<?php

namespace App\Services;

use Illuminate\Http\Request;
use stdClass;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PaymentService
{
    public function getAccessToken($customer_id, $amount , $product_id , $invoice_id) {
		$access_token = $this->getToken();
		$amount = $amount * config('variables.currency_rate');
		$orderUrl = $this->getOrderURL(env('PAYMENT_UTL'), $access_token, $customer_id, $amount, $product_id, $invoice_id);
        
		return ($orderUrl);
	}

	public function getOrderURL($outlet, $token, $customer_id, $amount, $product_id, $invoice_id) {
		$postData = new StdClass();
		$postData->action = "SALE";
		$postData->amount = new StdClass();
		$postData->amount->value = round($amount * 100);
		$postData->amount->currencyCode = "AED";

		$postData->emailAddress = 'user@gmail.com';
		$postData->billingAddress = new stdClass();
		$postData->billingAddress->firstName = 'dummy';
		$postData->billingAddress->lastName = 'user';
		$postData->billingAddress->address1 = 1;
		$postData->billingAddress->city = 1;
		$postData->billingAddress->countryCode = "AE";
		$postData->merchantAttributes = new stdClass();
		// $postData->merchantAttributes->redirectUrl = (env('APP_ENV') == 'local' ? 'https://testmarket.index.ae/get_payment_status' :env('SUCESS_URL'));
		$postData->merchantAttributes->redirectUrl = (env('APP_ENV') == 'local' ? 'https://devcu.ichs.uk/thank-you' : env('SUCESS_URL').'/thank-you');
		$postData->merchantAttributes->skipConfirmationPage = true;
		$postData->merchantOrderReference = $customer_id . 'S' . $product_id . 'S' . $invoice_id;
		$json = json_encode($postData);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, env('PAYMENT_URL') . "transactions/outlets/$outlet/orders");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			"Authorization: Bearer " . $token,
			"Content-Type: application/vnd.ni-payment.v2+json",
			"Accept: application/vnd.ni-payment.v2+json"));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
		$output = json_decode(curl_exec($ch));
		// $order_reference = $output->reference;

		$order_paypage_url = $output->_links->payment->href;
		curl_close($ch);
		return ($output);
	}


	public function getToken() {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,env('PAYMENT_URL')."identity/auth/access-token");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "accept: application/vnd.ni-identity.v1+json",
            "authorization: Basic ".env('PAYMENT_KEY'),
            "content-type: application/vnd.ni-identity.v1+json",
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"NetworkInternational\":\"ni\"}");
        $output = json_decode(curl_exec($ch));
        
        // dd(env('PUSHER_SCHEME'));
        $access_token = $output->access_token;

        return $access_token;

    }

}

?>
