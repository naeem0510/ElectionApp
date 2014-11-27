<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link href="Assets/CSS/bootstrap.min.css" rel="stylesheet">
    <script src="Assets/js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Create a New Election</h3>
                    </div>
             
                    <form class="form-horizontal" action="election_create.php" method="post">
                      <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
                        <label class="control-label">Election Name</label>
                        <div class="controls">
                            <input name="name" type="text"  placeholder="Election Name" value="<?php echo !empty($name)?$name:'';?>">
                            <?php if (!empty($nameError)): ?>
                                <span class="help-inline"><?php echo $nameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($typeError)?'error':'';?>">
                        <label class="control-label">Election Type</label>
                        <div class="controls">
                            <input name="type" type="text" placeholder="Election Type" value="<?php echo !empty($type)?$type:'';?>">
                            <?php if (!empty($typeError)): ?>
                                <span class="help-inline"><?php echo $typeError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($dateError)?'error':'';?>">
                        <label class="control-label">Date</label>
                        <div class="controls">
                            <input name="date" type="text"  placeholder="Election Date" value="<?php echo !empty($date)?$date:'';?>">
                            <?php if (!empty($dateError)): ?>
                                <span class="help-inline"><?php echo $dateError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn" href="index.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>

<?php
     
    include 'db_connect.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $nameError = null;
        $typeError = null;
        $dateError = null;
         
        // keep track post values
        $name = $_POST['name'];
        $type = $_POST['type'];
        $date = $_POST['date'];
         
        // validate input
        $valid = true;
        if (empty($name)) {
            $nameError = 'Please enter Name';
            $valid = false;
        }
         
        if (empty($type)) {
            $typeError = 'Please enter type';
            $valid = false;
        }
         
        if (empty($date)) {
            $dateError = 'Please enter Date';
            $valid = false;
        }
         
        // insert data
        if ($valid) {
           include 'db_connect.php';

            $sql = $dbh->prepare("INSERT INTO elections (ElectionID,Type,Date,Nominate) VALUES(?, ?, ?,'1')");
           	$sql->execute();
            header('Location:election.php');
        }
    }
?>