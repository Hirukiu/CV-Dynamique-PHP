<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cvdata";
$conn = new mysqli($servername, $username, $password, $dbname);

function insertData($table, $fields) {
    global $conn;
    if ($conn->connect_error) die("Connexion échouée : " . $conn->connect_error);

    // Colonnes et valeurs dynamiques
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
    return"<ul>
            <li>" . user_firstname($id) . "</li>
            <li>" . user_lastname($id) . "</li>
            <li>" . user_phone($id) . "</li>
            <li>" . user_email($id) . "</li>
            <li>" . user_picture($id) . "</li>
        </ul>
        ";
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
function num_users(){
    global $conn;
    $sql = "SELECT COUNT(*) as count FROM users";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['count'];
}

function newbook($id): string {
    include_once 'back.php';

    $firstname = user_firstname($id);
    $lastname = user_lastname($id);
    $profile = user($id);

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
}

?>
