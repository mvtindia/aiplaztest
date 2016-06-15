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
if(isset($_REQUEST['addtest']))
          { 
            $target_file=basename($_FILES['fileupload']['name']);
            //$target_file=$_FILES['fileupload']['name'];
            $tname = htmlentities($_REQUEST['tname']);
            $content = htmlentities($_REQUEST['content']);
            $query=mysqli_query($connect,'INSERT INTO `testimonials`(`tname`, `tcontent`,`timage`) VALUES("'.$tname.'","'.$content.'","'.$target_file.'")');
            $path="../img/testimonials/".$target_file;
            move_uploaded_file ($_FILES['fileupload']['tmp_name'],$path);
            if($query>0)
            {
               echo '<div class="alert alert-success alert-block fade in">
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <h4>
                                    <i class="icon-ok-sign"></i>
                                    Success!
                                </h4>
                                <p>Testimonial added successfully.</p>
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
                                <p>Unable to add the testimonial.</p>
                            </div>';
            }
          }

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
          Add Testimonial 
            <span class="tools pull-right">
                <a href="javascript:;" class="fa fa-chevron-down"></a>
                <a href="javascript:;" class="fa fa-times"></a>
             </span>
        </header>
        <div class="panel-body">
        <div class="adv-table">
  
  <form action="addtestimonials.php" method="post" class="form-horizontal" enctype="multipart/form-data">
                              <div class="form-group last">
                                    <label class="control-label col-md-3">Upload Testimonial Image</label>
                                    <div class="col-md-9">
                                        
                                <div class="col-md-5" class="iconic-input">
                                <input id="input-1" name="fileupload" type="file" class="file file-loading" data-allowed-file-extensions='["png", "gif", "jpg", "jpeg"]'>
                                </div>
                                       <!--  <br/>
                                        <span class="label label-danger ">NOTE!</span>
                                             <span>
                                             Attached image should be jpg,jpeg,gif,png
                                             </span> -->
                                    </div>
                                </div>
                                <div class="form-group last">
                                <label class="control-label col-md-3">Name</label>
                                <div class="col-md-5" class="iconic-input">
                                <input type="text" name="tname" class="form-control" required="required">
                                </div>
                            </div>

                            <div class="form-group last">
                                <label class="control-label col-md-3">Content</label>
                                <div class="col-md-8" class="iconic-input">
                                <textarea name="content" style="width:100%" rows="20" class="form-control ckeditor" required="required"></textarea>
                                </div>
                            </div>
                             <input type="hidden" name="cid" class="form-control" value="" required="required">
                              
                                 <div class="form-group last">
                                     <div class="col-md-5" class="iconic-input">
                                         <button class="btn btn-info" type="submit" name="addtest">Add</button>
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