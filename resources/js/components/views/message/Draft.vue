<template>
    <div class="row">
            <div class="col-md-12">


                             <div class="form-check form-check-custom" style="margin-top:25px;">
                                <label class="form-check-label">
                                    <input  class="form-check-input" type="checkbox" @click="SelectAll()" v-model="checkedAll" >
                                    <span class="form-check-sign">
                                        <span class="check"></span>
                                    </span>
                                </label>
                            </div>


                            <ul class="ul-action" style="margin:-25px 0px 0px 10px;">
                                <li>
                                     <a  @click="Refresh()">
                                        <i class="material-icons">
                                        refresh
                                        </i>                                                        
                                     </a>
                                </li>
                                <li>
                                      <a  @click="Reply()">
                                        <i class="material-icons">
                                            reply
                                        </i>                                                        
                                    </a>
                                </li>
                                <li>
                                          <a  @click="ToArchiveds()">
                                                <i class="material-icons">
                                                        archive
                                                </i>
                                         </a>
                                </li>

                                <li>
                                         <a  @click="Deletes()">
                                            <i class="material-icons">
                                                    delete_sweep
                                            </i>
                                        </a>
                                </li> 
                           
                            </ul>
                        

            </div>
            <div class="clearfix"></div>
            <div class="table-responsive">

            <table class="table">

            <tbody> 
            <tr   v-for="message in messagelist" :key="message.id" v-bind:class="[unread, (message.isRead == 1) ? read : '0']">


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

              <td class="th-message">To :</td> 

            <td class="th-message"><a @click="Read(message.id)" > {{ message.fullname }} </a> </td>                   

            <td>{{ message.subject }}</td>

            <td>{{ message.message }}</td>

            <td>{{ message.created_at | moment("MMM D") }}</td>

            <td class="td-actions text-right">

            <a rel="tooltip" title="Reply" class="btn btn-primary btn-link btn-sm">
            <i class="material-icons">reply</i>
            </a>

            <button @click="ToArchived(message.id)"   rel="tooltip" title="Archive" class="btn btn-primary btn-link btn-sm">
            <i class="material-icons">archive</i>
            </button>

            <router-link v-if="message.isRead == 0" :to="{name : 'readmessage', params :{id : message.id} }" rel="tooltip" title="Read" class="btn btn-primary btn-link btn-sm">
       
            <i  class="material-icons">drafts</i>
            </router-link>

            <button  v-else @click="Unread(message)" rel="tooltip" title="Read" class="btn btn-primary btn-link btn-sm">
            <i  class="material-icons">markunread</i>
          
            </button>


            <button @click="Delete(message.id)" rel="tooltip" title="Delete" class="btn btn-danger btn-link btn-sm">
            <i class="material-icons">close</i>
            </button>

            </td>
            </tr> 

            </tbody>

            </table>        
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
            read: 'read'
        }        
    },
    methods: {

          LoadMessages()
          {            
    
                  var _this = this;

                  axios.get('/api/messages/inbox').then(function(response){

                         _this.messagelist = response.data;            

                  }); 

               
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
          Delete(id)
          {

          

                var _this = this;                     
    
                axios.get('/api/messages/delete/'+ id).then(function(response){

                
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
          Deletes()
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

   
                axios.get('/api/messages/deletes', {params : { id: listId } } ).then(function(response){

                      console.log(response.data)

                    if(response.data.status == 'success'){

                        _this.LoadMessages()

                        alert(response.data.message)

                    }

                });
                    


            
          },
          Read(id)
          {
            this.$router.push({name: 'readmessage', params : { id : id } } )
          },  
          Unread(message)
          {              
             axios.get('/api/messages/unread/'+message.id).then(res => {
                    console.log(res.data)
                    this.LoadMessages()
                })
          
            
          },
          ToArchived(id) 
          {
            axios.get('/api/messages/toarchived/'+id).then(res => {
                console.log(res.data.message)
                this.LoadMessages()
            })
          },
          ToArchiveds() 
          {
             if(this.checked.length == 0)
               
                return alert("Select atleast one message")            
           

            axios.get('/api/messages/toarchiveds',{ params : { id : this.checked }}).then(res => {
                console.log(res.data.message)
                this.checkedAll = false
                this.checked = []
                this.LoadMessages()
            })
          },
          Refresh(){

              this.LoadMessages()
              this.checkedAll = false
              this.checked = []

              
          },
          Reply(){

          }
          

             

    }, 
    created(){

        this.LoadMessages();

    }
   


}
</script>

<style>

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
        float: left;   
   
       
    }

    .ul-action{
        float: left;
        width: 100%;
        padding:8px;
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
</style>


