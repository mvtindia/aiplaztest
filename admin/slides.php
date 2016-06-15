<?php
  include("../connect.php");
  include("mainheader.php");?>
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
             <?php if($_GET["msg"]=='1000')
           {
            echo '<div class="alert alert-success alert-block fade in">
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <h4>
                                    <i class="icon-ok-sign"></i>
                                    Success!
                                </h4>
                                <p> Slide added Successfully.</p>
                            </div>';
               }             
                ?>
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
                                <p> Slide Updated Successfully.</p>
                            </div>';
               }             
                ?>
                <?php if($_GET["nomsg"]=='002')
                     {

                     echo '<div class="alert alert-block alert-danger fade in">
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <strong>Oh snap!</strong> wrong file extension.
                            </div>';
                              }             
                            ?>
                           <?php 
if(isset($_GET["delid"]))
{
    $id=$_GET["delid"];
    

     $query=mysqli_query($connect,'delete from `slider` where slide_id="'.$id.'"');
     if($query>0)
     {
      echo '<div class="alert alert-info alert-dismissable">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times-circle"></i></button>
                   Slide is deleted successfully. </div>';
     }
     else{
        echo '<div class="alert alert-danger alert-dismissable">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times-circle"></i></button>
                   Unable to delete the Slide. </div>';
     }
    
 }   
 ?> 
                <div class="col-md-12">
                    <section class="panel">
                        <header class="panel-heading">
                         Slides
                          <span class="tools pull-right">
                            <a class="fa fa-chevron-down" href="javascript:;"></a>
                            <a class="fa fa-times" href="javascript:;"></a>
                         </span>
                        </header>
                        <div class="panel-body">
            <a class="btn btn-warning" href="addslide.php" style="cursor:pointer" value="">Add More Slides</a>
            
            <br>
                            <hr>
                             <br>
            <?php $que = mysqli_query($connect,"SELECT * FROM `slider` order by slide_id asc");
              while($row = mysqli_fetch_array($que))
              {
            ?>
                            <div class="form-group last col-md-12">
                                <label class="control-label col-md-6"> <img src="../img/<?php echo $row['slide_image']; ?>" style="height:200px; width:400px "></label>
                                <div class="col-md-6" class="iconic-input">
                                  <!-- <a href="editslide.php?id=<?php echo $row['slide_id']; ?>" class="btn btn-info" style="cursor:pointer" value="">Edit </a> -->

                                  <a href="?delid=<?php echo $row['slide_id']; ?>" class="btn btn-danger" >Delete </a>
                                </div>
                            </div>
                            <br>
                            <hr>
                             <br>
              <?php } ?>
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