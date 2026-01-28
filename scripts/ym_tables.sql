-- Create database
DROP DATABASE IF EXISTS ymdatabase;
CREATE DATABASE ymdatabase;
USE ymdatabase;

-- Create items table
DROP TABLE IF EXISTS items;
CREATE TABLE items (
    item_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    price DECIMAL(6,2) NOT NULL,
    category VARCHAR(50) NOT NULL,
    available ENUM('Yes','No') NOT NULL
);

-- Insert items data
INSERT INTO items (name, price, category, available) VALUES
('Kebap',4.00,'Food','Yes'),
('Pide',2.50,'Food','Yes'),
('Doner',3.00,'Food','Yes'),
('Lahmacun',2.00,'Food','Yes'),
('Bakhlava',1.50,'Dessert','Yes'),
('Kadayif',1.75,'Dessert','Yes'),
('Turkish coffee',1.00,'Drink','Yes'),
('Ayran',0.75,'Drink','Yes'),
('Meze platter',5.00,'Food','Yes'),
('Grilled fish',6.50,'Food','No');

-- Create orders table
DROP TABLE IF EXISTS orders;
CREATE TABLE orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    item_id INT NOT NULL,
    quantity INT NOT NULL,
    cost DECIMAL(8,2) NOT NULL,
    order_date DATE NOT NULL,
    FOREIGN KEY (item_id) REFERENCES items(item_id)
);

-- Insert orders data
INSERT INTO orders (item_id, quantity, cost, order_date) VALUES
(1,2,8.00,'2026-01-20'),
(3,1,3.00,'2026-01-21'),
(5,4,6.00,'2026-01-21'),
(2,3,7.50,'2026-01-22'),
(4,2,4.00,'2026-01-22'),
(6,1,1.75,'2026-01-23'),
(7,3,3.00,'2026-01-23'),
(8,2,1.50,'2026-01-24'),
(9,1,5.00,'2026-01-24'),
(10,1,6.50,'2026-01-25');
