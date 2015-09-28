<?php
require_once __DIR__ . '/facebook-php-sdk-v4/src/Facebook/autoload.php';

session_start();
$fb = new Facebook\Facebook([
  'app_id' => '894783127236712',
  'app_secret' => 'a4b407f153b1f834a635b8f00a239bfb',
  'default_graph_version' => 'v2.2',
  ]);
$helper = $fb->getRedirectLoginHelper();
try {
  $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

if (isset($accessToken)) {
  // Logged in!
  $_SESSION['facebook_access_token'] = (string) $accessToken;

  try {
    // Returns a `Facebook\FacebookResponse` object
    $response = $fb->get('/me?fields=id,name', (string) $accessToken);
  } catch(Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
  } catch(Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
  }

  $user = $response->getGraphUser();

  echo 'Name: ' . $user['name'];

  // Now you can redirect to another page and use the
  // access token from $_SESSION['facebook_access_token']
}
?>
