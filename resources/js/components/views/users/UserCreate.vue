<template>

    <div class="row">
        <div class="col-md-8" style="margin:0 auto">
         
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Create user</h4>
              <p class="card-category">Create a brand new user and add them to this site.</p>
            </div>
            <div class="card-body">
            <form @submit.prevent="CreateUser"> 
     
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="bmd-label-floating">Username</label>
                       <input type="text" class="form-control" name="username" v-model="fillable.username">                     
                    </div>
                          <div class="alert alert-danger" v-if="errors.username">
                              {{errors.username[0]}}
                          </div>
                  </div>
                </div>

                <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="bmd-label-floating">Email</label>
                            <input type="text" class="form-control" name="email" v-model="fillable.email">
                          </div>
                          <div class="alert alert-danger" v-if="errors.email">
                              {{errors.email[0]}}
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
                      <label class="bmd-label-floating">Password</label>
                      <input type="password" class="form-control" name="password" v-model="fillable.password">                         
                    </div>
                     <div class="alert alert-danger" v-if="errors.password">
                              {{errors.password[0]}}
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
        username : '',
        email : '',
        firstname : '',
        lastname : '',
        password : '',
        role : '2',
      },
      options :[
        { text : 'Administrator' , value : 1 },
        { text : 'Editor', value : 2 },
        { text : 'Author', value : 3 }        
      ],
      errors : []
    }
  },
  methods:{

    CreateUser(){
      
      var _this = this;
      _this.errors = [];

      axios.post('/api/users/store',this.fillable)
           .then(function(reponse){
                  alert(reponse.data.message)
                  _this.ClearFillable();
                })
            .catch(error => {

                 if(error.response.status == 422)
                {
                     _this.errors = error.response.data.errors;
                 
                 }
             }); 
    },

    ClearFillable(){
      this.fillable.username = ''
      this.fillable.email = ''
      this.fillable.firstname = ''
      this.fillable.lastname = ''
      this.fillable.role = '2'
      this.fillable.password = ''
      this.errors = []
    }

  } 
}
</script>
