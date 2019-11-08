<template>
    <!-- Modal -->
  <div class="modal fade" id="reply"  role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
         
          <h4 class="modal-title">Reply to : {{ guest.fullname }} <span id="model-auhtor"></span></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
         <form id="formreply" @submit.prevent="SubmitReply">     
        <div class="modal-body">              
           
           
               <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                      <label class="bmd-label-floating">Type your reply here...</label>                                     
                        <textarea  rows="5" id="comment" class="form-control" name="content">      
                          
                        </textarea>
                  </div>
                </div>
              </div>

           
        </div>
        <div class="modal-footer">
          <button type="submit"  class="btn btn-default" >Submit</button>
        </div>
         </form>
      </div>
      
    </div>
  </div>
</template>

<script>
export default {
  props : ['guest'],

    data(){
        return{

          person : ''

        }
    },
    methods : {
        SubmitReply()
        {

          var id  = this.guest.id;
   
          var form  =  document.getElementById('formreply')

          let formdata =  new FormData(form)

    
          formdata.append('id',id)         
  

          axios.post('/api/comments/replyByadmin',formdata).then(res => {


             this.$parent.fecth();

            let modal =  document.getElementById('reply')

            $(modal).modal('hide')

           


          })
        }
    }
}
</script>
 
<style>

</style>
