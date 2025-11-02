<?php
  include_once 'back.php';
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['form_user'])) {
      $imageData = file_get_contents($_FILES['picture']['tmp_name']);
      $imageBase64 = 'data:' . $_FILES['picture']['type'] . ';base64,' . base64_encode($imageData);
      $fields = [
        'firstname' => $_POST['firstname'],
        'lastname' => $_POST['lastname'],
        'phone' => $_POST['phone'],
        'picture' => $imageBase64,
        'email' => $_POST['email']
      ];
      insertData('users', $fields);
    } else if (isset($_POST['form_experience'])) {
      $fields = [
        'name' => $_POST['name'],
        'description' => $_POST['description'],
        'start_date' => $_POST['start_date'],
        'end_date' => $_POST['end_date'],
        'user_id' => $_POST['user_id']
      ];
      insertData('experience', $fields);
    } else if (isset($_POST['form_education'])) {
      $fields = [
        'name' => $_POST['name'],
        'description' => $_POST['description'],
        'start_date' => $_POST['start_date'],
        'end_date' => $_POST['end_date'],
        'user_id' => $_POST['user_id']
      ];
      insertData('education', $fields);
    } else if (isset($_POST['form_skill'])) {
      $fields = [
        'name' => $_POST['name'],
        'level' => $_POST['level'],
        'user_id' => $_POST['user_id']
      ];
      insertData('skills', $fields);
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
          <fieldset>
            <legend>Select one of us</legend>
            <form method="post">
              <button type="submit" name="person" value="1" formaction="view.php?user_id=1">Voir Mathieu</button>
              <button type="submit" name="person" value="2" formaction="view.php?user_id=2">Voir Philippe</button>
            </form>
          </fieldset>
        </h1>
      </ul>
    </header>
    <main class="main">
    </main>
    <footer class="right">
      <ul>
        <li>
          <a href="mailto:philippe.rastoul@epitech.eu" class="btn btn-primary">Contactez-moi !</a>
        </li>
      </ul>
    </footer>
    <script src="java.js"></script>
  </body>
</html>