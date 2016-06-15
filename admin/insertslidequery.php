<?php include("../connect.php");

 if(isset($_REQUEST['addlogo']))
          {
              $supported_image = array(
                                              'jpg',
                                              'jpeg',
                                              'png',
                                              'gif',
                                            );
                        $filename=$_FILES['file']['name'];
                        $save="../img/".$filename;
                        $filetmp=$_FILES['file']['tmp_name']; 
                        $filepath="../img/".$filename;
                      
                      $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

                      if (in_array($ext, $supported_image))
                         {
                          $query=mysqli_query($connection,'INSERT INTO `clientlogos`(`img`) VALUES ("'.$filename.'")');
                          move_uploaded_file($filetmp,$filepath);
                          echo '<script> window.location.href="vclientlogos.php?msg=00002";</script>';
                          }
                       else
                       {
                          echo '<script> window.location.href="addlogos.php?nomsg=002";</script>';
                       }


          }
          if(isset($_REQUEST['addimg']))
          {
              $supported_image = array(
                                              'jpg',
                                              'jpeg',
                                              'png',
                                              'gif',
                                            );
                        $filename=$_FILES['file']['name'];
                        $save="../img/".$filename;
                        $filetmp=$_FILES['file']['tmp_name']; 
                        $filepath="../img/".$filename;
                      
                      $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

                      if (in_array($ext, $supported_image))
                         {
                          $query=mysqli_query($connection,'INSERT INTO `gallery`(`img`) VALUES ("'.$filename.'")');
                          move_uploaded_file($filetmp,$filepath);
                          echo '<script> window.location.href="gallery.php?msg=00002";</script>';
                          }
                       else
                       {
                          echo '<script> window.location.href="addgpic.php?nomsg=002";</script>';
                       }


          }
                    
             
             //            $filename=$_FILES['file']['name'];
             //            $save="../img/".$filename;
             //            $filetmp=$_FILES['file']['tmp_name']; 
             //            $filepath="../img/".$filename;
                      
             //          $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
          
             //          if (in_array($ext, $supported_image) and !empty($filename))
             //             {
               
             //     $query=mysqli_query($connect,'INSERT INTO `slider`(`slide_image`) VALUES ("'.$filename.'")');
             //      move_uploaded_file($filetmp,$filepath);
             //       header("location:slides.php?msg=1000");

             // }
             //              else
             //               {
             //                 header("location:addslide.php?nomsg=002");
             //               } 
             //          }

  if(isset($_POST["addslide"]))
                      {
                        /* 
                          $slidetext = $_REQUEST['slidetext'];
                    $slideheading = $_REQUEST['slideheading'];
                    $btntext = $_REQUEST['btntext'];
                    $btnlink = $_REQUEST['btnlink'];*/
              $supported_image = array(
                                              'jpg',
                                              'jpeg',
                                              'png',
                                              'gif',
                                            );
                        $filename=$_FILES['file']['name'];
                        $save="../img/".$filename;
                        $filetmp=$_FILES['file']['tmp_name']; 
                        $filepath="../img/".$filename;
                      
                      $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
          
                      if (in_array($ext, $supported_image) and !empty($filename))
                         {
               $q = mysqli_query($connect,"select * from slider");
               if(mysqli_num_rows($q) > 0)
               {
                 $query=mysqli_query($connect,'INSERT INTO `slider`(`slide_image`) VALUES ("'.$filename.'")');
                  move_uploaded_file($filetmp,$filepath);
                   header("location:slides.php?msg=1000");
                }
                else
                {
                  $query=mysqli_query($connect,'INSERT INTO `slider`(`slide_image`,`status`) VALUES ("'.$filename.'","active")');
                  move_uploaded_file($filetmp,$filepath);
                   header("location:slides.php?msg=1000");
                }

             }
                          else
                           {
                             header("location:addslide.php?nomsg=002");
                           } 
                      }

                      //add news
            
            
            
            
           /*  if(!empty($filename1)
               {
                 if(in_array($ext1, $supported_image))
                 {
                          $query=mysqli_query($connection,'INSERT INTO `slider`(`slide_image`, `slide_text`, `slide_textimage`) VALUES ("'.$filename.'","'.$hone.'","'.$filename1.'")');
                          move_uploaded_file($filetmp,$filepath);
                          move_uploaded_file($filetmp1,$filepath1);
                           header("location:addslide.php?msg=001");
                 }
                 else
                 {
                    header("location:addslide.php?nomsg=002");
                 }
              }
              else
              {
                $query=mysqli_query($connection,'INSERT INTO `slider`(`slide_image`, `slide_text`) VALUES ("'.$filename.'","'.$hone.'")');
                  move_uploaded_file($filetmp,$filepath);
                   header("location:addslide.php?msg=001");
              } */
              
                      ?> 
 
 
 
 
