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
          <?php if($_GET["msz"]=='007')
           {
            echo '<div class="alert alert-success alert-block fade in">
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <h4>
                                    <i class="icon-ok-sign"></i>
                                    Success!
                                </h4>
                                <p>Product deleted successfully</p>
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
                                <p> Transaction is rejected.</p>
                            </div>';
                              }             
                            ?>
                             <?php if($_GET["msg"]=='changed')
           {
            echo '<div class="alert alert-success alert-block fade in">
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <h4>
                                    <i class="icon-ok-sign"></i>
                                    Success!
                                </h4>
                                <p>User Account has been Deactivated.</p>
                            </div>';
               }             
                ?>

                <?php if($_GET["msg"]=='00002')
           {
            echo '<div class="alert alert-success alert-block fade in">
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <h4>
                                    <i class="icon-ok-sign"></i>
                                    Success!
                                </h4>
                                <p>Product Added Successfully.</p>
                            </div>';
               }             
                ?>

                <?php if($_GET["nomsg"]=='009')
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
        <div class="col-sm-12">
        <section class="panel">
        <header class="panel-heading">
           View Users
            <span class="tools pull-right">
                <a href="javascript:;" class="fa fa-chevron-down"></a>
                <a href="javascript:;" class="fa fa-times"></a>
             </span>
        </header>
        <div class="panel-body">
        <div class="adv-table">
        <form action="actions.php" method="post">
        <table  class="display table table-bordered table-striped" style="text-align:center" id="dynamic-table">
        <thead>
        <tr>
          <th style="display:none;"></th>
          <th style="width:10% !important;text-align:center">#</th>
          <th style="width:30% !important;text-align:center">Name</th>
          <th style="width:30% !important;text-align:center">Email</th>
          <th style="width:30% !important;text-align:center">Contact</th>  

        </tr>
        </thead>
        <tbody>
        <?php
        $i=1;
        $nn = 1;
        $query=mysqli_query($connect,'SELECT * FROM `users` order by uid asc');
        while($row=mysqli_fetch_array($query))
        {
            ?>
        <tr class="gradeX">
        <td style="display:none;"></td>
            <td><?php echo $i++;?></td>
            <td class="center hidden-phone" style="width:30%"> <?php echo $row["fname"]." ".$row['lname']; ?> </td>
            <td class="center hidden-phone" style="width:30%"> <?php echo $row["email"]; ?> </td>
            <td class="center hidden-phone" style="width:30%"> <?php echo $row["contact"]; ?> </td>
        </tr>
       <?php
       }?>
      
        </tbody>
        </table>
        </form>
        </div>
        </div>
        </section>
        </div>
        </div>
        </div>
        <!--body wrapper end-->
     <?php include("footer.php");?>