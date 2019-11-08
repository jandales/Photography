<template>
   <div class="row">
        <div v-if="!isLoading" class="card">
        <div class="card-header card-header-primary">
        
          <div class="form-row align-items-center">
              <div class="col-9 my-1">
                  <h4 class="card-title">Settings</h4>
              </div>
          </div>

        </div>

         <div class="card-body">

            
                     <div class="row">
                   <div class="col-md-6">
                       <div class="form-group">
                         <label class="bmd-label-floating">Campany Name</label>
                       <input type="text" class="form-control" name="campanyname" v-model="settings.name">
                   </div>
                   </div>
               </div>

                <div class="row">
                   <div class="col-md-6">
                       <div class="form-group">
                         <label class="bmd-label-floating">Email Address</label>
                       <input type="text" class="form-control" name="email" v-model="settings.email">
                   </div>
                   </div>
                </div>

                <div class="row">
                   <div class="col-md-6">
                       <div class="form-group">
                         <label class="bmd-label-floating">Business Address</label>
                       <input type="text" class="form-control" name="address" v-model="settings.address">
                   </div>
                   </div>
                </div>

                 <div class="row">
                   <div class="col-md-6">
                       <div class="form-group">
                         <label class="bmd-label-floating">Phone Number</label>
                         <input type="text" class="form-control" name="phonenumber" v-model="settings.phone">
                   </div>
                   </div>
                </div>

                    <br>

                    <h4>Pagination</h4>
                  <div class="row">
                   <div class="col-md-6">
                       <div class="form-group">
                         <label class="bmd-label-floating">Per page</label>
                        <input type="text" class="form-control" name="perpage" v-model="settings.perpage">
                   </div>
                   </div>
                </div>

                <div class="row">
                   <div class="col-md-6">
                       <div class="form-group">
                           <button class="btn btn-primary">Save Settings</button>
                   </div>
                   </div>
                </div>


        </div>
    </div>

    <div v-else class="col-md-12">
             <div  class="spinner">
             <div  class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div> 
     </div>
    </div>

   </div>
</template>

<script>
export default {
    data(){
        return {

            settings : {},

            isLoading : false
        }
    },
    methods :{
        fecth(){

            var _this = this

            _this.isLoading = true;

            axios.get('/api/settings').then(res => {

                _this.settings = res.data

                _this.isLoading = false;
                              

            })
        }
    },
    created(){

        this.fecth();

    }
}
</script>

