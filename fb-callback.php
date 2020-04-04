<?php
	require_once "fb_config.php";

	try {
		$accessToken = $helper->getAccessToken();
	} catch (\Facebook\Exceptions\FacebookResponseException $e) {
		echo "Response Exception: " . $e->getMessage();
		exit();
	} catch (\Facebook\Exceptions\FacebookSDKException $e) {
		echo "SDK Exception: " . $e->getMessage();
		exit();
	}

    if (! isset($accessToken)) {
        if ($helper->getError()) {
          header('HTTP/1.0 401 Unauthorized');
          echo "Error: " . $helper->getError() . "\n";
          echo "Error Code: " . $helper->getErrorCode() . "\n";
          echo "Error Reason: " . $helper->getErrorReason() . "\n";
          echo "Error Description: " . $helper->getErrorDescription() . "\n";
        } else {
          header('HTTP/1.0 400 Bad Request');
          echo 'Bad request';
        }
        header('Location: https://digitotalbd.com/docket299/SignIn.php');
        exit;
    }

    $oAuth2Client = $FB->getOAuth2Client();
    
    $tokenMetadata = $oAuth2Client->debugToken($accessToken);
    $tokenMetadata->validateAppId('208761533528895');
    $tokenMetadata->validateExpiration();

	if (! $accessToken->isLongLived()) {
        // Exchanges a short-lived access token for a long-lived one
        try {
          $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
          echo "<p>Error getting long-lived access token: " . $e->getMessage() . "</p>\n\n";
          exit;
        }
      
        echo '<h3>Long-lived</h3>';
        var_dump($accessToken->getValue());
    }

    //$response = $FB->get("/me?fields=id, first_name, last_name, email, picture?redirect=false&width=300&height=300", $accessToken);
    $response = $FB->get("/me?fields=id, first_name, last_name, email,friends, picture.type(large)", $accessToken);
    //$response = $FB->get("/me?fields=id, first_name, last_name, email, picture", $accessToken);
    //$requestPicture = $FB->get('/me/picture?redirect=false&width=300&height=300', $accessToken);
    //$requestPicture = $FB->get('/me/picture?redirect=false&width=300&height=300', $accessToken);
    //$profilePicture= $requestPicture->getGraphNode();
	  $userData = $response->getGraphNode()->asArray();
    $_SESSION['userData'] = $userData;
    //$_SESSION['profilePicture'] = $profilePicture;
    // Returns a `FacebookFacebookResponse` object
    $_SESSION['access_token'] = (string) $accessToken;
    
  //header('Location: index.php');
  header('Location: redirect.php');
	exit();
?>