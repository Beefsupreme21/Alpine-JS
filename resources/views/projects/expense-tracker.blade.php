<x-layout>
    <div>
        Expense Tracker
    </div>
    <div x-data="tracker">
        <div class="p-4 bg-gray-200 rounded-lg shadow-md">
            <input type="text" class="w-full border py-2 px-3 mb-4" x-model="amount" placeholder="$Amount">
            <select name="category" class="w-full border py-2 px-3 mb-4" x-model="category">
                <option value="">Please choose an option</option>
                <option value="rent">Rent</option>
                <option value="utilities">Utilities</option>
                <option value="food">Food</option>
                <option value="entertainment">Entertainment</option>
                <option value="misc">Misc</option>
            </select>
            <div class="flex mb-4">
                <input type="radio" x-bind:value="'positive'" x-model="expense_type" class="mr-2" checked>
                <label class="text-gray-700">Positive</label>
                <input type="radio" x-bind:value="'negative'" x-model="expense_type" class="ml-4 mr-2">
                <label class="text-gray-700">Negative</label>
            </div>
            <button type="submit" class="bg-gray-800 text-white py-2 px-4 rounded" x-on:click="addToDo">Add</button>
        </div>
        <table class="table-auto w-full text-left bg-white shadow-md">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-4 py-2">Amount</th>
                    <th class="px-4 py-2">Category</th>
                    <th class="px-4 py-2">Type</th>
                </tr>
            </thead>
            <tbody>
                <template x-for="expense in expenses">
                    <tr class="text-gray-700">
                        <td class="border px-4 py-2">
                            <span :class="{ 'text-green': expense.expense_type == 'positive', 'text-red': expense.expense_type == 'negative' }" x-text="expense.amount"></span>
                        </td>
                        <td class="border px-4 py-2">
                            <span x-text="expense.category"></span>
                        </td>
                        <td class="border px-4 py-2">
                            <span x-text="expense.expense_type"></span>
                        </td>
                        <td class="border px-4 py-2">
                            <button x-on:click="removeExpense(expense)">Delete</button>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
        <ul>
            <template x-for="expense in expenses">
                <li>
                    <input type="checkbox" x-model="expense.completed">
                    <span :class="{ 'text-green': expense.expense_type == 'positive', 'text-red': expense.expense_type == 'negative' }" x-text="expense.amount"></span>
                    <span x-text="expense.category"></span>
                    <span x-text="expense.expense_type"></span>
                    <button x-on:click="removeExpense(expense)">Delete</button>
                </li>
            </template>
        </ul>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('tracker', () => ({
                expenses: [], 
                category: '',
                amount: '',
                expense_type: '',

                addToDo() {
                    let id = this.expenses.length + 1;
                    this.expenses.push({
                        id: id,
                        amount: this.amount,
                        category: this.category,
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
