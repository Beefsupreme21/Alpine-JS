<x-fullscreen-layout>
    <div x-data="game" class="px-32">
        <div style="background-image: url('/images/racetracks/Background 2-1.png'); background-repeat: no-repeat; height: 50vh;">
            <div class="pt-44">
                <template x-for="(horse, index) in horses">
                    <img x-bind:src="getHorseSprite(horse)" class="h-16 w-16 -mb-8" x-bind:style="'transform: translateX(' + (horse.position) + 'px)'"/>
                </template>
            </div>
        </div>
        <div class="container mx-auto mt-8">
            <p class="text-center text-2xl font-bold mb-4">$<span x-text="money"></span></p>
            <p class="text-2xl font-bold" x-text="`${timer.toFixed(2)} sec`"></p>   

            <div class="flex justify-center mb-8">
                <template x-for="(horse, index) in horses">
                    <div class="mx-4 cursor-pointer" x-on:click="selectedHorse = index" x-bind:class="{ 'border border-blue-500': selectedHorse === index }">
                        <img x-bind:src="getHorsePortrait(horse)" class="h-48 w-48 rounded-lg" />
                        <p class="text-center font-bold mt-2 text-lg" x-text="horse.name"></p>
                        <p class="text-center mt-1" x-text="'Odds: ' + horse.odds + ':1'"></p>
                        <template x-if="winner == horse">
                            <p class="text-center font-bold mt-2 text-lg">1st</p>
                        </template>
                        <template x-if="secondPlace == horse">
                            <p class="text-center font-bold mt-2 text-lg">2nd</p>
                        </template>
                        <template x-if="thirdPlace == horse">
                            <p class="text-center font-bold mt-2 text-lg">3rd</p>
                        </template>
                    </div>
                </template>
            </div>
            <div class="flex justify-center mt-4">
                <input class="border-2 border-gray-300 p-2 rounded-lg w-32 text-center" type="number" min="0" step="10" x-model.number="betAmount" placeholder="Bet amount" x-bind:disabled="raceStarted">
                <button class="ml-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" x-on:click="placeBet(selectedHorse)" x-bind:disabled="raceStarted">Place Bet</button>
            </div>
            
            <div x-show="!raceStarted" class="flex justify-center">
                <button class="px-4 py-2 text-lg font-bold text-white bg-blue-500 rounded hover:bg-blue-700" x-on:click="startRace()">Start</button>
            </div>
            <template x-if="finishedHorses.length == horses.length" class="flex justify-center">
                <button class="px-4 py-2 text-lg font-bold text-white bg-blue-500 rounded hover:bg-blue-700" x-on:click="restartRace()">Race Again</button>
            </template>
        </div>
    </div>
    
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('game', () => ({
                horses: [
                    { number: 1, name: 'Horsing Around', minSpeed: 3, maxSpeed: 5, position: 0, animationIndex: 1, odds: 29 },
                    { number: 2, name: 'Sir Gallopsalot', minSpeed: 3, maxSpeed: 5, position: 0, animationIndex: 1, odds: 3 },
                    { number: 3, name: 'Hoof Hearted', minSpeed: 5, maxSpeed: 5.2, position: 0, animationIndex: 1, odds: 5 },
                    { number: 4, name: 'Fifty Shades of Hay', minSpeed: 3, maxSpeed: 5, position: 0, animationIndex: 1, odds: 10 },
                    { number: 5, name: 'Neigh Sayer', minSpeed: 3, maxSpeed: 5.2, position: 0, animationIndex: 1, odds: 15 },
                    { number: 6, name: 'Thunder Hooves', minSpeed: 3, maxSpeed: 5.4, position: 0, animationIndex: 1, odds: 20 },
                ],
                finishedHorses: [],
                winner: null,
                secondPlace: null,
                thirdPlace: null,
                money: 500,
                raceStarted: false,
                selectedHorse: null,
                betAmount: null, 
                timer: 0,

                startRace() {
                    this.raceStarted = true;
                    this.startTimer();
                    this.horses.forEach((horse, index) => {
                        horse.speed = this.calculateSpeed(horse.minSpeed, horse.maxSpeed);
    
                        horse.intervalId = setInterval(() => {
                            this.moveHorse(index);
                        }, 10 + Math.random() * 10);
    
                        horse.animationIntervalId = setInterval(() => {
                            horse.animationIndex = (horse.animationIndex % 12) + 1;
                        }, 50);
    
                        horse.speedIntervalId = setInterval(() => {
                            horse.speed = this.calculateSpeed(horse.minSpeed, horse.maxSpeed);
                        }, 1000);
                    });
                },

                restartRace() {
                    this.raceStarted = false;
                    this.horses.forEach((horse, index) => {
                        horse.position = 0;
                        clearInterval(horse.intervalId);
                        clearInterval(horse.animationIntervalId);
                        clearInterval(horse.speedIntervalId);
                    });
                    this.finishedHorses = [];
                    this.winner = null;
                    this.secondPlace = null;
                    this.thirdPlace = null;
                    this.bets = {};
                    this.betAmount = null;
                    this.timer = 0;
                },
    
                moveHorse(horseIndex) {
                    const horse = this.horses[horseIndex];
                    horse.position += horse.speed;
                    if (horse.position >= 1400) {
                        this.finished(horseIndex);
                    }
                },
    
                calculateSpeed(minSpeed, maxSpeed) {
                    return Math.floor(Math.random() * (maxSpeed - minSpeed + 1)) + minSpeed;
                },
    
                getHorseSprite(horse) {
                    const imageName = `Horse ${horse.number}-${horse.animationIndex.toString().padStart(2, '0')}`;
                    return `/images/horses/${imageName}.png`;
                },

                getHorsePortrait(horse) {
                    const imageName = `Horse Character ${horse.number}-1`;
                    return `/images/horse-portrait/${imageName}.png`;
                },

                startTimer() {
                    if (!this.intervalId) {
                    this.intervalId = setInterval(() => {
                        this.timer += 0.01;
                    }, 10);
                    }
                },

                stopTimer() {
                    if (this.intervalId) {
                    clearInterval(this.intervalId);
                    this.intervalId = null;
                    }
                },

                placeBet(horse) {
                    if (!this.bets) {
                        this.bets = {};
                    }

                    if (this.bets[horse.number]) {
                        this.money += this.bets[horse.number];
                    }

                    if (this.money < this.betAmount) {
                        alert("You don't have enough money to place this bet!");
                        return;
                    }

                    this.money -= this.betAmount;
                    this.bets[horse.number] = this.bets[horse.number] ? this.bets[horse.number] + this.betAmount : this.betAmount;

                    this.payOut();
                },

                payOut() {
                    if (this.selectedHorse && this.selectedHorse === this.winner) {
                        const payout = this.betAmount * this.horses[this.selectedHorse].odds;
                        this.money += payout;
                        alert(`Congratulations, you have won ${payout} coins!`);
                    }
                },
    
                finished(horseIndex) {
                    const horse = this.horses[horseIndex];
                    clearInterval(horse.intervalId);
                    clearInterval(horse.animationIntervalId);
                    clearInterval(horse.speedIntervalId);
                    this.finishedHorses.push(horse);

                    if (this.finishedHorses.length > 0) {
                        this.winner = this.finishedHorses[0];
                        this.payOut();
                        this.stopTimer();
                    } 
                    if (this.finishedHorses.length > 1) {
                        this.secondPlace = this.finishedHorses[1];
                    }
                    if (this.finishedHorses.length > 2) {
                        this.thirdPlace = this.finishedHorses[2];
                    } 
                },
            }));
        });
    </script>
    
</x-fullscreen-layout>