PRAGMA foreign_keys = ON;
.headers on
.mode columns


DROP TABLE IF EXISTS Client;
DROP TABLE IF EXISTS Purchase;
DROP TABLE IF EXISTS Category;
DROP TABLE IF EXISTS Product;
DROP TABLE IF EXISTS Reparation;
DROP TABLE IF EXISTS Facility;
DROP TABLE IF EXISTS ReparationFacility;
DROP TABLE IF EXISTS Favorites;
DROP TABLE IF EXISTS Return;
DROP TABLE IF EXISTS Purchase_Products;
DROP TABLE IF EXISTS user_messages;
 

 CREATE TABLE Return (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    date_ TEXT NOT NULL,
    purchase_number INTEGER NOT NULL REFERENCES Purchase(number_),
    product_id INTEGER NOT NULL REFERENCES Product(id),
    quantity INTEGER NOT NULL CHECK(quantity > 0)
);

CREATE TABLE Client (
    username TEXT PRIMARY KEY,
    password TEXT,
    vat INTEGER ,
    address_ TEXT NOT NULL
);
 
CREATE TABLE Purchase (
    number_ INTEGER PRIMARY KEY,
    price INTEGER NOT NULL CHECK(price > 0),
    date_ INTEGER NOT NULL,
    client TEXT NOT NULL REFERENCES Client,
    delivery_option TEXT NOT NULL
);


CREATE TABLE Purchase_Products (
    purchase_number INTEGER REFERENCES Purchase,
    product_id INTEGER REFERENCES Product,
    quantity INTEGER NOT NULL CHECK(quantity > 0),
    PRIMARY KEY (purchase_number, product_id)
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
    price FLOAT NOT NULL
    
);
 
CREATE TABLE Reparation (
    id INTEGER PRIMARY KEY,
    date_ TEXT NOT NULL,
    client TEXT NOT NULL REFERENCES Client, 
    status TEXT NOT NULL DEFAULT 'Evaluating',
    device_type TEXT NOT NULL,
    brand TEXT NOT NULL,
    serial_number TEXT NOT NULL,
    reported_issue TEXT NOT NULL,
    budget INTEGER NOT NULL,
    shipping_code INTEGER NOT NULL
);

CREATE TABLE ReparationFacility (
    facility INTEGER NOT NULL REFERENCES Facility,
    reparation INTEGER NOT NULL REFERENCES Reparation,
    PRIMARY KEY(facility, reparation)
);
 
CREATE TABLE Facility (
    id INTEGER PRIMARY KEY,
    address_ TEXT NOT NULL UNIQUE
); 
 
CREATE TABLE Favorites (
    username TEXT,
    id INTEGER,
    PRIMARY KEY (username, id),
    FOREIGN KEY (username) REFERENCES Users(username),
    FOREIGN KEY (id) REFERENCES Product(id)
);

