<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=moduleconnexion', 'root', 'root');
 
if(isset($_POST['formconnection'])) {
   $loginconnect = htmlspecialchars($_POST['login']);
   $passwordconnect = $_POST['password'];

   if(!empty($loginconnect) AND !empty($passwordconnect)) {
    $requser = $bdd->prepare("SELECT * FROM utilisateurs WHERE login = ? AND password = ?");
    $requser->execute(array($loginconnect, $passwordconnect));
    $userexist = $requser->rowCount();


    if($userexist == 1) {
       $userinfo = $requser->fetch();
       $_SESSION['id'] = $userinfo['id'];
       $_SESSION['login'] = $userinfo['login'];
       $_SESSION['password'] = $userinfo['password'];

       if ($userinfo['login'] == 'admin' AND $userinfo['password'] == 'admin'){
           header("Location: admin.php?id=".$_SESSION['id']);
       }
       else{
            header("Location: profil.php?id=".$_SESSION['id']);
       }     
    }    
    else {
        $erreur = "Mauvais mail ou mot de passe !";
     }
  } else {
     $erreur = "Tous les champs doivent être complétés !";
  }
}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="connexion.css">
    <title>Connexion</title>
</head>

<body>

    <header>

    <nav id='menu'>
  <ul>
    <li><a class='dropdown-arrow' href='http://'>Menu</a>
      <ul class='sub-menus'>
      <li><a href='index.php'>Accueil</a></li>
  <li><a href='#'>Projets</a></li>
  <?php if (isset($_SESSION['id'] )) {?> 
          <li class="active"><a href="profil.php?id=" <?php $_SESSION['id'] ?> >Profil</a></li>
          <?php }  else { ?>
         <li class="active"><li><a href='inscription.php'>Inscription</a></li>
          <?php } ?>
        <?php if (isset($_SESSION['id'] )) {?> 
          <li class="active"><a href="deconnexion.php">Deconnexion</a></li>
          <?php }  else { ?>
         <li class="active"><a href="connexion.php">Connexion</a></li>
          <?php } ?> 

        <li><a href='#'>Contact</a></li>
      </ul>
    </li>
</nav>


    </header>

    <main>

        <section class="container_img">
            <img src="ressource/building.jpeg" alt="building"/>
        </section>

        <section class="container_form">

            <article class="container_title">
                <img src="ressource/logo2.png" alt="logo" class="logo"/>
                <h1>Morphosis</h1>
            </article>

            <article>

                <form class="form_connexion" method="POST" action="connexion.php">

                        <label for="login"> Login : </label><br>
                        <input type="text" name="login"  /><br><br>

                        <label for="password">Password :</label><br>
                        <input type="password" name="password"  /><br>
                        <br>

                        <button type="submit" name="formconnection" class="button">Se connecter</button>

                </form><br>
                <?php
         if(isset($erreur)) {
            echo '<font color="red"><center>'.$erreur."</center></font>";
         }
         ?>
            </article>

            <article class="lien">

                <a href="inscription.php">Inscription</a>
                <a href="index.php">Retour à la page d'accueil</a>

            </article>

        </section>

 

    </main>  
    
    <footer>


    </footer>
</body>
</html>

<?php $bdd = null ?>