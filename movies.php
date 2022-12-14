<!doctype html>
<?php include("nav.php");?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Movies</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
      
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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  switch ($_POST['saveType']) {
    case 'Add':
      $sqlAdd = "insert into movies (movieName,director,releaseDate,rating,imdb_score) value (?,?,?,?,?)";
      $stmtAdd = $conn->prepare($sqlAdd);
      $stmtAdd->bind_param("ssssd", $_POST['nMovieName'],$_POST['nDirector'],$_POST['nReleaseDate'],$_POST['nRating'],$_POST['nIMDBScore']);
      $stmtAdd->execute();
      echo '<div class="alert alert-success" role="alert">New Movie added.</div>';
      break;
    case 'Edit':
      $sqlEdit = "update movies set  movieName=?,director=?,releaseDate=?,rating=?,imdb_score=? where movieID=?";
      $stmtEdit = $conn->prepare($sqlEdit);
      $stmtEdit->bind_param("ssssdi", $_POST['nMovieName'],$_POST['nDirector'],$_POST['nReleaseDate'],$_POST['nRating'],$_POST['nIMDBScore'] ,$_POST['mid']);
      $stmtEdit->execute();
      echo '<div class="alert alert-success" role="alert">Movie edited.</div>';
      break;
    case 'Delete':
      $sqlDelete = "delete from movies where movieID=?";
      $stmtDelete = $conn->prepare($sqlDelete);
      $stmtDelete->bind_param("i", $_POST['mid']);
      $stmtDelete->execute();
      echo '<div class="alert alert-success" role="alert">Movie deleted.</div>';
      break;
  }
}
?>
    
     <h1>Movies</h1>
<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th>MovieID</th>
            <th>Movie Name</th>
            <th>Director</th>
           <th>Release Date</th>
            <th>Rating</th>
            <th>IMDB Score</th>      
    </tr>
  </thead>
  <tbody>
          
<?php
$sql = "SELECT * from movies";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
          
          <tr>
           <td><?=$row["movieID"]?></td>
    <td><?=$row["movieName"]?></td>
    <td><?=$row["director"]?></td>
    <td><?=$row["releaseDate"]?></td>
    <td><?=$row["rating"]?></td>
    <td><?=$row["imdb_score"]?></td>
            <td>
              <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editMovie<?=$row["movieID"]?>">
                Edit
              </button>
              <div class="modal fade" id="editMovie<?=$row["movieID"]?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editMovie<?=$row["movieID"]?>Label" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="editMovie<?=$row["movieID"]?>Label">Edit Movie</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="">
                        <div class="mb-3">
                          <label for="editMovie<?=$row["movieID"]?>name" class="form-label">movieName</label>
                          <input type="text" class="form-control" id="editMovie<?=$row["movieID"]?>movieID" aria-describedby="editMovie<?=$row["movieID"]?>Help" name="nMovieName" value="<?=$row['movieName']?>">
                          <div id="editMovie<?=$row["movieID"]?>Help" class="form-text">Enter the Movie's name.</div>
                         <label for="editMovie<?=$row["movieID"]?>name" class="form-label">Director</label>
                          <input type="text" class="form-control" id="editMovie<?=$row["movieID"]?>director" aria-describedby="editMovie<?=$row["movieID"]?>Help" name="nDirector" value="<?=$row['director']?>">
                          <div id="editMovie<?=$row["movieID"]?>Help" class="form-text">Enter the Movie's Director.</div>
                          <label for="editMovie<?=$row["movieID"]?>name" class="form-label">Release Date</label>
                          <input type="text" class="form-control" id="editMovie<?=$row["movieID"]?>releaseDate" aria-describedby="editMovie<?=$row["movieID"]?>Help" name="nReleaseDate" value="<?=$row['releaseDate']?>">
                          <div id="editMovie<?=$row["movieID"]?>Help" class="form-text">Enter the Movie's Release Date.</div>
                           <label for="editMovie<?=$row["movieID"]?>name" class="form-label">Grade</label>
                          <input type="text" class="form-control" id="editMovie<?=$row["movieID"]?>rating" aria-describedby="editMovie<?=$row["movieID"]?>Help" name="nRating" value="<?=$row['rating']?>">
                          <div id="editMovie<?=$row["movieID"]?>Help" class="form-text">Enter the Movie's rating.</div>
                          <label for="editMovie<?=$row["movieID"]?>name" class="form-label">IMDB Score</label>
                          <input type="text" class="form-control" id="editMovie<?=$row["movieID"]?>rating" aria-describedby="editMovie<?=$row["movieID"]?>Help" name="nIMDBScore" value="<?=$row['imdb_score']?>">
                          <div id="editMovie<?=$row["movieID"]?>Help" class="form-text">Enter the Movie's IMDB Score.</div>
			
			
			</div>
                        <input type="hidden" name="mid" value="<?=$row['movieID']?>">
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
                <input type="hidden" name="mid" value="<?=$row["movieID"]?>" />
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
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMovie">
        Add New
      </button>

      <!-- Modal -->
      <div class="modal fade" id="addMovie" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addMovieLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="addMovieLabel">Add Movie</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post" action="">
                <div class="mb-3">
                 
                  <!--$_POST['nMovieName'],$_POST['nDirector'],$_POST['nReleaseDate'],$_POST['nRating'],$_POST['nIMDBScore'])-->
                  <label for="movie_movieName" class="form-label">Movie Name</label>
                  <input type="text" class="form-control" id="movie_movieName" aria-describedby="nameHelp" name="nMovieName">
                  <div id="nameHelp" class="form-text">Enter the Movie's Name.</div>
                  <label for="movie_director" class="form-label">Director Name</label>
                  <input type="text" class="form-control" id="movie_director" aria-describedby="nameHelp" name="nDirector">
                  <div id="nameHelp" class="form-text">Enter the Movie's Director</div>
                  <label for="movie_ReleaseDate" class="form-label">Release Date</label>
                  <input type="text" class="form-control" id="movie_ReleaseDate" aria-describedby="nameHelp" name="nReleaseDate">
                  <div id="nameHelp" class="form-text">Enter the Movie's Release Date.</div>
                  <label for="movie_rating" class="form-label">Rating</label>
                  <input type="text" class="form-control" id="movie_rating" aria-describedby="nameHelp" name="nRating">
                  <div id="nameHelp" class="form-text">Enter the Movie's Rating.</div>
                   <label for="movie_imdbScore" class="form-label">Grade</label>
                  <input type="text" class="form-control" id="movie_imdbScore" aria-describedby="nameHelp" name="nIMDBScore">
                  <div id="nameHelp" class="form-text">Enter the Movie's IMDB Score.</div>
		  
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
