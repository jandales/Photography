<template>
    <div class="readMessageContainer">
        <div class="col-md-12">
                     
                            <ul class="ul-action">
                                 <li>
                                     <a @click="Back()">
                                        <i class="material-icons">
                                        keyboard_backspace
                                        </i>                                                        
                                     </a>
                                </li>
                                <li>
                                     <a>
                                        <i class="material-icons">
                                        refresh
                                        </i>                                                        
                                     </a>
                                </li>
                                <li>
                                      <a>
                                        <i class="material-icons">
                                            reply
                                        </i>                                                        
                                    </a>
                                </li>
                                <li>
                                          <a>
                                                <i class="material-icons">
                                                        archive
                                                </i>
                                         </a>
                                </li>

                                <li>
                                         <a>
                                            <i class="material-icons">
                                                    delete_sweep
                                            </i>
                                        </a>
                                </li> 
                           
                            </ul>
                        
                        
        
       

        <div class="sender">
             <h4 class="sender-subject">{{ message.subject }}</h4>
            <img class="sender-image" width="42" height="42" src="/img/avatar/1543471436.png">
           <div class="sender-info">
                <span class="sender-name">{{ message.fullname }}</span>
                <span class="sender-email"><a>{{ message.email }}</a></span>
                <span class="sender-recieved">{{ message.created_at | moment("MMMM DD YYYY, hh:mm a") }}</span>
           </div>
           <div class="clearfix"></div>
           <div class="sender-message">
               <p>{{ message.content }}</p>
           </div>
        </div>
         </div>
       
    </div>
</template>


<script>
export default {
 
    data(){
        return {
                message : {
                    id : '',
                    fullname : '',
                    email : '',
                    subject : '',
                    content : '',
                    created_at : ''
                }
        }

        },
    methods : {

        Read()
          {
            
          
            let id  = this.$route.params.id           

            
             axios.get('/api/messages/read/'+id).then(res => {
                 
                    this.message.id = res.data.id
                    this.message.fullname = res.data.fullname
                    this.message.email = res.data.email
                    this.message.subject = res.data.subject
                    this.message.created_at = res.data.created_at
                    this.message.content = res.data.message
                                   
             })
          

          
            
          },
          Back(){

              this.$router.push({name : 'inbox'})

          }
    },
    created(){
        this.Read();
    }
    
    
}

</script>








 <style>
 .readMessageContainer
 {
     margin-top: 20px;  
     }

    
    .sender{
       
        width: 100%;
      
      
    }

    .sender-subject{
        margin-left: 52px;
        margin-top: 30px;
        margin-bottom: 30px;
        color: #222 !important;


    }

    

    .sender-image{
     float: left;
    }

    .sender-info{
        float: left;
        margin-top:10px;
        
    }

    .sender span{
        margin-left: 10px;
        
    }

    .sender-name{
        font-weight: bolder;
        color:#222 !important;
    }
    .sender-email{
        color: #a039b5; 
    }
    .sender-recieved{
       float: right;
    }

    .sender-message{
        margin:20px 0px 0px 52px;
    }
 </style>
 
