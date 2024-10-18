<?php  

function insertVendor($pdo, $vendor_name, $contact_email, $service_type, $website_url) {

	$sql = "INSERT INTO SaaS_Vendor (vendor_name, contact_email, service_type, website_url, date_added) VALUES(?,?,?,?,NOW())";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$vendor_name, $contact_email, $service_type, $website_url]);

	if ($executeQuery) {
		return true;
	}
}



function updateVendor($pdo, $vendor_name, $contact_email, $service_type, $website_url, $vendor_id) {

	$sql = "UPDATE SaaS_Vendor
				SET vendor_name = ?,
					contact_email = ?,
					service_type = ?, 
					website_url = ?
				WHERE vendor_id = ?
			";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$vendor_name, $contact_email, $service_type, $website_url, $vendor_id]);
	
	if ($executeQuery) {
		return true;
	}

}


function deleteVendor($pdo, $vendor_id) {
	$deleteVendorClients = "DELETE FROM SaaS_Client WHERE vendor_id = ?";
	$deleteStmt = $pdo->prepare($deleteVendorClients);
	$executeDeleteQuery = $deleteStmt->execute([$vendor_id]);

	if ($executeDeleteQuery) {
		$sql = "DELETE FROM SaaS_Vendor WHERE vendor_id = ?";
		$stmt = $pdo->prepare($sql);
		$executeQuery = $stmt->execute([$vendor_id]);

		if ($executeQuery) {
			return true;
		}

	}
	
}




function getAllVendors($pdo) {
	$sql = "SELECT * FROM SaaS_Vendor";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();

	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getVendorByID($pdo, $vendor_id) {
	$sql = "SELECT * FROM SaaS_Vendor WHERE vendor_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$vendor_id]);

	if ($executeQuery) {
		return $stmt->fetch();
	}
}





function getClientsByVendor($pdo, $vendor_id) {
	
	$sql = "SELECT 
				SaaS_Client.client_id AS client_id,
				SaaS_Client.client_name AS client_name,
				SaaS_Client.email AS email,
				SaaS_Client.subscription_plan AS subscription_plan,
				SaaS_Client.date_added AS date_added,
				SaaS_Vendor.vendor_name AS vendor_name
			FROM SaaS_Client
			JOIN SaaS_Vendor ON SaaS_Client.vendor_id = SaaS_Vendor.vendor_id
			WHERE SaaS_Client.vendor_id = ? 
			GROUP BY SaaS_Client.client_name;
			";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$vendor_id]);
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}


function insertClient($pdo, $client_name, $email, $subscription_plan, $vendor_id) {
	$sql = "INSERT INTO SaaS_Client (client_name, email, subscription_plan, vendor_id, date_added) VALUES (?,?,?,?,NOW())";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$client_name, $email, $subscription_plan, $vendor_id]);
	if ($executeQuery) {
		return true;
	}

}

function getClientByID($pdo, $client_id) {
	$sql = "SELECT 
				SaaS_Client.client_id AS client_id,
				SaaS_Client.client_name AS client_name,
				SaaS_Client.email AS email,
				SaaS_Client.subscription_plan AS subscription_plan,
				SaaS_Client.date_added AS date_added,
				SaaS_Vendor.vendor_name AS vendor_name
			FROM SaaS_Client
			JOIN SaaS_Vendor ON SaaS_Client.vendor_id = SaaS_Vendor.vendor_id
			WHERE SaaS_Client.client_id  = ? 
			GROUP BY SaaS_Client.client_name";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$client_id]);
	if ($executeQuery) {
		return $stmt->fetch();
	}
}

function updateClient($pdo, $client_name, $email, $subscription_plan, $client_id) {
	$sql = "UPDATE SaaS_Client
			SET client_name = ?,
				email = ?,
				subscription_plan = ?
			WHERE client_id = ?
			";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$client_name, $email, $subscription_plan, $client_id]);

	if ($executeQuery) {
		return true;
	}
}

function deleteClient($pdo, $client_id) {
	$sql = "DELETE FROM SaaS_Client WHERE client_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$client_id]);
	if ($executeQuery) {
		return true;
	}
}

?>
