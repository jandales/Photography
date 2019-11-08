import Vue from  'vue';
import Axios from 'axios';


export default function ( Vue ) {

  Vue.auth = { 

    setToken: (token) => {

       localStorage.setItem('access_token',token)

    },

    getToken: () => {

      return localStorage.getItem('access_token')

    },

    destroyToken: () => {

      localStorage.removeItem('access_token')

    }, 

    Login : (credentials) => {

      axios.post('/login',credentials).then(res => console.log(res.data))
      
    },

    isAuthenticated :() => {

      if( Vue.auth.getToken() )

        return true

      else

        return false

    },

    getUser : (credentials) => {     
      
      let token = window.$('meta[name="csrf-token"]').attr('content');
      axios.defaults.headers.common['X-CSRF-TOKEN'] = token;
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('access_token')
      axios.get('/api/user',credentials).then(res => {return res.data } )

    }

  }

}



Object.defineProperties(Vue.prototype, {
  $auth: {
    get : () => {
      return Vue.auth
    }
  }
})


