CREATE DATABASE IF NOT EXISTS grand_chase CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci; USE grand_chase;
CREATE TABLE users (id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY, role ENUM('customer','manager') NOT NULL DEFAULT 'customer', first_name VARCHAR(80) NOT NULL, last_name VARCHAR(80) NOT NULL, email VARCHAR(190) NOT NULL UNIQUE, password_hash VARCHAR(255) NOT NULL, phone VARCHAR(40), country VARCHAR(80), status ENUM('active','pending','suspended') NOT NULL DEFAULT 'pending', created_at DATETIME NOT NULL, updated_at DATETIME NULL) ENGINE=InnoDB;
CREATE TABLE accounts (id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,user_id BIGINT UNSIGNED NOT NULL,account_number VARCHAR(24) NOT NULL UNIQUE,currency CHAR(3) NOT NULL DEFAULT 'USD',balance DECIMAL(14,2) NOT NULL DEFAULT 0.00,status ENUM('active','frozen') NOT NULL DEFAULT 'active',created_at DATETIME NOT NULL, FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE) ENGINE=InnoDB;
CREATE TABLE transactions (id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,account_id BIGINT UNSIGNED NOT NULL,type ENUM('deposit','transfer','card','fee') NOT NULL,amount DECIMAL(14,2) NOT NULL,direction ENUM('credit','debit') NOT NULL,description VARCHAR(255) NOT NULL,reference VARCHAR(48) NOT NULL UNIQUE,status ENUM('pending','completed','rejected') NOT NULL DEFAULT 'pending',created_at DATETIME NOT NULL, FOREIGN KEY(account_id) REFERENCES accounts(id) ON DELETE CASCADE) ENGINE=InnoDB;
CREATE TABLE kyc_applications (id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,user_id BIGINT UNSIGNED NOT NULL,document_type VARCHAR(50) NOT NULL,document_number VARCHAR(100),status ENUM('pending','approved','rejected') NOT NULL DEFAULT 'pending',notes TEXT,created_at DATETIME NOT NULL, FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE) ENGINE=InnoDB;
CREATE TABLE loans (id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,user_id BIGINT UNSIGNED NOT NULL,amount DECIMAL(14,2) NOT NULL,purpose VARCHAR(255),term_months SMALLINT UNSIGNED,status ENUM('pending','approved','rejected') NOT NULL DEFAULT 'pending',created_at DATETIME NOT NULL, FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE) ENGINE=InnoDB;
CREATE TABLE cards (id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,user_id BIGINT UNSIGNED NOT NULL,card_type ENUM('virtual','physical') NOT NULL,last_four CHAR(4),status ENUM('pending','active','blocked','rejected') NOT NULL DEFAULT 'pending',created_at DATETIME NOT NULL, FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE) ENGINE=InnoDB;
-- Create a manager with a fresh hash generated for your chosen password:
-- INSERT INTO users (role,first_name,last_name,email,password_hash,status,created_at) VALUES ('manager','System','Manager','manager@example.com','$2y$...', 'active', NOW());

-- Operational indexes
CREATE INDEX idx_users_role_status ON users(role,status);
CREATE INDEX idx_transactions_account_status ON transactions(account_id,status,created_at);
CREATE INDEX idx_kyc_status ON kyc_applications(status,created_at);
CREATE INDEX idx_loans_status ON loans(status,created_at);
CREATE INDEX idx_cards_status ON cards(status,created_at);

CREATE TABLE audit_logs (id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY, manager_id BIGINT UNSIGNED NOT NULL, action VARCHAR(80) NOT NULL, resource_type VARCHAR(40) NOT NULL, resource_id BIGINT UNSIGNED NOT NULL, metadata JSON NULL, created_at DATETIME NOT NULL, INDEX idx_audit_manager_created (manager_id,created_at), FOREIGN KEY(manager_id) REFERENCES users(id) ON DELETE CASCADE) ENGINE=InnoDB;
