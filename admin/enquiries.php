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
          <?php  if(isset($_REQUEST['adel']))
                      {
                         $id=$_REQUEST["adel"];
            $query=mysqli_query($connect,'DELETE FROM `place` WHERE place_id="'.$id.'" order by eid desc');
                          if($query>0){
                             echo '<div class="alert alert-success alert-block fade in">
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <h4>
                                    <i class="icon-ok-sign"></i>
                                    Success!
                                </h4>
                                <p>Record Successfully Deleted</p>
                            </div>';
               }    else{
                 echo '<div class="alert alert-block alert-danger fade in">
                               <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <h4>
                                    <i class="icon-ok-sign"></i>
                                    Error!
                                </h4>
                                <p> Unable to Delete the Record.</p>
                            </div>';
                              } 
               }  //if isset                  
                            ?>
        <div class="col-sm-12">
        <section class="panel">
        <header class="panel-heading">
           Enquiries
            <span class="tools pull-right">
                <a href="javascript:;" class="fa fa-chevron-down"></a>
                <a href="javascript:;" class="fa fa-times"></a>
             </span>
        </header>
        <div class="panel-body">
        <div class="adv-table">
        <table  class="display mytable table table-bordered table-striped" style="text-align:center" id="dynamic-table">
        <thead>
        <tr>
             <tr>
              <th style="text-align:center; display:none">Sr.no</th>
            <th style="text-align:center">Sr.no</th>
            <th style="text-align:center">Name</th>
            <th style="text-align:center">Service</th>
            <th style="text-align:center">Mobile</th>
            <th style="text-align:center">Action</th>
        </tr>
        </tr>
        </thead>
        <tbody>
        <?php
        $m=1;
        $query=mysqli_query($connect,'SELECT * FROM `enquiry`');
        while($row=mysqli_fetch_array($query))
        {
            ?>
      
        <tr class="gradeX">
            <td style="width:10%;display:none"></td>
            <td style="width:10%"><?php echo $m++;?></td>
            <td style="width:10%"><?php echo $row['ename'];?></td>
            <td style="width:10%">
       <?php $query1=mysqli_query($connect,'SELECT * FROM `services` WHERE sid="'.$row['serviceid'].'"');
              $row1=mysqli_fetch_array($query1);             
             echo $row1['stitle'];
              ?>
              </td>
            <td style="width:10%">
            <?php 
                echo $row['emobile'];            
             ?></td>  
            <td style="width:20%" class="center hidden-phone">                
                <a href="viewenquiry.php?id=<?php echo $row["eid"];?>" class="btn btn-info btn-xs" type="button">View</a>
            </td>
        </tr>
       <?php
       }
       ?>
      
        </tfoot>
        </table>
        </div>
        </div>
        </section>
        </div>
        </div>
        </div>
        <!--body wrapper end-->
     <?php include("footer.php");?>