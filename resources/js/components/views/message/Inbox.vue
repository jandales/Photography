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
                                <a  @click="Reply">
                                <i class="material-icons">
                                    reply
                                </i>                                                        
                                </a>
                                </li>
                                <li>
                                <a  @click="MoveToArchiveds()">
                                        <i class="material-icons">
                                                archive
                                        </i>
                                </a>
                                </li>

                                <li>
                                <a  @click="MoveToTrashs()">
                                    <i class="material-icons">
                                            delete_sweep
                                    </i>
                                </a>
                                </li> 
                            </ul>

                            <div v-if="!Isloading" aria-label="Page navigation example">
                                <ul  v-if="pagination.last_page > 1" class="pagination justify-content-end pagination-custom">
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
                    <div class="clearfix"></div>

                <div v-if="!Isloading" class="table-responsive">
                    <table class="table">
                        <tbody> 

                        <tr v-if="messagelist.length == 0">
                            <th style="text-align:center;">No message in box</th>
                        </tr>
                        <tr  v-else v-for="message in messagelist" :key="message.id" v-bind:class="[unread, (message.isRead == 1) ? read : '0']">


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

                        <td class="th-message"><a @click="Read(message.id)" > {{ message.fullname }} </a> </td>                   

                        <td>{{ message.subject }}</td>

                        <td>{{ message.message }}</td>

                        <td>{{ message.created_at | Todate() }}</td>

                        <td class="td-actions text-right">

                        <a rel="tooltip" title="Reply"   @click="Reply" class="btn btn-primary btn-link btn-sm">
                        <i class="material-icons">reply</i>
                        </a>

                        <button @click="MoveToArchived(message.id)"   rel="tooltip" title="Archive" class="btn btn-primary btn-link btn-sm">
                        <i class="material-icons">archive</i>
                        </button>

                        <router-link v-if="message.isRead == 0" :to="{name : 'readmessage', params :{id : message.id} }" rel="tooltip" title="Read" class="btn btn-primary btn-link btn-sm">       
                        <i  class="material-icons">markunread</i>
                        </router-link>

                        <button  v-else @click="Unread(message)" rel="tooltip" title="Mark as Unread" class="btn btn-primary btn-link btn-sm">
                        <i  class="material-icons">drafts</i>
                    
                        </button>


                        <button @click="MoveToTrash(message.id)" rel="tooltip" title="Delete" class="btn btn-danger btn-link btn-sm">
                        <i class="material-icons">close</i>
                        </button>

                        </td>
                        </tr> 

                        </tbody>
                    </table>        
                </div>

                 <div v-else class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>  
            </div>


            

             <create-message id="createmessage"></create-message>

             <reply-component  ref="replyModal"></reply-component>


            
    </div>
</template>

