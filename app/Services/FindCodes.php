<?php


namespace App\Services;
use App\Models\ProfileCard;
use App\Models\PagesCategory;

class FindCodes
{
    private $html;


    function __construct($html)
    {
    	$this->html=$html;
    }

    public function findMergeCode()
    {
    	
		preg_match_all("/\[cat (.+?)\]/", $this->html, $codes);

        $all_codes=[];
        $codes = array_pop($codes);
       
        foreach($codes as $code)
        {
            
            $single_code= explode(" ", $code);

            $params = array();
            
            $single_code = array_filter($single_code);
            $flag=false;
            foreach ($single_code as $d){
         
                list($opt, $val) = explode("=", $d);
                
                $params[$opt] = trim($val, '"');
                if($opt=='id')
                {
                	$flag=true;
                }
                
            }

            if($flag==true)
            {
            	$all_codes[$code]=$params;
            }
            
        }

      $this->resolveCodes($all_codes);

      return $this->html;

    }


    public function resolveCodes($all_codes)
    {
    	foreach($all_codes as $key=>$code){

    		$obj=new ShortCode($code);
    		
    		$this->html = \Str::replace('[cat '.$key.']', $obj->getData(), $this->html);
    	}
    }
}


?>