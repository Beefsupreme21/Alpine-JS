<x-fullscreen-layout>
    <div x-data="wordle" x-on:keyup.window="alert($event.key)">
        <div class="h-screen w-screen grid place-items-center">
            <div>
                <template x-for="row in board">
                    <div class="flex">
                        <template x-for="tile in row">
                            <div class="w-24 h-24 border border-black"></div>
                        </template>
                    </div>
                </template>
            </div>
        </div>
    </div>
      
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('wordle', () => ({
                guessesAllowed: 5, 
                wordLength: 5,

                init() {
                    this.board = Array.from({ length: this.guessesAllowed }, () => {
                        return Array.from({ length: this.wordLength }, () => 'X');
                    });
                },
    
            }));
        });
    </script>

</x-fullscreen-layout>