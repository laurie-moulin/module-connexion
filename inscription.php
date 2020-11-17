<?php

$bdd = new PDO('mysql:host=localhost;dbname=moduleconnexion', 'root', 'root');

if(isset($_POST['forminscription'])) {
    $login = htmlspecialchars($_POST['login']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $nom = htmlspecialchars($_POST['nom']);
    $password = sha1($_POST['password']);
    $password2= sha1($_POST['password2']);

    if(!empty($_POST['login']) AND !empty($_POST['prenom']) AND !empty($_POST['nom']) AND !empty($_POST['password'] AND !empty($_POST['password2']))){
        $loginlength = strlen($login);
        $prenomlength = strlen($prenom);
        $nomlength = strlen($nom);

        if($prenomlength<= 255) {
            if($nomlength <= 255) {
               if($loginlength<= 255) {
                  $reqlogin = $bdd->prepare("SELECT * FROM utilisateurs WHERE login = ?");
                  $reqlogin->execute(array($login));
                  $loginexist = $reqlogin->rowCount();

        if($loginexist == 0) {
            if($password == $password2) {
               $insertmbr = $bdd->prepare("INSERT INTO utilisateurs(login, prenom, nom, password) VALUES(?, ?, ?, ?)");
               $insertmbr->execute(array($login, $prenom, $nom, $password));
               $erreur = "Votre compte a bien été créé !";
               header("Location: connexion.php");
            } else {
               $erreur = "Vos mots de passes ne correspondent pas !";
            }
         } else {
            $erreur = "Login déjà utilisé !";
         }
      } 
      else {
        $erreur = "Votre login ne doit pas dépasser 255 caractères !";
     }
     }
     else {
        $erreur = "Votre nom ne doit pas dépasser 255 caractères !";
     }
    }
    else {
        $erreur = "Votre prenom ne doit pas dépasser 255 caractères !";
     }
} else {
        $erreur = "Tous les champs doivent être complétés !";
}
}

?>



<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="inscription.css">
    <title>Inscription</title>
</head>

<body>

    <header>

    </header>

    <main>

        <section class="container_img">
            <img src="ressource/archi.jpeg" alt="building"/>
        </section>

        <section class="container_form">

            <article class="container_title">
                <img src="ressource/logo2.png" alt="logo" class="logo"/>
                <h1>Morphosis</h1>
            </article>

            <article>

                <form class="form_inscription" method="POST" action="inscription.php"> 

                        <legend>Inscription</legend>

                        <label for="login"> Login : </label>
                        <input type="text"  name="login" value="<?php if(isset($login)) { echo $login; } ?>"/><br><br>

                        <label for="prenom"> Prenom : </label>
                        <input type="text"  name="prenom"  value="<?php if(isset($prenom)) { echo $prenom; } ?>" /><br><br>

                        <label for="nom"> Nom: </label>
                        <input type="text"  name="nom" value="<?php if(isset($nom)) { echo $nom; } ?>"/><br><br>
                        

                        <label for="password">Mot de passe :</label>
                        <input type="password" name="password" placeholder= "Mot de passe"  /><br>
                        <label for="mdp2">Confirmation du mot de passe :</label>
                        <input type="password" name="password2" placeholder= "Confirmation mot de passe" /><br>
                        <br>

                        <button type="submit" name="forminscription" class="button">Connexion</button>

                </form>
            </article>

            <?php
         if(isset($erreur)) {
            echo '<font color="red"><center>'.$erreur."</center></font>";
         }
         ?>

            <article class="lien">
                <a href="connexion.php">Retour à la page de connexion</a>
            </article>


        </section>

    </main>  
    
    <footer>


    </footer>

</body>

</html>