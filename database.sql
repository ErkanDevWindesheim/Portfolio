-- Maak de database aan als deze nog niet bestaat
CREATE DATABASE IF NOT EXISTS PortfolioDB;

-- Gebruik de database
USE PortfolioDB;

-- Controleer of de tabel 'Users' al bestaat en verwijder deze indien nodig
DROP TABLE IF EXISTS Users;

-- Maak de tabel 'Users' aan
CREATE TABLE Users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255),
    role ENUM('admin', 'guest') DEFAULT 'admin',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Controleer of de tabel 'Projects' al bestaat en verwijder deze indien nodig
DROP TABLE IF EXISTS Projects;

-- Maak de tabel 'Projects' aan
CREATE TABLE Projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    description TEXT NOT NULL,
    technologies_used VARCHAR(255),
    project_link VARCHAR(255),
    github_link VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Controleer of de tabel 'Skills' al bestaat en verwijder deze indien nodig
DROP TABLE IF EXISTS Skills;

-- Maak de tabel 'Skills' aan
CREATE TABLE Skills (
    id INT AUTO_INCREMENT PRIMARY KEY,
    skill_name VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Controleer of de many-to-many tabel 'ProjectSkills' al bestaat en verwijder deze indien nodig
DROP TABLE IF EXISTS ProjectSkills;

-- Maak de many-to-many relatie tussen Projects en Skills aan
CREATE TABLE ProjectSkills (
    project_id INT,
    skill_id INT,
    PRIMARY KEY (project_id, skill_id),
    FOREIGN KEY (project_id) REFERENCES Projects(id) ON DELETE CASCADE,
    FOREIGN KEY (skill_id) REFERENCES Skills(id) ON DELETE CASCADE
);

-- Controleer of de tabel 'ContactSubmissions' al bestaat en verwijder deze indien nodig
DROP TABLE IF EXISTS Contacts;

-- Maak de tabel 'Contacts' aan
CREATE TABLE Contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    message TEXT NOT NULL,
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Optionele tabel voor werkervaring
DROP TABLE IF EXISTS Experience;

-- Maak de tabel 'Experience' aan (optioneel)
-- CREATE TABLE Experience (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     company_name VARCHAR(100) NOT NULL,
--     position VARCHAR(100) NOT NULL,
--     description TEXT,
--     start_date DATE,
--     end_date DATE
-- );
