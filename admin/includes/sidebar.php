

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">BLOG A BLOG!</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="posts.php" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-chalkboard-teacher"></i>
            <span>Posts</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <!--<h6 class="collapse-header">Custom Utilities:</h6>-->
                <a class="collapse-item" href="posts.php?source=add_post">Add a Post</a>
                <a class="collapse-item" href="posts.php">View all Posts</a>

            </div>
        </div>
    </li>




    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="categories.php">
            <i class="fas fa-user-graduate"></i>
            <span> Categories</span></a>
    </li>
    <!-- Nav Item - Pages Collapse Menu -->

    <li class="nav-item">
        <a class="nav-link" href="comments.php">
            <i class="fas fa-fw fa-table"></i>
            <span>Comments</span></a>
    </li>


    <!-- Nav Item - Utilities Collapse Menu -->
<!--   --><?php
//    if(isset($_SESSION['user_id']) ){
//        $role = $_SESSION['role'];
//        if ($role == "super_admin") {
//            ?>
            <li class="nav-item dropdown">
                <a class="nav-link collapsed dropdown-toggle" href="users.php" role="button" data-toggle="dropdown">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Users</span>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="users.php">View All Users</a>
                    <a class="dropdown-item" href="http://localhost/blog-cms1/admin/users.php?source=add_user">Add User</a>
                </div>
            </li>
<!--            --><?php
//        }
//
//
//    }
//    ?>
    <li class="nav-item">
        <a class="nav-link" href="profile.php">
            <i class="fas fa-fw fa-table"></i>
            <span>Profile</span></a>
    </li>









    <!-- Divider -->
    <hr class="d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
