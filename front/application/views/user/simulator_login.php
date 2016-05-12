<br/><br/>
<div class="container">
<div class="row" style="margin: 10px;"> 
	<div class="col-md-5 col-md-offset-3" style="border-radius: 5px 5px 5px 5px; box-shadow: 0 1px 5px rgba(0, 0, 0, 0.65);">
		<form method="post" action="<?php echo base_url() ; ?>index.php/user/simulator/connect/">
			<h3 style="text-align: center; "><b>Connectez-vous</b></h3>
			<hr/><br/>
			<!-- Email -->

			<?php if ( $error == "error" ) { ?>
				<div class="alert alert-danger">
	  				<strong>Erreur!</strong> il n'y aucun compte existant avec ces identifiants.
				</div>
			<?php } ?>
			
			<?php if (!empty(form_error('email'))) { 
				/* L'adresse email est mal rempli */
			?>
			
				<div class="form-group has-error">
					<label class="control-label" for="email">Email:</label><br/>
    					<input class="form-control input-lg" name="email" type="text" placeholder="Votre adresse email" value="<?php echo set_value('email');?>"/> 
					<div class="control-label"><?php echo form_error('email');?></div>
  				</div>
			<?php } else { ?>
				<?php if ( !empty(validation_errors()) && empty(form_error('email')) ) { 
					/* Erreur dans le formulaire mais pas ici */	
				?>
					<div class="form-group has-success">
						<label class="control-label" for="email">Email:</label><br/>
						<input class="form-control input-lg " type="text" name="email" value="<?php echo set_value('email');?>"/>
					</div>
				<?php } else { ?>
				<div class="form-group">
					<label class="control-label" for="email">Email:</label><br/>
					<input class="form-control input-lg" type="text" placeholder="votre adresse email" name="email" value="<?php echo set_value('email');?>"/>
					<div class="control-label"><?php echo form_error('email');?></div>
				</div>
			<?php 	} 
			}?>
			<br/>
			

			
			<!-- password -->
			<?php if (!empty(form_error('password'))) { 
				/* L'adresse email est mal rempli */
			?>
			
				<div class="form-group has-error">
					<label class="control-label" for="password">Mot de passe:</label><br/>
					<input class="form-control input-lg" type="password"  name="password" />
					<div class="control-label"><?php echo form_error('password');?></div>
  				</div>
			<?php } else { ?>
				<?php if ( !empty(validation_errors()) && empty(form_error('password')) ) { 
					/* Erreur dans le formulaire mais pas ici */	
				?>
					<div class="form-group has-success">
						<label class="control-label" for="password">Mot de passe:</label><br/>
						<input class="form-control input-lg" type="password"  name="password" />
					</div>
				<?php } else { ?>
					<div class="form-group">				
						<label class="control-label" for="password">Mot de passe:</label><br/>
						<input class="form-control input-lg" type="password"  name="password" />
						<div class="control-label"><?php echo form_error('password');?></div>
					</div>
					<a href="#"><b>Mot de passe oublié ?</b></a>
			<?php 	} 
			}?>

		
			<br/><br/>
			<button type="submit" class="btn btn-primary" style="width: 100%; ">Connectez-vous!</button>
			<br/><br/>
			OU
			<br/><br/>	
			<button type="submit" class="btn btn-primary" style="width: 100%; ">Connectez vous sur facebook</button>
			<br/><br/>
			<p>Vous n'êtes pas encore client ?, <a href="<?php echo base_url(); ?>index.php/user/simulator/registration/">S'inscrire maintenant</a></p>
		</form>
	</div>
</div>
<div>
