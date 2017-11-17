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
<?php
$dbc = mysqli_connect('localhost','root','root','gastenboek');
$select = "SELECT naam,bericht FROM berichten";

$result = mysqli_query($dbc, $select);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
echo '<b>Naam: </b>' . $row["naam"] . '<br>';
echo '<b>Bericht: </b>' . $row["bericht"] . '<br>';
echo '_________________________________________________<br>';
    }
}
if (isset($_POST["submit"])) {
  $naam = $_POST["naam"];
  $bericht = $_POST["bericht"];

  $naamFilter = preg_match("#\b(^kut)\b#", $naam);
  $berichtFilter = preg_match("#\b(^kut)\b#", $bericht);
if ($naamFilter && $berichtFilter) {
  echo "je mag geen kut zeggen";
} else {
  $insertImage = "INSERT INTO berichten(naam, bericht) VALUES ('$naam', '$bericht')";
  $result = mysqli_query($dbc, $insertImage);
  echo "gelukt";
}

}

mysqli_close($dbc);
 ?>

  </body>
</html>
