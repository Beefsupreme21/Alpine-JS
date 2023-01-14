<x-layout>     

    <table x-data="usersTable" class="table-auto w-full text-black bg-white">
        <thead>
            <tr class="text-left font-medium">
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Number</th>
                <th class="px-4 py-2">Email</th>
            </tr>
        </thead>
        <tbody>
            <template x-for="user in users">
                <tr class="text-left">
                    <td class="border px-4 py-2" x-text="user.name"></td>
                    <td class="border px-4 py-2" x-text="user.number"
                        x-bind:class="{ 
                            'bg-green-500': user.number >= numberPercentiles[3],
                            'bg-green-400': user.number >= numberPercentiles[2] && user.number < numberPercentiles[3],
                            'bg-green-300': user.number >= numberPercentiles[1] && user.number < numberPercentiles[2],
                            'bg-green-200': user.number >= numberPercentiles[0] && user.number < numberPercentiles[1],
                            'bg-green-100': user.number < numberPercentiles[0]
                        }">
                    </td>
                    <td class="border px-4 py-2" x-text="user.email"></td>
                </tr>
            </template>
        </tbody>
    </table>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('usersTable', () => {
                let users = @json($users);
                let numbers = users.map(user => user.number);

                console.log(numbers);

                let sorted = numbers.sort((a, b) => a - b);

                console.log(sorted);

                let numberPercentiles = [];

                for (let i = 1; i <= 4; i++) {
                    let percentileIndex = Math.floor(numbers.length * (i / 5)) - 1;
                    console.log(numberPercentiles);

                    numberPercentiles[i - 1] = numbers[percentileIndex];
                }

                console.log(numberPercentiles);
                
                return {
                    users: users,
                    numberPercentiles: numberPercentiles
                }
            });
        });
    </script>
    
  
</x-layout>
