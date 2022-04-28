<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Bootstrap 5 Admin &amp; Dashboard Template">
	<meta name="author" content="Bootlab">

	<title>VERTAB</title>

	<link rel="canonical" href="https://appstack.bootlab.io/dashboard-default.html" />
	<link rel="shortcut icon" href="img/favicon.ico">

	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
	<link class="js-stylesheet" href="../template/css/light.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    
    <script src="../servicios/core.js"></script>
    <link class="js-stylesheet" href="./template/css/style.css" rel="stylesheet">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
	<!-- <script src="../template/js/settings.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"></script>

    <!-- DATABASE -->
    <link href="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.css" rel="stylesheet" type="text/css">
<script src="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.js" type="text/javascript"></script>

    <script src="../servicios/core.js"></script>
  
</head>
<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-behavior="sticky">
    
    <?php 
    
    function processInput_temp($uri)
    {
        return implode('/',
        array_slice(
            explode('/', $uri), 3));
        }
        echo $rutaCompleta = $_SERVER["REQUEST_URI"];
        echo $rutaLimpia = processInput_temp($rutaCompleta);
        
        /* if(isset($_SESSION['id_user'])){
            $rutaLimpia = processInput_temp($rutaCompleta);
            
        }else{
            $rutaLimpia = 'login';
        }; */
        
        
        ?>
    <div class="wrapper">
        <?php
        if ($rutaLimpia!='login' && $rutaLimpia !='restablecer_contrasena') {
            require('./components/navbar.php');
            require('./components/topbar.php');
        }
        
        ?>
        <?php
        
        if(isset($_SESSION['id_user'])){
            $page =  require('./router.php');
            require($page);
        }else{
            require('./views/logueo/login.php');
        };
        
        ?>

<?php 
        if ($rutaLimpia!='login'  && $rutaLimpia !='restablecer_contrasena') {
            require('./components/footer.php');
        }
        ?>
    </div>
    <script>
        Notification.requestPermission();
        </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
        <script src="../template/js/printThis.js"></script>
</body>

</html>