<?php

//Displaying errors - no console.log in PHP
declare(strict_types=1);
ini_set('display_errors', "on");
ini_set('display_startup_errors', "on");
error_reporting(E_ALL);

// test
$hello = 'test Hello';
$subject = 'Pokédex';
echo $hello;
echo ' ';
echo $subject;
echo ' ';

// tutorial https://tutorialsclass.com/php-rest-api-file_get_contents/

$searchPokemon = '';
$id = '';
$name = '';
$moves = '';

// Pass API URL in file_get_contents() to fetch data
function fetchPokemon (string $fetch) : array { // put data into PHP array
$api_url = 'https://pokeapi.co/api/v2/pokemon';
$fetch = file_get_contents($api_url);
$response_data = json_decode($fetch, true);
return $response_data;
}

//test result pokemon
$searchPokemon = fetchPokemon($api_url.input)


?>

<!-- No need to create a separate index.html file -->
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="description" content="description">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Pokédex</title>
</head>
<body>
<p>
<h1>Hello Pokédex!</h1>

<br>
<div id="tmp-pokemon"></div>
<div id="id"></div>
<div id="name"></div>
<div id="moves"></div>

<div>
    <img src="" id="img" style width="200px" class="center">
</div>

<form action="index.php" method="post">
    <br>
    <p>Search your Pokémon with the <strong> name or ID-number</strong></p>
    <input type="text" name="textbox" id="input"/>
</form>

<div class="actions">
    <br>
    <button type="button" class="game" id="search">Search!</button>
</div>

</body>
</html>
