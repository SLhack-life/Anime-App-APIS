@include('Admin.layouts.master')
<body>
    
   
        <!-- OffCanvas Menu End -->
        <!-- breadcrumb-area start -->
        <div class="breadcrumb-area">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-12 text-center">
                        <h2 class="breadcrumb-title">Login</h2>
                        <!-- breadcrumb-list start -->
                        <ul class="breadcrumb-list">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active">Login</li>
                        </ul>
                        <!-- breadcrumb-list end -->
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb-area end -->
        <!-- login area start -->
        

        <div class="login-register-area pt-100px pb-100px">
            <div class="container">
               
                <div class="row">
                    <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                        <div class="login-register-wrapper">
                            <div class="login-register-tab-list nav">
                                <a class="active" data-bs-toggle="tab" href="#lg1">
                                    <h4>login</h4>
                                </a>
                                <a data-bs-toggle="tab" href="#lg2">
                                    <h4>register</h4>
                                </a>
                            </div>
                            <div class="tab-content"> 
                            
                                <div id="lg1" class="tab-pane active">
                                    <div class="login-form-container">
                                        <div class="login-register-form">
                                            <form action="" method="POST">
                                                <input type="text" name="username" placeholder="Username" />
                                                <input type="password" name="password" placeholder="Password" />
                                                <div class="button-box">
                                                    <div class="login-toggle-btn">
                                                        <input type="checkbox" />
                                                        <a class="flote-none" href="javascript:void(0)">Remember me</a>
                                                        <a href="#">Forgot Password?</a>
                                                    </div>
                                                    <button type="submit" name="submit"><span>Login</span></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                
                                <div id="lg2" class="tab-pane">
                                    <div class="login-form-container">
                                        <div class="login-register-form">
                                            <form  method="POST">
                                                
                                                <label style="color:blue;">*</label>
                                                <input type="text" name="username" placeholder="Username" />

                                                <label style="color:blue;">*</label>  
                                                <input name="Email" placeholder="Email" type="email" />
                                    
                                                <label style="color:blue;">*</label> 
                                                <input type="password" name="password" placeholder="Password" />
                                           
                                                <label style="color:blue;">*</label> 
                                                <input type="password" name="confirm_password" placeholder="confirm Password" />
                                                
                                                <div class="button-box">
                                                    <button type="submit" name="submit"><span>Register</span></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 
                </div>
            </div>
        </div>

        <!-- login area end -->
        <!-- Footer Area Start -->
        
        <!-- Footer Area End -->
    </div>
    <!-- Global Vendor, plugins JS -->
    <!-- JS Files
    ============================================ -->
   