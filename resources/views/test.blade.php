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
            <div class="flex justify-center mb-8">
              <template x-for="(horse, index) in horses">
                <div class="mx-4">
                  <img x-bind:src="getHorsePortrait(horse)" class="h-48 w-48 rounded-full" />
                  <p class="text-center font-bold mt-2 text-lg" x-text="horse.name"></p>
                  <p class="text-center mt-1" x-text="'Odds: ' + horse.odds + ':1'"></p>
                </div>
              </template>
            </div>
            <template x-if="winner">
              <div class="text-center">
                <h2 class="text-2xl font-bold mb-2" x-text="'Winner: ' + winner.name"></h2>
                <h2 class="text-lg mb-2" x-text="'Second place: ' + secondPlace.name" x-show="secondPlace"></h2>
                <h2 class="text-lg mb-2" x-text="'Third place: ' + thirdPlace.name" x-show="thirdPlace"></h2>
              </div>
            </template>
            <div class="flex justify-center">
              <button class="px-4 py-2 text-lg font-bold text-white bg-blue-500 rounded hover:bg-blue-700" x-on:click="startRace()">Start</button>
            </div>
          </div>
          
    </div>
    
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('game', () => ({
                horses: [
                    { number: 1, name: 'orange', minSpeed: 3, maxSpeed: 5, position: 0, animationIndex: 1, odds: 29 },
                    { number: 2, name: 'green', minSpeed: 3, maxSpeed: 5, position: 0, animationIndex: 1, odds: 3 },
                    { number: 3, name: 'tan', minSpeed: 3, maxSpeed: 5.2, position: 0, animationIndex: 1, odds: 5 },
                    { number: 4, name: 'white', minSpeed: 3, maxSpeed: 5, position: 0, animationIndex: 1, odds: 10 },
                    { number: 5, name: 'black', minSpeed: 3, maxSpeed: 5.2, position: 0, animationIndex: 1, odds: 15 },
                    { number: 6, name: 'red', minSpeed: 3, maxSpeed: 5.4, position: 0, animationIndex: 1, odds: 20 },
                ],
                finishedHorses: [],
                winner: null,
                secondPlace: null,
                thirdPlace: null,
                money: 500,
    
                startRace() {
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
    
                finished(horseIndex) {
                    const horse = this.horses[horseIndex];
                    clearInterval(horse.intervalId);
                    clearInterval(horse.animationIntervalId);
                    clearInterval(horse.speedIntervalId);
                    this.finishedHorses.push(horse);
    
                    if (this.finishedHorses.length === this.horses.length) {
                        this.winner = this.finishedHorses[0];
                        this.secondPlace = this.finishedHorses[1];
                        this.thirdPlace = this.finishedHorses[2];
                    }
                },
            }));
        });
    </script>
    
    
    
    
      
      
    
      
</x-fullscreen-layout>