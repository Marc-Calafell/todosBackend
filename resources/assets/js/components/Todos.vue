<style>

</style>

<template>
    <div>
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Tasques</h3>
            </div>

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Quick Example</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form">
                    <div class="box-body">
                        <div class="form-group">
                           <input type="TEXT" class="form-control" id="name" placeholder="Nom de la tasca">
                            @keyup.enter="addtodo"
                        </div>
                    </div>
                </form>
            </div>









            <div class="btn-group">
                <button type="button" class="btn btn-default">{{Visibility}}</button>
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#" v-on:click="setVisibiliti{'All'}">All</a></li>
                    <li><a href="#" @click="setVisibiliti{'Active'}">Active</a></li>
                    <li><a href="#" @click="setVisibiliti{'Completed'}">Completed</a></li>
                </ul>
            </div>


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
                    <tr v-for="(todo, index) in todos">
                        <td>{{index + 1}}</td>
                        <td>{{todo.name}}</td>
                        <td>{{todo.priority}}</td>
                        <td>{{todo.done}}</td>
                        <td>
                            <div class="progress progress-xs">
                                <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                            </div>
                        </td>
                        <td><span class="badge bg-red">55%</span></td>
                    </tr>
                    </tbody>

                </table>
            </div>
            <div class="box-footer clearfix">
                <ul class="pagination pagination-sm no-margin pull-right">
                    <li><a href="#">&laquo;</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">&raquo;</a></li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                seen: false,
                newTodo: ''
                visibility: 'all'// active completed
            }
        },
        computed:{

            filteredTodos: function(){

            var filters = {
                all: function(todos){
                    return todos;
                },

                active: function(todos){
                return todos.filter(function (todo){
                    return !todo.done;
                })
                },

                competed: function(todos){
                    return todos.filter(function (todo){
                    return todo.done;
                })

                }

            }

            return filters[this.visibility](this.todos);



            }
        },
        created() {
            console.log('Component todolist created.');
            this.fetchData();
        },
        methods: {
            newTodo: function(){
                console.log("Fuckciona");
               // console.log(this.newTodo);
               // this.todo.

            },



            reverseMessage: function() {
                this.message = this.message.split('').reverse().join('');
            },
            fetchData: function() {
                // GET /someUrl
                this.$http.get('/api/v1/task').then((response) => {
                    console.log(response);
                    this.todos = response.data.data;
                }, (response) => {
                    // error callback
                    sweetAlert("Oops...", "Something went wrong!", "error");
                    console.log(response);
                });
            }


        }
    }
</script>