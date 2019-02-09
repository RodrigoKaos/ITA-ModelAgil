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
    ("user2", "123456", "User Two");

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
    ("Book Twelve", "Fiction", 250);

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
    USER_BOOKS(UB_USER_ID, UB_BOOK_ID)
VALUES
    (1, 1), (1, 2);

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