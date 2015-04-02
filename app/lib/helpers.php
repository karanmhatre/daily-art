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

  function imageEdit($image, $field_name = 'image' ,$model){
  if(is_null($image)) {
    return $model->$field_name;
  }else{
    $image = uploadFile($image);
    if($image)
      return $image;
    else
      return false;
  }
}

function imageStore($image){
    if(is_null($image)){
      return false;
    }else{
      $image = uploadFile($image);
      if($image)
        return $image;
      else
        return false;
    }
  }

  function useDataTables($item_id){
   echo "<script>

    $(document).ready(function() {

    $('#".$item_id."').dataTable();

    });
    </script>";

  }

  function orderTable($item_id, $route){
    echo "
    <script>
    $(document).ready(
    function()
    {
    $('#".$item_id."').sortable({
        axis: 'y',
        update: function (event, ui) {
            var data = $(this).sortable('serialize');

            $.ajax({
              data: data,
              type: 'POST',
              url: '".$route."'
            });
        }
    });
  });
    </script>";
  }

  function sortModel($items, $model){
    foreach ($items as $key => $value) {
      $film = $model::find($value);
      $film->order = $key;
      $film->save();
    }
  }

 function hex2rgb($hex, $alpha) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
    }
   else
   {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
    }
  $rgba = "rgba(".$r.",".$g.",".$b.",".$alpha.")";
   //return implode(",", $rgb); // returns the rgb values separated by commas
   return $rgba; // returns an array with the rgb values
 }

 function useColorPicker($item){

   echo "<script>
     $(document).ready(
      function()
      {
        $('#".$item."').colpick({
              layout:'rgbhex',
              submit:0,
              colorScheme: 'dark',
                onChange:function(hsb,hex,rgb,el,bySetColor) {
                  if(!bySetColor) $(el).val(hex);
                }
              }).keyup(function(){
                $(this).colpickSetColor(this.value);
            });
    });
        </script>";
  }

  function formatDate($date){
    return date('jS M, Y', strtotime($date));
  }

  function isActive($keyword){
    if(Request::is('*'.$keyword.'*'))
      return 'active';
    else
      return '';
  }

  function moneyFormatIndia($num){
    $explrestunits = "" ;
    if(strlen($num)>3){
        $lastthree = substr($num, strlen($num)-3, strlen($num));
        $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
        $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
        $expunit = str_split($restunits, 2);
        for($i=0; $i<sizeof($expunit); $i++){
            // creates each of the 2's group and adds a comma to the end
            if($i==0)
            {
                $explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
            }else{
                $explrestunits .= $expunit[$i].",";
            }
        }
        $thecash = $explrestunits.$lastthree;
    } else {
        $thecash = $num;
    }
    return $thecash; // writes the final format where $currency is the currency symbol.
	}