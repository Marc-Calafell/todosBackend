<template>
    <div>
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Add task</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="#">
                <div class="box-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="name" class="form-control" id="name" placeholder="Enter task name here"
                               v-model="newTodo"
                               @keyup.enter="addTodo">
                    </div>
                </div>
                <!-- /.box-body -->
            </form>
        </div>

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Tasques</h3>
                <div class="btn-group">
                    <button type="button" class="btn btn-default">{{visibility}}</button>
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#" @click="setVisibility('all')">All</a></li>
                        <li><a href="#" @click="setVisibility('active')">Active</a></li>
                        <li><a href="#" @click="setVisibility('completed')">Completed</a></li>
                    </ul>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Task</th>
                        <th>Priority</th>
                        <th>Done</th>
                        <th>Progress</th>
                        <th style="width: 40px">Label</th>
                        <th style="width: 45px">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(todo, index) in filteredTodos">
                        <todo> </todo>
                        <!--<td>{{index + from}}</td>-->
                        <!--<td>-->
                            <!--<span v-if="!editingName[index]" @dblclick="editTodoName(index,page)">{{todo.name}}</span>-->
                            <!--<span v-else @keyup.enter="editTodoName(index,page)"><input v-model="todo.name" style="width: 100%; "></span>-->
                        <!--</td>-->
                        <!--<td>-->
                            <!--<span v-if="!editingPriority[index]" @dblclick="editTodoPriority(index,page)">{{todo.priority}}</span>-->
                            <!--<span v-else @keyup.enter="editTodoPriority(index,page)"><input v-model="todo.priority" size="3"></span>-->
                        <!--</td>-->
                        <!--<td>-->
                            <!--<span v-if="todo.done"><input type="checkbox" class="flat-red" checked></span>-->
                            <!--<span v-else><input type="checkbox" class="flat-red"></span>-->
                        <!--</td>-->
                        <!--<td>-->
                            <!--<div class="progress progress-xs">-->
                                <!--<div class="progress-bar progress-bar-danger" style="width: 95%"></div>-->
                            <!--</div>-->
                        <!--</td>-->
                        <!--<td><span class="badge bg-red">55%</span></td>-->
                        <!--<td><button @click="delTodo(index,todo.id)">Del</button></td>-->
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="box-footer clearfix">
                <span class="pull-left">Mostrant todos entre {{ from }} i {{ to }} d'un total de {{ total }} </span>


                <pagination :current-page="page"
                            :items-per-page="perPage"
                            :total-items="total"
                            @page-changed="pageChanged"></pagination>
            </div>
        </div>
    </div>

</template>
<style>

</style>
<script>

import Pagination from './pagination.vue'
import Todo from './Todo.vue'
    export default {
        components : { Pagination, Todo },
        data() {
            return {
                todos: [],
                visibility: 'all', // 'active', 'completed'
                newTodo: '',
                from: 0,
                to: 0,
                total: 0,
                perPage: 0,
                page: 1,
                editingName: [
                    false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,
                ],
                editingPriority: [
                    false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,
                ],
                id: 0,
            }
        },
        computed: {
            filteredTodos: function() {

                var filters = {
                    all: function(todos) {
                        return todos;
                    },
                    active: function(todos) {
                        return todos.filter(function(todo) {
                            return !todo.done;
                        });
                    },
                    completed: function(todos) {
                        return todos.filter(function(todo) {
                            return todo.done;
                        });
                    },
                };

                return filters[this.visibility](this.todos);
            }
        },
        created() {
            this.fetchData();
        },
        methods: {
            getTodoID: function(index) {
                this.index = index;
                this.$http.get('/api/v1/task').then((response) => {
                    var todos = this.todos = response.data.data;
                    this.id = todos[index].id;
                }, (response) => {
                    // error callback
                    sweetAlert("Oops...", "Something went wrong!", "error");
                    console.log(response);
                });

            },
            reverseMessage: function() {
                this.message = this.message.split('').reverse().join('');
            },
            fetchData: function() {
                return this.fetchPage(1);
            },
            fetchPage: function(page) {
                // GET /someUrl
                this.$http.get('/api/v1/task?page=' + page).then((response) => {
                    this.todos = response.data.data;
                    this.to = response.data.to;
                    this.from = response.data.from;
                    this.total = response.data.total;
                    this.perPage = response.data.per_page;
                }, (response) => {
                    // error callback
                    sweetAlert("Oops...", "Something went wrong!", "error");
                    console.log(response);
                });
            },
            setVisibility: function(visibility) {
                this.visibility = visibility;
            },
            addTodo: function() {
                var value = this.newTodo && this.newTodo.trim();
                if (!value) {
                    return;
                }
                var todo = {
                    name: value,
                    priority: 1,
                    done: false,
                    user_id: 1,
                }
                this.todos.push(todo);
                this.addTodoToApi(todo);
                this.newTodo = '';
            },
            addTodoToApi: function(todo) {
                this.$http.post('/api/v1/task', {
                    name: todo.name,
                    priority: todo.priority,
                    done: todo.done,
                    user_id: todo.user_id,
                }).then((response) => {
                    console.log(response);
                }, (response) => {
                    // error callback
                    sweetAlert("Oops...", "Something went wrong!", "error");
                    console.log(response);
                });
                this.fetchPage(this.page);
            },
            delTodo: function(index,id) {
                var del = this;
                swal({
                  title: "Are you sure?",
                  text: "You will not be able to recover this task!",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText: "Yes, delete it!",
                  closeOnConfirm: false
                },
                function(){
                    swal("Deleted!", "Your task has been deleted.", "success");
                    //this.delTodoFromApi(id);
                    del.todos.splice(index, 1);
                    //this.fetchPage(page);

                });

            },
            delTodoFromApi: function(id) {
                this.$http.delete('/api/v1/task/' + id).then((response) => {
                    console.log(response);
                }, (response) => {
                    // error callback
                    sweetAlert("Oops...", "Something went wrong!", "error");
                    console.log(response);
                });
            },
            pageChanged: function(pageNum) {
                this.page = pageNum;
                this.fetchPage(pageNum);
            },
            editTodoName: function(index,pageNum) {
                if (this.editingName[index] == true) {
                    this.editingName[index] = false;
                    return this.fetchPage(pageNum);
                }
                this.editingName[index] = true;
                return this.fetchPage(pageNum);
            },
            editTodoPriority: function(index,pageNum) {
                if (this.editingPriority[index] == true) {
                    this.editingPriority[index] = false;
                    return this.fetchPage(pageNum);
                }
                this.editingPriority[index] = true;
                return this.fetchPage(pageNum);
            },
        }
    }
</script>