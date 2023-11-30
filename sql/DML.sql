-- CATEGORIES

-- Household
INSERT INTO categories (category_name)
VALUES ('Household');

-- Garden
INSERT INTO categories (category_name)
VALUES ('Garden');

-- PRODUCTS

-- Trash Bin
INSERT INTO products (name, description, photo, price, quantity, manufacturer, origin, category_id)
VALUES ('Trash Bin', 'A stylish and efficient waste solution for your home', 'images/products/bin.png', 19.99, 50, 'EcoLiving Solutions', 'China', 1);

-- Bowl
INSERT INTO products (name, description, photo, price, quantity, manufacturer, origin, category_id)
VALUES ('Bowl', 'A practical bowl for your kitchen needs', 'images/products/bowl.png', 9.99, 100, 'KitchenMaster', 'India', 1);

-- Broom
INSERT INTO products (name, description, photo, price, quantity, manufacturer, origin, category_id)
VALUES ('Broom', 'An effective broom for easy and green cleaning', 'images/products/broom.png', 14.99, 30, 'CleanSweeper', 'Canada', 1);

-- Wall Clock
INSERT INTO products (name, description, photo, price, quantity, manufacturer, origin, category_id)
VALUES ('Wall Clock', 'A decorative timepiece for your living room', 'images/products/clock.png', 29.99, 20, 'TimeCrafters', 'Japan', 1);

-- Coatrack
INSERT INTO products (name, description, photo, price, quantity, manufacturer, origin, category_id)
VALUES ('Coatrack', 'An elegant coatrack for organizing your coats', 'images/products/coatrack.png', 39.99, 15, 'StylishHome Furnishings', 'Mexico', 1);

-- Soap Dispenser
INSERT INTO products (name, description, photo, price, quantity, manufacturer, origin, category_id)
VALUES ('Soap Dispenser', 'A convenient soap dispenser for your bathroom', 'images/products/dispenser.png', 12.99, 40, 'BathMaster', 'China', 1);

-- Clothes Hangers
INSERT INTO products (name, description, photo, price, quantity, manufacturer, origin, category_id)
VALUES ('Clothes Hangers', 'A set of stylish hangers for your wardrobe', 'images/products/hangers.png', 7.99, 60, 'FashionHangs', 'India', 1);

-- Soap Dish
INSERT INTO products (name, description, photo, price, quantity, manufacturer, origin, category_id)
VALUES ('Soap Dish', 'A chic soap dish for your bathroom', 'images/products/holder.png', 8.99, 35, 'BathElegance', 'USA', 1);

-- Kettle
INSERT INTO products (name, description, photo, price, quantity, manufacturer, origin, category_id)
VALUES ('Kettle', 'A modern kettle for your kitchen', 'images/products/kettle.png', 34.99, 0, 'KitchenTech', 'Vietnam', 1); --Out of Stock

-- Lamp
INSERT INTO products (name, description, photo, price, quantity, manufacturer, origin, category_id)
VALUES ('Lamp', 'A stylish lamp for ambient lighting', 'images/products/lamp.png', 49.99, 18, 'LightCrafters', 'South Korea', 1);

-- Frying Pan
INSERT INTO products (name, description, photo, price, quantity, manufacturer, origin, category_id)
VALUES ('Frying Pan', 'A reliable frying pan for your kitchen', 'images/products/pan.png', 22.99, 30, 'KitchenMaster', 'USA', 1);

-- Sauce Pan
INSERT INTO products (name, description, photo, price, quantity, manufacturer, origin, category_id)
VALUES ('Sauce Pan', 'A versatile sauce pan for cooking', 'images/products/saucepan.png', 19.99, 25, 'KitchenMaster', 'USA', 1);

-- Golden Leaf Sculpture
INSERT INTO products (name, description, photo, price, quantity, manufacturer, origin, category_id)
VALUES ('Leaf Sculpture', 'A beautiful sculpture for decoration', 'images/products/sculpture.png', 59.99, 12, 'ArtCrafters', 'Italy', 1);

-- Plant Stand
INSERT INTO products (name, description, photo, price, quantity, manufacturer, origin, category_id)
VALUES ('Plant Stand', 'An elegant stand for displaying your plants', 'images/products/stand.png', 27.99, 22, 'GreenLife Designs', 'Japan', 1);

-- Steamer
INSERT INTO products (name, description, photo, price, quantity, manufacturer, origin, category_id)
VALUES ('Steamer Basket', 'An efficient bamboo steamer for your food', 'images/products/steamer.png', 32.99, 18, 'KitchenTech', 'Vietnam', 1);

