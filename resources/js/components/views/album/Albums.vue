<template>
    <div class="row">
    <div  v-if="!isLoading" class="col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
        
          <div class="form-row align-items-center">
              <div class="col-9 my-1">
                  <h4 class="card-title">List of Albums</h4>
              </div>
                <form class="navbar-form" @submit.prevent="Search">
                    <div class="input-group no-border">
                  
                    <input type="text" class="form-control txtsearch" name="search" placeholder="Search" v-model="inputsearch">
                      <button type="submit" class="btn btn-white btn-round btn-just-icon">
                        <i class="material-icons">search</i>
                        <div class="ripple-container"></div>
                      </button>
                    </div>
                </form>
          
           

          </div>



        </div>
       
        <div class="card-body">
            <div class="form-row align-items-center">
               
                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                    <div class="btn-group mr-2" role="group" aria-label="First group">
                    <router-link to="/ph-admin/albums/create" class="btn btn-primary">
                         Create
                        <div class="ripple-container"></div>
                    </router-link>
                    <button @click="edit()" id="albums-edit" type="button" class="btn btn-primary">Edit</button>
                    <button @click="deletes()" type="button" class="btn btn-primary">Delete</button>
                  </div>
                                     
                </div>

            </div>

             <br>
                <div v-if="!isLoading && searchState">
                  <p>Search found : {{ foundCount }} of {{ inputsearch }}   <span @click="CloseSearch" class="btn btn-span btn-danger"><i class="material-icons">close</i></span> </p>
                </div>
        
          <div  class="table-responsive">
            <table v-if="albums.length" class="table">
              <thead class=" text-primary">
                <th>  
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="form-check-input" type="checkbox" value="" @click="selectAll()" v-model="IsCheckedAll">
                      <span class="form-check-sign">
                        <span class="check"></span>
                      </span>
             
                    </label>
                  </div>
                </th>
                <th>Name</th>
                <th>Category</th>
                <th>Photos</th>
                <th>Author</th>
                <th>Status</th>
                <th>Created</th>
                 <th></th>
              </thead>
              <tbody> 

            
          
                <tr  v-for="album in albums" :key="album.id">
                       <td> 
                          <div class="form-check">
                            <label class="form-check-label">
                            <input name="checkbox"  class="form-check-input childCheckbox" type="checkbox" :value="album.id" v-model="checked">
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                       </td>
                       <td>{{ album.name }}</td>
                       <td>{{ album.category.name }}</td>
                       <td>{{ album.photos.length }}</td>
                       <td>{{ album.user.username }}</td>
                       <td>{{ album.published | published }}</td>
                       <td>{{ album.created_at | moment('MMMM D, YYYY,  HH:mm a') }}</td>
                       <td class="td-actions text-right">
                            <router-link :to="{name : 'galleryAlbum', params : { id : album.id } }" rel="tooltip" title="Edit" class="btn btn-primary btn-link btn-sm">
                              <i class="material-icons">edit</i>
                            </router-link>
                            <span @click="destroy(album.id)" rel="tooltip" title="Delete" class="btn btn-danger btn-link btn-sm">
                              <i class="material-icons">close</i>
                            </span>
                        </td>
                      </tr>  

                          
               
              </tbody>
           
            </table>   

             <div v-else>
                  <p v-if="foundCount == 0" class="empty-list">No list of posts</p>
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
        return{
            albums : [],
            checked : [],
            IsCheckedAll : false,
            isLoading : false,
            pagination : {},
            inputsearch : '',
            searchState : false,
            foundCount : 0
            
        }
    },
    methods : {
        fecth( page_url ){

              var _this = this

              page_url = page_url || '/api/albums'

              axios.get( page_url ).then(response => {

                _this.albums = response.data.data             
                
                _this.Pagination(response.data)

                _this.foundCount = response.data.total

                setTimeout(function(){

                  _this.isLoading = false

                },1000)

              })

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
        edit(){
            

            if( this.checked.length > 1 || this.checked.length == 0 )
            {
                alert('Select  one item to edit');
                this.checked = []
                this.IsCheckedAll = false
            }

            var id = this.checked[0];       

            this.$router.push({name : 'galleryAlbum',  params :{ id : id }})

        },
        destroy(id){

          
          var _this = this
           axios.get('/api/albums/delete/'+id).then(res => {
             alert(res.data.message)
             _this.fecth()
           }) 

        }, 
        deletes(){

          var _this = this
          axios.get('/api/albums/delete',{params : {id : _this.checked } }).then(res => {
              _this.fecth()
              alert(res.data.message)
          })

        },     
        selectAll(){        
        
          if(!this.IsCheckedAll)
          {
            for(let i = 0 ; i < this.albums.length; i++)
            {
                this.checked.push(this.albums[i].id);
            }
            
          }
          else
          
            this.checked = []
          
        },
        Search(){


               var _this = this

                if(_this.inputsearch == null){
                    _this.fecth()
                    return alert('Search field empty')
                }

               _this.albums = []       

              axios.get('/api/albums/search',{ params : { search : _this.inputsearch } }).then(response => {

                _this.searchState = true

                _this.albums = response.data;

                _this.foundCount = response.data.length

                setTimeout(function() {

                    _this.isLoading = false

                },1000)

                
              })
        },
         CloseSearch(){


          this.searchState = false;
          this.inputsearch = 'Search'
          this.fecth();

        }

    },
    created(){
      
      this.isLoading = true;
      this.fecth();
   
    },
 

}
</script>

