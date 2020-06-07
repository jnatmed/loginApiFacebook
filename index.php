<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    session_start();
    $config = require("config.php");
    
    require 'vendor/autoload.php';

    // use Facebook\FacebookSession;
    // use Facebook\FacebookRedirectLoginHelper;
    // use Facebook\FacebookRequest;
    // use Facebook\FacebookResponse;
    // use Facebook\GraphObject;
    // use Facebook\FacebookRequestException;

    // FacebookSession::setDefaultApplication($config['app_id'],$config['app_secret']);

    // $helper = new FacebookRedirectLoginHelper('http://localhost:8080/index.php');
    // try {
    //     //code...
    // } catch (\Throwable $th) {
    //     //throw $th;
    // }

    // require_once __DIR__ . '/vendor/autoload.php'; // change path as needed

    $fb = new \Facebook\Facebook([
      'app_id' => $config['app_id'],
      'app_secret' => $config['app_secret'],
      'default_graph_version' => $config['graph_version'],
      'default_access_token' => $config['access_token'], // optional
    ]);
    
    // Use one of the helper classes to get a Facebook\Authentication\AccessToken entity.
      $helper = $fb->getRedirectLoginHelper();
      $helper = $fb->getJavaScriptHelper();
      $helper = $fb->getCanvasHelper();
      $helper = $fb->getPageTabHelper();

    try {
      // Get the \Facebook\GraphNodes\GraphUser object for the current user.
      // If you provided a 'default_access_token', the '{access-token}' is optional.
      $response = $fb->get('/me', $config['access_token']);
    } catch(\Facebook\Exceptions\FacebookResponseException $e) {
      // When Graph returns an error
      echo 'Graph returned an error: ' . $e->getMessage();
      echo("<pre>");
    //   var_dump($config);
    //   var_dump($response);
    //   var_dump($fb);
      var_dump($helper);
      exit;
    } catch(\Facebook\Exceptions\FacebookSDKException $e) {
      // When validation fails or other local issues
      echo 'Facebook SDK returned an error: ' . $e->getMessage();
      var_dump($helper);
      exit;
    }
    
    $me = $response->getGraphUser();
    echo 'Logged in as ' . $me->getName();
    ?>
</body>
</html>