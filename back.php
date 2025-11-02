<?php
$conn = new mysqli('db', 'root', 'monpassword', 'cvdata');



function insertData($table, $fields) {
    global $conn;
    if ($conn->connect_error) die("Connexion échouée : " . $conn->connect_error);   
    $columns = implode(",", array_keys($fields));
    $values  = "'" . implode("','", array_values($fields)) . "'";

    $sql = "INSERT INTO $table ($columns) VALUES ($values)";
    mysqli_query($conn, $sql);
}

function createnewuser($firstname, $lastname, $email, $phone, $picture){    
    global $conn;
    $sql = "INSERT INTO users (firstname, lastname, email, phone, picture) 
            VALUES ('$firstname', '$lastname', '$email', '$phone', '$picture')";
    
    mysqli_query($conn, $sql);
}

function user_firstname($id){
    global $conn;
    $sql = "SELECT firstname FROM users WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row['firstname'];
    }
}
function user_lastname($id){
    global $conn;
    $sql = "SELECT lastname FROM users WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row['lastname'];
    }
}
function user_phone($id){
    global $conn;
    $sql = "SELECT phone FROM users WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row['phone'];
    }
}
function user_email($id){
    global $conn;
    $sql = "SELECT email FROM users WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
       return "<a href='mailto:{$row['email']}' class='btn btn-primary'>{$row['email']}</a>";
    }
}
function user_picture($id){
    global $conn;
    $sql = "SELECT picture FROM users WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return '<img src="' . $row['picture'] . '" alt="Image">';
}
function user($id){
    return"<div class = 'user_profile'>
            <div class = 'user_name'>" 
              . user_firstname($id) . " " . user_lastname($id) . "
            </div>
            <div class = 'user_phone'>" . user_phone($id) . "</div>
            <div class = 'user_email'>" . user_email($id) . "</div>
            
  </div>";
}


function get_experience($id)
{
    global $conn;
    $sql = "select * from experience where user_id = $id";
    $result = mysqli_query($conn, $sql);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}
function show_experience($id, $num){
    $experiences = get_experience($id);
    return "<ul>
            <li>" . $experiences[$num - 1]['name'] . "</li>
            <li>" . $experiences[$num - 1]['description'] . "</li>
            <li>" . $experiences[$num - 1]['start_date'] . " - " . $experiences[$num - 1]['end_date'] . "</li>
        </ul>
        ";
}


function get_education($id)
{
    global $conn;
    $sql = "select * from education where user_id = $id";
    $result = mysqli_query($conn, $sql);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function show_education($id, $num){
    $educations = get_education($id);
    return "<ul>
            <li>" . $educations[$num - 1]['name'] . "</li>
            <li>" . $educations[$num - 1]['description'] . "</li>
            <li>" . $educations[$num - 1]['start_date'] . " - " . $educations[$num - 1]['end_date'] . "</li>
        </ul>";
}
function show_all_education($id){
    $result = "<ul>";
    for ($i = 1; $i <= count(get_education($id)); $i++) {
        $result .= "<li>" . show_education($id, $i) . "</li>";
    }
    $result .= "</ul>";
    return $result;
}
function get_skills($id)
{
    global $conn;
    $sql = "select * from skills where user_id = $id";
    $result = mysqli_query($conn, $sql);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}
function level($level){
  for ($i = 0; $i < 5; $i++) {
      if ($i < $level) {
          echo "★";
      } else {
          echo "☆";
      }
  }
}
function show_skills($id, $num){
    $skills = get_skills($id);
    return "
            <p>" . $skills[$num - 1]['name'] . "</p>
            <p>" . level($skills[$num - 1]['level']) . "</p>
      ";
}
function show_all_skills($id){
  $result = "<ul>";
  for ($i = 1; $i <= count(get_skills($id)); $i++) {
      $result .= "<li>" . show_skills($id, $i) . "</li>";
  }
  $result .= "</ul>";
  return $result;
}
function num_users(){
    global $conn;
    $sql = "SELECT COUNT(*) as count FROM users";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['count'];
}

function newbook($id): string {
    $profile = user($id);
    $img = user_picture($id);
    return "
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
                      <p style='margin: 0;'>Profile</p><br>
                      $profile
                    </div>
                  </div>
                  <div class='page right-page'>
                    <div>
                      <img src='$img' alt='Profile Picture'>
                    </div>
                  </div>
                </div>
              </div>

              <div class='carousel-item'>
                <div class='page-container'>
                  <div class='page left-page'>
                    <div>
                      <p style='margin: 0;'>Experiences</p><br>
                    </div>
                  </div>
                  <div class='page right-page'>
                    <div>
                      <p style='margin: 0;'></p>
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
                      <p style='margin: 0;'></p>
                    </div>
                  </div>
                </div>
              </div>

             <div class='carousel-item'>
                <div class='page-container'>
                  <div class='page left-page'>
                    <div>
                      <p style='margin: 0;'>Skills</p><br>
                    </div>
                  </div>
                  <div class='page right-page'>
                    <div>
                      <p style='margin: 0;'></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>";
}

?>
