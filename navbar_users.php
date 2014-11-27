<?php

  $uid = $_SESSION['userid'];


?>

<html>
<head>
    
</head>
<body>
 <?php
  $eid1 = 'UCD1';
 $eid2 = 'UCD2';
  $eid3 = 'UCD3';
   $eid4 = 'UCD4';
 ?>

<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header" style = "width:35px;height:35px;">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"></a>
  <!--    <img alt="Brand" src="Assets/profile/ucd.png">  -->
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style = "font-size:20px;margin-left:50px;">
      <ul class="nav navbar-nav">
        <li><a href="userhome.php">Home</a>
        <li><a href="nomination_form.php">Nomination</a></li>
        <li><a href="election.php">Election</a></li>
       
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Result <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href= "test_result.php?id='<?php echo $eid1;?>'">UCD1</a></li>
            <li><a href="result.php?id='<?php echo $eid2;?>'">UCD2</a></li>
            <li><a href="result.php?id='<?php echo $eid3;?>'">UCD3</a></li>
            <li><a href="result.php?id='<?php echo $eid4;?>'">UCD4</a></li>
          </ul>
        </li>

      </ul>

      <form class="navbar-form navbar-left" role="search">
        
      </form>
      <ul class="nav navbar-nav navbar-right">
   
      <div class="dropdown">
      <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
       <img src="Assets/profile/<?php echo $uid;?>.jpg" style = "width:35px;height:35px;margin-right:10px;" > 
        <span class="caret"></span>
      </button>
      <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
        <li role="presentation"><a role="menuitem" tabindex="-1" href="Logout.php">Logout</a></li>
      </ul>
    </div>
       
      <!--     <li><a href="Logout.php">Logout</a></li> -->
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

</body>
</html>