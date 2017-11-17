<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form action="index.php" method="post">
      <input type="text" name="naam" placeholder="naam"><br><br>
      <textarea name="bericht" rows="8" cols="80"></textarea>
      <input type="submit" name="submit" value="verstuur">
    </form>
    Het woord dat wordt gefiltert is lol<br>
    En er is gebruik gemaakt van PDO<br><br>
<?php
$dbc = new PDO('mysql:hosts=localhost;dbname=21960_db', 'maurice', 'depies');
$select = $dbc->prepare("SELECT naam,bericht FROM gastenboek");
$select->execute();


    while ($row = $select->fetch()) {
echo '<b>Naam: </b>' . $row["naam"] . '<br>';
echo '<b>Bericht: </b>' . $row["bericht"] . '<br>';
echo '_________________________________________________<br>';
    }

if (isset($_POST["submit"])) {
  $naam = strtolower($_POST["naam"]);
  $bericht = strtolower($_POST["bericht"]);

  $naamFilter = preg_replace('/\blol\b/', "***", $naam);
  $berichtFilter = preg_replace('/\blol\b/', "***", $bericht);

if ($naam != $naamFilter || $bericht != $berichtFilter) {
  echo "je mag geen lol zeggen";
} else {
  $insertImage = $dbc->prepare("INSERT INTO gastenboek(naam, bericht) VALUES (?,?)");
  $insertImage->bindParam(1,$naamFilter);
  $insertImage->bindParam(2,$berichtFilter);
  $insertImage->execute();

  echo "gelukt";
}

}

 ?>

  </body>
</html>
