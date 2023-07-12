<?php
namespace App\Services;
 
class CodeService
{

  public function create($moel)
  {
    $code = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',5)),0,10);
    $discount = $moel::where('code',$code)->first();
    if($discount!=null)
    {
       return $this->create();
    }

    return $code;
  }

    

}
