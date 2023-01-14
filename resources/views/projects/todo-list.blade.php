<div x-data="{ todos: [], todo: '' }">
    <form x-on:submit.prevent="todos.push({ text: todo, completed: false }); todo = ''">
      <input type="text" x-model="todo" placeholder="Add a todo">
      <button type="submit">Add</button>
    </form>
    <ul>
        <template x-for="todo in todos">
            <li :class="{ 'line-through': todo.completed }">
                <input type="checkbox" x-model="todo.completed">
                <span x-text="todo.text"></span>
              </li>
        </template>
    </ul>
</div>