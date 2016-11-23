<aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="../../images/user.png" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p>{{G_FNAME}}</p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form 
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
           /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">LIBRARY SERVICES</li>
            <p>{{member}}</p>


            <!-- My Info -->
            <li class="treeview">
              <a href="#">
                <i class="fa fa-user"></i>
                <span>My Info</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li  class="active"><a href="../../manager/myinfo/myinfo.php"><i class="fa fa-circle-o"></i>Profile</a></li>
                <li  class="active"><a href="../../manager/myinfo/myinfo_history.php"><i class="fa fa-circle-o"></i>Reading History</a></li>                                
              </ul>
            </li>
			   
            <!-- Book Search -->
            <li class="treeview">
              <a href="../../manager/request/request.php?bag_invt=init">
                <i class="fa fa-database"></i>
                <span>Book Search</span>
                <!--i class="fa fa-angle-left pull-right"></i-->
              </a>
             
            </li>                    

        
            <!-- Study Room -->
            <!--li class="treeview">
              <a href="#">
                <i class="fa fa-pencil-square-o"></i>
                <span>Study Room</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="#"><i class="fa fa-circle-o"></i>1st Floor</a></li>
                <li class="active"><a href="#"><i class="fa fa-circle-o"></i>2nd Floor</a></li>                             
              </ul>
            </li-->

            <!-- Contact -->
            <li class="treeview">
              <a href="#">
                <i class="fa fa-car"></i>
                <span>Contact</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="../../manager/contact/location.php"><i class="fa fa-circle-o"></i>Location</a></li>
                <li class="active"><a href="../../manager/contact/timetable.php"><i class="fa fa-circle-o"></i>Hours</a></li>             
              </ul>           


            <li class="header">STAFF ONLY</li>       
			          
            <!-- Manage Books --> 
            <li class="treeview">
              <a href="#;">
                <i class="fa fa-pencil-square-o"></i> <span>Manage Borrowing</span>    
                <i class="fa fa-angle-left pull-right"></i>            
              </a>      
              <ul class="treeview-menu">
                  <li  class="active"><a href="../../manager/msgborrow/msgborrow.php">
                    <i class="fa fa-circle-o"></i>Borrowing</a></li>
                  <li  class="active"><a href="../../manager/msgborrow/msgborrow_return.php">
                    <i class="fa fa-circle-o"></i>Return</a></li>            
              </ul>        
            </li>

            <!-- Register Books --> 
            <li class="treeview">
              <a href="#;">
                <i class="fa fa-book"></i> <span>Register Books</span>    
                <i class="fa fa-angle-left pull-right"></i>            
              </a>      
              <ul class="treeview-menu">
                  <li  class="active"><a href="../../manager/books/books.php">
                    <i class="fa fa-circle-o"></i>Book List</a></li>
                  <li  class="active"><a href="../../manager/books/books_new.php">
                    <i class="fa fa-circle-o"></i>Book New</a></li>            
              </ul>        
            </li>

            <!-- Register Members --> 
            <li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i> <span>Register Members</span>     
                <i class="fa fa-angle-left pull-right"></i>                            
              </a>  
              <ul class="treeview-menu">
                <li  class="active"><a href="../../manager/member/member.php"><i class="fa fa-circle-o"></i>Member List</a></li>
                <li  class="active"><a href="../../manager/member/member_new.php"><i class="fa fa-circle-o"></i>Member New</a></li>                
              </ul>                              
            </li>

        
            <!-- Report --> 
            <li class="treeview">
              <a href="#;">
                <i class="fa fa-bar-chart"></i> <span>Report</span>
                <i class="fa fa-angle-left pull-right"></i>
                <!--span class="label label-primary pull-right">4</span-->
              </a>
              <ul class="treeview-menu">                        
                <li  class="active"><a href="../../manager/report/report_item.php"><i class="fa fa-circle-o"></i>Book Report</a></li>
              </ul>              
            </li>          
        
        </section>
        <!-- /.sidebar -->
      </aside>


