 <?php

function validateString($string){

  if(empty($string)){
    return false;
  }
  $string=trim(htmlspecialchars($string));
  return $string;
}

function validateNumeric($number){

  if(empty($number)){
    return false;
  }
  $number=trim(htmlspecialchars($number));
  
  if (is_numeric($number)) {
    return $number;
  }
  else{
    return false;
  }

}



function validateEmail($string){

  if(empty($string)){  
    return false;
  }  
  else{  
    if(!filter_var($string, FILTER_VALIDATE_EMAIL)){
      return false;
    }  
  }
  return true;
}


  
function validateFieldName($fieldsArr, $formData){
  $err=0;
  for ($i=0; $i<count($fieldsArr); $i++) {
    if(!array_key_exists($fieldsArr[$i], $formData)){
        $err++;
    }
  }
  if ($err>0) {
    return false;
  }
  else{
    return true;
  }
}  








?> 