<template>
    
<div class="row">
        <div class="col-md-12" style="margin:0 auto">
         
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Gallery</h4>
             </div>
            <div class="card-body">
                <div class="album-container">
                   <div class="album-image">

                        <div class="div-image"  v-if="album.image">
                            <img  height="200" width="200" :src="album.image">                            
                        </div>

                       <div class="div-image" v-else>
                            <img height="200" width="200" src="/img/private/camera.png">                            
                       </div>
                       
                       
                       
                   </div>
                    <div class="album-info">

                      
                        <label class="title">{{ album.name }}</label>
                        <br>
                        <label>{{ album.category }}</label>
                         <br>
                        <label>Photos : {{ album.photos }}</label>
                         <br>
                        <label>Status : {{ album.isPublished | published }}</label>
                        <br>
                        <a @click="ClearUploader()" class="btn btn-primary" data-toggle="modal" data-target="#editalbum">Edit</a>
                       
                       
                    
                    </div>
                    
                </div>
               <div class="clearfix"></div>

                <div class="album-content">
                        <div class="album-content-header">              

                                <a href="#" @click="ClearUploader()" class="btn btn-primary" data-toggle="modal" data-target="#ReplyModal">Add Images</a>       
                                 <button @click="DeletePhotos()" class="btn btn-primary">Delete</button>                
                        
                         </div>

                    <div class="tab-content clearfix">
          <div>             
        

            <table  class="table table-reponsive">
                <thead class=" text-primary">
                        <th>  
                        <div class="form-check">
                            <label class="form-check-label">
                            <input id="perentCheckbox" class="form-check-input" type="checkbox" value="" @click="SelectAll()" v-model="isCheckedAll">
                            <span class="form-check-sign">
                                <span class="check"></span>
                            </span>
                            </label>
                        </div>
                        </th>
                        <th></th>
                        <th>Name</th>
                        <th>Location</th>
                        <th>Size</th>
                        <th>Date upload</th>
                        <th></th>   
                </thead>
                <tbody id="tbody">                          
                        <tr v-for="photo in photos" :key="photo.id">
                            <td> 
                                <div class="form-check">
                                    <label class="form-check-label">
                                    <input name="checkbox"  class="form-check-input" type="checkbox" :value="photo.id" v-model="checked">
                                    <span class="form-check-sign">
                                        <span class="check"></span>
                                    </span>
                                    </label>
                                </div>
                            </td>
                            <td><img :src="photo.location" width="50" height="50"></td>
                            <td>{{photo.name}}</td>
                            <td>{{photo.location}}</td>
                            <td>{{photo.size | ToMB }}</td>
                            <td>{{photo.created_at | moment('MMMM D, YYYY, hh:mm a')}}</td>
                            <td><a @click="Destroy(photo.id)" class="btn btn-danger"><i class="material-icons">close</i></a></td>
                        </tr>
                </tbody>
                </table>         

          </div>

        
        
			</div>
                </div>
                
            </div>
          </div>
        </div>

        <!-- Upload image modal -->

