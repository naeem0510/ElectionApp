<!--<div class="navbar navbar-default">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="#">Election App</a>
  </div>

  <div class="navbar-collapse collapse navbar-responsive-collapse">
    <ul class="nav navbar-nav">
      <li><a href="admin.php">Home</a></li>
      <li><a href="candidate_update.php">Candidates Requests</a></li>
      <li><a href="nomination_form.php">Nomination</a></li>
      <li><a href="#">Results</a></li>
    </ul>

     
    <form class="navbar-form navbar-left">
      </form>
    <ul class="nav navbar-nav navbar-right">
              <li><a href="Logout.php">Log Out</a></li>
        </ul>
   
  </div>
</div>  -->


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Dashboard</title>

    <!-- Bootstrap Core CSS -->
    <link href="Assets/CSS/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="Assets/CSS/simple-sidebar.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#">
                       vótálaí
                    </a>
                </li>
                <li>
                    <a href="admin.php">Dashboard</a>
                </li>
                <li>
                    <a href="candidate_update.php">Requests</a>
                </li>
                <li>
                    <a href="nomination_form.php">Nomination</a>
                </li>
                <li>
                    <a href="election.php">Election</a>
                </li>
                <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Result <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href= "result.php?id='<?php echo $eid1;?>'">UCD1</a></li>
            <li><a href="result.php?id='<?php echo $eid2;?>'">UCD2</a></li>
            <li><a href="result.php?id='<?php echo $eid3;?>'">UCD3</a></li>
            <li><a href="result.php?id='<?php echo $eid4;?>'">UCD4</a></li>
          </ul>
        </li>
                
                <li>
                    <a href="Logout.php">Logout</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1>Overview</h1>
                        <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="Assets/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="Assets/js/bootstrap.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>

</body>

</html>
