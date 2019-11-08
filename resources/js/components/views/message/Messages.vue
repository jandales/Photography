<template>

    <div class="row">
        <div v-if="!isLoading" class="col-md-12">
                 <div class="card">
        <div class="card-header card-header-primary">
          <div class="form-row align-items-center">
              <div class="col-9 my-1">
                  <h4 class="card-title">List of Message</h4>
              </div>
                <form @submit.prevent="SearchUsers"> 
                    <div class="input-group no-border">

                    <input type="text" name="search" value="" class="form-control txtsearch" placeholder="Search..." v-model="search">
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

     
            <div class="row">

            
        <div class="col-md-3">
               <div class="sidebar-wrapper">  
     <ul class="nav">
         <li>
             <a href="#" data-toggle="modal" data-target="#createmessage" class="a-item compose">
                 <i class="material-icons">create</i>Create Message
             </a>
        </li>
        <li>
             <router-link to="/ph-admin/messages/compose" class="a-item compose">
                 <i class="material-icons">create</i>Compose
             </router-link>
        </li>
         <li >
             <router-link to="/ph-admin/messages/inbox" class="a-item a-relative">
                 <i class="material-icons">move_to_inbox</i>Inbox <span v-if="inboxcount > 0" class="inbox-count">{{ inboxcount }}</span>
             </router-link>
        </li>
         <li>
             
              <router-link to="/ph-admin/messages/sentbox" class="a-item">
                 <i class="material-icons">send</i>Sent
              </router-link>
    
        </li>
  
         <li>
              <router-link to="/ph-admin/messages/archived" class="a-item">
                 <i class="material-icons">archive</i>Archived
              </router-link>
        </li>

         <li>
              <router-link to="/ph-admin/messages/trash" class="a-item">
                 <i class="material-icons">delete</i>Trash
              </router-link>
        </li>
     </ul>
    </div>
        </div>
       <div class="col-md-9">

         <!-- <message-list></message-list> -->
            <!-- <read-message></read-message> -->
           <router-view></router-view>
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
            messagelist : [],
            checkedAll : false,
            checked : [],
            selected: '0',
            search : '', 
            unread : 'unread',
            read: 'read' ,
            component : 'read-message' ,
            inboxcount : 0,
            isLoading : false 

            
        }        
    },   

    created(){
     

        this.isLoading = true;
      
         setTimeout(() => {           
           this.isLoading = false        
            
         },5000)

    }
    


}
</script>

<style>   

   .nav{

        display: block;
        margin-top: 20px;
    }
    .nav .a-item{
        display:block;
        margin-top:10px;
        padding:  10px ;
        border-radius: 5px;
       
    }
    .nav .a-item i{
        margin: 10px;
    }
    .nav .item{
        cursor: pointer;
        color: #a039b5 !important;
       
    }   
    .nav .a-item:hover, {
        background: #eee;
       
    }
  

    .nav .compose{
        cursor: pointer;
        background: #a039b5;
        box-shadow: #222;
        color: #fff !important;
    }

     .nav .compose:hover{
        background: #a039b5;
        box-shadow: #222;
          color: #fff !important;
    }

    .a-relative{
        position: relative !important;
    }
    
    .nav .a-item .inbox-count{
        position: absolute;
        right: 15px;
        top:20px;
        color:#fff;
        font-size: 13px; 

   
    }
</style>



