<template>
    
     <!-- modal Edit album -->
  
    <div class="modal fade" id="createmessage" role="dialog">
    <div class="modal-dialog">
      
      <!-- Modal content-->
      <div class="modal-content">
           <form id="editform" @submit.prevent="CreateMessage" enctype="multipart/form-data">
        <div class="modal-header">
         
          <h4 class="modal-title">Message us<span id="model-auhtor"></span></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          
          <div class="row">
              <div class="col-md-12">
                  <div class="form-group">
                    <label class="bmd-label-floating">Fullname</label>
                    <input type="text" class="form-control" name="fullname" v-model="message.fullname">
                  </div>
              </div>
          </div>

            <div class="row">
              <div class="col-md-12">
                  <div class="form-group">
                    <label class="bmd-label-floating">Email</label>
                    <input type="email" class="form-control" name="email" v-model="message.email">
                  </div>
              </div>
          </div>

            <div class="row">
              <div class="col-md-12">
                  <div class="form-group">
                    <label class="bmd-label-floating">Subject</label>
                    <input type="text" class="form-control" name="subject" v-model="message.subject">
                  </div>
              </div>
           </div>

             <div class="row">
              <div class="col-md-12">
                  <div class="form-group">
                    <label class="bmd-label-floating">Message</label>
                    <textarea rows="10" type="text" class="form-control" name="message" v-model="message.message"></textarea>
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
     data(){
       return{
         message : {
            fullname : '',
            email : '',
            subject : '',
            message : ''
         }
       }
     },
     methods :{
       CreateMessage(){
          
            axios.post('/api/messages/sendbyClient',this.message).then(res => {
              alert(res.data.message)
              this.$parent.$parent.inbox();
              this.$parent.LoadMessages();
          
            })
            

       }
     }
}
</script>

