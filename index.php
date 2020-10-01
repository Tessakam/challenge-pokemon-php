<?php

//Displaying errors - no console.log in PHP
declare(strict_types=1);
ini_set('display_errors', "on");
ini_set('display_startup_errors', "on");
error_reporting(E_ALL);

/*use var_dump to check specific error
var_dump($_GET); */

$url = 'https://pokeapi.co/api/v2/pokemon/'; // niet vergeten om te eindigen met "/" als er nadien input volgt
$url_species = 'https://pokeapi.co/api/v2/pokemon-species/'; // evolutions
$searchPokemon = '';
$result = '';
$id = '';
$name = '';
$image = '';
$oneMove = [];
$fourMoves = ''; // change array to '' to solve error: Array to string conversion

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
    $oneMove = $result['moves'][0]['move']['name'];

    //Example: https://www.php.net/manual/en/function.rand.php
    //4 moves to display
    $moves = array();
    $maxMoves = 4;
    $allMoves = count($result['moves']);
    for ($i = 0; $i < $maxMoves; $i++) {
        if ($allMoves > 4) {
            $random = (rand(0, $allMoves));
            array_push($moves, $result['moves'][$random]['move']['name'] . ", "); //same as JS
        } elseif ($allMoves < 4) {
            array_push($moves, $result['moves'][$i]['move']['name'] . ", ");
        }
    }

    // show previous evolutions
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

<!-- HTML use method Get and link with name - NOT with id!! -->
<form action="index.php" method="get">
    <p>Search your Pokémon with the <strong> name or ID-number</strong></p>
    <input type="text" name="input" id="search" placeholder="Name / ID-number">
    <input type="submit" name="submit" value="Search!" align="center">
</form>

<!-- Always put the echo separate - NOT inside your form!! -->
<!-- to check: adding empty = clear the input field? -->
<div class="id" align="center">
    <p><strong>ID-number:</strong></p>
    <?php echo $id ?> </div>

<div class="name" align="center">
    <p><strong>Name:</strong></p>
    <?php echo $name ?> </div>

<div class="moves" align="center">
    <p><strong>1 move:</strong></p>
    <?php echo $oneMove ?>
</div>

<div class="moves" align="center">
    <p><strong>4 random moves:</strong></p>
    <?php foreach ($moves as $fourMoves) { //otherwise you only have 1 move s result!
        echo "$fourMoves ";
    } ?>

</div>

<img src="<?php echo $image ?>" alt="image pokemon" class="center">
<!-- Extra: combine image default front/back into 1
https://stackoverflow.com/questions/25636066/php-gd-library-turn-2-images-into-1-side-by-side -->


</body>
</html>