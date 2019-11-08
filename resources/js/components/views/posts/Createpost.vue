<template>
    <div class="row">
        <div class="col-md-12" style="margin:0 auto">
         
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Create Post</h4>
              <p class="card-category">Add Post to your site.</p>
            </div>
            <div class="card-body">

            <form id="form"  @submit.prevent="CreatePost">
                      
                        <div style="margin:0 auto;" class="col-md-11">
                            <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label class="bmd-label-floating">Name</label>
                                  <input type="text" class="form-control" name="title" v-model="post.title">
                                  </div>
                                  <div v-if="errors.title" class="alert alert-danger">
                                    {{errors.title[0]}}
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Content</label>                                     
                                            <textarea class="form-control" rows="6" name="content"  v-model="post.content" ></textarea>
                                    </div>
                                     <div v-if="errors.content" class="alert alert-danger">
                                        {{errors.content[0]}}
                                  </div>
                                  </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                          <label class="bmd-label-floating">Category</label>
                                          <select name="category" class ="form-control" v-model="post.category">
                                             
                                              <option v-for="category in categories" :key="category.id" v-bind:value="category.value">
                                                {{category.name}}
                                              </option>
                                                                                      
                                          </select>
                                        </div>
                                         <div v-if="errors.category" class="alert alert-danger">
                                        {{errors.category[0]}}
                                  </div>
                                      </div>
                                </div>

                                
                             <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label class="bmd-label-floating">Tags</label>
                                    <input type="text" class="form-control" name="tags" v-model="post.tags">
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                       
                                  <div class="col-md-12">
                    
                                      <label class="custom-link btn btn-primary" >
                                          Set feature image
                                          <input  type="file" id="feature-image" name="image" style="display:none;" @change="uploadImage($event)">
                                        </label>
                    
                                    <div v-if="imagelink"  class="feature-image-container">
                                        <img id="image" :src="imagelink">
                                    
                                        <a @click="removeImage()" id="remove-feature-image" rel="tooltip" title="Remove image" class="btn btn-danger btn-link btn-sm image-delete">
                                            <i class="material-icons">close</i>
                                        </a>
                                    </div>
                    
                                     
                                  </div>
                              </div>  
                    
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label class="bmd-label-floating">Status</label>
                                    <select  class ="form-control" name="isPublished" v-model="post.isPublished">
                                            <option v-for="option in options" :key="option.value" v-bind:value="option.value">
                                                  {{option.text}}
                                            </option>                     
                                    </select>
                                  </div>
                                </div>
                           </div>
                           <button type="submit" class="btn btn-primary pull-right">Create</button>
                           <div class="clearfix"></div>
               
                  
                        </div>

                          
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

            post :{

                title : '',

                content : '',

                category : '0',

                tags : '',

                image : '' ,

                isPublished : '0'

            },

            options : [  

                { text : 'Draft',       value : '0' },

                { text : 'Published',   value : '1' },

                { text : 'Unpublished', value : '2' }

            ],

            categories : [],

            imagelink : '',

            errors : []

        }
    },
    methods : {
      listcategories(){

          var _this = this

          axios.get('/api/categories/all').then(response => {
              
                 var list = response.data

                  for(var i = 0; i < list.length; i++)
                  {
                      //// push the list of categotries from database  into categories list in view
                      _this.categories.push({ id : i,  name : list[i].name, value : list[i].id})
                  }

                
                    
                })          

      },
      CreatePost(){
        
        var form = document.getElementById('form');

        let formData = new FormData(form);

        var _this = this

        this.errors = []
   
        axios.post('/api/posts/store',formData,{ 
                    headers: {
                    'Content-Type': 'multipart/form-data'}
                  })
             .then(function(response){

                  if(response.data.status == "success")
                  {
                   
                      _this.post.title = ''
                      _this.post.content = ''
                      _this.post.category = '0'
                      _this.post.tags = ''
                      _this.post.image = ''
                      _this.post.isPublished = 0
                      _this.imagelink = ''

                 
                      alert(response.data.message)

                      return
                  }
                  else  
                    alert(response.data.message)

                  })
              .catch(error =>
                    {
                        if(error.response.status == 422)
                        {
                           _this.errors = error.response.data.errors                        
                        }
                    })
      },
      uploadImage(event)
      {
        var file = event.target.files[0]

      

        if(file.size >= 16777216)
        {
            alert('image is to big')
            return;
        }

        if(!file.type.match('image/jpeg'))
        {
           alert('Invalid image type')
           return
        }
      
        this.post.image = file    
        this.imagelink = URL.createObjectURL(file)   

      },
      removeImage()
      {
        this.post.image = ''
        this.imagelink = ''
      }
      
    },
    created(){
      this.listcategories();
      this.post.category = 0
    }
}
</script>

