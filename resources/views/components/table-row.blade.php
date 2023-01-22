<tr x-data="teamStat(user)" {{ $attributes }}>
    <td class="border px-4 py-2" x-text="user.name"></td>
    <td class="border px-4 py-2" x-text="user.number" x-bind:class="getBackgroundColor(user.number)"></td>
    <td class="border px-4 py-2" x-text="user.age"></td>
    <td class="border px-4 py-2" x-text="user.email"></td>
</tr>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('teamStat', (user) => {
            let numbers = @json($users).map(user => user.number);
            let sorted = numbers.sort((a, b) => a - b);
            let numberPercentiles = [];

            for (let i = 1; i <= 4; i++) {
                let percentileIndex = Math.floor(numbers.length * (i / 5)) - 1;
                console.log(percentileIndex);
                numberPercentiles[i - 1] = numbers[percentileIndex];
                console.log(numberPercentiles);
            }
            return {
                user: user,
                numberPercentiles: numberPercentiles,

                getBackgroundColor(number) {
                    if (number >= this.numberPercentiles[3]) {
                        return 'bg-green-500';
                    } else if (number >= this.numberPercentiles[2] && number < this.numberPercentiles[3]) {
                        return 'bg-green-400';
                    } else if (number >= this.numberPercentiles[1] && number < this.numberPercentiles[2]) {
                        return 'bg-green-300';
                    } else if (number >= this.numberPercentiles[0] && number < this.numberPercentiles[1]) {
                        return 'bg-green-200';
                    } else {
                        return 'bg-green-100';
                    }
                },
            }
        });
    });
</script>
