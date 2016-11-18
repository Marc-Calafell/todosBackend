
<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Example Component</div>
                        <div id="app" xmlns:v-on="http://www.w3.org/1999/xhtml">
                        <div class="panel-body">

                            <p v-show="seen">@{{message}}</p>
                            <input type="text" v-model="message">
                            <button v-on:click="reverseMessage">Reverse</button>
                            <ol>
                                <li v-for="todo in todos">@{{todo.name}} | @{{todo.done}} | @{{todo.priority}}</li>
                            </ol>
                        </div><script src="js/app.js"></script>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>