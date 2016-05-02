
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
		<hr/>
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
			<label for="country_to">Vers:</label><br/>
			<select class="form-control input-lg" style="width: 100%; " name="country_to" id="country_to"
				disabled="disabled">
                        	<option class="form-control input-lg" value="" selected="selected">Pays du destinataire</option><hr/>
                                	<?php foreach ( $receive_countries as $country ) {?>
                               	<option class="form-contol input-lg" value="<?php echo $country->id;?>">
                                       	<?php echo $country->name; ?>
                                 </option><hr/>
                        	        <?php } ?>
                        </select>
			<br/>
			<label for="amount">Somme envoyée:</label><br/>
			<div class="form-group">
    				<div class="input-group">
      					<div class="input-group-addon btn-success" style="color: yellow; " id="send-money-sign">
												
					</div>
      					<input type="text" class="form-control input-lg" id="amount" name="amount" placeholder="Somme envoyée" autocomplete="off" 
					disabled="disabled">
      					<div class="input-group-addon btn-success" style="color: yellow; ">.00</div>
    				</div>
  			</div>
			<hr/>	
			<label for="amount_received">Somme reçue: </label><br/>
			<div class="form-group">
    				<div class="input-group">
      					<div class="input-group-addon btn-success" style="color: yellow; " id="receive-money-sign">
						
					</div>
      					<input type="text" class="form-control input-lg" id="amount_received" name="amount_received"
					disabled="disabled">
      					<div class="input-group-addon btn-success" style="color: yellow; ">.00</div>
    				</div>
  			</div>
			<!--<input type="text" name="amount_received" id="amount_received" class="form-control input-lg " placeholder="0.00"/>-->
			<br/><br/>
			<p id="cost"></p>
			<p id="change"></p>
			<br/>
			<br/><br/>
			<button disabled="disabled" style="float: center; " type="submit" class="btn btn-success" style="color: yellow; " id="submit">Envoyez de l'argent</button>
			<br/><br/>
			
		</form>
	</div>
</div>
</div>


<script>
$('#country_from').change(function() {
	var country	=	$("#country_from").val();
	if ( country == "") { 
		$("#submit").attr('disabled', 'disabled'); 
		$("#amount").attr('disabled', 'disabled'); 
	}
	$.ajax({
		'type'	:	"POST",
		'url'	:	"<?php echo base_url() . "index.php/user/country_values" ; ?>",
		'data'	:	'country=' +  country,
		'dataType' : 	"text",
		
		success : function (text, statut) {
			var res = text.split("&");
			$("#send-money-sign").text(res[3]);
			$("#country_to").removeAttr('disabled');
			

			if ( $("#country_from").val() != "" && $("#country_to").val() != "" )
			{
				$("#amount").removeAttr('disabled');				
			}

			if ( $("#country_from").val() != "" && $("#country_to").val() != "" && $("#amount").val() != "" )
			{
				$("#submit").removeAttr('disabled');				
			}
		},
	});
});

$('#country_to').change(function() {
        var country     =       $("#country_to").val();
	if ( country == "" ) { 
		$("#submit").attr('disabled', 'disabled'); 
		$("#amount").attr('disabled', 'disabled');
		return;
	}
        $.ajax({
                'type'  :       "POST",
                'url'   :       "<?php echo base_url() . "index.php/user/country_values" ; ?>",
                'data'  :       'country=' +  country,
                'dataType' :    "text",
                
                success : function (text, statut) {
                        var res = text.split("&");
                        $("#receive-money-sign").text(res[3]);
			$("#amount").removeAttr('disabled');
			if ( $("#country_from").val() != "" && $("#country_to").val() != "" && $("#amount").val() != "" )
                        {
                                $("#submit").removeAttr('disabled');
                        }

                },
        });
});


$('#amount').bind("keyup", function() {
        var amount      =       $("#amount").val();
	var amount_int	= 	parseInt(amount);
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
	                'data'  :       'country_from=' + $("#country_from").val() + "&" + "country_to=" + $("#country_to").val() + "&amount=" + amount,
        	        'dataType' :    "text",
                
	                success : function (text, statut) {
				var res = text.split("&");
                	        $("#amount_received").attr('value', res[0]);
				$("#cost").html("<b>Nos Frais</b>: " + ((res[1]== 0) ? 2.50 : res[1]) + " " + res[2]);
				$("#change").html("<b>Taux de change</b>: " + res[3]);
				$("#submit").removeAttr('disabled');
	                },
        	});
	} 
});


</script>
