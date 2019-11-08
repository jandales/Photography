<template>
<div class="row">



    <div v-if="!isLoading"  class="card">
        <div class="card-header card-header-primary">
            <div class="form-row align-items-center">
                <div class="col-9 my-1">
                    <h4 class="card-title">List of Categories</h4>
                </div>
                  <form  @submit.prevent="search" class="navbar-form">

                      <div class="input-group no-border">
                      <input type="text" name="search" id="search"  class="form-control txtsearch" placeholder="Search..." v-model="inputsearch">
                      <button type="submit" class="btn btn-white btn-round btn-just-icon">
                            <i class="material-icons">search</i>
                            <div class="ripple-container"></div>
                          </button>   
                      </div>  

                </form>            
                    
  
            </div>

            
  
        </div>
        <div class="card-body">
            <div class="row">
              <div class="col-md-5">
              <form class="col-md-10" @submit.prevent="SaveCategories">
       
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="bmd-label-floating" v-if="!editState">Create new categories</label>
                        <label class="bmd-label-floating" v-else>Edit categories</label>                      
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="bmd-label-floating">Name</label>
                        <input type="text" name='name' class="form-control" v-model="fillable.name">

                            <div  class="alert alert-danger" role="alert" v-if="errors.name">
                            {{errors.name[0]}}
                       </div>
                      </div>
                    </div>
                  </div>
    
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="bmd-label-floating">Description</label>
                        <input type="text" class="form-control" name="description" v-model="fillable.description">
                      </div>
                    </div>
                  </div>
    
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="bmd-label-floating">Slug must have dash between words!</label>
                        <input type="text" class="form-control" name="slug" v-model="fillable.slug">
               
                      </div>
                    </div>
                  </div>
          
                  <button type="submit" class="btn btn-primary pull-right">Save</button>
                  <div class="clearfix"></div>
                </form>
              </div>
              <div class="col-md-7">
                  <div class="form-row align-items-center">                     
                     
      
                      <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                          <div class="btn-group mr-2" role="group" aria-label="First group">
                          <button @click="CreateCategories()" class="btn btn-primary">
                              Create                             
                          </button>      
                          <button id="category-edit" @click="edit()" type="button" class="btn btn-primary">
                            Edit
                            </button>
                          <button id="category-delete" @click="multidelete()" type="button" class="btn btn-primary">
                             Delete
                          </button>
                        </div>
                                           
                      </div>

                       <br>
                <div v-if="!isLoading && searchState">
                  <p>Search found : {{ foundCount }} of {{ inputsearch }}   <span @click="CloseSearch" class="btn btn-span btn-danger"><i class="material-icons">close</i></span> </p>
                </div>
      
                     
      
                     
                  </div>
                <div class="table-responsive">
                  <table v-if="categories.length" class="table">
                    <thead class=" text-primary">
                        <th>  
                            <div class="form-check">
                              <label class="form-check-label">
                                <input class="form-check-input" @click="selectAll()" id="perentCheckbox" type="checkbox"  v-model="isCheckAll">
                                <span class="form-check-sign">
                                  <span class="check"></span>
                                </span>
                              </label>
                            </div>
                          </th>
                      <th>Name</th>
                      <th>Description</th>
                      <th>Slug</th>
                      <th colspan="2"></th>                    
                    </thead>
                    <tbody>


                                  
                
                      <tr v-for="category in categories" :key="category.id">
                          <td> 
                              <div class="form-check">
                                <label class="form-check-label">
                                <input  class="form-check-input" type="checkbox" v-bind:value='category'  v-model="checkedIds">
                                  <span class="form-check-sign">
                                    <span class="check"></span>
                                  </span>
                                </label>
                              </div>
                            </td>
                            <td>{{category.name}}</td>
                            <td>{{category.description}}</td>
                            <td>{{category.slug}}</td>
                    
                      <td class="td-actions text-right">
                            <button @click="EditCategories(category)" rel="tooltip" title="Edit" class="btn btn-primary btn-link btn-sm">
                              <i class="material-icons">edit</i>
                            </button>
                            <button @click="Delete(category.id)" rel="tooltip" title="Delete" class="btn btn-danger btn-link btn-sm">
                              <i class="material-icons">close</i>
                            </button>
                      </td>
                        </tr> 

                                                   
                
                                       
                    </tbody>
                  
                  </table>

                     <div v-else>
                  <p v-if="foundCount == 0" class="empty-list">No categories in the database.. Create new one</p>
                </div>

                <div v-if="pagination.last_page > 1 && !searchState" aria-label="Page navigation example">
                <ul  class="pagination justify-content-end pagination-custom">
                    <li class="page-item"><span>Page : {{ pagination.current_page}} of {{ pagination.last_page }}</span></li>

                    <li  :class="[ { disabled : !pagination.prev_page_url } ]" class="page-item " >
                            <a  @click="PrevPage()" class="page-link"><i class="material-icons">navigate_before</i></a>
                    </li> 
                                  
                    <li :class="[ { disabled : !pagination.next_page_url }  ]" class="page-item">
                        <a @click="NextPage()" class="page-link" ><i class="material-icons">navigate_next</i></a>
                    </li>
                </ul>
               </div>
           
                </div>

                  
              </div>
            </div>
        </div>
    </div>
    <div v-else  class="col-md-12">
        <div class="spinner">
                         <div  class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div> 
        </div>
    </div> 
