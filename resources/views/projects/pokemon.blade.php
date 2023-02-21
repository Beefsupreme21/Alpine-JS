<x-layout>
    <div x-data="pokemon" x-init="fetchPokemon()">
        <button x-on:click="getRandomPokemon()" class="px-4 py-2 bg-gray-700 text-white rounded-md">Get Random Pokemon</button>
        <p x-text="'Selected type: ' + randomType" class="mt-4 font-medium text-gray-800"></p>
        <div x-show="selectedPokemon" class="mt-4">
            <template x-for="pokemon in selectedPokemon" :key="pokemon.name">
                <div class="flex items-center py-2">
                    <div class="text-gray-800">
                        <div class="font-medium" x-text="pokemon.name"></div>
                        <div x-text="pokemon.types.map(type => type.type.name).join(', ')" class="text-sm"></div>
                    </div>
                </div>
            </template>
        </div>
        
        <ul class="divide-y divide-gray-300 p-4">
            <template x-for="pokemon in pokemons" :key="pokemon.name">
                <li class="py-4">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-medium capitalize text-white">
                            <span x-text="pokemon.name"></span>
                        </h2>
                        <div class="flex">
                            <template x-for="type in pokemon.types" :key="type.type.name">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium capitalize bg-gray-200" 
                                    x-bind:class='getTextColor(type.type.name)'
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

                async getRandomPokemon() {
                    const types = this.pokemons.flatMap(pokemon => pokemon.types.map(type => type.type.name));
                    const randomTypeIndex = Math.floor(Math.random() * types.length);
                    const randomType = types[randomTypeIndex];
                    this.randomType = randomType;
                    const typePokemon = this.pokemons.filter(pokemon => pokemon.types.some(type => type.type.name === randomType));
                    const randomTypePokemon = typePokemon[Math.floor(Math.random() * typePokemon.length)];
                    const nonTypePokemon = this.pokemons.filter(pokemon => pokemon.types.every(type => type.type.name !== randomType));
                    const randomNonTypePokemon1 = nonTypePokemon[Math.floor(Math.random() * nonTypePokemon.length)];
                    const randomNonTypePokemon2 = nonTypePokemon[Math.floor(Math.random() * nonTypePokemon.length)];
                    const randomNonTypePokemon3 = nonTypePokemon[Math.floor(Math.random() * nonTypePokemon.length)];
                    this.selectedPokemon = [randomTypePokemon, randomNonTypePokemon1, randomNonTypePokemon2, randomNonTypePokemon3];
                },

                fetchPokemon() {
                    axios.get('https://pokeapi.co/api/v2/pokemon?limit=150')
                        .then(response => {
                            this.pokemons = response.data.results;
                            Promise.all(this.pokemons.map(pokemon => axios.get(pokemon.url)))
                                .then(responses => {
                                    responses.forEach((response, i) => {
                                        this.pokemons[i].types = response.data.types;
                                    });
                                });
                        });
                },

                getTextColor(type) {
                    switch (type) {
                        case 'normal':
                        return 'text-gray-400';
                        case 'fire':
                        return 'text-red-500';
                        case 'water':
                        return 'text-blue-500';
                        case 'electric':
                        return 'text-yellow-500';
                        case 'grass':
                        return 'text-green-500';
                        case 'ice':
                        return 'text-blue-200';
                        case 'fighting':
                        return 'text-red-700';
                        case 'poison':
                        return 'text-purple-500';
                        case 'ground':
                        return 'text-yellow-700';
                        case 'flying':
                        return 'text-indigo-500';
                        case 'psychic':
                        return 'text-pink-500';
                        case 'bug':
                        return 'text-green-700';
                        case 'rock':
                        return 'text-yellow-500';
                        case 'ghost':
                        return 'text-purple-700';
                        case 'dragon':
                        return 'text-purple-500';
                        case 'dark':
                        return 'text-gray-800';
                        case 'steel':
                        return 'text-gray-500';
                        case 'fairy':
                        return 'text-pink-300';
                        default:
                        return 'text-gray-400';
                    }
                },
            }))
        })
    </script>
</x-layout>
