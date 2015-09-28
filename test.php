<?php
require_once __DIR__ . '/facebook-php-sdk-v4/src/Facebook/autoload.php';

session_start();
$fb = new Facebook\Facebook([
  'app_id' => 'XXXXXXXXXXXXXX',
  'app_secret' => 'XXXXXXXXXXXXXXXXXXXXXXX',
  'default_graph_version' => 'v2.2',
  ]);

$helper = $fb->getRedirectLoginHelper();
$permissions = ['email', 'user_likes']; // optional
$loginUrl = $helper->getLoginUrl('http://localhost/test2.php', $permissions);

echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
?>
