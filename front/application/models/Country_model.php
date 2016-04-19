
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
	
	public function get_country_name($country)
	{
		$query	=	"select name from country where id = '$country';"; 
		$query	=	$this->db->query($query); 
		$query	=	$query->result(); 
		$query	=	$query[0]; 
		return $query->name; 
	}
	public function get_country_currency($country)
	{
		$query	=	"select currency from country where id = '$country';"; 
		$query	=	$this->db->query($query); 
		$query	=	$query->result(); 
		$query	=	$query[0]; 
		return $query->currency; 
	}
	
	public function get_country_currency_sign($country)
	{
		$query	=	"select currency_sign from country, currency where country.id = '$country'  and country.currency = currency.id;"; 
		$query	=	$this->db->query($query); 
		$query	=	$query->result(); 
		$query	=	$query[0]; 
		return $query->currency_sign; 
	}
	public function get_country_code($country)
	{
		$query	=	"select phone_code from country where id = '$country';"; 
		$query	=	$this->db->query($query); 
		$query	=	$query->result(); 
		$query	=	$query[0]; 
		return $query->phone_code; 
	}
}
