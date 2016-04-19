
<br/><br/>
<div class="container">
	<div class="row">
		<ul class="nav nav-tabs ">
  			<li role="presentation" class="col-md-3"><a href="<?php echo base_url(); ?>">Accueil</a></li>
			<li role="presentation" class="col-md-3"><a href="<?php echo base_url(); ?>index.php/user/recipient//">Destinataires</a></li>
  			<li role="presentation" class="active col-md-3"><a href="<?php echo base_url(); ?>index.php/user/transfert/">Transferts</a></li>
			<li role="presentation" class="col-md-3"><a href="<?php echo base_url(); ?>index.php/user/account/">Mon compte</a></li>			
		</ul>
	</div>
	
	<br/>
	<div class=row">
		<div class="col-md-6">
			<h3>Transferts récents</h3>			
    		</div>
		<div class="col-md-2 col-md-offset-3">
			<br/>
			<a href="<?php echo base_url(); ?>index.php/user/transfert/recipient/">
				<button class="btn btn-primary">Envoyez de l'argent maintenant </button>
			</a>
    		</div>
  	</div>

	<br/><br/><br/><br/><br/><br/>
	<div class="row" style="margin: 10px; ">
		<div class="col-md-9 col-md-offset-1 table-responsive">
		
			<table class="table table-hover">
				<thead>
      					<tr>
        					<th>#</th>
        					<th>Référence</th>
        					<th>Statut</th>
        					<th>Date</th>
        					<th>Destinataire</th>
        					<th>Envoyer</th>
	        				<th>Recevoir</th>
      					</tr>
    				</thead>
    				<tbody>
					<?php foreach ( $transferts as $transfert ) { ?>
					<tr>
						<td><?php echo $transfert->id; ?></td>
						<td><?php echo strtoupper($transfert->reference); ?></td>
						<td><?php echo $transfert->state; ?></td>
						<td><?php ?></td>
						<td><?php echo $this->user_model->get_recipient_name($transfert->recipient); ?></td>
						<td><?php echo $transfert->amount . " " .  $this->country_model->get_country_currency_sign($transfert->transfert_currency); ?></td>
						<td>467 500 GNF</td>
					<tr>	
					<?php } ?>
    				</tbody>
  			</table>
			
		</div>
	</div>	
</div>
