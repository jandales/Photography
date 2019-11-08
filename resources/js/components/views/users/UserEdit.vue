<template>
    <div class="row">
        <div class="col-md-8" style="margin:0 auto">
         
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Edit user</h4>
            </div>
            <div class="card-body">
            <form @submit.prevent="UpdateUser">
      
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="bmd-label-floating">Username</label>
                       <input type="text" class="form-control" name="username" v-model="fillable.username" disabled>
                    </div>
                  </div>
                </div>

                <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="bmd-label-floating">Email</label>
                          <input type="text" class="form-control" name="email" v-model="fillable.email">
                          </div>
                        </div>
               </div>

               <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="bmd-label-floating">Firstname</label>
                      <input type="text" class="form-control" name="firstname" v-model="fillable.firstname">
                      </div>
                    </div>
              </div>

              <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="bmd-label-floating">Lastname</label>
                        <input type="text" class="form-control" name="lastname" v-model="fillable.lastname">
                      </div>
                    </div>
              </div>
    
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="bmd-label-floating">New Password</label>
                      <input type="password" class="form-control" name="password" v-model="fillable.password">
                    </div>
                  </div>
                </div>

                <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="bmd-label-floating">Role</label>
                            <select name="role" class ="form-control" v-model="fillable.role">
                                <option v-for="option in options" :key="option.value" v-bind:value="option.value">{{option.text}}</option>  
                            </select>
                          </div>
                        </div>
                      </div>
             
                <button type="submit" class="btn btn-primary pull-right">Submit</button>
                <div class="clearfix"></div>
              </form>
            </div>
          </div>
        </div>
    
      </div>
</template>

<script>
export default {
  data(){
    return{
      fillable : {
        id : '',
        username : '',
        email : '',
        firstname : '',
        lastname : '',
        password : '',
        role : '2',
      },
      userid : this.$route.params.id,
      options :[
        { text : 'Administrator' , value : 1 },
        { text : 'Editor', value : 2 },
        { text : 'Author', value : 3 }        
      ],
      errors : []
    }
  },
  methods:{

      GetUser(){
            var _this = this
            axios.get('/users/edit/'+ _this.userid).then(function(response){
                  _this.fillable.id = response.data.id
                  _this.fillable.username = response.data.username
                  _this.fillable.firstname = response.data.firstname
                  _this.fillable.lastname = response.data.lastname
                  _this.fillable.role = response.data.role
                  _this.fillable.email = response.data.email
            })

      },  

      UpdateUser(){
        
        var _this = this;
        _this.errors = [];

        axios.post('/api/users/update/' + _this.userid,this.fillable)
            .then(function(response){
                  alert(response.data.message)                 
                  })
              .catch(error => {

                  if(error.response.status == 422)
                  {
                      _this.errors = error.response.data.errors;
                  
                  }
              }); 
      },  

  }, 
  created(){
      this.GetUser();
  } 
}
</script>

