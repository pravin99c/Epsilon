<?php

if (! function_exists('uploadImage')) {
    function uploadImage($image)
    {
        // uniq file name create and store in public storage file.
        $file_name =  time().uniqid() .'_'.  str_replace(' ','_',$image->getClientOriginalName());

        return $image->storeAs('uploads',$file_name);
    }
}
