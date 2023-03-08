<x-fullscreen-layout>
    <div x-data="game" class="px-32">
        <div x-show="showRaceScreen">
            <div style="background-image: url('/images/racetracks/Background 2-1.png'); background-repeat: no-repeat; height: 50vh;">
                <div class="pt-44">
                    <template x-for="(horse, index) in horses">
                        <img x-bind:src="getHorseSprite(horse)" class="h-16 w-16 -mb-8" x-bind:style="'transform: translateX(' + (horse.position) + 'px)'"/>
                    </template>
                </div>
            </div>
            <div x-show="!raceStarted">
                <button class="px-4 py-2 text-lg font-bold text-white bg-blue-500 rounded hover:bg-blue-700" x-on:click="startRace()">Start</button>
            </div>
            <template x-if="finishedHorses.length == horses.length">
                <button class="px-4 py-2 text-lg font-bold text-white bg-blue-500 rounded hover:bg-blue-700" x-on:click="restartRace()">Race Again</button>
            </template>
            <p class="text-2xl font-bold" x-text="`${timer.toFixed(2)} sec`"></p>  
            <p class="text-2xl font-bold" x-text="message"></p>  
            <p class="text-2xl font-bold mb-4"><span x-text="resultsMessage"></span></p>

            <div>
                <template x-for="(horse, index) in sortedFinishedHorses">
                    <div>
                        <template x-if="winner == horse">
                            <div>
                                <p>1st</p>
                                <p x-text="`${horse.name}: ${horse.time.toFixed(2)} sec`"></p>
                                <img x-bind:src="getHorsePortrait(horse)" class="h-12 w-12 rounded-lg" />
                                <p class="text-center mt-1" x-text="horse.odds + ':1'"></p>
                            </div>
                        </template>
                        <template x-if="secondPlace == horse">
                            <div>
                                <p>2nd</p>
                                <p x-text="`${horse.name}: ${horse.time.toFixed(2)} sec`"></p>
                                <img x-bind:src="getHorsePortrait(horse)" class="h-12 w-12 rounded-lg" />
                                <p class="text-center mt-1" x-text="horse.odds + ':1'"></p>
                            </div>
                        </template>
                        <template x-if="thirdPlace == horse">
                            <div>
                                <p>3rd</p>
                                <p x-text="horse.name"></p>
                                <img x-bind:src="getHorsePortrait(horse)" class="h-12 w-12 rounded-lg" />
                                <p class="text-center mt-1" x-text="horse.odds + ':1'"></p>
                            </div>
                        </template>
                    </div>
                </template>
            </div>
        </div>
        <div x-show="showBetScreen" class="container mx-auto">
            <div class="flex justify-evenly mb-8">
                <div>
                    <p class="text-2xl font-bold mb-4">$<span x-text="money"></span></p>
                    <p class="text-2xl font-bold mb-4"><span x-text="resultsMessage"></span></p>
                    <div class="flex justify-center mt-4">
                        <input class="border-2 border-gray-300 p-2 rounded-lg w-32 text-center" type="number" min="0" step="10" x-model.number="betAmount" placeholder="Bet amount" x-bind:disabled="raceStarted">
                        <button class="ml-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" x-on:click="placeBet(selectedHorse)" x-bind:disabled="raceStarted">Place Bet</button>
                    </div>
                </div>
                <div class="flex justify center">
                    <template x-for="(horse, index) in horses">
                        <div class="mx-4 cursor-pointer" x-on:click="selectedHorse = index" x-bind:class="{ 'border border-blue-500': selectedHorse === index }">
                            <img x-bind:src="getHorsePortrait(horse)" class="h-36 w-36 rounded-lg" />
                            <p class="text-center font-bold mt-2 text-lg" x-text="horse.name"></p>
                            <p class="text-center mt-1" x-text="'Odds: ' + horse.odds + ':1'"></p>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('game', () => ({
                horses: [
                    { number: 1, name: 'Horsing Around', minSpeed: 3, maxSpeed: 5, position: 0, animationIndex: 1, odds: 29, time: null },
                    { number: 2, name: 'Sir Gallopsalot', minSpeed: 3, maxSpeed: 5, position: 0, animationIndex: 1, odds: 3, time: null },
                    { number: 3, name: 'Hoof Hearted', minSpeed: 7, maxSpeed: 7.2, position: 0, animationIndex: 1, odds: 5, time: null },
                    { number: 4, name: 'Fifty Shades of Hay', minSpeed: 3, maxSpeed: 5, position: 0, animationIndex: 1, odds: 10, time: null },
                    { number: 5, name: 'Neigh Sayer', minSpeed: 3, maxSpeed: 5.2, position: 0, animationIndex: 1, odds: 15, time: null },
                    { number: 6, name: 'Thunder Hooves', minSpeed: 3, maxSpeed: 5.4, position: 0, animationIndex: 1, odds: 20, time: null },
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
                bets: {},
                resultsMessage: null, 
                showBetScreen: true,
                showRaceScreen: false,

                get sortedFinishedHorses() {
                    return this.finishedHorses.slice().sort((a, b) => a.position - b.position);
                },

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
                    this.showBetScreen = false,
                    this.showRaceScreen = true,
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
                    if (this.betAmount > this.money) {
                        alert("You don't have enough money to place this bet!");
                        return;
                    }

                    this.bets[horse.number] = (this.bets[horse.number] || 0) + this.betAmount;
                    this.money -= this.betAmount;
                    this.selectedHorse = horse;

                    this.showBetScreen = false;
                    this.showRaceScreen = true;
                    this.payOut();
                },

                payOut() {
                    if (this.selectedHorse !== null && this.winner !== null && this.horses[this.selectedHorse - 1].number === this.winner.number) {
                        const payout = this.betAmount * this.horses[this.selectedHorse].odds;
                        this.money += payout;
                        this.resultsMessage = `Congratulations, you have won $${payout}!`;
                    }
                },

                finished(horseIndex) {
                    const horse = this.horses[horseIndex];
                    horse.position = 1400;
                    horse.time = this.timer.toFixed(2);
                    this.finishedHorses.push(horse);

                    clearInterval(horse.intervalId);
                    clearInterval(horse.animationIntervalId);
                    clearInterval(horse.speedIntervalId);

                    if (this.finishedHorses.length === this.horses.length) {
                        this.stopTimer();
                        this.setResults();
                    }
                },

                setResults() {
                    const sortedFinishedHorses = this.sortedFinishedHorses;

                    this.winner = sortedFinishedHorses[0];
                    this.secondPlace = sortedFinishedHorses[1];
                    this.thirdPlace = sortedFinishedHorses[2];

                    this.horses.forEach((horse) => {
                        horse.time = this.timer - (horse.position / horse.speed);
                    });

                    let message = '';
                    if (this.selectedHorse) {
                        if (this.selectedHorse === this.winner) {
                            message = 'Congratulations, you won!';
                            this.money += this.bets[this.selectedHorse.number] * this.selectedHorse.odds;
                        } else {
                            message = 'Sorry, you lost.';
                        }
                    }
                    this.resultsMessage = message;
                },
            }));
        });
    </script>
    
</x-fullscreen-layout>