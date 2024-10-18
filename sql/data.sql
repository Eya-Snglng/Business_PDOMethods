-- Table for SaaS Vendors
CREATE TABLE SaaS_Vendor (
    vendor_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    vendor_name VARCHAR(100) NOT NULL,
    contact_email VARCHAR(100) NOT NULL UNIQUE,
    service_type VARCHAR(50) NOT NULL,
    website_url VARCHAR(100),
    date_added DATE NOT NULL
);

-- Table for SaaS Clients
CREATE TABLE SaaS_Client (
    client_id INT PRIMARY KEY AUTO_INCREMENT,
    client_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    subscription_plan VARCHAR(50) NOT NULL,
    vendor_id INT,
    date_added DATE NOT NULL,
    FOREIGN KEY (vendor_id) REFERENCES SaaS_Vendor(vendor_id)
);
