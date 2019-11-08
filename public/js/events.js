

$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $(document).ready(function(){
var fileToUpload = [];
function readURL(input) {

    var file = input.files[0];
    
   if(file.size >= 16777216)
   {
    alert("File to Big");
     $("#form").get(0).reset(); //the trickyf part is to "empty" the input file here I reset the form.
     return;
   }
   if(!file.type.match('image/jp.*')) {
     alert("Invalid Format");
     $("#form").get(0).reset(); //the tricky part is to "empty" the input file here I reset the form.
     return;
   }



if (!input.files && !input.files[0]) 
    return;

    var reader = new FileReader();

    reader.onload = function (e) {
        $('#image').attr('src', e.target.result);
        $('.featured-image').addClass('visible');
     
    }  

    reader.readAsDataURL(input.files[0]);

    }
    
    // var files = filearray.splice(0,0,1);
    // console.log(input.files);


///// event change to upload image
$('#feature-image').change(function(){
   
    readURL(this); 

});

/// remove image in feature-image
$('#remove-feature-image').click(function(){
    $('#feature-image').val(null);
    $('.featured-image').removeClass('visible');
  
});




$('#ImageUploader').change(function(e)
{
    // var fileArray= [];
    // $.each(e.target.files, function(index, value){
    //     //Add your condition for allowing only specific file
    //     var fileReader = new FileReader(); 
    //     fileReader.readAsDataURL(value);
    //     fileToUpload.push(
    //         index,
    //         fileReader);
          
    //     /// set name of file;
    //     name = value.name;
    //     /// set size of file
    //     size = value.size;

    //     tr = $('<tr><td>'+ name +'</td><td>'+ size +'</td><td>0%</td><td class="td-actions text-right"> <a href="#" id="'+ index +'" rel="tooltip" title="Delete" class="btn btn-danger btn-link btn-sm image-remove"> <i class="material-icons">close</i></a></td></tr>'); 
    //     $('#tbody').append(tr);
    // });

    for(i = 0; i < e.target.files.length; i++)
    {
        id = i;
        file = e.target.files[i];
        name = file.name;
        size = file.size;

        fileToUpload.push({id,file});        
        tr = $('<tr><td>'+ id +'</td><td>'+ name +'</td><td>'+ size +'</td><td>0%</td><td class="td-actions text-right"> <a href="#" id="'+ id +'" rel="tooltip" title="Delete" class="btn btn-danger btn-link btn-sm image-remove"> <i class="material-icons">close</i></a></td></tr>'); 
        $('#tbody').append(tr);
    }


console.log(fileToUpload);
  
    // preview_image(this);
});

// function preview_image(input) 
// {
//     var file = input.files[0];
//     for(var i = 0; i < input.files.length; i++ ){  
//         var src = URL.createObjectURL(event.target.files[i]);
//         div = $('<div class="grid-item"><a  href="#" id="remove"><i class="fa fa-close"></i>'+input.files[i].name +'</a></div>');
//         img = jQuery('<img  />');
//         img.attr('src', src);
//         div.append(img);   
//         $('.gallery-grid').append(div);        
 
//     }
       
// }

function preview_image(input) 
{
    var totalsize = 0;
    for(var i = 0; i < input.files.length; i++ ){  
        
        file = input.files[i];
        id = i;
        name = file.name;
        size = file.size;     
      
        tr = $('<tr><td>'+id+'</td><td>'+ file.name +'</td><td>'+ size +'</td><td>0%</td><td class="td-actions text-right"> <a href="#" id="'+ id +'" rel="tooltip" title="Delete" class="btn btn-danger btn-link btn-sm image-remove"> <i class="material-icons">close</i></a></td></tr>'); 
        $('#tbody').append(tr);
      
     }  

}
       


$("body").on("click", ".image-remove", function(){
 

    var  tr = $(this).closest('tr');
    var  id = $(this).attr('id');
    var Imageid = 0;

    var input = $('#ImageUploader').prop('files');

     /// remove file from fileToUpload;
    for (i = 0; i < fileToUpload.length;i++)
    {
        
        if(fileToUpload[i].id == id)
        {      
            Imageid = fileToUpload[i].id;       
            fileToUpload.splice(i,1); 
                    
           
        }

   

        tr.find('td').fadeOut(1000, function () { tr.remove(); });  
        console.log(fileToUpload.length); 
        
            


           
    }

    form = $('#form');

    var formData = new FormData(form);


    for(i = 0; i < fileToUpload.length;i++)
    {
        formData.append('#ImageUploader',fileToUpload[i].file);

    }


   console.log(input.length);





  
   

    

    /// set the fileToUpload to......














    // tr = $(this).closest('tr');
    // var input = $('#ImageUploader').prop('files');
    // var id  = $(this).attr('id');
    // console.log(id);
     
    // for(var i = 0; i < input.length; i++)
    // {
    //     if(i == id)
    //     {   
            
    //         tr.find('td').fadeOut(1000,function(){
    //             tr.remove();
    //         });
            
    //     }
    // }



  });

  function removeimage(input)
  {
    for(i = 0;i < input.files.length;i++)
    {
        console.log(input.files[0].name);
    }
  }

  
$('#perentCheckbox').change(function(event){

   if(this.checked){
        $('.childCheckbox').prop('checked', true);
        $('.childCheckbox').closest('tr').addClass('row-active')
        return;
   }
   
       $('.childCheckbox').prop('checked', false);
       $('.childCheckbox').closest('tr').removeClass('row-active')
   
});

$('.childCheckbox').change(function(event){

    if(this.checked){
        $(this).closest('tr').toggleClass('row-active');
        return;
    }

    $(this).closest('tr').removeClass('row-active');
    $('#parentCheckbox').prop('checked', false);
});

//// event for selecting all image
$('#image-select-all').click(function(){
    
   input = $('input[name="checkbox"]'); //// get checkbox element
    
   if(input.is(':checked'))
   {
        input.prop('checked',false);  /// set checkbox to false 
        $('.media-item').removeClass('media-item-focus');/// set to unfocus an item
        $('.image-delete').removeClass('visible');/// set to hidden icon delete
       
        $(this).text("Select all"); /// set select button to default text
   }
   else
   {
         input.prop('checked',true);  /// set checkbox to true
         $('.media-item').addClass('media-item-focus');/// set to focus an item
         $('.delete-photos').addClass('visible'); /// set to visible icon delete
         $(this).text("Clear Selection"); /// set select button to clear seletion text
         
   }


});


////// event for select the image
$('.media-item').click(function(){
   var id = [];
    var input =  $(this).find('.form-check-input');
    var deleteIcon = $(this).find('a');

    if(input.is(':checked')) {
        input.prop('checked',false);  /// set checkbox to false    
        $(this).removeClass('media-item-focus'); /// set to unfocus an item
        deleteIcon.removeClass('visible'); /// set to hidden icon delete

        ///// check how many checkbox are checked
        $('input[name=checkbox]:checked').each(function(i){
            id[i] = $(this).attr('id'); /// get the element to an array                   
        });
        
        /// chech  if checkbox is nothing selected
        if(id.length == 0)
        {
            //// set select all button to default text
            $('#image-select-all').text("Select all");
        }

       

    } 
    else {
        input.prop('checked',true); /// set checkbox to true
        $(this).addClass('media-item-focus'); /// set to focus an item
        deleteIcon.addClass('visible');/// set to visible delete buttton
        $('#image-select-all').text("Clear Selection"); /// set select button to clear selection
       
     
    }      
  });


 


});
