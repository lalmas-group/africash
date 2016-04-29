
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
			<h3 style="text-align: center;">Paiement par carte</h3>
			<hr/>
			<p> Nous acceptons : </p>
			<p>Image cartes ici</p>

			<h3>Entrez vos coordonnées bancaires</h3>
			<form method="post" action="<?php echo base_url() . "index.php/user/card_paiement/$reference"; ?>"  style="margin: 10px;">
			<?php if (!empty(form_error('name'))) { 
				/* L'adresse email est mal rempli */
			?>
			
				<div class="form-group has-error">
					<label class="control-label" for="name">Nom du titulaire:</label><br/>
    					<div class="input-group" style="width: 100%;">
      						<input type="text" class="form-control input-lg" id="name" name="name" value="<?php echo set_value('name');?>">
					</div>
					<div class="control-label"><?php echo form_error('name');?></div>
  				</div>
			<?php } else { ?>
				<?php if ( !empty(validation_errors()) && empty(form_error('name')) ) { 
					/* Erreur dans le formulaire mais pas ici */	
				?>
					<div class="form-group has-success">
						<label class="control-label" for="name">Nom du titulaire: </label><br/>
    						<div class="input-group" style="width: 100%;">
		      					<input type="text" class="form-control input-lg" id="name" name="name" value="<?php echo set_value('name');?>">
    						</div>
					</div>
				<?php } else { ?>
					<div class="form-group">
						<label class="control-label" for="name">Nom du titulaire: </label><br/>
    						<div class="input-group" style="width: 100%;">
		      					<input type="text" class="form-control input-lg" id="name" name="name"  style="width: 100%;" placeholder="Votre nom">
    						</div>
					</div>
			<?php 	}
			} ?>
			

			<?php if (!empty(form_error('card_number'))) { 
				/* L'adresse email est mal rempli */
			?>
			
				<div class="form-group has-error">
					<label class="control-label" for="card_number">Numéro de carte:</label><br/>
    					<div class="input-group" style="width: 100%;">
      						<input type="text" class="form-control input-lg" id="card_number" name="card_number" value="<?php echo set_value('card_number');?>">
					</div>
					<div class="control-label"><?php echo form_error('card_number');?></div>
  				</div>
			<?php } else { ?>
				<?php if ( !empty(validation_errors()) && empty(form_error('card_number')) ) { 
					/* Erreur dans le formulaire mais pas ici */	
				?>
					<div class="form-group has-success">
						<label class="control-label" for="card_number">Numéro de carte: </label><br/>
    						<div class="input-group" style="width: 100%;">
		      					<input type="text" class="form-control input-lg" id="card_number" name="card_number" value="<?php echo set_value('card_number');?>">
    						</div>
					</div>
				<?php } else { ?>
					<div class="form-group">
						<label class="control-label" for="card_number">Numéro de carte: </label><br/>
    						<div class="input-group" style="width: 100%;">
		      					<input type="text" class="form-control input-lg" id="card_number" name="card_number">
    						</div>
					</div>
			<?php 	}
			} ?>


				
			<?php if (!empty(form_error('expiration_date'))) { 
				/* L'adresse email est mal rempli */
			?>
			
				<div class="form-group has-error">
					<label class="control-label" for="expiration_date">Date d'expiration:</label><br/>
    					<div class="input-group" style="width: 100%;">
      						<input type="text" class="form-control input-lg" id="expiration_date" name="expiration_date" value="<?php echo set_value('expiration_date');?>">
					</div>
					<div class="control-label"><?php echo form_error('expiration_date');?></div>
  				</div>
			<?php } else { ?>
				<?php if ( !empty(validation_errors()) && empty(form_error('expiration_date')) ) { 
					/* Erreur dans le formulaire mais pas ici */	
				?>
					<div class="form-group has-success">
						<label class="control-label" for="expiration_date">Date d'expiration: </label><br/>
    						<div class="input-group" style="width: 100%;">
		      					<input type="text" class="form-control input-lg" id="expiration_date" name="expiration_date" value="<?php echo set_value('expiration_date');?>">
    						</div>
					</div>
				<?php } else { ?>
					<div class="form-group">
						<label class="control-label" for="expiration_date">Date d'expiration: </label><br/>
    						<div class="input-group" style="width: 100%;">
		      					<input type="text" class="form-control input-lg" id="expiration_date" name="expiration_date" >
    						</div>
					</div>
			<?php 	}
			} ?>




			<?php if (!empty(form_error('cvv'))) { 
				/* L'adresse email est mal rempli */
			?>
			
				<div class="form-group has-error">
					<label class="control-label" for="cvv">CVV:</label><br/>
    					<div class="input-group" style="width: 100%;">
      						<input type="text" class="form-control input-lg" id="cvv" name="cvv" value="<?php echo set_value('cvv');?>">
					</div>
					<div class="control-label"><?php echo form_error('cvv');?></div>
  				</div>
			<?php } else { ?>
				<?php if ( !empty(validation_errors()) && empty(form_error('cvv')) ) { 
					/* Erreur dans le formulaire mais pas ici */	
				?>
					<div class="form-group has-success">
						<label class="control-label" for="cvv">CVV: </label><br/>
    						<div class="input-group" style="width: 100%;">
		      					<input type="text" class="form-control input-lg" id="cvv" name="cvv" value="<?php echo set_value('cvv');?>">
    						</div>
					</div>
				<?php } else { ?>
					<div class="form-group">
						<label class="control-label" for="cvv">CVV: </label><br/>
    						<div class="input-group" style="width: 100%;">
		      					<input type="text" class="form-control input-lg" id="cvv" name"cvv">
    						</div>
					</div>
			<?php 	}
			} ?>

			<br/><br/>
			<button type="submit" class="btn btn-primary" style="width: 100%; ">Confirmer et payer 52,50 €(total_amount)</button>
			<br/><br/>	
			</form>
    		</div>
  	</div>
</div>
			</form>
    		</div>
  	</div>
</div>
