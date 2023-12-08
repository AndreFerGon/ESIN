PRAGMA foreign_keys = ON;
.headers on
.mode columns

DROP TABLE IF EXISTS Person;
DROP TABLE IF EXISTS Client;
DROP TABLE IF EXISTS Employee;
DROP TABLE IF EXISTS Shop;
DROP TABLE IF EXISTS Purchase;
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



INSERT INTO Category (name) VALUES ('Computer');
INSERT INTO Category (name) VALUES ('SmartPhone');
INSERT INTO Category (name) VALUES ('Tablet');
INSERT INTO Category (name) VALUES ('Accessories');

 

INSERT INTO Product (category, model, price) VALUES (1, 'PC1', '10');
INSERT INTO Product (category, model, price) VALUES (1, 'PC2', '11');
INSERT INTO Product (category, model, price) VALUES (1, 'PC3', '12');
INSERT INTO Product (category, model, price) VALUES (1, 'PC4', '13');
INSERT INTO Product (category, model, price) VALUES (2, 'S1', '20');
INSERT INTO Product (category, model, price) VALUES (2, 'S2', '21');
INSERT INTO Product (category, model, price) VALUES (2, 'S3', '22');
INSERT INTO Product (category, model, price) VALUES (3, 'T1', '30');
INSERT INTO Product (category, model, price) VALUES (3, 'T2', '31');
INSERT INTO Product (category, model, price) VALUES (3, 'T3', '32');
INSERT INTO Product (category, model, price) VALUES (4, 'A1', '40');
INSERT INTO Product (category, model, price) VALUES (4, 'A2', '41');
INSERT INTO Product (category, model, price) VALUES (4, 'A3', '42');