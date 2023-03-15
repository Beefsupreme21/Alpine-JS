<x-layout>
    <div x-data="wheelOfFortune" class="max-w-lg mx-auto my-8">
        <div x-show="!gameStarted" class="flex flex-col items-center">
            <div class="w-full h-64 mb-4 flex justify-center items-center">
                <img src="{{ asset('images/wheel-of-fortune.png') }}" alt="" class="w-auto h-full object-contain">
            </div>
            <button x-on:click="startGame()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-80 mb-4">
              Start Game
            </button>
            <div class="flex">
              <button x-on:click="currentCategory = null" class="flex-1 mr-2 text-center py-2 px-4 rounded-lg border-2 border-gray-400 bg-gray-100 text-gray-700 hover:bg-gray-200 focus:outline-none focus:bg-gray-200" x-bind:class="currentCategory === null ? 'border-blue-500 text-blue-500 bg-white' : ''">
                Any
              </button>
              <button x-on:click="currentCategory = 'classic movie'" class="flex-1 mr-2 text-center py-2 px-4 rounded-lg border-2 border-gray-400 bg-gray-100 text-gray-700 hover:bg-gray-200 focus:outline-none focus:bg-gray-200" x-bind:class="currentCategory === 'classic movie' ? 'border-blue-500 text-blue-500 bg-white' : ''">
                Classic Movie
              </button>
              <button x-on:click="currentCategory = 'landmark'" class="flex-1 text-center py-2 px-4 rounded-lg border-2 border-gray-400 bg-gray-100 text-gray-700 hover:bg-gray-200 focus:outline-none focus:bg-gray-200" x-bind:class="currentCategory === 'landmark' ? 'border-blue-500 text-blue-500 bg-white' : ''">
                Landmark
              </button>
            </div>
        </div>
          
        <div x-show="gameStarted" x-cloak class="bg-white rounded-lg shadow-lg p-6">
            <h1 x-text="currentCategory" class="text-center capitalize"></h1>
            <div class="flex flex-wrap justify-center mb-8">
                <template x-for="(letter, index) in displayWord" :key="index">
                    <div>
                        <template x-if="letter == ' '">
                            <div class="bg-white w-8 h-8 mx-1 my-1 text-center capitalize flex items-center" x-text="letter"></div>
                        </template>
                        <template x-if="letter !== ' '">
                            <div class="border border-black bg-white w-8 h-8 mx-1 my-1 text-center capitalize flex items-center justify-center font-bold text-3xl" x-text="letter"></div>
                        </template>
                    </div>
                </template>
            </div>
            <div class="mb-4">
                <span class="font-bold">Remaining Attempts:</span>
                <span x-text="remainingAttempts"></span>
            </div>
            <div class="mb-4">
                <span class="font-bold">Guessed Letters:</span>
                <span x-text="Array.from(guessedLetters).join(', ')"></span>
            </div>
            <div class="flex flex-wrap mb-4">
                <template x-for="letter in letters">
                    <button x-text="letter"
                            x-on:click="guessLetter(letter)"
                            class="inline-block hover:bg-gray-400 focus:outline-none focus:shadow-outline capitalize rounded-full px-3 py-1 mx-1 text-white"
                            x-bind:class="{
                                'hover:bg-blue-400': !guessedLetters.has(letter),
                                'bg-gray-300': !displayWord.includes(letter),
                                'bg-green-500': displayWord.includes(letter),
                                'bg-red-500': incorrectGuesses.includes(letter)
                            }">
                    </button>
                </template>
            </div>
            <div x-show="showResults" class="mb-4">
                <p class="font-bold" x-text="resultsMessage"></p>
            </div>
        </div>
    </div>
    

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('wheelOfFortune', () => ({
                phrases: [
                    { phrase: 'caddyshack', category: 'classic movie' },
                    { phrase: 'ghostbusters', category: 'classic movie' },                    
                    { phrase: 'sydney opera house', category: 'landmark'},
                ],
                letters: "abcdefghijklmnopqrstuvwxyz".split(""),
                maxAttempts: 6,
                guessedLetters: new Set(),
                displayWord: null,
                showResults: false,
                resultsMessage: null,
                gameStarted: false,
                currentCategory: null, 

                startGame() {
                    let categoryPhrases = this.phrases;

                    if (this.currentCategory && this.currentCategory !== 'Any') {
                        categoryPhrases = this.phrases.filter(p => p.category === this.currentCategory);
                    }

                    const phraseObject = categoryPhrases[Math.floor(Math.random() * categoryPhrases.length)];
                    this.word = phraseObject.phrase;
                    this.currentCategory = phraseObject.category;
                    this.displayWord = this.word.replace(/[a-z]/gi, '_');
                    this.guessedLetters.clear();
                    this.showResults = false;
                    this.gameStarted = true;
                },

                
                get remainingAttempts() {
                    return this.maxAttempts - this.incorrectGuesses.length;
                },

                get incorrectGuesses() {
                    return Array.from(this.guessedLetters).filter(letter => !this.word.includes(letter));
                },

                guessLetter(letter) {
                    if (this.guessedLetters.has(letter)) {
                        return;
                    }

                    this.guessedLetters.add(letter);

                    if (this.word.includes(letter)) {
                        for (let i = 0; i < this.word.length; i++) {
                            if (this.word[i] === letter) {
                                this.displayWord = this.displayWord.slice(0, i) + letter + this.displayWord.slice(i + 1);
                            }
                        }
                        if (this.displayWord === this.word) {
                            this.showResults = true;
                            this.resultsMessage = 'You Win';
                        }
                    } else {
                        if (this.remainingAttempts === 0) {
                            this.showResults = true;
                            this.resultsMessage = 'You Lose';
                        }
                    }
                },
            }))
        })
    </script>
</x-layout>