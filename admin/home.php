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
           if(isset($_REQUEST['uphome']))
          {
            $content = htmlentities($_REQUEST['content']);
            $query=mysqli_query($connect,"UPDATE `pages` SET `page_content`='".$content."' where page_title='home'");
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
            }else{
              echo '<div class="alert alert-danger alert-block fade in">
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <h4>
                                    <i class="icon-ok-sign"></i>
                                    Error!
                                </h4>
                                <p>Unable to update data.</p>
                            </div>';
            }
          }//if isset
                     
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
          Edit Home 
            <span class="tools pull-right">
                <a href="javascript:;" class="fa fa-chevron-down"></a>
                <a href="javascript:;" class="fa fa-times"></a>
             </span>
        </header>
        <div class="panel-body">
        <div class="adv-table">
      
  <?php
        $id=$_GET["id"];
        $query=mysqli_query($connect,'SELECT * FROM `pages` where page_title="home"');
        $row=mysqli_fetch_array($query);
        
     ?>
   
  <form method="post" class="form-horizontal" enctype="multipart/form-data">
                            <div class="form-group last">
                                <label class="control-label col-md-3">Content</label>
                                <div class="col-md-8" class="iconic-input">
                                <textarea name="content" style="width:100%" rows="20" cols="10" class="form-control ckeditor" required="required"><?php echo html_entity_decode($row["page_content"]);?></textarea>
                                </div>
                            </div>
                             <input type="hidden" name="cid" class="form-control" value="<?php echo $row["page_id"];?>" required="required">
                              
                                 <div class="form-group last">
                                     <div class="col-md-5" class="iconic-input">
                                         <button class="btn btn-info" type="submit" name="uphome">Update Content</button>
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