<template>
    <form @submit.prevent="Update" id="form">


<div v-if="!isLoading" class="row">

  <div class="col-md-8">
    <div class="card">
      <div class="card-header card-header-primary">
        <h4 class="card-title">Edit Profile</h4>
        <p class="card-category">Complete your profile</p>
      </div>
      <div class="card-body">    
       
          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
                <label class="bmd-label-floating">Company</label>
                <input type="text" class="form-control" disabled value="Photography">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label class="bmd-label-floating">Username</label>
              <input type="text" class="form-control" disabled v-model="user.username">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label class="bmd-label-floating">Email address</label>
                <input type="email"  name="email" class="form-control" value="" v-model="user.email">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="bmd-label-floating">Fist Name</label>
              <input type="text" name="firstname" class="form-control" value="" v-model="user.firstname">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="bmd-label-floating">Last Name</label>
                <input type="text" name="lastname" class="form-control" value="" v-model="user.lastname">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label class="bmd-label-floating">Address</label>
              <input type="text" name="address" class="form-control"  value="" v-model="user.address">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>About Me</label>
                <div class="form-group">
                <textarea name="aboutme" class="form-control" rows="5" v-model="user.aboutme"></textarea>
                </div>
              </div>
            </div>
          </div>        
         
          <button type="submit" class="btn btn-primary pull-right">Update Profile</button>

          <div class="clearfix"></div>
   
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card card-profile">
       
      <div class="card-avatar">
          
        <a href="#pablo">
          

          <img v-if="user.avatar" :src="user.avatar" id="image" class="img"  />

          <img v-else id="image" class="img" src="/material/avatar/avatar.png" />
          
        
         
        </a>
 
      </div>
      <div class="card-body">
        <h6 class="card-category text-gray">{{ user.role | role }}</h6>
      <h4 class="card-title">{{ user.firstname + " " +  user.lastname  }}</h4>
        <p class="card-description">
            {{user.aboutme}}
        </p>
        <div class="td-actions text-center">
            <label rel="tooltip" title="Upload Image" class="btn btn-primary btn-link btn-sm">
              <i class="material-icons">insert_photo</i>
              <input  type="file" name="image" style="display:none;" @change="OnfileChange($event)">
            </label>
            <a href="#" rel="tooltip" title="Remove Image" class="btn btn-danger btn-link btn-sm" @click="RemoveAvatar()">
              <i class="material-icons">close</i>
            </a>
          </div>
        
      </div>
    </div>
  </div>


</div>

 <div v-else class="spinner">
             <div  class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div> 
  </div> 

</form>
    
</template>

<script>
export default {
    data(){
      return {
          user : { },
          imagefile : '',
          NullImage : false,
          isLoading : false
      }
    },
    methods : 
    {
      Auth(){

          var _this = this

          _this.isLoading = true;

          axios.get('/api/user').then(res => {

              _this.user = res.data

            
              _this.isLoading = false


          })


      },
      Update(){

      var _this = this

      var form  =  document.getElementById('form')

      var formdata = new FormData(form)

      formdata.append('image',this.user.avatar)

      formdata.append('removeImage',this.NullImage)

       axios.post('/api/users/profile/update',formdata, {
         
          headers : { 'Content-Type': 'multipart/form-data' }
         
       }).then( res => {

          _this.Auth()
          _this.NullImage = false

         })

      },
      OnfileChange(e){

          var file = e.target.files[0]

          this.imagefile = this.user.avatar

          this.user.avatar = URL.createObjectURL(file)

      },
      RemoveAvatar(){

        this.NullImage = true;

      }
    },
    created(){
      this.Auth();
    }
}
</script>

