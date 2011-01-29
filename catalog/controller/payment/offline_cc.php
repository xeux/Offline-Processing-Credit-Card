<?php 
class ControllerPaymentOfflineCC extends Controller {
    private $errors = array();
    
	protected function index() {
        $this->language->load('payment/offline_cc');

		$this->data['text_creditcard'] = $this->language->get('text_creditcard');
		$this->data['text_wait'] = $this->language->get('text_wait');
		
        $this->data['entry_cc_type'] = $this->language->get('entry_cc_type');
		$this->data['entry_cc_owner'] = $this->language->get('entry_cc_owner');
		$this->data['entry_cc_number'] = $this->language->get('entry_cc_number');
		$this->data['entry_cc_expire'] = $this->language->get('entry_cc_expire');
		$this->data['entry_cc_cvv'] = $this->language->get('entry_cc_cvv');
		
		$this->data['button_confirm'] = $this->language->get('button_confirm');
		$this->data['button_back'] = $this->language->get('button_back');

        $this->data['action'] = HTTPS_SERVER . 'index.php?route=payment/offline_cc/process';
		if ($this->request->get['route'] != 'checkout/guest_step_3') {
			$this->data['back'] = HTTPS_SERVER . 'index.php?route=checkout/payment';
		} else {
			$this->data['back'] = HTTPS_SERVER . 'index.php?route=checkout/guest_step_2';
		}

		$this->data['months'] = array();
		
		for ($i = 1; $i <= 12; $i++) {
			$this->data['months'][] = array(
				'text'  => strftime('%B', mktime(0, 0, 0, $i, 1, 2000)), 
				'value' => sprintf('%02d', $i)
			);
		}
		
		$today = getdate();

		$this->data['year_expire'] = array();

		for ($i = $today['year']; $i < $today['year'] + 11; $i++) {
			$this->data['year_expire'][] = array(
				'text'  => strftime('%Y', mktime(0, 0, 0, 1, 1, $i)),
				'value' => strftime('%Y', mktime(0, 0, 0, 1, 1, $i)) 
			);
		}
        
		if ($this->request->get['route'] != 'checkout/guest_step_3') {
			$this->data['back'] = HTTPS_SERVER . 'index.php?route=checkout/payment';
		} else {
			$this->data['back'] = HTTPS_SERVER . 'index.php?route=checkout/guest_step_2';
		}

		$this->id = 'payment';

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/offline_cc.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/payment/offline_cc.tpl';
		} else {
			$this->template = 'default/template/payment/offline_cc.tpl';
		}	
		
