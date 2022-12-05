<!doctype html>
<?php include("nav.php");?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Plot</title>
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
      $sqlAdd = "insert into plot (movieName,trailer,plot) value (?,?,?)";
      $stmtAdd = $conn->prepare($sqlAdd);
      $stmtAdd->bind_param("sss", $_POST['nMovieName'],$_POST['nTrailer'],$_POST['nPlot']);
      $stmtAdd->execute();
      echo '<div class="alert alert-success" role="alert">New Plot added.</div>';
      break;
    case 'Edit':
      $sqlEdit = "update plot set  movieName=?,trailer=?,plot=? where plotID=?";
      $stmtEdit = $conn->prepare($sqlEdit);
      $stmtEdit->bind_param("sssi", $_POST['nMovieName'],$_POST['nTrailer'],$_POST['nPlot'],$_POST[‘pid’]);
      $stmtEdit->execute();
      echo '<div class="alert alert-success" role="alert">Plot edited.</div>';
      break;
    case 'Delete':
      $sqlDelete = "delete from plot where plotID=?";
      $stmtDelete = $conn->prepare($sqlDelete);
      $stmtDelete->bind_param("i", $_POST['mid']);
      $stmtDelete->execute();
      echo '<div class="alert alert-success" role="alert">Plot deleted.</div>';
      break;
  }
}
?>
    
     <h1>Plot</h1>
<table class="table table-striped">
  <thead>
    <tr>
      <th>PlotID</th>
            <th>Movie Name</th>
            <th>Trailer</th>
           <th>Plot</th>
           
     
    </tr>
  </thead>
  <tbody>
          
<?php
$sql = "SELECT * from plot";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
          
          <tr>
           <td><?=$row["plotID"]?></td>
    <td><?=$row["movieName"]?></td>
    <td>
      <a href="<?=$row["trailer"]?>" target="_blank" class="btn btn-primary btn-lg" role="button" aria-disabled="true">Watch</a>
    </td>
    <td><?=$row["plot"]?></td>            
<td>
           <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editPlot<?=$row["plotID"]?>">
                Edit
              </button>
              <div class="modal fade" id="editPlot<?=$row["plotID"]?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editPlot<?=$row["plotID"]?>Label" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="editPlot<?=$row["plotID"]?>Label">Edit Plot</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="">
                        <div class="mb-3">
                          <label for="editPlot<?=$row["plotID"]?>name" class="form-label">Movie Name</label>
                          <input type="text" class="form-control" id="editPlot<?=$row["plotID"]?>plotID" aria-describedby="editPlot<?=$row["plotID"]?>Help" name="nMovieName" value="<?=$row['movieName']?>">
                          <div id="editPlot<?=$row["plotID"]?>Help" class="form-text">Enter the Movie's name.</div>
                         <label for="editPlot<?=$row["plotID"]?>name" class="form-label">Trailer</label>
                          <input type="text" class="form-control" id="editPlot<?=$row["plotID"]?>director" aria-describedby="editPlot<?=$row["plotID"]?>Help" name="nTrailer" value="<?=$row['trailer']?>">
                          <div id="editPlot<?=$row["plotID"]?>Help" class="form-text">Enter the Trailer's Link.</div>
                          <label for="editPlot<?=$row["plotID"]?>name" class="form-label">Plot</label>
                          <input type="text" class="form-control" id="editPlot<?=$row["plotID"]?>releaseDate" aria-describedby="editPlot<?=$row["plotID"]?>Help" name="nPlot" value="<?=$row['plot']?>">
                          <div id="editPlot<?=$row["plotID"]?>Help" class="form-text">Enter the Movie's Plot.</div>
                          
			
			
			</div>
                        <input type="hidden" name="pid" value="<?=$row['plotID']?>">
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
                <input type="hidden" name="pid" value="<?=$row["plotID"]?>" />
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
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPlot">
        Add New
      </button>

      <!-- Modal -->
      <div class="modal fade" id="addPlot" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addMovieLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="addMovieLabel">Add Plot</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post" action="">
                <div class="mb-3">
                 
                 
                  <label for="plot_movieName" class="form-label">Movie Name</label>
                  <input type="text" class="form-control" id="plot_movieName" aria-describedby="nameHelp" name="nMovieName">
                  <div id="nameHelp" class="form-text">Enter the Movie's Name.</div>
                  <label for="plot_trailer" class="form-label">Trailer</label>
                  <input type="text" class="form-control" id="plot_trailer" aria-describedby="nameHelp" name="nTrailer">
                  <div id="nameHelp" class="form-text">Enter the Trailer Link</div>
                  <label for="plot" class="form-label">Plot</label>
                  <input type="text" class="form-control" id="plot" aria-describedby="nameHelp" name="nReleaseDate">
                  <div id="nameHelp" class="form-text">Enter the Movie's Release Date.</div>
                  
		  
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
