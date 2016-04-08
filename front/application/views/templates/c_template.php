<!DOCTYPE html>
<html lang="en">
  	<head>
    		<meta charset="utf-8">
	    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	    	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
   		 <title><?php echo $title ?></title>

	    	<!-- Bootstrap -->
    		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" 
		integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" 
		integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
	    	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	    	<!--[if lt IE 9]>
      			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	    	<![endif]-->
  	</head>
  	<body>
		<div class="container">
  			<nav class="navbar navbar-default row">
    				<div class="navbar-header">
    					<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".js-navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">My Store</a>
				</div>
	
				<div class="collapse navbar-collapse js-navbar-collapse">
					<ul class="nav navbar-nav row">			
						<li class="">
							<a href="#" >
								<button class="btn btn-primary">
									ENVOYER DE L'ARGENT
								</button>
							</a>				
						</li>
		 			        <li class="">
							<a href="#" >
								<button class="btn btn-primary">
									QUI SOMMES NOUS ?
								</button>
							</a>				
						</li>
		 			        <li class="">
							<a href="#" >
								<button class="btn btn-primary">
									CONTACTEZ-NOUS
								</button>
							</a>				
						</li>
				        	<ul class="nav navbar-nav navbar-right col-sm-offset-2">
        						<li class="dropdown">
	          						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" 
								aria-expanded="false">
									Moncompte
								</a>
          							<ul class="dropdown-menu" role="menu">
            								<li><a href="#">Action</a></li>
            								<li><a href="#">Another action</a></li>
            								<li><a href="#">Something else here</a></li>
            								<li class="divider"></li>
	            							<li><a href="<?php echo base_url(); ?>index.php/user/deconnexion/">Deconnexion</a></li>
        	  						</ul>
       							 </li>
      						</ul>
					</ul>
				</div><!-- /.nav-collapse -->
  			</nav>
		</div>
		
		<?php echo $content; ?>
	</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $(".dropdown").hover(            
        function() {
            $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true,true).slideDown("400");
            $(this).toggleClass('open');        
        },
        function() {
            $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true,true).slideUp("400");
            $(this).toggleClass('open');       
        }
    );
});
</script>
</html>
