<x-fullscreen-layout>
    <div x-data="blackjack" x-init="startGame()" class="flex flex-col justify-center h-screen">
        <div class="flex-grow">
            <div class="text-center">
                <h2 class="mb-4 font-bold text-lg">Dealer</h2>
                <h3 x-text="dealerHandValue" class="text-lg font-bold mb-2"></h3>
                <template x-for="(card, index) in dealerCards">
                    <span x-text="showCardValues[index] ? card.value + card.suit : 'X'" class="inline-block bg-white border border-gray-400 rounded-md p-1 m-1"></span>
                </template>
                <template x-if="!gameStarted" class="mt-4">
                    <button x-on:click="dealCards()" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">Deal Cards</button>
                </template>
            </div>
        </div>

        <div class="flex-grow">
            <div class="text-center">
                <h2 class="mb-4 font-bold text-lg">Player 1</h2>
                <h3 x-text="playerOneHandValue" class="text-lg font-bold mb-2"></h3>
                <div>
                    <template x-for="card in playerOneCards">
                        <span x-text="card.value + card.suit" class="inline-block bg-white border border-gray-400 rounded-md p-1 m-1"></span>
                    </template>
                    <div>
                        <button x-on:click="playerHit()" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mt-4">Hit</button>
                        <button x-on:click="playerStand()" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mt-4 ml-4">Stand</button>
                    </div>
                </div>
                <p x-text="resultsMessage" class="text-lg font-bold mt-4"></p>
                <div x-show="playerOneCards && resultsMessage" class="mt-4">
                    <button x-on:click="resetGame()" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Deal Again</button>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('blackjack', () => ({
                deck: [],
                playerOneCards: [],
                dealerCards: [],
                playerOneHandValue: 0,
                dealerHandValue: 0,
                showCardValues: [false, true, true, true, true], 
                resultsMessage: null,
                gameStarted: false,

                startGame() {
                    this.deck = this.getDeck();
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
                        'J': 10,
                        'Q': 10,
                        'K': 10,
                        'A': 11,
                    };
                    for (const suit of suits) {
                        for (const value of values) {
                            const card = {
                                value,
                                suit,
                                points: pointValues[value],
                                isHidden: false,
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
        
                dealCards() {
                    this.gameStarted = true;
                    this.drawCard('playerOne');
                    this.drawCard('dealer');
                    this.drawCard('playerOne');
                    this.drawCard('dealer');
                },
        
                drawCard(player) {
                    const card = this.deck.shift();
                    if (player === 'playerOne') {
                        this.playerOneCards.push(card);
                        this.calculateHandValue(player);
                    } else if (player === 'dealer') {
                        this.dealerCards.push(card);
                        this.calculateHandValue(player);
                        this.showCardValues.push(false);
                    }
                    if (card.value === 'A' && this[player + 'HandValue'] > 21) {
                        this[player + 'HandValue'] -= 10;
                    }
                },

                hit() {
                    const card = this.deck.shift();
                    this.playerOneCards.push(card);
                    this.calculateHandValue('playerOne');
                    if (this.playerOneHandValue > 21) {
                        this.dealerWins();
                    } else if (this.playerOneHandValue == 21) {
                        this.dealerTurn();
                    }
                },

                playerHit() {
                    this.hit();
                },

                playerStand() {
                    this.dealerTurn();
                },

                dealerTurn() {
                    this.revealCardValues();
                    while (this.dealerHandValue < 17) {
                        const card = this.deck.shift();
                        this.dealerCards.push(card);
                        this.calculateHandValue('dealer');
                    }
                    if (this.dealerHandValue > 21) {
                        this.playerWins();
                    } else if (this.dealerHandValue == this.playerOneHandValue) {
                        this.playerTies();
                    }else if (this.dealerHandValue >= this.playerOneHandValue) {
                        this.dealerWins();
                    } else {
                        this.playerWins();
                    }
                },

                playerWins() {
                    this.resultsMessage = "Player wins!"
                },

                playerTies() {
                    this.revealCardValues();
                    this.resultsMessage = "Push"
                },

                dealerWins() {
                    this.revealCardValues();
                    this.resultsMessage = "Dealer wins!"
                },

                revealCardValues() {
                    this.showCardValues[0] = true;
                },

                resetGame() {
                    this.playerOneCards = [];
                    this.dealerCards = [];
                    this.playerOneHandValue = 0;
                    this.dealerHandValue = 0;
                    this.resultsMessage = null;
                    this.deck = this.getDeck();
                    this.dealCards();
                    this.showCardValues[0] = false;
                },

                sumCardValues(cards) {
                    let handValue = 0;
                    let numAces = 0;
                    for (const card of cards) {
                        handValue += card.points;
                        if (card.value === 'A') {
                            numAces++;
                        }
                    }
                    while (handValue > 21 && numAces > 0) {
                        handValue -= 10;
                        numAces--;
                    }
                    return handValue;
                },

                calculateHandValue(player) {
                    if (player === 'playerOne') {
                        this.playerOneHandValue = this.sumCardValues(this.playerOneCards);
                    } else if (player === 'dealer') {
                        this.dealerHandValue = this.sumCardValues(this.dealerCards);
                    }
                },
            }))
        })
    </script>
      
</x-fullscreen-layout>