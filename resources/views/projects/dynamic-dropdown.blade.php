<x-layout>

    <div class="w-4/5 mx-auto text-white">
        <div class="mt-10 mb-5">
            <div class="flex items-center mb-5 -ml-10">
                <img src="{{ asset('images/hashtag.png') }}" class="w-8 h-8 mr-2" alt="My Image">
                <p class="text-3xl">Dynamic Dropdown</p>
            </div>
            <ul class="list-disc pl-6">
                <li>x-model is being used to bind the value of the selectedTeamId data property to the value of the select element.</li>
                <li>When you select a different option in the select element, the value of the selectedTeamId data property will be updated to reflect the new selection.</li>
            </ul>
        </div>

        <script type="text/plain" class="language-markup max-w-[1000px]">
            <div x-data="teamSeasonInputs">
                <label>Team</label>
                <select x-model="selectedTeamId" name="team_id">
                    <option value=""></option>
                    <template x-for="team in teams">
                        <option :value="team.id" x-text="team.name"></option>
                    </template>
                </select>
                
                <template x-if="teamSeasons.length">
                    <label>Season</label>
                    <select name="season_id">
                        <template x-for="season in teamSeasons">
                            <option 
                                :value="season.id" 
                                x-text="`${season.year} ${season.name}`">
                            </option>
                        </template>                         
                    </select>
                </template>
            </div>
        </script>

        <script type="text/plain" class="language-javascript max-w-[640px]">
            document.addEventListener('alpine:init', () => {
                Alpine.data('teamSeasonInputs', () => ({
                    teams: '',
                    selectedTeamId: '',
                    selectedSeason: '',

                    get teamSeasons() {
                        if (this.selectedTeamId) {
                            const team = this.teams.find((team) => { 
                                return team.id === parseInt(this.selectedTeamId);
                            });

                            if (team.seasons.length) {
                                return team.seasons;
                            }
                        }
                        
                        return [];
                    },
                }))
            })
        </script>

    </div>
</x-layout>
