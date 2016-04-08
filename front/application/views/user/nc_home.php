
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
			<label for="amount">Somme envoyée:</label><br/>
			<div class="form-group">
    				<div class="input-group">
      					<div class="input-group-addon btn-primary" style="color: white; ">
						EUR
					</div>
      					<input type="text" class="form-control input-lg" id="acount" name="acount" placeholder="Somme envoyée">
      					<div class="input-group-addon btn-primary" style="color: white; ">.00</div>
    				</div>
  			</div>
<!--label for="from">De:</label><br/>
			<input type="text" name="from" id="from" class="form-control input-lg " placeholder="Pays de"/>-->
			<label for="to">Vers:</label><br/>
			<input type="text" name="to" id="to" class="form-control input-lg " value="Guinée" disabled/>
			<br/>
			<label for="delivry_mode">Mode de livraison:</label><br/>
			<input type="text" name="delivry_mode" id="delivry_mode" class="form-control input-lg " placeholder="Mode de livraison" disabled/>
			<br/>
			<hr/>	
			<label for="amount_received">Somme reçue: </label><br/>
			<div class="form-group">
    				<div class="input-group">
      					<div class="input-group-addon btn-primary" style="color: white; ">
						FG
					</div>
      					<input type="text" class="form-control input-lg" id="amount_received" name="amount_received" value="0" disabled>
      					<div class="input-group-addon btn-primary" style="color: white; ">.00</div>
    				</div>
  			</div>
			<!--<input type="text" name="amount_received" id="amount_received" class="form-control input-lg " placeholder="0.00"/>-->
			<p class="cost"></p>
			<button style="float: center; " type="submit" class="btn btn-primary">Envoyez de l'argent</button>
			<br/><br/>
			
		</form>
	</div>
</div>
</div>
