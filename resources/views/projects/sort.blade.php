<x-layout>     

    <table x-data="usersTable" class="table-auto w-full text-black bg-white">
        <thead>
            <th class="text-left px-4 py-2 w-40">
                <button x-on:click.prevent="sortBy('name')" class="w-full h-full group inline-flex">
                    Name
                    <template x-if="sortCol === 'name'">
                        <div class="ml-2">
                            <template x-if="sortAsc">
                                <x-svg.arrow-up />
                            </template>
                            <template x-if="!sortAsc">
                                <x-svg.arrow-down />
                            </template>
                        </div>
                    </template>
                </button>
            </th>
            <th class="text-left px-4 py-2 w-40">
                <button x-on:click.prevent="sortBy('year')" class="w-full h-full group inline-flex">
                    Year
                    <template x-if="sortCol === 'year'">
                        <div class="ml-2">
                            <template x-if="sortAsc">
                                <x-svg.arrow-up />
                            </template>
                            <template x-if="!sortAsc">
                                <x-svg.arrow-down />
                            </template>
                        </div>
                    </template>
                </button>
            </th>
            <th class="text-left px-4 py-2 w-40">
                <button x-on:click.prevent="sortBy('age')" class="w-full h-full group inline-flex">
                    Age
                    <template x-if="sortCol === 'age'">
                        <div class="ml-2">
                            <template x-if="sortAsc">
                                <x-svg.arrow-up />
                            </template>
                            <template x-if="!sortAsc">
                                <x-svg.arrow-down />
                            </template>
                        </div>
                    </template>
                </button>
            </th>
        </thead>
        <tbody>
            <template x-for="(user, index) in results" :key="index">
                <tr class="text-left">
                    <td class="border px-4 py-2" x-text="user.name"></td>
                    <td class="border px-4 py-2" x-text="user.year"></td>
                    <td class="border px-4 py-2" x-text="user.age"></td>                
                </tr>
            </template>
        </tbody>
    </table>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('usersTable', () => ({
                users: @json($users),
                sortCol: 'name',
                sortAsc: false,

                get results() {
                    let users = this.users;

                    if (this.sortCol !== '') {
                        users = users.sort((a, b) => {
                            if (this.sortCol === 'name') {
                                if (a.name < b.name) return this.sortAsc ? 1 : -1;
                                if (a.name > b.name) return this.sortAsc ? -1 : 1;
                                return 0;
                            }

                            if (this.sortAsc) {
                                return a[this.sortCol] - b[this.sortCol];
                            }

                            return b[this.sortCol] - a[this.sortCol];
                        });                        
                    }
                    return users;
                },

                sortBy(col) {
                    if (this.sortCol === col) {
                        this.sortAsc = !this.sortAsc;
                    } else {
                        this.sortAsc = false;
                    }
                    this.sortCol = col;
                }
            }))
        })
    </script>

</x-layout>