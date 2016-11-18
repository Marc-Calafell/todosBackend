
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));

// const app = new Vue({
//     el: '#app'
// });


const app = new Vue({
    el: '#app',

    data: {
        message:'Hello',
        seen:true,
        todos: [
            {
                name: 'Learn Javascript',
                done: true,
                priority: 3
            },
            {
                name: 'Estudiar php',
                done: false,
                priority: 4
            },


            {
                name: 'comprar tabaco',
                done: true,
                priority: 8
            }
        ]
    },

    methods: {
        reverseMessage: function () {
            this.message = this.message.split('').reverse().join('');

        }
    }

});