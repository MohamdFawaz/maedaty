
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
//
// const app = new Vue({
//     el: '#app'
// });

import Echo from "laravel-echo"

window.io = require('socket.io-client');

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001'
});

window.Echo.join(`online`)
    .here((users) => {
        let userId = $('meta[name=user-id]').attr('content');
        users.forEach(function(user){
            if(user.id != userId){
                $('#online-users').append(`<li class="list-group-item" id="online-user-${user.id}">${user.first_name}</li>`);
            }

            console.log(user.first_name);
        })//end of function
        console.log(users);
    })
    .joining((user) => {
        $('#online-users').append(`<li class="list-group-item" id="online-user-${user.id}">${user.first_name}</li>`);
    })
    .leaving((user) => {
        $('#online-user-' + user.id).remove();
    });
    $('#chat-text').keypress(function(e){
      if(e.which == 13){
          e.preventDefault();
          let body = $(this).val();
          let url = $(this).data('url');
          $('#chat').append(`<div class="mt-4 w-50 text-white p-3 rounded float-right bg-primary">
                        <p>${body}</p>
                    </div>
                    <div class="clearfix"></div>`);
          let data = {
              '_token': $('meta[name=csrf-token]').attr('content'),
              'body' : body,
              'user_id': $('meta[name=user-id]').attr('content')
          }
          console.log(data);
          $.ajax({
              url: url,
              method: 'POST',
              data: data,
              success: function () {
                  
              }

          })
      }
    })

window.Echo.channel('chat-group')

    .listen('MessageDelivered', (e) => {
        $('#chat').append(`<div class="mt-4 w-50 text-white p-3 rounded float-left bg-warning">
                        <p>${e.message.body}</p>
                    </div>
                    <div class="clearfix"></div>`)

    });

