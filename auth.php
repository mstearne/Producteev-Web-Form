<?
include_once("include.php");

//first page of the auth process:

//https://www.producteev.com/oauth/v2/auth?client_id=53518db120bce50455000004_1gphpxybebesgc04s8sw4s8kwooocsw80ocwc04kwkco0wsw4w&response_type=code&redirect_uri=http%3A%2F%2Fwww.pathinteractive.com%2Finternal%2Fproducteev%2Fauth.php
session_start();

if($_REQUEST['code']){
	
/// Get the "code" from the auth and save it to the session for later use
$_SESSION['code']=$_REQUEST['code'];

//https://www.producteev.com/oauth/v2/token?client_id=YOURCLIENTID&client_secret=YOURCLIENTSECRET&grant_type=authorization_code&redirect_uri=http%3A%2F%2Fwww.yoururlencoded.com&code=ARANDOMCODE

$authFinal=get_web_page("https://www.producteev.com/oauth/v2/token?client_id=53518db120bce50455000004_1gphpxybebesgc04s8sw4s8kwooocsw80ocwc04kwkco0wsw4w&client_secret=1xsyki0zequ8cckwg0sko00cw40g0oc4ow040go4kkgwkgk4ok&grant_type=authorization_code&redirect_uri=http%3A%2F%2Fwww.pathinteractive.com%2Finternal%2Fproducteev%2Fauth.php&code=".$_REQUEST['code']);

print $authFinal['content'];
}

?>