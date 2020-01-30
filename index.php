<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>LAN Tube</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- fontawesome icons -->
    <link rel="stylesheet" href="assets/fontawesome-free-5.4.1-web/css/all.css">

  <!-- php for uploading video with modal -->
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
               echo "File too large. File must be less than 2GB.";
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


        <!-- php for playing video with video id -->

    <?php
    include('config.php');


      if (isset($_GET['view?v'])) {

        $viewID = $_GET['view?v'];
        // Fetching value in database
        $view_query = mysqli_query($con, "SELECT location, username, name FROM videos WHERE id = $viewID");
        $view_value = mysqli_fetch_assoc($view_query);


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

            <form class="form-inline" action="videosearch.php" method="POST">
              <input name="filename" class="form-control mr-sm-2" type="text" placeholder="Search video...">
              <button class="btn btn-primary" type="submit"> <i class="fas fa-search"></i> </button>
            </form>

            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <li class="nav-item active">
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

      <!-- Video Item Heading -->
      <h2 class="my-4">Now streaming...</h2>

      <!-- Video Item Row -->
      <div class="row">

        <div class="col-md-8">
          <?php

          // Selected video will be displayed if the variable is not empty!
          if(!empty($view_value['location'])){
          echo "<video class='img-thumbnail' src='".$view_value['location']."' width='730px' height='730px' controls autoplay>";
        } else {
          // Default image displayed when video not selected!
          echo "<img class='img-thumbnail' src='assets/images/PlayLANTube.jpg' width='730px' height='420px' title='Select video to play here!'>";
        }
           ?>
        </div>

        <div class="col-md-4">
          <h4 class="my-3">Video Description</h4>
          <p>This video was uploaded by
            <?php
            if (!empty($view_value['username'])) {
              // The field normally is displayed if the variable is not Empty!
              echo '<strong><font color="#007bff"><i class="fas fa-user"></i> '.$view_value['username'].'</font></strong>. You can send a message to say thanks. Just <a href="chat.php">click here <i clas"fas fa-chat"></i></a>';
            }else {
              //The default message to be desplayed when the field is empty!
              echo '<strong><font color="#007bff"><i class="fas fa-user"></i> You will see user name here!</font></strong>';
            }
            ?>
          </p>
          <h3 class="my-3">More</h3>
            <p>This content can be viewed
              online here on <strong>LAN Tube</strong> or downloaded offline to be watched later.</p>
            <hr>
            <p>Having a video to upload?</p>
            <p>Click <a href="index.php" title="Click here to upload new content" data-toggle="modal" data-target="#exampleModal">here <i class="fas fa-upload"></i></a> to upload a new video </p>
        </div>
        <div class="sub_video">
          <hr>
              <small>

                <?php
                if (!empty($view_value['name'])) {
                  // The field normally is displayed if the variable is not Empty!
                  echo '<strong><font color="#007bff"><h6><i class="fas fa-play"></i> '.$view_value['name'].'</h6></font></strong>';
                }else {
                  //The default message to be desplayed when the field is empty!
                  echo '<strong><font color="#007bff"><h6><i class="fas fa-play"></i> Video title will be seen here!</h6></font></strong>';
                }

                ?>

              </small><br>
              <span>

                  <?php
                  if (!empty($view_value['username'])) {
                    // The field normally is displayed if the variable is not Empty!
                    echo '<strong><i class="fas fa-bell"></i> <i>'.$view_value['username']."</i></strong> uploaded a new video!";
                  }else {
                    //The default message to be desplayed when the field is empty!
                    echo '<strong><font color="#007bff"><h6><i class="fas fa-bell"></i> Notification here!</h6></font></strong>';
                  }

                  ?>


            </span>
          <hr>
          <?php
            if (!empty($view_value['location'])) {
              // Display the Download button if the variable is not empty!
              echo '<a class="btn btn-primary" href="'.$view_value["location"].'" title="Download this content" download>Download</a>';
            }
            // In this case there is no need for an else statement because there is nothing to be downloaded!
          ?>

        </div>
      </div>
      <!-- /.row -->

      <!-- Recent vides Row -->
      <h3 class="my-4">Recently uploaded</h3>
        <style media="screen">
          .container_wrap{
            min-height: 100px;
            overflow: hidden;
            transition: 1s;
          }
          .wrap{
            float: left;
            margin-bottom: 5%;
            margin-left: 5%;
            transition: 1s;
          }

          .text-muted{
            float: left;
            margin-top: 136px;
            margin-left: -230px;

          }

        </style>

        <div class="container_wrap">
        <?php
          include("config.php");

          $nub_of_vid = 0;
          $fetchVideos = mysqli_query($con, "SELECT id, location, name, username FROM videos ORDER BY id DESC");
          while($row = mysqli_fetch_assoc($fetchVideos)){
            $nub_of_vid++;
            $location = $row['location'];
            $name_of_file = $row['name'];
            $display_username = $row['username'];
            $id = $row['id'];


            echo '<a href="index.php?view?v='.$id.'">';
              echo '<div class="wrap">';
                echo "<video class='img-fluid' src='".$location."' controls width='230px' height='230px' >";
              echo '</div>';
              echo '<small class="text-muted">Uploaded by <i class="fas fa-user"></i> <strong>'.$display_username.'</strong></small>';
            echo '</a>';



          }

        ?>

<center>
        <?php
            if ($nub_of_vid == 0) {
              echo '<h6><i><strong>No content yet, </strong> <a href="index.php" title="Quick add new content" data-toggle="modal" data-target="#exampleModal"> Click here</a> upload new video!</i></h6>';
            }
         ?>
</center>
      </div>



            <div class="alert alert-info">
              <center><strong>Hey!</strong> You're all caught up!<br>
                You've seen all <?php echo $nub_of_vid; ?> post(s) from the past days.
              <center>
            </div>




            <!-- Modal for quick upload video -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload new video</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">


                    <div class="container">
                        <div class="row">
                            <div class="col-md-8">

                                  <h4> <i class="fas fa-upload"></i> Select file to upload below</h4>
                                  <hr>

                                  <form method="post" action="index.php" enctype='multipart/form-data'>
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
        <p class="m-0 text-center text-white">Copyright &copy; LAN Tube 2018</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
