<!DOCTYPE HTML>
<html lang="en">
   <head>
     <meta charset="UTF-8">
     <title></title>
     <style>
     </style>
   </head>
   <body>
     <nav>
       <ul>
         <li><a href="index.php">Etusivu</a></li>
         <li><a href="kuvat.php">Ladatut kuvat</a></li>
       </ul>
     </nav>
<?php
  //Otetaan yhteys tietokantaan
  $tietokantayhteys =
  mysqli_connect ("", "", "", "");
  if(mysqli_connect_errno()) {
    echo "Yhteysvirhe tietokantaan: " . mysqli_connect_error();
  }


  // Kuvan lataus
    if(isset($_POST['submit'])) {
      $tmp_file = $_FILES['kuva']['tmp_name'];
      $target_file = basename($_FILES['kuva']['name']);
      $upload_dir = "uploads";

      if(move_uploaded_file($tmp_file, $upload_dir."/".$target_file)){
        echo "Tiedosto ladattu onnistuneesti.";
      } else {
        echo $_FILES['kuva']['error'];
      }
    }


  // Tallennetaan tietoja kuvista tauluun kuvat
  $nimetty = $_POST['nimi'];


  $query  = "INSERT INTO kuvat (nimi, tmp_name, polku, aika) VALUES ('".$_POST["nimi"]."','".$_FILES['kuva']['name']."', '".$upload_dir."', '".time()."')";

          $result = mysqli_query($tietokantayhteys, $query);
          if ($result) {
          } else {
              die("No voi. " . mysqli_error($tietokantayhteys));
          }

          mysqli_close($tietokantayhteys);

?>
     <form action="index.php" enctype="multipart/form-data" method="POST">
       <input type="file" name="kuva" /><br>
       Nimi: <input type="text" name="nimi"><br>
       <input type="submit" name="submit" value="Lataa" />
     </form>
   </body>
</html>
