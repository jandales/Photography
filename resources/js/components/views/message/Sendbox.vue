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
    <a  @click="Resends()">
    <i class="material-icons">
        send
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
        <a  @click="IsTrasheds()">
        <i class="material-icons">
                delete_sweep
        </i>
    </a>
    </li> 

    </ul>

        <div v-if="!Isloading"  aria-label="Page navigation example">
            <ul v-if="pagination.last_page > 1" class="pagination justify-content-end pagination-custom">
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

     
    
    
      <div v-if="!Isloading" class="table-responsive"> 

                <table  class="table">
                    <tbody> 
                        <tr v-if="messagelist.length == 0">
                            <th style="text-align:center;">No sent messages! Send one now!</th>
                        </tr> 
                        <tr v-else  v-for="message in messagelist" :key="message.id">
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

                            <td class="th-message"><a @click="Resend(message.id)" > {{ message.email_to }} </a> </td>                   

                            <td >{{ message.subject }}</td>      

                            <td>{{ message.created_at | moment("MMM D") }}</td>

                            <td class="td-actions text-right">

                            <button @click="ToArchived(message.id)"   rel="tooltip" title="Archive" class="btn btn-primary btn-link btn-sm">
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
            Isloading : false,
            firstload : false
        }        
    },
    methods: {
          LoadMessages( page_url )
          {            

                  var _this = this                        
                // set the page url 
                  page_url = page_url || '/api/messages/sentbox'
                    /// execute the request
                  axios.get( page_url ).then(function(response){
                        // push the response data to messagelist
                         _this.messagelist = response.data.data;
                         // call the method pagination
                         _this.Pagination( response.data )
                         ///set 2 sec timeout 
                        setTimeout(function () {  

                            _this.Isloading = false;
                     
                        }, 1000)
            
                  }); 

               
          },
          Pagination( data )
          {             
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

              this.LoadMessages( this.pagination.next_page_url )
              this.checkedAll = false
              this.checked = []

          },
          PrevPage(){

              this.LoadMessages( this.pagination.prev_page_url )
              this.checkedAll = false
              this.checked = []

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
          Resend(id)
          {
            this.$router.push({name: 'viewcompose', params : { id : id } } )
          },
          Resends()
          {
            if(this.checked.length == 0 || this.checked.length > 1)
            {
                this.checkedAll = false;
                this.checked = []
                return alert('Select one item')
            }
         
            var id =  this.checked[0]

            this.Resend(id)


          },
          ToArchived(id) 
          {
             axios.get('/api/messages/isArchived/'+id).then(res => {
                
                    alert(res.data.message)
                    this.LoadMessages()

                })
          },
          ToArchiveds() 
          {
             if(this.checked.length == 0)
               
                return alert("Select atleast one message")            
           

                axios.get('/api/messages/isArchiveds',{ params : { id : this.checked }}).then(res => {
              
                this.checkedAll = false
                this.checked = []
                this.LoadMessages()

                alert(res.data.message)

             })
          },
          Refresh()
          {

              this.LoadMessages()
              this.checkedAll = false
              this.checked = []

              
          },
          IsTrashed(id){

              var _this =  this

              axios.get('/api/messages/isTrashed/'+id).then(res => {

                  alert(res.data.message)

                  _this.LoadMessages() 
                 

              })
              
          },
          IsTrasheds()
          {
              var _this = this

              if(_this.checked.length == 0)
               
                return alert("Select atleast one message")  
          
                axios.get('/api/messages/isTrasheds',{ params : { id : _this.checked }}).then(res => {
                    alert(res.data.message)
                    _this.Refresh()
                })
          },
    }, 
    created(){

        this.Isloading = true;
        this.LoadMessages();

    }  
}
</script>
<style>
.lds-roller {
  display: inline-block;
  position: relative;
  width: 64px;
  height: 64px;
  left: calc(50% - 64px);
  top: 100px;
}
.lds-roller div {
  animation: lds-roller 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
  transform-origin: 32px 32px;
}
.lds-roller div:after {
  content: " ";
  display: block;
  position: absolute;
  width: 6px;
  height: 6px;
  border-radius: 50%;
  background: #a039b5;
  margin: -3px 0 0 -3px;
}
.lds-roller div:nth-child(1) {
  animation-delay: -0.036s;
}
.lds-roller div:nth-child(1):after {
  top: 50px;
  left: 50px;
}
.lds-roller div:nth-child(2) {
  animation-delay: -0.072s;
}
.lds-roller div:nth-child(2):after {
  top: 54px;
  left: 45px;
}
.lds-roller div:nth-child(3) {
  animation-delay: -0.108s;
}
.lds-roller div:nth-child(3):after {
  top: 57px;
  left: 39px;
}
.lds-roller div:nth-child(4) {
  animation-delay: -0.144s;
}
.lds-roller div:nth-child(4):after {
  top: 58px;
  left: 32px;
}
.lds-roller div:nth-child(5) {
  animation-delay: -0.18s;
}
.lds-roller div:nth-child(5):after {
  top: 57px;
  left: 25px;
}
.lds-roller div:nth-child(6) {
  animation-delay: -0.216s;
}
.lds-roller div:nth-child(6):after {
  top: 54px;
  left: 19px;
}
.lds-roller div:nth-child(7) {
  animation-delay: -0.252s;
}
.lds-roller div:nth-child(7):after {
  top: 50px;
  left: 14px;
}
.lds-roller div:nth-child(8) {
  animation-delay: -0.288s;
}
.lds-roller div:nth-child(8):after {
  top: 45px;
  left: 10px;
}
@keyframes lds-roller {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

</style>




