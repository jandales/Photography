<template>
    <div class="row">
    <div class="col-md-12">
      <div  v-if="!isLoading" class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title ">List of Comments</h4>
        </div>
        <div class="card-body">

            <div class="form-row align-items-center">
                <div class="col-auto my-1">
           
                  <select class="custom-select mr-sm-2 changevalue" id="inlineFormCustomSelect" v-model="selected">
                    <option v-for="action in actions" 
                            :key="action.value" 
                            :value="action.value">{{ action.name }}</option>
                  
                  </select>
                </div>
                
                <div class="col-auto my-1">
                  <button @click="SubmitAction()" type="submit" class="btn btn-primary">Submit</button>
                </div>
              
            </div>
        



          <div  class="table-responsive">
            <table v-if="comments.length" class="table">
              <thead class=" text-primary">
                 <th>  
                  <div class="form-check">
                    <label class="form-check-label">
                      <input id="perentCheckbox" class="form-check-input"  type="checkbox" @click="SelectAll()" v-model="isCheckedAll">
                      <span class="form-check-sign">
                        <span class="check"></span>
                      </span>
                    </label>
                  </div>
                </th>
                <th>Name</th>
                <th>Comment</th>                                        
                <th>Submitted on</th>
              </thead>
              <tbody>              
                
              
   
                    <tr v-for="comment in comments" :key="comment.id">
                         <td> 
                      <div class="form-check">
                        <label class="form-check-label">
                        <input name="checkbox" id ="#" class="form-check-input" type="checkbox" v-bind:value="comment.id"   v-model="isChecked">
                          <span class="form-check-sign">
                            <span class="check"></span>
                          </span>
                        </label>
                      </div>
                    </td>
                      <td class="author" style="width=50%;">
                       <div>
                          <strong>
                              <!-- <img  class="pull-left" height="32px" src="{{asset('material/avatar/avatar.png')}}"/> -->
                               <img  class="pull-left" height="32px" src=""/>
                              <span class="author-name">{{comment.fullname}}</span>
                          </strong>
                          <br>
                        <a href="#">{{comment.email}}</a>
                       </div>
                       
                      </td>
              
                      <td class="comment-author">
                                                          
                            <span v-if="comment.replyto">In Reply to : <a href="#">{{comment.replyto.fullname}}</a></span>  
                            <br>
                            <span class="strong">In Reponse to : <a href="#">{{comment.post.title.substring(0,100)+".."}}</a></span> 
                            <p>{{comment.content.substring(0,100)+".."}}</p>
                       <div class="td-row-action">
                
                        <span v-if="comment.status == 0"><a href="#" class="text-primary"  @click="ApprovedOrUnapproved(1,comment.id)">Approved</a></span>                
                        <span v-else ><a href="#" class="text-warning" @click="ApprovedOrUnapproved(0,comment.id)">Unapproved</a></span>  
                         <span><a href="#" class="text-info" @click="View(comment.id)">View</a></span>
                         <span><a href="#" class="text-info" @click="Reply(comment)">Reply</a></span>
                         <span><a href="#" class="text-danger" @click="Delete(comment.id)">Delete</a></span>
                     
                       </div>
                      </td>

                      <td class="td-submitted">{{ comment.created_at | moment('MMMM DD YYYY hh:ss a') }}</td>  
                   
                    </tr>
       
                
              </tbody>
            </table>

              <div v-else>
                  <p v-if="foundCount == 0" class="empty-list">No list of posts</p>
                </div>

                <div v-if="pagination.last_page > 1 && !searchState" aria-label="Page navigation example">
                <ul  class="pagination justify-content-end pagination-custom">
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

                     



        </div>

       

      </div>

           <div v-else class="spinner">
             <div  class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div> 
         </div> 
         
    </div>
 




<reply-component ref="reply" :guest="comment_id"></reply-component>
<view-component  ref="view" :guest="comment_id" ></view-component>




  </div>

</template>

<script>

import ReplyForm from './Reply.vue'
import View from './ViewComment.vue'

export default {
  
  components : {
    'reply-component' : ReplyForm,
    'view-component' : View

  },
  data(){
        return{
            comments : [],
            replyTo : '',
            isCheckedAll : false,
            isChecked : [],
            isLoading : false,
            pagination : {},
            inputsearch : '',
            searchState : false,
            foundCount : 0,
            selected : 0,
            actions : [

              { name : 'Select Action' , value : 0 },
              { name : 'Approved' , value : 1 },
              { name : 'Unapproved' , value : 2 },
              { name : 'Delete' , value : 3 },

            ],
            comment_id : ''
            
            
       
        
        }        
  },
  methods :{

        fecth( page_url ){

            var _this = this

            
            page_url = page_url || '/api/comments'

            axios.get(page_url).then(response => { 

                    _this.comments = response.data.data                    

                    _this.Pagination(response.data)

                    _this.foundCount = response.data.data.length

                    setTimeout(function(){

                        _this.isLoading = false

                    },1000)

            })
        },
        Pagination( data ){

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

              this.fecth( this.pagination.next_page_url )

          },
        PrevPage(){

              this.fecth( this.pagination.prev_page_url )

          },     
        RespondTo(id){
            var name = ''

            axios.get('/api/comments').then(response => name = response.data)

            return name
        },
        SelectAll(){
         if(!this.isCheckedAll)
          {
            for(var i = 0; i < this.comments.length;i++)
            {
             this.isChecked.push(this.comments[i].id)
            }
            return
          }
          else
          this.isChecked = []
        },
        ApprovedOrUnapproved(status,id){

          var _this = this 

        

          axios.get('/api/comments/approved/'+ id + '/' + status ).then( res => {
              
             

               alert(res.data.message)

                 _this.fecth() 

          })


         
        


        },
        Delete(id){
             var _this = this 

          axios.get('/api/comments/delete/'+ id ).then( res => {
              
               _this.fecth() 

               alert(res.data.message)

          })
        },
        SubmitAction(){         

        

            switch(this.selected)
            {
              case 0 :
                  alert('bulk action...')
                break

              case 1 :
                  this.ActionApprovedOrUnapproved();
                break

              case 2 :
                  this.ActionApprovedOrUnapproved();
                break

              case 3 :
                  this.ActionDelete()
                break
            }

             this.isCheckedAll = false

               this.isChecked = []

               this.selected = 0


        },        
        ActionDelete(){
         
          var _this = this
            if( _this.isChecked.length == 0 )
              return alert('Select atleast one comment to take action')

          axios.get('/api/comments/deletes',{ params : { id : _this.isChecked }  }).then( res => {
              
              _this.fecth()              
              
              

               alert(res.data.message)

          })
         
        },
        ActionApprovedOrUnapproved(){
         
          var _this = this 

          var status = 1;

          if( this.selected == 2)
          {
            status = 0;
          }

          if( _this.isChecked.length == 0 )
              return alert('Select atleast one comment to take action')

          axios.get('/api/comments/approveds', { params : { id : _this.isChecked, status : status }  }).then( res => {
              
              _this.fecth() 
               alert(res.data.message)

          })


         
        },
        Reply(id)
        {
            this.comment_id = id

            let element = this.$refs.reply.$el

            $(element).modal('show')

        },
        View(id)
        {
           this.click(id)
           this.comment_id = id
           let element = this.$refs.view.$el
           $(element).modal('show')
                    
        },
        click(id){
          
            this.$emit('send',id)  
        }
        
        
  },
    
    created(){

        this.isLoading = true;

        this.fecth();

    }

 
}
</script>