-- Tooth Brush
INSERT INTO products (name, description, photo, price, quantity, manufacturer, origin, category_id)
VALUES ('Tooth Brush', 'A sustainable choice for oral hygiene', 'images/products/tbrush.png', 4.99, 50, 'EcoDental', 'China', 1);

-- Utensil Set
INSERT INTO products (name, description, photo, price, quantity, manufacturer, origin, category_id)
VALUES ('Utensil Set', 'A set of stylish kitchen utensils for your kitchen', 'images/products/utensils.png', 29.99, 15, 'KitchenStyle', 'South Korea', 1);

-- Watering Can
INSERT INTO products (name, description, photo, price, quantity, manufacturer, origin, category_id)
VALUES ('Watering Can', 'A durable watering can for your plants', 'images/products/can.png', 14.99, 35, 'GardenMaster', 'China', 2);

-- Bird Feeder
INSERT INTO products (name, description, photo, price, quantity, manufacturer, origin, category_id)
VALUES ('Bird Feeder', 'A charming bird feeder for your garden', 'images/products/feeder.png', 18.99, 25, 'NatureCrafts', 'India', 2);

-- Garden Fork
INSERT INTO products (name, description, photo, price, quantity, manufacturer, origin, category_id)
VALUES ('Garden Fork', 'An efficient fork for soil cultivation', 'images/products/fork.png', 12.99, 30, 'GardenTools', 'Japan', 2);

-- Garden Gnome
INSERT INTO products (name, description, photo, price, quantity, manufacturer, origin, category_id)
VALUES ('Garden Gnome', 'A charming gnome for garden decoration', 'images/products/gnome.png', 24.99, 20, 'GardenDecor', 'Japan', 2);

-- Hose
INSERT INTO products (name, description, photo, price, quantity, manufacturer, origin, category_id)
VALUES ('Hose', 'A convenient hose for garden watering', 'images/products/hose.png', 19.99, 0, 'GreenFlow', 'Vietnam', 2); -- Out of Stock

-- Solar Spotlight
INSERT INTO products (name, description, photo, price, quantity, manufacturer, origin, category_id)
VALUES ('Solar Spotlight', 'An efficient solar spotlight for outdoor lighting', 'images/products/spotlight.png', 28.99, 15, 'EcoLighting', 'China', 2);

-- Planter
INSERT INTO products (name, description, photo, price, quantity, manufacturer, origin, category_id)
VALUES ('Planter', 'A stylish planter for your plants', 'images/products/planter.png', 16.99, 30, 'GreenLife Designs', 'South Korea', 2);

-- Garden Rake
INSERT INTO products (name, description, photo, price, quantity, manufacturer, origin, category_id)
VALUES ('Garden Rake', 'An efficient rake for leaves', 'images/products/rake.png', 14.99, 25, 'GardenTools', 'Japan', 2);

-- Garden Scissors
INSERT INTO products (name, description, photo, price, quantity, manufacturer, origin, category_id)
VALUES ('Garden Scissors', 'Scissors for trimming plants', 'images/products/scissors.jpeg', 9.99, 35, 'GardenTools', 'Japan', 2);

-- Pruning Shears
INSERT INTO products (name, description, photo, price, quantity, manufacturer, origin, category_id)
VALUES ('Pruning Shears', 'A pair of shears for pruning', 'images/products/shears.png', 17.99, 28, 'GardenTools', 'Japan', 2);

-- Digging Spade
INSERT INTO products (name, description, photo, price, quantity, manufacturer, origin, category_id)
VALUES ('Digging Spade', 'An efficient spade for digging', 'images/products/spade.png', 15.99, 30, 'GardenTools', 'Japan', 2);

-- Plant Trimmer
INSERT INTO products (name, description, photo, price, quantity, manufacturer, origin, category_id)
VALUES ('Grass Trimmer', 'A precise trimmer for a well-groomed lawn', 'images/products/trimmer.jpeg', 74.99, 15, 'GardenTools', 'Japan', 2);

-- Planting Trowel
INSERT INTO products (name, description, photo, price, quantity, manufacturer, origin, category_id)
VALUES ('Planting Trowel', 'A convenient trowel for planting', 'images/products/trowel.png', 11.99, 40, 'GardenTools', 'Japan', 2);

