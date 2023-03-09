<x-fullscreen-layout>
    <div x-data="game" class="px-32">
        <div x-show="showBetScreen" class="container mx-auto">
            <div class="flex justify-evenly mb-8">
                <div>
                    <p class="text-2xl font-bold mb-4">Balance $<span x-text="money"></span></p>
                    <p class="text-2xl font-bold mb-4"><span x-text="resultsMessage"></span></p>
                    <p class="text-2xl font-bold mb-4">Selected Horse: <span x-text="getHorseName(selectedHorse)"></span></p>
                    <div class="flex justify-center items-center">
                        <button x-on:click="if (betAmount >= 50) { betAmount -= 50 }" class="text-gray-700 font-bold py-2 px-4 rounded-l">
                            -
                        </button>
                        <span class="font-semibold text-gray-700">
                            <span x-text="betAmount"></span>
                        </span>
                        <button x-on:click="if (betAmount < money) { betAmount += 50 }" class="text-gray-700 font-bold py-2 px-4 rounded-r">
                            +
                        </button>
                    </div>
                    <button x-on:click="placeBet(selectedHorse)" class="ml-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Place Bet</button>
                </div>
                <div class="flex justify-center">
                    <template x-for="(horse, index) in horses">
                        <div x-on:click="selectedHorse = index" 
                             x-bind:class="{ 'bg-gray-200': selectedHorse === index }" 
                             class="mx-4 cursor-pointer rounded-lg p-4 transition-colors duration-200 ease-in-out">
                            <img x-bind:src="getHorsePortrait(horse)" class="h-36 w-36 rounded-lg" />
                            <p class="text-center font-bold mt-2 text-lg" x-text="horse.name"></p>
                            <p class="text-center mt-1" x-text="'Odds: ' + horse.odds + ':1'"></p>
                        </div>
                    </template>
                </div>
            </div>
        </div>

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
            <p class="text-2xl font-bold mb-4">$<span x-text="money"></span></p>
            <p class="text-2xl font-bold mb-4">Selected Horse<span x-text="selectedHorse"></span></p>
            <p class="text-2xl font-bold mb-4">Bet $<span x-text="betAmount"></span></p>
            <p class="text-2xl font-bold mb-4">Selected Horse: <span x-text="getHorseName(selectedHorse)"></span></p>
            <img x-bind:src="getHorsePortrait(selectedHorse)" class="h-12 w-12 rounded-lg" />
              
              
            <p class="text-2xl font-bold" x-text="`${timer.toFixed(2)} sec`"></p>  
            <div class="flex justify-center">
                <template x-for="(horse, index) in sortedFinishedHorses">
                    <div>
                        <template x-if="winner == horse">
                            <div>
                                <p>1st</p>
                                <p x-text="horse.name"></p>
                                <p x-text="`${horse.time.toFixed(2)} sec`"></p>
                                <img x-bind:src="getHorsePortrait(horse)" class="h-12 w-12 rounded-lg" />
                                <p class="text-center mt-1" x-text="horse.odds + ':1'"></p>
                            </div>
                        </template>
                        <template x-if="secondPlace == horse">
                            <div>
                                <p>2nd</p>
                                <p x-text="horse.name"></p>
                                <p x-text="`${horse.time.toFixed(2)} sec`"></p>
                                <img x-bind:src="getHorsePortrait(horse)" class="h-12 w-12 rounded-lg" />
                                <p class="text-center mt-1" x-text="horse.odds + ':1'"></p>
                            </div>
                        </template>
                        <template x-if="thirdPlace == horse">
                            <div>
                                <p>3rd</p>
                                <p x-text="horse.name"></p>
                                <p x-text="`${horse.time.toFixed(2)} sec`"></p>
                                <img x-bind:src="getHorsePortrait(horse)" class="h-12 w-12 rounded-lg" />
                                <p class="text-center mt-1" x-text="horse.odds + ':1'"></p>
                            </div>
                        </template>
                    </div>
                </template>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('game', () => ({
                horses: [
                    { number: 1, name: 'Horsing Around', minSpeed: 3, maxSpeed: 5, position: 0, animationIndex: 1, odds: 29, time: null },
                    { number: 2, name: 'Sir Gallopsalot', minSpeed: 3, maxSpeed: 5, position: 0, animationIndex: 1, odds: 3, time: null },
                    { number: 3, name: 'Hoof Hearted', minSpeed: 9, maxSpeed: 9, position: 0, animationIndex: 1, odds: 5, time: null },
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
                betAmount: 50, 
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

                getHorseName(number) {
                    const horse = this.horses.find(horse => horse.number - 1 === number);
                    return horse ? horse.name : '';
                },

                getHorsePortrait(horse) {
                    const imageName = `Horse Character ${horse.number}-1`;
                    return `/images/horse-portrait/${imageName}.png`;
                },

                getHorseSprite(horse) {
                    const imageName = `Horse ${horse.number}-${horse.animationIndex.toString().padStart(2, '0')}`;
                    return `/images/horses/${imageName}.png`;
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
                    this.bets[horse.number] = (this.bets[horse.number] || 0) + this.betAmount;
                    this.money -= this.betAmount;
                    this.selectedHorse = horse;
                    this.showBetScreen = false;
                    this.showRaceScreen = true;
                    this.payOut();
                },

                payOut() {
                    if (this.selectedHorse !== null && this.winner !== null && this.horses[this.selectedHorse].number === this.winner.number) {
                        const payout = this.betAmount * this.horses[this.selectedHorse].odds;
                        this.money += payout;
                        this.resultsMessage = `Congratulations, you have won $${payout}!`;
                    }
                },
    
                finished(horseIndex) {
                    const horse = this.horses[horseIndex];
                    clearInterval(horse.intervalId);
                    clearInterval(horse.animationIntervalId);
                    clearInterval(horse.speedIntervalId);
                    this.finishedHorses.push(horse);

                    if (this.finishedHorses.length == 1) {
                        this.winner = this.finishedHorses[0];
                        this.winner.time = this.timer; // set the time property of the winner horse to the current time
                        this.payOut();
                    } 
                    if (this.finishedHorses.length > 1) {
                        this.secondPlace = this.finishedHorses[1];
                        this.secondPlace.time = this.timer; // set the time property of the second place horse to the current time
                    }
                    if (this.finishedHorses.length > 2) {
                        this.thirdPlace = this.finishedHorses[2];
                        this.thirdPlace.time = this.timer; // set the time property of the third place horse to the current time
                    } 
                    if (this.finishedHorses.length == this.horses.length) {
                        this.stopTimer();
                    } 
                },
            }));
        });
    </script>
    
</x-fullscreen-layout>