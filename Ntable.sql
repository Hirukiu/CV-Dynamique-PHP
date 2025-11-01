CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    lastname VARCHAR(255),
    firstname VARCHAR(255),
    email VARCHAR(255),
    phone VARCHAR(255),
    picture VARCHAR(255)
);
CREATE TABLE IF NOT EXISTS skills (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    name VARCHAR(255),
    level VARCHAR(255),
    FOREIGN KEY (user_id) REFERENCES users(id)
);
CREATE TABLE IF NOT EXISTS experience (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    name VARCHAR(255),
    description VARCHAR(255),
    startdate DATE,
    enddate DATE,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
CREATE TABLE IF NOT EXISTS education (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    name VARCHAR(255),
    description VARCHAR(255),
    startdate DATE,
    enddate DATE,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
INSERT INTO users (lastname, firstname, email, phone, picture)
VALUES ('Jin', 'Mathieu', 'mathieu.jin@epitech.eu', '0123456789', '');

INSERT INTO users (lastname, firstname, email, phone, picture)
VALUES ('Rastoul', 'Philipe', 'Philipe.rastoul@epitech.eu', '0123456789', '');
