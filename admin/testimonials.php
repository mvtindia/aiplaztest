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
if(isset($_REQUEST['tdelid']))
          {
            $id=$_REQUEST['tdelid'];
            $query = mysqli_query($connect,"delete from testimonials where tid=".$id);
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
                                <p>Testimonial deleted successfully</p>
                            </div>';
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
                                <p>Testimonial deletion Failure</p>
                            </div>';
               }
            }//isset
                           ?>
                            
        <div class="col-sm-12">
        <section class="panel">
        <header class="panel-heading">
           Testimonials
          
            <span class="tools pull-right">
                <a href="javascript:;" class="fa fa-chevron-down"></a>
                <a href="javascript:;" class="fa fa-times"></a>
             </span>
        </header>
        <div class="panel-body">

        <div class="adv-table">
        <div><a href="addtestimonials.php" class="btn btn-warning btn-sm" type="button">Add More Testimonials</a></div>

<?php 
                          $query=mysqli_query($connect,'select * from testimonials');
                          while($row=mysqli_fetch_assoc($query))
                          {
                            $path="../images/testimonials/".$row['timage'];
                         
                          ?>
<div class="col-md-12">
                    <div class="panel widget-info-one">
                       <!--  <div class="avatar-img">
                            <img src="images/gallery/image3.jpg" alt=""/>
                        </div> -->
                        <div class="inner">
                            <div class="avatar"><img alt="" src="<?php echo $path; ?>"></div>
                            <h5><?php echo $row['tname'];?></h5>
                            <span class="subtitle">
                                <?php echo $row['tcontent'];?>
                            </span>
                        </div>
                        <div class="panel-footer">
                            <ul class="post-view">
                                <li>
                                    <a href="edittestimonials.php?teditid=<?php echo $row['tid'];?>">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                </li>
                                 <li class="active">
                                    <a href="#">
                                        <i class="fa fa-arrows-h"></i>
                                    </a>
                                   
                                </li> 
                                <li>
                                    <a href="?tdelid=<?php echo $row['tid'];?>">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
<?php  } //while?>

        </div>
        </div>
        </section>
        </div>
        </div>
        </div>
        <!--body wrapper end-->
     <?php include("footer.php");?>