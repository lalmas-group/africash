
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Country_model extends CI_Model 
{

	public function get_town_country($town)
	{
		$query	=	"select country from town where id = '$town';"; 
		$query	=	$this->db->query($query); 
		$query	=	$query->result(); 
		$query	=	$query[0]; 
		return $query->country; 
	}
}
