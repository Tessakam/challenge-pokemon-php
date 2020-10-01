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
$oneMove = [];
$fourMoves = [];

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
    $image = $result['sprites']['front_default'];
    //1 move
    $oneMove = $result['moves'][0]['move']['name'];

    //Example: https://www.php.net/manual/en/function.rand.php
    //4 moves to display

    $maxMoves = 4; // this is your min() of rand
        for ($i = 0; $i < $maxMoves; $i++) {
        $random = rand($maxMoves,count($result['moves']));
        $fourMoves = [$random]['move']['name'];
    }
}

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

<div class="moves" align="center">
    <?php echo $oneMove ?>
    <?php echo $fourMoves ?>
</div>

<img src="<?php echo $image?>" alt="image pokemon" class="center">
<!-- Extra: combine image default front/back into 1
https://stackoverflow.com/questions/25636066/php-gd-library-turn-2-images-into-1-side-by-side -->


<!-- HTML use method Get and link with name - NOT with id!! -->
<form action="index.php" method="get">
    <br>
    <p>Search your Pokémon with the <strong> name or ID-number</strong></p>
    <input type="text" name="input" id="search" placeholder="Name / ID-number">
    <input type="submit" value="Search!">
</form>

</body>
</html>