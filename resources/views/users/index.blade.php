<x-layout>     
    <table x-data="usersTable" class="table-auto w-full text-black bg-white">
        <thead>
            <tr class="text-left font-medium">
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Year</th>
                <th class="px-4 py-2">Age</th>
            </tr>
        </thead>
        <tbody>
            <template x-for="user in users">
                <tr class="text-left">
                    <td class="border px-4 py-2" x-text="user.name"></td>
                    <td class="border px-4 py-2" x-text="user.year"
                        x-bind:class="getBackgroundColor(user.year, 'year')">
                    </td>
                    <td class="border px-4 py-2" x-text="user.age"
                        x-bind:class="getBackgroundColor(user.age, 'age')">
                    </td>                
                </tr>
            </template>
        </tbody>
    </table>

    <script>
        document.addEventListener('alpine:init', () => {
            function calculatePercentiles(numbers) {
                let sorted = numbers.sort((a, b) => a - b);
                let percentiles = [];

                for (let i = 1; i <= 4; i++) {
                    let percentileIndex = Math.floor(numbers.length * (i / 5)) - 1;
                    percentiles[i - 1] = numbers[percentileIndex];
                }
                return percentiles;
            }

            let ages = @json($users).map(user => user.age);
            let agePercentiles = calculatePercentiles(ages);

            let years = @json($users).map(user => user.year);
            let yearPercentiles = calculatePercentiles(years);

            let percentiles = {
                age: agePercentiles,
                year: yearPercentiles
            };

            Alpine.data('usersTable', () => ({
                users: @json($users),

                getBackgroundColor(number, column) {
                    let columnPercentiles = percentiles[column];

                    if (number >= columnPercentiles[3]) {
                        return 'bg-green-500';
                    } else if (number >= columnPercentiles[2] && number < columnPercentiles[3]) {
                        return 'bg-green-400';
                    } else if (number >= columnPercentiles[1] && number < columnPercentiles[2]) {
                        return 'bg-green-300';
                    } else if (number >= columnPercentiles[0] && number < columnPercentiles[1]) {
                        return 'bg-green-200';
                    } else {
                        return 'bg-green-100';
                    }
                },
            }))
        });
    </script>
    
</x-layout>
