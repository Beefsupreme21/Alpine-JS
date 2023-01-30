<x-layout>
    <div x-data="todolist">
        <div>
            <input type="text" x-model="newTodo" placeholder="Add a todo">
            <button type="submit" x-on:click="addToDo">Add</button>
        </div>
        <ul>
            <template x-for="todo in todos">
                <li :class="{ 'line-through': todo.completed }">
                    <input type="checkbox" x-model="todo.completed">
                    <span x-text="todo.text"></span>
                    <button x-on:click="removeTodo(todo)">Delete</button>
                </li>
            </template>
        </ul>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('todolist', () => ({
                todos: [], 
                newTodo: '',

                addToDo() {
                    this.todos.push({
                        text: this.newTodo,
                        completed: false
                    });

                    this.newTodo = "";
                },

                removeTodo(todoToRemove) {
                    this.todos = this.todos.filter(todo => todo.text !== todoToRemove.text);
                },
            }))
        })
    </script>
</x-layout>

