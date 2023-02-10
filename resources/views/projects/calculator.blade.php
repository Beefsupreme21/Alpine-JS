<x-layout>
    <div x-data="calculator" class="w-64 bg-gray-900 rounded-lg p-4">
        <div class="flex flex-col">
            <input type="text" x-model="expression" class="bg-gray-800 text-white p-2 rounded-lg" readonly>
            <div x-text="result" class="text-white"></div>
        </div>
        <div class="grid grid-cols-4 gap-2 mt-2">
            <button x-on:click="expression += '1'; firstNumber = expression;" class="bg-gray-800 text-white p-2 rounded-lg">1</button>
            <button x-on:click="expression += '2'; firstNumber = expression;" class="bg-gray-800 text-white p-2 rounded-lg">2</button>
            <button x-on:click="expression += '3'" class="bg-gray-800 text-white p-2 rounded-lg">3</button>
            <button x-on:click="clear()" class="bg-gray-800 text-white p-2 rounded-lg">C</button>

            <button x-on:click="expression += '4'" class="bg-gray-800 text-white p-2 rounded-lg">4</button>
            <button x-on:click="expression += '5'" class="bg-gray-800 text-white p-2 rounded-lg">5</button>
            <button x-on:click="expression += '6'" class="bg-gray-800 text-white p-2 rounded-lg">6</button>
            <button x-on:click="expression += '+'; operator = '+';" class="bg-gray-800 text-white p-2 rounded-lg">+</button>

            <button x-on:click="expression += '7'" class="bg-gray-800 text-white p-2 rounded-lg">7</button>
            <button x-on:click="expression += '8'" class="bg-gray-800 text-white p-2 rounded-lg">8</button>
            <button x-on:click="expression += '9'" class="bg-gray-800 text-white p-2 rounded-lg">9</button>
            <button x-on:click="expression += '-'; operator = '-';" class="bg-gray-800 text-white p-2 rounded-lg">-</button>

            <button x-on:click="expression += '.'" class="bg-gray-800 text-white p-2 rounded-lg">.</button>
            <button x-on:click="expression += '0'" class="bg-gray-800 text-white p-2 rounded-lg">0</button>
            <button x-on:click="calculate()" class="bg-gray-800 text-white p-2 rounded-lg">=</button>
            <button x-on:click="expression += 'x'; operator = 'x';" class="bg-gray-800 text-white p-2 rounded-lg">x</button>

            <button x-on:click="expression += '/'; operator = '/';" class="bg-gray-800 text-white p-2 rounded-lg">/</button>
            <button x-on:click="backspace()" class="bg-gray-800 text-white p-2 rounded-lg"><</button>

        </div>
    </div>
    


    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('calculator', () => ({
                open: false,
                expression: '', 
                result: '',
                firstNumber: '',
                operator: '',
                secondNumber: '',
                
                backspace() {
                    this.expression = this.expression.substr(0, this.expression.length - 1)
                },

                calculate() {
                    let secondNumber = eval(this.expression.split(this.operator)[1]);
                    let firstNumber = eval(this.expression.split(this.operator)[0]);
                    
                    switch (this.operator) {
                        case "+":
                            this.result = firstNumber + secondNumber;
                            break;
                        case "-":
                            this.result = firstNumber - secondNumber;
                            break;
                        case "x":
                            this.result = firstNumber * secondNumber;
                            break;
                        case "/":
                            this.result = firstNumber / secondNumber;
                            break;
                        default:
                            this.result = "Invalid operator";
                    }
                },

                clear() {
                    this.expression = '';
                    this.result = '';
                },
            }))
        })
    </script>

</x-layout>