<script>
import Reply from './Reply.vue'
var moment = require('vue-moment');
import CreateMessage from './CreateMessage.vue'
export default { 

    components:{  
        'reply-component' : Reply,
         'create-message' : CreateMessage, 
    },
    data(){
        return {

            message_id : '',
            messagelist : [],
            checkedAll : false,
            checked : [],
            unread : 'unread',
            read: 'read',
            pagination : {},
            modalShow : false,
            Isloading : false,

        }        
    },
    methods: {                
          LoadMessages (page_url )
          {            
                page_url = page_url ||  '/api/messages/inbox'
                
                  var _this = this
                  
                  axios.get(page_url).then(function(response){

                         _this.messagelist = response.data.data  
                     
                         _this.Pagination(response.data)   
                         
                         setTimeout(function(){

                             _this.Isloading = false

                         },2000)

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
          SelectPage( page ){

              this.pagination.current_page = page
              
              var page_url = this.pagination.path+"?page="+page

              this.LoadMessages(page_url)         

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
          MoveToTrash( id )
          {

          

                var _this = this;                     
    
                axios.get('/api/messages/isTrashed/'+ id).then(function(response){

                
                if(response.data.status == 'success')
                {

                        _this.LoadMessages()

                        alert(response.data.message)

                        return

                }

                else

                  alert(response.data.message)



                });

          },
          MoveToTrashs()
          {


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

                  listId.push(_this.checked[i])

              }

   
                axios.get('/api/messages/isTrasheds', {params : { id: listId } } ).then(function(response){

                  

                    if(response.data.status == 'success'){

                        _this.Refresh();

                        alert(response.data.message)

                    }

                });
                    


            
          },
          Read( id )
          {
            this.$router.push({name: 'readmessage', params : { id : id } } )
          },  
          Unread( message )
          {              
             axios.get('/api/messages/unread/'+message.id).then(res => {
                    console.log(res.data)
                    this.LoadMessages()
                })
          
            
          },
          MoveToArchived( id ) 
          {
            axios.get('/api/messages/isArchived/'+id).then(res => {
                alert(res.data.message)
                this.LoadMessages()
            })
          },
          MoveToArchiveds() 
          {

              var _this = this

             if(this.checked.length == 0)
             {
                this.checkedAll = false

                this.checked = []

                return alert("Select atleast one message") 
             }

                axios.get('/api/messages/isArchiveds',{ params : { id : this.checked }}).then(res => {
                        alert(res.data.message)
                        _this.Refresh();
                })
          },
          Refresh(){

              this.LoadMessages()
              this.checkedAll = false
              this.checked = []

              
          },
          Reply(){

             if( this.checked.length == 0 || this.checked.length > 1 )
             {
                alert("Select one message to reply")

                this.checked = []

                this.checkedAll = false;
                
                return
             }

                 this.click(this.checked)
               
                 this.checked = []

                 this.checkedAll = false;

                 let element = this.$refs.replyModal.$el

                 $(element).modal('show')

        
            
             
          },
          click: function( id ) {
                 this.$emit('SendId', id);
          },
      
        
    }, 
    created(){

        this.Isloading = true
        this.LoadMessages();
    
      

    } 

}
</script>

<style>

    .top-navigation-wrapper{
        background: #eee;
        display: grid;
        grid-template-columns: auto auto auto;       
        padding: 10px 10px 0px 10px;
    }

    tr td a{
        cursor: pointer;
    }
  
    .unread{
        background: #eee;
    }
    .read{
        background: #fff;
    }

    .unread td{
        color: #222 !important;
    }

    .form-check-custom{
        margin-top: 0px !important;
        padding: 0px !important;
   
       
    }

    .ul-action{       
   
        padding:8px;
        margin-top:2px;
        margin-left: -60px;

    }



    .ul-action li{
        list-style: none;
        display: inline;
        margin: 10px;
        padding: 10px 5px;

    }

    .ul-action li a{
        cursor: pointer;
        color: #a039b5 !important;
    }
    .ul-action li:hover, .ul-action li:hover a {
        background: #a039b5;
        color: #fff !important;
    }

    .active{
           background: #a039b5;
    }

     .nav{

        display: block;
        margin-top: 20px;
    }
    .nav .li-item{
        margin-top:10px;
        padding:  5px;
        border-radius: 5px;
       
    }
    .nav .li-item i{
        margin: 10px;
    }
    .nav .item{
        cursor: pointer;
        color: #a039b5 !important;
       
    }
    .nav .li-active, .nav .li-active .item{
        color: #fff !important;
        background-color: #a039b5 !important;
    }
    .nav .li-active.item{
        color: #fff !important;
       
    }
   
    .nav .li-item:hover{
        background: #eee;
    }


    .pagination-custom{
        margin-top: 8px;
    }

    .page-item span{
        position: relative;
        display: block;
        padding: 0.5rem 0.75rem;
        margin-left: 0;
        margin-top: 5px;
        line-height: 1.25;
        color: #222;
        background-color: transparent;
        border: 0 solid #dee2e6;
    }
</style>


