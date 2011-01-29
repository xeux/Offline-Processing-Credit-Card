<?php 
class ModelPaymentOfflineCC extends Model {
  	public function getMethod($address) {
        $this->load->language('payment/offline_cc');
        
		if ($this->config->get('offline_cc_status')) {
      		if (!$this->config->get('offline_cc_geo_zone_id')) {
        		$status = true;
      		} elseif ($this->database->getRows("select * from zone_to_geo_zone where geo_zone_id = '" . (int)$this->config->get('offline_cc_geo_zone_id') . "' and country_id = '" . (int)$address['country_id'] . "' and (zone_id = '" . (int)$address['zone_id'] . "' or zone_id = '0')")) {
        		$status = true;
      		} else {
        		$status = false;
      		}
		} else {
			$status = false;
		}
		
		$method_data = array();
	
		if ($status) {  
      		$method_data = array( 
        		'id'         => 'offline_cc',
        		'title'      => $this->language->get('text_offline_cc_title'),
				'sort_order' => $this->config->get('offline_cc_sort_order')
      		);
    	}
   
    	return $method_data;
  	}
}
?>