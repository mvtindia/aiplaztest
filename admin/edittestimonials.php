<?php include("../connect.php"); include("mainheader.php");?>
<body class="sticky-header">
<section>
   <?php include("sidebar.php");?>
     <!-- main content start-->
    <div class="main-content" >
 <?php include("header.php");?>
        <!--body wrapper start-->
        <!--body wrapper start-->
       
        <div class="wrapper">
        <div class="row">
          <?php 

if(isset($_REQUEST['uptest']))
          {
            $tid = $_REQUEST['tid'];
           $tname = $_REQUEST['tname'];
           $tcontent = $_REQUEST['tcontent'];

           $target_file=$_FILES['fileupload']['name'];
           if(!empty($target_file)){
            $query=mysqli_query($connect,"UPDATE `testimonials` SET `tname`='".$tname."',`tcontent`='".$tcontent."',`timage`='".$target_file."' where tid='".$tid."'");
            $path="../images/testimonials/".$target_file;
            move_uploaded_file ($_FILES['fileupload']['tmp_name'],$path);

            if($query)
            {
               echo '<div class="alert alert-success alert-block fade in">
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <h4>
                                    <i class="icon-ok-sign"></i>
                                    Success!
                                </h4>
                                <p>Testimonial updated successfully.</p>
                            </div>';
                            echo '<script>window.location.href="testimonials.php";</script>';
            }
            else{
               echo '<div class="alert alert-danger alert-block fade in">
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <h4>
                                    <i class="icon-ok-sign"></i>
                                    Failure!
                                </h4>
                                <p>Unable to edit the Testimonial.</p>
                            </div>';
            }
          }//!empty
          else{
            $query=mysqli_query($connect,"UPDATE `testimonials` SET `tname`='".$tname."',`tcontent`='".$tcontent."' where tid='".$tid."'");
            if($query)
            {
               echo '<div class="alert alert-success alert-block fade in">
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <h4>
                                    <i class="icon-ok-sign"></i>
                                    Success!
                                </h4>
                                <p>Testimonial updated successfully.</p>
                            </div>';
                            echo '<script>window.location.href="testimonials.php";</script>';
            }
            else{
               echo '<div class="alert alert-danger alert-block fade in">
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <h4>
                                    <i class="icon-ok-sign"></i>
                                    Failure!
                                </h4>
                                <p>Unable to edit the Testimonial.</p>
                            </div>';
            }
          }
          }//isset
             
                            ?>
                            <style type="text/css">
                            .hello input 
                            {
                              width:700px;
                            }
                             .hello textarea 
                            {
                              width:700px;
                            }
                            </style>
        <div class="col-sm-12 hello">
        <section class="panel">
        <header class="panel-heading">
          Edit Testimonial 
            <span class="tools pull-right">
                <a href="javascript:;" class="fa fa-chevron-down"></a>
                <a href="javascript:;" class="fa fa-times"></a>
             </span>
        </header>
        <div class="panel-body">
        <div class="adv-table">
      
  <?php
        $id=$_GET["teditid"];
        $query=mysqli_query($connect,'SELECT * FROM `testimonials` where tid="'.$id.'"');
        $row=mysqli_fetch_array($query);
        //$path="../img/testimonials/".$row['timage'];
        
     ?>
   
  <form action="edittestimonials.php" method="post" class="form-horizontal" enctype="multipart/form-data">
                              <div class="form-group last">
                                    <label class="control-label col-md-3">Upload Testimonial Image</label>
                                    <div class="col-md-9 hidepic">
                                       
                                                <img src="<?php echo "../images/testimonials/".$row["timage"]; ?>" alt="" style="height: 141px;"/>
                                           
                                         <div class="editpic"> <a class="btn btn-info ">Edit</a></div>
                               
                                    </div>
                                    <div class="col-md-9 dispic" style="display:none;">   
                                    <div class="col-md-5" class="iconic-input" >
                    <input id="input-1" name="fileupload" value="<?php echo "../images/testimonials/".$row['timage']; ?>" type="file" class="file file-loading" data-allowed-file-extensions='["png", "gif", "jpg", "jpeg"]'>
                                 </div> </div>
                                </div>
                                <div class="form-group last">
                                <label class="control-label col-md-3">Name</label>
                                <div class="col-md-8" class="iconic-input">
                                <input name="tname" class="form-control" required="required" value="<?php echo $row["tname"];?>">
                                </div>
                            </div>
                            <div class="form-group last">
                                <label class="control-label col-md-3">Content</label>
                                <div class="col-md-8" class="iconic-input">
                                <textarea name="tcontent" style="width:100%" rows="20" class="form-control ckeditor" required="required"><?php echo $row["tcontent"];?></textarea>
                                </div>
                            </div>
                             <input type="hidden" name="tid" class="form-control" value="<?php echo $id;?>" required="required">
                              
                                 <div class="form-group last">
                                     <div class="col-md-5" class="iconic-input">
                                         <button class="btn btn-info" type="submit" name="uptest">Update Content</button>
                                    </div>
                                 </div>
                            </form>
        </div>
        </div>
        </section>
        </div>
        </div>
        </div>
        <!--body wrapper end-->
     <?php include("footer.php");?>