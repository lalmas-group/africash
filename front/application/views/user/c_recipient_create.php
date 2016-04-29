
<br/><br/>
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
			<form action="<?php echo base_url() ; ?>index.php/user/recipient/create/" method="post">
			<h3><b>Créer un nouveau destinataire</b></h3>			
			<br/><br/>


				<?php if ( $error == "error" ) { ?>
                                <div class="alert alert-danger">
                                        <strong>Erreur!</strong> il n'y aucun compte existant avec ces identifiants.
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
		  					<input type="text" class="form-control input-lg" placeholder="Votre nom" name="name" value="<?php echo set_value('name');?>"/>
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
  							<input type="text" class="form-control input-lg" placeholder="Prénoms" name="firstname" value="<?php echo set_value('firstname');?>"/>
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
                                                        <?php foreach ( $countries as $country ) {?>
                                                                <option class="form-contol input-lg" value="<?php echo $country->id;?>" selected="<?php echo (($this->input->post('country') == $country->id) ? "selected" : "");?>">
                                                                        <?php echo $country->name; ?>
                                                                </option><hr/>
                                                        <?php } ?>
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
                                                        <?php foreach ( $countries as $country ) {?>
                                                                <option class="form-contol input-lg" value="<?php echo $country->id;?>" selected="<?php echo (($this->input->post('country') == $country->id) ? "selected" : "");?>">
                                                                        <?php echo $country->name; ?>
                                                                </option><hr/>
                                                        <?php } ?>
                                                </select>

						</div>
					<?php } else { ?>
						<div class="form-group">
							<label class="control-label" for="country">Pays</label><br/>
							 <select class="form-control input-lg" style="width: 100%; " name="country">
                                                        <option class="form-control input-lg" value="" <?php echo set_select('country', '', TRUE); ?>>Choisissez un pays</option><hr/>
                                                        <?php foreach ( $countries as $country ) {?>
                                                                <option class="form-contol input-lg" value="<?php echo $country->id;?>" selected="<?php echo (($this->input->post('country') == $country->id) ? "selected" : "");?>">
                                                                        <?php echo $country->name; ?>
                                                                </option><hr/>
                                                        <?php } ?>
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
	      					<input type="text" class="form-control input-lg" id=phone_number" name="phone_number" placeholder="650535637" value="<?php echo set_value('phone_number');?>">
    						</div>
					</div>
					<?php 	}
				} ?>

			<!-- end firstname -->
				<br/><br/><br/>
				<button type="submit" class="btn btn-primary" style="width: 100%; ">Créer le destinataire</button>
			</form>
    		</div>
  	</div>
</div>
