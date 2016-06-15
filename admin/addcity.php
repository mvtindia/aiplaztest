 <?php include("mainheader.php");include("../connect.php");?>
<body class="sticky-header">
<section>
<?php  session_start(); if(isset($_SESSION["id"]))
{?>
   <?php include("sidebar.php");?>
     <!-- main content start-->
    <div class="main-content" >
 <?php include("header.php");?>
        <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
          <?php 

//add city
if(isset($_REQUEST['addcity']))
          {
              $title=htmlentities($_REQUEST["name"]);
              $latitude=$_REQUEST["latitude"];
              $longitude=$_REQUEST["longitude"];
              $supported_image = array(
                                              'jpg',
                                              'jpeg',
                                              'png',
                                              'gif',
                                            );
                        $filename=$_FILES['file']['name'];
                        $filetmp=$_FILES['file']['tmp_name']; 
                        $filepath="images/".$filename;
                      
                      $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

                      if (in_array($ext, $supported_image))
                         {
                          $query=mysqli_query($connect,'INSERT INTO `city`(`cityname`,`photo`,`latitude`,`longitude`) VALUES ("'.$title.'","'.$filename.'","'.$latitude.'","'.$longitude.'")');
                          move_uploaded_file($filetmp,$filepath);
                           echo '<div class="alert alert-success alert-block fade in">
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <h4>
                                    <i class="icon-ok-sign"></i>
                                    Success!
                                </h4>
                                <p>City Added Successfully</p>
                            </div>';
                          }
                       else
                       {
                            echo '<div class="alert alert-danger alert-block fade in">
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <h4>
                                    <i class="icon-ok-sign"></i>
                                    Error!
                                </h4>
                                <p>Unable to add the city.</p>
                            </div>';
                       }
          }
            
                ?>
                <div class="col-md-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Add City
                          <span class="tools pull-right">
                            <a class="fa fa-chevron-down" href="javascript:;"></a>
                            <a class="fa fa-times" href="javascript:;"></a>
                         </span>
                        </header>
                      
                        <div class="panel-body">
                            <form method="post" class="form-horizontal" enctype="multipart/form-data">
                                <div class="form-group last">
                                    <label class="control-label col-md-3">Add Image</label>
                                    <div class="col-md-9">
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                                <img src="images/no_img.jpg" alt="" style="height: 141px;"/>
                                            </div>
                                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                            <div>
                                                   <span class="btn btn-default btn-file">
                                                   <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                                   <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                                   <input type="file" class="default" name="file" required />
                                                   </span>
                                                <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                                            </div>
                                        </div>
                                        <br/>
                                        <span class="label label-danger ">NOTE!</span>
                                             <span>
                                             Attached image should be jpg,jpeg,gif,png
                                             </span>
                                    </div>
                                </div>

                                <div class="form-group last">
                                     <label class="control-label col-md-3">Name</label>
                                     <div class="col-md-5" class="iconic-input">
                                    <input type="text" name="name" placeholder="City Name" class="form-control" value="" required="required">
                                     
                                    </div>
                                 </div>

                                <div class="form-group last">
                                     <label class="control-label col-md-3">Latitude</label>
                                     <div class="col-md-5" class="iconic-input">
                                    <input type="text" name="latitude" placeholder="Latitude" class="form-control" value="" required="required">
                                     
                                    </div>
                                 </div>


                                <div class="form-group last">
                                     <label class="control-label col-md-3">Longitude</label>
                                     <div class="col-md-5" class="iconic-input">
                                    <input type="text" name="latitude" placeholder="Longitude" class="form-control" value="" required="required">
                                     
                                    </div>
                                 </div>
                                 <div class="form-group last">
                                     <div class="col-md-5" class="iconic-input">
                                         <button class="btn btn-info" type="submit" name="addcity">Add City</button>
                                         <a class="btn btn-warning" type="button" href="city.php">Back</a>
                                    </div>
                                 </div>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <!--body wrapper end-->

     <?php include("footer.php");?>
       <?php
}else{//header("location:login.php");
echo '<script>window.location.href="login.php";</script>';}
  ?>