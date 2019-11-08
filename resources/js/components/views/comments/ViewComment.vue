<template>
    <!-- Modal -->
  <div class="modal fade" id="reply"  role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
         
          <h4 class="modal-title">Reply to : <span id="model-auhtor"></span></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
          
        <div class="modal-body">              
<div class="row mb-2">
<div class="col-md-12">
<div class="form-group">
<label class="bmd-label-floating">Fullname</label>
<input type="text" class="form-control" name="email" v-model="comment.fullname" >
</div> 

</div>
</div>

<div class="row mb-2">
<div class="col-md-12">
<div class="form-group">
<label class="bmd-label-floating">Email</label>
<input type="email" class="form-control" name="email" v-model="comment.email" >
</div> 

</div>
</div>
           
               <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                      <label class="bmd-label-floating">Message</label>                                     
                        <textarea  rows="5" id="comment" class="form-control" name="content"  v-model="comment.message"></textarea>                               
                        
                  </div>
                </div>
              </div>

           
        </div>
        <div class="modal-footer">
          <button type="submit"  class="btn btn-default" data-dismiss="modal" >Close</button>
        </div>
      
      </div>
      
    </div>
  </div>
</template>

<script>


export default {
    props : ['guest'],

    data() {
        return {

            comment : {
                id : '',
                email : '',
                fullname : '',
                email : '',
                message : ''                

            },
            content : '',
            

        }
    
    },
    methods :{
        GetId(id){

            var _this = this

           axios.get('/api/comments/'+ id +'/show').then(res => {

               _this.comment.id = res.data.id

               _this.comment.email = res.data.email

               _this.comment.fullname = res.data.email

               _this.comment.message = res.data.content             

           } )

        }, 
        
    },
    created(){
        this.$parent.$on('send', this.GetId)
    }
  
}
</script>
