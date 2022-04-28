<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Rifas mi angel | Administrador</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

  <link rel="stylesheet" href="assets/plugins/toastr/toastr.min.css">
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  
<!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="assets/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> -->

  

<?php 
    
    function processInput_temp($uri)
    {
        return implode('/',
        array_slice(
            explode('/', $uri), 2));
        }
        $rutaCompleta = $_SERVER["REQUEST_URI"];
        $rutaLimpia = processInput_temp($rutaCompleta);
        
        if(isset($_SESSION['id_user'])){
            $rutaLimpia = processInput_temp($rutaCompleta);
            
        }else{
            $rutaLimpia = 'login';
        };
        
        
        ?>
    <div class="wrapper">
        <?php
        if ($rutaLimpia!='login' && $rutaLimpia !='restablecer_contrasena') {
          require('./components/topbar.php');
            require('./components/navbar.php');
        }
        
        ?>
        <?php
        
        if(isset($_SESSION['id_user'])){
          $page =  require('./router.php');
          require($page);
        }else{
            require('./views/login/login.php');
        };
        
        ?>

<?php 
        if ($rutaLimpia!='login'  && $rutaLimpia !='restablecer_contrasena') {
            require('./components/footer.php');
        }
        ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.js"></script>

<!-- PAGE assets/plugins -->
<!-- jQuery Mapael -->
<script src="assets/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="assets/plugins/raphael/raphael.min.js"></script>
<script src="assets/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="assets/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="assets/plugins/chart.js/Chart.min.js"></script>
<script src="assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="assets/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="assets/dist/js/pages/dashboard2.js"></script>
<script src="assets/plugins/toastr/toastr.min.js"></script>

<!-- servicios -->
<script src="./services/core.service.js"></script>
</body>
<script>
    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch();
    })
</script>
</html>
