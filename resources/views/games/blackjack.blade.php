<x-fullscreen-layout>
    <div x-data="blackjack" x-init="startGame()" class="flex flex-col justify-center h-screen">
        <div class="flex-grow">
            <div class="text-center">
                <h2 class="mb-4 font-bold text-lg">Dealer</h2>
                <h3 x-text="dealerHandValue" class="text-lg font-bold mb-2"></h3>
                <template x-for="(card, index) in dealerCards">
                    <img x-bind:src="showCardValues[index] ? getCardImage(card) : '/images/cards/back-blue.png'" class="inline-block bg-white border border-gray-400 rounded-md p-1 m-1" alt="">
                </template>
            </div>
        </div>
        <div>
            <button x-on:click="if (currentBet < playerBalance) { currentBet += 1 }">
                <svg width="100" height="100" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="50" cy="50" r="45" fill="#2196F3" stroke="black" stroke-width="2" />
                    <circle cx="50" cy="50" r="30" fill="white" stroke="black" stroke-width="2" />
                    <text x="50" y="58" font-size="24" font-family="Arial" font-weight="bold" text-anchor="middle">1</text>
                </svg>
            </button>
            <button x-on:click="if (currentBet < playerBalance) { currentBet += 5 }">
                <svg width="100" height="100" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="50" cy="50" r="45" fill="#FF0000" stroke="black" stroke-width="2" />
                    <circle cx="50" cy="50" r="30" fill="white" stroke="black" stroke-width="2" />
                    <text x="50" y="58" font-size="24" font-family="Arial" font-weight="bold" text-anchor="middle">5</text>
                </svg>
            </button>
            <button x-on:click="if (currentBet < playerBalance) { currentBet += 25 }">
                <svg width="100" height="100" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="50" cy="50" r="45" fill="#008000" stroke="black" stroke-width="2" />
                    <circle cx="50" cy="50" r="30" fill="white" stroke="black" stroke-width="2" />
                    <text x="50" y="58" font-size="24" font-family="Arial" font-weight="bold" text-anchor="middle">25</text>
                </svg>
            </button>
            <button x-on:click="if (currentBet < playerBalance) { currentBet += 100 }">
                <svg width="100" height="100" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="50" cy="50" r="45" fill="#000000" stroke="black" stroke-width="2" />
                    <circle cx="50" cy="50" r="30" fill="white" stroke="black" stroke-width="2" />
                    <text x="50" y="58" font-size="24" font-family="Arial" font-weight="bold" text-anchor="middle">100</text>
                </svg>
            </button>
        </div>




          
        <div class="flex flex-grow justify-between items-center">
            <div>
                <h3 class="text-lg font-bold mb-2">Balance:</h3>
                <span x-text="playerBalance" class="text-xl font-bold"></span>
            </div>
    
            <div>
                <span class="font-semibold text-3xl mx-4 w-20 text-center" x-text="currentBet"></span>
            </div>
    
            <div>
                <button x-on:click="currentBet = 0" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Clear</button>
                <button x-bind:disabled="currentBet === 0" x-on:click="placeBet()" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Play</button>
            </div>
        </div>
    
        <div class="flex-grow">
            <div class="text-center">
                <h2 class="mb-4 font-bold text-lg">Player 1</h2>
                <template x-if="playerCards.some(card => card.value === 'A')">
                    <span class="text-lg font-bold mb-2"><span x-text="playerHandValue - 10"></span> or </span>
                </template>
                <span x-text="playerHandValue" class="text-lg font-bold mb-2"></span>
                <div>
                    <template x-for="card in playerCards">
                        <img x-bind:src="getCardImage(card)" class="inline-block bg-white border border-gray-400 rounded-md p-1 m-1" alt="">
                    </template>
                    <div>
                        <button x-on:click="playerHit()" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mt-4">Hit</button>
                        <button x-on:click="playerStand()" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mt-4 ml-4">Stand</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('blackjack', () => ({
                deck: [],
                playerCards: [],
                dealerCards: [],
                playerHandValue: 0,
                dealerHandValue: 0,
                playerBalance: 1000,
                currentBet: 0,
                showCardValues: [false, true, true, true, true], 
                resultsMessage: null,
                gamePhase: 'betting',

                startGame() {
                    this.gamePhase = 'betting';
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
                                displayName: value,
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

                getCardImage(card) {
                    const suitName = card.suit === '♠' ? 'spade' :
                                    card.suit === '♣' ? 'club' :
                                    card.suit === '♥' ? 'heart' : 'diamond';
                    const valueName = card.displayName === 'A' ? '1' :
                                    card.displayName === 'K' ? 'king' :
                                    card.displayName === 'Q' ? 'queen' :
                                    card.displayName === 'J' ? 'jack' : card.displayName;
                    const imageName = `${suitName}_${valueName}`;
                    return `/images/cards/${imageName}.png`;
                },
        
                dealCards() {
                    this.drawCard('player');
                    this.drawCard('dealer');
                    this.drawCard('player');
                    this.drawCard('dealer');
                },
        
                drawCard(player) {
                    const card = this.deck.shift();
                    if (player === 'player') {
                        this.playerCards.push(card);
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

                playerHit() {
                    const card = this.deck.shift();
                    this.playerCards.push(card);
                    this.calculateHandValue('player');
                    if (this.playerHandValue > 21) {
                        this.dealerWins();
                    } else if (this.playerHandValue == 21) {
                        this.dealerTurn();
                    }
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
                    } else if (this.dealerHandValue == this.playerHandValue) {
                        this.playerTies();
                    }else if (this.dealerHandValue >= this.playerHandValue) {
                        this.dealerWins();
                    } else {
                        this.playerWins();
                    }
                },

                playerWins() {
                    this.resultsMessage = "Player wins!";
                    this.playerBalance += this.currentBet * 2;
                    this.currentBet = 0;
                    this.gamePhase = 'gameOver';
                },

                playerTies() {
                    this.revealCardValues();
                    this.resultsMessage = "Push";
                    this.playerBalance += this.currentBet;
                    this.currentBet = 0;
                    this.gamePhase = 'gameOver';
                },

                dealerWins() {
                    this.revealCardValues();
                    this.resultsMessage = "Dealer wins!";
                    this.currentBet = 0;
                    this.gamePhase = 'gameOver';
                },

                placeBet() {
                    this.playerBalance -= this.currentBet;
                    this.gamePhase = 'playing'; // Change phase to 'playing' after placing a bet
                    this.dealCards();
                },

                revealCardValues() {
                    this.showCardValues[0] = true;
                },

                resetGame() {
                    this.playerCards = [];
                    this.dealerCards = [];
                    this.playerHandValue = 0;
                    this.dealerHandValue = 0;
                    this.resultsMessage = null;
                    this.deck = this.getDeck();
                    // this.dealCards();
                    this.showCardValues[0] = false;
                    this.gamePhase = 'betting';
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
                    if (player === 'player') {
                        this.playerHandValue = this.sumCardValues(this.playerCards);
                    } else if (player === 'dealer') {
                        this.dealerHandValue = this.sumCardValues(this.dealerCards);
                    }
                },
            }))
        })
    </script>
      
</x-fullscreen-layout>