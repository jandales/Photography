<template>

   <div class="row">
       <div v-if="!isLoading" class="col-md-12">
           <div class="card">
        <div class="card-header card-header-primary">
          <div class="form-row align-items-center">
              <div class="col-9 my-1">
                  <h4 class="card-title">List of Users</h4>
              </div>
                <form @submit.prevent="SearchUsers"> 
                    <div class="input-group no-border">

                    <input type="text" id="search" name="search" value="" class="form-control txtsearch" placeholder="Search" v-model="search">
                      <button type="submit" class="btn btn-white btn-round btn-just-icon">
                        <i class="material-icons">search</i>
                        <div class="ripple-container"></div>
                      </button>
                    </div>
                </form> 
          </div>

        

        </div>
        <!-- card body -->
        <div class="card-body">

            <div class="form-row align-items-center">
                <div class="col-auto my-1">
           
                  <select class="custom-select mr-sm-2 roleitem" id="inlineFormCustomSelect" v-model="selected">
                    <option v-for="option in options"  :key="option.value" v-bind:value="option.value">
                        {{ option.text }}
                    </option>
                    
                  </select>
                </div>
                
                <div class="col-auto my-1">
                  <button @click="ChangeRole()" id="changerole" type="submit" class="btn btn-primary">Submit</button>
                </div>              

                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                    <div class="btn-group mr-2" role="group" aria-label="First group">
                    <router-link to="/ph-admin/users/create" class="btn btn-primary">
                        Create                        
                    </router-link>
                    <button  @click="edit()" type="button" class="btn btn-primary">Edit</button>
                    <button  @click="Deletes()" id="users-delete" type="button" class="btn btn-primary">Delete</button>
                  </div>                                     
                </div>
            </div>

          <br>
             <div v-if="!isLoading && searchState">
                  <p>Search found : {{ foundCount }} of {{ search }}   <span @click="CloseSearch" class="btn btn-span btn-danger"><i class="material-icons">close</i></span> </p>
             </div>
        
          <div    class="table-responsive">
            <table v-if="UsersList.length" class="table">
              <thead class=" text-primary">
                <th>  
                  <div class="form-check">
                    <label class="form-check-label">
                      <input id="perentCheckbox" class="form-check-input" type="checkbox" @click="SelectAll()" v-model="checkedAll" >
                      <span class="form-check-sign">
                        <span class="check"></span>
                      </span>
                    </label>
                  </div>
                </th>
                <th>Username</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Post</th>
                <th></th>
            </thead>
              <tbody> 
                
                 <tr v-for="User in UsersList" :key="User.id">                    

                    <td> 
                       <div class="form-check">
                        <label class="form-check-label">
                        <input name="checkbox" id ="" class="form-check-input childCheckbox" type="checkbox" v-bind:value="User" v-model="checked">
                        <span class="form-check-sign">
                            <span class="check"></span>
                        </span>
                        </label>
                    </div>
                    </td>

                    <td>{{User.username}}</td>

                    <td>{{User.firstname + " " + User.lastname}}</td>

                    <td>{{User.email}}</td>

                    <td>{{Role(User.role)}}</td>

                    <td>{{User.postcount.length}}</td>

                    <td class="td-actions text-right">

                        <router-link :to="{ name: 'useredit', params: { id: User.id }}"   rel="tooltip" title="Edit" class="btn btn-primary btn-link btn-sm">
                          <i class="material-icons">edit</i>
                        </router-link>

                        <button @click="Delete(User.id)" rel="tooltip" title="Delete" class="btn btn-danger btn-link btn-sm">
                          <i class="material-icons">close</i>
                        </button>

                     </td>
                  </tr> 
              
              </tbody>


           
            </table> 

              <div v-else>
                  <p v-if="foundCount == 0" class="empty-list">No users</p>
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
     <!-- / card body -->

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
            UsersList : [],
            checkedAll : false,
            checked : [],
            selected: '0',
            search : '',
            options: [
              { text: 'Change role to', value: '0' },
              { text: 'Administrator', value: '1' },
              { text: 'Editor', value: '2' },
              { text: 'Author' , value : '3' }
            ],
            isLoading : false,
            pagination : {},  
            searchState : false,
            foundCount : 0                   
            
        }        
    },
    methods: {
          fetch( page_url ){            

            page_url = page_url || '/api/users'
    
            var _this = this;
                      axios.get(page_url).then(function(response){

                          _this.UsersList = response.data.data;

                          _this.foundCount = response.data.data.length

                          _this.Pagination(response.data)
                       

                          setTimeout(function(){

                              _this.isLoading = false

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

              this.fetch( this.pagination.next_page_url )

          },
        PrevPage(){

              this.fetch( this.pagination.prev_page_url )

          },   
          Role(id)
          {
              switch(id)
              {
                  case 1:
                    return "Administrator";
                  case 2:
                      return "Editor";
                  case 3:
                      return "Author";

              }
          },
          edit()
          {
                    if(this.checked.length > 1 || this.checked.length == 0 )
                    {
                      alert("Select atleast one user  to edit")
                      this.checked = []
                      return;
                    }   

                    var id = this.checked[0].id
                    this.$router.push({ path : `users/edit/${id}`})
          },
          SelectAll()
          { 
              if(!this.checkedAll)
              { 
                  for(var key in this.UsersList)
                    {
                        this.checked.push(this.UsersList[key])           
                    }
              
                  return
              }
              else
                    this.checked = [];
          },
          ChangeRole()
          {

            var _this = this
            var id = []

            if(this.checked == 0){
              alert("Select atlease one user")
              return;
            }
            

            for(var i = 0;i < this.checked.length; i++)
            {
                id.push(this.checked[i].id)
            }
          

            var role = this.selected;
        

            axios.get('/api/users/role/'+ role,{params : { id : id } }).then(function(response){

                _this.fetch()

                _this.checked = []
                
                if(response.data.status == "success")
                {
                  alert(response.data.message);
                }
            });


        
          },
          Delete(id){

                var _this = this;                     
    
                axios.get('/api/users/delete/'+id).then(function(response){

                
                if(response.data.status == 'success'){
                        _this.fetch()
                        alert(response.data.message)
                        return
                }
                else

                  alert(response.data.message)



                });
          },
          Deletes(){


             if(this.checked.length == 0 )
             {
                alert("Select atleast one user  to delete")
                this.checked = []
                return
             }
     
        
        
              var _this = this;                     
              var listId = []

              for(var i = 0; i < _this.checked.length; i++)
              {
                  listId.push(_this.checked[i].id)
              }


   
                axios.get('/api/users/delete', {params : { id: listId } } ).then(function(response){

              
                    if(response.data.status == 'success'){

                        _this.fetch()
                        alert(response.data.message)

                    }

                });
                    


            
          }, 
          SearchUsers()
          {
              var _this = this;

              if(_this.search == '' || _this.search == 'Search')
              {
              
                document.getElementById('search').focus()

                alert('Search input must not empty')
                
                return;
              }

              axios.get('/api/users/search',{ params : { search : this.search } }).then(function(response){

                    _this.searchState = true

                    _this.UsersList =  response.data

                    _this.foundCount = response.data.length

                    setTimeout(function(){

                      _this.isLoading = false

                    },1000)


              });
          },
         CloseSearch(){

          this.searchState = false;

          this.search = ''

          this.fetch();

        }
            

    }, 
    created(){

        this.isLoading = true;

        this.fetch()
    }
   


}
</script>

