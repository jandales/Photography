<?php

namespace App\Library;
use Illuminate\Support\Facades\File;
use Image;
use Storage;
class Helpers
{
    public static function Slug($name)
    {
        /// create new slug name
        return str_slug($name, '-');
    }

     /** Creteting directory
      
    */
    public  static function CreateDirectory($name)
    {
        $path = public_path("uploads/".$name);

        //// check if path is already exist
        if(!File::exists($path)) {
            // make folder
            File::makeDirectory($path, 0775, true);
        }
    }

     /**
     * Upload image into storage
    */
    public static function UploadImage($image, $path = null)
    {        
      
       ///// Count the file in the directory folder and 1 count
        $filecount = Helpers::CountFiles() + 1;  
        /// initials name of image
        $filename = "IMG";
        /// size of an image
        $size = $image->getClientSize();
        /// extension of an image
        $extention = $image->getClientOriginalExtension();
        /// Fullname name of an image
        $name = $filename . $size  . $filecount . '.' . $extention;        
       

          
        /// check if path is not null
        if( $path != null )
        {
             /// Destination of an image
            $location = public_path("uploads/". $path . "/" . $name); 
            $imagepath = "/uploads/". $path . '/'.$name;          
        }

        else
        {
            /// Destination of an image
            $location = public_path("uploads/" . $name);
            $imagepath = "/uploads/".$name;
        } 

        /// Uplaod the image
        Image::make($image)->save($location);
        /// reset to an array[name of image, imagepath]
        $result = array("name" => $name,"location" => $imagepath, 'size' => $size);
        /// retuen the array
        return $result;

        
  
    }   

    public static function RenameFolder($oldname,$newname)
    {
        /// rename foldername
       rename('uploads/'. $oldname ,'uploads/'.$newname);
    }

    public static function CountFiles($path = null)
    {      
        /// count files in directory folder

        if( $path != null )
        {

            $files = File::files(public_path($path));
            return  $filecount = count($files);

        }               

        else
        {

            $files = File::files(public_path("uploads"));       
            return  $filecount = count($files);

        }

               
    }

    public static function ToDate($timespan)
    {
         return date('M d Y',strtotime($timespan));
    }
}

