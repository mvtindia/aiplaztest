					<?php include("../connect.php");


          if(isset($_REQUEST["submit"]))
                      {
                        $filename=$_FILES['file']['name'];
                        $filetmp=$_FILES['file']['tmp_name']; 
                        $filepath="../images/".$filename;
                       $supported_image = array(
                                              'jpg',
                                              'jpeg',
                                              'png',
                                              'gif',
                                            );
                      $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                      if(!empty($filename))
                      {
                      if (in_array($ext, $supported_image))
                         {
                          $query=mysqli_query($connect,'update logo set logo_image="'.$filename.'"');
                          move_uploaded_file($filetmp,$filepath);
                          echo '<script> window.location.href="logo.php?msg=001"; </script>';

                           //header("location:logo.php?msg=001");
                          }
                          else
                           {
                             //header("location:logo.php?nomsg=002");
                          echo '<script> window.location.href="logo.php?nomsg=002"; </script>';

                           } 
                      }
                      else
                      {
                          echo '<script> window.location.href="logo.php?msg=001"; </script>';
                      }
                      }



          if(isset($_REQUEST['upabout']))
          {
            $content = $_REQUEST['content'];
            $query=mysqli_query($connection,"UPDATE `aboutus` SET `content`='".$content."' ");
            if($query)
            {
              header('location:aboutus.php?msg=001');
            }
          }

         

          if(isset($_POST["upcl"]))
                      {
                        $cname=$_POST["cname"];
                        $location=$_POST["location"];
                            $sid=$_POST["cid"];

                          $query=mysqli_query($connection,'UPDATE `clients` SET `cname`="'.$cname.'",`location`="'.$location.'" WHERE clid='.$sid);
                        
                           header("location:viewclients.php?msg=001");
                       }


            if(isset($_POST["upcat"]))
                      {
                        $category=$_POST["category"];
                        
                            $sid=$_POST["cid"];

                          $query=mysqli_query($connection,'UPDATE `category` SET `catname`="'.$category.'" where `catid`="'.$sid.'"');
                        
                           header("location:categories.php?msg=001");
                       }

                        if(isset($_POST["upinfocat"]))
                      {
                        $category=$_POST["category"];
                        
                            $sid=$_POST["cid"];

                          $query=mysqli_query($connection,'UPDATE `infocat` SET `catname`="'.$category.'" where `catid`="'.$sid.'"');
                        
                           header("location:infocat.php?msg=001");
                       }


            if(isset($_REQUEST['icid']))
              {
                $query = mysqli_query($connection,"delete from infocat where catid=".$_REQUEST['icid']);
                if($query)
                {
                  header('location:infocat.php?msz=007');
                }
              }
        if(isset($_REQUEST['dclid']))
          {
            $query = mysqli_query($connection,"delete from clients where clid=".$_REQUEST['dclid']);
            if($query)
            {
              header('location:viewclients.php?msz=007');
            }
          }

          if(isset($_REQUEST['did']))
          {
            $query = mysqli_query($connection,"delete from category where catid=".$_REQUEST['did']);
            if($query)
            {
              header('location:categories.php?msz=007');
            }
          }
                      ?> 
                      <?php
                       if(isset($_POST["submit1"]))
                      {
                        $filename=$_FILES['file']['name'];
                        $filetmp=$_FILES['file']['tmp_name']; 
                        $filepath="../img/".$filename;
                       $supported_image = array(
                                              'jpg',
                                              'jpeg',
                                              'png',
                                              'gif',
                                            );
                      $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                      if (in_array($ext, $supported_image))
                         {
                          $query=mysqli_query($connection,'update sliderbg set sliderbg_image="'.$filename.'" where sliderbg_id=1');
                          move_uploaded_file($filetmp,$filepath);
                           header("location:agencyindexsliderbackground.php?msg=001");
                          }
                          else
                           {
                             header("location:agencyindexsliderbackground.php?nomsg=002");
                           } 
                      }
                    
                       if(isset($_POST["updateslide"]))
                      {
						  $scode = $_REQUEST['scode'];
						  
             // $slideheading = $_REQUEST['slideheading'];

						  $supported_image = array(
                                              'jpg',
                                              'jpeg',
                                              'png',
                                              'gif',
                                            );
						//file
                        $filename=$_FILES['file']['name'];
                        $filetmp=$_FILES['file']['tmp_name']; 
                        $filepath="../image/slide/".$filename;
                      $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
					  if(!empty($filename))
            {
					  
						  if (in_array($ext, $supported_image))
                         {
                          $query=mysqli_query($connection,'update slider set slide_image="'.$filename.'" where slide_id='.$scode);
                          move_uploaded_file($filetmp,$filepath);
                           header("location:slides.php?msg=001");
                          }
                          else
                           {
                            header("location:slides.php?nomsg=002");
                           } 
                         }
                         else
                         {
                           header("location:slides.php?msg=001");
                         }
					  
                      }


                       if(isset($_POST["updatemega"]))
                      {
              $scode = $_REQUEST['scode'];
              
             // $slideheading = $_REQUEST['slideheading'];

              $supported_image = array(
                                              'jpg',
                                              'jpeg',
                                              'png',
                                              'gif',
                                            );
            //file
                        $filename=$_FILES['file']['name'];
                        $filetmp=$_FILES['file']['tmp_name']; 
                        $filepath="../image/event/".$filename;
                      $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            if(!empty($filename))
            {
            
              if (in_array($ext, $supported_image))
                         {
                          $query=mysqli_query($connection,'update mega set pic="'.$filename.'" where mid='.$scode);
                          move_uploaded_file($filetmp,$filepath);
                           header("location:mega.php?msg=001");
                          }
                          else
                           {
                            header("location:mega.php?nomsg=002");
                           } 
                         }
                         else
                         {
                           header("location:mega.php?msg=001");
                         }
            
                      }


                      if(isset($_POST["updatestory"]))
                      {
              $scode = $_REQUEST['scode'];
              $title = $_REQUEST['title'];

              
             // $slideheading = $_REQUEST['slideheading'];

              $supported_image = array(
                                              'jpg',
                                              'jpeg',
                                              'png',
                                              'gif',
                                            );
            //file
                        $filename=$_FILES['file']['name'];
                        $filetmp=$_FILES['file']['tmp_name']; 
                        $filepath="../image/".$filename;
                      $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            if(!empty($filename))
            {
            
              if (in_array($ext, $supported_image))
                         {
                          $query=mysqli_query($connection,'update story set story_title = "'.$title.'" , story_pic="'.$filename.'" where story_id='.$scode);
                          move_uploaded_file($filetmp,$filepath);
                           header("location:tops.php?msg=updated");
                          }
                          else
                           {
                            header("location:tops.php?nomsg=002");
                           } 
                         }
                         else
                         {
                           $query=mysqli_query($connection,'update story set story_title = "'.$title.'" where story_id='.$scode);
                           header("location:tops.php?msg=updated");
                         }
            
                      }

                       //add series
                       if(isset($_POST["addproject"]))
                      {
                     $filename=$_FILES['file']['name'];
                     $ptitle =  $_REQUEST['mname'];
                     $pdesc = $_REQUEST['myear'];
                     $pcat = $_REQUEST['pcat'];
                     $pscat = $_REQUEST['pscat'];
                     $psscat = $_REQUEST['psscat'];
                     $filetmp=$_FILES['file']['tmp_name']; 
                     $filepath="../img/portfolio/".$filename;
                     $supported_image = array(
                                              'jpg',
                                              'jpeg',
                                              'png',
                                              'gif',
                                            );
                      $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                      if (in_array($ext, $supported_image))
                         {
                          $query=mysqli_query($connection,'INSERT INTO `projects`(`secondblock_id`, `editsecondblockfurther_id`, `subcontent_id`, `ptitle`, `pimg`, `pdesc`) VALUES ("'.$pcat.'","'.$pscat.'","'.$psscat.'","'.$ptitle.'","'.$filename.'","'.$pdesc.'")');
                         move_uploaded_file($filetmp,$filepath);
                          header("location:viewprojects.php?msg=000");
                          }
                          else
                           {
                             header("location:viewprojects.php?nomsg=002");
                           } 
                      }

                      ?>
 
 
 
 
 
