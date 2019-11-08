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
                                          <a  @click="Restores()">
                                                <i class="material-icons">
                                                       restore
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

       <div aria-label="Page navigation example">
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

                    <div v-if=" !Isloading " class="table-responsive">

                        <table class="table">

                            <tbody> 

                            <tr v-if="messagelist.length == 0">
                                <th style="text-align:center; margin-top: 50px;">No messages in Trash</th>
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
                                    <td v-if="message.type == 1">To :</td>
                                    <td v-else>From :</td>
                                    <td class="th-message"><a> {{ message.fullname }} </a> </td>                   

                                    <td>{{ message.subject }}</td>

                                    <td>{{ message.message }}</td>

                                    <td>{{ message.created_at | moment("MMM D") }}</td>

                                    <td class="td-actions text-right">

                                    <button @click="Restore(message.id)"   rel="tooltip" title="Restore" class="btn btn-primary btn-link btn-sm">
                                    <i class="material-icons">restore</i>
                                    </button>

                                    <button @click="Delete(message.id)" rel="tooltip" title="Delete" class="btn btn-danger btn-link btn-sm">
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
            Isloading : false
        }        
    },
    methods: {

          LoadMessages( page_url ){            
                page_url = page_url || '/api/messages/trash'

                var _this = this               

                axios.get( page_url ).then(function(response){

                        _this.messagelist = response.data.data;

                        _this.Pagination( response.data )                       

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

              }

              this.pagination = pagination
          
                   
              
          },         
          NextPage(){

              this.LoadMessages( this.pagination.next_page_url )

          },
          PrevPage(){

              this.LoadMessages( this.pagination.prev_page_url )

          },                
          SelectAll(){ 
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
          Restore( id ){
                var _this =  this

                     axios.get('/api/messages/restore/'+id).then(res => {
                         alert(res.data.message)
                         _this.LoadMessages();
                   } )
          },
          Restores(){
              var _this =  this 

              if(this.checked.length == 0)
              {
                    this.checkedAll = false;
                    this.checked = []
                    return alert("Select atleast one message")  
              }
                axios.get('/api/messages/restores',{ params : { id : _this.checked }}).then(res => {
               
                    alert(res.data.message)
                    _this.Refresh()
                })
          },
          Delete( id ){

                    var _this = this
                     axios.get('/api/messages/delete/'+id).then(res => {
                         alert(res.data.message)
                         _this.LoadMessages();
                   } )
          },
          Deletes() {
              var _this = this

              if(_this.checked.length == 0)
               
                return alert("Select atleast one message")  
          
                axios.get('/api/messages/deletes',{ params : { id : _this.checked }}).then(res => {
               
                    alert(res.data.message)
                    _this.Refresh()

                })
          },     
          Refresh(){

              this.LoadMessages()
              this.checkedAll = false
              this.checked = []

              
          },                    

    }, 
    created(){

        this.Isloading = true

        this.LoadMessages();

    }
   


}
</script>

