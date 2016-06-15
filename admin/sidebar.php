<!-- left side start-->
    <div class="left-side sticky-left-side">

        <!--logo and iconic logo start-->
       <div class="logo" style="width: 16%; height: auto; text-align: center;">
        <?php $q = mysqli_query($connect,"select * from logo"); $r = mysqli_fetch_array($q); ?>
            <a href="index.php"><img src="../images/<?php echo $r['logo_image']; ?>" alt="" style="max-width: 50px; height: auto;"></a>
        </div>
       
        <div class="logo-icon text-center">
            <a href="index.php"><img src="images/<?php echo $r['logo_image']; ?>" alt="" style="max-width: 50px; height: auto;"></a>
        </div>
     <!--  <p style="color:white; font-size:20px;">  </p> -->
        <!--logo and iconic logo end-->

        <div class="left-side-inner">

            <!-- visible to small devices only -->
            <div class="visible-xs hidden-sm hidden-md hidden-lg">
                <div class="media logged-user">
                    <img alt="" src="images/photos/user-avatar.png" class="media-object">
                    <div class="media-body">
                        <!-- <h4><a href="#">John Doe</a></h4>
                        <span>"Hello There..."</span> -->
                    </div>
                </div>
               
            </div>

            <!--sidebar nav start-->
            <ul class="nav nav-pills nav-stacked custom-nav">
                <li class="active"><a href="index.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
                <li class=""><a href="logo.php"><i class="fa fa-pencil-square-o"></i> <span>Logo</span></a></li>
              <!--   <li class=""><a href="slides.php"><i class="fa fa-picture-o"></i> <span>Slides</span></a></li> -->
                         
                        <!-- 
                <li><a href="home.php"><i class="fa fa-home"></i> <span>Home page</span></a></li>
 -->
                <li class="menu-list">
                    <a href=""><i class="fa fa-home"></i> <span>Home Page </span></a>
                    <ul class="sub-menu-list">
                        <!-- <li><a href="slides.php"><i class="fa fa-home"></i>Slider</a></li>  -->
                    	<li><a href="video.php"><i class="fa fa-home"></i>Video</a></li> 
                        <li><a href="home.php"><i class="fa fa-home"></i>About Us</a></li>  
                         <li><a href="work.php"><i class="fa fa-home"></i>How it Works</a></li>
                      </ul>

                  
                <li class=""><a href="city.php"><i class="fa fa-building-o"></i> <span>City</span></a></li>
                 <li><a href="ptype.php"><i class="fa fa-calendar"></i>Property Type</a></li>
                 <li><a href="ammenities.php"><i class="fa fa-tag"></i>Ammenities</a></li>
                <li><a href="safety.php"><i class="fa fa-chain"></i>Safety</a></li>
                <li><a href="rules.php"><i class="fa fa-paperclip"></i>Rules</a></li>
                <li><a href="event.php"><i class="fa fa-calendar"></i>Events</a></li>
                <li><a href="tax.php"><i class="fa fa-inr"></i>Tax</a></li>
                <li><a href="area.php"><i class="fa fa-inr"></i>Area</a></li>
                <li><a href="places.php"><i class="fa fa-check-square"></i>Places</a></li>
                <li><a href="services.php"><i class="fa fa-check-square"></i>Services</a></li>
                <li><a href="enquiries.php"><i class="fa fa-check-square"></i>Enquiries</a></li>
                <li><a href="testimonials.php"><i class="fa fa-tag"></i>Testimonials</a></li>                
                <li class=""><a href="changepassword.php"><i class="fa fa-lock"></i> <span>Change Password</span></a></li>

       <!--          <li class=""><a href="ads.php"><i class="fa fa-adn"></i> <span>Ads</span></a></li>
                <li class=""><a href="cal.php"><i class="fa fa-calendar"></i> <span>Google Calendar</span></a></li>
                <li class="menu-list">
                    <a href=""><i class="fa fa-home"></i> <span>Home page</span></a>
                    <ul class="sub-menu-list">
                        <li><a href="about.php"><i class="fa fa-user"></i>About Us</a></li>
                        <li><a href="news.php"><i class="fa fa-book"></i>News</a></li>
                        
                    </ul>
                </li>
                <li class="menu-list">
                    <a href=""><i class="fa fa-user"></i> <span>About Us</span></a>
                    <ul class="sub-menu-list">
                        <li><a href="acontent.php"><i class="fa fa-book"></i>Content</a></li>
                       
                        <li><a href="events.php"><i class="fa fa-calendar"></i>Events</a></li>
                    </ul>
                </li>
                 <li class="menu-list">
                    <a href=""><i class="fa fa-phone"></i> <span>Contact</span></a>
                    <ul class="sub-menu-list">
                        <li><a href="feedback.php"><i class="fa fa-pencil-square-o"></i>Feedback</a></li>
                        <li><a href="contact.php"><i class="fa fa-info-circle"></i>Information</a></li>
                        <li><a href="events.php"><i class="fa fa-calendar"></i>Events</a></li>
                    </ul>
                </li>   
            </ul> -->
            <!--sidebar nav end-->

        </div>
    </div>
    <!-- left side end-->