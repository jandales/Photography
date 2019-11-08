<template>

           <form @submit.prevent="createMessage">

   
  
<div class="row mb-2">
    <div class="col-md-12">
           
    </div>
</div>

<div class="row mb-2">
    <div class="col-md-12">
        <div class="form-group">
            <label class="bmd-label-floating">To : Email</label>
            <input type="email" class="form-control" name="email" v-model="message.email">
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

   <button type="submit" class="btn btn-primary pull-right">Submit</button>
    <div class="clearfix"></div>
                         
                

     
      
        </form>
    
</template>

<script>
export default {
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
            errors : []
        }
    },
    methods :{
        
        createMessage(){
            
            var _this = this

            axios.post('/api/messages/SendbyAdmin',this.message).then(res => {
                
                alert(res.data.message)

                this.message.email = ''

                this.message.subject = ''

                this.message.message = '' 

                _this.$router.push({ name : 'inbox' })

            }).catch(err => {

                if(err.response.status == 422){
                    this.errors = err.response.data.errors
                   
                }
            } )
        }
    }
}
</script>

