<?php

if(isset($_POST['user_log']) AND isset($_POST['password_log']))
 {
     if(preg_match('#^[a-zA-Z0-9.]{3,15}$#',$_POST['user_log']))
     {
         $req = $bdd->prepare('SELECT * FROM user WHERE username = :username');
         $req->bindParam(':username',$_POST['user_log']);
         $req->execute();
         $req = $req->fetch();
         if(isset($req['password']))
         {
            if( password_verify($_POST['password_log'],$req['password']))
            {
                $_SESSION['user'] = $_POST['user_log'];
                header('Location: ../../index.php');

            }
            else die("<p>Le mot de passe est invalide <a href=\"../../page/connexion.php\"> Cliquez ici pour recommencer</a></p>");
         }
         else die("<p>Cet utilisateur n\'existe pas <a href=\"../../page/connexion.php\"> Cliquez ici pour recommencer</a></p>");
     }
    else die("<p>Le nom d'utilisateur, contient des caractères interdits, vous pouvez utiliser seulement des lettres, des chiffres et des points : <a href=\"../../page/connexion.php\"> Cliquez ici pour recommencer</a></p>");
 }
else die("<p>Il manque des informations, retournez sur la page et re-inscrivez vous : <a href=\"../../page/connexion.php\"> Cliquez ici</a></p>");

?>