<?php 

$producteevNetworkID="519b6a70bcd3e02c6d000004";

function makeAPICall( $url, $postFields="",$optionsIn="POST" )
{

    $options = array(
        CURLOPT_RETURNTRANSFER => true,     // return web page
        CURLOPT_HEADER         => false,    // don't return headers
        CURLOPT_FOLLOWLOCATION => true,     // follow redirects
        CURLOPT_ENCODING       => "",       // handle all encodings
        CURLOPT_USERAGENT      => "spider", // who am i
        CURLOPT_AUTOREFERER    => true,     // set referer on redirect
        CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
        CURLOPT_TIMEOUT        => 120,      // timeout on response
        CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
        CURLOPT_HTTPHEADER      => array("Authorization:Bearer ".$_SESSION['producteev_access_token']),   
        CURLOPT_SSL_VERIFYPEER => false     // Disabled SSL Cert checks
    );
    if($optionsIn=="POST"&&$postFields){
      $options[CURLOPT_CUSTOMREQUEST] = 'POST';
      $options[CURLOPT_POSTFIELDS] = $postFields;
//      print "here";
    }
    if($optionsIn=="PUT"&&$postFields){
      $options[CURLOPT_CUSTOMREQUEST] = 'PUT';
      $options[CURLOPT_POSTFIELDS] = $postFields;
    }

    if($optionsIn=="DELETE"){
      $options[CURLOPT_CUSTOMREQUEST] = 'DELETE';
    }

//print_r($options);
    $ch      = curl_init( $url );
    curl_setopt_array( $ch, $options );
    $content = curl_exec( $ch );
    $err     = curl_errno( $ch );
    $errmsg  = curl_error( $ch );
    $header  = curl_getinfo( $ch );
    curl_close( $ch );

    $header['errno']   = $err;
    $header['errmsg']  = $errmsg;
    $header['content'] = $content;
    return $header;
}




?>