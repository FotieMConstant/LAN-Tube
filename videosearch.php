<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Search results</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- fontawesome icons -->
    <link rel="stylesheet" href="assets/fontawesome-free-5.4.1-web/css/all.css">

    <style media="screen">
      center{
        margin-top: 2%;
        margin-bottom: 5%;
      }
    </style>



  </head>

  <body>

    <!-- Navigation -->
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
      <a class="navbar-brand" href="index.php"><img src="assets/images/logo.png" width="60" height="50" alt="Logo"> LAN-Tube </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">


              <form class="form-inline" action="videosearch.php" method="POST">
                    <input name="filename" class="form-control mr-sm-2" type="text" placeholder="Search video...">
                    <button class="btn btn-primary" type="submit"> <i class="fas fa-search"></i> </button>
              </form>

              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


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
          <li class="nav-item">
            <a class="nav-link" href="upload.php"><i class="fas fa-upload"></i> Upload</a>
          </li>
          </ul>
        </div>
      </div>
    </nav>


    <!-- Page Content -->
    <div class="container">
      <hr>
      <center>
        <h2>Search results</h2>
        <p>If nothing shows up below it means your search did not match any video file on LAN Tube</p>
      </center>
      <hr>



          <?php
          include ("config.php");


          // php code to search data in mysql database and display!

          if (!empty($_POST['filename'])) {
            // file name to search!
            $filename = $_POST['filename'];
            // code is executed when the file is found in the database...

            $fetchsearch = mysqli_query($con, "SELECT id, name, username, location FROM videos WHERE name LIKE '%$filename%' ORDER BY name DESC");


              // loop and display results...
              while($row = mysqli_fetch_assoc($fetchsearch)){

                $location = $row['location'];
                $name_of_file = $row['name'];
                $display_username = $row['username'];
                $id = $row['id'];

                echo "<center>";
                echo '<a href="index.php?view?v='.$id.'">';
                echo $name_of_file."<br><br>";
                  echo '<div class="wrap">';
                    echo "<video class='img-fluid' src='".$location."' controls width='330px' height='330px' >";
                  echo '</div>';
                  echo '<small class="text-muted">Uploaded by <i class="fas fa-user"></i> <strong>'.$display_username.'</strong></small>';
                echo '</a>';
                echo "</center>";
                echo "<hr>";


              }


          }else {
            // code...
            echo '<div class="alert alert-danger"><center><strong>Please!</strong> , Enter video name to be searched <a href="#"title="Direct search" data-toggle="modal" data-target="#searchModal" >try again</a></div></center>';
          }

      ?>






                  <!-- Modal for quick upload video -->
                  <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="searchModalLabel">Direct search</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">


                          <div class="container">
                              <div class="row">
                                  <div class="col-md-8">

                                        <h6> <i class="fas fa-upload"></i> Please enter any word coresponding to the video you are Looking for!</h6>
                                        <hr>

                                        <form class="form-inline" action="videosearch.php" method="POST">
                                          <input name="filename" class="form-control mr-sm-2" type="text" placeholder="Search videos...">
                                          <button class="btn btn-primary" type="submit"> <i class="fas fa-search"></i> </button>
                                        </form>
                                        <hr>
                                  </div>
                              </div>
                          </div>


                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>




    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; LAN Tube 2018 - <?php echo date("Y"); ?>.</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
