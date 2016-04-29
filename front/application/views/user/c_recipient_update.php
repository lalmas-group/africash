<div class="container">
	<div class="row">
		<ul class="nav nav-tabs ">
  			<li role="presentation" class="col-md-3"><a href="<?php echo base_url(); ?>">Accueil</a></li>
			<li role="presentation" class="active col-md-3"><a href="<?php echo base_url(); ?>index.php/user/recipient/">Destinataires</a></li>
  			<li role="presentation" class="col-md-3"><a href="<?php echo base_url(); ?>index.php/user/transfert/">Transferts</a></li>
			<li role="presentation" class="col-md-3"><a href="<?php echo base_url(); ?>index.php/user/account/">Mon compte</a></li>			
		</ul>
	</div>
	
	<br/>
	<br/><br/><br/>
	<div class=row">
		<div class="col-md-offset-3 col-md-5">
			<?php $id  = $recipient->id; ?>
			<form action="<?php echo base_url() . "index.php/user/recipient/update/$id/update/"; ?>" method="post">
			<h3><b>Modifier votre bénéficiare N. <?php echo $recipient->id; ?></b></h3>			
			<br/><br/>


				<?php if ( $error == "error_update" ) { ?>
                                <div class="alert alert-danger">
                                        <strong>Erreur!</strong> Vous n'avez modifié aucune donnée.
                                </div>
				<br/>
	                       	<?php } ?>
				
			 	<?php if ( $error == "phone_already_use" ) { ?>
                                <div class="alert alert-danger">
                                        <strong>Erreur!</strong> Le numéro de téléphone que vous avez choisi a déjà été utilisé.
                                </div>
				<br/>
				<?php } ?>
			 	

				<?php if ( $error == "update_error" ) { ?>
                                <div class="alert alert-danger">
                                        <strong>Erreur!</strong> Vous n'avez modifié aucune valeur. .
                                </div>
				<br/>
				<?php } ?>

				<?php if (!empty(form_error('name'))) { 
					/* L'adresse email est mal rempli */
				?>
				
					<div class="form-group has-error">
						<label class="control-label" for="name">Nom</label>
			  			<input type="text" class="form-control input-lg" placeholder="Votre nom" name="name" value="<?php echo set_value('name');?>"/>
						<div class="control-label"><?php echo form_error('name');?></div>
  					</div>
				<?php } else { ?>
					<?php if ( !empty(validation_errors()) && empty(form_error('name')) ) { 
						/* Erreur dans le formulaire mais pas ici */	
					?>
						<div class="form-group has-success">
							<label class="control-label" for="name">Nom</label>
		  					<input type="text" class="form-control input-lg" placeholder="Votre nom" name="name" value="<?php echo set_value('name');?>"/>
						</div>
					<?php } else { ?>
						<div class="form-group">
							<label class="control-label" for="name">Nom</label>
		  					<input type="text" class="form-control input-lg" placeholder="Votre nom" name="name" value="<?php echo $recipient->name;?>"/>
						</div>
				<?php 	}
				} ?> 
				<br/>
				<?php if (!empty(form_error('firstname'))) { 
					/* L'adresse email est mal rempli */
				?>
				
					<div class="form-group has-error">
						<label class="control-label" for="fistname">Prénom(s)</label>
		  				<input type="text" class="form-control input-lg" placeholder="Prénoms" name="firstname" value="<?php echo set_value('firstname');?>"/>
						<div class="control-label"><?php echo form_error('firstname');?></div>
  					</div>
				<?php } else { ?>
					<?php if ( !empty(validation_errors()) && empty(form_error('firstname')) ) { 
						/* Erreur dans le formulaire mais pas ici */	
					?>
						<div class="form-group has-success">
							<label class="control-label" for="fistname">Prénom(s)</label>
		  					<input type="text" class="form-control input-lg" placeholder="Prénoms" name="firstname" value="<?php echo set_value('firstname');?>"/>
						</div>
					<?php } else { ?>
						<div class="form-group">
							<label class="control-label" for="fistname">Prénom(s)</label>
  							<input type="text" class="form-control input-lg" placeholder="Prénoms" name="firstname" value="<?php echo $recipient->firstname;?>"/>
						</div>
					<?php 	}
				} ?> 
			<br/>
				<?php if (!empty(form_error('country'))) { 
					/* L'adresse email est mal rempli */
				?>
				
					<div class="form-group has-error">
						<label class="control-label" for="country">Pays</label><br/>
							<select class="form-control input-lg" style="width: 100%; " name="country">
								<option class="form-control input-lg" value="" <?php echo set_select('country', '', TRUE); ?>>Choisissez un pays</option><hr/>
								<option class="form-control input-lg" value="1" <?php echo set_select('country', '1', TRUE); ?>>France</option><hr/>
								<option class="form-control input-lg" value="2" <?php echo set_select('country', '2', TRUE); ?>>Belgique</option><hr/>
							</select>
						<div class="control-label"><?php echo form_error('country');?></div>
  					</div>
				<?php } else { ?>
					<?php if ( !empty(validation_errors()) && empty(form_error('country')) ) { 
						/* Erreur dans le formulaire mais pas ici */	
					?>
						<div class="form-group has-success">
							<label class="control-label" for="country">Pays</label><br/>
								<select class="form-control input-lg" style="width: 100%; " name="country">
									<option class="form-control input-lg" value="" <?php echo set_select('country', '', TRUE); ?>>Choisissez un pays</option><hr/>
									<option class="form-control input-lg" value="1" <?php echo set_select('country', '1', TRUE); ?>>France</option><hr/>
									<option class="form-control input-lg" value="2" <?php echo set_select('country', '2', TRUE); ?>>Belgique</option><hr/>
								</select>
						</div>
					<?php } else { ?>
						<div class="form-group">
							<label class="control-label" for="country">Pays</label><br/>
								<select class="form-control input-lg" style="width: 100%; " name="country">
									<option class="form-control input-lg" value="" <?php echo set_select('country', '', TRUE); ?>>Choisissez un pays</option><hr/>
									<option class="form-control input-lg" value="1" <?php echo set_select('country', '1', TRUE); ?>>France</option><hr/>
									<option class="form-control input-lg" value="2" <?php echo set_select('country', '2', TRUE); ?>>Belgique</option><hr/>
								</select>
						</div>
					<?php 	}
				} ?> 
				<br/>
				<!-- end country-->
				<!-- phone -->
				<?php if (!empty(form_error('phone_number'))) { 
					/* L'adresse email est mal rempli */
				?>
				
					<div class="form-group has-error">
						<label class="control-label" for="phone_number">Numéro de téléphone: </label><br/>
		    				<div class="input-group">
      							<div class="input-group-addon btn-primary" style="color: white; ">
								0033
							</div>
      							<input type="text" class="form-control input-lg" id=phone_number" name="phone_number" placeholder="650535637" value="<?php echo set_value('phone_number');?>">
						</div>
						<div class="control-label"><?php echo form_error('phone_number');?></div>
  					</div>
				<?php } else { ?>
				<?php if ( !empty(validation_errors()) && empty(form_error('phone_number')) ) { 
					/* Erreur dans le formulaire mais pas ici */	
				?>
					<div class="form-group has-success">
						<label class="control-label" for="phone_number">Numéro de téléphone: </label><br/>
						<div class="input-group">
      							<div class="input-group-addon btn-primary" style="color: white; ">
								0033
							</div>
		      					<input type="text" class="form-control input-lg" id=phone_number" name="phone_number" placeholder="650535637" value="<?php echo set_value('phone_number');?>">
    						</div>
					</div>
				<?php } else { ?>
					<div class="form-group">
						<label class="control-label" for="phone_number">Numéro de téléphone: </label><br/>
    						<div class="input-group">
	      						<div class="input-group-addon btn-primary" style="color: white; ">
								0033
							</div>
	      					<input type="text" class="form-control input-lg" id=phone_number" name="phone_number" placeholder="650535637" value="<?php echo $recipient->phone_number;?>">
    						</div>
					</div>
					<?php 	}
				} ?>

			<!-- end firstname -->
				<br/><br/>
				<button type="submit" class="btn btn-primary" style="width: 100%; ">Modifier le destinataire</button>
				<br/><br/>
				<a href="<?php echo base_url() . "index.php/user/recipient/"; ?>" style="float: center; ">
					Annuler
				</a>
			</form>
    		</div>
  	</div>
</div>
