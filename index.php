<?php
	require_once "includes/get-data.php"; 
?>
<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Google app store">
    <meta name="author" content="kotryn">
    <title>Szukaj w Google </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link href="includes/favicon.ico" rel="icon" type="image/x-icon" />
  </head>
  <body>
  	<div class="container">
  		<div class="row">
  			<div class="col-md-6 col-md-offset-3">
  				<h1 class="page-header text-center">Szukaj aplikacji w Google Play</h1>

				<form class="form-horizontal" role="form" method="post">
					<div class="form-group">
						<label for="name" class="col-md-2 control-label"></label>
						<div class="col-md-6">

							<input type="text" class="form-control" id="name" name="name" placeholder="Nazwa aplikacji" >
							<?php echo "<p class='text-danger'>$errName</p>";?>					
						</div>
						<div class="col-md-2">
							<input id="submit" name="submit" type="submit" value="Szukaj" class="btn btn-info">
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-10 col-md-offset-2">
							<?php echo $result[0];?>
						</div>
					</div>
				</form> 
			</div>
			<div class="col-md-12 col-md-offset-2">
				<div class="form-group">
					<div class="col-md-4">
						<?php echo $result[4];?>
					</div>			
					<div class="col-md-8" class="lead">
						<font size="6"><?php echo "<dt>".$result[1]."</dt>"."<br>"; ?></font>
						<font size="4">
							<?php echo $result[2]; ?>
							<?php echo $result[3]; ?>
							<?php echo $result[5]; ?>
							<?php echo $result[6]; ?>
							<?php echo $result[7]; ?>
						</font>
					</div>
				</div>
			</div>
		</div>
	</div>   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
 </body>
</html>


