<?php
$server ="localhost";
$login ="debian";
$mdp ="ehman";
$bdd ="surf";
$user = $_POST['user_reg'];


session_start();

try {
	$linkpdo = new PDO("mysql:host=$server;dbname=$bdd", $login, $mdp);
} catch (Exception $e) {
	die('Erreur : ' . $e->getMessage());
}

if(preg_match('#^[a-zA-Z0-9.]{3,20}$#',$_POST['user_reg'])) {
         $req = $linkpdo->prepare('SELECT * FROM utilisateur WHERE username = :username');
         $req->bindParam(':username',$_POST['user_reg']);
         $req->execute();
         $req = $req->fetch();
         if(isset($req['username'])) die("<p>Nom d'utilisateur deja utilisé, <a href=\"inscription.html\"> Cliquez ici pour recommencer</a></p>");

            if(preg_match('#^[A-Z0-9a-z._%+-]+@[a-zA-Z0-9.-]+\.[A-Za-z]{2,4}$#',$_POST['mail_reg']))
            {
                $req = $linkpdo->prepare('SELECT * FROM eim_user WHERE mail = :mail');
                $req->bindParam(':mail',$_POST['email']);
                $req->execute();
                $req = $req->fetch();
                if(isset($req['mail'])) die("<p>Email deja utilisé, <a href=\"inscription.html\"> Cliquez ici pour recommencer</a></p> ");
                if(strlen($user)>= 3 OR strlen($user)<= 20)
                {
                   if($_POST['password_reg'] == $_POST['repassword_reg'])
                   {

                      $HORUS = password_hash($_POST['password_reg'], PASSWORD_DEFAULT);
                      $res = $linkpdo->prepare('INSERT INTO `utilisateur`(`username`, `password`, `mail`) VALUES(:username,:password,:mail)');
                      $res->execute(array('username' => $_POST['user_reg'],
						    'password' => $HORUS, // cc 
						    'mail' => $_POST['mail_reg']));

                    }
                   else die(" <p>Les deux mots de passe ne correspondent pas : <a href=\"inscription.html\"> Cliquez ici pour recommencer</a></p>");
                }
                else die("<p>Le nom d'utilisateur, est trop long ou trop court, il doit faire minimum 3 caractères et maximum 20 : <a href=\"../../LOGIN_v4/inscription.html\"> Cliquez ici pour recommencer</a></p>");
            }
            else die("<p>L'email rentré n'est pas valide, veuillez vérifier quelle contient bien un @ <a href=\"inscription.html\"> Cliquez ici pour recommencer</a></p>");
                
     }      
     else die("<p>Le nom d'utilisateur, contient des caractères interdits, vous pouvez utiliser seulement des lettres, des chiffres et des points : <a href=\"inscription.html\"> Cliquez ici pour recommencer</a></p>");
     


 ?>
