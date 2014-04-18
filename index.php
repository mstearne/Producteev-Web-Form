<?php 

include_once("include.php");

$page=get_web_page("https://www.producteev.com/oauth/v2/auth?client_id=53518db120bce50455000004_1gphpxybebesgc04s8sw4s8kwooocsw80ocwc04kwkco0wsw4w&response_type=token&redirect_uri=http%3A%2F%2Fwww.pathinteractive.com%2Finternal%2Fproducteev%2Fauth.php");

//https://www.producteev.com/oauth/v2/auth?client_id=53518db120bce50455000004_1gphpxybebesgc04s8sw4s8kwooocsw80ocwc04kwkco0wsw4w&response_type=code&redirect_uri=http%3A%2F%2Fwww.pathinteractive.com%2Finternal%2Fproducteev%2Fauth.php" ); 
print_r($page);




/*


require('php-oauth2/src/OAuth2/Client.php');
require('php-oauth2/src/OAuth2/GrantType/IGrantType.php');
require('php-oauth2/src/OAuth2/GrantType/AuthorizationCode.php');

const CLIENT_ID     = '53518db120bce50455000004_1gphpxybebesgc04s8sw4s8kwooocsw80ocwc04kwkco0wsw4w';
const CLIENT_SECRET = '1xsyki0zequ8cckwg0sko00cw40g0oc4ow040go4kkgwkgk4ok';

const REDIRECT_URI           = 'http://www.pathinteractive.com/internal/producteev/index.php';
const AUTHORIZATION_ENDPOINT = 'https://www.producteev.com/oauth/v2/auth_login';
const TOKEN_ENDPOINT         = 'https://www.producteev.com/oauth/v2/auth';

$client = new OAuth2\Client(CLIENT_ID, CLIENT_SECRET);
if (!isset($_GET['code']))
{
    $auth_url = $client->getAuthenticationUrl(AUTHORIZATION_ENDPOINT, REDIRECT_URI);
    header('Location: ' . $auth_url);
    die('Redirect');
}
else
{
    $params = array('code' => $_GET['code'], 'redirect_uri' => REDIRECT_URI);
    $response = $client->getAccessToken(TOKEN_ENDPOINT, 'authorization_code', $params);
    parse_str($response['result'], $info);
    $client->setAccessToken($info['access_token']);
    $response = $client->fetch('https://www.producteev.com/api/networks');
    var_dump($response, $response['result']);
}
//519b6a70bcd3e02c6d000004

*/

?>

