<template>

    <td>{{index + from}}</td>
    <td>
        <span v-if="!editingName[index]" @dblclick="editTodoName(index,page)">{{todo.name}}</span>
        <span v-else @keyup.enter="editTodoName(index,page)"><input v-model="todo.name" style="width: 100%; "></span>
    </td>
    <td>
        <span v-if="!editingPriority[index]" @dblclick="editTodoPriority(index,page)">{{todo.priority}}</span>
        <span v-else @keyup.enter="editTodoPriority(index,page)"><input v-model="todo.priority" size="3"></span>
    </td>
    <td>
        <span v-if="todo.done"><input type="checkbox" class="flat-red" checked></span>
        <span v-else><input type="checkbox" class="flat-red"></span>
    </td>
    <td>
        <div class="progress progress-xs">
            <div class="progress-bar progress-bar-danger" style="width: 95%"></div>
        </div>
    </td>
    <td><span class="badge bg-red">55%</span></td>
    <td><button @click="delTodo(index,todo.id)">Del</button></td>


</template>
<style>

</style>
<script>

import Pagination from './pagination.vue'

    export default {
        components : { Pagination },
        data() {
            return {
                editing: false;
        },
        computed: {

        },
        created() {

        },
        methods: {

            hello: function() {
                console.log
            },
        }
    }
</script>