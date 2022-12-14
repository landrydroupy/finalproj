<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sections</title>
   <?php include("nav.php");?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
  
  <body>
    <h1>Director Information</h1>
<table class="table table-striped">
  <thead>
    <tr>
      <th>DirectorID</th>
      <th>Director Name</th>
      <th>Academy Nominations</th>
      <th>Academy Wins</th>
      <th>Number of Films</th>
      <th>Movie Example</th>
    </tr>
  </thead>
  <tbody>
    <?php
$servername = "localhost";
$username = "landryou_user";
$password = "A2kYbmhiMHTE";
$dbname = "landryou_project_data";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$did = $_GET['id'];

$sql = "select d.directorID, d.directorName,d.filmNumber,d.academyNoms, d.academyWins, m.director, m.movieName, m.director from director d join movies m on d.directorName = m.director where m.director=?";
//echo $sql;
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $did);
    $stmt->execute();
    $result = $stmt->get_result();

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
  <tr>
    <td><?=$row["directorID"]?></td>
    <td><?=$row["director"]?></td>
    <td><?=$row["academyNoms"]?></td>
    <td><?=$row["academyWins"]?></td>
    <td><?=$row["filmNumber"]?></td>
    <td><?=$row["movieName"]?></td>
  </tr>
<?php
  }
} else {
  echo "0 results";
}
$conn->close();
?>
  </tbody>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
