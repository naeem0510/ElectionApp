<!DOCTYPE html>
<html>
<head>
    <title>Voting Page</title>
    <link rel="stylesheet" type="text/css" href="Assets/CSS/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="Assets/CSS/voting2.css">
     <script src="Assets/js/jquery.js"> </script>
     <script src="Assets/js/bootstrap.js"> </script>
     <script src="Assets/js/bootstrap.min.js"> </script>

</head>
<body>
<?php
include 'navbar.php' ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>

                </ol>
                <div class="carousel-inner">

                    <div class="item active">
                        <img src="Assets/images/1.jpg" alt="First slide">
                        <div class="carousel-caption">

                            <h3>
                                Naeem Mansoori</h3>
                            <p>
                                Masters in Electronics and Computer ENgineering</p>
                        </div>
                    </div>


                    <div class="item">
                        <img src="http://placehold.it/1200x500/9b59b6/8e44ad" alt="Second slide">
                        <div class="carousel-caption">
                            <h3>
                                Second slide</h3>
                            <p>
                                Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                        </div>
                    </div>
                    <div class="item">
                        <img src="http://placehold.it/1200x500/34495e/2c3e50" alt="Third slide">
                        <div class="carousel-caption">
                            <h3>
                                Third slide</h3>
                            <p>
                                Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                        </div>
                    </div>
                </div>
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span></a><a class="right carousel-control"
                        href="#carousel-example-generic" data-slide="next"><span class="glyphicon glyphicon-chevron-right">
                        </span></a>
            </div>
            <div class="main-text hidden-xs">
                <div class="col-md-12">
                    <h3>
                        </h3>
                    
                    <div class="">
                        <a class="btn btn-info btn-sm btn-min-block" href="http://www.jquery2dotnet.com/">Read Profile</a>
                        <a class="btn btn-success btn-sm btn-min-block" href="http://www.jquery2dotnet.com/">View Video</a>
                        <a class="btn btn-danger btn-sm btn-min-block" href="http://www.jquery2dotnet.com/">Vote</a>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="push">
</div>



</body>
</html>
