<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">
    <title>Admin</title>
</head>

<header>
</header>

<main>

<h1>Base de données utilisateurs</h1>

<?php

$bdd = new PDO('mysql:host=localhost;dbname=moduleconnexion', 'root', '');


$data = $bdd->prepare('SELECT * FROM utilisateurs');
$data->execute();


$i=0;

echo "<div class=\"table\"><table>" ;
while ($result = $data-> fetch(PDO::FETCH_ASSOC)){
  if ($i == 0){
    foreach ($result as $key => $value){
      echo "<th>$key</th>";
    }
    $i++;
  }
  echo "<tr>";
  foreach ($result as $key => $value) {
    echo "<td>$value</td>";
  }
  echo "</tr>";
}

echo "</div></table>";

?>

</main>

<footer>
</footer>


</html>

<?php $bdd = null ?>