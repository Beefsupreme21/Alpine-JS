<x-layout>
    <div x-data="weather">

        <button x-on:click="fetchWeather()" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 rounded">Fetch Weekly Forecase</button>
        <div>
            Current Weather
            <div x-text="weather.current_weather.temperature"></div>
        </div>
        <template x-for="(day, index) in weather.daily.time" :key="index">
            <div class="mt-4 p-4 border border-gray-300">
                <div class="text-lg font-bold">
                    <span x-text="getDayOfWeek(day)"></span>
                    <span x-text="new Date(day * 1000).toLocaleDateString()"></span>
                    <img x-bind:src="getWeatherIcon(weather.daily.weathercode[index])" alt="weather icon">
                </div>
                <div class="mt-2">
                    Weather Code: <span x-text="weather.daily.weathercode[index]"></span>
                </div>
                <div class="mt-2">
                    Time: <span x-text="day"></span>
                </div>
                <div class="mt-2">
                    Temperature Max: <span x-text="weather.daily.temperature_2m_max[index]"></span>
                </div>
                <div class="mt-2">
                    Temperature Min: <span x-text="weather.daily.temperature_2m_min[index]"></span>
                </div>
                <div class="mt-2">
                    Apparent Temperature Max: <span x-text="weather.daily.apparent_temperature_max[index]"></span>
                </div>
                <div class="mt-2">
                    Apparent Temperature Min: <span x-text="weather.daily.apparent_temperature_min[index]"></span>
                </div>
                <div class="mt-2">
                    Precipitation Sum: <span x-text="weather.daily.precipitation_sum[index]"></span>
                </div>
            </div>
        </template>
    </div>
    

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('weather', () => ({
                weather: null,

                getDayOfWeek(timestamp) {
                    const daysOfWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
                    const date = new Date(timestamp * 1000);
                    return daysOfWeek[date.getUTCDay()];
                },

                fetchWeather() {
                    axios.get("https://api.open-meteo.com/v1/forecast?latitude=39.74&longitude=-104.98&hourly=temperature_2m,apparent_temperature,precipitation,weathercode,windspeed_10m&daily=weathercode,temperature_2m_max,temperature_2m_min,apparent_temperature_max,apparent_temperature_min,precipitation_sum&current_weather=true&temperature_unit=fahrenheit&windspeed_unit=mph&precipitation_unit=inch&timeformat=unixtime&timezone=America%2FDenver")
                        .then(response => {
                        this.weather = response.data;
                        });
                },

                getWeatherIcon(code) {
                    switch (code) {
                    case 0:
                        return '/images/weather-icons/sun.svg';
                    case 1:
                    case 2:
                    case 3:
                        return '/images/weather-icons/sun.svg';
                    default:
                        return 'path/to/default-icon.svg';
                    }
                },
            }))
        })
    </script>
</x-layout>