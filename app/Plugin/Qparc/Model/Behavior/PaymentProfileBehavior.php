<?php
/**
 * Authorize.net CIM Behavior
 *
 * PHP version 5
 *
 * @category Behavior
 * @package  Qparc
 * @author   Michael Labieniec <michael@coderedhead.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.coderedhead.com
 */
App::import('Vendor', 'authnet/anet_php_sdk/AuthorizeNet');

class PaymentProfileBehavior extends ModelBehavior {

	public $METHOD_TO_USE = "DIRECT_POST";
	public $login = "";
	public $transaction = "";
	public $host = "apitest.authorize.net";

	/**
	 * Setup
	 *
	 * @param object $model
	 * @param array  $config
	 * @return void
	 */
	public function setup(&$model, $config = array()) {
		
        if (is_string($config)) {
            $config = array($config);
        }

        $this->settings[$model->alias] = $config;
		
		$this->login = Configure::read('Qparc.authnet_login');
		$this->transaction = Configure::read('Qparc.authnet_transaction_key');
		if (Configure::read('Qparc.authnet_test')) {
			$this->host = "apitest.authorize.net";
		} else {
			$this->host = "api.authorize.net";
		}

		define("AUTHORIZENET_MD5_SETTING","2T7Ejgu2tY"); 
		define("AUTHORIZENET_SANDBOX",true); // Set to false to test against production
		define("TEST_REQUEST", "FALSE");  
		define("AUTHORIZENET_API_LOGIN_ID",$this->login);    // Add your API LOGIN ID
		define("AUTHORIZENET_TRANSACTION_KEY",$this->transaction); // Add your API transaction key
    }

	/**
	 * afterFind callback
	 *
	 * @param object  $model
	 * @param array   $created
	 * @param boolean $primary
	 * @return array
	 */
    public function afterFind(&$model, $results = array(), $primary = false) {

        if ($primary && isset($results[0][$model->alias])) {
            foreach ($results AS $i => $result) {
            	if (isset($results[$i][$model->alias]))
					$results[$i][$model->alias]['auth_token'] = $this->auth_token($result['UserProfile']['cim']);

            }
        } elseif (isset($results[$model->alias])) {
        	if (isset($results[$model->alias]['body']))
        		$results[$model->alias]['auth_token'] = $this->auth_token($result['UserProfile']['cim']);
        }

        return $results;
	}

	public function beforeSave(&$model)
	{
		// If there is NO cim, then this is a NEW profile
		// Create the empty CIM in auth.net and save an
		// empty profile here.
		if (!isset($model->data['UserProfile']['cim'])) {
			$user = $model->data['User'];
			// Create empty customer profile in auth.net
			// before saving to our database so that we 
			// have the cim id to store
			$content =
	        "<?xml version=\"1.0\" encoding=\"utf-8\"?>" .
	        "<createCustomerProfileRequest xmlns=\"AnetApi/xml/v1/schema/AnetApiSchema.xsd\">".
	        $this->MerchantAuthenticationBlock().
	        "<profile>".
	        "<merchantCustomerId>".$user['id']."</merchantCustomerId>". // Your own identifier for the customer.
	        "<description>".Configure::read('Site.title')." User</description>".
	        "<email>" . $user['email'] . "</email>".
	        "</profile>".
	        "</createCustomerProfileRequest>";
	        
	        $response = $this->send_xml_request($content);
	        $parsedresponse = $this->parse_api_response($response);
			
			// Check the response
	        if ("Ok" == $parsedresponse->messages->resultCode) {
	        	
	            if ($parsedresponse->customerProfileId and $parsedresponse->customerProfileId > 0) {
	                    $customerProfileId = $parsedresponse->customerProfileId;
	            }
	            elseif ($parsedresponse->profile->customerProfileId and $parsedresponse->profile->customerProfileId > 0) {
	                    $customerProfileId = $parsedresponse->profile->customerProfileId;
	            }
				
				// Update our CIM id with the returned customer profile id
	            $model->data['UserProfile']['cim'] = $customerProfileId;
				
	        } else {
	        	
				return false;	
			}
		} else {
			// The User HAS a Customer profile ID, this must be an update to the profile.
			// Check if a payment method has been added, if not fail and send message	
			$content ="<?xml version=\"1.0\" encoding=\"utf-8\"?>" .
			"<getCustomerProfileRequest xmlns=\"AnetApi/xml/v1/schema/AnetApiSchema.xsd\">" .
			$this->MerchantAuthenticationBlock().
			"<customerProfileId>".$model->data['UserProfile']['cim']."</customerProfileId>".
			"</getCustomerProfileRequest>";
							
			$response = $this->send_xml_request($content);
			$parsedresponse = $this->parse_api_response($response);
			
			// Check the response
			if ("Ok" == $parsedresponse->messages->resultCode) {
				// If there is no payment method fail
				if ( !isset($parsedresponse->profile->paymentProfiles) ) {
					return false;
				} else {
					// we found a payment method, let's update our database 
					$model->data['UserProfile']["paymentProfileId"] = $parsedresponse->profile->paymentProfiles->customerPaymentProfileId;
				}
			} else {
				// Request failed...
				return false;
			}	

		}
		
		// Everything went ok!
		return true;
	}
	
