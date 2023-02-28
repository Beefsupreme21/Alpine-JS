<x-layout>
    <div x-data="hangmanGame" class="max-w-lg mx-auto my-8">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="mb-4">
                <span class="font-bold">Current Word:</span>
                <span x-text="word"></span>
            </div>
            <div class="mb-4">
                <span class="font-bold">Displayed Word:</span>
                <span x-text="displayWord"></span>
            </div>
            <div class="mb-4">
                <span class="font-bold">Max Attempts:</span>
                <span x-text="maxAttempts"></span>
            </div>
            <div class="mb-4">
                <span class="font-bold">Remaining Attempts:</span>
                <span x-text="remainingAttempts"></span>
            </div>
            <div class="mb-4">
                <span class="font-bold">Guessed Letters:</span>
                <span x-text="Array.from(guessedLetters).join(', ')"></span>
            </div>
            <div x-show="showResults" class="mb-4">
                <p class="font-bold" x-text="resultsMessage"></p>
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
        </div>
    </div>
    

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('hangmanGame', () => ({
                word: 'hangman',
                letters: "abcdefghijklmnopqrstuvwxyz".split(""),
                maxAttempts: 6,
                guessedLetters: new Set(),
                displayWord: null,
                showResults: false,
                resultsMessage: null,
                
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

                init() {
                    this.displayWord = '_'.repeat(this.word.length);
                },

            }))
        })
    </script>
</x-layout>