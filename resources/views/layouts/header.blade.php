
<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <style>
    .dropdown {
  position: relative;
  display: inline-block;
}


.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  max-width: 260px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  padding: 12px 16px;
  z-index: 1;
}

.dropdown:hover .dropdown-content {
  display: block;
}
</style> -->
    <meta charset="utf-8" />
    <title>GadgetsHunt</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="../assets/images/Gadgets.png">

    <!-- Bootstrap Css -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />

<!-- </head> -->

<!-- <body data-sidebar="dark"> -->

    <!-- Begin page -->
    <!-- <div id="layout-wrapper"> -->

        <header id="page-topbar" style="background-color:darkturquoise;">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a href="index.php" class="logo logo-light">
                            <!-- <span class="logo-sm">
                                <img src="assets/images/logo-sm-light.png" alt="" height="22">
                            </span> -->
                            <span class="logo-lg">
                                <img src="" alt="" height="30">
                            </span>
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                        <i class="mdi mdi-backburger"></i>

                    </button>

                </div>

                <!-- <div class="d-flex">
                    
                    <div class="navbar-brand-box">
                        <a href="index.php" class="logo logo-light">
                             <span class="logo-sm">
                                <img src="assets/images/logo-sm-light.png" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="assets/images/Gadgets2.png" alt="" height="30">
                            </span>
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                        <i class="mdi mdi-backburger"></i>

                    </button>

                </div> -->

                <div class="d-flex">
                   
                         <form method="post" action="">
                            <div class="dropdown">

                         
                         <div class="d-inline-block">

                     

                        <img src="/gadget_hunts/admin/assets/uploads/admin_profile/<?php echo @$row['profile']; ?>" style="vertical-align: middle;width: 80px;height: 80px;border-radius: 50%; margin-right: 20px;margin-top: 20px;
                        " alt="Avatar" class="avatar">

                        <h5><span class="badge badge-danger float-right">Admin</span></h5>
                        <div class="dropdown-content">
                        <a href="../profile.php"><button type="button" class="btn btn-primary">Profile</button></a>
                      <a href=""><button type="submit" name="submit" class="btn btn-primary mt-4" value="logout">logout</button></a>
                           
                        </div>
                    </div>

                    </div>
                        </form>
                 
                     <a href="../../admin_login.php"><button type="button" class="btn btn-danger">Login</button></a>
                    
                <?php
            
                ?>
                    

                </div>
            </div>
        </header>
<!-- </div>
 <script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>
    <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>

    <script src="{{asset('assets/js/app.js')}}"></script>
</body>
</html> -->