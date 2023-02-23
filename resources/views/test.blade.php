<x-layout>
    <div x-data="pokemon" x-init="fetchPokemon()">
        <template x-if="!currentQuestionIndex">
            <button x-on:click="startQuiz(count)" class="px-4 py-2 bg-gray-700 text-white rounded-md">Start Quiz</button>
        </template>
        <template x-for="(pokemonData, index) in selectedPokemon" :key="index" x-show="currentQuestionIndex === index">
            <div x-show="pokemonData" class="mt-4">
                <h2 class="text-lg font-medium mb-2" x-text="'Question ' + (currentQuestionIndex + 1) + ' of ' + questions.length"></h2>
                <p class="mb-4" x-text="'Selected type: ' + pokemonData.randomType"></p>
                <div class="grid grid-cols-2 gap-4">
                    <template x-for="pokemon in pokemonData.selectedPokemon" :key="pokemon.name">
                        <div class="my-2 rounded-lg border border-gray-400 px-4 py-2 text-center cursor-pointer" x-on:click="selectedAnswer = pokemon.name" :class="{ 'bg-blue-500 text-white': selectedAnswer === pokemon.name, 'bg-gray-200': selectedAnswer !== pokemon.name }">
                            <span x-text="pokemon.name"></span>
                        </div>
                    </template>
                </div>
                <button class="bg-blue-500 text-white font-bold py-2 px-4 rounded mt-4" x-on:click="confirmAnswer()">Confirm Answer</button>
            </div>
        </template>
    </div>
    
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('pokemon', () => ({
                pokemons: [],
                selectedPokemon: [],
                count: 5,
                selectedAnswer: null,
                currentQuestion: null,
                correctAnswers: 0,
                currentQuestionIndex: 0,

                async getRandomPokemon() {
                    const types = this.pokemons.flatMap(pokemon => pokemon.types.map(type => type.type.name));
                    const randomTypeIndex = Math.floor(Math.random() * types.length);
                    const randomType = types[randomTypeIndex];
                    const typePokemon = this.pokemons.filter(pokemon => pokemon.types.some(type => type.type.name === randomType));
                    const randomTypePokemon = typePokemon[Math.floor(Math.random() * typePokemon.length)];
                    const nonTypePokemon = this.pokemons.filter(pokemon => pokemon.types.every(type => type.type.name !== randomType));
                    const randomNonTypePokemon1 = nonTypePokemon[Math.floor(Math.random() * nonTypePokemon.length)];
                    const randomNonTypePokemon2 = nonTypePokemon[Math.floor(Math.random() * nonTypePokemon.length)];
                    const randomNonTypePokemon3 = nonTypePokemon[Math.floor(Math.random() * nonTypePokemon.length)];
                    return {
                        randomType: randomType,
                        selectedPokemon: [randomTypePokemon, randomNonTypePokemon1, randomNonTypePokemon2, randomNonTypePokemon3]
                    };
                },
    
                async startQuiz(count) {
                    this.selectedPokemon = [];
                    for (let i = 0; i < count; i++) {
                        const result = await this.getRandomPokemon();
                        this.selectedPokemon.push(result);
                    }
                },
    
                fetchPokemon() {
                    axios.get('https://pokeapi.co/api/v2/pokemon?limit=150')
                        .then(response => {
                            this.pokemons = response.data.results;
                            Promise.all(this.pokemons.map(pokemon => axios.get(pokemon.url)))
                                .then(responses => {
                                    responses.forEach((response, i) => {
                                        this.pokemons[i].types = response.data.types;
                                    });
                                });
                        });
                },

                nextQuestion() {
                    if (this.currentQuestionIndex < this.count - 1) {
                        this.currentQuestion = this.selectedPokemon[this.currentQuestionIndex];
                        this.currentQuestionIndex++;
                        this.selectedAnswer = null;
                    } else {
                        this.showResults = true;
                    }
                },

                confirmAnswer() {
                    if (this.selectedAnswer === null) {
                        alert("Please select an answer!");
                        return;
                    }
                    if (this.currentQuestion.answers[this.selectedAnswer] === this.currentQuestion.correctAnswer) {
                        this.correctAnswers++;
                    }
                    this.nextQuestion();
                },
            }))
        })
    </script>
    
</x-layout>