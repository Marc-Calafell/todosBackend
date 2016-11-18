@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{'adminlte_lang::message.home'}}

@endsection



@section('main-content')

 <todos-list></todos-list>



{{--<div id="app" xmlns:v-on="http://www.w3.org/1999/xhtml">--}}
    {{--<p v-show="seen">@{{message}}</p>--}}
    {{--<input type="text" v-model="message">--}}
    {{--<button v-on:click="reverseMessage">Reverse</button>--}}
    {{--<ol>--}}
        {{--<li v-for="todo in todos">@{{todo.name}} | @{{todo.done}} | @{{todo.priority}}</li>--}}
    {{--</ol>--}}
{{--</div><script src="js/app.js"></script>--}}

@endsection