<?php
include_once 'back.php';

$user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 1;
if ($user_id <= 0) {
    $user_id = 1;
}
else if ($user_id > num_users()) {
    $user_id = num_users();
  }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>View CV</title>
  <link rel="stylesheet" href="style.css">
</head>
<body class = "view">
  <header class="left">
    <h1>CV de <?= user_firstname($user_id) ?></h1>
  </header>
  <main>
    <?= newbook($user_id) ?>
  </main>
</body>
</html>
