<x-fullscreen-layout>
    <div x-data="war">
        <div>
            <h1>War</h1>
            <div class="flex mb-4">
                <div>
                    <h2>Player 1</h2>
                    <div x-show="playerOneCard">
                        <span x-text="playerOneCard.value + playerOneCard.suit"></span>
                    </div>
                </div>
                <div>
                    <h2>Player 2</h2>
                    <div x-show="playerTwoCard">
                        <span x-text="playerTwoCard.value + playerTwoCard.suit"></span>
                    </div>
                </div>
            </div>
            <button x-on:click="drawCards()">Draw</button>
            <button x-on:click="deal()">Start Game</button>
            <button x-on:click="reset()">Reset</button>
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
        
                deal() {
                    this.deck = this.getDeck();
                    this.deck = this.shuffle(this.deck);
                    this.playerOneCards = [];
                    this.playerTwoCards = [];
                    for (let i = 0; i < this.deck.length; i++) {
                        if (i % 2 === 0) {
                            this.playerOneCards.push(this.deck[i]);
                        } else {
                            this.playerTwoCards.push(this.deck[i]);
                        }
                    }
                },
        
                reset() {
                    this.playerOneCards = [];
                    this.playerTwoCards = [];
                    this.deck = [];
                    this.playerOneCard = null;
                    this.playerTwoCard = null;
                },
        
                getDeck() {
                    const values = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];
                    const suits = ['♠', '♣', '♥', '♦'];
                    const deck = [];
                    for (const suit of suits) {
                        for (const value of values) {
                            deck.push({ value, suit });
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
                },
        
                drawCard(player) {
                    if (player === 'playerOne') {
                        this.playerOneCard = this.playerOneCards.shift();
                    } else if (player === 'playerTwo') {
                        this.playerTwoCard = this.playerTwoCards.shift();
                    }
                },
            }))
        })
    </script>
      
</x-fullscreen-layout>