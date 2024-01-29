<?php


namespace App\Services;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\PromotionCode;
use Illuminate\Support\Facades\Log;

class PromotionCodeService
{

    private $code,$promotion_code,$amount;
    private $status=false;
    private $message='';
    private $discount=0;
    private $discount_type=0;
    private $id=null;
    private $product_type=null;
    private $product_id=null;
    private $promo_id=null;


    function __construct($args,$promo_id=null)
    {
    	$this->code=(isset($args['code']) ? $args['code'] : null);
    	$this->amount=(float) $args['amount'];
        $this->promo_id=$promo_id;
        $this->product_type=(isset($args['product_type']) ? str_replace("-", "\\" , $args['product_type']) : null);
        $this->product_id=(isset($args['product_id']) ? $args['product_id'] : null);
    	$this->getCode();
        $this->redeemCoupon();
    }


    public function getCode()
    {
       Log::info($this->product_id.' '.$this->product_type);
        $this->promotion_code=PromotionCode::when($this->promo_id==null,function($q){
                            $q->where('promotion_code',$this->code)
                                ->whereDate('valid_from','<=', (Carbon::today())->toDateString())
                                ->whereDate('valid_to','>=', (Carbon::today())->toDateString())
                                ->whereHas('promotionCodeProduct',function($p){
                                $p->where(['model_id'=>$this->product_id,'model_type'=>$this->product_type]);
                                });
                            })
                            ->when($this->promo_id!=null,function($q){
                            $q->where('id',$this->promo_id);
                            })
                            ->where('status','1')
                            ->whereColumn('usage_limit','>','no_of_times_used')
                            ->first();



 	   if(!empty($this->promotion_code))
 	   {
 	   		if($this->promotion_code->promotion_type=='percentage')
 	   		{
 	   			$this->getPercentage($this->promotion_code->value);

 	   		}elseif($this->promotion_code->promotion_type=='fixed')
 	   		{
 	   			$this->getFixed($this->promotion_code->value);
 	   		}else{
 	   			$this->getValue($this->promotion_code->value);
 	   		}
            $this->id=$this->promotion_code->id;
 	   		$this->status=true;
 	   }else{
	 	   	 $this->promotion_code=PromotionCode::when($this->promo_id==null,function($q){
                $q->where('promotion_code',$this->code)
                ->whereHas('promotionCodeProduct',function($p){
                    $p->where(['model_id'=>$this->product_id,'model_type'=>$this->product_type]);
                 });
             })
             ->when($this->promo_id!=null,function($q){
                    $q->where('id',$this->promo_id);
                })
             ->first();
	 	     if(!empty($this->promotion_code) && $this->product_type!=2)
	 	     {
	 	     	$this->message=$this->promotion_code->error_message_line1;
	 	     }else{
	 	     	$this->message="Promotion Code not found";
	 	     }
 	 	}

    }


    public function retrunMessage()
    {
    	return ['message'=>$this->message,
    			'status'=>$this->status,
    			'discount'=>$this->discount,
    			'discount_type'=>$this->discount_type,
                'promo_code_id'=>$this->id,
                'product_type'=>$this->product_type
    			];
    }


    private function getPercentage($percentage)
    {
        $percentage=(float) $percentage;
    	$this->discount=round(($percentage / 100) * $this->amount,2);
    	$this->discount_type='percentage';
    }


    private function getFixed($fixed)
    {
    	$this->discount=$fixed;
    	$this->discount_type='fixed';
    }

    private function getValue($value)
    {
    	$this->discount=$this->amount - $value;
    	$this->discount_type='value';
    }

    /* redeem coupon*/
    private function redeemCoupon()
    {
        if($this->promo_id!=null)
        {
            PromotionCode::find($this->promo_id)->increment('no_of_times_used');
        }
    }

}
