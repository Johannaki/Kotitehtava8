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
  $tietokantayhteys =
  mysqli_connect ("", "okp", "oli9tRR3", "johanna_okp");
  if(mysqli_connect_errno()) {
    echo "Yhteysvirhe tietokantaan: " . mysqli_connect_error();
  }

  $nimetty = $_POST['nimi'];

  $query  = "INSERT INTO kuvat (nimi)
          VALUES ('".$_POST["nimi"]."')";

          $result = mysqli_query($tietokantayhteys, $query);
          if ($result) {
          } else {
              die("No voi. " . mysqli_error($tietokantayhteys));
          }

          mysqli_close($tietokantayhteys);


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
?>
     <form action="index.php" enctype="multipart/form-data" method="POST">
       <input type="file" name="kuva" /><br>
       Nimi: <input type="text" name="nimi"><br>
       <input type="submit" name="submit" value="Lataa" />
     </form>


   </body>
</html>
