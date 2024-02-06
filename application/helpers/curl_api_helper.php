<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');


function curl_api($jenis_data = null, $k_kabupaten = null, $k_di = null, $tahun_iksi = null, $headers = array()) {

	$ch = curl_init();

    // Set Method
	$method = 'POST';

    // Set Data Body
	$data = array(
		'token' => '6a0a617ff721ada4e9bf603bf5cc5266',
		'jenis_data' => $jenis_data,
		'k_kabupaten' => $k_kabupaten,
		'k_di' => $k_di,
		'tahun_iksi' => $tahun_iksi
	);

    // Set the URL
	curl_setopt($ch, CURLOPT_URL, "http://epaksi.sda.pu.go.id/pdsda_pai/kmc-dak.php/");

    // Set the request method
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoupper($method));

    // Handle request data
	if ($method === 'POST') {
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
	}

    // Set headers
	$default_headers = array(
		'Content-Type: application/x-www-form-urlencoded',
		'Accept: application/json'
	);
	$headers = array_merge($default_headers, $headers);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    // Set timeout to 15 minutes (900 seconds)
	curl_setopt($ch, CURLOPT_TIMEOUT, 900);

    // Return the response as a string
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute the request and fetch the response
	$response = curl_exec($ch);

    // Check for errors
	if ($response === FALSE) {
		$error_message = curl_error($ch);
        // Close the cURL handle
		curl_close($ch);
		return json_encode(['code' => 500, 'psn' => $error_message]);
	}

    // Close the cURL handle
	curl_close($ch);

    // Decode JSON response
	$json_response = json_decode($response, TRUE);

    // Check if JSON decoding was successful
	if ($json_response === NULL || !is_array($json_response)) {
		return ['code' => 500, 'psn' => 'error api'];
	}

    // Return the decoded JSON response
	return $json_response;
}




?>