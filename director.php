<!doctype html>
<?php include("nav.php");?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Directors</title>
    <link rel="stylesheet" href="table-formatting.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
      
<?php
$servername = "localhost";
$username = "landryou_user";
$password = "A2kYbmhiMHTE";
$dbname = "landryou_project_data";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  switch ($_POST['saveType']) {
    case 'Add':
      $sqlAdd = "insert into director (directorName,academyNoms,academyWins,filmNumber) value (?,?,?,?)";
      $stmtAdd = $conn->prepare($sqlAdd);
      $stmtAdd->bind_param("siii", $_POST['ndirectorName'],$_POST['nacademyNoms'],$_POST['nacademyWins'],$_POST['nfilmNumber']);
      $stmtAdd->execute();
      echo '<div class="alert alert-success" role="alert">New Director added.</div>';
      break;
    case 'Edit':
      $sqlEdit = "update director set  directorName=?,academyNoms=?,academyWins=?,filmNumber=? where directorID=?";
      $stmtEdit = $conn->prepare($sqlEdit);
      $stmtEdit->bind_param("siiii", $_POST['ndirectorName'],$_POST['nacademyNoms'],$_POST['nacademyWins'],$_POST['nfilmNumber'] ,$_POST['did']);
      $stmtEdit->execute();
      echo '<div class="alert alert-success" role="alert">Director edited.</div>';
      break;
    case 'Delete':
      $sqlDelete = "delete from director where directorID=?";
      $stmtDelete = $conn->prepare($sqlDelete);
      $stmtDelete->bind_param("i", $_POST['did']);
      $stmtDelete->execute();
      echo '<div class="alert alert-success" role="alert">Director deleted.</div>';
      break;
  }
}
?>
    
     <h1>Directors</h1>
 <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDirector">
        Add Director
      </button>
<table class="table table-hover">
  <thead>
    <tr>
      <th>DirectorID</th>
            <th>Director Name</th>
            <th>Academy Nominations</th>
           <th>Academy Wins</th>
            <th>Number of Films</th>
    </tr>
  </thead>
  <tbody>
          
<?php
$sql = "SELECT * from director";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  
  while($row = $result->fetch_assoc()) {
?>
          
          <tr>
           <td><?=$row["directorID"]?></td>
    <td><?=$row["directorName"]?></td>
    <td><?=$row["academyNoms"]?></td>
    <td><?=$row["academyWins"]?></td>
    <td><?=$row["filmNumber"]?></td>
                   <td>
              <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editDirector<?=$row["directorID"]?>">
                Edit
              </button>
              <div class="modal fade" id="editDirector<?=$row["directorID"]?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editDirector<?=$row["directorID"]?>Label" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="editDirector<?=$row["directorID"]?>Label">Edit Movie</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="">
                        <div class="mb-3">
                          <label for="editDirector<?=$row["directorID"]?>name" class="form-label">Director Name</label>
                          <input type="text" class="form-control" id="editDirector<?=$row["directorID"]?>directorID" aria-describedby="editDirector<?=$row["directorID"]?>Help" name="ndirectorName" value="<?=$row['directorName']?>">
                          <div id="editDirector<?=$row["directorID"]?>Help" class="form-text">Enter the Director's name.</div>
                         <label for="editDirector<?=$row["directorID"]?>name" class="form-label">Academy Nominations</label>
                          <input type="text" class="form-control" id="editDirector<?=$row["directorID"]?>director" aria-describedby="editDirector<?=$row["directorID"]?>Help" name="nacademyNoms" value="<?=$row['academyNoms']?>">
                          <div id="editDirector<?=$row["directorID"]?>Help" class="form-text">Enter the Number of Academy Nominations</div>
                          <label for="editDirector<?=$row["directorID"]?>name" class="form-label">Academy Wins</label>
                          <input type="text" class="form-control" id="editDirector<?=$row["directorID"]?>releaseDate" aria-describedby="editDirector<?=$row["directorID"]?>Help" name="nacademyWins" value="<?=$row['academyWins']?>">
                          <div id="editDirector<?=$row["directorID"]?>Help" class="form-text">Enter the number of Academy Wins</div>
                           <label for="editDirector<?=$row["directorID"]?>name" class="form-label">Number of Films</label>
                          <input type="text" class="form-control" id="editDirector<?=$row["directorID"]?>rating" aria-describedby="editDirector<?=$row["directorID"]?>Help" name="nfilmNumber" value="<?=$row['filmNumber']?>">
                          <div id="editDirector<?=$row["directorID"]?>Help" class="form-text">Enter the number of Films they are involved with</div>
                         
			
			
			</div>
                        <input type="hidden" name="mid" value="<?=$row['directorID']?>">
                        <input type="hidden" name="saveType" value="Edit">
                        <input type="submit" class="btn btn-primary" value="Submit">
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </td>
            <td>
              <form method="post" action="">
                <input type="hidden" name="did" value="<?=$row["directorID"]?>" />
                <input type="hidden" name="saveType" value="Delete">
                <input type="submit" class="btn" onclick="return confirm('Are you sure?')" value="Delete">
              </form>
            </td>
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
      <br />
      
     

      
      <div class="modal fade" id="addDirector" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addDirectorLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="addDirectorLabel">Add Director</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post" action="">
                <div class="mb-3">
                 
                 
                  <label for="movie_movieName" class="form-label">Director Name</label>
                  <input type="text" class="form-control" id="movie_movieName" aria-describedby="nameHelp" name="ndirectorName">
                  <div id="nameHelp" class="form-text">Enter the Director's Name</div>
                  <label for="movie_director" class="form-label">Academy Nominations</label>
                  <input type="text" class="form-control" id="movie_director" aria-describedby="nameHelp" name="nacademyNoms">
                  <div id="nameHelp" class="form-text">Enter the Number of Academy Nominations</div>
                  <label for="movie_ReleaseDate" class="form-label">Academy Wins</label>
                  <input type="text" class="form-control" id="movie_ReleaseDate" aria-describedby="nameHelp" name="nacademyWins">
                  <div id="nameHelp" class="form-text">Enter the Number of Academy Wins</div>
                  <label for="movie_rating" class="form-label">Film Number</label>
                  <input type="text" class="form-control" id="movie_rating" aria-describedby="nameHelp" name="nfilmNumber">
                  <div id="nameHelp" class="form-text">Enter their Number of Films.</div>
                  
                </div>
                <input type="hidden" name="saveType" value="Add">
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
