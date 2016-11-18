@extends('adminlte::layouts.app')

<div id="app">
    <p v-show="seen">@{{message}}</p>
    <input type="text" v-model="message">
    <button v-on:click="reverseMessage">Reverse</button>
    <ol>
        <li v-for="todo in todos">@{{todo.name}} | @{{todo.done}} | @{{todo.priority}}</li>
    </ol>
</div><script src="js/app.js"></script>

