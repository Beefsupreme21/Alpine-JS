<x-fullscreen-layout>
    <div x-data="blackjack" x-init="startGame()" class="flex flex-col justify-center h-screen bg-[#1C3A28]">
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
            <div x-show="gamePhase === 'betting'">Place your bet</div>
            <div x-show="gamePhase === 'playing'">Hit or stand</div>
            <div x-show="gamePhase === 'gameOver'">
                <p x-text="resultsMessage" class="text-lg font-bold mt-4"></p>
            </div>
        </div>
        <div class="fixed top-4 left-4 text-lg font-bold">
            <a href="/" class="hover:underline">Back to home</a>
            <p class="mt-6">Balance: $<span x-text="playerBalance"></span></p>
        </div>
        <div class="flex-grow">
            <div class="text-center">
                <h2 class="mb-4 font-bold text-lg">$<span x-text="currentBet"></span></h2>
                <div>
                    <template x-if="playerHandValue">
                        <span x-text="playerHandValue" class="text-lg font-bold p-3 bg-red-500 rounded-full"></span>
                    </template>
                </div>

                <template x-for="card in playerCards">
                    <img x-bind:src="getCardImage(card)" class="inline-block bg-white border border-gray-400 rounded-md p-1 m-1">
                </template>
            </div>
        </div>
        <div class="flex justify-center mb-12">
            <div x-show="gamePhase === 'playing'">
                <button x-on:click="playerStand()" class="bg-gray-500 text-white text-2xl font-bold py-3 px-6 rounded-lg">Stand</button>
                <button x-on:click="playerHit()" class="bg-red-500 text-white text-2xl font-bold py-3 px-6 ml-3 rounded-lg">Hit</button>
            </div>
            <div x-show="gamePhase === 'betting'">
                <button x-bind:disabled="currentBet === 0" 
                    x-on:click="currentBet = 0" 
                    x-bind:class="{'opacity-50 cursor-not-allowed': currentBet === 0, 'hover:bg-gray-600': currentBet !== 0}" 
                    class="bg-gray-500 text-white text-2xl font-bold py-3 px-6 rounded-lg">
                    CLEAR
                </button>
                <button x-bind:disabled="currentBet === 0" 
                    x-on:click="placeBet()" 
                    x-bind:class="{'opacity-50 cursor-not-allowed': currentBet === 0, 'hover:bg-red-600': currentBet !== 0}" 
                    class="bg-red-500 text-white text-2xl font-bold py-3 px-6 ml-3 rounded-lg">
                    PLAY
                </button>
            </div>
        </div>
        <div class="fixed bottom-4 right-4 space-x-2">
            <button x-on:click="if (currentBet < playerBalance) { currentBet += 1 }">
                <x-svg.chip-1/>
            </button>
            <button x-on:click="if (currentBet < playerBalance) { currentBet += 5 }">
                <x-svg.chip-5/>
            </button>
            <button x-on:click="if (currentBet < playerBalance) { currentBet += 25 }">
                <x-svg.chip-25/>
            </button>
            <button x-on:click="if (currentBet < playerBalance) { currentBet += 100 }">
                <x-svg.chip-100/>
            </button>
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