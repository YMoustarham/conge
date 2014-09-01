<?php
session_start();

require_once('modules/DB_Manager.php');

require_once('external/facebook/src/Facebook/HttpClients/FacebookHttpable.php');
require_once('external/facebook/src/Facebook/HttpClients/FacebookCurl.php');
require_once('external/facebook/src/Facebook/HttpClients/FacebookCurlHttpClient.php');
require_once('external/facebook/src/Facebook/Entities/AccessToken.php');
require_once('external/facebook/src/Facebook/Entities/SignedRequest.php');
require_once('external/facebook/src/Facebook/FacebookSession.php');
require_once('external/facebook/src/Facebook/FacebookRedirectLoginHelper.php');
require_once('external/facebook/src/Facebook/FacebookRequest.php');
require_once('external/facebook/src/Facebook/FacebookResponse.php');
require_once('external/facebook/src/Facebook/FacebookSDKException.php');
require_once('external/facebook/src/Facebook/FacebookRequestException.php');
require_once('external/facebook/src/Facebook/FacebookOtherException.php');
require_once('external/facebook/src/Facebook/FacebookAuthorizationException.php');
require_once('external/facebook/src/Facebook/GraphObject.php');
require_once('external/facebook/src/Facebook/GraphSessionInfo.php');

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;

// init app with app id (APPID) and secret (SECRET)
FacebookSession::setDefaultApplication('1462311460710112','9d463a4952ceab96f73c052df23ca370');

// login helper with redirect_uri
$host = 'http://localhost/';
$helper = new FacebookRedirectLoginHelper( $host );

$params = array(
    'scope' => 'public_profile ,email,user_events,user_birthday,user_location'
    );

try
{
    $session = $helper->getSessionFromRedirect();
}
catch ( FacebookRequestException $ex )
{
    echo '1erro';
}
catch( Exception $ex ) {
    // When validation fails or other local issues
}

// see if we have a session
if ( isset( $session ) )
{
    // graph api request for user data

    $request = new FacebookRequest( $session, 'GET', '/me?fields=id,name,first_name,last_name,gender,birthday,email,events' );
    $response = $request->execute();
    // get response
    $graphObject = $response->getGraphObject()->asArray();

    // print data
    register_uer($graphObject);
    echo('<pre style="font-size:1em">');
    print_r($graphObject['events']->data);

    echo('</pre>');


}
else
{
    // show login url
    echo '<a href="' . $helper->getLoginUrl($params) . '">Login</a>';
}
function register_uer($graph)
{
    $id = $graph['id'];
    $email = null;
    $first_name = $graph['first_name'];
    $last_name = $graph['last_name'];
    $gender = $graph['gender'];
    $birthday = $graph['birthday'];
    $tel = null;

    DB::add_user($id,$first_name,$last_name,$email,$gender,$tel,$birthday);

}
function extracEvents($graph)
{
    $id  = $graph['id'];
    $start_time = $graph['start_time'];
    $end_time = $graph['end_time'];
    $name= $graph['name'];
    $location= $graph['location'];
    $time_zone  = $graph['timezone'];

}
class Event
{
    public $id;
    public $start_time;
    public $end_time;
    public $name;
    public $location;
    public $time_zone;
    public function Event($id ,$start_time,$end_time,$name,$location,$time_zone)
    {
        $this->id = $id;
        $this->start_time = $start_time;
        $this->end_time = $end_time;
        $this->location = $location;
        $this->name =$name;
        $this->time_zone = $time_zone;
    }

}