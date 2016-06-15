<?php include("../connect.php");
                      if(isset($_POST["submit"]))
                      {
                        $sid=$_POST["sid"];
                         $hone=$_POST["hone"];
                          $htwo=$_POST["htwo"];
                           $con=$_POST["con"];
                            $txt=$_POST["txt"];
                          
                        $filename=$_FILES['file']['name'];
                        $save="images/protein/".$filename;
                        $filetmp=$_FILES['file']['tmp_name']; 
                        $filepath="../images/protein/".$filename;
                       $supported_image = array(
                                              'jpg',
                                              'jpeg',
                                              'png',
                                              'gif',
                                            );
                      $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                      if (in_array($ext, $supported_image) and !empty($filename))
                         {
                          $query=mysqli_query($connection,'UPDATE `slider` SET `sheading1`="'.$hone.'",`sheading2`="'.$htwo.'",`scontent`="'.$con.'",`sbtntext`="'.$txt.'",`simg1`="'.$save.'" WHERE  sid="'.$sid.'"');
                          move_uploaded_file($filetmp,$filepath);
                           header("location:editslide.php?msg=001");
                          }
                      else if(empty($filename))
                          {
                              $query=mysqli_query($connection,'UPDATE `slider` SET `sheading1`="'.$hone.'",`sheading2`="'.$htwo.'",`scontent`="'.$con.'",`sbtntext`="'.$txt.'" WHERE  sid="'.$sid.'"');
                               header("location:editslide.php?msg=001");
                          }    
                      
                          else
                           {
                             header("location:editslide.php?nomsg=002");
                           } 
                      }

                      ?> 
 
 
 
 