-- USERS
-- Note: MD5 is used for practical purposes only; it is not recommended for secure password storage.
-- Customers
INSERT INTO users (name, email, pwd, birth_date, card_number, postal_address, admin)
VALUES ('Alice Johnson', 'alice.johnson@gmail.com', MD5('AlicePassword'), '1985-05-15', '9876543210123456', '123 Main St, Springfield, USA', false);

INSERT INTO users (name, email, pwd, birth_date, card_number, postal_address, admin)
VALUES ('Bob Smith', 'bob.smith@yahoo.com', MD5('BobPassword'), '1992-09-28', '8765432101234567', '456 Oak Ave, Manchester, UK', false);

INSERT INTO users (name, email, pwd, birth_date, card_number, postal_address, admin)
VALUES ('Eva Martinez', 'eva.martinez@hotmail.com', MD5('EvaPassword'), '1988-02-10', '7654321092345678', '789 Maple Rd, Barcelona, Spain', false);

INSERT INTO users (name, email, pwd, birth_date, card_number, postal_address, admin)
VALUES ('David Wilson', 'david.wilson@gmail.com', MD5('DavidPassword'), '1977-11-03', '6543210983456789', '101 Pine Lane, Sydney, Australia', false);

INSERT INTO users (name, email, pwd, birth_date, card_number, postal_address, admin)
VALUES ('Sophie Brown', 'sophie.brown@yahoo.com', MD5('SophiePassword'), '1995-07-22', '5432109874567890', '303 Elm Blvd, Toronto, Canada', false);

-- Admin
INSERT INTO users (name, email, pwd, birth_date, card_number, postal_address, admin)
VALUES ('Oscar Poblete', 'oscarpobletesaenz@gmail.com', MD5('OscarPassword'), '2000-11-07', '8765432109876543', '41 Carmen, Mexico', true);


-- PURCHASE HISTORY
INSERT INTO purchase_history (user_id, product_id, quantity, total_price)
VALUES (1, 1, 1, 19.99);  -- Alice Johnson purchased 1 Trash Bin

INSERT INTO purchase_history (user_id, product_id, quantity, total_price)
VALUES (2, 2, 1, 9.99);  -- Bob Smith purchased 1 Bowl

INSERT INTO purchase_history (user_id, product_id, quantity, total_price)
VALUES (3, 3, 1, 14.99);  -- Eva Martinez purchased 1 Broom

INSERT INTO purchase_history (user_id, product_id, quantity, total_price)
VALUES (4, 4, 1, 29.99);  -- David Wilson purchased 1 Wall Clock

INSERT INTO purchase_history (user_id, product_id, quantity, total_price)
VALUES (5, 5, 1, 39.99);  -- Sophie Brown purchased 1 Coatrack



-- SHOPPING CART
INSERT INTO shopping_cart (user_id, product_id)
VALUES (1, 6);  -- Alice Johnson added a Soap Dispenser to her shopping cart

INSERT INTO shopping_cart (user_id, product_id)
VALUES (1, 12); -- Alice Johnson added a Sauce Pan to her shopping cart

INSERT INTO shopping_cart (user_id, product_id)
VALUES (1, 18); -- Alice Johnson added a Watering Can to her shopping cart

INSERT INTO shopping_cart (user_id, product_id)
VALUES (2, 7);  -- Bob Smith added Clothes Hangers to his shopping cart

INSERT INTO shopping_cart (user_id, product_id)
VALUES (2, 10); -- Bob Smith added a Lamp to his shopping cart

INSERT INTO shopping_cart (user_id, product_id)
VALUES (3, 8);  -- Eva Martinez added a Soap Dish to her shopping cart

INSERT INTO shopping_cart (user_id, product_id)
VALUES (3, 16); -- Eva Martinez added a Tooth Brush to her shopping cart

INSERT INTO shopping_cart (user_id, product_id)
VALUES (4, 9);  -- David Wilson added a Kettle to his shopping cart

INSERT INTO shopping_cart (user_id, product_id)
VALUES (4, 13); -- David Wilson added a Sauce Pan to his shopping cart

INSERT INTO shopping_cart (user_id, product_id)
VALUES (5, 10); -- Sophie Brown added a Lamp to her shopping cart

INSERT INTO shopping_cart (user_id, product_id)
VALUES (5, 15); -- Sophie Brown added a Leaf Sculpture to her shopping cart

INSERT INTO shopping_cart (user_id, product_id)
VALUES (5, 20); -- Sophie Brown added a Garden Fork to her shopping cart
