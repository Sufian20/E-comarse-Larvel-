@extends('master')

@section('content')
 
    <div class="auth-fluid" style="background-image: url(../assets/images/bg-auth-2.jpg);">
            <!--Auth fluid left content -->
            <div class="auth-fluid-form-box">
                <div>
                    <div class="card-body">

                        <!-- Logo -->
                        <div class="auth-brand text-center">
                            <div class="auth-logo">
                                <a href="index.html" class="logo auth-logo-dark">
                                    <span class="logo-lg">
                                        <img src="../assets/images/logo-dark.png" alt="" height="26">
                                    </span>
                                </a>
            
                                <a href="index.html" class="logo auth-logo-light">
                                    <span class="logo-lg">
                                        <img src="../assets/images/logo-light.png" alt="" height="26">
                                    </span>
                                </a>
                            </div>
                        </div>

                        <!-- title-->

                        <div class="text-center w-75 m-auto pt-3">
                            <div class="mb-3">
                                <img src="../assets/images/users/avatar-5.jpg" alt="user-image" class="rounded-circle img-thumbnail avatar-lg">
                            </div>
                            <p class="text-muted mb-4">Enter your password to access the admin.</p>
                        </div>


                        <form action="#">

                            <div class="form-group mb-3">
                                <label for="password">Password</label>
                                <input class="form-control" type="password" required="" id="password" placeholder="Enter your password">
                            </div>

                            <div class="form-group mb-0 text-center">
                                <button class="btn btn-primary btn-block" type="submit"> Log In </button>
                            </div>
                            <div class="text-center mt-4">
                                <p class="text-muted">Not you? return <a href="pages-login.html" class="text-dark ml-1">Sign In</a></p>
                            </div>
                        </form>

                        <!-- Footer-->
                        <footer class="footer footer-alt">
                            <p class="text-muted"><script>document.write(new Date().getFullYear())</script> &copy; Highdmin theme by <a href="#">Coderthemes</a></p>
                        </footer>

                    </div> <!-- end .card-body -->
                </div>
            </div>
            <!-- end auth-fluid-form-box-->

        </div>
     <!-- end auth-fluid-->

@endsection

