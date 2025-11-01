<?php
include 'functions.php'; // Inclut le fichier avec la fonction

$message = "";

// Vérifie quel formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['form_user'])) {
        $fields = [
            'firstname'=> $_POST['firstname'],
            'lastname'=> $_POST['lastname'],
            'phone'=> $_POST['phone'],
            ''=> $_POST[''],
            'email'=> $_POST['email']
        ];
        insertData('users', $fields);
    }

    if (isset($_POST['form_experience'])) {
        $fields = [
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'start_date' => $_POST['start_date'],
            'end_date' => $_POST['end_date'],
            'user_id' => $_POST['user_id']
        ];
        insertData('experience', $fields);
    }

}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <title>CV Philippe et Mathieu</title>
  <meta name="author" content="P et M">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <header class="left">
    <ul>
      <h1>
        <span id="prenom">Mathieu Jin </span>
        <br>
        <span id="nom">Philippe Rastoul</span>
      </h1>
    </ul>
  </header>

  <main class="main">
  </main>

    <?php
      include 'back.php'; 
      echo newbook(1);
      
    ?>
    <footer class="right">
    <ul>
      <li>
        <a href="mailto:philippe.rastoul@epitech.eu" class="btn btn-primary">Contactez-moi !</a>
      </li>
    </ul>
  </footer>

</body>

</html>