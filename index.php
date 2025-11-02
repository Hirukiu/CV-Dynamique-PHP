<?php
  include_once 'back.php';
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
          Hello
        </h1>
      </ul>
    </header>

    <nav>
      <fieldset>
      <legend>Select an option</legend>
      <form>
        <button type="submit" name="user_id" value="1" formaction="view.php?user_id=1">Voir Mathieu</button>
        <button type="submit" name="user_id" value="2" formaction="view.php?user_id=2">Voir Philippe</button>
        <button type="submit" name="user_id" value="1" formaction="edit.php?user_id=1">Edit Mathieu</button>
        <button type="submit" name="user_id" value="2" formaction="edit.php?user_id=2">Edit Philippe</button>
      </form>
      </fieldset>
    </nav>

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