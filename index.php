<?php

//Displaying errors - no console.log in PHP
declare(strict_types=1);
ini_set('display_errors', "on");
ini_set('display_startup_errors', "on");
error_reporting(E_ALL);
var_dump($_GET);

$url = 'https://pokeapi.co/api/v2/pokemon/';
$searchPokemon = '';
$result = '';
$id = '';
$name = '';
$moves = '';

//tutorial https://tutorialsclass.com/php-rest-api-file_get_contents/
// Pass API URL in file_get_contents() to fetch data
function fetchPokemon (string $url) : array { // put data into PHP array
$fetch = file_get_contents($url);
$fetch = json_decode($fetch, true);
return $fetch;
}

// GET is used to request data from a specified resource.
if (!empty($_GET['input'])) { //search when field is NOT empty
$searchPokemon = $_GET['input'];
$result = fetchPokemon($url. $searchPokemon);
$id = $result['id'];
$name = $result['name'];
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

    <!--<link rel="stylesheet" type="text/css" href="style.css"> -->
    <title>Pokédex</title>
</head>
<body>
<p>
<h1>Hello Pokédex!</h1>
<br>

<!-- HTML use method Get and link with name - NOT with id!! -->
<form action="index.php" method="get">
    <br>
    <p>Search your Pokémon with the <strong> name or ID-number</strong></p>
    <input type="text" name="input" id="search" placeholder="Name / ID-number" >
    <input type="submit">
</form>

<?php echo($id) ?>
<?php echo($name) ?>

<div class="actions">
    <br>
    <button type="button" class="game" id="search">Search!</button>
</div>

<div>
    <img src="" id="img" style width="200px" class="center">
</div>

</body>
</html>

