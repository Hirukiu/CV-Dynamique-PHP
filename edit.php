<?php
include_once 'back.php';

$user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 1;
if ($user_id <= 0) {
  $user_id = 1;
} else if ($user_id > num_users()) {
  $user_id = num_users();
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Edit CV</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <header class="left">
    <h1>
      <div class='choice'>
        <button>create</button>
        <button>update</button>
        <button>delete</button>
      </div>
    </h1>
  </header>
  <main>
    <div id='wrapper'>
      <div class='container'>
        <div class='sprite-wrapper'>
          <div class='book'>
            <div class='carousel' style='--slides: 4;'>
              <div class='carousel-controls'>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</body>

</html>