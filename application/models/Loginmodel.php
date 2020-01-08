<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loginmodel extends CI_Model{
 
 public function areDetailsOk($username,$password){
 	$this->db->where('username',$username);
    $this->db->where('password',$password);
 	return $this->db->get('login')->result_array();
 }

}
?>
