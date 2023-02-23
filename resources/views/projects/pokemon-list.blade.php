<x-layout>
    <div x-data="pokemon" x-init="fetchPokemon()">
        <ul class="divide-y divide-gray-300 p-4">
            <template x-for="pokemon in pokemons" :key="pokemon.name">
                <li class="py-4">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-medium text-white">
                            <span class="mr-2" x-text="pokemon.id"></span>
                            <span class="capitalize" x-text="pokemon.name"></span>
                        </h2>                          
                        <div class="flex w-40">
                            <template x-for="type in pokemon.types" :key="type.type.name">
                                <span class="inline-flex items-center px-2.5 py-0.5 mx-1 rounded-full text-sm font-medium capitalize" 
                                    x-bind:class="getTextColor(type.type.name)"
                                    x-text="type.type.name">
                                </span>
                            </template>
                        </div>
                    </div>
                </li>
            </template>
        </ul>
    </div>
      
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('pokemon', () => ({
                pokemons: null,
                randomType: null,
                selectedPokemon: [],

                fetchPokemon() {
                    axios.get('https://pokeapi.co/api/v2/pokemon?limit=150')
                        .then(response => {
                            this.pokemons = response.data.results;
                            Promise.all(this.pokemons.map(pokemon => axios.get(pokemon.url)))
                                .then(responses => {
                                    responses.forEach((response, i) => {
                                        this.pokemons[i].types = response.data.types;
                                        this.pokemons[i].id = response.data.id;
                                    });
                                });
                        });
                },

                getTextColor(type) {
                    switch (type) {
                        case 'normal':
                        return ['text-gray-400', 'bg-gray-200'];
                        case 'fire':
                        return ['text-white', 'bg-red-500'];
                        case 'water':
                        return ['text-white', 'bg-blue-500'];
                        case 'electric':
                        return ['text-black', 'bg-yellow-500'];
                        case 'grass':
                        return ['text-black', 'bg-green-500'];
                        case 'ice':
                        return ['text-white', 'bg-blue-200'];
                        case 'fighting':
                        return ['text-white', 'bg-red-900'];
                        case 'poison':
                        return ['text-white', 'bg-purple-500'];
                        case 'ground':
                        return ['text-white', 'bg-yellow-700'];
                        case 'flying':
                        return ['text-white', 'bg-indigo-500'];
                        case 'psychic':
                        return ['text-white', 'bg-pink-500'];
                        case 'bug':
                        return ['text-white', 'bg-green-700'];
                        case 'rock':
                        return ['text-white', 'bg-yellow-500'];
                        case 'ghost':
                        return ['text-white', 'bg-purple-700'];
                        case 'dragon':
                        return ['text-white', 'bg-purple-500'];
                        case 'dark':
                        return ['text-white', 'bg-gray-800'];
                        case 'steel':
                        return ['text-black', 'bg-gray-500'];
                        case 'fairy':
                        return ['text-black', 'bg-pink-300'];
                        default:
                        return ['text-gray-400', 'bg-gray-200'];
                    }
                },

            }))
        })
    </script>
</x-layout>
