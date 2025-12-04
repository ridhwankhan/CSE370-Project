# ⚡ Techie Tokkor: High-Performance E-Commerce for PC Hardware

[![Tech Stack](https://img.shields.io/badge/Stack-PHP%20|%20MySQL%20|%20JS%20|%20HTML%20|%20CSS-blue?style=for-the-badge&logo=php)](https://github.com/ridhwankhan/cse370-project)
[![Status](https://img.shields.io/badge/Status-Completed-brightgreen?style=for-the-badge)](https://github.com/ridhwankhan/cse370-project)

## 🚀 Project Overview

**Techie Tokkor** is a full-featured e-commerce platform dedicated to selling a wide range of electronic components and gaming peripherals (CPUs, GPUs, Motherboards, RAM, etc.). Built with a classic, robust **PHP** backend and a **MySQL** relational database, this project demonstrates solid foundational web development and database management skills.

The core objective was to deliver a convenient and efficient shopping experience for tech enthusiasts, offering competitive pricing and transparent product information. The system includes comprehensive user and administrative modules to manage the entire sales lifecycle.

## ✨ Key Features (Demonstrated Capabilities)

| Feature Category | Description & Technical Implementation |
| :--- | :--- |
| **Authentication & Authorization** | Secure user registration (`signup.php`), login (`login.php`), and session management (PHP Sessions). Implemented a dedicated **Admin role** (`admin1`) with restricted access to management dashboards (`dashboard.php`, `update_order_status.php`). |
| **Product Management** | **CRUD** operations (Create/Add, Read/View, Update/Edit, Delete) for product inventory via the Admin Dashboard (`add_product.php`, `edit_product.php`, `delete_product.php`, `inventory_management.php`). Inventory levels (`qtyavail`) are managed upon checkout to prevent overselling. |
| **Shopping Workflow** | Seamless **Shopping Cart** (`cart.php`) and **Wish List** (`wishlist.php`) functionality with persistent data stored in the MySQL database. Secure **Checkout** (`checkout.php`) handles order finalization, payment options (COD/Bank), and inventory reduction. |
| **Order Processing** | Comprehensive **Order Management** for users and admins. Admins can view, track, update status (Pending, Processing, Shipped, Delivered), and manage order details via the `order_management.php` admin panel. |
| **Customer Engagement** | Implemented a **Reviews and Ratings** module (`review.php`, `sproduct.php`) to allow post-purchase feedback, aiding user purchasing decisions. |

## 🛠️ Technology Stack

* **Backend:** PHP (Native, with MySQLi for database connectivity)
* **Database:** MySQL / MariaDB (Relational database management)
* **Frontend:** HTML5, CSS3, JavaScript (for client-side interactivity and validation)

## 📊 Database Schema

The relational database architecture is normalized and includes tables for all core components of an e-commerce system:

* `accounts` (Customer and Admin data, with unique constraints)
* `products` (Product details, inventory tracking (`qtyavail`))
* `orders` (Transaction details, including `status` tracking)
* `cart` (Tracks items in the customer's shopping cart)
* `wishlist` (Tracks items saved for later purchase)
* `order-details` (Links orders to specific products and quantities)
* `reviews` (Stores customer ratings and text feedback)

The full database schema and constraints are defined in the provided `TechieTokkor.sql` file.

## ⚙️ Installation and Setup

1.  **Clone** the repository.
2.  Setup a local server environment (e.g., **XAMPP, MAMP**) supporting **PHP** and **MySQL**.
3.  Create a MySQL database named `emc` (as defined in `include/connect.php`).
4.  **Import** the database schema using the `TechieTokkor.sql` file.
5.  Place the entire `website/` folder within your web server's root directory (e.g., `htdocs` or `www`).
6.  Access the project via your local host URL (e.g., `http://localhost/website/index.php`).

---
### Admin Credentials (for testing full functionality):

| Field | Value |
| :--- | :--- |
| **Username** | `admin1` |
| **Password** | `admin123` |
| **Email** | `ridwahnkhan03@gmail.com` |
