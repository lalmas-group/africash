<br/><br/>
<div class="container">
<div class="row" style="margin: 10px; ">
	<div class="col-md-6 col-md-offset-1 col-lg-6 col-lg-offset-1">
		<form method="post" action="<?php echo base_url(); ?>index.php/user/register">
			<h3><b>Vos infos de connexion</b></h3>
			<br/>


			<!-- Email -->
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
				</div>
			<?php 	} 
			}?>
			<br/>
			<!-- END Email -->






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
					</div>
			<?php 	} 
			}?>
		
			<br/>	
			<!-- End password -->






			<!-- password conf -->
			<?php if (!empty(form_error('password_conf'))) { 
				/* L'adresse email est mal rempli */
			?>
			
				<div class="form-group has-error">
					<label  class="control-label" for="password_conf">Confirmation de mot de passe</label><br/>
					<input class="form-control input-lg" type="password" name="password_conf"/><br/>
					<div class="control-label"><?php echo form_error('password_conf');?></div>
  				</div>
			<?php } else { ?>
				<?php if ( !empty(validation_errors()) && empty(form_error('password_conf')) ) { 
					/* Erreur dans le formulaire mais pas ici */	
				?>
					<div class="form-group has-success">
						<label class="control-label" for="password_conf">Confirmation de mot de passe</label><br/>
						<input class="form-control input-lg" type="password" name="password_conf"/><br/>
					</div>
				<?php } else { ?>
					<div class="form-group">
						<label class="control-label" for="password_conf">Confirmation de mot de passe</label><br/>
						<input class="form-control input-lg" type="password" name="password_conf"/><br/>
					</div>
			<?php 	}
			} ?> 
			<br/>
			<!-- END password conf -->
			<hr/>


			<h3><b>Vous</b></h3>

			<br/>
			






			<!-- name -->
			
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
			<!-- end name -->







			<!-- firstname -->
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
			<!-- end firstname -->


			<br/>
			<hr/>





			<h3><b>Vos coordonnées</b></h3><br/>




		
			
			<!-- country -->
			<?php if (!empty(form_error('country'))) { 
				/* L'adresse email est mal rempli */
			?>
				<div class="form-group has-error">
					<label class="control-label" for="country">Pays</label><br/>
						<select class="form-control input-lg" style="width: 100%; " name="country" id="country">
							<option class="form-control input-lg" value="" <?php echo set_select('country', '', TRUE); ?>>Choisissez un pays</option><hr/>
							<?php foreach ( $countries as $country ) {?>
								<option class="form-contol input-lg" value="<?php echo $country->id;?>">
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
						<select class="form-control input-lg" style="width: 100%; " name="country" id="country">
							<option class="form-control input-lg" value="" <?php echo set_select('country', '', TRUE); ?>>Choisissez un pays</option><hr/>
							<?php foreach ( $countries as $country ) {?>
								<option class="form-contol input-lg" value="<?php echo $country->id;?>">
									<?php echo $country->name; ?>
								</option><hr/>
							<?php } ?>
						</select>
					</div>
				<?php } else { ?>
					<div class="form-group">
						<label class="control-label" for="country">Pays</label><br/>
						<select class="form-control input-lg" style="width: 100%; " name="country" id="country">
							<option class="form-control input-lg" value="" <?php echo set_select('country', '', TRUE); ?>>Choisissez un pays</option><hr/>
							<?php foreach ( $countries as $country ) {?>
								<option class="form-contol input-lg" value="<?php echo $country->id;?>">
									<?php echo $country->name; ?>
								</option><hr/>
							<?php } ?>
						</select>
					</div>
			<?php 	}
			} ?> 
			<br/>
			<!-- end country-->

			




		

			<!-- adress -->			
			<?php if (!empty(form_error('address'))) { 
				/* L'adresse email est mal rempli */
			?>
			
				<div class="form-group has-error">
					<label class="control-label" for="address">Adresse: </label><br/>
  					<input type="text" class="form-control input-lg"   style="width: 100%; " name="address" value="<?php echo set_value('address');?>">
					<div class="control-label"><?php echo form_error('address');?></div>
  				</div>
			<?php } else { ?>
				<?php if ( !empty(validation_errors()) && empty(form_error('address')) ) { 
					/* Erreur dans le formulaire mais pas ici */	
				?>
					<div class="form-group has-success">
						<label class="control-label" for="address">Adresse: </label><br/>
			  			<input type="text" class="form-control input-lg"   style="width: 100%; " name="address" value="<?php echo set_value('address');?>">
					</div>
				<?php } else { ?>
					<div class="form-group">
						<label for="class="control-label" address">Adresse: </label><br/>
						<input type="text" class="form-control input-lg"   style="width: 100%; " name="address" value="<?php echo set_value('address');?>">
					</div>
			<?php 	}
			} ?> 
			<br/>
			<!-- end address -->
			
			<!-- end ville -->




			<!-- phone -->
			<?php if (!empty(form_error('phone_number'))) { 
				/* L'adresse email est mal rempli */
			?>
			
				<div class="form-group has-error">
					<label class="control-label" for="phone_number">Numéro de téléphone: </label><br/>
	    				<div class="input-group">
      						<div class="input-group-addon btn-primary" style="color: white; " id="country-phone-code">
							<?php echo $phone_code; ?>
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
      							<div class="input-group-addon btn-primary" style="color: white; " id="country-phone-code">
								<?php echo $phone_code; ?>
							</div>
		      					<input type="text" class="form-control input-lg" id=phone_number" name="phone_number" placeholder="650535637" value="<?php echo set_value('phone_number');?>">
    						</div>
					</div>
				<?php } else { ?>
					<div class="form-group">
						<label class="control-label" for="phone_number">Numéro de téléphone: </label><br/>
    						<div class="input-group">
	      						<div class="input-group-addon btn-primary" style="color: white;" id="country-phone-code">
							</div>
	      					<input type="text" class="form-control input-lg" id=phone_number" name="phone_number" placeholder="650535637" value="<?php echo set_value('phone_number');?>">
    						</div>
					</div>
			<?php 	}
			} ?>

			
			<br/><br/><br/>

			<button type="submit" class="btn btn-primary" style="width: 100%; ">Créer un compte</button>
			<br/><br/><br/></br>
			<p style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif;">En cliquanr sur "Créer un compte" vous acceptez les <a href="">Conditions Générales</a> d'Africa$h et sa 
				<a href="">Politique de Confidentialité</a></p>

			<br/><br/><br/>
		</form>
	</div>
</div>
</div>

<script>
$('#country').change(function() {
        var country     =       $("#country").val();
        $.ajax({
                'type'  :       "POST",
                'url'   :       "<?php echo base_url() . "index.php/user/country_values" ; ?>",
                'data'  :       'country=' +  country,
                'dataType' :    "text",
                
                success : function (text, statut) {
                        var res = text.split("&");
                        $("#country-phone-code").text(res[1]);
                },
        });
});
</script>
