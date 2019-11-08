$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });


$(document).ready(function(){

  
 
/*
Album event method
*/
$('#album-delete-photos').click(function(){

    var id = [];
    var $div = [];

    $('input[name=checkbox]:checked').each(function(i){
        id[i] = $(this).attr('id');                     
        $div[i] = $(this).closest('.form-check');
    });

    if(id.length == 0)
    {
        alert("Select atleast one image");
    }

    $.ajax({
        type: 'get',
        url: '/ph-admin/albums/deletephotos',
        data:{
            'id' : id,                           
        },
        datatype:"json",
        success:function(response)
        {    
            console.log(response);
            $.each($div, function( i,l ){                
                $(this).parent('.media-item').fadeOut(1000,function(l){ 
                     $(this).remove(); 
                    
            }); });  
            $('.h4-header').text("Photos ("+response+")");
         

         }
     
    });

});
$('#albums-edit').click(function(){

    var id = [];

    $('input[name=checkbox]:checked').each(function(i){
        id[i] = $(this).attr('id');                     
    });

    if(id.length > 1 || id.length == 0)
    {
        alert("Select atlease one album to edit");
        $('input[name=checkbox]').prop('checked', false);
        $('.childCheckbox').closest('tr').removeClass('row-active')
        return;
    }
    window.location.href = '/ph-admin/albums/edit/'+id;
});
$('#albums-delete').click(function(){
    var id = [];

    $('input[name=checkbox]:checked').each(function(i){
        id[i] = $(this).attr('id');                     
    });
         
     if(id.length == 0)
     {
         alert("Select Atleast one album");
         return;
     }

     $.ajax({
        type: 'get',
        url: '/ph-admin/albums/delete',
        data:{
            'id' : id,                           
        },
        datatype:"json",

        success:function(response)
        {
            window.location.href = '/ph-admin/albums';         
        }

    });
});
$('.delete-photos').click(function(){

    var id  = $(this).attr('id');
    div = $(this);
    $.ajax({
       type: 'get',
       url: '/ph-admin/albums/delete/photos/'+id,
       data:{
        id : id,
       },
       datatype:"json",
       success:function(response)
       {    
     
            div.parent('.media-item').fadeOut(1000,function(){
                 div.remove();
                 $('.h4-header').text("Photos ("+response+")");
            });
            

         

              
        }
    
   });
})
/*
end Album event method
*/

/*
Category event method
*/
/// Category Edit method
$('#category-edit').click(function(){

    var id = [];

    $('input[name=checkbox]:checked').each(function(i){
        id[i] = $(this).attr('id');                     
    });

    if(id.length > 1)
    {
        alert("Select one category edit");
        $('input[name=checkbox]').prop('checked', false);
        return;
    }
    window.location.href = '/ph-admin/categories/edit/'+id;
});
/// Category Delete method
$('#category-delete').click(function(){
    var id = [];
    var roleid =  $('.roleitem').val();

    $('input[name=checkbox]:checked').each(function(i){
        id[i] = $(this).attr('id');                     
    });
         
     if(id.length == 0)
     {
         alert("Select Atleast one category");
         return;
     }

     $.ajax({
        type: 'get',
        url: '/ph-admin/categories/delete',
        data:{
            'id' : id,                           
        },
        datatype:"json",

        success:function(response)
        {
            window.location.href = '/ph-admin/categories';         
        }

    });
});


/*
Users event method
*/

//// change user role 
$('#changerole').click(function(){

        var id = [];
        var roleid =  $('.roleitem').val();


        $('input[name=checkbox]:checked').each(function(i){
            id[i] = $(this).attr('id');                     
        });


        if(roleid == 0)  { return; }

        if(id.length == 0)
        {
             alert("Select Atleast one user");
        }

        $.ajax({
            type: 'get',
            url: '/ph-admin/users/role/'+ roleid,
            data:{
                'id' : id,                           
            },
            datatype:"json",
            success:function(response)
            {      
                window.location.href = '/ph-admin/users';
            }
    
        });
});
/// method delete
$('#users-delete').click(function(){
        var id = [];
        var roleid =  $('.roleitem').val();

        $('input[name=checkbox]:checked').each(function(i){
            id[i] = $(this).attr('id');                     
        });
             
         if(id.length == 0)
         {
             alert("Select Atleast one user");
         }

         $.ajax({
            type: 'get',
            url: '/ph-admin/users/delete',
            data:{
                'id' : id,                           
            },
            datatype:"json",
            success:function(response)
            {
                window.location.href = '/ph-admin/users';         
            }
    
        });
});
/// method edit
$('#users-edit').click(function(){

        var id = [];
 
        $('input[name=checkbox]:checked').each(function(i){
            id[i] = $(this).attr('id');                     
        });

        if(id.length > 1)
        {
            alert("Select one user edit");
            $('input[name=checkbox]').prop('checked', false);
            return;
        }

        window.location.href = '/ph-admin/users/edit/'+id;
 });


 /*
Post event method
*/

/// edit event methof
$('#posts-edit').click(function(){
    var id = [];

    $('input[name=checkbox]:checked').each(function(i){
        id[i] = $(this).attr('id');                     
    });


    if(id.length > 1 || id.length == 0){
        alert("Select one post to edit");
        return;
    }

    window.location.href = '/ph-admin/posts/edit/'+id;
    
});

/// delete event method
$('#posts-delete').click(function(){
    var id = [];

    $('input[name=checkbox]:checked').each(function(i){
        id[i] = $(this).attr('id');
    });

    if(id.length == 0)
    {
        alert("Select atlease one post to delete!");
        return;
    }

    
    $.ajax({
        type : 'GET',
        url: '/ph-admin/posts/deletes',
        data:{'id': id},
        dataType: 'Json',
        success:function(response)
        {        
            window.location.href = '/ph-admin/posts'
        },

    });


});

/// delete event method
$('#posts-changestatus').click(function(){
    var id = [];

    var status = $('.changevalue').val();

   
    $('input[name=checkbox]:checked').each(function(i){
        id[i] = $(this).attr('id');
    });

    if(status == 3)
    {
        alert("Select value to change status of the posts");
        return;
    }
    if(id.length == 0)
    {
        alert("Select atlease one post to delete!");
        return;
    }      
    $.ajax({
        type:'get',
        url: '/ph-admin/posts/status/'+ status,
        data:{'id' : id},
        datatype:"json",
        success:function(response)
        {       
     
            window.location.href = '/ph-admin/posts';
        },

    });


});

/// post comment
/// edit event methof
$('#posts-comments').click(function(){
    var id = [];

    $('input[name=checkbox]:checked').each(function(i){
        id[i] = $(this).attr('id');                     
    });


    if(id.length > 1 || id.length == 0){
        alert("Select one post to edit");
        return;
    }

    window.location.href = '/ph-admin/comments/create/'+id;
    
});




/////  

$('#cmdCommand').click(function(){
    var id = getId()[0];
    var tr = getId()[1];
    var status = $('.changevalue').val();




    // $('input[name=checkbox]:checked').each(function(i){
    //     id[i] = $(this).attr('id');                     
    // });


    if(id.length == 0)
    {
        alert("Select atleat one comment to item to update");
        return;  
    }
       

    switch(status)
    {
        case "0":  
                 updatestatus(status,id);        
            break;
        case "1":
                 updatestatus(status,id);
            
            break;
        case "2":
                deleteComment(id);
            break;      
  
    }

    $.each(tr, function( i,l ){
                
        $(this).find('td').fadeOut(1000,function(l){ 
           $(this).remove();                
           $('input[name=checkedall]').prop('checked', false); // Unchecks it  
          
        }); 
    
    
    });

   

  
});

//// function Approved()
function updatestatus(status,id)
{
   
    $.ajax({
        type:'get',
        url:'/ph-admin/comments/status/'+ status,
        data: {'id':id},
        dataType: 'json',
        success:function(response){
            console.log(response);
        },
});

}

function deleteComment(id)
{
    $.ajax({
        type:'get',
        url:'/ph-admin/comments/delete',
        data: {'id':id },
        dataType: 'json',
        success:function(response){
            console.log(response);
        },
});
}

//// get value from checkboxes
function getId()
{
    id = [];
    tr = [];

    $('input[name=checkbox]:checked').each(function(i){
        id[i] = $(this).attr('id');                     
        tr[i] = $(this).closest('tr');
    });

    data = [id,tr];
    return data;

}



$('.linkReply').click(function(){
    var id = $(this).attr('id');
    var author = $('.author-name').text();

    $.ajax({

        type:'get',
        url: '/ph-admin/comments/'+ id +'/show',
        data:{id:id},
        dataType: 'json',
        success:function(response){
            $('#model-auhtor').text(response['fullname']);
            $("#fullname").val(response["fullname"]);
            $("#email").val(response["email"]);
            $('#respondtoID').val(response['id']);
            $("#ReplyModal").modal();
        }   

    });

$('#btnReply').click(function(){
 

        var id  = $('#respondtoID').val();
   

   
        $.ajax({
            type: 'POST',
            url: '/ph-admin/comments/replyAdmin',
            data:{
                'id' : id,
                'content' : $('#comment').val(),
                'fullname' : $('input[name=fullname]').val(),
                'email' : $('input[name=email]').val(),
                'respondToId' : $('input[name=respondID]').val(),              
            },        
            datatype: 'json',
            success:function(response){
                    console.log(response);
            }
        });

});




  
   
});





});