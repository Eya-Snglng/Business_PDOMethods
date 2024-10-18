<?php require_once 'core/handleForms.php'; ?>
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
	<?php $getVendorByID = getVendorByID($pdo, $_GET['vendor_id']); ?>
	<h1>Edit the vendor!</h1>
	<form action="core/handleForms.php?vendor_id=<?php echo $_GET['vendor_id']; ?>" method="POST">
		<p>
			<label for="vendorName">Vendor Name</label> 
			<input type="text" name="vendorName" value="<?php echo $getVendorByID['vendor_name']; ?>">
		</p>
		<p>
			<label for="contactEmail">Contact Email</label> 
			<input type="email" name="contactEmail" value="<?php echo $getVendorByID['contact_email']; ?>">
		</p>
		<p>
			<label for="serviceType">Service Type</label> 
			<input type="text" name="serviceType" value="<?php echo $getVendorByID['service_type']; ?>">
		</p>
		<p>
			<label for="websiteUrl">Website URL</label> 
			<input type="url" name="websiteUrl" value="<?php echo $getVendorByID['website_url']; ?>">
			<input type="submit" name="editVendorBtn">
		</p>
	</form>
</body>
</html>
