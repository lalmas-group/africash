
<br/>
<div class="container">
<div class="row" style="margin: 10px;">
	<div class="col-md-7 col-lg-7">
		<h3>Avec Africash, envoyez de l'argent en afrique en un click.</h3>

		<br/>
		<img src="<?php echo base_url(); ?>vendor/images/pyNVUg5EM0j.png" alt="money send network image"/>
	</div>
	<div class="col-md-4 col-md-offset-1 col-lg-4 col-lg-offset-1" style="border-radius: 5px 5px 5px 5px; box-shadow: 0 1px 5px rgba(0, 0, 0, 0.65);">
		<h3 style="text-align: center;">Simulez votre transfert</h3>
		<br/>
		<form method="" action="">
			<label for="country_from">De:</label><br/>
			<select class="form-control input-lg" style="width: 100%; " name="country_from" id="country_from">
                        	<option class="form-control input-lg" value="" <?php echo set_select('country_from', '', TRUE); ?>>Votre pays</option><hr/>
                                	<?php foreach ( $send_countries as $country ) {?>
                               	<option class="form-contol input-lg" value="<?php echo $country->id;?>">
                                       	<?php echo $country->name; ?>
                                 </option><hr/>
                        	        <?php } ?>
                        </select>

			<br/>
			<label for="amount">Somme envoyée:</label><br/>
			<div class="form-group">
    				<div class="input-group">
      					<div class="input-group-addon btn-success" style="color: yellow; ">
						EUR
					</div>
      					<input type="text" class="form-control input-lg" id="acount" name="acount" placeholder="Somme envoyée">
      					<div class="input-group-addon btn-success" style="color: yellow; ">.00</div>
    				</div>
  			</div>
			<label for="country_to">Vers:</label><br/>
			<select class="form-control input-lg" style="width: 100%; " name="country_to">
                        	<option class="form-control input-lg" value="nothing" selected="selected">Pays du destinataire</option><hr/>
                                	<?php foreach ( $receive_countries as $country ) {?>
                               	<option class="form-contol input-lg" value="<?php echo $country->id;?>" selected="<?php echo (($this->input->post('country') == $country->id) ? "selected" : "");?>">
                                       	<?php echo $country->name; ?>
                                 </option><hr/>
                        	        <?php } ?>
                        </select>
			<br/>
			<label for="delivry_mode">Mode de livraison:</label><br/>
			<input type="text" name="delivry_mode" id="delivry_mode" class="form-control input-lg " placeholder="Mode de livraison" disabled/>
			<br/>
			<hr/>	
			<label for="amount_received">Somme reçue: </label><br/>
			<div class="form-group">
    				<div class="input-group">
      					<div class="input-group-addon btn-success" style="color: yellow; ">
						GNF
					</div>
      					<input type="text" class="form-control input-lg" id="amount_received" name="amount_received" value="0" disabled>
      					<div class="input-group-addon btn-success" style="color: yellow; ">.00</div>
    				</div>
  			</div>
			<!--<input type="text" name="amount_received" id="amount_received" class="form-control input-lg " placeholder="0.00"/>-->
			<p class="cost"></p>
			<br/>
			<br/><br/>
			<button style="float: center; " type="submit" class="btn btn-success" style="color: yellow; ">Envoyez de l'argent</button>
			<br/><br/>
			
		</form>
	</div>
</div>
</div>


<script>
$('#country_from').change(function() {
	alert( "Handler for .change() called." );
	var country	=	$("#country_from").val();
	alert(country);
	$.ajax({
		'type'	:	"POST",
		'url'	:	"<?php echo base_url() . "index.php/user/country_values" ; ?>",
		'data'	:	'country=' +  country,
		'dataType' : 	"text",
		
		success : function (text, statut) {
			alert('' +  text);
		},
	});
});
</script>
