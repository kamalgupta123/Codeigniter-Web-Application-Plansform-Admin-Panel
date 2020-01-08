<div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav style="width:350px;" class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
              <div class="nav-profile-image">
                <img src="<?php echo base_url()?>assets/images/faces/face1.jpg" alt="profile">
                <span class="login-status online"></span> <!--change to offline or busy as needed-->              
            </div>
              <div class="nav-profile-text d-flex flex-column">
                <span class="font-weight-bold mb-2">
                  <?php echo $this->session->userdata('username');?>
                  </span>
              </div>
              <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" data-target="#posts_dropdown">
              <span class="menu-title">News</span>
              <i class="menu-icon mdi mdi-chevron-down"></i>
            </a>
             <ul id="posts_dropdown" class="collapse">
                            <li>
                                <a href="<?php echo base_url()?>Admin/articleForm">Add News</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url()?>Admin/newsView">View News</a>
                            </li>
              </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" data-target="#blogs_dropdown" href="pages/tables/basic-table.html">
              <span class="menu-title">Blogs</span>
              <i class="menu-icon mdi mdi-chevron-down"></i>
            </a>
            <ul id="blogs_dropdown" class="collapse">
                            <li>
                                <a href="<?php echo base_url()?>Admin/blogForm">Add Blogs</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url()?>Admin/blogView">View Blogs</a>
                            </li>
              </ul>
          </li>
        </ul>
      </nav>