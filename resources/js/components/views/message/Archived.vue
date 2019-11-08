<template>
    <div class="row">
            <div class="col-md-12">

    <div class="top-navigation-wrapper">
                             <div class="form-check form-check-custom">
                                <label class="form-check-label">
                                    <input  class="form-check-input" type="checkbox" @click="SelectAll()" v-model="checkedAll" >
                                    <span class="form-check-sign">
                                        <span class="check"></span>
                                    </span>
                                </label>
                            </div>


                            <ul class="ul-action">
                                <li>
                                     <a  @click="Refresh()">
                                        <i class="material-icons">
                                        refresh
                                        </i>                                                        
                                     </a>
                                </li>                          
                                <li>
                                          <a  @click="Unarchiveds()">
                                                <i class="material-icons">
                                                        archive
                                                </i>
                                         </a>
                                </li>

                                <li>
                                         <a  @click="isTrasheds()">
                                            <i class="material-icons">
                                                    delete_sweep
                                            </i>
                                        </a>
                                </li> 
                           
                            </ul>

                            
       <div   aria-label="Page navigation example">
            <ul v-if="pagination.last_page > 1" class="pagination justify-content-end pagination-custom">
                <li class="page-item"><span>Page : {{ pagination.current_page}} of {{ pagination.last_page }}</span></li>
                <li  :class="[ { disabled : !pagination.prev_page_url } ]" class="page-item " >
                        <a  @click="PrevPage()" class="page-link"><i class="material-icons">navigate_before</i></a>
                </li>
                <!-- <li v-for="(page,index) in pagination.last_page" :key="index" :class="[pagination.current_page == (index + 1) ? 'active' : '']" class="page-item"><a  class="page-link" href="#" @click="SelectPage(index + 1)">{{ index + 1 }}</a></li> -->

                <li :class="[ { disabled : !pagination.next_page_url }  ]" class="page-item">
                    <a @click="NextPage()" class="page-link" ><i class="material-icons">navigate_next</i></a>
                </li>
            </ul>
        </div>


            </div>

        <div v-if="!isLoading" class="table-responsive">

            <table class="table">

            <tbody> 

          <tr v-if="messagelist.length == 0">
                <th style="text-align:center;">No messages in archived</th>
            </tr> 

            <tr  v-else  v-for="message in messagelist" :key="message.id">


            <td> 
            <div class="form-check">
            <label class="form-check-label">
            <input name="checkbox" id ="" class="form-check-input" type="checkbox" v-bind:value="message.id" v-model="checked">
            <span class="form-check-sign">
            <span class="check"></span>
            </span>
            </label>
            </div>
            </td>             

            <td class="th-message"><a> {{ message.fullname }} </a> </td>                   

            <td>{{ message.subject }}</td>

            <td>{{ message.message }}</td>

            <td>{{ message.created_at | moment("MMM D") }}</td>

            <td class="td-actions text-right">
           

            <button @click="Unarchived(message.id)"   rel="tooltip" title="Unarchive" class="btn btn-primary btn-link btn-sm">
            <i class="material-icons">archive</i>
            </button>

          


            <button @click="IsTrashed(message.id)" rel="tooltip" title="Delete" class="btn btn-danger btn-link btn-sm">
            <i class="material-icons">close</i>
            </button>

            </td>
            </tr> 

            </tbody>

            </table>        
            </div>
                 <div v-else class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>  
            </div>
      
          
    </div>
</template>


<script>


export default {
    name : 'MessageList',
    data(){
        return {
            messagelist : [],
            checkedAll : false,
            checked : [],
            unread : 'unread',
            read: 'read',
            pagination : {},
            isLoading : false
        }        
    },
    methods: {

          LoadMessages( page_url )
          {            
                page_url = page_url || '/api/messages/archived'

                var _this = this;

                axios.get(page_url).then(function(response){

           
                     _this.messagelist = response.data.data

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

                  data : data

              }

              this.pagination = pagination



          },         
          NextPage(){

              this.LoadMessages(this.pagination.next_page_url)

          },
          PrevPage(){

              this.LoadMessages(this.pagination.prev_page_url)

          },                         
          SelectAll()
          { 
              if(!this.checkedAll)
              { 
                  for(var key in this.messagelist)
                  {
           
                      this.checked.push(this.messagelist[key].id)  

                  }
              
                  return
              }

              else

                  this.checked = [];
          },         
          IsTrashed(id){
              axios.get('/api/messages/isTrashed/'+id).then(res => {
                   alert(res.data.message)
                   this.LoadMessages();
                   } )
          },
          IsTrasheds()
          {
              if(this.checked.length == 0)
               
                return alert("Select atleast one message")  
          
                axios.get('/api/messages/isTrasheds',{ params : { id : this.checked }}).then(res => {
               
                    this.checkedAll = false
                    this.checked = []
                    this.LoadMessages()
                })
          },
          Read(id)
          {
            this.$router.push({name: 'readmessage', params : { id : id } } )
          },  
          Unread(message)
          {              
             axios.get('/api/messages/unread/'+message.id).then(res => {
                    
                    this.LoadMessages()

                })
          
            
          },
          Unarchived(id) 
          {
                axios.get('/api/messages/unarchived/'+id).then(res => {
                    alert(res.data.message)
                    this.LoadMessages()
                })
          },
          Unarchiveds() 
          {
             if(this.checked.length == 0)
             {
                this.checkedAll = false
                this.checked = []
                return alert("Select atleast one message")            
            }

            axios.get('/api/messages/unarchiveds',{ params : { id : this.checked }}).then(res => {
                
                this.checkedAll = false
                this.checked = []
                this.LoadMessages()

                alert(res.data.message)
            })
          },
          Refresh(){

              this.LoadMessages()
              this.checkedAll = false
              this.checked = []

              
          },
                     

    }, 
    created(){
        this.isLoading = true;
      
            this.LoadMessages();

      

      

    }
   


}
</script>
