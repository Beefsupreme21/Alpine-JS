<x-layout>
    <div x-data="pokemon" x-init="fetchPokemon()" class="text-white">
        <p class="text-2xl font-bold" x-text="`${timer.toFixed(2)} sec`"></p>   
        <div x-show="currentQuestionIndex === null">
            <button x-on:click="startQuiz(count)" class="bg-blue-500 text-white font-bold py-2 px-4 rounded mt-4">Start Quiz</button>
        </div>
        <template x-if="currentQuestionIndex !== null && !showResults">
            <div>
                <h2 x-text="'Question ' + (currentQuestionIndex + 1) + ' of ' + count" class="text-lg font-medium mb-2"></h2>
                <p x-text="'Selected type: ' + selectedPokemon[currentQuestionIndex].randomType" class="mb-4 capitalize"></p>
                <div class="grid grid-cols-2 gap-2">
                    <template x-for="pokemon in selectedPokemon[currentQuestionIndex].selectedPokemon" :key="pokemon.name">
                        <div class="rounded-lg border border-gray-400 px-4 py-2 text-center capitalize cursor-pointer" 
                            x-on:click="selectedAnswer = pokemon.name" 
                            :class="{ 'bg-blue-500 text-white': selectedAnswer === pokemon.name, 'bg-gray-700': selectedAnswer !== pokemon.name }"
                            >
                            <span x-text="pokemon.name"></span>
                        </div>
                    </template>
                </div>
                <button x-on:click="confirmAnswer()" class="bg-blue-500 text-white font-bold py-2 px-4 rounded mt-4">Confirm Answer</button>
            </div>
        </template>
        <template x-if="showResults">
            <div>
                <h2 class="text-lg font-medium mb-2" x-text="'Quiz Results'"></h2>
                <p class="mb-4">You got <span class="font-medium" x-text="correctAnswers"></span> out of <span class="font-medium" x-text="count"></span> questions correct!</p>
                <a href="/games/pokemon-quiz" class="bg-blue-500 text-white font-bold py-2 px-4 rounded">Retry Quiz</a>
            </div>
        </template>
    </div>
    
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('pokemon', () => ({
                pokemons: [],
                selectedPokemon: [],
                count: 3,
                selectedAnswer: null,
                correctAnswers: 0,
                currentQuestionIndex: null,
                showResults: false, 
                timer: 0,
                intervalId: null,

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
                    const selectedPokemon = [randomTypePokemon, randomNonTypePokemon1, randomNonTypePokemon2, randomNonTypePokemon3];

                    for (let i = selectedPokemon.length - 1; i > 0; i--) {
                        const j = Math.floor(Math.random() * (i + 1));
                        const temp = selectedPokemon[i];
                        selectedPokemon[i] = selectedPokemon[j];
                        selectedPokemon[j] = temp;
                    };

                    return {
                        randomType: randomType,
                        selectedPokemon: selectedPokemon
                    };
                },

                shuffleArray(array) {
                    for (let i = array.length - 1; i > 0; i--) {
                        const j = Math.floor(Math.random() * (i + 1));
                        [array[i], array[j]] = [array[j], array[i]];
                    }
                    return array;
                },

                async startQuiz(count) {
                    this.selectedPokemon = [];
                    this.elapsedTime = 0;
                    this.startTimer();
                    for (let i = 0; i < count; i++) {
                        const result = await this.getRandomPokemon();
                        result.index = i + 1;
                        this.selectedPokemon.push(result);
                    }
                    this.currentQuestionIndex = 0;
                    this.startTimer();

                },

                startTimer() {
                    if (!this.intervalId) {
                    this.intervalId = setInterval(() => {
                        this.timer += 0.01;
                    }, 10);
                    }
                },

                pauseTimer() {
                    if (this.intervalId) {
                    clearInterval(this.intervalId);
                    this.intervalId = null;
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
                        this.currentQuestionIndex++;
                        this.selectedAnswer = null;
                    } else {
                        this.showResults = true;
                        this.pauseTimer();
                    }
                },

                confirmAnswer() {
                    console.log('confirmedAnswer:', this.selectedAnswer);
                    console.log('currentQuestionIndex:', this.currentQuestionIndex);
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
