<template>
    <div class="mx-auto w-96">

        <div class="mt-5">
            <form @submit.prevent="submit">
                <input type="text" name="text" v-model="form.name" />
                <button type="submit">Submit</button>
            </form>
        </div>

        <div class="mt-10" >
            <ul>
                <li  class="flex justify-between items-center" v-for="todo in todos" :key="todo.id">
                    <span @click.self="toggleTodo(todo)">{{todo.name}}   <span v-if="todo.done" class="text-green-500 font-semibold" >done</span> <span class="text-red-500 font-semibold" v-if="!todo.done">not done</span></span>
                    <Link :href="linkTo(todo)" method="delete" :data="{ todo: todo.id }" >Delete</Link>

                </li>
            </ul>
        </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'
export default {
    components: {
      Link
    },
    props: {
      todos: Array
    },
    data() {
        return {
            form: {
                name: "",
                done: 0
            }
        }
    },

    methods: {
        submit() {
            this.$inertia.post(this.route("todos.store"), this.form);
        },
        removeTodo(todo) {
            console.log(todo)

            this.$inertia.delete(this.route("todos.destroy"), todo.id)
        },
        linkTo(todo) {
            return "/todos/" + todo.id
        },
        toggleTodo(todo) {
            this.$inertia.get(`/todo/toggle/${todo.id}`);
        }
    }

}
</script>
