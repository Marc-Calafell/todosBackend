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
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <todo v-for="(todo, index) in filteredTodos"
                              v-bind:todo="todo"
                              v-bind:index="index"
                              v-bind:from="from"
                              v-bind:page="page"
                              v-bind:fetchPage="fetchPage"
                              @todo-deleted="delTodo">
                        </todo>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
            <!--TODO http://www.pontikis.net/labs/bs_pagination/demo/-->
            <div class="box-footer clearfix">
                <span class="pull-left">Showing {{ from }} to {{ to }} of {{ total }} entries.</span>

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
                this.$http.get('/api/v1/task').then((response) => {
                    var todos = this.todos = response.data.data;
                    this.id = todos[index].id;
                }, (response) => {
                    // error callback
                    sweetAlert("Oops...", "Something went wrong!", "error");
                    console.log(response);
                });
                //return id;
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
                    console.log('Task with name \"' + todo.name + '\" created succesfully!');
                }, (response) => {
                    // error callback
                    sweetAlert("Oops...", "Something went wrong!", "error");
                    console.log(response);
                });
                this.fetchPage(this.page);
            },
            pageChanged: function(pageNum) {
                this.page = pageNum;
                this.fetchPage(pageNum);
            },
            delTodo: function(id) {

                function(){
                    del.delTodoFromApi(id);

                });

            },
            delTodoFromApi: function(id) {
                this.$http.delete('/api/v1/task/' + id).then((response) => {
                    console.log('Task ' + id + ' deleted succesfully!');
                }, (response) => {
                    sweetAlert("Oops...", "Something went wrong!", "error");
                    console.log(response);
                });
                this.fetchPage(this.page);
            },
        }
    }
</script>