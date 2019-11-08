<template>
    
     <!-- modal Edit album -->
  
    <div class="modal fade" id="reply" role="dialog">
    <div class="modal-dialog">
      
      <!-- Modal content-->
      <div class="modal-content">
           <form id="editform" @submit.prevent="CreateMessage" enctype="multipart/form-data">
        <div class="modal-header">
         
          <h4 class="modal-title">Reply to : <span id="model-auhtor"></span></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          
          
<div class="row mb-2">
    <div class="col-md-12">
        <div class="form-group">
            <label class="bmd-label-floating">To : Email</label>
            <input type="email" class="form-control" name="email" v-model="message.email" >
        </div> 
        <div v-if="errors.email" class="alert alert-warning">{{errors.email[0]}}</div>     
    </div>
</div>

<div class="row mb-2">
    <div class="col-md-12">
        <div class="form-group">
            <label class="bmd-label-floating">Subject</label>
            <input type="text" class="form-control" name="subjet" v-model="message.subject">
        </div>  
         <div v-if="errors.subject" class="alert alert-warning">{{errors.subject[0]}}</div>     
    </div>
</div>

<div class="row mb-2">
    <div class="col-md-12">
        <div class="form-group">            
            <label class="bmd-label-floating">Type your Message here...</label>                                     
        <textarea rows="10" id="comment" class="form-control" name="content" v-model="message.message"> </textarea>    
        </div>       
    </div>
</div>  
          

           
     
                         
                            <div class="clearfix"></div>
                

        </div>
        <div class="modal-footer">
            <button class="btn btn-primary">
                             Submit
            </button>
        </div>
        </form>
      </div>
       
    </div>
  </div>

</template>

<script>
export default {
     props: ['message_id'],    
     data(){
       return{
          message :{
                fullname : '',
                email : '',
                subject :'',
                message : '',                
                type : '0',
                isRead : '0',
                status : '0'
            },
            errors : [],
            messageid : this.message_id
           
       }
     },
     methods :{

         GetId(value){

             this.messageid = value;

             this.loadMessage(value)
       
         
         },
          loadMessage(id){
            
           this.message.email = '' 

            axios.get('/api/messages/show/'+id).then(res => {
                
                this.message.email = res.data.email_from

                this.message.subject = ''

                this.message.message = ''
               

            })

        },
        CreateMessage(){
            
            var _this = this

            axios.post('/api/messages/SendbyAdmin',this.message).then(res => {
                
                alert(res.data.message)

                this.message.email = ''

                this.message.subject = ''

                this.message.message = ''             
                

            }).catch(err => {

                if(err.response.status == 422){

                    this.errors = err.response.data.errors
                   
                }
            } )
        },
     },
     created(){

         this.$parent.$on('SendId', this.GetId)
         
     }
}
</script>

