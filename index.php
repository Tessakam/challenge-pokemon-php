<?php

//Displaying errors - no console.log in PHP
declare(strict_types=1);
ini_set('display_errors', "on");
ini_set('display_startup_errors', "on");
error_reporting(E_ALL);

/*use var_dump to check specific error
var_dump($_GET); */

$url = 'https://pokeapi.co/api/v2/pokemon/'; // niet vergeten om te eindigen met "/" als er nadien input volgt
$searchPokemon = '';
$result = '';
$id = '';
$name = '';
$image = '';
$moves = [];

//tutorial https://tutorialsclass.com/php-rest-api-file_get_contents/
// Pass API URL in file_get_contents() to fetch data
function fetchPokemon(string $url): array
{ // put data into PHP array
    $fetch = file_get_contents($url);
    $fetch = json_decode($fetch, true);
    return $fetch;
}

// GET is used to request data from a specified resource.
if (!empty($_GET['input'])) { //search when field is NOT empty, otherwise 1 = bulbasaur
    $searchPokemon = $_GET['input'];
    $result = fetchPokemon($url . $searchPokemon);
    $id = $result['id'];
    $name = $result['name'];
    $imageFront = $result['sprites']['front_default'];
    $maxmoves = 4;
    $moves = $result['moves'][0]['move']['name'];
}

/*
function randomMoves($allMoves){
    $amountToDisplay = min(4, sizeof($allMoves));
    $moveNames = "";
    for ($i=0; $i<$amountToDisplay; $i++){
        $randomNumber = rand(0,sizeof($allMoves));
        $moveNames .= $allMoves[$randomNumber]['move']['name']. ", ";
    }
        return $moveNames;
 */


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
<h1>Hello Pokédex!</h1>
<br>
<!-- Always put the echo separate - NOT inside your form!! -->
<!-- to check: adding empty = clear the input field? -->
<div class="id" align="center">
    <?php echo $id ?> </div>

<div class="name" align="center">
    <?php echo $name ?> </div>

<img src="<?php echo $imageFront ?>" alt="image pokemon" class="center">

<div class="moves" align="center">
    <?php echo $moves ?>
</div>

<!-- HTML use method Get and link with name - NOT with id!! -->
<form action="index.php" method="get">
    <br>
    <p>Search your Pokémon with the <strong> name or ID-number</strong></p>
    <input type="text" name="input" id="search" placeholder="Name / ID-number">
    <input type="submit" value="Search!">
</form>

</body>
</html>