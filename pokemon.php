<?php

//Displaying errors - no console.log in PHP
declare(strict_types=1);
ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);

$hello = 'Hello';
$subject = 'Pokédex';
echo $hello;
echo ' ';
echo $subject;
echo ' ';

// tutorial https://tutorialsclass.com/php-rest-api-file_get_contents/
$api_url = 'https://pokeapi.co/api/v2/pokemon';
$fetch = file_get_contents($api_url); // read the API
$response_data = json_decode($fetch); // put data into PHP array
$pokemon_data = $response_data->data;

?>
