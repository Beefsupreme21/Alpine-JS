<x-layout>
    <div x-data="timer" class="px-32">
        <p class="text-2xl font-bold" x-text="`${timer.toFixed(2)} sec`"></p>  
        <button x-on:click="startTimer()">Start</button>
        <button x-on:click="logTime()">Log</button>
        <p x-text="logs.length ? `Last logged time: ${logs[logs.length-1].toFixed(2)}` : ''"></p>
        <button x-on:click="stopTimer()">Stop</button>
    </div>
    
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('timer', () => ({
                timer: 0,
                logs: [],
    
                startTimer() {
                    if (!this.intervalId) {
                        this.intervalId = setInterval(() => {
                            this.timer += 0.01;
                        }, 10);
                    }
                },
    
                logTime() {
                    this.logs.push(this.timer);
                },
    
                stopTimer() {
                    if (this.intervalId) {
                        clearInterval(this.intervalId);
                        this.intervalId = null;
                    }
                },
            }));
        });
    </script>
</x-layout>