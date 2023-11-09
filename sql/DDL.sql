{\rtf1\ansi\ansicpg1252\cocoartf2639
\cocoatextscaling0\cocoaplatform0{\fonttbl\f0\fswiss\fcharset0 Helvetica;}
{\colortbl;\red255\green255\blue255;}
{\*\expandedcolortbl;;}
\margl1440\margr1440\vieww11520\viewh8400\viewkind0
\pard\tx566\tx1133\tx1700\tx2267\tx2834\tx3401\tx3968\tx4535\tx5102\tx5669\tx6236\tx6803\pardirnatural\partightenfactor0

\f0\fs24 \cf0 -- Categories Table\
CREATE TABLE Categories (\
    Category_ID INT AUTO_INCREMENT PRIMARY KEY,\
    Category_Name VARCHAR(255) NOT NULL\
);\
\pard\tx566\tx1133\tx1700\tx2267\tx2834\tx3401\tx3968\tx4535\tx5102\tx5669\tx6236\tx6803\pardirnatural\partightenfactor0
\cf0 \
-- Products Table\
CREATE TABLE Products (\
    Product_ID INT AUTO_INCREMENT PRIMARY KEY,\
    Name VARCHAR(255) NOT NULL,\
    Description TEXT,\
    Photos VARCHAR(255),\
    Price DECIMAL(10, 2) NOT NULL,\
    Quantity_In_Stock INT NOT NULL,\
    Manufacturer VARCHAR(255),\
    Origin VARCHAR(255),\
    Category_ID INT,\
    FOREIGN KEY (Category_ID) REFERENCES Categories(Category_ID)\
);\
\
-- Users Table\
CREATE TABLE Users (\
    User_ID INT AUTO_INCREMENT PRIMARY KEY,\
    User_Name VARCHAR(255) NOT NULL,\
    Email VARCHAR(255) NOT NULL,\
    Password VARCHAR(255) NOT NULL,\
    Date_of_Birth DATE,\
    Credit_Card_Number VARCHAR(16),\
    Postal_Address TEXT\
);\
\
-- Purchase History Table\
CREATE TABLE Purchase_History (\
    Purchase_ID INT AUTO_INCREMENT PRIMARY KEY,\
    User_ID INT,\
    Product_ID INT,\
    FOREIGN KEY (User_ID) REFERENCES Users(User_ID),\
    FOREIGN KEY (Product_ID) REFERENCES Products(Product_ID)\
);\
\
-- Shopping Cart Table\
CREATE TABLE Shopping_Cart (\
    Cart_Product_ID INT AUTO_INCREMENT PRIMARY KEY,\
    User_ID INT,\
    Product_ID INT,\
    FOREIGN KEY (User_ID) REFERENCES Users(User_ID),\
    FOREIGN KEY (Product_ID) REFERENCES Products(Product_ID)\
);\
\
}