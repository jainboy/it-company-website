  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="../assets/img/favicon-leonex1.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Leonex Technology</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="profile" class="d-block"><?php echo $_SESSION['USER_NAME']?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="admin_dashboard" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a href="pages/widgets.html" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Events
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li> -->
		      <!-- <li class="nav-item has-treeview"> 
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-heart"></i>
              <p>
                order
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="today_order" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>today order</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pending_order" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Panding Order</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="all_order" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Order</p>
                </a>
              </li>
            </ul>
          </li> -->
          <?php   if($_SESSION['ROLE']!='admistration'){ ?>
          <li class="nav-item has-treeview">
            <a href="drone" class="nav-link">
              <i class="nav-icon fas fa-plane"></i>
              <p>
                Portfolio
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="dorne_log" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Profile</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="drone_pilot" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Additional Information</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="intellgence" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Change Password</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } ?>
          <li class="nav-header">OTHER TASK</li>
          <?php if($_SESSION['ROLE']=='blogger' || $_SESSION['ROLE']=='admistration'){ ?>
          <li class="nav-item has-treeview">
            <a href="blog" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Blog Option
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">6</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="manage_blog" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Blog</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="all_category" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Blog Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="all_blog" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Blog</p>
                </a>
              </li>
            </ul>
          </li>
          <?php }   if($_SESSION['ROLE']=='SEO_Maketing' || $_SESSION['ROLE']=='admistration'){ ?>
          <li class="nav-item">
            <a href="query" class="nav-link">
              <i class="nav-icon fas fa-calendar-alt"></i>
              <p>
                Query
                <span class="badge badge-info right">2</span>
              </p>
            </a>
          </li>
         <?php } if($_SESSION['ROLE']=='blogger' || $_SESSION['ROLE']=='admistration'){ ?>
          <li class="nav-item">
            <a href="comment" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                Comments
              </p>
            </a>
          </li>
          <?php } 
         if($_SESSION['ROLE']=='SEO_Maketing' || $_SESSION['ROLE']=='admistration'){ ?>
          <li class="nav-item">
            <a href="enquiry" class="nav-link">
              <i class="nav-icon fas fa-calendar-alt"></i>
              <p>
                Enquiry
                <span class="badge badge-info right">2</span>
              </p>
            </a>
          </li>
         <?php } if($_SESSION['ROLE']=='admistration'){ ?>
          <li class="nav-item has-treeview">
            <a href="team" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Team Setting
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="profile" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Profile</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="project" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Projects</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="project" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Project Add</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="project" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Project Edit</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="project" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Project Detail</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="contact" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Contacts</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">Admin Feature</li>
          <li class="nav-item has-treeview">
            <a href="admin_setting" class="nav-link">
              <i class="nav-icon far fa-plus-square"></i>
              <p>
                Admin Setting
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="profile" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Profile</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="all_admin" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Admin</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="change_password" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Change Password</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } ?>
          <li class="nav-item">
            <a href="logout.php" class="nav-link">
              <i class="nav-icon fas fa-lock"></i>
              <p>Log Out</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>