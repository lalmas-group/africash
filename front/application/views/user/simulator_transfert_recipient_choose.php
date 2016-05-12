
<br/><br/><br/>
<div class="container">
	<div class="row">
		<ul class="nav nav-tabs ">
  			<li role="presentation" class="col-md-4"><a href="<?php echo base_url(); ?>">Accueil</a></li>
			<li role="presentation" class="col-md-4"><a href="<?php echo base_url(); ?>index.php/user/recipient/">Destinataires</a></li>
  			<li role="presentation" class="active col-md-4"><a href="<?php echo base_url(); ?>index.php/user/transfert/">Transferts</a></li>
		</ul>
	</div>
	
	<br/>
	<div class=row">
		<div class="col-md-6">
			<h3>Destinataires</h3>			
    		</div>
		<div class="col-md-2 col-md-offset-3">
			<br/>
			<a href="<?php echo base_url(); ?>index.php/user/simulator/recipient//">
				<button class="btn btn-primary"> Créer un nouveau destinataire </button>
			</a>
    		</div>
  	</div>
	<br/><br/><br/><br/>
	<div class="row" style="margin: 10px; ">
		<div class="col-md-9 col-md-offset-1 table-responsive">
		
			<table class="table table-hover">
				<thead>
      					<tr>
        					<th>#</th>
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
						<td><?php echo $recipient->id; ?></td>
						<td><?php echo $recipient->firstname; ?></td>
						<td><?php echo $recipient->name; ?></td>
						<td><?php echo $this->country_model->get_country_name($recipient->country); ?></td>
						<td><?php echo "(". $this->country_model->get_country_code($recipient->country) . ") " .$recipient->phone_number; ?></td>
						<td>
							<?php $id =	$recipient->id; ?>
							<a href="<?php echo base_url() . "index.php/user/transfert/new/$id/"; ?>">
								<button class="btn btn-info" title="Envoyez de l'argent à ce destinataire.">Envoyez de l'argentà ce destinataire</button>
							</a>
						</td>
					<tr>	
					<?php } ?>
    				</tbody>
  			</table>
			
		</div>	
	</div>
</div>
