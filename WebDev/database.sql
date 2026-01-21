SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('candidate', 'recruiter') NOT NULL,
    specialty VARCHAR(100) DEFAULT NULL,
    bio TEXT DEFAULT NULL,
    skills_tags TEXT DEFAULT NULL,
    experience_years INT DEFAULT 0,
    experience_level ENUM('Beginner', 'Intermediate', 'Advanced') DEFAULT 'Beginner',
    profile_photo VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS jobs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    company_name VARCHAR(255) DEFAULT 'RecruitMe Partner',
    location VARCHAR(100) NOT NULL,
    contract_type ENUM('Full-time', 'Part-time', 'Internship') NOT NULL,
    description TEXT NOT NULL,
    required_skills TEXT,
    required_level ENUM('Beginner', 'Intermediate', 'Advanced'),
    recruiter_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (recruiter_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS applications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    job_id INT NOT NULL,
    candidate_id INT NOT NULL,
    status ENUM('Pending', 'Reviewed', 'Accepted', 'Rejected') DEFAULT 'Pending',
    applied_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (job_id) REFERENCES jobs(id) ON DELETE CASCADE,
    FOREIGN KEY (candidate_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS interviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    candidate_id INT,
    offer_id INT,
    recruiter_id INT,
    interview_date DATETIME,
    link VARCHAR(255),
    status ENUM('Upcoming', 'In Progress', 'Completed', 'Accepted', 'Rejected') DEFAULT 'Upcoming',
    FOREIGN KEY (candidate_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (offer_id) REFERENCES jobs(id) ON DELETE CASCADE,
    FOREIGN KEY (recruiter_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    message TEXT NOT NULL,
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

SET FOREIGN_KEY_CHECKS = 1;