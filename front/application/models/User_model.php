
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
	

	public function create_transfert($data)
	{
		$this->db->trans_start(); 
			$this->db->insert('transfert', $data); 
		$this->db->trans_complete(); 
		if ($this->db->trans_status() === FALSE)
		{
			return 0; 
		}else {
			return 1; 
		}
	}
	
	public function update_user_recipient($user, $id, $name, $firstname, $country, $phone_number)
	{
		$data	=	array(
			'name'		=>	$name, 
			'firstname'	=>	$firstname,
			'phone_number'	=>	$phone_number,
			'country'	=>	$country
		); 
		$this->db->trans_start(); 
			$this->db->where('id', $id); 
			$this->db->update('recipient', $data); 
		$this->db->trans_complete(); 
		if ($this->db->trans_status() === FALSE)
		{
			return 0; 
		}else {
			return 1; 
		}
	}
	
	public function delete_user_recipient($recipient, $user)
	{
		$this->db->trans_start(); 
			$this->db->where('customer', $user); 
			$this->db->where('id', $recipient); 
			$this->db->delete('recipient'); 
		$this->db->trans_complete(); 
		if ($this->db->trans_status() === FALSE)
		{
			return 0; 
		}else {
			return 1; 
		}
	}



	public function create_recipient($data)
	{
		$this->db->trans_start(); 
			$this->db->insert('recipient', $data); 
			$id = $this->db->insert_id();
		$this->db->trans_complete(); 
		if ($this->db->trans_status() === FALSE)
		{
			return 0; 
		}else {
			return $id; 
		}
	}
	
	public function recipient_exists($user, $number, $country)
	{
		$query		=	"select * from recipient where recipient.phone_number = '$number' and recipient.country = '$country' and customer = '$user'";
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
	
	
	public function phone_number_already_user($number, $country)
	{
		$query		=	"select * from customer, country where customer.phone_number = '$number' and customer.country = '$country' and country.id = customer.country and country.id = '$country'";
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

	public function get_recipient($id) {
		$query = $this->db->get_where('recipient', array('id' => $id));
                $query = $query->result();
                $query = $query[0];
                return $query;
	}
	
	public function get_user_recipients($id)
	{
		$query = $this->db->get_where('recipient', array('customer' => $id ));
		$query = $query->result(); 
		return $query; 
	}
	public function get_recipient_name($id)
	{
		$query = $this->db->get_where('recipient', array('id' => $id ));
		$query = $query->result(); 
		$query = $query[0]; 
		return $query->firstname . " " . $query->name; 
	}
	


	public function get_user_transferts($id)
	{
		$query		=	"select * from transfert where transfert.customer = '$id' order by creation_date asc;";
		$query = $this->db->query($query); 
		return $query->result(); 
	}

	public function get_user_nb_transferts($user, $offset, $number)
	{
		$query		=	"select * from transfert where transfert.customer = '$user' order by creation_date desc limit $number offset $offset;";
		$query = $this->db->query($query); 
		return $query->result(); 
	}


	public function get_user_nb_recipients($user, $offset, $number)
	{
		$query		=	"select * from recipient where customer = '$user' limit $number offset $offset;";
		$query = $this->db->query($query); 
		return $query->result(); 
	}


	public function get_transfert_id_by_reference($reference)
	{
		$query		=	"select id from transfert where transfert.reference = '$reference';";
		$query = $this->db->query($query); 
		$query = $query->result(); 
		$query = $query[0]; 
		return $query->id; 
	}
	

	public function get_transfert_by_reference($reference)
	{
		$query		=	"select * from transfert where transfert.reference = '$reference';";
		$query = $this->db->query($query); 
		$query = $query->result(); 
		$query = $query[0]; 
		return $query; 
	}
	public function get_transfert_recipient_by_reference($reference)
	{
		$query		=	"select * from transfert, recipient where transfert.reference = '$reference' and transfert.recipient = recipient.id ;";
		$query = $this->db->query($query); 
		$query = $query->result(); 
		$query = $query[0]; 
		return $query; 
	}
}
