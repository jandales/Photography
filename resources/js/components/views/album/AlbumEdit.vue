<template>
    
     <!-- modal Edit album -->
  
    <div class="modal fade" id="editalbum" role="dialog">
    <div class="modal-dialog">
      
      <!-- Modal content-->
      <div class="modal-content">
           <form id="editform" @submit.prevent="Upload" enctype="multipart/form-data">
        <div class="modal-header">
         
          <h4 class="modal-title">Edit Album<span id="model-auhtor"></span></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          
              <div class="row">
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <label class="bmd-label-floating">Name</label>
                                    <input type="text" class="form-control" name="name" v-model="album.name">
                                    </div>
                                  
                                  </div>
                                </div>
                
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <label class="bmd-label-floating">Choose category</label>
                                       <select name="category" class ="form-control" v-model="album.category_id">
                                                                             
                                        <option v-for="category in categories" :key="category.id" :value="category.id">
                                          {{ category.name }}
                                        </option>

                                      </select>
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
                
                                  <label class="custom-link btn btn-primary" >Set feature image<input   type="file" name="image" style="display:none;" ></label>
                
                                 <div v-if="album.image" class="feature-image-container">
                                    <img v-bind:src="album.image">                                
                                    <a rel="tooltip" title="Remove image" class="btn btn-danger btn-link btn-sm image-delete">
                                        <i class="material-icons">close</i>
                                    </a>
                                </div>
                
                                 
                              </div>
                          </div>  
                
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label class="bmd-label-floating">Status</label>
                                <select  class ="form-control" name="status" v-model="album.isPublis">
                                  
                                  <option value="1">Published</option>
                                  <option value="0">Unpublished</option>
                                   
                                </select>
                              </div>
                            </div>
                       </div>
                      
                         
                         
                            <div class="clearfix"></div>
                

        </div>
        <div class="modal-footer">
            <button class="btn btn-primary">
                             Submit
            </button>
        </div>
        </form>
      </div>
       
    </div>
  </div>

</template>

<script>
export default {
      data(){
        return{
             album : {
                    id : '',
                    name : '',
                    category : '',
                    category_id : '',
                    image : '',
                    photos : '',
                    tags : '',
                    isPublished : '',                    

              },
               categories : [],

        }
      },
      methods : {
        fetch(){
          
              var _this = this
                axios.get('/api/albums/show/'+ _this.$route.params.id).then(res => {

                    _this.album.id = res.data.id
                    _this.album.name = res.data.name
                    _this.album.category = res.data.category.name
                    _this.album.category_id = res.data.category.id
                    _this.album.image = res.data.featured_image
                    _this.album.photos = res.data.photos.length
                    _this.album.tags = res.data.tags
                    _this.album.isPublished = res.data.published
                    _this.photos = res.data.photos;

                })

                console.log(_this.$route.params.id)

        },
         Loadcategories(){
        
                var _this = this

                axios.get('/api/categories/all').then(response => _this.categories = response.data)

        },
      }
}
</script>

