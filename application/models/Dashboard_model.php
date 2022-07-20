<?php
class Dashboard_model  extends CI_Model  {  

    function __construct()
    {
        parent::__construct();
    }   

    function get_active_and_verified_users()        
    {
        $query="SELECT * FROM users WHERE active='1' and  verified='1'"; 
        $db=$this->db->query($query);
        $result=$db->result();
        return $result; 
    }
    function get_active_and_verified_usr_with_attached_prods()          
    {
        $query="SELECT distinct users.* FROM users, user_products, products 
                        WHERE
                            user_products.user_id = users.user_id
                        and 
                            products.id = user_products.id
                        and 
                            products.status = 1
                        and     
                            users.active= 1
                        and  
                            users.verified=1 "; 

        $db=$this->db->query($query);
        $result=$db->result();
        return $result; 
    }
    function get_active_products()            
    {
        $query="SELECT * FROM products WHERE status='1' "; 
        $db=$this->db->query($query);
        $result=$db->result();
        return $result; 
    }
    function get_active_products_do_not_belong_to_any_user()              
    {   
        $query="SELECT products.* FROM products WHERE products.status='1' and products.id not in (select distinct user_products.id from user_products ) "; 
        $db=$this->db->query($query);
        $result=$db->result();
        return $result; 
    }
    function get_all_active_attached_product()                   
    {       
        $query="SELECT sum(user_products.quantity) as all_active_attached_product FROM `user_products` where user_products.id in (SELECT DISTINCT products.id from products where products.status = 1) "; 
        $db=$this->db->query($query);
        $result=$db->result();
        return $result; 
    }

    function get_summarized_price_of_all_active_attached_products($user_id='')                   
    {               
        $query="SELECT sum(user_products.quantity*user_products.Item_price) 
                    as summarized_price_of_all_active_attached_products  
                        FROM `user_products` 
                        where user_products.id 
                            in (SELECT DISTINCT products.id from products where products.status = 1) 
                        "; 
        $query .= (trim($user_id) ? ' and `user_products`.user_id = '.$user_id : '');   
        $db=$this->db->query($query);
        $result=$db->result();
        return $result; 
    }

    function get_summarized_prices_all_active_products_per_user()
    {
        $out_put = array();
        $users = $this->get_active_and_verified_usr_with_attached_prods();
        foreach($users as $k)
        {   
            $out_put[$k->name] = $this->get_summarized_price_of_all_active_attached_products($k->user_id)[0]->summarized_price_of_all_active_attached_products; 
        }  
        return $out_put; 
    }
}
?>