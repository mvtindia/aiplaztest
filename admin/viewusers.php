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
            if(isset($_REQUEST["aid"]))
{
   
     $aid=$_REQUEST["aid"];
     $adst=urldecode($_REQUEST["adst"]);
     if($adst=='ACTIVE')
     {
      $adst='INACTIVE';
     }
     else
     {
      $adst='ACTIVE';
     }

     $query1=mysqli_query($connection,'UPDATE `register` SET `active`="'.$adst.'" WHERE `rid`="'.$aid.'"');
                              
 }   //end of if aid
         ?>

        
          <?php  

           //delete user
            if(isset($_REQUEST["delrid"]))
{
   
     $delrid=$_REQUEST["delrid"];
   
     $query1=mysqli_query($connection,'DELETE FROM `register` WHERE rid="'.$delrid.'"');
       if($query1>0)
       {
        echo '<div class="alert alert-success alert-block fade in">
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                
                                <p> User is deleted Successfully.</p>
                            </div>';
                        }else{
                             echo '<div class="alert alert-danger alert-block fade in">
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                               
                                <p> Unable to delete the user.</p>
                            </div>';
                        }
                                          
 }   //end of if aid
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
        <table  class="display table table-bordered table-striped" id="dynamic-table">
        <thead>
        <tr>
             <tr>
            <th style="max-width:7% !important">Sr.no</th>
            <th style="max-width:12% !important">Name </th>
            <th style="max-width:20% !important">Email </th>
             <th style="max-width:10% !important">Phone</th>
            <th style="max-width:12% !important">Timestamp</th>
             <th style="max-width:10% !important">Status</th>
             <th style="max-width:14% !important">Active/Inactive</th>
             <th style="max-width:11% !important">Action</th>
        </tr>
        </tr>
        </thead>
        <tbody>
        <?php
        $i=1;
        $query=mysqli_query($connection,'SELECT * FROM `register`');
        while($row=mysqli_fetch_array($query))
        {
            ?>
      
        <tr class="gradeX">
            <td><?php echo $i++;?></td>
              <td class="center hidden-phone"><?php echo $row["fname"]." ".$row["lname"]; ?></td>
           <td class="center hidden-phone">
             <?php echo $row["email"]; ?>

           </td>
        
             <td>
                <?php  echo  $row["phone"];          ?>
             </td>
       
             <td class="center hidden-phone" style="width:11%"><?php  echo $row["times"];?></td>

              <td class="center hidden-phone" style="width:9%">
                <?php 
                if($row["status"]==1)
                {
               
                echo '<span class="label label-primary label-mini">Registered</span>';
               
                }
                else
                  {
              echo '<span class="label label-warning label-mini">Unregistered</span>';
             }?>
 
            </td>
              <td class="center hidden-phone"><a href="?aid=<?php echo $row['rid'];?>&adst=<?php echo urlencode($row['active']);?>">
            <?php if($row['active']=='ACTIVE')
            {
              echo '<span class="label label-primary label-mini">'.$row['active'].'</span>';
            }
           else
            {
              echo '<span class="label label-danger label-mini">'.$row['active'].'</span>';
            }
                ?>
               </a> </td>
               <td><a href="viewsingleuser.php?regid=<?php echo $row["rid"]; ?>" class="btn btn-success btn-xs" type="button">View</a>
                <a href="?delrid=<?php echo $row["rid"];?>" class="btn btn-danger btn-xs" type="button">Delete</a></td>
        </tr>
       <?php
       }?>
      
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