<x-fullscreen-layout>
    <div x-data="game" class="px-16 border border-red-500">
        <template x-for="(horse, index) in horses">
          <img x-bind:src="getHorseImageUrl(horse)" class="h-16 w-16" />
        </template>
        <button x-on:click="startRace()">Start</button>
      </div>
      
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('game', () => ({
                horses: [
                    { number: 1, color: 'red', speed: 20, position: 0, animationIndex: 1 },
                    { number: 2, color: 'blue', speed: 30, position: 0, animationIndex: 1 },
                    { number: 3, color: 'green', speed: 35, position: 0, animationIndex: 1 },
                ],
        

        
                startRace() {
                    this.horses.forEach((horse, index) => {
                        horse.intervalId = setInterval(() => {
                            horse.position += horse.speed;
                            horse.animationIndex = (horse.animationIndex % 12) + 1;
                            this.finished(index);
                            console.log(`Horse ${horse.number} position: ${horse.position}`);
                        }, 100);
                    });
                },
        
                getHorseImageUrl(horse) {
                    const imageName = `Horse ${horse.number}-${horse.animationIndex.toString().padStart(2, '0')}`;
                    return `/images/horses/${imageName}.png`;
                },

                finished(horseIndex) {
                    const horse = this.horses[horseIndex];
                    console.log(`Horse ${horse.number} position: ${horse.position}`);
                    if (horse.position >= 1000) {
                        clearInterval(horse.intervalId);
                    }
                },

            }));
        });
    </script>
      
      
    
      
</x-fullscreen-layout>