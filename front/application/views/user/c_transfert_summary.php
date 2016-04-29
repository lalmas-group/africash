<br/><br/>
<div class="container">
	<div class="row">
		<ul class="nav nav-tabs ">
  			<li role="presentation" class="col-md-3"><a href="<?php echo base_url(); ?>">Accueil</a></li>
			<li role="presentation" class="col-md-3"><a href="<?php echo base_url(); ?>index.php/user/recipient/">Destinataires</a></li>
  			<li role="presentation" class="active col-md-3"><a href="<?php echo base_url(); ?>index.php/user/transfert/">Transferts</a></li>
			<li role="presentation" class="col-md-3"><a href="<?php echo base_url(); ?>index.php/user/account/">Mon compte</a></li>			
		</ul>
	</div>


	<br/><br/>	
	<div class="row">
		<h1 >Référence du retrait : <?php echo strtoupper($transfert->reference); ?></h1>
	</div>
	<div class=row" >
		<div class="col-md-6">	
			<br/>
			<h4>Statut</h4>
			<div style="border-radius: 2px 2px 2px 2px; box-shadow: 0 1px 5px rgba(0, 0, 0, 0.65);">
				<br/>
				<h4 style="margin: 20px;"> <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> <?php show_state($transfert->state);  ?></h4>
				<hr/ style="margin-left:20px; margin-right:20px;">
				<br/>
				<?php if ( $transfert->state == "WAIT_PAIEMENT" && $transfert->paiement_mean == 2) { ?>


					<p style="margin-left: 40px; margin-right: 40px;">
						Créditez votre ordre de transfert dans les 24 heures en versant €52.99 sur notre compte bancaire grâce à votre service bancaire en ligne ou téléphonique. 
					</p><br/>
					<p style="margin-left: 40px; margin-right: 40px;">
						En cas de paiement par transfert bancaire, nous devons recevoir votre paiement avant de pouvoir procéder au transfert. Cela pourrait entraîner d'autres retards en plus des 
						week-ends ou des jours fériés. 
					</p><br/>
					<h4 style="margin: 20px;"> <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Compte bancaire Africash</h4>
					<hr/ style="margin-left:20px; margin-right:20px;">

					<table class="table table-responsive borderless" style="margin: 40px; border: 0;">
						<tr style="border: none;">
							<td>Prenom: </td>
							<td>Africash Inc: </td>
						</tr>
						<tr>
							<td>Banque</td>
							<td>BNP Paribas</td>
						</tr>
						<tr>
							<td>IBAN: </td>
							<td>XXXXXXXXXXXXXXXXXXXXXXXXXXX</td>
						</tr>
						<tr>
							<td>BIC: </td>
							<td>XXXXXXXXXXX</td>
						</tr>
						<tr>
							<td>Numéro de compte: </td>
							<td>1111111111</td>
						</tr>
					</table>
					<br/>
				<?php }
					if ( $transfert->state == "FINISH" ) { ?>
					<p style="margin-left: 40px; margin-right: 40px;">
						Vous avez déjà régler ce transfert et votre destinataire a reçu votre transfert. 
					</p>
					<?php } else if ( $transfert->state == "WAIT_RECEIVE" ) { ?>
					<p style="margin-left: 40px; margin-right: 40px;">
						Ce transfert a été reglé, votre destinataire va recevoir les fonds très bientôt.  
					</p>
					<?php } else { ?>
						<a href="">
							<button class="btn btn-primary" style="width: 100%; ">Reglement par carte de crédit</button>
						</a>				
					<?php } ?>
    			</div>
		</div>
		<div class="col-md-6">	
			<br/>
			<h4>Informations surle transfert</h4>
			<div style="border-radius: 2px 2px 2px 2px; box-shadow: 0 1px 5px rgba(0, 0, 0, 0.65);">
				
					<br/>
					<h4 style="margin: 20px"> <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Informations sur le transfert</h4>
					<hr/ style="margin: 20px;">


					<p style="margin-left: 40px; margin-right: 40px;">
						Reference du retrait: <b><?php echo strtoupper($transfert->reference); ?></b><br/>
						Montant transféré   : <b><?php echo $transfert->amount . " " .  $this->country_model->get_country_currency_sign($transfert->transfert_currency); ?></b><br/>
						Montant à recevoir  : <b>467 500 GNF</b><br/>
						Nos frais  : <b>2,50 €</b><br/>
						Montant total :  <b>52,50 €</b><br/><br/>
							Veuillez renseigner le vrai numéro de votre destinataire, sinon il rique de ne pas recevoir votre transfert. 
					</p><br/>

					<h4 style="margin: 20px"> <span class="glyphicon glyphicon-phone" aria-hidden="true"></span> Adresse à créditer</h4>
					<hr/ style="margin: 20px;">
					<table class="table table-responsive borderless" style="margin: 40px; border: 0;">
						<tr style="border: none;">
							<td>Prenom: </td>
							<td><?php echo $recipient->firstname; ?></td>
						</tr>
						<tr style="border: none;">
							<td>Nom: </td>
							<td><?php echo $recipient->name; ?></td>
						</tr>
						<tr style="border: none;">
							<td>Pays: </td>
							<td><?php echo $this->country_model->get_country_name($recipient->country); ?></td>
						</tr>
						<tr style="border: none;">
							<td>Téléphone: </td>
							<td><?php echo "(". $this->country_model->get_country_code($recipient->country) . ") " .$recipient->phone_number; ?></td>
						</tr>
					</table>
					<br/><br/>
					<a href="<?php echo base_url() . "index.php/user/transfert/"; ?>">
						<button class="btn btn-primary" style="width: 100%; ">Retour à la liste de transferts</button>
					</a>				
    			</div>
  	</div>
</div>
