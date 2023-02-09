<x-layout>

    <div class="bg-gray-800 text-white" x-data="tracker">
        <div class="p-5">
            <h1 class="text-3xl font-medium">Expense Tracker</h1>
            <div class="mt-5">
                <input class="p-2 border border-gray-500 rounded-lg text-black" type="text" x-model="amount" placeholder="$Amount">
                <input class="p-2 ml-3 border border-gray-500 rounded-lg text-black" type="date" x-model="date">
                <select class="p-2 ml-3 border border-gray-500 rounded-lg text-black" name="category" x-model="category">
                    <option value="">Please choose an option</option>
                    <option value="rent">Rent</option>
                    <option value="utilities">Utilities</option>
                    <option value="food">Food</option>
                    <option value="entertainment">Entertainment</option>
                    <option value="misc">Misc</option>
                </select>
                <div class="mt-3">
                    <input type="radio" x-bind:value="'positive'" x-model="expense_type" checked> 
                    <span class="ml-2 text-gray-500">Positive</span>
                    <input class="ml-5" type="radio" x-bind:value="'negative'" x-model="expense_type"> 
                    <span class="ml-2 text-gray-500">Negative</span>
                </div>
                <button class="mt-3 p-2 border border-gray-500 rounded-lg" type="submit" x-on:click="addExpense">Add</button>
            </div>
            <table class="mt-5 w-full">
                <tbody>
                    <template x-for="expense in expenses">
                        <tr>
                            <td class="px-2 py-2">
                                <span :class="{ 'text-green-500': expense.expense_type == 'positive', 'text-red-500': expense.expense_type == 'negative' }" x-text="expense.amount"></span>
                            </td>
                            <td class="px-2 py-2">
                                <span x-text="expense.category"></span>
                            </td>
                            <td class="px-2 py-2">
                                <span x-text="expense.date"></span>
                            </td>
                            <td class="px-2 py-2">
                                <span x-text="expense.expense_type"></span>
                            </td>
                            <td class="px-2 py-2">
                                <button x-on:click="removeExpense(expense)">Delete</button>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
      </div>
    

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('tracker', () => ({
                expenses: [], 
                amount: '',
                category: '',
                date: '',
                expense_type: '',

                addExpense() {
                    let id = this.expenses.length + 1;
                    this.expenses.push({
                        id: id,
                        amount: this.amount,
                        category: this.category,
                        date: this.date,
                        expense_type: this.expense_type,
                        completed: false
                    });

                    this.amount = "";
                },

                removeExpense(expenseToRemove) {
                    this.expenses = this.expenses.filter(expense => expense.id  !== expenseToRemove.id);
                },
            }))
        })
    </script>

</x-layout>
