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