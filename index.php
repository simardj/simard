<?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    session_start();
	require "facebook-php-sdk-v4-4.0-dev/autoload.php";
	use Facebook\FacebookSession;
	use Facebook\FacebookRedirectLoginHelper;
	use Facebook\FacebookRequest;
	use Facebook\GraphUser;
	const APPID = "1553479528238610";
	const APPSECRET = "f5b2542a764c91a66ec31f768bc87025";
	FacebookSession::setDefaultApplication(APPID, APPSECRET);
    $helper = new FacebookRedirectLoginHelper('https://simard.herokuapp.com');
	
	//SI les variables de sessions existent et que $_SESSION['fb_token'] existe
	// alors je veux créer mon utilisateur à partir de cette session
	if( isset($_SESSION) && isset($_SESSION['fb_token']) ) {
		$session = new FacebookSession($_SESSION['fb_token']);
	}
	//Sinon j'affiche le lien de connection
	else
	{
		$session = $helper->getSessionFromRedirect();
	}
	
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Titre de ma page</title>
		<meta name="description" content="contenu de ma page">
	</head>
	<body>
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

		<h1>Mon app FB</h1>

		<div
		  class="fb-like"
		  data-share="true"
		  data-width="450"
		  data-show-faces="true">
		</div>

		<br>
		<?php
			if($session)
			{
				$_SESSION['fb_token'] = (string) $session->getAccessToken();
				$request_user = new FacebookRequest( $session,"GET","/me");
				$request_user_executed = $request_user->execute();
				$user = $request_user_executed->getGraphObject(GraphUser::className());
				echo "Bonjour ".$user->getName();
			}else{
				$loginUrl = $helper->getLoginUrl();
				echo "<a href='".$loginUrl."'>Se connecter</a>";
			}
		?>
		

	</body>
</html>