
<br/><br/>
<div class="container">
	<div class="row">
		<ul class="nav nav-tabs ">
  			<li role="presentation" class="active col-md-4"><a href="<?php echo base_url(); ?>">Accueil</a></li>
			<li role="presentation" class="col-md-4"><a href="<?php echo base_url(); ?>index.php/user/recipient/">Destinataires</a></li>
  			<li role="presentation" class="col-md-4"><a href="<?php echo base_url(); ?>index.php/user/transfert/">Transferts</a></li>
		</ul>
	</div>
	<br/><br/>	
	<?php if ( count($transferts) != 0 ) { ?>
	<div class="row">
		<div class="col-md-9 col-md-offset-2" >
			<h3>Transferts récents</h3>
			<hr/>
			<div class="table-responsive">		
				<table class="table table-hover">
					<thead>
						<tr>
        						<th>Référence</th>
       							<th>Statut</th>
       							<th>Destinataire</th>
		       					<th>Envoyer</th>
	        					<th>Recevoir</th>
	        					<th>Résumé</th>
						</tr>
					</thead>
    					<tbody>
						<?php foreach ( $transferts as $transfert ) { ?>
							<tr>
								<td><?php echo strtoupper($transfert->reference); ?></td>
								<td><?php echo show_state($transfert->state); ?></td>
								<td><?php echo $this->user_model->get_recipient_name($transfert->recipient); ?></td>
								<td><?php echo $transfert->amount . " " .  
									$this->country_model->get_country_currency_sign($transfert->transfert_currency); ?></td>
								<?php
									$transfert_cost = 	$this->country_model->
										get_country_transfert_cost($transfert->receive_currency);
			                                                $change         =       $this->country_model->get_change(
                        			                                $transfert->transfert_currency,
                                                			        $transfert->receive_currency);
		                                                ?>
                		                                <td>
                                	                	        <?php echo number_format(
										(intval($transfert->amount)*$change->amount)-$transfert_cost) . " " .
                                          		              		$this->country_model->get_country_currency_sign(
										$transfert->receive_currency);?>
		                                                </td>  
								<td>
									<a href="<?php echo base_url(). "index.php/user/summary/" . strtoupper($transfert->reference); ?>">
										<button class="btn btn-default" title="Voir tous vos transferts à ce destinataire.">
											<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
										</button>
									</a>
								</td>
							</tr>
						<?php } ?>
    					</tbody>
  				</table>
			</div>
			<div style="float: right;">
				<a href="<?php echo base_url() . "index.php/user/transfert/"; ?>">
					<button  class="btn btn-primary" >VOIR TOUS VOS TRANSFERTS</button>
				</a>
			</div>
		</div>
	</div>
	<?php } else { ?>
	<div class="row">
		<div class="col-md-9 col-md-offset-2" >
			<h3>Transferts récents</h3>
			<hr/>
			<p style="margin: 50px; "> Vous n'avez pas encore effectué de transfert.</p>
			<a href="" style="margin: 50px; ">
				<button  class="btn btn-primary" >CREER UN BENEFICIARE</button>
			</a>
		</div>
	</div>
	<br/><br/>
	<?php } ?>

	<br/><br/>
	 <?php if ( count($recipients) != 0 ) { ?>
	<div class="row">
		<div class="col-md-9 col-md-offset-2">
			<h3>Vos bénéficiaires</h3>
			<hr/>			
			<div class="table-responsive">		
				<table class="table">
					<thead>
      						<tr>
        						<th>Prénom(s)</th>
        						<th>Nom</th>
        						<th>Pays</th>
	        					<th>Téléphone</th>
		        				<th>Actions</th>
      						</tr>
    					</thead>
    					<tbody>
						<?php foreach ( $recipients as $recipient ) { ?>
						<tr>
							<td><?php echo $recipient->firstname; ?></td>
							<td><?php echo $recipient->name; ?></td>
							<td><?php echo $this->country_model->get_country_name($recipient->country); ?></td>
							<td><?php echo "(". $this->country_model->get_country_code($recipient->country) . ") " .$recipient->phone_number; ?></td>
							<td>
								<?php $id = $recipient->id;?>
									<button class="btn btn-default" title="Voir tous vos transferts à ce destinataire."><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></button>
								<a href="<?php echo base_url() . "index.php/user/recipient/update/$id"; ?>">
									<button class="btn btn-primary" title="Modifier ce destinataire."><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
								</a>
								<a href="<?php echo base_url() . "index.php/user/transfert/new/$id"; ?>">
									<button class="btn btn-info" title="Envoyez de l'argent à ce destinataire."><span class="glyphicon glyphicon-send" aria-hidden="true"></span></button>
								</a>
							</td>
						<tr>	
						<?php } ?>
    					</tbody>
  				</table>
			</div>
			<div style="float: right;">
				<a href="<?php echo base_url() . "index.php/user/recipient/"; ?>">
					<button  class="btn btn-primary" >VOIR TOUS VOS DESTINATAIRES</button>
				</a>
			</div>
		</div>
	<div>
	<?php } else { ?>
	<div class="row">
		<div class="col-md-9 col-md-offset-2" >
			<h3>Vos bénéficiaires</h3>
			<hr/>
			<p style="margin: 50px; "> Vous n'avez aucun bénéficiare.</p>
			<a href="" style="margin: 50px; ">
				<button  class="btn btn-primary" >CREER UN BENEFICIARE</button>
			</a>
		</div>
	</div>
	<?php } ?>
</div>

<br/><br/>


