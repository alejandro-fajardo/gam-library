<!-- js -->
<script src="js/jquery-1.7.1.min.js"></script>
<script src="js/Master.js"></script>

<?php
 if($_GET["logout"]==="true")
 {  
     logout();
     header("location:index.php");
 }
 if($_GET["section"]&&$_GET["module"])
 {  
     $section = $_GET["section"];
     $module = $_GET["module"];
 }
 ?>
 
 <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="index.php" class="logo"> 
    <!-- mini logo for sidebar mini 50x50 pixels --> 
    <span class="logo-mini"><b>GAM</b></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b><img src="img/emp/logoGamBlanco.png" width="100px" height="50px"></b></span>
    </a>
    <!-- Logo -->

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">Administrador</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  Administrador
                </p>
              </li>
              <!-- Menu Body -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="?logout=true" class="btn btn-default btn-flat">Salir</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a ><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header">Menu</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Usuarios</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="?section=users&module=admin_user">Usuarios</a></li>
            <!-- <li><a href="?section=trivia&module=results">Resultados</a></li> -->
          </ul>
          
          <ul class="treeview-menu">git
            <li><a href="?section=users&module=profiles">Perfiles</a></li>
            <!-- <li><a href="?section=trivia&module=results">Resultados</a></li> -->
          </ul>

          <ul class="treeview-menu">
            <li><a href="#" onclick="VerLibros()">Ver Libros</a></li>
          </ul>
          <ul class="treeview-menu">
            <li><a href="?section=categorias&module=categories">Categorias</a></li>
            <!-- <li><a href="?section=trivia&module=results">Resultados</a></li> -->
          </ul>z

        </li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" id="container_info">

    <?php
    if($section!==null&&$module!==null)
    {
        if(file_exists ( "sections/".$section."/".$module.".php" ))
        {
          include("sections/".$section."/".$module.".php");
        }
        else
        {
        ?>
            <!-- Content Header (Page header) -->
            <section class="content-header">
            <h1>
                URL Invalida...
                <small></small>
            </h1>
            </section>

            <!-- Main content -->
            <section class="content">

            <!-- Your Page Content Here -->
            </section>
        <?php
        }  
    }
    else
    {
    ?>
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1>
            DashBoard
            <small></small>
        </h1>
        </section>

        <!-- Main content -->
        <section class="content">

        <!-- Your Page Content Here -->
        </section>
    <?php
    }
    ?>
  </div>



  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      
    </div>
    <!-- Default to the left -->
    
  </footer>

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
