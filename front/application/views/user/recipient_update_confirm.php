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
	<div class="row" style="margin: 10px;">
		<div class="col-md-offset-1 col-md-10">
			<?php if ( $status == "success" ) { ?>

				<h3><b>Mon compte</b></h3>
				<hr/><br/>
				
				<p style="color: green; margin: 10px;">Votre destinataire a bien été modifié avec succès.</p>

				<br/><br/>
				<div class="row" style="margin: 10px;">
					<a href="<?php echo base_url(); ?>index.php/user/recipient/" style="float: left; ">
						<button type="submit" class="btn btn-primary" style="width: 100%; ">Retour à la liste de destinataire</button>
					</a>
				</div>				

			<?php } else {?>
				<h3><b>Mon compte</b></h3>
				<hr/><br/>
				
				<p style="color: red/;">Votre destinataire n'a malheureusement pas été modifié. Veuillez réessayer plus tard.</p>
				

				<p style="color: red/;">Nous vous présentons nos sincères excuses pour se désagrément.</p>
				
				

				<br/><br/>
				<div class="row" style="margin: 10px;">
					<a href="<?php echo base_url(); ?>index.php/user/recipient/" style="float: left; ">
						<button type="submit" class="btn btn-primary" style="width: 100%; ">Retour à la liste de destinataire</button>
					</a>
				</div>				
			<?php } ?>
		</div>
	</div>
</div>
