<?php
include_once 'back.php';

$user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 1;
if ($user_id <= 0) {
  $user_id = 1;
} else if ($user_id > num_users()) {
  $user_id = num_users();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (isset($_POST['create_user'])) {
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
  } else if (isset($_POST['create_education'])) {
    $name = ($_POST['name']);
    $description = ($_POST['description']);
    $start_date = ($_POST['start_date']);
    $end_date = ($_POST['end_date']);

    $fields = [
      'name' => $name,
      'description' => $description,
      'startdate' => $start_date,
      'enddate' => $end_date,
      'user_id' => $user_id
    ];

    insertData('education', $fields);
  } else if (isset($_POST['create_experience'])) {
    $name = ($_POST['name']);
    $description = ($_POST['description']);
    $start_date = ($_POST['start_date']);
    $end_date = ($_POST['end_date']);

    $fields = [
      'name' => $name,
      'description' => $description,
      'startdate' => $start_date,
      'enddate' => $end_date,
      'user_id' => $user_id
    ];

    insertData('experience', $fields);
  } else if (isset($_POST['create_skill'])) {
    $name = ($_POST['name']);
    $level = ($_POST['level']);

    $fields = [
      'name' => $name,
      'level' => $level,
      'user_id' => $user_id
    ];

    insertData('skills', $fields);
  } else if (isset($_POST['update_skill'])) {
    $name = ($_POST['name']);
    $level = ($_POST['level']);

    $fields = [
      'name' => $name,
      'level' => $level,
      'user_id' => $user_id
    ];
    ModifData('skills', $fields);
  } else if (isset($_POST['update_education'])) {
    $name = ($_POST['name']);
    $description = ($_POST['description']);
    $start_date = ($_POST['start_date']);
    $end_date = ($_POST['end_date']);

    $fields = [
      'name' => $name,
      'description' => $description,
      'startdate' => $start_date,
      'enddate' => $end_date,
      'user_id' => $user_id
    ];

    ModifData('education', $fields);
  } else if (isset($_POST['update_experience'])) {
    $name = ($_POST['name']);
    $description = ($_POST['description']);
    $start_date = ($_POST['start_date']);
    $end_date = ($_POST['end_date']);

    $fields = [
      'name' => $name,
      'description' => $description,
      'startdate' => $start_date,
      'enddate' => $end_date,
      'user_id' => $user_id
    ];

    ModifData('experience', $fields);
  } 
  else if (isset($_POST['update_user'])) {
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

    modif_user( $fields , $user_id);
  }

  else if(isset($_POST['delete_user'])){
    deleteUser( $user_id);
  }
  else if(isset($_POST['delete_experience'])){
    deleteData("experience", $user_id, $_POST['name']);
  }
  else if(isset($_POST["delete_education"])){
    deleteData("education", $user_id, $_POST['name']);
  }
  else if(isset($_POST["delete_skill"])){
    deleteData("skills", $user_id, $_POST['name']);
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
  <nav>
    <ul class="navbar">
      <li><a href="view.php?user_id=1">Voir Mathieu</a></li>
      <li><a href="view.php?user_id=2">Voir Philippe</a></li>
      <li><a href="edit.php?user_id=1">Edit Mathieu</a></li>
      <li><a href="edit.php?user_id=2">Edit Philippe</a></li>
    </ul>
  </nav>
  <div class="container-edit">
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
                        <h2>Create new User</h2>
                        <form method="POST" action="edit.php?user_id=<?= $user_id ?>" enctype="multipart/form-data">
                          <label for="fname">First name</label><br>
                          <input type="text" id="fname" name="firstname" required><br>
                          <label for="lname">Last name</label><br>
                          <input type="text" id="lname" name="lastname" required><br>
                          <label for="email">Email</label><br>
                          <input type="text" id="email" name="email" required><br>
                          <label for="phone">Phone</label><br>
                          <input type="text" id="phone" name="phone" required><br>
                          <label class="custom-file-upload">
                            Choisir un fichier
                            <input type="file" id="picture" name="picture" onchange="updateFileName()">
                          </label> <br>
                          <input type="submit" value="Create User" name="create_user">
                        </form>
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
                        <h2>Create new education</h2>
                        <form method="POST" action="edit.php?user_id=<?= $user_id ?>" enctype="multipart/form-data">
                          <label for="name">name</label><br>
                          <input type="text" id="name" name="name" required><br>

                          <label for="description">description</label><br>
                          <input type="text" id="description" name="description" required><br>

                          <label for="start_date">start_date</label><br>
                          <input type="date" id="start_date" name="start_date" required><br>

                          <label for="end_date">end_date</label><br>
                          <input type="date" id="end_date" name="end_date" required><br>

                          <input type="submit" value="create education" name="create_education">
                        </form>
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
                        <h2>Create new experience</h2>
                        <form method="POST" action="edit.php?user_id=<?= $user_id ?>" enctype="multipart/form-data">
                          <label for="name">name</label><br>
                          <input type="text" id="name" name="name" required><br>

                          <label for="description">description</label><br>
                          <input type="text" id="description" name="description" required><br>

                          <label for="start_date">start_date</label><br>
                          <input type="date" id="start_date" name="start_date" required><br>

                          <label for="end_date">end_date</label><br>
                          <input type="date" id="end_date" name="end_date" required><br>

                          <input type="submit" value="create experience" name="create_experience">
                        </form>
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
                        <h2>Create new skills</h2>
                        <form method="POST" action="edit.php?user_id=<?= $user_id ?>" enctype="multipart/form-data">
                          <label for="name">name</label><br>
                          <input type="text" id="name" name="name" required><br>

                          <label for="level">level</label><br>
                          <input type="int" id="level" name="level" required><br>

                          <input type="submit" value="create skills" name="create_skill">
                        </form>
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
                        <h2>update User</h2>
                        <form method="POST" action="edit.php?user_id=<?= $user_id ?>" enctype="multipart/form-data">
                          <label for="fname">First name</label><br>
                          <input type="text" id="fname" name="firstname" required><br>
                          <label for="lname">Last name</label><br>
                          <input type="text" id="lname" name="lastname" required><br>
                          <label for="email">Email</label><br>
                          <input type="text" id="email" name="email" required><br>
                          <label for="phone">Phone</label><br>
                          <input type="text" id="phone" name="phone" required><br>
                          <label class="custom-file-upload">
                            Choisir un fichier
                            <input type="file" id="picture" name="picture" onchange="updateFileName()">
                          </label> <br>
                          <input type="submit" value="update User" name="update_user">
                        </form>
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
                        <h2>Update education</h2>
                        <form method="POST" action="edit.php?user_id=<?= $user_id ?>" enctype="multipart/form-data">
                          <label for="name">name</label><br>
                          <input type="text" id="name" name="name" required><br>

                          <label for="description">description</label><br>
                          <input type="text" id="description" name="description" required><br>

                          <label for="start_date">start_date</label><br>
                          <input type="date" id="start_date" name="start_date" required><br>

                          <label for="end_date">end_date</label><br>
                          <input type="date" id="end_date" name="end_date" required><br>

                          <input type="submit" value="update education" name="update_education">
                        </form>
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
                        <h2>Update experience</h2>
                        <form method="POST" action="edit.php?user_id=<?= $user_id ?>" enctype="multipart/form-data">
                          <label for="name">name</label><br>
                          <input type="text" id="name" name="name" required><br>

                          <label for="description">description</label><br>
                          <input type="text" id="description" name="description" required><br>

                          <label for="start_date">start_date</label><br>
                          <input type="date" id="start_date" name="start_date" required><br>

                          <label for="end_date">end_date</label><br>
                          <input type="date" id="end_date" name="end_date" required><br>

                          <input type="submit" value="update experience" name="update_experience">
                        </form>
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
                        <h2>Update skills</h2>
                        <form method="POST" action="edit.php?user_id=<?= $user_id ?>" enctype="multipart/form-data">
                          <label for="name">name</label><br>
                          <input type="text" id="name" name="name" required><br>

                          <label for="level">level</label><br>
                          <input type="int" id="level" name="level" required><br>

                          <input type="submit" value="update skills" name="update_skill">
                        </form>
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
                        <h2>Delete User</h2>
                        <form method="POST" action="edit.php?user_id=<?= $user_id ?>" enctype="multipart/form-data">
                          <input type="checkbox" required><label for="user">Delete this user?</label><br>
                          <input type="submit" value="delete user" name="delete_user">
                        </form>
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
                        <h2>Delete education</h2>
                        <form method="POST" action="edit.php?user_id=<?= $user_id ?>" enctype="multipart/form-data">
                          <label for="name">name</label><br>
                          <input type="text" id="name" name="name" required><br>

                          <input type="submit" value="delete education" name="delete_education">
                        </form>
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
                        <h2>Delete experience</h2>
                        <form method="POST" action="edit.php?user_id=<?= $user_id ?>" enctype="multipart/form-data">
                          <label for="name">name</label><br>
                          <input type="text" id="name" name="name" required><br>

                          <input type="submit" value="delete experience" name="delete_experience">
                        </form>
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
                        <h2>Delete skill</h2>
                        <form method="POST" action="edit.php?user_id=<?= $user_id ?>" enctype="multipart/form-data">
                          <label for="name">name</label><br>
                          <input type="text" id="name" name="name" required><br>

                          <input type="submit" value="delete skill" name="delete_skill">
                        </form>
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
  </div>
  <script src="java.js"></script>
</body>



</html>