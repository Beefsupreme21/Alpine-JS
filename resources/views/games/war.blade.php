<x-fullscreen-layout>
    <div x-data="war" class="h-screen flex flex-col justify-center items-center">
        <div x-show="!gameStarted">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2" x-on:click="startGame()">Start Game</button>
        </div>
        <div x-show="gameStarted" class="flex justify-evenly">
            <div>
                <h1 class="text-3xl font-bold mb-6 text-center">War</h1>
                <div class="flex justify-between mb-6 mr-8 bg-gray-100 p-6 rounded-lg">
                    <div class="flex flex-col items-center border border-black bg-white p-4 rounded-lg w-1/2">
                        <h2 class="text-lg font-bold mb-4">Player 1</h2>
                        <h3 class="text-xl font-bold mb-4">Cards Left: <span x-text="playerOneCards.length"></span></h3>
                        <div class="text-4xl font-bold" x-show="playerOneCard">
                          <span x-text="playerOneCard.value + playerOneCard.suit"></span>
                        </div>
                    </div>
                    <div class="flex flex-col items-center border border-black bg-white p-4 rounded-lg w-1/2">
                        <h2 class="text-lg font-bold mb-4">Player 2</h2>
                        <h3 class="text-xl font-bold mb-4">Cards Left: <span x-text="playerTwoCards.length"></span></h3>
                        <div class="text-4xl font-bold" x-show="playerTwoCard">
                          <span x-text="playerTwoCard.value + playerTwoCard.suit"></span>
                        </div>
                    </div>
                </div>
                <p class="text-lg font-bold mb-4 text-center" x-text="message"></p>
                <div x-if="tieCards.length > 0" class="tie-cards">
                    <template x-for="card in tieCards">
                        <div class="card">
                            <div class="card-value" x-text="card.value"></div>
                            <div class="card-suit" x-text="card.suit"></div>
                        </div>
                    </template>
                </div>
                <div class="flex justify-center">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2" x-on:click="drawCards()">Draw</button>
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" x-on:click="reset()">Reset</button>
                </div>
            </div>
            <div class="mt-4">
                <h2 class="text-lg font-bold mb-2">Game History</h2>
                <ul>
                    <template x-for="round in history">
                        <li>
                            Player 1: <span x-text="round.playerOneCard.value + round.playerOneCard.suit"></span>,
                            <span x-text="round.playerOneScore"></span>,
                            Player 2: <span x-text="round.playerTwoCard.value + round.playerTwoCard.suit"></span>,
                            <span x-text="round.playerTwoScore"></span>,
                            <span x-text="round.message"></span>
                        </li>
                    </template>
                </ul>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('war', () => ({
                playerOneCards: [],
                playerTwoCards: [],
                deck: [],
                playerOneCard: null,
                playerTwoCard: null,
                message: null,
                winningCards: [],
                gameStarted: false,
                history: [], 
                tiedCards: [], 

                startGame() {
                    this.gameStarted = true;
                    this.deck = this.getDeck();
                    this.deck = this.shuffle(this.deck);

                    for (let i = 0; i < this.deck.length; i++) {
                        if (i % 2 === 0) {
                            this.playerOneCards.push(this.deck[i]);
                        } else {
                            this.playerTwoCards.push(this.deck[i]);
                        }
                    }
                },
        
                getDeck() {
                    const values = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];
                    const suits = ['♠', '♣', '♥', '♦'];
                    const deck = [];
                    const pointValues = {
                        '2': 2,
                        '3': 3,
                        '4': 4,
                        '5': 5,
                        '6': 6,
                        '7': 7,
                        '8': 8,
                        '9': 9,
                        '10': 10,
                        'J': 11,
                        'Q': 12,
                        'K': 13,
                        'A': 14,
                    };
                    for (const suit of suits) {
                        for (const value of values) {
                        const card = {
                            value,
                            suit,
                            points: pointValues[value],
                        };
                        deck.push(card);
                        }
                    }
                    return this.shuffle(deck);
                },
        
                shuffle(deck) {
                    for (let i = deck.length - 1; i > 0; i--) {
                        const j = Math.floor(Math.random() * (i + 1));
                        [deck[i], deck[j]] = [deck[j], deck[i]];
                    }
                    return deck;
                },
        
                drawCards() {
                    this.drawCard('playerOne');
                    this.drawCard('playerTwo');
                    this.determineRoundWinner();
                },
        
                drawCard(player) {
                    if (player === 'playerOne') {
                        this.playerOneCard = this.playerOneCards.shift();
                    } else if (player === 'playerTwo') {
                        this.playerTwoCard = this.playerTwoCards.shift();
                    }
                },

                determineRoundWinner() {
                    if (this.playerOneCard && this.playerTwoCard) {
                        const playerOnePoints = this.playerOneCard.points;
                        const playerTwoPoints = this.playerTwoCard.points;

                        if (playerOnePoints > playerTwoPoints) {
                            this.message = 'Player 1 wins round!';
                            this.addtoHistory();
                            this.winningCards.push(this.playerOneCard, this.playerTwoCard);
                            this.playerOneCards.push(...this.winningCards);
                            this.winningCards = [];
                        } else if (playerTwoPoints > playerOnePoints) {
                            this.message = 'Player 2 wins round!';
                            this.addtoHistory();
                            this.winningCards.push(this.playerTwoCard, this.playerOneCard);
                            this.playerTwoCards.push(...this.winningCards);
                            this.winningCards = [];
                        } else {
                            this.message = 'Tie!';
                            this.addtoHistory();
                        }
                    }
                },

                addtoHistory() {
                    this.history.push({
                        playerOneCard: this.playerOneCard,
                        playerTwoCard: this.playerTwoCard,
                        playerOneScore: this.playerOneCards.length,
                        playerTwoScore: this.playerTwoCards.length,
                        message: this.message
                    });
                },


                reset() {
                    this.playerOneCards = [];
                    this.playerTwoCards = [];
                    this.deck = [];
                    this.playerOneCard = null;
                    this.playerTwoCard = null;
                },
            }))
        })
    </script>
      
</x-fullscreen-layout>