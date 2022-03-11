<?php
require_once ("DatabaseHelper.php");
$db=new DatabaseHelper();
if(isset($_POST['password'])){
    if(!is_numeric($_POST['password'])|| strlen($_POST['password'])!=4){
        $nopin=True;
    }
    else{
        if($db->insertIntoUser($_POST['username'], $_POST['email'], $_POST['password'], $_POST['creditcard'])){
            session_start();
            $_SESSION['username']=$_POST['username'];
            header("location: ./index.php");
        }
        else{
            $errorreg=True;
        }

    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizza Lieferservice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&family=Roboto+Mono&display=swap" rel="stylesheet">
</head>
<body>
<div style="margin-left: 15em; margin-right: 15em; padding-left: 2em; padding-right: 2em; background-color: white; height: 100%; min-height: 100vh">
    <br>
    <header>
        <h1 style="font-size: 80px; background: rgb(0,228,6);
background: linear-gradient(90deg, rgba(0,228,6,1) 0%, rgba(255,255,255,1) 44%, rgba(247,247,247,1) 56%, rgba(236,0,0,1) 100%);">
            Pizza Lieferdienst
        </h1>
    </header>
    <?php if($nopin){ ?>
        <h1>Somthing went wrong</h1>
        <div class="alert alert-danger" role="alert">
            Der Pin darf nur aus Zahlen bestehen:
        </div>
    <?php } ?>
    <?php if($errorreg){ ?>
        <h1>Something went wrong</h1>
        <div class="alert alert-danger" role="alert">
            Es gab einen Fehler bei der Registrierung bitte versuchen Sie es erneut
        </div>
    <?php } ?>
    <!--https://getbootstrap.com/docs/4.0/components/forms/-->
    <form action="" method="post">
        <div class="form-group">
            <label for="username">username</label>
            <input type="text" class="form-control" id="username"  placeholder="Gib usernamen ein" name="username">
        </div>
        <div class="form-group">
            <label for="password">Pin</label>
            <input type="password" class="form-control" id="password" placeholder="Gib eine vier stellige Pinnummer ein" name="password">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" placeholder="Gib eine Email ein" name="email">
        </div>
        <div class="form-group">
            <label for="creditcard">Kreditkartennummer</label>
            <input type="text" class="form-control" id="creditcard" placeholder="Kreditkartennummer eingeben" name="creditcard">
        </div>
        <br>

        <button type="submit" class="btn btn-success">Register</button>
    </form>
</div>



<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>
