
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

	public function get_country($id)
        {
                $query  =       "select * from country where id = '$id';";
                $query  =       $this->db->query($query);
                $query  =       $query->result();
                $query  =       $query[0];
                return $query;
        }
	public function get_change($currency_from, $currency_to)
        {
                $query  =       "select * from currency_translate where currency_from = '$currency_from' and currency_to = '$currency_to';";
                $query  =       $this->db->query($query);
                $query  =       $query->result();
                $query  =       $query[0];
                return $query;
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
	public function get_country_currency_short_name($country)
	{
		$query	=	"select short_name from country, currency where country.id = '$country'  and country.currency = currency.id;"; 
		$query	=	$this->db->query($query); 
		$query	=	$query->result(); 
		$query	=	$query[0]; 
		return $query->short_name; 
	}
	public function get_country_code($country)
	{
		$query	=	"select phone_code from country where id = '$country';"; 
		$query	=	$this->db->query($query); 
		$query	=	$query->result(); 
		$query	=	$query[0]; 
		return $query->phone_code; 
	}

	public function get_all_countries_send_money()
	{
		$query	=	"select distinct * from country where money_send = '1';"; 
		$query	=	$this->db->query($query); 
		$query	=	$query->result(); 
		return $query; 
	}
	

	public function get_all_countries_receive_money()
	{
		$query	=	"select * from country where money_receive = '1';"; 
		$query	=	$this->db->query($query); 
		$query	=	$query->result(); 
		return $query; 
	}
}
