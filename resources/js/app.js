
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import router from './router/router.js';
import auth  from './auth/auth.js';
import { store } from './store/store.js';


// import moment from 'vue-moment'

Vue.filter('published',function(value){
   
    switch(value){
      case 0 :
           return 'Unpublished' 
      case 1 :
           return 'Pubslished'
      case 2 :
           return 'Draft'
    }
})

Vue.filter('ToMB',function(bytes){

  var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
  if (bytes == 0) return '0 Byte';
  var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
  return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];

})

Vue.filter('role',function(value){
  
  switch(value){
    case 1 :
         return 'Administrator' 
    case 2 :
         return 'Editor'
    case 3 :
         return 'Author'
  }

})

Vue.filter('Todate',function(value){


   var date = moment(value).format("MM-DD-YYYY")

   var now =  moment().format('MM-DD-YYYY')


  if(now > date)
  {
     return moment(value).format("MMMM DD YYYY")
  }
  
  if(now == date)
  {
      return moment(value).format("LTS")
  }

})



const moment = require('moment')



Vue.use(router);

Vue.use(auth)



Vue.use(require('vue-moment'), {
  moment
})

  /// vue componets layout
  Vue.component('top-navigation',require('./components/layout/TopNavigation.vue'));
  Vue.component('footer-layout',require('./components/layout/Footer.vue'));
  Vue.component('side-navigation',require('./components/layout/SideNavigation.vue'));
  Vue.component('app-component',require('./components/App.vue'));
  Vue.component('textarea-component', require('./components/Textarea.vue'))
  Vue.component('album-edit', require('./components/views/album/AlbumEdit.vue'))
  Vue.component('message-sidebar-component',require('./components/MessageNavigation.vue'))
  Vue.component('login-component',require('./components/auth/login.vue'))




  // 3. Create the router instance and pass the `routes` option
// You can pass in additional options here, but let's
// keep it simple for now.
// const router = new VueRouter({
//     mode: 'history',
//     routes // short for `routes: routes`
// })
  

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


 let token = window.$('meta[name="csrf-token"]').attr('content');
 window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token;
 window.axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('access_token')


// Object.defineProperties(Vue.prototype, {
//   $auth: {
//     get : () => {
//       return auth
//     }
//   }
// })



router.beforeEach((to,from,next) => {

       
          if(to.matched.some(record => record.meta.Authenticated )) {

            if ( ! Vue.auth.isAuthenticated() ){

              next( window.location = '/login')

            } else next()

          } else if( to.matched.some(record => record.meta.guest ) ){
               
              if( Vue.auth.isAuthenticated() ){
                next({
                  path : '/ph-admin'
                })
              }else next()

          }
          else next()


})


const app = new Vue({
    el: '#app',
    store : store,  
    router : router
});
