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
          <?php if($_GET["msg"]=='001')
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
                ?>
                <?php if($_GET["nomsg"]=='002')
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
          Edit About Us 
            <span class="tools pull-right">
                <a href="javascript:;" class="fa fa-chevron-down"></a>
                <a href="javascript:;" class="fa fa-times"></a>
             </span>
        </header>
        <div class="panel-body">
        <div class="adv-table">
      
  <?php
        $id=$_GET["id"];
        $query=mysqli_query($connection,'SELECT * FROM `aboutus`');
        $row=mysqli_fetch_array($query);
        
     ?>
   
  <form action="update.php" method="post" class="form-horizontal" enctype="multipart/form-data">
                            <div class="form-group last">
                                <label class="control-label col-md-3">Content</label>
                                <div class="col-md-5" class="iconic-input">
                                <textarea name="content" style="width:100%" rows="20" class="form-control ckeditor" required="required"><?php echo $row["content"];?></textarea>
                                </div>
                            </div>
                             <input type="hidden" name="cid" class="form-control" value="<?php echo $row["catid"];?>" required="required">
                              
                                 <div class="form-group last">
                                     <div class="col-md-5" class="iconic-input">
                                         <button class="btn btn-info" type="submit" name="upabout">Update Content</button>
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