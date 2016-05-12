
<br/><br/>
<div class="container">
	<div class="row">
		<ul class="nav nav-tabs ">
  			<li role="presentation" class="col-md-4"><a href="<?php echo base_url(); ?>">Accueil</a></li>
			<li role="presentation" class="col-md-4"><a href="<?php echo base_url(); ?>index.php/user/recipient/">Destinataires</a></li>
  			<li role="presentation" class="active col-md-4"><a href="<?php echo base_url(); ?>index.php/user/transfert/">Transferts</a></li>
		</ul>
	</div>


	<br/><br/>	
	<div class=row">
		<div class="col-md-5 col-md-offset-3" style="border-radius: 5px 5px 5px 5px; box-shadow: 0 1px 5px rgba(0, 0, 0, 0.65);">
			<br/>
			<h3 style="text-align: center;">Envoyez de l'argent</h3>
			<p>
				Saisissez le montant que vous voulez envoyer à votre destinataire, les frais que vous nous paierez 
				et la somme reçue par votre destinataire seront calculés automatiquement. 
			</p>
			<form method="post" action="<?php echo base_url(); ?>index.php/user/transfert/create/" style="margin: 10px;">
			<?php if (!empty(form_error('amount'))) { 
				/* L'adresse email est mal rempli */
			?>
			
				<div class="form-group has-error">
					<label class="control-label" for="amount">Envoyer:</label><br/>
	    				<div class="input-group">
      						<div class="input-group-addon btn-primary" style="color: white; ">
							<?php echo $this->country_model->get_country_currency_short_name(
							$this->session->userdata('country')); ?>
						</div>
      						<input type="text" class="form-control input-lg" id="amount" name="amount" 
							value="<?php echo ($this->session->userdata('simulator_amount') == null ) ? set_value('amount') : $this->session->userdata('simulator_amount');?>">
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
								<?php echo $this->country_model->get_country_currency_short_name(
								$this->session->userdata('country')); ?>
								
							</div>
		      					<input type="text" class="form-control input-lg" id="amount" name="amount" value="<?php echo set_value('amount');?>">
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
								<?php echo $this->country_model->get_country_currency_short_name(
								$this->session->userdata('country')); ?>
							</div>
		      					<input type="text" class="form-control input-lg" id="amount" name="amount">
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
					<label class="control-label" for="amount_received">Recevoir: </label><br/>
					<div class="input-group">
						<div class="input-group-addon btn-primary" style="color: white; ">
							<?php echo $this->country_model->get_country_currency_short_name(
								$recipient_object->country); ?>
						</div>
	      					<input type="text" class="form-control input-lg" id="amount_received"name="amount_received"
						disabled="disabled">
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
							<?php echo $this->country_model->get_country_currency_short_name(
							$this->session->userdata('country')); ?>
						</div>
	      					<input type="text" class="form-control input-lg" id="cost" name="cost" disabled="disabled">
					</div>
				</div>	
				<br/>
				<div class="form-group">
					<label class="control-label" for="currency_change">Taux de change: </label><br/>
					<div class="input-group">
						<div class="input-group-addon btn-primary" style="color: white; ">
							<?php echo $this->country_model->get_country_currency_short_name(
								$recipient_object->country); ?>
						</div>
	      					<input type="text" class="form-control input-lg" id="change" name="change" disabled="disabled">
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
							</div>	
							<div class="control-label"><?php echo form_error('paiement_means');?></div>
					</div>
				<?php } else { ?>
					<div class="form-group">
							<label class="control-label" for="paiement_means">Votre moyen de paiement: </label><br/>
							<div class="input-group">
								<input type="radio" name="paiement_means" value="1" > Carte bancaire </label><br/>
								<input type="radio" name="paiement_means" value="2"> Virement </label><br/>
							</div>	
							<div class="control-label"><?php echo form_error('paiement_means');?></div>
					</div>
			<?php 	}
			} ?>


				<br/><br/>
			

				<button type="submit" class="btn btn-primary" style="width: 100%; " id="submit" disabled="disabled">
					Valider
				</button>
				<input type="hidden" value="<?php echo $recipient; ?>" name="recipient"/>
			</form>
    		</div>
  	</div>
</div>
			</form>
    		</div>
  	</div>
</div>
<?php echo $this->session->userdata('country'); ?>

<script>
$('#amount').bind("keyup", function() {
        var amount      =       $("#amount").val();
        var amount_int  =       parseInt(amount);
        if ( isNaN(amount_int) && amount != "") {
                alert("Veuillez choisir un nombre !");
                $("#submit").attr('disabled', 'disabled'); 
                return;
        }
        if ( amount == "" ) {
                $("#submit").attr('disabled', 'disabled'); 
                return ; 
        }
        if ( !isNaN(amount_int) && amount_int != 0 )
        {
                $.ajax({
                        'type'  :       "POST",
                        'url'   :       "<?php echo base_url() . "index.php/user/amount_change/" ; ?>",
                        'data'  :       'country_from=' + <?php echo $this->session->userdata('country');?> + 
				"&" + "country_to=" + <?php echo $recipient_object->country; ?> + "&amount=" + amount,
                        'dataType' :    "text",
                
                        success : function (text, statut) {
                                var res = text.split("&");
                                $("#amount_received").attr('value', res[0]);
                                $("#cost").attr('value', res[1]);
                                $("#change").attr('value', res[3] );
                                $("#submit").removeAttr('disabled');
                        },
                });
        } 
});

</script>
