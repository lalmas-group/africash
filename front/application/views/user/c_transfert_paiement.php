<br/><br/>
<div class="container">
	<div class="row">
		<ul class="nav nav-tabs ">
  			<li role="presentation" class="col-md-4"><a href="<?php echo base_url(); ?>">Accueil</a></li>
			<li role="presentation" class="col-md-4"><a href="<?php echo base_url(); ?>index.php/user/recipient/">Destinataires</a></li>
  			<li role="presentation" class="active col-md-4"><a href="<?php echo base_url(); ?>index.php/user/transfert/">Transferts</a></li>
		</ul>
	</div>
	<br/><br/><br/>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<?php if ( $status == "success" ) { ?>

				<h3><b>Votre transfert</b></h3>
				<hr/><br/>
				
				<p style="text-color: green; margin: 10px; font-size: 18px; line-height: 24px; ">Votre transfert de reférence <?php echo strtoupper($reference); ?> a bien été crée.</p>

				<br/>

				<p style="text-color: green; margin: 10px; font-size: 18px; line-height: 24px;">Créditez votre ordre de transfert dnas les 24h en nous versant 55 € (total_amount) sur notre compte bancaire grâce à votre service bancaire en ligne de votre banque..</p>
					
				

				<br/>
				<p style="text-color: green; margin: 10px; font-size: 18px; line-height: 24px;">Attention : Nous debvons recevoir votre virement avant de procéder au transfert. Ceci pourra retarder votre transfert encore plus longtemps les 
				week-end. .</p>

				<br/><br/>
				<div class="row" style="margin: 10px;">
					<a href="<?php echo base_url(); ?>index.php/user/transfert/" style="float: left; ">
						<button type="submit" class="btn btn-primary" style="width: 100%; ">Retour à la liste de transferts</button>
					</a>
				</div>				

			<?php } else {?>
				<h3><b>Mon compte</b></h3>
				<hr/><br/>
				
				<p style="text-color: red/;">Votre transfert n'a malheureusement pas été crée. Veuillez réessayer plus tard.</p>
				

				<p style="text-color: red/;">Nous vous présentons nos sincères excuses pour se désagrément.</p>
				
				

				<br/><br/>
				<div class="row" style="margin: 10px;">
					<a href="<?php echo base_url(); ?>index.php/user/recipient/" style="float: left; ">
						<button type="submit" class="btn btn-primary" style="width: 100%; ">Retour à la liste de transferts</button>
					</a>
				</div>				
			<?php } ?>
		</div>
	</div>
</div>
