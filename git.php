<?php
if(isset($_GET['dst']) && preg_match('/https:\/\/github\.com\/(ois-.+?)\/(DN.+?)\/commit\/([a-z0-9]+)/', $_GET['dst'], $params)){
    header('Content-Type: application/json');
    
    require_once("secret.php");

    $endpoint = "https://api.github.com";
    $owner = $params[1];
    $repo = $params[2];
    $commit = $params[3];

    $headers = array(
        "User-Agent: Oiscenjevalec-proxy / 1.0", 
        "Authorization: token $github_token",
        "Accept: application/vnd.github.v3+json"
    );

    $ch = curl_init();

    $options = array(
        CURLOPT_URL => "$endpoint/repos/$owner/$repo/commits/$commit",
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_RETURNTRANSFER => true
    );
    
    curl_setopt_array($ch, $options);

    $response = curl_exec($ch);
    curl_close($ch);

    echo $response;
} else {
    echo "Bad request!";
    http_response_code(503);
    exit;
}
