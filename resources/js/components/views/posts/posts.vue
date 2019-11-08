<template>
   <div class="row">

    <div v-if="!isLoading" class="col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
        
          <div class="form-row align-items-center">
              <div class="col-9">
                  <h4 class="card-title">List of Posts</h4>
              </div>
                <form class="navbar-form " @submit.prevent="Search">
                    <div class="input-group no-border">
                    <input type="text" name="search" value="" class="form-control txtsearch" placeholder="Search..." v-model="inputsearch">
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
                <div class="col-auto my-1">
           
                  <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" v-model="selected">
                    <option value="3" disabled>Change status to</option>
                    <option value="0">Draft</option>
                    <option value="1">Published</option>
                    <option value="2">Unpublished</option>                    
                  </select>
                </div>
                
                <div class="col-auto my-1">
                  <button @click="Changeto()" type="submit" class="btn btn-primary">Submit</button>
                </div>              

                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                    <div class="btn-group mr-2" role="group" aria-label="First group">
                      <router-link to="/ph-admin/posts/create" class="btn btn-primary">Create</router-link>
                      <button @click="Edit()" id="posts-edit" type="button" class="btn btn-primary">Edit</button>
                      <button @click="Deletes()" type="button" class="btn btn-primary">Delete</button>                    
                     </div>                                     
                </div>
             
            </div>

               <br>
                <div v-if="!isLoading && searchState">
                  <p>Search found : {{ foundCount }} of {{ inputsearch }}   <span @click="CloseSearch" class="btn btn-span btn-danger"><i class="material-icons">close</i></span> </p>
                </div>
        
          <div  class="table-responsive">
            <table v-if="posts.length" class="table">
              <thead class=" text-primary">
                <th>  
                  <div class="form-check">
                    <label class="form-check-label">
                      <input id="perentCheckbox" class="form-check-input" type="checkbox" @click="CheckedAll()" v-model="isCheckedAll">
                      <span class="form-check-sign">
                        <span class="check"></span>
                      </span>
                    </label>
                  </div>
                </th>
                <th style="width:25%">Title</th>
                <th>Author</th>
                <th>Categories</th>
                <th><i class="fa fa-comment"></i></th>
                <th>Status</th>
                <th>Date</th>
                <th></th>
         
              </thead>
              <tbody>
          
                  <tr  v-for="post in posts" :key="post.id">
                    <td> 
                      <div class="form-check">
                        <label class="form-check-label">
                        <input name="checkbox" id ="#" class="form-check-input" type="checkbox" v-bind:value="post.id"   v-model="isChecked">
                          <span class="form-check-sign">
                            <span class="check"></span>
                          </span>
                        </label>
                      </div>
                    </td>
                      <td>{{post.title.substring(0,25)+".."}}</td>
                      <td>{{post.user.username}}</td>
                      <td>{{post.category.name}}</td>
                      <td><a href="#">{{post.comments.length}}</a></td>
                      <td>{{status(post.ispublished)}}</td>
                      <td>{{ post.created_at | moment("MMMM D YYYY, h:mm a")}}</td>
                      <td class="td-actions text-right">
                          <router-link :to="{name: 'editpost', params : {id : post.id }}" rel="tooltip" title="Edit" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </router-link>
                          <button @click="Delete(post.id)" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
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


import moment from 'vue-moment';

export default {
    data()
        {
           return {
              posts : [],
              isCheckedAll : false,
              isChecked : [],
              selected : '3',
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

            page_url = page_url || '/api/posts'
                 
            axios.get(page_url)

                 .then(response => {

                    _this.posts = response.data.data

                    _this.foundCount = response.data.total
                    
                    _this.Pagination(response.data)                   

                    setTimeout(function(){

                      _this.isLoading = false;


                    },1000)

                 })

                 .catch(errors => console.log(errors))
                
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
        CheckedAll(){
          if(!this.isCheckedAll)
          {
            for(var i = 0; i < this.posts.length;i++)
            {
             this.isChecked.push(this.posts[i].id)
            }
            return
          }
          else
          this.isChecked = []
        },
        Edit(){
          var checked = this.isChecked 
      
          if(checked.length == 0 || checked.length > 1)
          {
              alert("Select one post to edit")
              this.isChecked = []
              return
          }

           var id  = checked[0] 
           this.$router.push({name : 'editpost', params :{ id : id } })            

        },
        status( status ){
          switch(status)
          {
              case 0 :
                    return 'Draft'
                 break
              case 1 :
                    return "Published"
                 break
              case 2 :
                    return "Unpublished"
                break
          }
        },
        Delete( id ){
          var _this = this

          axios.get('/api/posts/delete/'+id).then(response => _this.fecth() )
            
        },
        Deletes(){


            var id = this.isChecked

            if( this.isChecked.length == 0 )

                return alert("Select atleast one  post to delete")

            else

                var _this = this
             
                axios.get('/api/posts/delete', { params : { id : id } } ).then(response => {
                  
            
                  _this.fecth()
                  _this.isChecked = [];


                 })

            
        },
        Reset(){
          this.isCheckedAll = false;
          this.isChecked = [];
        },
        Changeto()
        {

        

          var _this = this
          var id = this.isChecked;
          

          /// check if the select value is null
          if(this.selected == 3)
              return

          //// check if select post is null
          if( id.length == 0 )
          {
              this.checked = []
              return alert("Select atleast one post to update")          
          }
          else

              //execute get  request
              axios.get('/api/posts/status/'+this.selected, { params : { id : id } }).then(response => {

                      if(response.data.status == 'success')
                      {
                          _this.fecth();  
                          _this.Reset()
                          return alert(response.data.message)

                      }
                      else
                        
                          _this.Reset()
                         return alert(response.data.message)

              })
        },
        Search(){

           var _this = this

           _this.posts = []

             _this.isLoading = true

             _this.searchState = true
          
           axios.get('/api/posts/search',{params :{ search : _this.inputsearch }})

                 .then(response => {

                    _this.posts = response.data
                    
                    _this.foundCount = response.data.length

                
                    setTimeout(function(){

                      _this.isLoading = false;

                      
                    },1000)

                 })

                 .catch(errors => console.log(errors))
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
       

    }
}
</script>



