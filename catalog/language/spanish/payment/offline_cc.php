<?php
// Text
$_['text_offline_cc_title'] 				= 'Tarjeta de Credito (Manual)';
$_['heading_title']                         = 'Tarjeta de Credito (Manual)';

$_['text_creditcard']                       = 'Detalles de la Tarjeta de Credito';
/*$_['text_mastercard']                       = 'MasterCard';
$_['text_visa']                             = 'Visa';*/

$_['entry_cc_type']                 		= 'Tipo de Tarjeta:';
$_['entry_cc_owner']                 		= 'Propietario de la Tarjeta:';
$_['entry_cc_number']               		= 'Numero de la Tarjeta:';
$_['entry_cc_expire']             			= 'Vencimiento (mm/aaaa):';
$_['entry_cc_cvv']                  		= 'CVV:';

// E-Mail
$_['email_subject']         				= 'Referencia ID #%s - Detalles de la Tarjeta de Credito';
$_['email_message']         				= 'Referencia ID: #%s ' . "\n" . 
											  'Los detalles de la tarjeta de credito para este pedido son:' . "\n" . 
											  'Tipo de Tarjeta: %s' . "\n" .
                                              'Propietario de la Tarjeta: %s' . "\n" .
											  'Numero de la Tarjeta: %s' . "\n" .
											  'Vencimiento: %s' . "\n" .
											  'CVV: %s' . "\n";

// Error    
$_['error_cc_type_missing']               = 'Debe introducir un valor en "Tipo de Tarjeta"';
$_['error_cc_owner_missing']               = 'Debe introducir un valor en "Propietario de la Tarjeta"';
$_['error_cc_number_missing']               = 'Debe introducir un valor en "Numero de la Tarjeta"';
$_['error_cc_month_missing']       			= 'Debe introducir un valor en "Vencimiento" (mes). ej: Diciembre';
$_['error_cc_year_missing']        			= 'Debe introducir un valor en "Vencimiento" (a&ntilde;o). ej: 2009';
$_['error_cc_cvv_missing']          		= 'Debe introducir un valor en "CVV".';
$_['error_cc_number_not_numeric']           = '"Numero de la Tarjeta" debe ser numerico. (puede tener espacios)';
$_['error_cc_number_invalid']               = 'El valor de "Numero de la Tarjeta" no es un numero valido.';
$_['error_cc_number_invalid_for_type']      = 'El valor de "Numero de la Tarjeta" es un numero valido. Pero, no es compatible con el "Tipo de Tarjeta" seleccionado. Por favor revise si el "Tipo de Tarjeta" seleccionado es el mismo a su tarjeta.';
$_['error_cc_month_not_numeric']   			= '"Vencimiento" (mes) debe ser numerico. eg: 07';
$_['error_cc_year_not_numeric']    			= '"Vencimiento" (a&ntilde;o) debe ser numerico. ej: 2008';
$_['error_cc_month_invalid_range'] 			= '"Vencimiento" (mes) debe estar en el rango de 1 a 12.';
$_['error_cc_year_invalid_range']  			= '"Vencimiento" (a&ntilde;o) no puede ser mas de 10 a&ntilde;os hacia el futuro.';
$_['error_cc_expires_too_soon']             = 'La tarjeta vencera muy pronto para completar esta transacci&oacute;n.';
$_['error_cc_expired']                      = 'La tarjeta ha vencido.';
$_['error_mastercard_cvv']                  = 'El "CVV" para MasterCard debe ser un numero de 3 digitos. ej: 546';
$_['error_visa_cvv']                        = 'El "CVV" para Visa debe ser un numero de 3 digitos. ej: 546';
$_['error_cc_expired']                      = 'La tarjeta ha vencido.';
?>