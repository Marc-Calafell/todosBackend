<style xmlns:v-on="http://www.w3.org/1999/xhtml">

</style>

<template>
    <div>
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Add task</h3>
            </div>

            <form role="form" action="#">
                <div class="box-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="name" class="form-control" id="name" placeholder="Enter task name here"
                               v-model="newTodo"
                               @keyup.enter="addTodo">
                    </div>
                </div>
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
                        <li><a href="#"  v-on:click="setVisibility('all')">All</a></li>
                        <li><a href="#"  @click="setVisibility('active')">Active</a></li>
                        <li><a href="#/" @click="setVisibility('completed')">Completed</a></li>
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
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(todo, index) in filteredTodos">
                        <td>{{index + from}}</td>
                        <td>{{todo.name}}</td>
                        <td>{{todo.priority}}</td>
                        <td>{{todo.done}}</td>
                        <td>
                            <div class="progress progress-xs">
                                <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                            </div>
                        </td>
                        <td><span class="badge bg-red">95%</span></td>
                    </tr>
                    </tbody>

                </table>
            </div>

            <div class="box-footer clearfix">



                <span>mostrant tasques {{from}} - {{to}} de {{total}}</span>
            </div>
        </div>
    </div>
</template>
<script>

import pagination from './pagination.vue'

    export default {
        props: {
    // Current Page
            currentPage: {
                type: Number,
                required: true
            },


    // Visible Pages
            visiblePages: {
                type: Number,
                default: 5,
                coerce: (val) => parseInt(val),
            }
        },

        components : {pagination},
        data() {
            return {
                todos: [],
                visibility: 'all', // 'active' 'completed'
                newTodo: '',
                from : 0,
                to : 0,
                total : 0
            }
        },
        computed: {
            filteredTodos: function() {
                var filters = {
                    all: function (todos) {
                        return todos;
                    },
                    active: function (todos) {
                        return todos.filter(function (todo) {
                            return !todo.done;
                        });
                    },
                    completed: function (todos) {
                        return todos.filter(function (todo) {
                            return todo.done;
                        });
                    }
                }
                return filters[this.visibility](this.todos);
            }
        },

        lastPage () {
            if (this.totalPages) {
                   return this.totalPages
            } else {
                return this.totalItems % this.itemsPerPage === 0
                ? this.totalItems / this.itemsPerPage
                : Math.floor(this.totalItems / this.itemsPerPage) + 1
            }
        },

        paginationRange () {
              let start = this.currentPage - this.visiblePages / 2 <= 0
                            ? 1 : this.currentPage + this.visiblePages / 2 > this.lastPage
                            ? this.lowerBound(this.lastPage - this.visiblePages + 1, 1)
                            : Math.ceil(this.currentPage - this.visiblePages / 2)
              let range = []
              for (let i = 0; i < this.visiblePages && i < this.lastPage; i++) {
                range.push(start + i)
              }
              return range
            }
        },

        created() {
            console.log('Component todolist created.');
            this.fetchData();
        },
        methods: {
            addTodo: function() {
                var value = this.newTodo && this.newTodo.trim();
                if (!value) {
                    return;
                }
                this.todos.push({
                    name: value,
                    priority: 1,
                    done: false
                });
                this.newTodo = '';
            },
            setVisibility: function(visibility) {
                this.visibility = visibility;
            },
            reverseMessage: function() {
                this.message = this.message.split('').reverse().join('');
            },
            fetchData: function() {

                this.$http.get('/api/v1/task').then((response) => {
                    console.log(response);
                    this.todos = response.data.data;
                }, (response) => {

                    sweetAlert("Oops...", "Something went wrong!", "error");
                    console.log(response);
                });
            },
            fetchPage: function(page) {

                this.$http.get('/api/v1/task? page=' + page ).then((response) => {
                        console.log(response);
                        this.todos = response.data.data;
                        this.perPage = response.data.per_page;
                        this.from = response.data.from;
                        this.to = response.data.to;
                        this.total = response.data.total;
                }
            }


        }
    }
</script>