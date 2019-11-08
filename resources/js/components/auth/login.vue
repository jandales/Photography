<template>
    <div class="row">
    <div class="col-lg-4 col-md-8  col-sm-12" style="margin:50px auto">
      <div style="margin-bottom: 50px">
        <h2 class="text-center">Campany Name</h2>
      </div>
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Login</h4>
          <p class="card-category">Enter your credentials</p>
        </div>
        <div class="card-body">

          <form  @submit.prevent="Login" v-if="!isLoading"> 
            <div class="row">
              <div class="col-md-12">
                <div v-if="errors" class="alert alert-danger">
                  {{ errors }}
                </div>
                <div class="form-group">
                  <label class="bmd-label-floating">Username / Email</label>
                  <input type="text"  class="form-control" v-model="credintials.email"> 
                
                  <span class="invalid-feedback" role="alert">
                      <strong></strong>
                  </span>
             
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="bmd-label-floating">Password</label>
                  <input type="text" class="form-control" name="password" required v-model="credintials.password">
                 
                  <span class="invalid-feedback" role="alert">
                      <strong></strong>
                  </span>
            
                </div>
              </div>
            </div>
         
           <div class="form-check">
                        <label class="form-check-label">
                          <input class="form-check-input" type="checkbox" name="remember" id="remember">
                          <span class="form-check-sign">
                            <span class="check"></span>
                          </span>
                          Remember Me
                        </label>
             </div>
             <a href="">Forgot your password?</a>
            <button type="submit" class="btn btn-primary pull-right">login</button>
            <div class="clearfix"></div>

          </form>

           <div v-else class="spinner">
             <div  class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div> 
           </div> 
        
        </div>
      </div>
    </div>

  </div>
</template>
<script>
export default {

   data(){
       return {
        
           credintials :{
              email: '',
              password : ''
           },
           errors : '',

           registerUser :{
             username : 'JessAndales02',
             email : 'jesusandales02@example.com',
             password : 'secret'
           },

           isLoading : false
       }

   },
   methods : {

       Login () {

         var _this = this

         _this.errors = ''

         _this.isLoading = true

               

            axios.post('/login',this.credintials)
            
                .then(res => {

                    
                    
                    if(res.data.error == 401 || res.data.error == 400){

                        _this.errors = res.data.message                      
                      
                        _this.isLoading = false

                        _this.credintials.password = ''

                        return
                    }                                  
            

                    var token = res.data.access_token

                    _this.$auth.setToken(token) 
                 

                    window.location = '/ph-admin' ;


                })
      


   
                   
                 
               

       },
 

   },

   created() {

        if( this.$auth.isAuthenticated() )
        {
            window.location = '/ph-admin' ;
        }
        
   }
   

    
}
</script>

