<?php
include_once 'back.php';

$user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 1;
if ($user_id <= 0) {
  $user_id = 1;
} else if ($user_id > num_users()) {
  $user_id = num_users();
}
if (isset($_POST['create_user'])) {
    
  if ($_POST['create_user']) {
      $firstname = ($_POST['firstname']);
      $lastname = ($_POST['lastname']);
      $phone = ($_POST['phone']);
      $picture = fileToBase64($_FILES['picture']);
      $email = ($_POST['email']);
      $fields = [
          'firstname' => $firstname,
          'lastname' => $lastname,
          'phone' => $phone,
          'picture' => $picture,
          'email' => $email
      ];
      insertData('users', $fields);
    }
    if (isset($_POST['create_education'])) {
      $name = ($_POST['name']);
      $description = ($_POST['description']);
      $start_date = ($_POST['start_date']);
      $end_date = ($_POST['end_date']);

      $fields = [
          'name' => $name,
          'description' => $description,
          'start_date' => $start_date,
          'end_date' => $end_date,
          'user_id' => $user_id
      ];
      insertData('education', $fields);
    }
    if (isset($_POST['create_experience'])) {
      $name = ($_POST['name']);
      $description = ($_POST['description']);
      $start_date = ($_POST['start_date']);
      $end_date = ($_POST['end_date']);

      $fields = [
          'name' => $name,
          'description' => $description,
          'start_date' => $start_date,
          'end_date' => $end_date,
          'user_id' => $user_id
      ];
      insertData('experience', $fields);
    }
    if (isset($_POST['create_skill'])) {
      $name = ($_POST['name']);
      $level = ($_POST['level']);
      $fields = [
          'name' => $name,
          'level' => $level,
          'user_id' => $user_id
      ];
      insertData('skills', $fields);
    }

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
        <button data-action="create">Create</button>
        <button data-action="update">Update</button>
        <button data-action="delete">Delete</button>
      </div>
    </h1>
  </header>
  <main>
    <div id='wrapper'>
      <div class='container'>
        <div class='sprite-wrapper'>
          <div class='book create'>
            <div class='carousel' style='--slides: 4;'>
              <div class='sprite'></div>
              <div class='carousel-item'>
                <div class='page-container'>
                  <div class='page left-page'>
                    <div>
                      <h2>Create</h2>
                    </div>
                  </div>
                  <div class='page right-page'>
                    <div>
                    </div>
                  </div>
                </div>
              </div>
              <div class='carousel-item'>
                <div class='page-container'>
                  <div class='page left-page'>
                    <div>
                    </div>
                  </div>
                  <div class='page right-page'>
                    <div>
                    </div>
                  </div>
                </div>
              </div>
              <div class='carousel-item'>
                <div class='page-container'>
                  <div class='page left-page'>
                    <div>
                    </div>
                  </div>
                  <div class='page right-page'>
                    <div>
                    </div>
                  </div>
                </div>
              </div>

              <div class='carousel-item'>
                <div class='page-container'>
                  <div class='page left-page'>
                    <div>
                    </div>
                  </div>
                  <div class='page right-page'>
                    <div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class='book update'>
            <div class='carousel' style='--slides: 4;'>
              <div class='sprite'></div>
              <div class='carousel-item'>
                <div class='page-container'>
                  <div class='page left-page'>
                    <div>
                      <h2>Update</h2>
                    </div>
                  </div>
                  <div class='page right-page'>
                    <div>
                    </div>
                  </div>
                </div>
              </div>
              <div class='carousel-item'>
                <div class='page-container'>
                  <div class='page left-page'>
                    <div>
                    </div>
                  </div>
                  <div class='page right-page'>
                    <div>
                    </div>
                  </div>
                </div>
              </div>
              <div class='carousel-item'>
                <div class='page-container'>
                  <div class='page left-page'>
                    <div>
                    </div>
                  </div>
                  <div class='page right-page'>
                    <div>
                    </div>
                  </div>
                </div>
              </div>

              <div class='carousel-item'>
                <div class='page-container'>
                  <div class='page left-page'>
                    <div>
                    </div>
                  </div>
                  <div class='page right-page'>
                    <div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class='book delete'>
            <div class='carousel' style='--slides: 4;'>
              <div class='sprite'></div>
              <div class='carousel-item'>
                <div class='page-container'>
                  <div class='page left-page'>
                    <div>
                      <h2>Delete</h2>
                    </div>
                  </div>
                  <div class='page right-page'>
                    <div>
                    </div>
                  </div>
                </div>
              </div>
              <div class='carousel-item'>
                <div class='page-container'>
                  <div class='page left-page'>
                    <div>
                    </div>
                  </div>
                  <div class='page right-page'>
                    <div>
                    </div>
                  </div>
                </div>
              </div>
              <div class='carousel-item'>
                <div class='page-container'>
                  <div class='page left-page'>
                    <div>
                    </div>
                  </div>
                  <div class='page right-page'>
                    <div>
                    </div>
                  </div>
                </div>
              </div>

              <div class='carousel-item'>
                <div class='page-container'>
                  <div class='page left-page'>
                    <div>
                    </div>
                  </div>
                  <div class='page right-page'>
                    <div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>


        </div>
      </div>
    </div>
  </main>
  <script src="java.js"></script>
</body>

</html>