<div class="modal fade" id="ReplyModal" role="dialog">
    <div class="modal-dialog">
      
      <!-- Modal content-->
      <div class="modal-content modal-large">
           <form id="form" @submit.prevent="Upload" enctype="multipart/form-data">
        <div class="modal-header">
         
          <h4 class="modal-title">Uploader<span id="model-auhtor"></span></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <div v-if="success" class="alert alert-success">
                {{success}}
            </div>
                  <label class="custom-link btn btn-primary" >Upload Images<input id="file"  type="file" name="image" style="display:none;" multiple @change="OnFileChange($event)"></label>                           
            

             <div class="list-image">
                 <div class="list-image-item" v-for="image in ImagesToUpload" :key="image.id">                   
                     <span @click="RemoveImageToUpload(image.id)" class="btn btn-danger"><i class="material-icons">close</i></span>
                     <img width="60" height="60" :src="ConvertToImage(image.file)">
                 </div>
             </div>
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

  <!-- modal Edit album -->
  
    <div class="modal fade" id="editalbum" role="dialog">
    <div class="modal-dialog">
      
      <!-- Modal content-->
      <div class="modal-content">
           <form id="editform" @submit.prevent="Update" enctype="multipart/form-data">
        <div class="modal-header">
         
          <h4 class="modal-title">Edit Album<span id="model-auhtor"></span></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div v-if="success" class="alert alert-success">
                {{ success }}
            </div>
            <div class="row">
                
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="bmd-label-floating">Name</label>
                        <input type="text" class="form-control" name="name" v-model="album.name">
                    </div>
                    <div v-if="errors.name" class="alert alert-danger">
                            {{errors.name[0]}}
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

                    <label class="custom-link btn btn-primary" >Set feature image<input id="FeatureImageFile"  type="file" name="image" style="display:none;" @change="OnFileImage($event)"></label>

                        <div v-if="imagelink" class="feature-image-container">
                            <img  v-bind:src="imagelink">                                
                            <a rel="tooltip" @click="RemoveFeatureImage()" title="Remove image" class="btn btn-danger btn-link btn-sm image-delete">
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
                photos : [],                
                ImagesToUpload : [],
                index : [],
                imagelink : '',
                categories : [],
                file : '',
                isRemove : false,
                tempImage : '',
                errors : [],
                checked : [],
                isCheckedAll : '',
                success : '',                
            }
        },
        methods : {
            fecth(){

          
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
                    _this.imagelink = res.data.featured_image

                })

            },
            Upload(){
                

              
                var _this = this;
                
                var form  = document.getElementById('form')
                 
                /// set the form into foradata sa varialble
                let formdata = new FormData(form);
                
                //// clear the success messages
                _this.success = ''

                /// get the route parameters
                var id = _this.$route.params.id

                /// append id into dataform
                formdata.append('id',id)

                
                ///loop the images
                for(let i = 0; i < _this.ImagesToUpload.length; i++)
                {
                /// append images into formdatas
                    formdata.append('images[]',_this.ImagesToUpload[i].file)

                }               

            
                /// execute a post request
                axios.post('/api/albums/upload',formdata,{  

                    headers: { 'Content-Type': 'multipart/form-data' }

                    }).then(res => {
                        
                        _this.success = res.data.message
                      _this.fecth()
                    })

            },
            Update(){


                var _this = this

                var id  = _this.album.id;
                /// ser the success message to null
                _this.success = ''
                /// set the form
                var form = document.getElementById('editform')
                 
                /// append the form into formadata 
                let formdata =  new FormData(form)            

                /// set the errrors to null
                _this.errors = []

                /// execute a post request
                axios.post('/api/albums/update/'+id,formdata,{

                     headers: { 'Content-Type': 'multipart/form-data' }

                }).then(res => {

                    _this.success = res.data.message;

                    _this.fecth()

                }).catch(err => {

                    if(err.response.status == 422){

                        _this.errors = err.response.data.errors
                    }
                })

            },
            Loadcategories(){
        
                var _this = this

                axios.get('/api/categories/all').then(response => _this.categories = response.data)

            },
            ChangeView(){
                
                this.grid ^= true
            },
            OnFileImage(e){

                this.file = e.target.files[0];
                this.tempImage = this.album.image
                this.imagelink = URL.createObjectURL(this.file)
                   
            },
            OnFileChange(event){
            
                var files = event.target.files;
             
                var  index = this.index.length;

                for(var i = 0; i < files.length; i++)
                {

                    this.index.push(i);

                    this.ImagesToUpload.push({id : index, name : files[i].name ,file : files[i]})

                    index++           

                }

                let input = document.getElementById('file')

                input.value = '';  
      
            },
            RemoveFeatureImage(){

                this.imagelink = this.tempImage
                let input = document.getElementById('FeatureImageFile')
                input.value = ''; 

            },
            ConvertToImage(file){
                return URL.createObjectURL(file);
            },
            RemoveImageToUpload(id){
                for(let i = 0; i < this.ImagesToUpload.length; i++)
                {
                    if(this.ImagesToUpload[i].id == id)
                    {
                        this.ImagesToUpload.splice(i,1);
                    }
                }

            
            },
            ClearUploader(){
                this.ImagesToUpload = [];
                this.success = ''
            },
            Destroy(id){
              
              var _this = this
              axios.get('/api/albums/delete/photos/'+id).then(res => { 
                  
                  alert(res.data.message)
                  _this.fecth();

              } )

            },
            DeletePhotos(){

                var _this = this

                if(_this.checked.length == 0)
                {

                    return alert('No selected photo')
                   
                }

                axios.get('/api/albums/deletephotos',{ params : { id : _this.checked } } ).then(res => { 
                  
                  alert(res.data)
                  _this.fecth();

                })

            },
            SelectAll(){
                
                if(!this.isCheckedAll)
                {
                    for(let i = 0; i < this.photos.length; i++)
                    {
                        this.checked.push(this.photos[i].id)
                    }
                    return
                }

                this.checked = []
                
            },
          

        },
        created(){
            this.fecth();
            this.Loadcategories();
        }
       
        
}
</script>

<style>
.album-image{
    float: left;    
}
.album-info{
    float: left;
    left: 10px;
    margin-left: 10px;
}
.album-info .title{
   
    font-size: 20px;
}

.album-content{
    margin-top: 50px;
}
.album-content-header{
    margin-bottom: 30px;
}

.btn{
   color: #fff !important;
   
}

.div-image {
    position: relative;  
    text-align: center;  
}
.div-image:hover .image-action {
    visibility: visible;
}

.div-image .image-action{
    visibility: hidden;
    position: absolute;
    bottom: 10px;
    width: 100%;
    text-align: center; 
}

.modal-large {
    width: 900px !important;/* respsonsive width */
    margin-left: -160px;
}

.list-image{
  display: grid;
  grid-template-columns: 1fr 1fr 1fr 1fr; 
  padding: 10px;
  margin-bottom: 20px; 
}
.list-image-item{
  position: relative;
  background-color: rgba(255, 255, 255, 0.8);
  text-align: center;
  padding: 5px;
  width: 210px;
  height: 210px;
}

.list-image-item img{
    width:100%;
    height:100%;
}

.list-image-item span{
    position: absolute;
    top :10px;
    right : 10px;
}

.list-image-item .btn{
    padding: 0 !important;
}
.feature-image-container{
    width: 180px !important;
    height: 180px !important;
    margin-bottom: 20px;
}

.feature-image-container img{
    width: 180px !important;
    height: 180px !important;
}

.modal-body{
    padding: 30px;
}
</style>
