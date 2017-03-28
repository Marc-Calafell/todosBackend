<template>
        <tr>
            <td>{{index + from}}</td>
            <td>
                <span v-if="!editingName" @dblclick="editTodoName(page,todo.id)">
                    <span>{{todo.name}}</span>
                    <span style="float: right;">
                        <button type="button" class="btn btn-info btn-xs" @click="editTodoName(page,todo.id)"><i class="fa fa-fw fa-edit"></i></button>
                    </span>
                </span>
                <span v-else @keyup.enter="editTodoName(page,todo.id)" @keyup.esc="cancelTodoEdit(page)">
                    <input v-model="todo.name" size="80">
                    <span style="float: right;">
                        <button type="button" class="btn btn-success btn-xs" @click="editTodoName(page,todo.id)"><i class="fa fa-fw fa-check"></i></button>
                        <button type="button" class="btn btn-danger btn-xs" @click="cancelTodoEdit(page)"><i class="fa fa-fw fa-close"></i></button>
                    </span>
                </span>
            </td>
            <td>
                <span class="btn-group">
                    <button type="button" class="btn btn-default">
                        <span>{{todo.priority}}</span>
                    </button>
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li v-for="n in 10"><a href="#" @click="editTodoPriority(page,(n-1))">{{(n-1)}}</a></li>
                    </ul>
                </span>
            </td>
            <td>
                <span v-if="todo.done"><input type="checkbox" class="checkbox icheck" checked @click="editTodoDone(page,todo.done)"></span>
                <span v-else><input type="checkbox" class="checkbox icheck" @click="editTodoDone(page,todo.done)"></span>
            </td>
            <td>
                <div class="progress progress-xs">
                    <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                </div>
            </td>
            <td><span class="badge bg-red">55%</span></td>
            <td>
                <button type="button" class="btn btn-info btn-xs" @click="editTodoName(page,todo.id)"><i class="fa fa-fw fa-edit"></i></button>
                <button type="button" class="btn btn-warning btn-xs" @click="delTodo(todo.id)"><i class="fa fa-fw fa-trash"></i></button>
            </td>
        </tr>
</template>
<style>

</style>
<script>

    export default {
        props: ['todo','index','from','page','fetchPage'],
        data() {
            return {
                editingName: false,
                editingPriority: false,
            }
        },
        created() {

        },
        methods: {
            delTodo: function(id) {
                this.$emit('todo-deleted',id);
            },
            editTodoName: function(pageNum,id) {
                if (this.editingName == true) {
                    this.editTodoNameToApi();
                    this.editingName = false;
                    return this.fetchPage(pageNum);
                }
                this.editingName = true;
                return this.fetchPage(pageNum);
            },
            editTodoNameToApi: function() {
                this.$http.put('/api/v1/task/' + this.todo.id,{
                    name: this.todo.name,
                }).then((response) => {
                console.log('Name of task ' + this.todo.id + ' updated succesfully! Now is known as \"' + this.todo.name + '\".');
                }, (response) => {
                    sweetAlert("Oops...", "Something went wrong!", "error");
                    console.log(response);
                });
            },
            editTodoPriority: function(pageNum,number) {
                this.editTodoPriorityToApi(number);
                return this.fetchPage(pageNum);
            },
            editTodoPriorityToApi: function(number) {
                this.$http.put('/api/v1/task/' + this.todo.id,{
                    priority: number,
                }).then((response) => {
                console.log('Priority of task ' + this.todo.id + ' updated succesfully! Now has \"' + number + '\".');
                }, (response) => {
                    sweetAlert("Oops...", "Something went wrong!", "error");
                    console.log(response);
                });
            },
            cancelTodoEdit: function(pageNum) {
                this.editingName = false;
                this.editingPriority = false;
                return this.fetchPage(pageNum);
            },
            editTodoDone: function(pageNum,doneStatus) {
                doneStatus = this.todo.done = !this.todo.done;
                this.editTodoDoneToApi(doneStatus);
                return this.fetchPage(pageNum);
            },
            editTodoDoneToApi: function(doneStatus) {
                this.$http.put('/api/v1/task/' + this.todo.id,{
                    done: doneStatus,
                }).then((response) => {
                console.log('Done status of task ' + this.todo.id + ' updated succesfully! Now has \"' + doneStatus + '\".');
                }, (response) => {
                    sweetAlert("Oops...", "Something went wrong!", "error");
                    console.log(response);
                });
            }
        }
    }
</script>