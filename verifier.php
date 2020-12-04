<?php

$server ="localhost";
$login ="debian";
$mdp ="ehman";
$bdd ="surf";
$user = $_POST['user_reg'];

echo "branle ma queue";

try {
    $linkpdo = new PDO("mysql:host=$server;dbname=$bdd", $login, $mdp);
    $linkpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "tes co";
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}



echo "troll";
if(isset($_POST['user_log']) AND isset($_POST['password_log']))
    echo "troll";
 {
     if(preg_match('#^[a-zA-Z0-9.]{3,15}$#',$_POST['user_log']))
     {
         $req = $linkpdo->prepare('SELECT * FROM user WHERE username = :username');
         $req -> bindParam(':username',$_POST['user_log']);
         $req -> execute();
         $req = $req->fetch();
         echo "test";
         if(isset($req['password']))
         {
            echo "testtt";
            if(password_verify($_POST['password_log'], $req['password']))
            {
                $_SESSION['user'] = $_POST['user_log'];
                header('Location: ../../index.html');

            }
            else die("<p>Le mot de passe est invalide <a href=\"../../page/connexion.php\"> Cliquez ici pour recommencer</a></p>");
         }
         else die("<p>Cet utilisateur n\'existe pas <a href=\"../../page/connexion.php\"> Cliquez ici pour recommencer</a></p>");
     }
    else die("<p>Le nom d'utilisateur, contient des caractères interdits, vous pouvez utiliser seulement des lettres, des chiffres et des points : <a href=\"../../page/connexion.php\"> Cliquez ici pour recommencer</a></p>");
 }
else die("<p>Il manque des informations, retournez sur la page et re-inscrivez vous : <a href=\"../../page/connexion.php\"> Cliquez ici</a></p>");

?>