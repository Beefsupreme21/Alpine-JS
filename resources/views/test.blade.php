<x-layout>
    <div x-data="game" class="text-white flex justify-center items-center h-screen">
        <div class="grid grid-cols-12 gap-2">
            <template x-for="i in 40">
                <div class="h-16 w-16 flex justify-center items-center rounded-lg text-white font-bold"
                    x-bind:class="getSquareColor(i)">
                    <p x-text="i === 1 ? 'Start' : (i === 40 ? 'Finish' : i)"></p>
                </div>
            </template>
        </div>
        <button
          x-on:click="square = square + 1"
          class="ml-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg"
        >
          Move
        </button>
      </div>
      
        <button x-on:click="rollDice()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">
            Roll Dice
        </button>
        <template x-if="diceOne">
            <div class="flex">
                <img :src="getDice(diceOne)" class="h-16 w-16 mr-4" />
                <img :src="getDice(diceTwo)" class="h-16 w-16" />
            </div>
        </template>
    </div>
    
    
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('game', () => ({
                diceOne: null,
                diceTwo: null,
                square: 0,

                rollDice() {
                    this.diceOne = Math.floor(Math.random() * 6) + 1;
                    this.diceTwo = Math.floor(Math.random() * 6) + 1;
                },
    
                getDice(roll) {
                    return '/images/dice/dice-' + roll + '.svg';
                },

                getSquareColor(square) {
                    const colors = ['bg-red-500', 'bg-purple-500', 'bg-blue-500', 'bg-green-500', 'bg-orange-500'];
                    const index = square % colors.length;
                    return colors[index];
                },
            }));
        });
    </script>
    
      
</x-layout>