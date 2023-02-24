<x-layout>
    <div x-data="pokemon" x-init="fetchPokemon()" class="text-white">
        <template x-if="!currentQuestionIndex">
            <button x-on:click="startQuiz(count)">Start Quiz</button>
        </template>
        <template x-if="currentQuestionIndex !== null && !showResults">
            <div>
                <h2 x-text="'Question ' + (currentQuestionIndex + 1) + ' of ' + count"></h2>
                <p x-text="'Selected type: ' + selectedPokemon[currentQuestionIndex].randomType"></p>
                <template x-for="pokemon in selectedPokemon[currentQuestionIndex].selectedPokemon" :key="pokemon.name">
                    <div class="cursor-pointer" 
                        x-on:click="selectedAnswer = pokemon.name; console.log('selectedAnswer:', selectedAnswer)" 
                        :class="{ 'bg-blue-500 text-white': selectedAnswer === pokemon.name, 'bg-gray-700': selectedAnswer !== pokemon.name }"
                        >
                        <span x-text="pokemon.name"></span>
                    </div>
                </template>
                <button x-on:click="confirmAnswer()">Confirm Answer</button>
            </div>
        </template>
        <template x-if="showResults">
            <div>
                <h2 class="text-lg font-medium mb-2" x-text="'Quiz Results'"></h2>
                <p class="mb-4">You got <span class="font-medium" x-text="correctAnswers"></span> out of <span class="font-medium" x-text="count"></span> questions correct!</p>
                <button class="bg-blue-500 text-white font-bold py-2 px-4 rounded" x-on:click="restartQuiz()">Retry Quiz</button>
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
                correctAnswers: 0,
                currentQuestionIndex: null,
                showResults: false, 

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
                        result.index = i + 1;
                        this.selectedPokemon.push(result);
                    }
                    this.currentQuestionIndex = 0;
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
                        this.currentQuestionIndex++;
                        this.selectedAnswer = null;
                    } else {
                        this.showResults = true;
                    }
                },

                confirmAnswer() {
                    console.log('confirmedAnswer:', this.selectedAnswer)
                    if (this.selectedAnswer === null) {
                        alert("Please select an answer!");
                        return;
                    }
                    if (this.selectedPokemon[this.currentQuestionIndex].selectedPokemon.find(pokemon => pokemon.name === this.selectedAnswer).types.some(type => type.type.name === this.selectedPokemon[this.currentQuestionIndex].randomType)) {
                        this.correctAnswers++;
                    }
                    this.nextQuestion();
                },
            }))
        });
    </script>
    
</x-layout>