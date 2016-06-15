<?php include("../connect.php");
                      if(isset($_REQUEST["id"]))
                      {
                        $id=$_REQUEST["id"];
                        
                         {
                          $query=mysqli_query($connection,'DELETE FROM `slider` WHERE  sid="'.$id.'"');
                           header("location:editslide.php?msg=003");
                          }
                      }

                      if(isset($_REQUEST['dpid']))
                      {
                      	$id=$_REQUEST["dpid"];
 						$query=mysqli_query($connection,'DELETE FROM `products` WHERE  prid="'.$id.'"');
                           header("location:productview.php?msz=007");
                      }
                      if(isset($_REQUEST['dgid']))
                      {
                        $id=$_REQUEST["dgid"];
            $query=mysqli_query($connection,'DELETE FROM `gallery` WHERE  gid="'.$id.'"');
                           header("location:gallery.php?msz=007");
                      }

                       if(isset($_REQUEST['dinfo']))
                      {
                        $id=$_REQUEST["dinfo"];
            $query=mysqli_query($connection,'DELETE FROM `infodata` WHERE  dataid="'.$id.'"');
                           header("location:viewinfo.php?msz=007");
                      }

                      if(isset($_REQUEST['logoid']))
                      {
                         $id=$_REQUEST["logoid"];
            $query=mysqli_query($connection,'DELETE FROM `clientlogos` WHERE  logoid="'.$id.'"');
                           header("location:vclientlogos.php?msz=007");
                      }


                      if(isset($_REQUEST['dptid']))
                      {
                         $id=$_REQUEST["dptid"];
            $query=mysqli_query($connection,'DELETE FROM `partners` WHERE  ptid="'.$id.'"');
                           header("location:partners.php?msz=007");
                      }

                       if(isset($_REQUEST['ddid']))
                      {
                         $id=$_REQUEST["ddid"];
            $query=mysqli_query($connection,'DELETE FROM `deals` WHERE  did="'.$id.'"');
                           header("location:deals.php?msz=007");
                      }
                      if(isset($_REQUEST['dgid']))
                      {
                         $id=$_REQUEST["dgid"];
            $query=mysqli_query($connection,'DELETE FROM `groups` WHERE  gid="'.$id.'"');
                           header("location:groups.php?msz=007");
                      }


                      

 if(isset($_REQUEST['edel']))
                      {
                         $id=$_REQUEST["edel"];
            $query=mysqli_query($connection,'DELETE FROM `news_events` WHERE  neid="'.$id.'"');
                           header("location:events.php?msz=007");
                      }
                      ?> 
 
 
 
 
