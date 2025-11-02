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
<body>
  <header class="left">
    <h1></h1>
  </header>
  <main>
    <div id='wrapper'>
          <div class='container'>
            <div class='sprite-wrapper'>
              <div class='book'>
                <div class='carousel' style='--slides: 4;'>
                  <div class='sprite'></div>
                  <div class='carousel-item'>
                    <div class='page-container'>
                      <div class='page left-page'>
                        <div>
                          <p style='margin: 0; text-indent: 1rem'>
                            <span id='prenom'>$firstname $lastname</span>
                          </p>
                        </div>
                      </div>
                      <div class='page right-page'>
                        <div></div>
                      </div>
                    </div>
                  </div>
    
                  <div class='carousel-item'>
                    <div class='page-container'>
                      <div class='page left-page'>
                        <div>
                          <p style='margin: 0;'>Profile</p><br>
                          $profile
                        </div>
                      </div>
                      <div class='page right-page'>
                        <div>
                          <p style='margin: 0;'>Experiences</p>
                        </div>
                      </div>
                    </div>
                  </div>
    
                  <div class='carousel-item'>
                    <div class='page-container'>
                      <div class='page left-page'>
                        <div>
                          <p style='margin: 0;'>Education</p><br>
                        </div>
                      </div>
                      <div class='page right-page'>
                        <div>
                          <p style='margin: 0;'>Skills</p>
                        </div>
                      </div>
                    </div>
                  </div>
    
                  <div class='carousel-item'></div>
                </div>
              </div>
            </div>
          </div>
        </div>";
  </main>
</body>
</html>
