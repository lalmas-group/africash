
<br/><br/><br/>
<div class="container">
	<div class="row">
		<ul class="nav nav-tabs ">
  			<li role="presentation" class="col-md-4"><a href="<?php echo base_url(); ?>">Accueil</a></li>
			<li role="presentation" class="active col-md-4"><a href="<?php echo base_url(); ?>index.php/user/recipient/">Destinataires</a></li>
  			<li role="presentation" class="col-md-4"><a href="<?php echo base_url(); ?>index.php/user/transfert/">Transferts</a></li>
		</ul>
	</div>
	
	<br/>
	<div class=row">
		<div class="col-md-6">
			<h3>Destinataires</h3>			
    		</div>
		<div class="col-md-2 col-md-offset-3">
			<br/>
			<a href="<?php echo base_url(); ?>index.php/user/recipient/create/">
				<button class="btn btn-primary"> Créer un nouveau destinataire </button>
			</a>
    		</div>
  	</div>
	<br/><br/><br/><br/>
	<?php if ( count($recipients) != 0 ) { ?>
	<div class="row" style="margin: 10px; ">
		<div class="col-md-8 col-md-offset-2 table-responsive">
		
			<table class="table table-hover">
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
							<a href="<?php echo base_url() . "index.php/user/recipient/delete/$id"; ?>">
								<button class="btn btn-danger" title="Supprimer ce destinataire."><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
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
	</div>
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
