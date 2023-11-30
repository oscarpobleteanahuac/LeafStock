-- Categories table
CREATE TABLE categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(255) NOT NULL
);

-- Products table
CREATE TABLE products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    photo VARCHAR(255),
    price DECIMAL(10, 2) NOT NULL,
    quantity INT NOT NULL,
    manufacturer VARCHAR(255),
    origin VARCHAR(255),
    category_id INT,
    FOREIGN KEY (category_id) REFERENCES categories(category_id)
);

-- Users table
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    pwd VARCHAR(255) NOT NULL,
    birth_date DATE,
    card_number VARCHAR(16),
    postal_address TEXT,
    admin BOOLEAN DEFAULT false NOT NULL
);

-- Purchase History table
CREATE TABLE purchase_history (
    purchase_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    product_id INT,
    quantity INT,
    total_price DECIMAL(10, 2),  -- Adjust precision as needed
    purchase_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (product_id) REFERENCES products(product_id)
);


-- Shopping Cart table
CREATE TABLE shopping_cart (
    cart_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    product_id INT,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (product_id) REFERENCES products(product_id)
);