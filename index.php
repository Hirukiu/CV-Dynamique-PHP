<?php
include_once  'back.php';
$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['form_user'])) {
        $imageData = file_get_contents($_FILES['picture']['tmp_name']);
        $imageBase64 = 'data:' . $_FILES['picture']['type'] . ';base64,' . base64_encode($imageData);
        $fields = [
            'firstname'=> $_POST['firstname'],
            'lastname'=> $_POST['lastname'],
            'phone'=> $_POST['phone'],
            'picture'=> $imageBase64,
            'email'=> $_POST['email']
        ];
        insertData('users', $fields);
    }

    else if (isset($_POST['form_experience'])) {
        $fields = [
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'start_date' => $_POST['start_date'],
            'end_date' => $_POST['end_date'],
            'user_id' => $_POST['user_id']
        ];
        insertData('experience', $fields);
    }
    else if (isset($_POST['form_education'])) {
        $fields = [
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'start_date' => $_POST['start_date'],
            'end_date' => $_POST['end_date'],
            'user_id' => $_POST['user_id']
        ];
        insertData('education', $fields);
    }
    else if (isset($_POST['form_skill'])) {
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
        <div>
    <input type="radio" id="mathieu" name="person" value="Mathieu" checked />
    <label for="huey">Mathieu</label>
  </div>
  <div>
    <input type="radio" id="philippe" name="person" value="Philippe"/>
    <label for="dewey">Philippe</label>
  </div>
  </fieldset>

      </h1>
    </ul>
  </header>

  <main class="main">
    <form method="POST">
    <input type="hidden">
    <label for="name">Name</label>
    <input type="text" id="Name" name="name" placeholder="Your name.." required>
    <label for="lname">Profile</label>
    <input type="text" id="Profile" name="profile" placeholder="Your profile.." required >
    <label for="pnumber">Experience</label>
    <input type="text" id="Experience" name="experience" placeholder="Your experience.." required>
    <label for="mail">Education</label>
    <input type="text" id="Education" name="Education" placeholder="Your education.." required>
    <label for="subject">Skills</label>
    <input type="text" id="skills" name="Skills" placeholder="Your skills.." required>
    <input type="submit" value="Submit">
  </form>
  </main>
    <?php
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