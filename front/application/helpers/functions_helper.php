
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function show_state($state)
{
	switch($state){
		case "WAIT_PAIEMENT":
			echo "En attente de paiement";
			break;
		case "FINISH":
			echo "Transfert déjà reglé";
			break;
		case "WAIT_RECEIVE":
			echo "En attente de réception par le destinataire";
			break;
	}
}


function show_date($date) 
{
	$date_tab = explode(" ", $date); 
	echo $date_tab[0] . " à " . $date_tab[1]; 
}
