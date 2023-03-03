<x-layout>
    <div x-data="game">
        <div class="flex justify-between h-32">
            <div class="py-4">
                <p class="text-lg font-semibold">Player <span x-text="currentPlayer"></span>'s Turn</p>
            </div>
            <template x-if="diceOne">
                <div class="flex items-center py-4">
                    <img :src="getDice(diceOne)" class="h-16 w-16 mr-4" />
                    <img :src="getDice(diceTwo)" class="h-16 w-16" />
                </div>
            </template>
            <div x-show="!showResults">
                <button x-on:click="rollDice()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">
                    Roll Dice
                </button>
            </div>
            <div x-show="showResults">
                <button x-on:click="playAgain()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">
                    Play Again
                </button>
            </div>
        </div>
        <div x-show="showResults">
            <p x-text="'Player ' + (playerOneSquare >= 40 ? 1 : 2) + ' wins!'" class="text-center"></p>
        </div>
        <div class="relative max-w-screen-sm mx-auto">
            <div class="grid grid-cols-8 gap-1 relative">
                <template x-for="i in 40">
                    <div class="relative" style="padding-bottom: 100%;">
                        <div class="absolute inset-0 bg-gray-500 opacity-25"></div>
                        <div class="absolute inset-0 flex justify-center items-center text-white font-bold"
                            x-bind:class="getSquareColor(i)">
                            <p x-text="i"></p>
                        </div>
                        <template x-if="i == playerOneSquare">
                            <div class="absolute bg-yellow-500 rounded-full border border-black text-center w-6 h-6">1</div>
                        </template>
                        <template x-if="i == playerTwoSquare">
                            <div class="absolute bg-blue-500 rounded-full border border-black text-center w-6 h-6 ml-9">2</div>
                        </template>
                    </div>
                </template>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('game', () => ({
                diceOne: null,
                diceTwo: null,
                playerOneSquare: 1,
                playerTwoSquare: 1,
                currentPlayer: 1,
                showResults: false,

                rollDice() {
                    this.diceOne = Math.floor(Math.random() * 6) + 1;
                    this.diceTwo = Math.floor(Math.random() * 6) + 1;
                    const totalRoll = this.diceOne + this.diceTwo;

                    if (this.currentPlayer === 1) {
                        this.playerOneSquare += totalRoll;
                        this.gameOver(this.playerOneSquare);
                        this.currentPlayer = 2;

                    } else {
                        this.playerTwoSquare += totalRoll;
                        this.gameOver(this.playerTwoSquare);
                        this.currentPlayer = 1;
                    }
                },

                gameOver(playerSquare) {
                    if (playerSquare >= 40) {
                        this.showResults = true;
                    } 
                },

                playAgain() {
                    this.playerOneSquare = 1;
                    this.playerTwoSquare = 1;
                    this.currentPlayer = 1;
                    this.showResults = false;
                },
    
                getDice(roll) {
                    return '/images/dice/dice-' + roll + '.svg';
                },

                getSquareColor(square) {
                    const colors = ['bg-red-500', 'bg-purple-500', 'bg-pink-500', 'bg-green-500', 'bg-orange-500'];
                    const index = square % colors.length;
                    return colors[index];
                },
            }));
        });
    </script>
    
</x-layout>