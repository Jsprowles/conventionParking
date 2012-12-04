<?php
class QparcAppController extends AppController {
	
	public $components = array(
		'Email',
	    'Amazon.Amazon'
	);
	
	public function beforeFilter()
	{
		parent::beforeFilter();
		
		if ($this->RequestHandler->isMobile()) {
	    	$this->theme = "mobile";
			$this->layout = "default";
	    }
		
		// Amazon SES Settings
		$this->Email->smtpOptions = array(        
			'port'=>Configure::read('Amazon.sns_port'),         
			'timeout'=>'15',        
			'host' => Configure::read('Amazon.sns_host'),        
			'username'=>Configure::read('Amazon.sns_username'),        
			'password'=>Configure::read('Amazon.sns_password') 
		  );    
		  
		  $this->Email->SMTPAuth = true;
		  $this->Email->SMTPSecure = 'tls';  
		  $this->Email->delivery = 'smtp';
		  $this->Email->from = 'dispatch@amride.com';
		  
		  $this->set('mobile',$this->RequestHandler->isMobile());
	}
	
	/**
	 * Sent to user when a reservation is made
	 */
	public function sendUserReservationEmail($LocationReservation)
	{
		$user = $this->Auth->user();
		
	    //$this->Email->to = $user['User']['email']; 
	    $this->Email->to = "michael@codecreator.com";
		
	    $this->Email->template = 'reservation';
		$this->Email->subject = 'Thank you for your reservation';
		
	    //Send as 'html', 'text' or 'both' (default is 'text')
	    $this->Email->sendAs = 'html';
	    //Set view variables as normal
	    $this->set('reservation',$LocationReservation);
	    $this->set('user', $user);
	    //Do not pass any args to send()
	    $this->Email->send();
	}
	
	function createDateRangeArray($strDateFrom,$strDateTo)
	{
	    // takes two dates formatted as YYYY-MM-DD and creates an
	    // inclusive array of the dates between the from and to dates.
	
	    // could test validity of dates here but I'm already doing
	    // that in the main script
	
	    $aryRange=array();
	
	    $iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));
	    $iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));
	
	    if ($iDateTo>=$iDateFrom)
	    {
	        array_push($aryRange,date('Y-m-d',$iDateFrom)); // first entry
	        while ($iDateFrom<$iDateTo)
	        {
	            $iDateFrom+=86400; // add 24 hours
	            array_push($aryRange,date('Y-m-d',$iDateFrom));
	        }
	    }
	    return $aryRange;
	}
	
	/**
	 * Create a CSV file for Amano iParc Professional
	 * 
	 * options
	 * 0 = reservation
	 * 1 = promotion/coupon
	 * 
	 * CSV file
	 * 1. Barcode Number: unique Alpha Numeric up to 15 characters 
	 * 2. Lot_ID:	6401
	 * 3. Identifier: 1 Add/Update Barcode, 2 Deactivate Barcode Activation 
	 * 4. Date/Time: MMDDYYYY_HHMM This is the date and time the barcode will become active. 
	 * 5. Number of Uses: 1
	 * 6. Number of Uses Per Transaction: 1 
	 * 7. Expiration Date: (Future Use) 
	 * 8. Prepaid Amount: Amount to be deducted from Transaction amount due: $000.00 
	 * 9. Store Validation Number: (Does Not Apply to Pre-Pay) 
	 * 10. First Name: Limited to 15 letters in quotes. 
	 * 11. Last Name: Limited to 15 letters in quotes.
	 * 
	 * @author Michael Labieniec <michael@coderedhead.com>
	 */
	function create_iparc_csv( 
		$option = 0,
		$bar_code,
		$date_string,
		$start_date,
		$store_id,
		$lot_id = '',
		$prepaid_amount = '', 
		$first_name = '',
		$last_name = '',
		$number_of_uses = '-1',
		$uses_per_transaction = '1',
		$expiration = '',
		$identifier = '1') 
	{
		$this->layout = 'ajax';
		$this->render(false);
		
		App::import('Helper','Csv');
		
		$csv = new CsvHelper();
		$csv->filename = $date_string.'.csv';
		
		//1. Barcode Number
		$csv->addField($bar_code); 
		//2. Lot_ID
		$csv->addField($lot_id); 
		//3. Identifier
		$csv->addField($identifier);
		//4. Date/Time
		$csv->addField($start_date);  
		//5. Num uses
		$csv->addField($number_of_uses);
		//6. Num uses PER transaction
		$csv->addField($uses_per_transaction);
		//7. Expiration
		$csv->addField($expiration);
		//8. Prepaid Amount
		$csv->addField($prepaid_amount);
		//9. Store Validation Number
		$csv->addField($store_id); 
		//First Name
		$csv->addField($first_name); 
		//Last Name
		$csv->addField($last_name);
		$csv->endRow(); 
		
		return $csv->render($csv->filename, 'UTF-8', 'auto');
	}
	
	/**
	 * Generate and return a random string
	 *
	 * The default string returned is 8 alphanumeric characters.
	 *
	 * The type of string returned can be changed with the "seeds" parameter.
	 * Four types are - by default - available: alpha, numeric, alphanum and hexidec. 
	 *
	 * If the "seeds" parameter does not match one of the above, then the string
	 * supplied is used.
	 *
	 * @author      Aidan Lister <aidan@php.net>
	 * @version     2.1.0
	 * @link        http://aidanlister.com/repos/v/function.str_rand.php
	 * @param       int     $length  Length of string to be generated
	 * @param       string  $seeds   Seeds string should be generated from
	 */
	function str_rand($length = 8, $seeds = 'alphanum')
	{
	    // Possible seeds
	    $seedings['alpha'] = 'abcdefghijklmnopqrstuvwqyz';
	    $seedings['numeric'] = '0123456789';
	    $seedings['alphanum'] = 'abcdefghijklmnopqrstuvwqyz0123456789';
	    $seedings['hexidec'] = '0123456789abcdef';
	    
	    // Choose seed
	    if (isset($seedings[$seeds]))
	    {
	        $seeds = $seedings[$seeds];
	    }
	    
	    // Seed generator
	    list($usec, $sec) = explode(' ', microtime());
	    $seed = (float) $sec + ((float) $usec * 100000);
	    mt_srand($seed);
	    
	    // Generate
	    $str = '';
	    $seeds_count = strlen($seeds);
	    
	    for ($i = 0; $length > $i; $i++)
	    {
	        $str .= $seeds{mt_rand(0, $seeds_count - 1)};
	    }
	    
	    return $str;
	}
	
}
