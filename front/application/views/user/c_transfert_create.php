
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
	<div class=row">
		<div class="col-md-5 col-md-offset-3" style="border-radius: 5px 5px 5px 5px; box-shadow: 0 1px 5px rgba(0, 0, 0, 0.65);">
			<br/>
			<h3>Envoyez de l'argent</h3>
			<p>
				Saisissez le montant que vous voulez envoyer à votre destinataire, les frais que vous nous paierez 
				et la somme reçue par votre destinataire seront calculés automatiquement. 
			</p>
			<form method="post" action="<?php echo base_url(); ?>index.php/user/transfert/paiement/" style="margin: 10px;">
			<?php if (!empty(form_error('amount'))) { 
				/* L'adresse email est mal rempli */
			?>
			
				<div class="form-group has-error">
					<label class="control-label" for="amount">Envoyer:</label><br/>
	    				<div class="input-group">
      						<div class="input-group-addon btn-primary" style="color: white; ">
							EUR
						</div>
      						<input type="text" class="form-control input-lg" id=amount" name="amount" value="<?php echo set_value('amount');?>">
      						<div class="input-group-addon btn-primary" style="color: white; ">
							.00
						</div>
					</div>
					<div class="control-label"><?php echo form_error('amount');?></div>
  				</div>
			<?php } else { ?>
				<?php if ( !empty(validation_errors()) && empty(form_error('amount')) ) { 
					/* Erreur dans le formulaire mais pas ici */	
				?>
					<div class="form-group has-success">
						<label class="control-label" for="amount">Envoyer: </label><br/>
						<div class="input-group">
      							<div class="input-group-addon btn-primary" style="color: white; ">
								EUR
							</div>
		      					<input type="text" class="form-control input-lg" id=amount" name="amount" placeholder="650535637" value="<?php echo set_value('amount');?>">
      							<div class="input-group-addon btn-primary" style="color: white; ">
								.00
							</div>
    						</div>
					</div>
				<?php } else { ?>
					<div class="form-group">
						<label class="control-label" for="amount">Envoyer: </label><br/>
    						<div class="input-group">
	      						<div class="input-group-addon btn-primary" style="color: white; ">
								EUR
							</div>
		      					<input type="text" class="form-control input-lg" id=amount" name="amount" value="50">
	      						<div class="input-group-addon btn-primary" style="color: white; ">
								.00
							</div>
    						</div>
					</div>
			<?php 	}
			} ?>


				
				<br/>
			<!-- END Email -->
						<div class="form-group">
							<label class="control-label" for="amount_receive">Recevoir: </label><br/>
    							<div class="input-group">
	      							<div class="input-group-addon btn-primary" style="color: white; ">
									GNF 
								</div>
			      					<input type="text" class="form-control input-lg" id=amount_receive" name="amount_receive" value="466 505">
	      							<div class="input-group-addon btn-primary" style="color: white; ">
									.00
								</div>
    							</div>
						</div>	
				<br/>
				<div class="form-group">
					<label class="control-label" for="cost">Nos Frais: </label><br/>
					<div class="input-group">
						<div class="input-group-addon btn-primary" style="color: white; ">
							EUR
						</div>
	      					<input type="text" class="form-control input-lg" id=cost" name="cost" value="2,50">
					</div>
				</div>	
				<br/>
				<div class="form-group">
					<label class="control-label" for="currency_change">Taux de change: </label><br/>
					<div class="input-group">
						<div class="input-group-addon btn-primary" style="color: white; ">
							GNF
						</div>
	      					<input type="text" class="form-control input-lg" id=cost" name="currency_change" value="9335.96608">
					</div>
				</div>
				<br/>
				<?php if (!empty(form_error('paiement_means'))) { 
					/* L'adresse email est mal rempli */
				?>
					
					<div class="form-group has-error">
	    					<div class="input-group">
							<label class="control-label" for="paiement_means">Votre moyen de paiement: </label><br/>
							<div class="input-group">
								<input type="radio" name="paiement_means" value="1"> Carte bancaire </label><br/>
								<input type="radio" name="paiement_means" value="2"> Virement </label><br/>
								<input type="radio" name="paiement_means" value="3"> Paypal </label>
							</div>	
							<div class="control-label"><?php echo form_error('paiement_means');?></div>
	  					</div>
				<?php } else { ?>
				<?php if ( !empty(validation_errors()) && empty(form_error('paiement_means')) ) { 
					/* Erreur dans le formulaire mais pas ici */	
				?>
					<div class="form-group has-success">
							<label class="control-label" for="paiement_means">Votre moyen de paiement: </label><br/>
							<div class="input-group">
								<input type="radio" name="paiement_means" value="1"> Carte bancaire </label><br/>
								<input type="radio" name="paiement_means" value="2"> Virement </label><br/>
								<input type="radio" name="paiement_means" value="3"> Paypal </label>
							</div>	
							<div class="control-label"><?php echo form_error('paiement_means');?></div>
					</div>
				<?php } else { ?>
					<div class="form-group">
							<label class="control-label" for="paiement_means">Votre moyen de paiement: </label><br/>
							<div class="input-group">
								<input type="radio" name="paiement_means" value="1" > Carte bancaire </label><br/>
								<input type="radio" name="paiement_means" value="2"> Virement </label><br/>
								<input type="radio" name="paiement_means" value="3"> Paypal </label>
							</div>	
							<div class="control-label"><?php echo form_error('paiement_means');?></div>
					</div>
			<?php 	}
			} ?>


				<br/><br/>
			

				<button type="submit" class="btn btn-primary" style="width: 100%; ">Créer un compte</button>
				<input type="hidden" value="<?php echo $recipient; ?>" name="recipient"/>
			</form>
    		</div>
  	</div>
</div>
			</form>
    		</div>
  	</div>
</div>
