<?php session_start();
?>
<!DOCTYPE html>

<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script lang="javascript">
		alert ('inscription bien effectué');
	</script>
</head>
<body>

<div class="header">
	<h2>Home Page</h2>
</div>
<div class="content">
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>

    <?php  if (isset($_SESSION['nom'])) : ?>
    	<p>bonjour Mr.(Mme.) <strong><?php echo $_SESSION['nom']; ?></strong></p>
    	<p> <a href="logout.php" style="color: red;">logout</a> </p>
		<?php session_destroy();
		?>
    <?php endif ?>
</div>
		
</body>
</html>