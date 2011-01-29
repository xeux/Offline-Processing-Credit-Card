<?php
// Text
$_['text_offline_cc_title'] 				= 'Credit Card (Offline Processing)';
$_['heading_title']                         = 'Credit Card (Offline Processing)';

$_['text_creditcard']                       = 'Credit Card Details';
/*$_['text_mastercard']                       = 'MasterCard';
$_['text_visa']                             = 'Visa';*/

$_['entry_cc_type']                 		= 'Card Type:';
$_['entry_cc_owner']                 		= 'Card Owner:';
$_['entry_cc_number']               		= 'Card Number:';
$_['entry_cc_expire']             			= 'Exp (mm/yy):';
$_['entry_cc_cvv']                  		= 'CVV:';

// E-Mail
$_['email_subject']         				= 'Reference ID #%s - Offline Credit Card Details';
$_['email_message']         				= 'Reference ID: #%s ' . "\n" . 
											  'The Credit Card details for this order are:' . "\n" . 
                                              'Card Type: %s' . "\n" .
											  'Card Owner: %s' . "\n" .
											  'Card Num: %s' . "\n" .
											  'Expiration: %s' . "\n" .
											  'Card CVV: %s' . "\n";

// Error    
$_['error_cc_type_missing']               = 'A value must be entered for "Card Type"';
$_['error_cc_owner_missing']               = 'A value must be entered for "Card Owner"';                        
$_['error_cc_number_missing']               = 'A value must be entered for "Card Number"';
$_['error_cc_month_missing']       			= 'A value must be entered for "Expiration" (month). eg: 12';
$_['error_cc_year_missing']        			= 'A value must be entered for "Expiration" (year). eg: 09';
$_['error_cc_cvv_missing']          		= 'A value must be entered for "CVV".';
$_['error_cc_number_not_numeric']           = '"Card Number" must be numeric. (you can have spaces)';
$_['error_cc_number_invalid']               = 'The value entered for "Card Number" is not a valid credit card number.';
$_['error_cc_number_invalid_for_type']      = 'The value entered for "Card Number" is a valid credit card number. However, it is not valid for the "Card Type" selected. Please check that the "Card Type" selected is the same as your credit card.';
$_['error_cc_month_not_numeric']   			= '"Expiration" (month) must be numeric. eg: 07';
$_['error_cc_year_not_numeric']    			= '"Expiration" (year) must be numeric eg: 08';
$_['error_cc_month_invalid_range'] 			= '"Expiration" (month) must be in the range 1 to 12.';
$_['error_cc_year_invalid_range']  			= '"Expiration" (year) cannot be more than 10 years into the future.';
$_['error_cc_expires_too_soon']             = 'Your card will expire too soon to complete this transaction.';
$_['error_cc_expired']                      = 'Your card has expired.';
$_['error_mastercard_cvv']                  = 'The "CVV" for MasterCard must be a 3 digit number. eg: 546';
$_['error_visa_cvv']                        = 'The "CVV" for Visa must be a 3 digit number. eg: 546';
$_['error_cc_expired']                      = 'Your card has expired.';
?>