
<br/><br/>
<div class="container">
	<div class="row">
		<ul class="nav nav-tabs ">
  			<li role="presentation" class="col-md-4"><a href="<?php echo base_url(); ?>">Accueil</a></li>
			<li role="presentation" class="col-md-4"><a href="<?php echo base_url(); ?>index.php/user/recipient//">Destinataires</a></li>
  			<li role="presentation" class="active col-md-4"><a href="<?php echo base_url(); ?>index.php/user/transfert/">Transferts</a></li>
		</ul>
	</div>
	
	<br/>
	<div class=row">
		<div class="col-md-6">
			<h3>Vos transferts effectués</h3>			
    		</div>
		<div class="col-md-2 col-md-offset-3">
			<br/>
			<a href="<?php echo base_url(); ?>index.php/user/transfert/recipient/">
				<button class="btn btn-primary">Envoyez de l'argent maintenant </button>
			</a>
    		</div>
  	</div>

	<br/><br/><br/><br/><br/><br/>
	<?php if ( count($transferts) != 0 ) { ?>
	<div class="row" style="margin: 10px; ">
		<div class="table-responsive">
		
			<table class="table table-hover">
				<thead>
      					<tr>
        					<th>Référence</th>
        					<th>Statut</th>
        					<th>Date</th>
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
						<td><?php echo show_date($transfert->creation_date);?></td>
						<td><?php echo $this->user_model->get_recipient_name($transfert->recipient); ?></td>
						<td><?php echo $transfert->amount . " " .  
							$this->country_model->get_country_currency_sign($transfert->transfert_currency); ?></td>
						<?php 
						$change         =       $this->country_model->get_change(
				                        $transfert->transfert_currency, 
							$transfert->receive_currency);
						?>
						<td>
							<?php echo number_format(intval($transfert->amount)*$change->amount) . " " .
                                                        $this->country_model->get_country_currency_sign($transfert->receive_currency);?>
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
			<nav>
				<ul class="pager">
					<?php if ( intval($page) >  0) { ?>
	    					<li><a href="<?php echo base_url() . 'index.php/user/show_transferts/' . (intval($page)-1) ; ?>"><?php echo "<< Prev"; ?></a></li>
					<?php } ?>
					<?php if ( (intval($page)*10)+10 < count($all_transferts)) { ?>
	    					<li><a href="<?php echo base_url() . 'index.php/user/show_transferts/' . (intval($page)+1) ; ?>"><?php echo ">> Next"; ?></a></li>
					<?php } ?>
					
  				</ul>
			</nav>	
		</div>
	</div>	
	<?php } else { ?>
	<div class="row">
		<div class="col-md-9 col-md-offset-2" >
			<h3>Vos transferts</h3>
			<hr/>
			<p style="margin: 50px; "> Vous n'avez pas encore effectué de transfert.</p>
			<a href="" style="margin: 50px; ">
				<button  class="btn btn-primary" >CREER UN BENEFICIARE</button>
			</a>
		</div>
	</div>
	<?php } ?>
	 
</div>
