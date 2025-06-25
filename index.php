<?php
$url = 'https://api.paystack.co/transaction/initialize';
$fields = [
    'email' => 'add your email', //add your eamil here
    'amount' => '20000', //add amount or variable that hold amount value
    'currency'=> 'NGN', //set your currency
    'callback_url' => 'http://localhost/mlu/your-succes-url.php', //call back if sucessfull this page shows
    'metadata' => ["cancel_action" => "http://localhost/mlu/your-cancel-url.php"] //if cancle this page shows
];
$fields_string = json_encode($fields);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer sk_test_b3acd20134e8a21fba4e90bb8c369ef3ef1eedf3',
    'Cache-Control: no-cache',
    'Content-Type: application/json',
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
} else {
    $response = json_decode($result, true);
    print_r($response);
}
header('location: '.$response['data']['authorization_url']);
curl_close($ch);

//Dont forget to subscribe to my youtube channel @samuel_ademoroti
?>
