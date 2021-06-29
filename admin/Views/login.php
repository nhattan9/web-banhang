<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="<?= STATIC_DIR ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <!-- Custom styles for this template-->
    <link href="<?= STATIC_DIR ?>/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <span id = "login_alert"></span>
                                    <!-- // action="?controller=login&action=post" -->
                                    <!-- <form  id="login_Form" method="post"> -->
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="username" name="username" aria-describedby="emailHelp"
                                                placeholder="Enter Username..." value="<?= $_COOKIE['adminName'] ?? ""?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="password" name="password" placeholder="Password"  value="<?= $_COOKIE['adminPass'] ?? ""?>">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" name="remember" id="customCheck" >
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                            
                                        <div  id="btn_submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </div>
                                        <hr>
                                        <button type="submit" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </button>
                                        <a  class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a>
                                    <!-- </form> -->
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="views/register.php">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <script>

//   $("#btn_submit").click(function () {
//     var form = $('#login_Form')[0];
//     var data = new FormData(form);

//     $.ajax({
//         url: "?controller=login&action=post",
//         data: data,
//         cache: false,
//         processData: false,
//         contentType: false,
//         type: 'POST',
//         success: function (resp) {
//             // $('#login_alert').html(resp);
//             alert(resp.status);
       
//          location.reload();
//         }
//     });
//   });
$(function() {
            $('#btn_submit').on('click', function() {

                let username = $('#username').val();
                let password = $('#password').val();
                let remember = $('#customCheck').prop("checked");

                if (username == "" || password == "") {
                    // $('#username').addClass('is-invalid');
                    // $('#password').addClass('is-invalid');
                    $("#login_alert").append('<div class="alert alert-danger alert-dismissible fade show" role="alert">Tài khoản và mật khẩu không được để rỗng<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    return false;
                }

                $.ajax({
                    url: '?controller=login&action=post',
                    type: 'POST',
                    data: {username: username, password: password, remember: remember},
                    success: function(result) {
                        if (JSON.parse(result).status == 1) {
                            location.reload();
                            // window.location.href = "https://badhabitsstore.vn/products/street";
                        } else {
                            // $('#username').addClass('is-invalid');
                            // $('#password').addClass('is-invalid');
                            if ($('.alert').length > 0) {
                                $('.alert').remove();
                                $("#login_alert").append('<div class="alert alert-danger alert-dismissible fade show" role="alert">'+JSON.parse(result).message+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                            } else {
                                $("#login_alert").append('<div class="alert alert-danger alert-dismissible fade show" role="alert">'+JSON.parse(result).message+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                            }

                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }      
                });
            });
        });
      </script>


    <!-- Bootstrap core JavaScript-->
    <script src="<?= STATIC_DIR ?>/vendor/jquery/jquery.min.js"></script>
    <script src="<?= STATIC_DIR ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= STATIC_DIR ?>/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= STATIC_DIR ?>/js/sb-admin-2.min.js"></script>

</body>

</html>