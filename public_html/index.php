<?php

// Include DatabaseHelper.php file
require_once('DatabaseHelper.php');
session_start();
// Instantiate DatabaseHelper class
$database = new DatabaseHelper();

$searchText = '';
if (isset($_GET['searchText'])) {
    $searchText = $_GET['searchText'];
}
if(isset($_POST['pressed'])){
    session_destroy();
    header("location=./index.php");
}
$pizza_array = $database->selectPizzasWherePizzaName($searchText);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Football Database</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&family=Roboto+Mono&display=swap" rel="stylesheet">
</head>

<body style="font-family: 'Poppins', sans-serif; font-family: 'Roboto Mono', monospace; background-color: lightgray">

<div style="margin-left: 15em; margin-right: 15em; padding-left: 2em; padding-right: 2em; background-color: white; height: 100%; min-height: 100vh">
    <br>
    <header>
        <h1 style="font-size: 80px; background: rgb(0,228,6);
background: linear-gradient(90deg, rgba(0,228,6,1) 0%, rgba(255,255,255,1) 44%, rgba(247,247,247,1) 56%, rgba(236,0,0,1) 100%);">
            Pizza Lieferdienst
        </h1>
    </header>

    <!-- Search form -->
    <h2>Suche:</h2>

    <form method="get", action="">
        <div class="input-group">
            <input id="searchText" name="searchText" type="search" class="form-control input-md"
                   value='<?php echo $searchText; ?>' class="form-control rounded" aria-describedby="search-addon"
                   placeholder="Suchen Sie nach Pizzen!" aria-label="Search" >
            <button id='submit' type='submit' class='btn btn-outline-primary'>
                Search
            </button>
        </div>
    </form>
    <br>
    <?php if(isset($_SESSION['username'])){
        ?>
        <h3> Welcome back <?php echo $_SESSION['username']; ?> </h3>
        <form method="post" action="">
            <button class="btn btn-danger" type="submit" name="pressed" value="yes">Logout</button>
        </form>
  <?php  }
  else{?>
    <div class="input-group">
    <form method="post" action="login.php">
        <button class="btn btn-success" type="submit">Login</button>
    </form>
        <form style="padding-left: 10px " action="signup.php">
            <button class="btn btn-primary" type="submit">Registrieren</button>
        </form>
    </div>
<?php } ?>
    <table class="table table-hover">
        <?php
        if(empty($pizza_array)) { echo "Kein Pizza gefunden";}
        else{ ?>
        <h1>Suchergebnisse</h1>    <thead>
        <td>Pizzaname </td>
        <td>Informationen </td>
        <td>Beschreibung </td>
        <td>Preis </td>
        </thead>

        <?php foreach ($pizza_array as $pizza) : ?>
            <tr>
                <td><?php echo $pizza['PIZZANAME']; ?>  </td>
                <td><?php echo $pizza['PIZZAINFO']; ?>  </td>
                <td><?php echo $pizza['PIZZABESCHREIBUNG']; ?>  </td>
                <td><?php echo $pizza['PIZZAPREIS']; ?>  </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <?php } ?>
    <br>
    <br>
    <br>
    <div>
        <h4>Unsere Top Besteller diesen Monat waren:</h4>
        <table class="table table-hover">
            <thead>
                <td>Username</td>
                <td>Anzahl Bestellungen</td>
            </thead>
            <tr>
                <td> m.noessing </td>
                <td> 23 </td>
            </tr>
            <tr>
                <td> g.dobler </td>
                <td> 18 </td>
            </tr>
            <tr>
                <td> j.seegatz </td>
                <td> 12 </td>
            </tr>
        </table>
    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>
