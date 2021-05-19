<?php
    include_once('connect.php');
    session_start();

    if (!empty($_SESSION['c_id'])) {
        header("Location: ./index.php?error=loggedin");
        //echo "empty: ".$_SESSION['c_id'];
    }

    //print_r($_SESSION);
		
    $sql = "SELECT * FROM public.customer WHERE c_email = '".pg_escape_string($_POST['email'])."' and c_password = '".pg_escape_string($_POST['password'])."'";
    $data = pg_query($dbconn, $sql);
    $row = pg_fetch_assoc($data);
    $login_check = pg_num_rows($data);
    if($login_check > 0) {
        //echo "logged in\n";
        $_SESSION['c_id'] = $row['c_id'];
        $_SESSION['c_email'] = $row['c_email'];
        //echo "row c_id: ".$row['c_id']."\n";
        //echo "c_id: ".$_SESSION['c_id']."\n";
        header("Location: ./index.php");
    } else {
        //echo "invalid";
    }

    $_SESSION['c_id'];

		
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Medicine Dealers</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/fonts/simple-line-icons.min.css">
    <link rel="stylesheet" href="assets/css/Footer-Basic.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Button.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body style="background: rgb(138,188,188);">
    <div class="collapse navbar-collapse" id="navcol-1" style="opacity: 1;">
        <ul class="nav nav-tabs mr-auto">
            <li class="nav-item"><a class="nav-link active" href="#">First Item</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Second Item</a></li>
            <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" aria-expanded="false" data-toggle="dropdown" href="#">Dropdown </a>
                <div class="dropdown-menu"><a class="dropdown-item" href="#">First Item</a><a class="dropdown-item" href="#">Second Item</a><a class="dropdown-item" href="#">Third Item</a></div>
            </li>
        </ul><span class="navbar-text actions"> <a class="login" href="#">Log In</a><a class="btn btn-light action-button" role="button" href="#">Sign Up</a></span>
    </div>
    <nav class="navbar navbar-light navbar-expand-md navigation-clean-button" style="background: rgb(220, 220, 220);opacity: 1;filter: invert(0%);border-bottom-style: inset;border-bottom-color: var(--gray);">
        <div class="container"><a class="navbar-brand" href="index.php" style="color: rgb(28,151,179);font-size: 20px;opacity: 1;">Medicine Dealers</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1" style="opacity: 1;">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link" href="shop.php">Shop<br></a></li>
                    <li class="nav-item"><a class="nav-link" href="order.php">Order</a></li>
                    <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" aria-expanded="false" data-toggle="dropdown" href="#">Dropdown </a>
                        <div class="dropdown-menu"><a class="dropdown-item" href="#">First Item</a><a class="dropdown-item" href="#">Second Item</a><a class="dropdown-item" href="#">Third Item</a></div>
                    </li>
                </ul>
                <?php
                    if (empty($_SESSION['c_id'])) {
                        //header("Location: ./index.php?error=notloggedin");
                        //echo "empty: ".$_SESSION['c_id'];
                        echo '
                            <span class="navbar-text actions">
                                <a class="login" href="login.php">
                                    Log In
                                </a>
                                <a class="btn btn-light action-button" role="button" href="register.php" style="background: rgb(28,151,179);">
                                    Sign Up
                                </a>
                            </span>
                        ';
                    }
                    else {
                        echo '
                            <span class="navbar-text actions">
                                <a class="login" href="cart.php" style="padding: 8px;">
                                    <i class="fas fa-shopping-cart" style="color: rgb(28,151,179);"></i>
                                </a>
                                <a class="btn btn-light action-button" role="button" href="account.php" style="background: rgb(28,151,179);">
                                    Account
                                </a> 
                            </span>
                            <form method="post" action="logout.php"> 
                                <a>
                                    <button class="btn btn-link" type="submit" name="logout-submit" role="button" style="background: rgba(28,151,179,0); margin-left: 10px; margin-right: 10px;">
                                        Sign Out
                                    </button>
                                </a>
                            </form>
                            ';
                    }
                ?>
            </div>
        </div>
    </nav>
    <section class="login-clean" style="background: rgba(241,247,252,0);box-shadow: 7px 0px;">
        <form method="post">
            <h2 class="sr-only">Login Form</h2>
            <div class="illustration"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" fill="none" style="color: rgb(28,151,179);">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12.6569 2.75736C15 0.414213 18.799 0.414214 21.1421 2.75736C23.4853 5.1005 23.4853 8.8995 21.1421 11.2426L11.2426 21.1421C8.89949 23.4853 5.1005 23.4853 2.75736 21.1421C0.414214 18.799 0.414213 15 2.75736 12.6569L12.6569 2.75736ZM19.7279 9.82843L15.4853 14.0711L9.82843 8.41421L14.0711 4.17157C15.6332 2.60948 18.1658 2.60948 19.7279 4.17157C21.29 5.73367 21.29 8.26633 19.7279 9.82843Z" fill="currentColor"></path>
                </svg></div>
            <div class="form-group"><input class="form-control" type="email" name="email" id="email"placeholder="Email" style="box-shadow: 2px 2px 4px rgb(156,156,156);"></div>
            <div class="form-group"><input class="form-control" type="password" name="password" id="password" placeholder="Password" style="box-shadow: 2px 2px 4px rgb(156,156,156);"></div>
            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit" style="background: rgb(28,151,179);text-shadow: 0px 0px;box-shadow: 2px 2px 4px rgb(156,156,156);">
                Log In
                </button>
            </div>
            <a class="btn btn-primary btn-block" role="button" href="register.php" style="background: rgb(224,224,224);margin: 14px 0px 0px;color: rgb(28,151,179);box-shadow: 2px 2px 4px rgb(156,156,156);">
                Sign Up
            </a>
            <a class="forgot" href="#">
                Forgot your email or password?
            </a>
            <a class="btn btn-primary btn-block" role="button" href="employeelogin.php" style="background: rgb(28,151,179);text-shadow: 0px 0px;box-shadow: 2px 2px 4px rgb(156,156,156);padding: 8px;width: 158px;font-size: 14px;height: 37px;margin: 31px 8px 0px 40px;">
                Employee Login Here
            </a>
        </form>
    </section>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/quantity.js"></script>
</body>

</html>
