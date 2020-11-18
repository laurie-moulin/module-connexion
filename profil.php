<?php
session_start();
 
$bdd = new PDO('mysql:host=localhost;dbname=moduleconnexion', 'root', 'root');

$msg = "";

if(isset($_SESSION['id'])) {   
   $requser = $bdd->prepare("SELECT * FROM utilisateurs WHERE id = ?");
   $requser->execute(array($_SESSION['id']));
   $user = $requser->fetch();
   
   if(isset($_POST['formprofil'])){

      if(isset($_POST['newlogin']) AND !empty($_POST['newlogin']) AND $_POST['newlogin'] != $user['login']) {
            $login = htmlspecialchars($_POST['newlogin']);
            $reqlogin = $bdd->prepare("SELECT * FROM utilisateurs WHERE login = ?");
            $reqlogin->execute(array($login));
            $loginexist = $reqlogin->rowCount();

            if($loginexist == 0) {
            $newlogin = htmlspecialchars($_POST['newlogin']);
            $insertlogin = $bdd->prepare("UPDATE utilisateurs SET login = ? WHERE id = ?");
            $insertlogin->execute(array($newlogin, $_SESSION['id']));
            }
            else{
            $msg = "Login déjà utilisé";
         }
      }
      if(isset($_POST['newprenom']) AND !empty($_POST['newprenom']) AND $_POST['newprenom'] != $user['prenom']) {
         $newprenom = htmlspecialchars($_POST['newprenom']);
         $insertprenom = $bdd->prepare("UPDATE utilisateurs SET prenom = ? WHERE id = ?");
         $insertprenom->execute(array($newprenom, $_SESSION['id']));
      }
      if(isset($_POST['newnom']) AND !empty($_POST['newnom']) AND $_POST['newnom'] != $user['nom']) {
         $newnom = htmlspecialchars($_POST['newnom']);
         $insertnom = $bdd->prepare("UPDATE utilisateurs SET nom = ? WHERE id = ?");
         $insertnom->execute(array($newnom, $_SESSION['id']));
      }
      if(isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2'])) {
         $mdp1 = ($_POST['newmdp1']);
         $mdp2 = ($_POST['newmdp2']);
         if($mdp1 == $mdp2) {
            $insertmdp = $bdd->prepare("UPDATE utilisateurs SET motdepasse = ? WHERE id = ?");
            $insertmdp->execute(array($mdp1, $_SESSION['id'])); 
         } 
         else {
            $msg = "Vos deux mdp ne correspondent pas !";
         }    
         }  if ($msg == ""){
            $msg = "Votre profil a bien été modifié !";
      }      
   } 
      
} 


 
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="profil.css">
    <title>Profil</title>
</head>

   <body>

   <header>
   </header>

   <main>

        <section class="container_form">

            <article class="container_title">
                <img src="ressource/logo2.png" alt="logo" class="logo"/>
                <h1>Morphosis</h1>
  
            </article>

            <article class="container_formulaire">

            <div>
         <h2>Bonjour <?php echo $user['login']; ?> ! </h2>
         <p>Edition de votre profil</p>
</div>

         <form method="POST" action="" enctype="multipart/form-data" class="form_inscription">

         <div class="display_form">
         <div>
               <label>Login :</label><br>
               <input type="text" name="newlogin" placeholder="login" value="<?php echo $user['login']; ?>" /><br /><br />
               <label>Prenom :</label><br>
               <input type="text" name="newprenom" placeholder="Prenom" value="<?php echo $user['prenom']; ?>" /><br /><br />
               <label>Nom :</label><br>
               <input type="text" name="newnom" placeholder="nom" value="<?php echo $user['nom']; ?>" /><br /><br />
         </div>
         <div>
               <label>Mot de passe :</label><br>
               <input type="password" name="newmdp1" placeholder="Mot de passe"/><br /><br />
               <label>Confirmation - mot de passe :</label><br>
               <input type="password" name="newmdp2" placeholder="Confirmation du mot de passe" /><br /><br /> 

               <?php if(isset($msg)) { echo '<font color="green"><center>'.$msg."</center></font>";} ?><br>

               <input type="submit" name="formprofil"  class="button" value="Mettre à jour mon profil !" />
         </div>

</div>
            </form>
            
         
         </article>

         </section>
      </main>

      <footer>
</footer>
   </body>
</html>
