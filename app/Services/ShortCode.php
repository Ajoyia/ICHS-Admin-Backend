<?php


namespace App\Services;
use App\Models\ProfileCard;
use App\Models\PagesCategory;

class ShortCode
{
    private $short_code,$category;


    function __construct($short_code)
    {
    	$this->short_code=$short_code;
    	
    }


    public function getData()
    {
    	$this->category=PagesCategory::find($this->short_code['id']);

    	if(!empty($this->category))
    	{	
    		return $this->{$this->category->template_name}();

    	}else{
    		return null;
    	}
    }


    private function getView($data): string
    {
    	$view_name=$this->getViewName();
    	return view($view_name, compact('data'))->render();
    }


    private function profile_card()
    {
    	$data=ProfileCard::where('category_id',$this->category->id)->get();
    	return $this->getView($data);
    }

	private function affiliations_listing()
    {
    	$data=ProfileCard::where('category_id',$this->category->id)->get();
    	return $this->getView($data);
    }

	private function executive_office()
    {
    	$data=ProfileCard::where('category_id',$this->category->id)->get();
    	return $this->getView($data);
    }

	private function international_executive_board()
    {
    	$data=ProfileCard::where('category_id',$this->category->id)->get();
    	return $this->getView($data);
    }


    private function getViewName():string
    {
    	foreach(config('variables.pages_categories_templates') as $views)
    	{
    		if($this->category->template_name==$views['template_name'])
    		{
    			return $views['template_view'];
    		}
    	}
    	return "";
    }

   
}
?>