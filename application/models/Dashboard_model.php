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
}
?>