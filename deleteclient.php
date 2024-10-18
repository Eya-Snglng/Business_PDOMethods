<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<?php $getClientByID = getClientByID($pdo, $_GET['client_id']); ?>
	<h1>Are you sure you want to delete this client?</h1>
	<div class="container" style="border-style: solid; height: 400px;">
		<h2>Client Name: <?php echo $getClientByID['client_name'] ?></h2>
		<h2>Email: <?php echo $getClientByID['email'] ?></h2>
		<h2>Subscription Plan: <?php echo $getClientByID['subscription_plan'] ?></h2>
		<h2>Date Added: <?php echo $getClientByID['date_added'] ?></h2>

		<div class="deleteBtn" style="float: right; margin-right: 10px;">

			<form action="core/handleForms.php?client_id=<?php echo $_GET['client_id']; ?>&vendor_id=<?php echo $_GET['vendor_id']; ?>" method="POST">
				<input type="submit" name="deleteClientBtn" value="Delete">
			</form>			
			
		</div>	

	</div>
</body>
</html>
