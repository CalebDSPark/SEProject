 <header class="main-header">
        <!-- Logo -->
        <a href="../main/main.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>DL</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>DO Library</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

              <!-- Messages: style can be found in dropdown.less-->
              <!--li class="dropdown messages-menu">
                <a href="#">
                  <i class="fa fa-user"></i>
                  <span class="label label-success">4</span>
                </a>
              </li-->

              <!-- Notifications: style can be found in dropdown.less -->
              <!--li class="dropdown notifications-menu">
                <a href="#">
                  <i class="fa fa-check-square"></i>
                  <span class="label label-warning">10</span>
                </a>                
              </li-->

              <!-- Tasks: style can be found in dropdown.less -->
              <!--li class="dropdown tasks-menu">
                <a href="#">
                  <i class="fa fa-chain"></i>
                  <span class="label label-danger">9</span>
                </a>                
              </li-->
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="../../images/user.png" class="user-image" alt="User Image">
                  <span class="hidden-xs">{{G_FNAME}}</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="../../images/user.png" class="img-circle" alt="User Image" />
                    <p>
                      {{G_FNAME}} {{G_LNAME}} 
                      <small>{{G_DEPT}} - {{G_JOB}}</small>
                      <small>Access Level: {{G_LEVEL}}</small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <!--div class="pull-left">
                      <a href="../../manager/admin/admin_view.php?f_id={{G_ID}}" class="btn btn-default btn-flat">Profile</a>
                    </div-->
                    <div class="pull-right">
                      <a href="../../manager/logout.php" class="btn btn-default btn-flat">Log out</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              
            </ul>
          </div>
        </nav>
      </header>