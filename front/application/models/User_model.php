
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model 
{

	public function create_user($data)
	{
		$this->db->trans_start(); 
			$this->db->insert('customer', $data); 
		$this->db->trans_complete(); 
		if ($this->db->trans_status() === FALSE)
		{
			return 0; 
		}else {
			return 1; 
		}
	}
	
	public function phone_number_already_user($number, $town)
	{
		$country	=	$this->country_model->get_town_country($town); 
		$query		=	"select * from customer, town where customer.phone_number = '$number' and customer.town = '$town' and town.id = customer.town and town.country = '$country'";
		$query		=	$this->db->query($query);
//		$query		=	$query->result(); 
		if ( $query->num_rows() == 0 )
		{
			return FALSE; 
		}
		else
		{
			return TRUE; 
		}
	}
	
	public function exists($email, $password)
	{
		$query = $this->db->get_where('customer', array('email' => $email, 'password' => $password));
		if ( $query->num_rows() == 0 ) 
			return FALSE; 
		else
			return TRUE;
	}



	public function get($email, $password)
	{
		$query = $this->db->get_where('customer', array('email' => $email, 'password' => $password));
		$query = $query->result(); 
		$query = $query[0]; 
		return $query; 
	}
}
