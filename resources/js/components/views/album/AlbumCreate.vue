<template>
    <div class="row">
        <div class="col-md-8" style="margin:0 auto">
         
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Create Album</h4>
              <p class="card-category">Add Album to your site.</p>
            </div>
            <div class="card-body">
            <form id="#form" @submit.prevent="CreateAlbum" enctype="multipart/form-data">
                      

                       <div class="row">
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <label class="bmd-label-floating">Name</label>
                                    <input type="text" class="form-control" name="name" v-model="album.name">
                                    </div>
                                    <div v-if="errors.name" class="alert alert-danger">
                                       {{ errors.name[0] }}
                                    </div>
                                  </div>
                                </div>
                
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <label class="bmd-label-floating">Choose category</label>
                                      <select name="category" class ="form-control" v-model="album.category">
                                                                             
                                        <option v-for="category in categories" :key="category.id" :value="category.id">
                                          {{ category.name }}
                                        </option>
                                      </select>
                                    </div>

                                     <div v-if="errors.category" class="alert alert-danger">
                                       {{ errors.category[0] }}
                                    </div>

                                  </div>
                             </div>
                
                             <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label class="bmd-label-floating">Tags</label>
                                  <input type="text" class="form-control" name="tags" v-model="album.tags">
                                </div>
                              </div>
                            </div>
                
                            <div class="row">
                       
                              <div class="col-md-12">
                
                                  <label class="custom-link btn btn-primary" >Set feature image<input   type="file" name="image" style="display:none;" @change="OnFileChange($event)"></label>
                
                                <div v-if="imagelink" class="feature-image-container">
                                    <img v-bind:src="imagelink">                                
                                    <a @click="RemoveFeatureImage()" rel="tooltip" title="Remove image" class="btn btn-danger btn-link btn-sm image-delete">
                                        <i class="material-icons">close</i>
                                    </a>
                                </div>
                
                                 
                              </div>
                          </div>  
                
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label class="bmd-label-floating">Status</label>
                                <select  class ="form-control" name="status" v-model="album.isPublished">
                                  
                                  <option value="1">Published</option>
                                  <option value="0">Unpublished</option>
                                   
                                </select>
                              </div>
                            </div>
                       </div>
                      
                         
                            <button type="submit" class="btn btn-primary pull-right">Create</button>
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
      return {
        category_id : '',
        album : {
             name : '',
             category : '',
             description : '',
             tags : '',
             image : '',
             isPublished : '1'
        },
        categories : [],
        imagelink : '',
        errors : []
       
      }   
    
    },
    methods : {

       CreateAlbum(){

          var _this = this;
          
          _this.errors = []

          var form =  document.getElementById('#form')

          let formdata = new FormData(form);          

          axios.post('/api/albums/store',formdata,{

                  headers: { 'Content-Type': 'multipart/form-data' }

          }).then(res => {

                 _this.category_id = res.data
                 _this.$router.push({name : 'galleryAlbum', params : { id : _this.category_id } } )
            
            })

            .catch(err => {
            
              if(err.response.status == 422)
              {
                  _this.errors = err.response.data.errors
              }

          })  


       },

       Loadcategories(){
        
            var _this = this

            axios.get('/api/categories/all').then(response => _this.categories = response.data)

       },

       OnFileChange(event)
       {

         var file = event.target.files[0]

         this.imagelink = URL.createObjectURL(file)

       },

       RemoveFeatureImage(){

         this.imagelink = ''

       }        
     
    },
    created(){

      this.Loadcategories()
   
    }
}
</script>
<style>
  td > span{
   cursor: pointer;
  }
</style>


