<br/><br/>
<div class="container">
	<div class="row" style="margin: 10px;">
		<div class="col-md-offset-1 col-md-10">
			<?php if ( $status == "success" ) { ?>

				<h3><b>Mon compte</b></h3>
				<hr/><br/>
				
				<p style="text-color: green;">Votre compte a bien été crée. Vous allez recevoir un mail de confirmation de la part de nos équipes.</p>

				<br/><br/>
				<div class="row">
					<a href="" style="float: left; ">
						<button type="submit" class="btn btn-primary" style="width: 100%; ">Faire mon premier transfert</button>
					</a>
					<a href="" style="float: right; ">
						<button type="submit" class="btn btn-primary" style="width: 100%; ">Voir mon profil</button>
					</a>
				</div>				

			<?php } else {?>
				<h3><b>Mon compte</b></h3>
				<hr/><br/>
				
				<p style="text-color: red/;">Votre compte n'a malheureusement pas été crée. Veuillez réessayer plus tard.</p>
				

				<p style="text-color: red/;">Nous vous présentons nos sincères excuses pour se désagrément.</p>
				
				

				<br/><br/>
<!--				<div class="row">
					<a href="" style="float: left; ">
						<button type="submit" class="btn btn-primary" style="width: 100%; ">Faire mon premier transfert</button>
					</a>
					<a href="" style="float: right; ">
						<button type="submit" class="btn btn-primary" style="width: 100%; ">Voir mon profil</button>
					</a>
				</div>				-->
			<?php } ?>
		</div>
	</div>
</div>
