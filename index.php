<!doctype html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include("nav.php");?>
    <title>Courses</title>
    <link rel="stylesheet" href="home.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>

 $servername = "localhost";
$username = "landryou_user";
$password = "A2kYbmhiMHTE";
$dbname = "landryou_project_data";
 
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

  <body>
     
 <div class="container">
  <div class="description" style="text-align:center; font-family:Dubai; color:black;">
  <h1 class="display-4">Welcome to MovieTracker </h1>
 <p class="description">Through the use of this site, users will be able to input personally watched movies to keep a personalized catalog of the movies they have watched.</p>
  <hr class="my-4">
   
  <p class="description">Use the following buttons to begin using the website!</p>
  <p class="lead">
     <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMovie">
        Input Movie Details
      </button>
     <a class="btn btn-primary btn-lg" href="reviews.php" role="button">Write a Review</a>
     <a class="btn btn-primary btn-lg" href="plot.php" role="button">Leave a Plot Summary</a>
  </p>
</div>
   <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="https://ntvb.tmsimg.com/assets/p12386480_v_h10_az.jpg?w=1280&h=720" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="https://reporter.rit.edu:8443/sites/pubDir/slideShow/04-15/85-1033-168352016.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="https://cdn.prime1studio.com/media/catalog/product/cache/1/image/1400x1400/17f82f742ffe127f42dca9de82fb58b1/h/d/hdmmdc-02_a19.jpg" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
</div>
  </body>
  
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
                   <label for="movie_imdbScore" class="form-label">Enter IMDB Score</label>
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
  
  
  
  
  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
