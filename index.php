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

 

  <body>
     
 <div class="container">
  <div class="description" style="text-align:center; font-family:Dubai; color:black;">
  <h1 class="display-4">Welcome to MovieTracker </h1>
 <p class="description">Through the use of this site, users will be able to input personally watched movies to keep a personalized catalog of the movies they have watched.</p>
  <hr class="my-4">
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
  <p class="description">Use the following buttons to begin using the website!</p>
  <p class="lead">
     <a class="btn btn-primary btn-lg" href="movies.php" role="button">Input Movie Details</a>
     <a class="btn btn-primary btn-lg" href="reviews.php" role="button">Write a Review</a>
     <a class="btn btn-primary btn-lg" href="plot.php" role="button">Leave a Plot Summary</a>

  </p>
</div>
</div>
  </body>
  
  
  
  
  
  
  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
