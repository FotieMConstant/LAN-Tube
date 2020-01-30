<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Share files here</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- fontawesome icons -->
    <link rel="stylesheet" href="assets/fontawesome-free-5.4.1-web/css/all.css">




        <?php
       include("config.php");
       if(isset($_POST['uploadfile'])){
          $maxfilesize = 2048242880; // 2048MB = 2GB

          $uploader_name = $_POST['uploader_name'];
          $name_of_file = $_FILES['file']['name'];
          $file_dir = "uploads/uploaded_files/";
          $the_target_file = $file_dir . $_FILES["file"]["name"];

          // Select file type
          $FileType = strtolower(pathinfo($the_target_file,PATHINFO_EXTENSION));

          // Valid file extensions
          $extensions_array = array("pdf","png","jpg","jpeg","exe","zip","docx","iso","doc","txt","wpd","tar","sql","mp3","wav","apk","jar","py","js","html","htm","css","php","ppt","xlsx","xls","msi","rtf","wps","wpd","wks","jpg","rar");

          // Check extension
          if( in_array($FileType,$extensions_array) ){

             // Check file size
             if(($_FILES['file']['size'] >= $maxfilesize) || ($_FILES["file"]["size"] == 0)) {
               echo "File too large. File must be less than 2GB.";
             }else{
               // Upload
               if(move_uploaded_file($_FILES['file']['tmp_name'],$the_target_file)){
                 // Insert record
                 $queryfile = "INSERT INTO files(name,location,username) VALUES('".$name_of_file."','".$the_target_file."','".$uploader_name."')";

                 mysqli_query($con,$queryfile);
                 echo '<div class="alert alert-info"><center><strong>Awesome!</strong> , your file was uploaded successfully.</div></center>';
               }
             }

          }else{
            echo '<div class="alert alert-danger"><center><strong>Too bad!</strong> , could not upload file. Please check file format and  <a href="sharefiles.php">try again</a></div></center>';
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
            <li class="nav-item active">
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
        <h2>Share files</h2>
        <h6><a href="#" title="Click here to upload new file" data-toggle="modal" data-target="#uploadfileModal">Click here<a> to upload new file</h6>
      </center>
      <hr>

      <style media="screen">

      .row-section{
        width:100%; /* fallback for old browsers */

      }
      .row-section h2{
        float:left;
        width:100%;
        color:#fff;
        margin-bottom:30px;
        font-size: 14px;
      }
      .row-section h2 span{
        font-family: 'Libre Baskerville', serif;
        display:block;
        font-size:45px;
        text-transform:none;
        margin-bottom:20px;
        margin-top:30px;
        font-weight:700;
      }
      .row-section h2 a{
        color:#d2abce;
      }
      .row-section .row-block{
        background:#fff;
        padding:20px;
        margin-bottom:50px;
      }
      .row-section .row-block ul{
      margin:0;
      padding:0;
      }
      .row-section .row-block ul li{
        list-style:none;
        margin-bottom:20px;
      }
      .row-section .row-block ul li:last-child{
        margin-bottom:0;
      }
      .row-section .row-block ul li:hover{
        cursor:grabbing;
      }
      .row-section .row-block .media{
        border:1px
        solid #d5dbdd;
        padding:5px 20px;
        border-radius: 5px;
        box-shadow:0px 2px 1px rgba(0,0,0,0.04);
        background:#fff;
        word-wrap: break-word;
      }
      .row-section .media .media-left img{
        width:75px;
        margin: 10px;
      }
      .row-section .media .media-body p{
        padding: 0 15px;
        font-size: 100%;
        transition: 1s;

      }

      @media (max-width: 412px) {
          .row-section .media .media-body p{
            font-size: 60%;
            transition: 1s;

          }
      }
      .row-section .media .media-body h4 {
        color: #007bff;
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 0;
        padding-left: 14px;
        margin-top:30px;
      }
      .btn-default{
        background:#007bff;
        color:#fff;
        border-radius:30px;
        border:none;
        font-size:16px;
        margin-bottom: 15px;
        transition: 1s;

      }

      @media (max-width: 412px) {
        .btn-default{
            font-size:10px;
            transition: 1s;

          }
      }

      </style>

      <section class="row-section">
          <div class="container">
            <div class="row">
            </div>
            <div class="col-md-10 offset-md-1 row-block">
                <ul id="sortable">
      <?php

      $nub_of_files = 0;
      $fetchfiles = mysqli_query($con, "SELECT location, name, username FROM files ORDER BY id DESC");
      while($row = mysqli_fetch_assoc($fetchfiles)){
        $nub_of_files++;
        $location = $row['location'];
        $name_of_file = $row['name'];
        $display_username = $row['username'];

        echo '

                      <li>
                        <div class="media">
                            <div class="media-left align-self-center">
                                <img class="rounded-circle" src="assets/images/avatar.png">
                            </div>
                            <div class="media-body">
                                <h4>'.$display_username.'</h4>
                                <p>'.$name_of_file.'</p>
                                  <a href="'.$location.'" target="_BLANK" class="btn btn-default" download>Download</a>
                            </div>
                        </div>
                    </li>


        ';

      }

      if ($nub_of_files == 0) {
        echo '<h3><font color="red"><strong><i>No file was added yet!</i></strong></font></h3>';
      }
      ?>



    </ul>
</div>
</div>
</section>






      <?php
      echo "<h4>Total files: <strong>".$nub_of_files."</strong></h4>";
      ?>





                  <!-- Modal for quick upload video -->
                  <div class="modal fade" id="uploadfileModal" tabindex="-1" role="dialog" aria-labelledby="uploadfileModal" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="uploadfileModal">Upload new File</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">


                          <div class="container">
                              <div class="row">
                                  <div class="col-md-8">

                                    <div class="col-sm-12">

                                      <h5><strong>Select your file below!</strong></h5>

                                      <form method="POST" action="sharefiles.php" enctype='multipart/form-data'>
                                          <input class="form-control" type="text" name="uploader_name" placeholder="Enter you name..." required>
                                              <div class="form-group files">
                                                <label>Upload Your File </label>
                                                <input type="file" name="file" class="form-control" multiple="" required>
                                              </div>
                                              <button class="btn btn-primary" type="submit" name="uploadfile">Upload file</button>
                                      </form>

                                    </div>


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