</div>
   
      
     
</template>

<script>
 export default {

    data(){
        return{
            categories : [],
            fillable : {
                'id' : '',
                'name' : '',
                'description' :  '',
                'slug' : '',
            },
            inputsearch : null,
            editState : false,          
            checkedIds: [],
            isCheckAll: false,
            errors : [],
            pagination : {},
            isLoading : false,
            inputsearch : '',
            searchState : false,
            foundCount : 0

          

        }
    },
   
    methods :
    {
          /// get list categories from database
          fecth(page_url)
          {
              var _this = this        

              page_url = page_url || '/api/categories'

              axios.get(page_url).then(function (response) {

                  _this.categories= response.data.data;
                  
                  _this.Pagination(response.data)

                
                  setTimeout(function(){
                      
                      _this.isLoading = false;

                  },1000)

              });        
          },
          Pagination( data ){

                let pagination = {

                          current_page : data.current_page,

                          next_page_url : data.next_page_url,

                          prev_page_url : data.prev_page_url,

                          last_page : data.last_page,

                          path : data.path,

                          page_url : data.path+"?page="+data.current_page
                        

                }       

               this.pagination = pagination

          },
          NextPage(){

              this.fecth( this.pagination.next_page_url )

          },
          PrevPage(){

              this.fecth( this.pagination.prev_page_url )

          },
          CreateCategories(){
              this.editState = false
              this.fillable.id = ''
              this.fillable.name = ''
              this.fillable.description = ''
              this.fillable.slug = ''
              this.checkedIds = []
              this.isCheckAll= false;
          },
          EditCategories(category){
              this.label = 'Edit Category'
              this.editState = true
              this.fillable.id = category.id
              this.fillable.name = category.name
              this.fillable.description = category.description
              this.fillable.slug = category.slug          
          
          },
          SaveCategories(){
              this.errors = [] 
              var _this = this;
              if(this.editState == false)
              {

                    axios.post('/api/categories/store', this.fillable)
                        .then(function (response) {  
                              _this.fecth();                   
                              _this.CreateCategories();
                                            
                          })
                          .catch(error => {

                              if(error.response.status == 422)
                              {
                                _this.errors = error.response.data.errors;
                              }

                          });
                          
                          
              }
              else{

                  axios.post('/api/categories/update/'+this.fillable.id, this.fillable).then(function (response) {
                        _this.fecth()                                                 
                        _this.CreateCategories()
                    });
              }
          },
          Delete(id){

            
                    var _this = this;
                    axios.get('/api/categories/delete/'+id).then(function (response) {
                        _this.fecth()
                        _this.CreateCategories()
                      
                    });

              
          },
          multidelete(){
                var _this = this;

              
                  var listId = [];
          
                    for (var i = 0; i < this.checkedIds.length; i++) {

                    listId.push(  this.checkedIds[i].id);
                        
                    }

                    axios.get('/api/categories/delete',{params :{ id : listId} })
                          .then(function (response) {
                              _this.checkedIds = []
                              listId = []
                              _this.fecth() 
                    });

                    this.fecth()


                  
          },
          search(){

              var _this = this;

              if(_this.inputsearch == '')
              {
                alert("Enter keyword to search")


                document.getElementById('search').focus()

            
                return;
              }

             _this.isLoading = true

             _this.searchState = true;


              axios.get('/api/categories/search',{params : { search : this.inputsearch} })
                  .then(response => 
                  {
                    _this.categories = response.data

                    _this.foundCount = response.data.length

                    setTimeout(function() {

                        _this.isLoading = false;

                    })
                    
                  });
          },
          edit(){

            if(this.checkedIds.length > 1 || this.checkedIds.length == 0)
              {
                  alert("Select one categories to edit");                 
                  this.CreateCategories();
                return;
              }

            this.editState = true
            this.fillable.id = this.checkedIds[0].id
            this.fillable.name = this.checkedIds[0].name
            this.fillable.description = this.checkedIds[0].description
            this.fillable.slug = this.checkedIds[0].slug   
                  
          },    
          selectAll(){
              if(!this.isCheckAll)
              {
                for(var key in this.categories)
                {
                  this.checkedIds.push(this.categories[key])           
                }

                return;
              }

              this.checkedIds = [];
              

          },
          CloseSearch(){
            this.searchState = false;
            this.inputsearch = ''
            this.fecth();

          } 

    },

    created(){
        this.isLoading = true;
        this.fecth();
    },
  
}
</script>