		$this->render();
  	}

  	public function process() {
        $this->language->load('payment/offline_cc');
        
        $this->load->model('checkout/order');
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
			if (!$this->validate($this->request->post)) {
            	if (!empty($this->errors)) {
                    $this->session->data['error'] = $this->errors;
                }
                $this->redirect(HTTPS_SERVER . 'index.php?route=checkout/guest_step_2');
            }
            
            $ref_id = $this->session->data['order_id'];
            
        	$ccNumber = preg_replace('/[^0-9 -]/', '', $this->request->post['cc_number']); // strip non numerics from the text but leave spaces for the moment.
            

			$comment = sprintf($this->language->get('checkout_comment'), $this->request->post['cc_type'], $this->request->post['cc_owner'], $ccNumber, $this->request->post['cc_month'] .'/'. $this->request->post['cc_year'], $this->request->post['cc_cvv']);
            
            $this->model_checkout_order->confirm($this->session->data['order_id'], 1, $comment);
            //$this->model_checkout_order->confirm($this->session->data['order_id'], $this->config->get('offline_cc_order_status_id'), $comment);
            $this->redirect(HTTPS_SERVER . 'index.php?route=checkout/success');
		}
  	}
  	
  	
  	// Pre-Validates user input from the form before attempting to send.
    private function validate($data = array()) { 

        $this->errors = '';
        if (strcmp($data['cc_type'], 'none') == 0) {
             $this->errors .= '<p>'.$this->language->get('error_cc_type_missing').'</p>';
		}
        
        if (strlen($data['cc_owner']) == 0) {
             $this->errors .= '<p>'.$this->language->get('error_cc_owner_missing').'</p>';
		}

        $ccNumber = preg_replace('/[^0-9 -]/', '', $data['cc_number']); // strip non numerics from the text but leave spaces for the moment.
        if (strlen($ccNumber) == 0) {
            $this->errors .= '<p>'.$this->language->get('error_cc_number_missing').'</p>';
        } else if (strlen($ccNumber) <> strlen($this->request->post['cc_number'])) {
            $this->errors .= '<p>'.$this->language->get('error_cc_number_not_numeric').'</p>';
        }

        if (strlen($data['cc_month']) == 0) {
            $this->errors .= '<p>'.$this->language->get('error_cc_month_missing').'</p>';
        }
                            
        if (strlen($data['cc_year']) == 0) {
            $this->errors .= '<p>'.$this->language->get('error_cc_year_missing').'</p>';
        }
                            
        if (strlen($data['cc_cvv']) == 0) {
            $this->errors .= '<p>'.$this->language->get('error_cc_cvv_missing').'</p>';
        }
        
        //  No point to continue validating if we already have an error.
        if (count($this->error) > 0) {
            return false;
        }
                       
        //  now we remove harmless spaces or dashes from the credit card number so that we can test it as a number.
        $ccNumber = ereg_replace('[ -]', '', $ccNumber);
        
        //  and remove all non numerics from the following and validate them.
        $ccMonth = ereg_replace('[^0-9]', '', $data['cc_month']);
        $ccYear = ereg_replace('[^0-9]', '', $data['cc_year']);
 
        if (strlen($ccMonth) <> strlen($data['cc_month'])) {
            $this->errors .= '<p>'.$this->language->get('error_cc_month_not_numeric').'</p>';       
        }
        if (strlen($ccYear) <> strlen($data['cc_year'])) {
            $this->errors .= '<p>'.$this->language->get('error_cc_year_not_numeric').'</p>';       
        }

        //  No point to continue validating if we already have an error.
        if (count($this->error) > 0) {
            return false;
        }
            
        //  Validate credit card number by common algorithm
        $cardNumber = strrev($ccNumber);
        $numSum = 0;
        for($i = 0; $i < strlen($cardNumber); $i++) {
            $currentNum = substr($cardNumber, $i, 1);

            // Double every second digit
            if ($i % 2 == 1) {
                $currentNum *= 2;       
            }

            // Add digits of 2-digit numbers together
            if ($currentNum > 9) {
                $firstNum = $currentNum % 10;
                $secondNum = ($currentNum - $firstNum) / 10;
                $currentNum = $firstNum + $secondNum;
            }
            $numSum += $currentNum;
        }
        if ($numSum % 10 != 0) {
            $this->errors .= '<p>'.$this->language->get('error_cc_number_invalid').'</p>';
            return false;            
        }
 
        
        //  Validate the number(s) match the card type  
        switch ($data['cc_type']) {
            case 'mastercard':
                if (!(ereg("^5[1-5][0-9]{14}$", $ccNumber)))
                    $this->errors .= '<p>'.$this->language->get('error_cc_number_invalid_for_type').'</p>'; 
                if (!(ereg("^[0-9][0-9][0-9]$", $ccCVV)))
                    $this->errors .= '<p>'.$this->language->get('error_mastercard_cvv').'</p>';   
                break;
            case 'visa':
                if (!(ereg("^4[0-9]{12}([0-9]{3})?$", $ccNumber)))
                    $this->errors .= '<p>'.$this->language->get('error_cc_number_invalid_for_type').'</p>'; 
                if (!(ereg("^[0-9][0-9][0-9]$", $data['cc_cvv'])))
                    $this->errors .= '<p>'.$this->language->get('error_visa_cvv').'</p>';   
                break;
             default:
                break;
        }
        
        // Month must be in the range 1 to 12
        $ccMonth = (int)$ccMonth;
        if ($ccMonth < 1 || $ccMonth > 12) {
            $this->errors .= '<p>'.$this->language->get('error_cc_month_invalid_range').'</p>';
        }
        
        // Year cannot be more than 10 years into the future
        $ccYear = (int)$ccYear;
        $currentYear = (int)date('Y');
        if ($ccYear  > $currentYear + 10) {
            $this->errors .= '<p>'.$this->language->get('error_cc_year_invalid_range').'</p>';
        }
        
        // Cannot expire within the next 3 days because the payment is processed on weekdays and it could be friday night
        $margin = 3;
        // $margin days before the 1st day of the month after ValidTo date on card
        $ccExpiresLimit = mktime(0,0,0, $ccMonth + 1,  1 - $margin, $ccYear);  
        $today = mktime(0,0,0);
        if ($today >= mktime(0,0,0, $ccMonth + 1,  1, $ccYear)) {
            $this->errors .= '<p>'.$this->language->get('error_cc_expired').'</p>';
        } else if ($today >= $ccExpiresLimit) {
            $this->errors .= '<p>'.$this->language->get('error_cc_expires_too_soon').'</p>';
        }
        
        return (strlen($this->error) < 1);
    }
    

  	
}
?>