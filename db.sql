-- create user table with usernme emil phone pssword and role(enum(seeker,recruiter))
CREATE TABLE user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    phone VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('seeker', 'recruiter') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- alter user table to have a img_path column 
   
ALTER TABLE user ADD COLUMN img_path VARCHAR(255) DEFAULT '';

-- alter user table img_path to have a default of http://localhost/hireup/public/person.jpg

ALTER TABLE user MODIFY COLUMN img_path VARCHAR(255) DEFAULT 'http://localhost/hireup/public/person.jpg';

-- alter user table remove img_path column from user table

ALTER TABLE user DROP COLUMN img_path;

-- create job table with title, description, salary, location, company name, user_id(foreign key)

CREATE TABLE job_post (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    location VARCHAR(255) NOT NULL,
    type ENUM('full-time', 'part-time', 'contract', 'internship') NOT NULL,
    tags TEXT,
    user_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE
    ON UPDATE CASCADE
);


-- create table post that has a content and imgpath and created_at and updated_at 

CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    content TEXT NOT NULL,
    user_id INT NOT NULL,
    img_path VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE
    ON UPDATE CASCADE
);

-- alter job_post to remove type and tags
   
ALTER TABLE job_post DROP COLUMN type, DROP COLUMN tags;

-- create a comment table with user_id(foreign key) and job_id(foreign key) and content(text)

CREATE TABLE comment (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    post_id INT NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE
    ON UPDATE CASCADE,
    FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE
    ON UPDATE CASCADE
);

-- alter comment table to change the name job_id to post_id


-- create job application table with job_id(foreign key), user_id(foreign key),content(text), status(enum(pending, accepted, rejected))

CREATE TABLE job_application (
    id INT AUTO_INCREMENT PRIMARY KEY,
    job_id INT NOT NULL,
    user_id INT NOT NULL,
    content TEXT,
    status ENUM('pending', 'accepted', 'rejected') DEFAULT 'pending' NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (job_id) REFERENCES job_post(id) ON DELETE CASCADE
    ON UPDATE CASCADE,
    FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE
    ON UPDATE CASCADE
);

-- alter job_application to have a title column 


-- insert an application into jop_application with user id (7) and jopid 3 


INSERT INTO job_application (job_id, user_id, title, content) VALUES (3, 7, 'Software Engineer', 'I am a software engineer with 5 years of e5436=====xperience in web development.');


