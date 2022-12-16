
<!doctype html>
<?php include("nav.php");?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reviews</title>
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

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  switch ($_POST['saveType']) {
    case 'Add':
      $sqlAdd = "insert into reviews (movieName,DateWatched,personalRating,review) value (?,?,?,?)";
      $stmtAdd = $conn->prepare($sqlAdd);
      $stmtAdd->bind_param("ssss", $_POST['nMovieName'],$_POST['nDateWatched'],$_POST['npersonalRating'],$_POST['nReview']);
      $stmtAdd->execute();
      echo '<div class="alert alert-success" role="alert">New Review added.</div>';
      break;
    case 'Edit':
      $sqlEdit = "update reviews set  movieName=?,DateWatched=?,personalRating=?,review=? where reviewID=?";
      $stmtEdit = $conn->prepare($sqlEdit);
      $stmtEdit->bind_param("ssssi", $_POST['nMovieName'],$_POST['nDateWatched'],$_POST['npersonalRating'],$_POST['nReview'],$_POST['rid']);
      $stmtEdit->execute();
      echo '<div class="alert alert-success" role="alert">Review edited.</div>';
      break;
    case 'Delete':
      $sqlDelete = "delete from reviews where reviewID=?";
      $stmtDelete = $conn->prepare($sqlDelete);
      $stmtDelete->bind_param("i", $_POST['rid']);
      $stmtDelete->execute();
      echo '<div class="alert alert-success" role="alert">Review deleted.</div>';
      break;
  }
}
?>
    
     <h1>Reviews</h1>
<table class="table table-hover">
  <thead>
    <tr>
      <th>ReviewID</th>
            <th>Movie Name</th>
            <th>Date Watched</th>
           <th>Personal Rating</th>
            <th>Review</th>   
    </tr>
  </thead>
  <tbody>
          
<?php
$sql = "SELECT * from reviews";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
          
          <tr>
           <td><?=$row["reviewID"]?></td>
   <td><?=$row["movieName"]?></td>
   <td><?=$row["DateWatched"]?></td>
    <td><?=$row["personalRating"]?></td>
    <td><?=$row["review"]?></td>
    
            <td>
              <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editReview<?=$row["reviewID"]?>">
                Edit
              </button>
              <div class="modal fade" id="editReview<?=$row["reviewID"]?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editReview<?=$row["reviewID"]?>Label" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="editReview<?=$row["reviewID"]?>Label">Edit Review</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="">
                        <div class="mb-3">
                          <label for="editReview<?=$row["reviewID"]?>name" class="form-label">Movie Name</label>
                          <input type="text" class="form-control" id="editReview<?=$row["reviewID"]?>reviewID" aria-describedby="editReview<?=$row["reviewID"]?>Help" name="nMovieName" value="<?=$row['movieName']?>">
                          <div id="editReview<?=$row["reviewID"]?>Help" class="form-text">Enter the Movie's name.</div>
                         <label for="editReview<?=$row["reviewID"]?>name" class="form-label">Date Watched</label>
                          <input type="text" class="form-control" id="editReview<?=$row["reviewID"]?>director" aria-describedby="editReview<?=$row["reviewID"]?>Help" name="nDateWatched" value="<?=$row['DateWatched']?>">
                          <div id="editReview<?=$row["reviewID"]?>Help" class="form-text">Enter Watch Date.(yyyy-mm-dd)</div>
                          <label for="editReview<?=$row["reviewID"]?>name" class="form-label">Personal Rating</label>
                          <input type="text" class="form-control" id="editReview<?=$row["reviewID"]?>releaseDate" aria-describedby="editReview<?=$row["reviewID"]?>Help" name="nersonalRating" value="<?=$row['personalRating']?>">
                          <div id="editReview<?=$row["reviewID"]?>Help" class="form-text">Enter Personal Rating (Out of 10)</div>
                           <label for="editReview<?=$row["reviewID"]?>name" class="form-label">Review</label>
                          <input type="text" class="form-control" id="editReview<?=$row["reviewID"]?>rating" aria-describedby="editReview<?=$row["reviewID"]?>Help" name="nReview" value="<?=$row['review']?>">
                          <div id="editReview<?=$row["reviewID"]?>Help" class="form-text">Write a review</div>
                          
			
			</div>
                        <input type="hidden" name="rid" value="<?=$row['reviewID']?>">
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
                <input type="hidden" name="rid" value="<?=$row["reviewID"]?>" />
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
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addReview">
        Add New
      </button>

      <!-- Modal -->
      <div class="modal fade" id="addReview" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addReviewLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="addReviewLabel">Add Movie</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post" action="">
                <div class="mb-3">
                 
                 
                  <label for="movie_movieName" class="form-label">Movie Name</label>
                  <input type="text" class="form-control" id="movie_movieName" aria-describedby="nameHelp" name="nMovieName">
                  <div id="nameHelp" class="form-text">Enter the Movie's Name.</div>
                  <label for="movie_DateWatched" class="form-label">Watch Date</label>
                  <input type="text" class="form-control" id="movie_director" aria-describedby="nameHelp" name="nDateWatched">
                  <div id="nameHelp" class="form-text">Enter Date Watched</div>
                  <label for="movie_PersonalRating" class="form-label">Personal Rating</label>
                  <input type="text" class="form-control" id="movie_ReleaseDate" aria-describedby="nameHelp" name="npersonalRating">
                  <div id="nameHelp" class="form-text">Enter Personal Rating (Out of 10)</div>
                  <label for="movie_Review" class="form-label">Review</label>
                  <input type="text" class="form-control" id="movie_rating" aria-describedby="nameHelp" name="nReview">
                  <div id="nameHelp" class="form-text">Write a review.</div>
                   
		  
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