	private function auth_token($cim = null)
	{
		if (!$cim) 
			return $cim;
		
		Cache::config('short', array(      
			'engine' => 'File',      
			'duration'=> '+10 minutes',      
			'path' => CACHE,      
			'prefix' => 'payment_profile_'
			));
		
		//Cache::delete('token');
		
		//Check the cache first before making the call
		$token = Cache::read('token');
		
		if ($token !== false) {
		    return $token;
		} else {
			// Nothing found in the cache, make the auth.net call to get the token
			$content =
		    "<?xml version=\"1.0\" encoding=\"utf-8\"?>
		    <getHostedProfilePageRequest xmlns=\"AnetApi/xml/v1/schema/AnetApiSchema.xsd\">
		        <merchantAuthentication>
		        <name>" . $this->login . "</name>
		        <transactionKey>" . $this->transaction . "</transactionKey>
		        </merchantAuthentication>
				<customerProfileId>" . $cim . "</customerProfileId>
		    </getHostedProfilePageRequest>";

			$response = $this->send_xml_request($content);
			$parsedresponse = $this->parse_api_response($response);

			if ("Ok" == $parsedresponse->messages->resultCode) {
				// Typecast the SimpleXMLObject to a string
				// http://stackoverflow.com/questions/416548/forcing-a-simplexml-object-to-a-string-regardless-of-context
		        $token = array( (string) $parsedresponse->token );	
				// write the token to the cache for 10 minutes
				Cache::write('token', $token[0]);
			} else {
				$token = $parsedresponse->messages->resultCode;
			}
			
			return $token[0];
		}
		
	}
	
	private function send_xml_request($content)
	{
		return $this->send_request_via_fsockopen($this->host,"/xml/v1/request.api",$content);
	}
	
	//function to send xml request via fsockopen
	//It is a good idea to check the http status code.
	private function send_request_via_fsockopen($host,$path,$content)
	{
		$posturl = "ssl://" . $host;
		$header = "Host: $host\r\n";
		$header .= "User-Agent: PHP Script\r\n";
		$header .= "Content-Type: text/xml\r\n";
		$header .= "Content-Length: ".strlen($content)."\r\n";
		$header .= "Connection: close\r\n\r\n";
		$fp = fsockopen($posturl, 443, $errno, $errstr, 30);
		$out = "";
		
		if (!$fp)
		{
			$body = false;
		}
		else
		{
			error_reporting(E_ERROR);
			fputs($fp, "POST $path  HTTP/1.1\r\n");
			fputs($fp, $header.$content);
			fwrite($fp, $out);
			$response = "";
			while (!feof($fp))
			{
				$response = $response . fgets($fp, 128);
			}
			fclose($fp);
			error_reporting(E_ALL ^ E_NOTICE);
			
			$len = strlen($response);
			$bodypos = strpos($response, "\r\n\r\n");
			if ($bodypos <= 0)
			{
				$bodypos = strpos($response, "\n\n");
			}
			while ($bodypos < $len && $response[$bodypos] != '<')
			{
				$bodypos++;
			}
			$body = substr($response, $bodypos);
		}
		return $body;
	}
	
	//function to send xml request via curl
	private function send_request_via_curl($host,$path,$content)
	{
		$posturl = "https://" . $host . $path;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $posturl);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: text/xml"));
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$response = curl_exec($ch);
		return $response;
	}
	
	
	//function to parse the api response
	//The code uses SimpleXML. http://us.php.net/manual/en/book.simplexml.php 
	//There are also other ways to parse xml in PHP depending on the version and what is installed.
	private function parse_api_response($content)
	{
		$parsedresponse = simplexml_load_string($content, "SimpleXMLElement", LIBXML_NOWARNING);
		
		if ("Ok" != $parsedresponse->messages->resultCode) {
			echo "The operation failed with the following errors:<br>";
			foreach ($parsedresponse->messages->message as $msg) {
				echo "[" . htmlspecialchars($msg->code) . "] " . htmlspecialchars($msg->text) . "<br>";
			}
			echo "<br>";
		}
		
		return $parsedresponse;
	}
	
	private function MerchantAuthenticationBlock() {

		return
	        "<merchantAuthentication>".
	        "<name>" . $this->login . "</name>".
	        "<transactionKey>" . $this->transaction . "</transactionKey>".
	        "</merchantAuthentication>";
	}
	
}
	