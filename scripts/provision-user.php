<?php

$consumer_key = getenv('ETSY_CONSUMER_KEY');
$consumer_secret = getenv('ETSY_CONSUMER_SECRET');

if (empty($consumer_key) || empty($consumer_secret))
{
    error_log("Env vars ETSY_CONSUMER_KEY and ETSY_CONSUMER_SECRET are required\n\nExample:\nexport ETSY_CONSUMER_KEY=qwertyuiop123456dfghj\nexport ETSY_CONSUMER_SECRET=qwertyuiop12");
    exit(1);
}


try {

     // read user input for verifier
     print "Please type the user_id to allow access to the app below: \n";

     print '$ ';

    $user_id = trim(fgets(STDIN));

    $ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://openapi.etsy.com/v3/application/provisional-users/' + $user_id);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);

$headers = array();
$headers[] = 'X-Api-Key: ' + $consumer_key ;
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close ($ch);

    echo "Success! user '{$user_id}' was added to etsy application.\n";


}catch (Exception $e) {
    error_log($e);
}

   