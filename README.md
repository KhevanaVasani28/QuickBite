# 🍕 QuickBite - Online Food Ordering Website

A full-stack **online food ordering web application** built with **HTML, CSS, Vanilla JavaScript, PHP, and MySQL**. QuickBite lets customers browse a menu, add items to a cart, register/login, and place orders with a simple checkout flow.

![PHP](https://img.shields.io/badge/PHP-8.x-blue)
![MySQL](https://img.shields.io/badge/MySQL-8.x-orange)
![JavaScript](https://img.shields.io/badge/JavaScript-ES6-yellow)

---

## 📖 Overview

QuickBite simulates a real-world online food delivery experience. Users can explore categories (Indian, Mexican, Italian, Chinese, Beverages), view food items, manage a shopping cart, and place Cash-on-Delivery orders. The project demonstrates frontend development with vanilla JS, REST-style PHP endpoints, session-based authentication, and MySQL database integration.

---

## ✨ Features

- 🔐 **User Authentication** - Register and login system with secure password hashing
- 🏠 **Home Page** — Hero banner, popular categories, and featured food items
- 🍽️ **Food Categories** - Browse Indian, Mexican, Italian, Chinese, and Beverages
- 🛒 **Shopping Cart** - Add, update quantity, and remove items
- 💳 **Checkout** — Enter delivery details, view order summary (subtotal + delivery + tax), and place order
- 🔐 **Session Management** — Login state maintained via PHP sessions
- 📱 **Fully Responsive** - Works perfectly on desktop, tablet, and mobile
- 🎨 **Modern UI** - Clean and attractive interface
- ⚡ **AJAX Powered** - Smooth, no-reload experience

---

## 🛠️ Tech Stack

| Technology | Purpose |
|------------|---------|
| **HTML5** | Structure |
| **CSS3** | Styling & Responsive Design |
| **JavaScript (ES6+)** | Client-side interactivity |
| **PHP 7+** | Server-side logic |
| **MySQL** | Database |
| **AJAX/Fetch API** | Asynchronous requests |
| **LocalStorage** | Cart persistence |

---

## 📁 Folder Structure

```
QuickBite/
│
├── index.html              # Homepage with categories & popular items
├── menu.html               # Full menu with category filters
├── cart.html               # Shopping cart
├── checkout.html           # Checkout & payment
├── order_success.html      # Order confirmation page
├── login.html              # User login
├── register.html           # User registration
│
├── css/
│   └── style.css           # Main stylesheet
│
├── js/
│   ├── script.js           # Main JavaScript (menu, categories)
│   └── cart.js             # Cart functionality
│
├── php/
│   ├── db_connect.php      # Database connection
│   ├── register_user.php   # User registration handler
│   ├── login_user.php      # User login handler
│   ├── fetch_categories.php # Returns all categories (JSON)
│   ├── fetch_food_items.php # Returns food items (JSON)
│   └── place_order.php     # Order placement handler
│
├── assets/
│   └── images/
│       ├── categories/
|       |   ├── chinese.jpg
|       |   ├── italian.jpg
|       |   └── .....
|       |
│       ├── food/
|       |   ├── cold-coffee.jpg
|       |   ├── manchurian.jpg
|       |   └── .....
|       |
│       ├── default-category.jpg
│       └──default-food.jpg
|
├── .gitignore
└── README.md
```

---

## 🚀 Installation & Setup

### Prerequisites

- **XAMPP** (or MAMP/WAMP) installed
- **MySQL** running
- **PHP 7.0+**
- Modern web browser

### Step 1: Clone the Repository

```bash
git clone https://github.com/KhevanaVasani28/QuickBite.git
cd QuickBite.git
```

### Step 2: Move to XAMPP htdocs

```bash
# For Windows XAMPP
copy online-food-ordering C:\xampp\htdocs\
```

### Step 3: Set Up the Database

1. Open **phpMyAdmin** at `http://localhost:8888/phpMyAdmin/`
2. Click on the **SQL** tab
3. Copy and paste the contents of Database Schema given below. Also add the data nto the tables (Example given below).
4. Click **Go** to execute

### Step 4: Configure Database Connection

Open `php/db_connect.php` and update if needed:
(For XAMPP)
```php
$host = 'localhost';
$username = 'root';
$password = '';       
$database = 'food_ordering';
$port = 3306;              
```

### Step 5: Run the Website

Open XAMPP control panel and start Apache and MySQL. Now open the browser and write:

```
http://localhost:8888/QuickBite/index.html
```

---

## 🗄️ Database Schema and Example input

```sql
CREATE DATABASE food_ordering;
USE food_ordering;

-- Users table
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(15),
    address TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Categories table
CREATE TABLE categories (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    image VARCHAR(255),
    description TEXT
);

-- Food items table
CREATE TABLE food_items (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    image VARCHAR(255),
    category_id INT,
    is_available BOOLEAN DEFAULT TRUE,
    food_type ENUM('veg', 'non-veg', 'vegan') DEFAULT 'veg',
    preparation_time INT DEFAULT 20,
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

-- Orders table
CREATE TABLE orders (
    id INT PRIMARY KEY AUTO_INCREMENT,
    customer_id INT,
    total_amount DECIMAL(10,2) NOT NULL,
    delivery_address TEXT NOT NULL,
    payment_method VARCHAR(20),
    status ENUM('pending', 'confirmed', 'preparing', 'out_for_delivery', 'delivered', 'cancelled') DEFAULT 'pending',
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    estimated_delivery TIME,
    instructions TEXT,
    FOREIGN KEY (customer_id) REFERENCES users(id)
);

-- Order items table
CREATE TABLE order_items (
    id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT,
    food_item_id INT,
    quantity INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (food_item_id) REFERENCES food_items(id)
);
```

```sql
INSERT INTO categories (name, description, image) VALUES
('Indian',    'Spicy and flavorful Indian dishes', 'assets/images/categories/indian.jpg'),
('Mexican',   'Tacos, burritos and more',           'assets/images/categories/mexican.jpg'),
('Italian',   'Pizza, pasta and more',              'assets/images/categories/italian.jpg'),
('Chinese',   'Noodles, dumplings and more',        'assets/images/categories/chinese.jpg'),
('Beverages', 'Refreshing drinks',                  'assets/images/categories/beverages.jpg');

INSERT INTO food_items (category_id, name, description, price, image, food_type, preparation_time) VALUES
(1, 'Chicken Biryani',  'Aromatic basmati rice with chicken', 249.00, 'assets/images/food/biryani.jpg', 'non-veg', 30),
(2, 'Veg Tacos',        'Crispy tacos with veggies and salsa', 149.00, 'assets/images/food/tacos.jpg',   'veg',     15),
(3, 'Margherita Pizza', 'Classic cheese pizza',                199.00, 'assets/images/food/pizza.jpg',   'veg',     20),
(4, 'Hakka Noodles',    'Stir-fried noodles with veggies',     129.00, 'assets/images/food/noodles.jpg', 'veg',     15),
(5, 'Cold Coffee',      'Chilled coffee with ice cream',        99.00, 'assets/images/food/coffee.jpg',  'veg',      5);
```

## 🔌 API Endpoints

| Endpoint | Method | Description |
|----------|--------|-------------|
| `php/register_user.php` | POST | Register a new user |
| `php/login_user.php` | POST | Login existing user |
| `php/fetch_categories.php` | GET | Get all food categories |
| `php/fetch_food_items.php` | GET | Get all food items (or filter by `?category_id=`) |
| `php/place_order.php` | POST | Place a new order |
| `php/check_session.php` | GET | Get the current session status |

---

## 🎯 How to Use

1. **Register** a new account at `register.html`
2. **Login** with your credentials
3. **Browse** categories and food items
4. **Add items** to cart by clicking "Add to Cart"
5. **View cart** and adjust quantities
6. **Proceed to checkout** and enter delivery details
7. **Place order** and see the success message

---

## 🧪 Testing

### Test Database Connection
Create a file `test.php` in the root:

```php
<?php
include 'php/db_connect.php';
echo "Database connected successfully!<br>";

$result = $conn->query("SELECT COUNT(*) as count FROM categories");
$row = $result->fetch_assoc();
echo "Categories: " . $row['count'] . "<br>";

$result = $conn->query("SELECT COUNT(*) as count FROM food_items");
$row = $result->fetch_assoc();
echo "Food Items: " . $row['count'];
?>
```

Visit `http://localhost:8888/online-food-ordering/test.php`

---

## 🐛 Troubleshooting

| Issue | Solution |
|-------|----------|
| **Database connection failed** | Check MAMP MySQL port (default 8889) and password ('root') |
| **Images not showing** | Ensure `images/` folder exists or use online image URLs |
| **Categories not loading** | Open browser console (F12) to check for JavaScript errors |
| **404 on PHP files** | Ensure you're accessing via `http://localhost:8888/` (not `file://`) |
| **Login not working** | Clear browser cache and try again |

---

## 🔒 Security Features

- ✅ **Password Hashing** with `password_hash()`
- ✅ **SQL Injection Prevention** with `real_escape_string()`
- ✅ **Session Management** for authentication
- ✅ **Input Validation** on all forms
- ✅ **XSS Protection** with `htmlspecialchars()`

---

## 📈 Future Enhancements

- [ ] Order tracking with live status updates
- [ ] Admin panel for managing items
- [ ] Email notifications
- [ ] Razorpay/Stripe integration
- [ ] User profile & order history
- [ ] Coupon & discount system
- [ ] Ratings & reviews
- [ ] Real-time GPS delivery tracking

---
