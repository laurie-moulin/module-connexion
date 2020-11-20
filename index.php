<?php
session_start();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="index.css">
  <title>Accueil</title>
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

    <img src="ressource/04-McCleanDesign_p002.jpg" alt="home" class="home">
    <h1>MORPHOSIS</h1>
    <img src="ressource/logo2.png" alt="logo" class="logo">

  </header>

  <main>


    <div class="apropos">

      <section class="container_color">


        <img src="ressource/archi1.jpg" alt="archi" class="archi">

      </section>

      <section class="container_title">

        <p class="ligne"> </p>
        <p class="bordure_verticale">
        </p>
        <h2>Architecture <br> & Design</h2>

        <p class="txt">ipsom Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ipsum doloribus odio sit,
          laboriosam eos, accusantium debitis quas mollitia beatae non vitae. Illum blanditiis dolorem error asperiores
          vitae unde qui est! <br> ipsom Lorem, ipsum dolor sit amet consectetur adipisicing elit. Porro, tempora quia!
          Eos dolore explicabo temporibus suscipit, enim perspiciatis corporis quas itaque laboriosam placeat expedita
          eum, aliquid porro fugiat natus. Repudiandae.</p>

        <article class="container_lien">

          <h3>Espace Client</h3>

          <a href="connexion.php">Se connecter</a><br><br><br>
          <a href="inscription.php">S'inscrire</a>

        </article>

      </section>
    </div>

</html>