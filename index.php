<!-- Partie reservées au traitement des données -->
<?php session_start(); ?>
<?php

    if (isset($_POST["mdp"]) AND !empty($_POST["mdp"]) AND isset($_POST["user"]) AND !empty($_POST["user"])) {

        if (strlen($_POST["mdp"])<8) {
            $error = "Your password must be greater than 8 characters";
        }else{
            $_SESSION["mdp"] = $_POST["mdp"];
            $_SESSION["user"] = $_POST["user"];
        }


        echo strlen($_POST["mdp"]);
    }else{
        if (isset($_POST["mdp"]) AND empty($_POST["mdp"])) {
            $errors[0] = "This field is required";
        }
        if (isset($_POST["user"]) AND empty($_POST["user"])) {
            $errors[1] = "This field is required";
        }
    }

    if (isset($_POST["logout"])) {
        unset($_SESSION["mdp"]);
        unset($_SESSION["user"]);
    }

?>


<!-- Partie reservées a l'affichage des données -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="./ressources/css/style.css">
</head>
<body>
    <div class="container">
        <div class="group">

            <div class="logo"><img src="./ressources/img/login.png" alt=""></div>

            <br><br><br><br>

            <?php if ((!isset($_SESSION["mdp"]) AND !isset($_SESSION["user"]))):?>
                <div class="title">Login Here</div>
            <?php else:?>
                <div class="title">Welcome</div>
            <?php endif ?>

            <div class="form">
                <?php if ((!isset($_SESSION["mdp"]) AND !isset($_SESSION["user"]))):?>
                    
                    <br><br><br>
                    <form action="" method="post">

                        <label for="name">Username</label><br>
                        <input type="text" name="user" id="name" placeholder="Enter username..." <?php if (isset($errors[1])): ?>class="ifError"<?php endif?> <?php if (isset($_POST["user"]) AND !empty($_POST["user"])): ?> value = "<?=$_POST["user"]?>"<?php endif?>>

                        <?php if (isset($errors[1])): ?>
                            <div class="error"><?= $errors[1] ?></div>
                        <?php endif?> 

                        <br><br>

                        <label for="password">Password</label><br>
                        <input type="password" name="mdp" id="password" <?php if (isset($error) || isset($errors[0])): ?>class="ifError"<?php endif?> placeholder="Enter password..." >
                        <?php if (isset($error)): ?>
                            <div class="error"><?= $error ?></div>
                        <?php endif?>
                        <?php if (isset($errors[0])): ?>
                            <div class="error"><?= $errors[0] ?></div>
                        <?php endif?>

                        <br><br><br>

                        <button type="submit">Login</button>
                    </form>

                    <br><br><br><br>

                    <a href="#">Lost your password ?</a> <br><br>
                    <a href="#">Don't have an account ?</a> <br>

                <?php else:?>
                    
                    <div class="justForStyle"></div>
                    <br><br><br>

                    <form action="" method="post">
                        <label for="name">Username : <?= $_SESSION["user"]?></label><br><br><br>
                        <label for="password">Password : <?= $_SESSION["mdp"]?></label><br><br><br>
                        <button type="submit" class="logout" name="logout">Logout</button>
                    </form>

                <?php endif ?>
            </div>

        </div>
    </div>
</body>
</html>