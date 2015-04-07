<?php

	error_reporting()(E_ALL);
	init_set("display_errors", 1);
	
	/* 
	** Installation SDK FACEBOOK
	*/

	session_start();

	require("facebook-php-sdk-v4-4.0-dev/autoload.php");

	use Faceook\FacebookSession;	
	use Facebook\FacebookRedirectLoginHelper;	

	const APPID = "1553479528238610";
	const APPSECRET = "f5b2542a764c91a66ec31f768bc87025";

	FacebookSession::setDefaultApplication(APPID, APPSECRET);

	/* 
	** Générer l'URL de connexion
	*/

	$helper = new FacebookRedirectLoginHelper("https://simard.herokuapp.com");


?>

<!DOCTYPE html>

<html>

	<head>
		<meta charset="UTF-8">
		<title>App Facebook</title>
		<meta name="description" content="Page de test : App Facebook">

		<!-- 
			Connexion JavaScript (Plugins)
		-->
		<script>
		  window.fbAsyncInit = function() {
		    FB.init({
		      appId      : '<?php echo APPID; ?>',
		      xfbml      : true,
		      version    : 'v2.3'
		    });
		  };

		  (function(d, s, id){
		     var js, fjs = d.getElementsByTagName(s)[0];
		     if (d.getElementById(id)) {return;}
		     js = d.createElement(s); js.id = id;
		     js.src = "//connect.facebook.net/fr_FR/sdk.js";
		     fjs.parentNode.insertBefore(js, fjs);
		   }(document, 'script', 'facebook-jssdk'));
		</script>		
	</head>

	<body>
		<!--
			Bouton J'aime / Partager
		-->
		<div
		  class="fb-like"
		  data-share="true"
		  data-width="450"
		  data-show-faces="true">
		</div>

		<!--
			Commentaires
		-->
		<div class="fb-comments" data-href="http://developers.facebook.com/docs/plugins/comments/" data-numposts="5" data-colorscheme="light"></div>

		<?php
			$loginUrl = $helper->getLoginUrl();
			echo '<a href="'.$loginUrl.'">Se connecter</a>';
		?>

	</body>

</html>