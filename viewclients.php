<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="styles.css">
	<script>
		function validateClientForm() {
			var clientName = document.forms["clientForm"]["clientName"].value;
			var email = document.forms["clientForm"]["email"].value;
			var subscriptionPlan = document.forms["clientForm"]["subscriptionPlan"].value;
			if (clientName == "" || email == "" || subscriptionPlan == "") {
				alert("All fields must be filled out");
				return false;
			}
		}
	</script>
</head>
<body>
	<a href="index.php">Return to home</a>
	<?php $getVendorByID = getVendorByID($pdo, $_GET['vendor_id']); ?>
	<h1>Vendor Name: <?php echo $getVendorByID['vendor_name']; ?></h1>
	<h1>Add New Client</h1>
	<form name="clientForm" action="core/handleForms.php?vendor_id=<?php echo $_GET['vendor_id']; ?>" method="POST" onsubmit="return validateClientForm()">
		<p>
			<label for="clientName">Client Name</label> 
			<input type="text" name="clientName">
		</p>
		<p>
			<label for="email">Email</label> 
			<input type="email" name="email">
		</p>
		<p>
			<label for="subscriptionPlan">Subscription Plan</label> 
			<input type="text" name="subscriptionPlan">
			<input type="submit" name="insertClientBtn">
		</p>
	</form>

	<table style="width:100%; margin-top: 50px;">
	  <tr>
	    <th>Client ID</th>
	    <th>Client Name</th>
	    <th>Email</th>
	    <th>Subscription Plan</th>
	    <th>Date Added</th>
	    <th>Action</th>
	  </tr>
	  <?php 
	  $getClientsByVendor = getClientsByVendor($pdo, $_GET['vendor_id']); 
	  if ($getClientsByVendor) {
	      foreach ($getClientsByVendor as $row) { ?>
	      <tr>
	      	<td><?php echo $row['client_id']; ?></td>	  	
	      	<td><?php echo $row['client_name']; ?></td>	  	
	      	<td><?php echo $row['email']; ?></td>	  	
	      	<td><?php echo $row['subscription_plan']; ?></td>	  	
	      	<td><?php echo $row['date_added']; ?></td>
	      	<td>
	      		<a href="editclient.php?client_id=<?php echo $row['client_id']; ?>&vendor_id=<?php echo $_GET['vendor_id']; ?>">Edit</a>

	      		<a href="deleteclient.php?client_id=<?php echo $row['client_id']; ?>&vendor_id=<?php echo $_GET['vendor_id']; ?>">Delete</a>
	      	</td>	  	
	      </tr>
	  <?php } 
	  } else {
	      echo "<tr><td colspan='6'>No clients found for this vendor.</td></tr>";
	  }
	  ?>
	</table>

	
</body>
</html>
