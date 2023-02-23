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
    </div>
      
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('pokemon', () => ({
                pokemons: [],
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
            }))
        })
    </script>
</x-layout>
