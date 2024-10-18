<?php 

require_once 'dbConfig.php'; 
require_once 'models.php';

function validateFields($fields) {
	foreach ($fields as $field) {
		if (empty($field)) {
			return false;
		}
	}
	return true;
}

if (isset($_POST['insertVendorBtn'])) {
	$fields = [$_POST['vendorName'], $_POST['contactEmail'], $_POST['serviceType'], $_POST['websiteUrl']];
	if (validateFields($fields)) {
		$query = insertVendor($pdo, $_POST['vendorName'], $_POST['contactEmail'], $_POST['serviceType'], $_POST['websiteUrl']);
		if ($query) {
			header("Location: ../index.php");
		} else {
			echo "Insertion failed";
		}
	} else {
		echo "All fields must be filled out";
	}
}

if (isset($_POST['editVendorBtn'])) {
	$fields = [$_POST['vendorName'], $_POST['contactEmail'], $_POST['serviceType'], $_POST['websiteUrl']];
	if (validateFields($fields)) {
		$query = updateVendor($pdo, $_POST['vendorName'], $_POST['contactEmail'], $_POST['serviceType'], $_POST['websiteUrl'], $_GET['vendor_id']);
		if ($query) {
			header("Location: ../index.php");
		} else {
			echo "Edit failed";
		}
	} else {
		echo "All fields must be filled out";
	}
}

if (isset($_POST['deleteVendorBtn'])) {
	$query = deleteVendor($pdo, $_GET['vendor_id']);
	if ($query) {
		header("Location: ../index.php");
	} else {
		echo "Deletion failed";
	}
}

if (isset($_POST['insertClientBtn'])) {
	$fields = [$_POST['clientName'], $_POST['email'], $_POST['subscriptionPlan']];
	if (validateFields($fields)) {
		$query = insertClient($pdo, $_POST['clientName'], $_POST['email'], $_POST['subscriptionPlan'], $_GET['vendor_id']);
		if ($query) {
			header("Location: ../viewclients.php?vendor_id=" . $_GET['vendor_id']);
		} else {
			echo "Insertion failed";
		}
	} else {
		echo "All fields must be filled out";
	}
}

if (isset($_POST['editClientBtn'])) {
	$fields = [$_POST['clientName'], $_POST['email'], $_POST['subscriptionPlan']];
	if (validateFields($fields)) {
		$query = updateClient($pdo, $_POST['clientName'], $_POST['email'], $_POST['subscriptionPlan'], $_GET['client_id']);
		if ($query) {
			header("Location: ../viewclients.php?vendor_id=" . $_GET['vendor_id']);
		} else {
			echo "Update failed";
		}
	} else {
		echo "All fields must be filled out";
	}
}

if (isset($_POST['deleteClientBtn'])) {
	$query = deleteClient($pdo, $_GET['client_id']);
	if ($query) {
		header("Location: ../viewclients.php?vendor_id=" . $_GET['vendor_id']);
	} else {
		echo "Deletion failed";
	}
}

?>
