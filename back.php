<?php

use LDAP\Result;
$conn = new mysqli('db', 'root', 'monpassword', 'cvdata');



function insertData($table, $fields)
{
  global $conn;

  $columns = implode(",", array_keys($fields));
  $values = "'" . implode("','", array_values($fields)) . "'";

  $sql = "INSERT INTO $table ($columns) VALUES ($values)";

  mysqli_query($conn, $sql);
}

function ModifData($table, $fields)
{
  global $conn;

  $setClause = [];
  foreach ($fields as $column => $value) {
    $setClause[] = "$column = '$value'";
  }
  $setString = implode(", ", $setClause);

  $sql = "UPDATE $table SET $setString WHERE user_id = " . $fields['user_id'] . " and name = '" . $fields['name'] . "'";

  mysqli_query($conn, $sql);
}

function modif_user($fields, $id)
{
  global $conn;

  $setClause = [];
  foreach ($fields as $column => $value) {
    $setClause[] = "$column = '$value'";
  }
  $setString = implode(", ", $setClause);

  $sql = "UPDATE users SET $setString WHERE id = " . $id;

  mysqli_query($conn, $sql);
}
function deleteUser($id) {
    global $conn;

    if (!canDeleteUser($id)) {
      echo "tu peut pas supprimer";
        return false; 
    }

    $sql = "DELETE FROM users WHERE id = $id";
    mysqli_query($conn, $sql);
    return true;
}
function deleteData($table, $id, $name)
{
  global $conn;
  $sql = "DELETE FROM $table WHERE user_id = $id AND name = '$name' LIMIT 1";
  mysqli_query($conn, $sql);
}
function canDeleteUser($user_id) {
    global $conn;

    $tables = ['experience', 'education', 'skills'];
    foreach ($tables as $table) {
        $sql = "SELECT COUNT(*) as count FROM $table WHERE user_id = $user_id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        if ($row['count'] > 0) {
            return false;
        }
    }

    return true; 
}

function user_firstname($id)
{
  global $conn;

  $sql = "SELECT firstname FROM users WHERE id = $id";
  $result = mysqli_query($conn, $sql);

  if ($result) {
    $row = mysqli_fetch_assoc($result);
    return $row['firstname'];
  }
}
function user_lastname($id)
{
  global $conn;

  $sql = "SELECT lastname FROM users WHERE id = $id";
  $result = mysqli_query($conn, $sql);

  if ($result) {
    $row = mysqli_fetch_assoc($result);
    return $row['lastname'];
  }
}
function user_phone($id)
{
  global $conn;

  $sql = "SELECT phone FROM users WHERE id = $id";
  $result = mysqli_query($conn, $sql);

  if ($result) {
    $row = mysqli_fetch_assoc($result);
    return $row['phone'];
  }
}

function fileToBase64($file)
{
  $image = file_get_contents($file['tmp_name']);
  $mimeType = mime_content_type($file['tmp_name']);
  $base64 = base64_encode($image);
  return "data:$mimeType;base64,$base64";
}

function user_email($id)
{
  global $conn;

  $sql = "SELECT email FROM users WHERE id = $id";
  $result = mysqli_query($conn, $sql);

  if ($result) {
    $row = mysqli_fetch_assoc($result);
    return "<a href='mailto:{$row['email']}' class='btn btn-primary'>{$row['email']}</a>";
  }
}
function user_picture($id)
{
    global $conn;

    $sql = "SELECT picture FROM users WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    return !empty($row['picture']) ? $row['picture'] : 'default.png';
}

function user($id)
{
  return "<div class = 'user_profile'>
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
function show_experience($id, $num)
{
  $experiences = get_experience($id);

  return "<div class='object'>
            <div class='titleof'>" . $experiences[$num - 1]['name'] . "</div>
            <div>" . $experiences[$num - 1]['startdate'] . " - " . $experiences[$num - 1]['enddate'] . "</div>
            <div>" . $experiences[$num - 1]['description'] . "</div>
        </div>";
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

function show_education($id, $num)
{
  $educations = get_education($id);

  return "<div class='object'>
            <div class='titleof'>" . $educations[$num - 1]['name'] . "</div>
            <div>" . $educations[$num - 1]['startdate'] . " - " . $educations[$num - 1]['enddate'] . "</div>
            <div>" . $educations[$num - 1]['description'] . "</div>
        </div>";
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
function level($level)
{
  $result = "";
  for ($i = 0; $i < 5; $i++) {

    if ($i < $level) {
      $result .= "★";
    } else {
      $result .= "☆";
    }

  }
  return $result;
}
function show_skills($id, $num)
{
  $skills = get_skills($id);

  return "<div class='object'>
            <div class='titleof'>" . $skills[$num - 1]['name'] . "</div>
            <div>" . level($skills[$num - 1]['level']) . "</div>
      </div>";

}

function num_users()
{
  global $conn;
  $sql = "SELECT COUNT(*) as count FROM users";

  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);

  return $row['count'];
}


function show_all_experience($id)
{
  $data = get_experience($id);
  $left = "<ul>";
  $right = "<ul>";

  for ($i = 0; $i < count($data); $i++) {
    if ($i < 4) {
      $left .= "<li>" . show_experience($id, $i + 1) . "</li>";
    } else {
      $right .= "<li>" . show_experience($id, $i + 1) . "</li>";
    }
  }

  $left .= "</ul>";
  $right .= "</ul>";

  return ['left' => $left, 'right' => $right];
}

function show_all_skills($id)
{
  $data = get_skills($id);
  $left = "<ul>";
  $right = "<ul>";

  for ($i = 0; $i < count($data); $i++) {
    if ($i < 4) {
      $left .= "<li>" . show_skills($id, $i + 1) . "</li>";
    } else {
      $right .= "<li>" . show_skills($id, $i + 1) . "</li>";
    }
  }

  $left .= "</ul>";
  $right .= "</ul>";

  return ['left' => $left, 'right' => $right];
}

function show_all_education($id)
{
  $data = get_education($id);
  $left = "<ul>";
  $right = "<ul>";

  for ($i = 0; $i < count($data); $i++) {
    if ($i < 4) {
      $left .= "<li>" . show_education($id, $i + 1) . "</li>";
    } else {
      $right .= "<li>" . show_education($id, $i + 1) . "</li>";
    }
  }

  $left .= "</ul>";
  $right .= "</ul>";

  return ['left' => $left, 'right' => $right];
}


function newbook($id): string
{
  $profile = user($id);
  $img = user_picture($id);

  $skills = show_all_skills($id);
  $education = show_all_education($id);
  $experiences = show_all_experience($id);


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
                    <div class ='div-container'>
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
                      {$experiences['left']}
                    </div>
                  </div>
                  <div class='page right-page'>
                    <div>
                      {$experiences['right']}
                    </div>
                  </div>
                </div>
              </div>
              <div class='carousel-item'>
                <div class='page-container'>
                  <div class='page left-page'>
                    <div>
                      <p style='margin: 0;'>Education</p><br>
                      {$education['left']}
                    </div>
                  </div>
                  <div class='page right-page'>
                    <div>
                      {$education['right']}
                    </div>
                  </div>
                </div>
              </div>

              <div class='carousel-item'>
                <div class='page-container'>
                  <div class='page left-page'>
                    <div>
                      <p style='margin: 0;'>Skills</p><br>
                      {$skills['left']}
                    </div>
                  </div>
                  <div class='page right-page'>
                    <div>
                      {$skills['right']}
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