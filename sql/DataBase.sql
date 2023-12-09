PRAGMA foreign_keys = ON;
.headers on
.mode columns

DROP TABLE IF EXISTS Person;
DROP TABLE IF EXISTS Client;
DROP TABLE IF EXISTS Employee;
DROP TABLE IF EXISTS Shop;
DROP TABLE IF EXISTS Purchase;

DROP TABLE IF EXISTS Category;
DROP TABLE IF EXISTS Product;

DROP TABLE IF EXISTS DeliveryCenter;
DROP TABLE IF EXISTS Reparation;
DROP TABLE IF EXISTS Facility;
DROP TABLE IF EXISTS ProductPurchase;
DROP TABLE IF EXISTS PurchaseShop;
DROP TABLE IF EXISTS ReparationFacility;
 
 
CREATE TABLE Person (
    vat INTEGER PRIMARY KEY,
    name_ TEXT NOT NULL,
    phone_number TEXT NOT NULL,
    email TEXT NOT NULL
);
 
 
CREATE TABLE Client (
    vat INTEGER PRIMARY KEY REFERENCES Person,
    address_ TEXT NOT NULL,
    delivery_center INTEGER NOT NULL REFERENCES DeliveryCenter 
);
 
 
CREATE TABLE Employee (
    vat INTEGER PRIMARY KEY REFERENCES Person,
    ein INTEGER NOT NULL, 
    shop INTEGER NOT NULL REFERENCES Shop
);
 
 
CREATE TABLE Shop (
    id INTEGER PRIMARY KEY,
    address_ TEXT NOT NULL, 
    email TEXT NOT NULL,
    reparation INTEGER NOT NULL REFERENCES Reparation
);
 
 
CREATE TABLE Purchase (
    number_ INTEGER PRIMARY KEY,
    price INTEGER NOT NULL CHECK(price > 0),
    date_ INTEGER NOT NULL,
    client TEXT NOT NULL REFERENCES Client
);

CREATE TABLE Category (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  name TEXT NOT NULL
); 
 
CREATE TABLE Product (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    category INTEGER NOT NULL REFERENCES Category,
    model TEXT NOT NULL,
    specs TEXT NOT NULL,
    photo TEXT NOT NULL,
    /*serial_number TEXT NOT NULL AUTOINCREMENT,*/
    price FLOAT NOT NULL
    /*reparation INTEGER NOT NULL REFERENCES Reparation */
);


 
CREATE TABLE DeliveryCenter (
    id INTEGER PRIMARY KEY,
    name_ TEXT NOT NULL UNIQUE,
    address_ TEXT NOT NULL UNIQUE 
);
 
 
CREATE TABLE Reparation (
    id INTEGER PRIMARY KEY,
    date_ TEXT NOT NULL,
    facility INTEGER NOT NULL REFERENCES Facility 
);
 
 
CREATE TABLE Facility (
    id INTEGER PRIMARY KEY,
    address_ TEXT NOT NULL UNIQUE
);
 
 
CREATE TABLE ProductPurchase (
    purchase INTEGER NOT NULL REFERENCES Purchase,
    product INTEGER NOT NULL REFERENCES Product,
    quantity INTEGER NOT NULL CHECK (quantity IS NULL OR quantity > 0),
    PRIMARY KEY(purchase, product)
);
 
 
 
CREATE TABLE PurchaseShop (
    shop TEXT NOT NULL REFERENCES Shop,
    purchase INTEGER NOT NULL REFERENCES Purchase,
    PRIMARY KEY(shop, purchase)
);
 
 
CREATE TABLE ReparationFacility (
    facility INTEGER NOT NULL REFERENCES Facility,
    reparation INTEGER NOT NULL REFERENCES Reparation,
    budget INTEGER NOT NULL CHECK (budget IS NULL OR budget > 0),
    PRIMARY KEY(facility, reparation)
);



-- Insert Categories
INSERT INTO Category (name) VALUES ('Laptops');
INSERT INTO Category (name) VALUES ('Smartphones');
INSERT INTO Category (name) VALUES ('Tablets');
INSERT INTO Category (name) VALUES ('Accessories');

-- Insert Laptops
INSERT INTO Product (category, model, price, specs, photo) VALUES (1, 'MacBook Air 13', '1489', '2022 | M2 | 8GB | 512GB SSD | GPU 10-Core | Cinzento Sideral','C1');
INSERT INTO Product (category, model, price, specs, photo) VALUES (1, 'Gaming Laptop MSI Katana 15 B13VGK-1649PT', '1659.99', '15.6 | GeForce RTX 4070 | Intel® Core™ i9-13900H | 32GB | 1TB','C2');
INSERT INTO Product (category, model, price, specs, photo) VALUES (1, 'Laptop HP Pavilion Plus 14-eh1004np', '849.99', '14 | EVO i5-1340P | 16GB | 512GB | Prateado natural','C3');
INSERT INTO Product (category, model, price, specs, photo) VALUES (1, 'Laptop Lenovo IdeaPad Gaming 3 15ACH6', '849.99', '15.6" | R5-5500H | 16 GB | 512 GB SSD | RTX 2050 | Win11','C4');
INSERT INTO Product (category, model, price, specs, photo) VALUES (1, 'Laptop Lenovo Yoga 7 14IRL8', '1499.99', '14 | Intel® EVO Core™ i7-1360P | 16GB | 1TB','C5');
INSERT INTO Product (category, model, price, specs, photo) VALUES (1, 'MacBook Pro 14', '2599', '2023 | M3 Pro 11-core | 18GB | 512GB SSD - Preto Sideral','C6');


