<x-layout>
    <div x-data="hangmanGame">
        <div>
            <span>Current Word</span>
            <span x-text="word"></span>
        </div>
        <div>
            <span>Displayed Word</span>
            <span x-text="displayWord"></span>
        </div>
        <div>
            <span>Max Attempts</span>
            <span x-text="maxAttempts"></span>
        </div>
        <div>
            <span>Remaining Attempts</span>
            <span x-text="remainingAttempts"></span>
        </div>
        <div>
            <span>Guessed Letters</span>
            <span x-text="Array.from(guessedLetters).join(', ')"></span>
        </div>
        <template x-for="letter in letters">
            <button x-text="letter"
                    x-on:click="guessLetter(letter)"
                    class="inline-block hover:bg-gray-400 focus:outline-none focus:shadow-outline capitalize rounded-full px-3 py-1 mx-1"
                    :class="{
                        'hover:bg-blue-400': !guessedLetters.has(letter),
                        'bg-gray-300': !displayWord.includes(letter),
                        'bg-green-500': displayWord.includes(letter),
                        'bg-red-500': incorrectGuesses.includes(letter)
                      }">
            </button>
        </template>
          
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('hangmanGame', () => ({
                word: 'hangman',
                letters: "abcdefghijklmnopqrstuvwxyz".split(""),
                maxAttempts: 6,
                guessedLetters: new Set(),
                displayWord: null,
                
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
                    }
                },

                init() {
                    this.displayWord = '_'.repeat(this.word.length);
                },

            }))
        })
    </script>
</x-layout>