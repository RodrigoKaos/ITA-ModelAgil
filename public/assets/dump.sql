CREATE DATABASE ita_jali;
USE ita_jali;

CREATE TABLE users(
    id            INT AUTO_INCREMENT PRIMARY KEY,
    login         VARCHAR(18) NOT NULL UNIQUE,
    password      VARCHAR(255) NOT NULL,
    name          VARCHAR (255) NOT NULL,
    points        INT DEFAULT 0,
    created_at    TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
);

INSERT INTO 
    users(login, password, name ) 
VALUES 
    ("admin", "admin", "Administrator"), 
    ("user1", "123456", "User One"),
    ("user2", "123456", "User 2"), 
    ("user3", "123456", "User 3"), 
    ("user4", "123456", "User 4"), 
    ("user5", "123456", "User 5"), 
    ("user6", "123456", "User 6"), 
    ("user7", "123456", "User 7"), 
    ("user8", "123456", "User 8"), 
    ("user9", "123456", "User 9"), 
    ("user10", "123456", "User Ten");
    

CREATE TABLE books(
    id            INT AUTO_INCREMENT PRIMARY KEY,
    title         VARCHAR(255) NOT NULL,
    genre         VARCHAR(255) NOT NULL,
    total_pages         INT NOT NULL,
    created_at    TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO
    books(title, genre, total_pages)
VALUES
    ("Book One", "Fiction", 50),
    ("Book Two", "Romance", 150),
    ("Book Three", "Fiction", 250),
    ("Book Four", "Fiction", 50),
    ("Book Five", "Romance", 450),
    ("Book Six", "Fiction", 250),
    ("Book Seven", "Fiction", 50),
    ("Book Eight", "Romance", 150),
    ("Book Nine", "Fiction", 250),
    ("Book Ten", "Fiction", 50),
    ("Book Eleven", "Romance", 450),
    ("Book Twelve", "Fiction", 250),    
    ("Book 13", "Horror Fiction", 50),
    ("Book 14", "Horror Fiction", 150),
    ("Book 15", "Horror Fiction", 250),
    ("Book 16", "Horror Fiction", 50),
    ("Book 17", "Horror Fiction", 450);

CREATE TABLE user_books(
    id           INT AUTO_INCREMENT PRIMARY KEY,
    user_id      INT NOT NULL,
    book_id      INT NOT NULL,
    status       INT DEFAULT 0,
    created_at   TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY(user_id) REFERENCES users(id),
    FOREIGN KEY(book_id) REFERENCES books(id)
);

INSERT INTO
    user_books(user_id, book_id, status)
VALUES
    (2, 1, 1),
    (3, 2, 1),(3, 1, 1),
    (4, 1, 1), (4, 2, 1), (4, 3, 1),
    (5, 1, 1), (4, 2, 1), (4, 3, 1), (5, 1, 1), (4, 2, 1), (4, 3, 1),

--Book list
SELECT 
    u.book_id, b.title, b.genre, u.status

FROM user_books u 

LEFT JOIN books b ON b.id = u.book_id 

WHERE 
    u.user_id = 2 
AND 
    u.status = 1;


-- Total books of a especific genre
SELECT Count(u.book_id) AS quantity, b.genre
    FROM user_books u 
    LEFT JOIN books b ON b.id = u.book_id 
    WHERE u.user_id = 2 AND u.status = 1
    GROUP BY b.genre 
    ORDER BY quantity DESC;