CREATE TABLE user_messages (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username NOT NULL,
    name NOT NULL,
    email NOT NULL,
    message TEXT NOT NULL,
    submission_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


INSERT INTO Category (name) VALUES ('Laptops');
INSERT INTO Category (name) VALUES ('Smartphones');
INSERT INTO Category (name) VALUES ('Tablets');
INSERT INTO Category (name) VALUES ('Accessories');

INSERT INTO Product (category, model, price, specs) VALUES (1, 'MacBook Air 13', '1489', '2022 | M2 | 8GB | 512GB SSD | GPU 10-Core | Cinzento Sideral');
INSERT INTO Product (category, model, price, specs) VALUES (1, 'Gaming Laptop MSI Katana 15 B13VGK-1649PT', '1659.99', '15.6 | GeForce RTX 4070 | Intel® Core™ i9-13900H | 32GB | 1TB');
INSERT INTO Product (category, model, price, specs) VALUES (1, 'Laptop HP Pavilion Plus 14-eh1004np', '849.99', '14 | EVO i5-1340P | 16GB | 512GB | Prateado natural');
INSERT INTO Product (category, model, price, specs) VALUES (1, 'Laptop Lenovo IdeaPad Gaming 3 15ACH6', '849.99', '15.6" | R5-5500H | 16 GB | 512 GB SSD | RTX 2050 | Win11');
INSERT INTO Product (category, model, price, specs) VALUES (1, 'Laptop Lenovo Yoga 7 14IRL8', '1499.99', '14 | Intel® EVO Core™ i7-1360P | 16GB | 1TB');
INSERT INTO Product (category, model, price, specs) VALUES (1, 'MacBook Pro 14', '2599', '2023 | M3 Pro 11-core | 18GB | 512GB SSD - Preto Sideral');

INSERT INTO Product (category, model, price, specs) VALUES (2, 'Apple iPhone 13', '569.99', '128GB - Meia-Noite - Recondicionado - Grade C');
INSERT INTO Product (category, model, price, specs) VALUES (2, 'Apple iPhone 14 Pro Max', '1249.99', '256GB - Preto Sideral - Recondicionado - Grade A');
INSERT INTO Product (category, model, price, specs) VALUES (2, 'Samsung Galaxy A04S', '129.99', '32GB - Preto');
INSERT INTO Product (category, model, price, specs) VALUES (2, 'Samsung Galaxy S23', '879.99', '5G 256GB - Preto');
INSERT INTO Product (category, model, price, specs) VALUES (2, 'Samsung Galaxy A14', '189.99', '128GB - Preto');
INSERT INTO Product (category, model, price, specs) VALUES (2, 'Samsung Galaxy A54', '439.99', '5G - 128GB - Graphite');

INSERT INTO Product (category, model, price, specs) VALUES (3, 'Apple iPad Pro 11.0\', '1099', '256GB - WiFi - Prateado');
INSERT INTO Product (category, model, price, specs) VALUES (3, 'Apple iPad 10.2\', '579', 'Wi-Fi - 256GB - Prateado');
INSERT INTO Product (category, model, price, specs) VALUES (3, 'Tablet Lenovo Tab P11 TB350FU', '399.99', '128GB Wi-Fi + Capa + Teclado + Precision Pen 2');
INSERT INTO Product (category, model, price, specs) VALUES (3, 'Tablet Samsung Galaxy Tab S9 FE+ 12.4', '699.99', '128GB - Gray');
INSERT INTO Product (category, model, price, specs) VALUES (3, 'Lenovo Tab M10 Plus TB128FU', '219.99', '128 GB - Wi-Fi - Cinzento - 2023');
INSERT INTO Product (category, model, price, specs) VALUES (3, 'Tablet Lenovo Tab M9 TB310FU', '159.99', '64GB - Wi-Fi - Arctic Grey + Capa');

INSERT INTO Product (category, model, price, specs) VALUES (4, 'Auscultadores Bluetooth Marshall Major IV', '99.99', 'Preto');
INSERT INTO Product (category, model, price, specs) VALUES (4, 'Auscultadores Bluetooth Audio-Technica ATH-S220BT', '69.99', 'Preto');
INSERT INTO Product (category, model, price, specs) VALUES (4, 'Rato Gaming Razer', '24.99', 'Fio DeathAdder Essentia');
INSERT INTO Product (category, model, price, specs) VALUES (4, 'Rato Bluetooth Logitech MX Master 3S', '99.99', 'Graphite');
INSERT INTO Product (category, model, price, specs) VALUES (4, 'Teclado Bluetooth Ewent Slim', '19.99', 'PT- Prateado');
INSERT INTO Product (category, model, price, specs) VALUES (4, 'Teclado Gaming Razer Huntsman Mini RGB', '99.99', 'Red Switches - Branco');

INSERT INTO Facility (id, address_) VALUES (1, 'Porto');
INSERT INTO Facility (id, address_) VALUES (2, 'Lisboa');
INSERT INTO Facility (id, address_) VALUES (3, 'Faro');
