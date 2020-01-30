<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Upload new video</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- fontawesome icons -->
    <link rel="stylesheet" href="assets/fontawesome-free-5.4.1-web/css/all.css">


    <?php
   include("config.php");
   if(isset($_POST['but_upload'])){
      $maxsize = 2048242880; // 2048MB = 2GB

      $username = $_POST['username'];
      $name = $_FILES['file']['name'];
      $target_dir = "uploads/videos/";
      $target_file = $target_dir . $_FILES["file"]["name"];

      // Select file type
      $videoFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

      // Valid file extensions
      $extensions_arr = array("mp4","avi","3gp","mov","mpeg","mkv","mpg","rm","wmv","3g2","h264");

      // Check extension
      if( in_array($videoFileType,$extensions_arr) ){

         // Check file size
         if(($_FILES['file']['size'] >= $maxsize) || ($_FILES["file"]["size"] == 0)) {
           echo '<div class="alert alert-danger"><center><strong>File too large</strong>. File must be less than 2GB. Check video size and <a href="upload.php">try again</a></div></center>';
         }else{
           // Upload
           if(move_uploaded_file($_FILES['file']['tmp_name'],$target_file)){
             // Insert record
             $query = "INSERT INTO videos(name,location,username) VALUES('".$name."','".$target_file."','".$username."')";

             mysqli_query($con,$query);
             echo '<div class="alert alert-info"><center><strong>Awesome!</strong> , your video was uploaded successfully.</div></center>';
           }
         }

      }else{
        echo '<div class="alert alert-danger"><center><strong>Too bad!</strong> , could not upload video. Please check file format and  <a href="upload.php">try again</a></div></center>';
      }

    }
    ?>


  </head>

  <body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
      <a class="navbar-brand" href="index.php"><img src="assets/images/logo.png" width="60" height="50" alt="Logo"> LAN-Tube </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="index.php"><i class="fas fa-home"></i> Home

              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="sharefiles.php"><i class="fas fa-file"></i> Share files</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="chat.php"><i class="fas fa-comment"></i> Chat</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about.php"><i class="fas fa-book"></i> About</a>
            </li>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="upload.php"><i class="fas fa-upload"></i> Upload</a>
          </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container">
      <center>
        <hr>
        <h2>Upload here</h2>
      </center>
      <hr>

      <br><br>


      <div class="container">
          <div class="row">
              <div class="col-md-8">

                    <h4> <i class="fas fa-upload"></i> Select file to upload below</h4>
                    <hr>

                    <form method="post" action="upload.php" enctype='multipart/form-data'>
                      <label for="username">Enter name:</label>
                      <input id="username" class="form-control" type="text" placeholder="Your name..." name="username" required><br/>
                      <input class="form-control" type='file' name='file' />
                      <hr>
                      <input class="btn btn-primary" type='submit' value='Upload' name='but_upload'>
                  </form>
                    <hr>
              </div>
          </div>
      </div>

      <p><strong>Supported Video file formats:</strong> <span class="badge badge-primary">mp4</span> <span class="badge badge-primary">avi</span> <span class="badge badge-primary">3gp</span> <span class="badge badge-primary">mov</span> <span class="badge badge-primary">mpeg</span> <span class="badge badge-primary">mkv</span>
        <span class="badge badge-primary"> mpg</span>  <span class="badge badge-primary">rm</span>  <span class="badge badge-primary">wmv</span>  <span class="badge badge-primary">3g2</span>  <span class="badge badge-primary">h264</span>.  Suggest more file formats <a href="#">here</a> </p>

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; LAN Tube 2018</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
