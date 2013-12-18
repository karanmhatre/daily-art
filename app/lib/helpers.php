<?php
  
  function uploadFile($file)
  {
    if(!empty($file)) {
      $destinationPath = public_path() . '/upload/';
      $filename = date('ymdhis') . $file->getClientOriginalName();
      $file->move($destinationPath, $filename);
      return 'upload/' . $filename;    
    }    
  }