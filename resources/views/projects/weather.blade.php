<x-layout>
    <div x-data="weather" x-init="fetchWeather()">
        <div class="flex mx-auto w-max py-6">
            <div class="flex border-r border-gray-600 pr-4 items-center">
                <img x-bind:src="getWeatherIcon(weather.current_weather.weathercode)" alt="weather icon" class="w-32">
                <div class="text-4xl pl-4" x-text="Math.round(weather.current_weather.temperature)"></div>
                <span class="text-2xl">&deg;</span>
            </div>
            <div class="px-4">
                <div class="temperature">
                    <p class="label">HIGH</p>
                    <span class="text-2xl" x-text="Math.round(weather.daily.temperature_2m_max[0])"></span>
                    <span class="text-2xl -ml-1">&deg;</span>
                    <p class="label">LOW</p>
                    <span class="text-2xl" x-text="Math.round(weather.daily.temperature_2m_min[0])"></span>
                    <span class="text-2xl -ml-1">&deg;</span>
                </div>
            </div>
            <div class="px-4">
                <div class="temperature">
                    <p class="label">FL HIGH</p>
                    <span class="text-2xl" x-text="Math.round(weather.daily.apparent_temperature_max[0])"></span>
                    <span class="text-2xl -ml-1">&deg;</span>
                    <p class="label">FL LOW</p>
                    <span class="text-2xl" x-text="Math.round(weather.daily.apparent_temperature_min[0])"></span>
                    <span class="text-2xl -ml-1">&deg;</span>
                </div>
            </div>      
            <div class="px-4">
                <div>
                    <p class="label">Wind</p>
                    <span class="text-2xl" x-text="weather.current_weather.windspeed"></span>
                    <span class="-ml-1">mph</span>
                </div>
                <div>
                    <p class="label">Precip</p>
                    <span class="text-2xl" x-text="weather.daily.precipitation_sum[0]"></span>
                    <span class="-ml-1">in</span>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-7 mb-5">
            <template x-for="(day, index) in weather.daily.time" :key="index">
                <div x-on:click="selectedDay = day" class="p-4 border border-gray-600 rounded-lg shadow-lg flex flex-col justify-between cursor-pointer hover:bg-gray-800">
                    <div class="flex items-center h-full">
                        <img :src="getWeatherIcon(weather.daily.weathercode[index])" alt="weather icon" class="w-32">
                    </div>
                    <div class="text-center">
                        <div x-text="getDayOfWeek(day)"></div>
                        <span class="text-2xl" x-text="Math.round(weather.daily.temperature_2m_max[index])"></span>
                        <span class="text-2xl">&deg;</span>
                    </div>
                </div>
            </template>
        </div>
        <div x-show="selectedDay">
            <template x-for="(hour, hourIndex) in weather.hourly.time" :key="hourIndex">
                <template x-if="isWithinDay(hour, selectedDay)">
                    <div x-bind:class="hourIndex % 2 === 0 ? 'bg-gray-700' : 'bg-gray-800'" class="grid grid-cols-6 justify-items-center justify-between p-1 items-center text-center">
                        <div>
                            <div x-text="getDayOfWeek(selectedDay).toUpperCase()" class="text-sm font-bold"></div>
                            <div x-text="new Date(hour * 1000).toLocaleTimeString([], { hour: 'numeric' })" class="text-lg"></div>
                        </div>
                        <img x-bind:src="getWeatherIcon(weather.hourly.weathercode[hourIndex])" alt="weather icon" class="w-8">
                        <div>
                            <div class="text-sm font-bold">TEMP</div>
                            <div>
                                <span x-text="Math.round(weather.hourly.temperature_2m[hourIndex])"></span>
                                <span class="-ml-1">&deg;</span>
                            </div>
                        </div>
                        <div>
                            <div class="text-sm font-bold">FL TEMP</div>
                            <span x-text="Math.round(weather.hourly.temperature_2m[hourIndex])"></span>
                            <span class="-ml-1">&deg;</span>
                        </div>
                        <div>
                            <div class="text-sm font-bold">WIND</div>
                            <span x-text="weather.hourly.windspeed_10m[hourIndex]"></span>
                            <span class="-ml-1">mph</span>
                        </div>
                        <div>
                            <div class="text-sm font-bold">PRECIP</div>
                            <span x-text="weather.hourly.precipitation[hourIndex]"></span>
                            <span class="-ml-1">in</span>
                        </div>
                    </div>
                </template>
            </template>
        </div>
    </div>
      
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('weather', () => ({
                weather: null,
                selectedDay: null,

                getDayOfWeek(timestamp) {
                    const daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                    const date = new Date(timestamp * 1000);
                    return daysOfWeek[date.getUTCDay()];
                },

                fetchWeather() {
                    axios.get("https://api.open-meteo.com/v1/forecast?latitude=39.74&longitude=-104.98&hourly=temperature_2m,apparent_temperature,precipitation,weathercode,windspeed_10m&daily=weathercode,temperature_2m_max,temperature_2m_min,apparent_temperature_max,apparent_temperature_min,precipitation_sum&current_weather=true&temperature_unit=fahrenheit&windspeed_unit=mph&precipitation_unit=inch&timeformat=unixtime&timezone=America%2FDenver")
                        .then(response => {
                            this.weather = response.data;
                        });
                },

                isWithinDay(timestamp, day) {
                    const selectedDate = new Date(day * 1000);
                    const date = new Date(timestamp * 1000);
                    return (
                        date.getFullYear() === selectedDate.getFullYear() &&
                        date.getMonth() === selectedDate.getMonth() &&
                        date.getDate() === selectedDate.getDate()
                    );
                },

                getWeatherIcon(code) {
                    if (code === 0 || code === 1) {
                        return '/images/weather-icons/sun.svg';
                    } else if (code === 2) {
                        return '/images/weather-icons/cloud-sun.svg';
                    } else if (code === 3) {
                        return '/images/weather-icons/cloud.svg';
                    } else if (code === 45 || code === 48) {
                        return '/images/weather-icons/smog.svg';
                    } else if (code >= 51 && code <= 67 || code === 80 || code === 81 || code === 82) {
                        return '/images/weather-icons/cloud-showers-heavy.svg';
                    } else if (code === 71 || code === 73 || code === 75 || code === 77 || code === 85 || code === 86) {
                        return '/images/weather-icons/snowflake.svg';
                    } else if (code === 95 || code === 96 || code === 99) {
                        return '/images/weather-icons/cloud-bolt.svg';
                    } else {
                        return 'path/to/default-icon.svg';
                    }
                },
            }))
        })
    </script>
</x-layout>