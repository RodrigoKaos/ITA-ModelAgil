CREATE DATABASE JALI;
USE JALI;

CREATE TABLE USERS(
    U_ID            INT AUTO_INCREMENT PRIMARY KEY,
    U_LOGIN         VARCHAR(18) NOT NULL UNIQUE,
    U_PASSWORD      VARCHAR(255) NOT NULL,
    U_NAME          VARCHAR (255) NOT NULL,
    U_POINTS        INT DEFAULT 0,
    U_CREATED_AT    TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
);

INSERT INTO 
    USERS(U_LOGIN, U_PASSWORD, U_NAME ) 
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
    

CREATE TABLE BOOKS(
    B_ID            INT AUTO_INCREMENT PRIMARY KEY,
    B_TITLE         VARCHAR(255) NOT NULL,
    B_GENRE         VARCHAR(255) NOT NULL,
    B_PAGES         INT NOT NULL,
    B_CREATED_AT    TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO
    BOOKS(B_TITLE, B_GENRE, B_PAGES)
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

CREATE TABLE USER_BOOKS(
    UB_ID           INT AUTO_INCREMENT PRIMARY KEY,
    UB_USER_ID      INT NOT NULL,
    UB_BOOK_ID      INT NOT NULL,
    UB_STATUS       BIT DEFAULT 0,
    UB_CREATED_AT   TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY(UB_USER_ID) REFERENCES USERS(U_ID),
    FOREIGN KEY(UB_BOOK_ID) REFERENCES BOOKS(B_ID)
);

INSERT INTO
    USER_BOOKS(UB_USER_ID, UB_BOOK_ID, UB_STATUS)
VALUES
    (2, 1, 1),
    (3, 2, 1),(3, 1, 1),
    (4, 1, 1), (4, 2, 1), (4, 3, 1),
    (5, 1, 1), (4, 2, 1), (4, 3, 1), (5, 1, 1), (4, 2, 1), (4, 3, 1),

--Book list
SELECT 
    u.UB_BOOK_ID, b.B_TITLE, b.B_GENRE, u.UB_STATUS

FROM USER_BOOKS u 

LEFT JOIN BOOKS b ON b.B_ID = u.UB_BOOK_ID 

WHERE 
    u.UB_USER_ID = 2 
AND 
    u.UB_STATUS = 1;


-- Total books of a especific genre
SELECT Count(u.UB_BOOK_ID) AS B_QUANTITY, b.B_GENRE
    FROM USER_BOOKS u 
    LEFT JOIN BOOKS b ON b.B_ID = u.UB_BOOK_ID 
    WHERE u.UB_USER_ID = 2 AND u.UB_STATUS = 1
    GROUP BY b.B_GENRE 
    ORDER BY B_QUANTITY DESC;