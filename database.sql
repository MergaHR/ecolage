-- Ecolage Database Schema
-- Educational Payment Management System

-- Admin users table
CREATE TABLE IF NOT EXISTS `administration` (
  `Id_Administration` int(11) NOT NULL AUTO_INCREMENT,
  `Email_Administration` varchar(100) NOT NULL,
  `Mot_de_passe` varchar(255) NOT NULL,
  `Nom_Administration` varchar(100) DEFAULT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id_Administration`),
  UNIQUE KEY `Email_Administration` (`Email_Administration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Account types table
CREATE TABLE IF NOT EXISTS `type_compte` (
  `Id_type_compte` int(11) NOT NULL AUTO_INCREMENT,
  `Type_compte` varchar(50) NOT NULL,
  `Description` text DEFAULT NULL,
  PRIMARY KEY (`Id_type_compte`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- User accounts table
CREATE TABLE IF NOT EXISTS `compte` (
  `Id_compte` int(11) NOT NULL AUTO_INCREMENT,
  `Adresse_Email` varchar(100) NOT NULL,
  `Mdp` varchar(255) NOT NULL,
  `Id_type_compte` int(11) NOT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id_compte`),
  UNIQUE KEY `Adresse_Email` (`Adresse_Email`),
  KEY `Id_type_compte` (`Id_type_compte`),
  FOREIGN KEY (`Id_type_compte`) REFERENCES `type_compte` (`Id_type_compte`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Academic levels table
CREATE TABLE IF NOT EXISTS `niveau` (
  `Code_Niveau` int(11) NOT NULL AUTO_INCREMENT,
  `Grade` varchar(50) NOT NULL,
  `Cout_niveau` decimal(10,2) NOT NULL DEFAULT 0.00,
  `Description` text DEFAULT NULL,
  PRIMARY KEY (`Code_Niveau`),
  UNIQUE KEY `Grade` (`Grade`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Academic mentions table
CREATE TABLE IF NOT EXISTS `mention` (
  `Code_Mention` int(11) NOT NULL AUTO_INCREMENT,
  `Nom_Mention` varchar(100) NOT NULL,
  `Description` text DEFAULT NULL,
  PRIMARY KEY (`Code_Mention`),
  UNIQUE KEY `Nom_Mention` (`Nom_Mention`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Students table
CREATE TABLE IF NOT EXISTS `etudiant` (
  `Numero_Matricule` varchar(50) NOT NULL,
  `Nom_Etudiant` varchar(100) NOT NULL,
  `Prenom_Etudiant` varchar(100) NOT NULL,
  `Niveau` varchar(50) NOT NULL,
  `Mention` varchar(100) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Telephone` varchar(20) DEFAULT NULL,
  `Adresse` text DEFAULT NULL,
  `Date_Inscription` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Numero_Matricule`),
  KEY `Niveau` (`Niveau`),
  KEY `Mention` (`Mention`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Payment methods table
CREATE TABLE IF NOT EXISTS `modepayement` (
  `Id_Mode` int(11) NOT NULL AUTO_INCREMENT,
  `Mode_payement` varchar(50) NOT NULL,
  `Description` text DEFAULT NULL,
  PRIMARY KEY (`Id_Mode`),
  UNIQUE KEY `Mode_payement` (`Mode_payement`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Payment records table
CREATE TABLE IF NOT EXISTS `payement` (
  `N` int(11) NOT NULL AUTO_INCREMENT,
  `Numero_Matricule` varchar(50) NOT NULL,
  `Montant` decimal(10,2) NOT NULL,
  `Mode_payement` varchar(50) NOT NULL,
  `Date_payement` timestamp DEFAULT CURRENT_TIMESTAMP,
  `validation_status` enum('pending','validated','rejected') DEFAULT 'pending',
  `validated_by` varchar(100) DEFAULT NULL,
  `validation_date` timestamp NULL DEFAULT NULL,
  `Reference` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`N`),
  KEY `Numero_Matricule` (`Numero_Matricule`),
  KEY `Mode_payement` (`Mode_payement`),
  FOREIGN KEY (`Numero_Matricule`) REFERENCES `etudiant` (`Numero_Matricule`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Student payment details table
CREATE TABLE IF NOT EXISTS `payementetu` (
  `N` int(11) NOT NULL AUTO_INCREMENT,
  `Numero_Matricule` varchar(50) NOT NULL,
  `Montant` decimal(10,2) NOT NULL,
  `Mode_payement` varchar(50) NOT NULL,
  `Date_payement` timestamp DEFAULT CURRENT_TIMESTAMP,
  `Status` varchar(20) DEFAULT 'pending',
  `Notes` text DEFAULT NULL,
  PRIMARY KEY (`N`),
  KEY `Numero_Matricule` (`Numero_Matricule`),
  FOREIGN KEY (`Numero_Matricule`) REFERENCES `etudiant` (`Numero_Matricule`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Verification records table
CREATE TABLE IF NOT EXISTS `verification` (
  `Id_verification` int(11) NOT NULL AUTO_INCREMENT,
  `Numero_Matricule` varchar(50) NOT NULL,
  `Type_verification` varchar(50) NOT NULL,
  `Status` varchar(20) DEFAULT 'pending',
  `Date_verification` timestamp DEFAULT CURRENT_TIMESTAMP,
  `Verified_by` varchar(100) DEFAULT NULL,
  `Notes` text DEFAULT NULL,
  PRIMARY KEY (`Id_verification`),
  KEY `Numero_Matricule` (`Numero_Matricule`),
  FOREIGN KEY (`Numero_Matricule`) REFERENCES `etudiant` (`Numero_Matricule`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert default data
INSERT INTO `type_compte` (`Id_type_compte`, `Type_compte`, `Description`) VALUES
(1, 'Administrator', 'System administrator with full access'),
(2, 'Accountant', 'Financial management access'),
(3, 'Academic', 'Academic records management'),
(4, 'Staff', 'Limited access staff account');

INSERT INTO `modepayement` (`Id_Mode`, `Mode_payement`, `Description`) VALUES
(1, 'Cash', 'Cash payment'),
(2, 'Bank Transfer', 'Bank transfer payment'),
(3, 'Mobile Money', 'Mobile money payment'),
(4, 'Check', 'Check payment'),
(5, 'Credit Card', 'Credit card payment');

-- Insert default admin user (password: admin123)
INSERT INTO `administration` (`Email_Administration`, `Mot_de_passe`, `Nom_Administration`) VALUES
('admin@ecolage.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'System Administrator');

-- Insert sample academic levels
INSERT INTO `niveau` (`Grade`, `Cout_niveau`, `Description`) VALUES
('L1', 500000.00, 'Licence 1st Year'),
('L2', 500000.00, 'Licence 2nd Year'),
('L3', 500000.00, 'Licence 3rd Year'),
('M1', 750000.00, 'Master 1st Year'),
('M2', 750000.00, 'Master 2nd Year');

-- Insert sample mentions
INSERT INTO `mention` (`Nom_Mention`, `Description`) VALUES
('Computer Science', 'Computer Science and Engineering'),
('Business Administration', 'Business and Management'),
('Economics', 'Economics and Finance'),
('Law', 'Law and Political Science'),
('Medicine', 'Medical Studies');
