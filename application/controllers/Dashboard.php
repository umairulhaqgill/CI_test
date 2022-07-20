<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{    
      $this->load->model('Dashboard_model');

      $data['exchange_rates'] = $this->exchange_rates();    

      $data['active_and_verified_users'] = $this->Dashboard_model->get_active_and_verified_users();     
      $data['active_and_verified_usr_with_attached_prods'] = $this->Dashboard_model->get_active_and_verified_usr_with_attached_prods();
      $data['active_products'] = $this->Dashboard_model->get_active_products(); 
      $data['active_products_do_not_belong_to_any_user'] = $this->Dashboard_model->get_active_products_do_not_belong_to_any_user();        
      $data['all_active_attached_product'] = ($this->Dashboard_model->get_all_active_attached_product()[0]->all_active_attached_product?$this->Dashboard_model->get_all_active_attached_product()[0]->all_active_attached_product:0);  
      $data['summarized_price_of_all_active_attached_products'] = ($this->Dashboard_model->get_summarized_price_of_all_active_attached_products()[0]->summarized_price_of_all_active_attached_products?$this->Dashboard_model->get_summarized_price_of_all_active_attached_products()[0]->summarized_price_of_all_active_attached_products:0); 
      $data['summarized_prices_all_active_products_per_user'] = $this->Dashboard_model->get_summarized_prices_all_active_products_per_user();    
      $this->load->view('dashboard_page',$data);        
	}   

    private function exchange_rates()
    {
        $endpoint = 'latest';
        $access_key = $this->config->item('exchangeratesapi_access_key'); 
        
        $ch = curl_init('http://api.exchangeratesapi.io/v1/'.$endpoint.'?access_key='.$access_key);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Store the data:  
        $json = curl_exec($ch);
        curl_close($ch);
        $exchangeRates = json_decode($json, true);
        if($exchangeRates['rates'])
        {
            return $exchangeRates['rates']; 
        }
    }
}
