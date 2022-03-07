<?php
 require("detail_cred.php");
$data = array(
	"key" => $apikey,
	"q" => $_GET["q"],
	"page" => 1,
	"per_page" => 5,
	"orientation" => "horizontal",
	"category" => "places, nature"
);
$url = "https://pixabay.com/api/?" . http_build_query($data);
    $curl = curl_init();
    
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
    ));
    $response = curl_exec($curl);
    $response = json_decode($response, true);
    // echo "<pre>";
    // print_r($response["hits"][0]["webformatURL"]);
    // echo "</pre>";
   $filter = array();
   foreach($response["hits"] as $hits) {
   		$picInfo = $hits["webformatURL"];
   		$filter[] = $picInfo;
    }
   //header('Content-Type: application/json');
   echo json_encode($filter);
?>