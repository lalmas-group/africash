
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employe_model extends CI_Model 
{
	public function exists($email, $password)
	{
		$numb = $this->db
			->where('email', $email)
			->where('password', $password)
			->count_all_results('employe');
		
		if ( $numb == 1 ) 
			return TRUE;
		else
			return FALSE; 
	}
	

	public function get($email, $password)
	{
		$this->db->where('email', $email);	
		$this->db->where('password', $password);	
		$query   = $this->db->get('employe'); 
		$employe	=	$query->result(); 
		return $employe[0]; 
	}
}
