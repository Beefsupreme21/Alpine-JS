<x-layout>
    <div class="w-4/5 mx-auto text-white">
        <div>
            <h1 class="text-4xl font-bold my-5">x-model</h1>
            <h2 class="text-xl mt-5 mb-16"></h2>
        </div>
    
        <div class="mt-10 mb-5">
            <div class="flex items-center mb-5 -ml-10">
                <img src="{{ asset('images/hashtag.png') }}" class="w-8 h-8 mr-2" alt="My Image">
                <p class="text-3xl">x-model</p>
            </div>
            <p>x-model is a directive that allows you to bind a piece of data in your JavaScript application to an input element in the DOM, creating a two-way data binding between the two.</p>
        </div>

        <div>
            <div class="flex items-center my-5 -ml-6">
                <img src="{{ asset('images/hashtag.png') }}" class="w-4 h-4 mr-2" alt="My Image">
                <p class="text-xl">Example 1</p>
            </div>
            <ul class="list-disc pl-6">
                <li>Here x-model is being used to bind the value of the input field to the x-text message</li>
            </ul>
            <div x-data="{ message: 'Type here' }" class="flex justify-between p-4">
                <input type="text" x-model="message" class="text-black border rounded p-2" />
                <p class="mt-2" x-text="message"></p>
            </div>
            <script type="text/plain" class="language-markup max-w-[640px]">
                <div x-data="{ message: '' }" class="flex justify-between p-4">
                    <input type="text" x-model="message" class="border rounded p-2" />
                    <p class="mt-2" x-text="message"></p>
                </div>
            </script>
        </div>

        <div>
            <div class="flex items-center my-5 -ml-6">
                <img src="{{ asset('images/hashtag.png') }}" class="w-4 h-4 mr-2" alt="My Image">
                <p class="text-xl">Example 2</p>
            </div>
            <ul class="list-disc pl-6">
                <li>Here x-model is being used to bind the value of the select dropdown to the x-text message</li>
            </ul>
            <div x-data="{
                selectedTeamId: '1',
                teams: [
                  { id: 1, name: 'Team 1' },
                  { id: 2, name: 'Team 2' },
                  { id: 3, name: 'Team 3' }
                ],
                teamSeasons: [
                  { id: 1, year: 2020, name: 'Season 1' },
                  { id: 2, year: 2021, name: 'Season 2' }
                ]
              }">
                <label>Team</label>
                <div class="relative inline-block">
                  <select x-model="selectedTeamId" name="team_id" class="block appearance-none bg-white text-black border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
                    <option value=""></option>
                    <template x-for="team in teams">
                      <option :value="team.id" x-text="team.name"></option>
                    </template>
                  </select>
                  <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                  </div>
                </div>
                <p x-text="selectedTeamId"></p>

            </div>
              

            <script type="text/plain" class="language-markup max-w-[640px]">
                <div x-data="{
                        selectedTeamId: '1',
                        teams: [
                            { id: 1, name: 'Team 1' },
                            { id: 2, name: 'Team 2' },
                            { id: 3, name: 'Team 3' }
                        ],
                    }">
                    <label>Team</label>
                    <div class="flex justify-between">
                        <select x-model="selectedTeamId" name="team_id">
                            <option value=""></option>
                            <template x-for="team in teams">
                                <option :value="team.id" x-text="team.name"></option>
                            </template>
                        </select>
                        <p x-text="selectedTeamId"></p>
                    </div>
                </div>
            </script>
        </div>



    </div>
</x-layout>



