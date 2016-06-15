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
           if(isset($_REQUEST['upwhovr']))
          {
            $content = $_REQUEST['content'];
            $image = $_FILES['file']['name'];
            $tmp = $_FILES['file']['tmp_name'];
            $path="../images/testimonials/".$image;
            if(!empty($image)){
            move_uploaded_file($tmp,$path);
            $query=mysqli_query($connection,"UPDATE `whovr` SET `wcontent`='".$content."',`wimage`='".$image."' ");
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
                                <p>Data updated successfully.</p>
                            </div>';
               }
               else
               {
                echo '<div class="alert alert-block alert-danger fade in">
                               <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <h4>
                                    <i class="icon-ok-sign"></i>
                                    Success!
                                </h4>
                                <p> wrong file extension.</p>
                            </div>';
               } 
               }
               else{
                $query=mysqli_query($connection,"UPDATE `whovr` SET `wcontent`='".$content."'");
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
                                <p>Data updated successfully.</p>
                            </div>';
               }
               else
               {
                echo '<div class="alert alert-block alert-danger fade in">
                               <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <h4>
                                    <i class="icon-ok-sign"></i>
                                    Success!
                                </h4>
                                <p> wrong file extension.</p>
                            </div>';
               } 
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
          Edit Who We Are 
            <span class="tools pull-right">
                <a href="javascript:;" class="fa fa-chevron-down"></a>
                <a href="javascript:;" class="fa fa-times"></a>
             </span>
        </header>
        <div class="panel-body">
        <div class="adv-table">
      
  <?php
        $id=$_GET["id"];
        $query=mysqli_query($connection,'SELECT * FROM `whovr`');
        $row=mysqli_fetch_array($query);
        
     ?>
   
  <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                                   <div class="form-group last">
                                    <label class="control-label col-md-3">Upload Image</label>
                                    <div class="col-md-9 hidepic">
                                       
                                                <img src="<?php echo "../images/testimonials/".$row["wimage"]; ?>" alt="" style="height: 141px;"/>
                                           
                                         <div class="editpic"> <a class="btn btn-info ">Edit</a></div>
                               
                                    </div>
                                    <div class="col-md-9 dispic" style="display:none;">   
                                    <div class="col-md-5" class="iconic-input" >
                    <input id="input-1" name="file" value="<?php echo "../images/testimonials/".$row['wimage']; ?>" type="file" class="file file-loading" data-allowed-file-extensions='["png", "gif", "jpg", "jpeg"]'>
                                 </div> </div>
                                </div>
                            <div class="form-group last">
                                <label class="control-label col-md-3">Content</label>
                                <div class="col-md-5" class="iconic-input">
                                <textarea name="content" style="width:100%" rows="20" class="form-control ckeditor" required="required"><?php echo $row["wcontent"];?></textarea>
                                </div>
                            </div>
                             <input type="hidden" name="cid" class="form-control" value="<?php echo $row["wid"];?>" required="required">
                              
                                 <div class="form-group last">
                                     <div class="col-md-5" class="iconic-input">
                                         <button class="btn btn-info" type="submit" name="upwhovr">Update Content</button>
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