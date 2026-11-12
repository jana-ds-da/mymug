# My Mug — Full-Stack E-commerce & Store Management System

![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?style=flat&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=flat&logo=php&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-4-06B6D4?style=flat&logo=tailwindcss&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-ES6+-F7DF1E?style=flat&logo=javascript&logoColor=black)
![MySQL](https://img.shields.io/badge/Database-Laravel_Configured-4479A1?style=flat&logo=database&logoColor=white)

## Overview

**My Mug** is a full-stack e-commerce and store management web application built with Laravel. It provides a complete shopping experience for customers and a management system for administrators.

The platform includes product browsing, product details, shopping cart management, checkout, order tracking, receipt generation, and an administrative dashboard for managing products, users, roles, permissions, categories, departments, and orders.

The application also supports English and Arabic interfaces, including right-to-left (RTL) layouts.

---

## Main Features

### 1. Customer Storefront

- Home page with store presentation.
- About page.
- Product collections and browsing.
- Product details pages.
- Product catalog and category-based organization.
- Shopping cart.
- Add products to cart.
- Increase and decrease product quantities.
- Remove individual cart items.
- Empty cart functionality.
- Checkout process.
- Order receipt page.
- Customer order history.
- User registration and login.
- Logout functionality.

### 2. Admin Dashboard

The administrative dashboard provides management tools for the store.

**Dashboard**
- Centralized dashboard.
- Sales and order overview.
- Store management interface.

**Product Management**
- View and manage products.
- Add products.
- Update product information.
- Delete products.
- Organize products by categories.

**Order Management**
- View all customer orders.
- View individual order details.
- Update order status.
- Delete orders.
- View personal customer orders.

**User Management**
- View users.
- Create new users.
- Edit user information.
- Delete users.
- Assign roles and departments.

**Role & Permission Management**
- View available roles.
- Create roles.
- Edit roles.
- Delete roles.
- Manage role-based access and permissions.

**Category Management**
- View categories.
- Create categories.
- Edit categories.
- Delete categories.
- Support for translated category data.

**Department Management**
- View departments.
- Create departments.
- Edit departments.
- Delete departments.

### 3. Authentication & Authorization

- User registration.
- User login and logout.
- Protected routes.
- Role-based access control.
- Permission-based access control.
- Separate access levels for customers and administrators.

### 4. Multilingual Support

- English language.
- Arabic language.
- Language switching.
- RTL layout support.
- Translatable products and categories.

### 5. Order & Checkout System

- Shopping cart integration.
- Checkout form.
- Order creation.
- Order items management.
- Order status tracking.
- Receipt generation.
- Printable receipt page.
- New order email template.

---

## Application Pages

The following pages are based on the Blade views and application routes in the main project.

### Customer Pages

| Page | Description |
|---|---|
| Home | Main storefront landing page |
| About | Store information |
| Collection | Product collection and browsing |
| Product Details | Individual product information |
| Cart | Shopping cart management |
| Checkout | Customer checkout |
| Receipt | Order receipt |
| Login | Customer authentication |
| Signup | New customer registration |
| My Orders | Customer order history |

### Admin & Management Pages

| Page | Description |
|---|---|
| Dashboard | Administrative overview |
| Products Management | Product administration |
| All Orders | View all customer orders |
| Order Details | Individual order information |
| Users Management | View and manage users |
| Create User | Add a new user |
| Edit User | Update user information |
| Roles Management | View and manage roles |
| Create Role | Create a new role |
| Categories Management | View and manage categories |
| Category Form | Create or edit a category |
| Departments Management | View and manage departments |
| Department Form | Create or edit a department |

### Shared Views & Templates

- Main application layout.
- Navigation bar component.
- Welcome page.
- New order email template.

---

## Technology Stack

### Backend
- PHP 8.2+
- Laravel 12
- Laravel Eloquent ORM
- Laravel Authentication
- Laravel Sanctum package
- Spatie Laravel Permission
- Astrotomic Laravel Translatable
- Yajra Laravel DataTables

### Frontend
- HTML5
- CSS3
- JavaScript
- Blade Templates
- Tailwind CSS 4
- Vite
- jQuery
- DataTables
- Font Awesome

### Database
- Laravel database configuration.
- Eloquent ORM.
- Database migrations.
- Relational data models.

---

## Database Models

The main application includes the following Eloquent models:

| Model | Responsibility |
|---|---|
| User | User accounts and authentication |
| Product | Store products |
| ProductTranslation | Translated product information |
| Category | Product categories |
| CategoryTranslation | Translated category information |
| Department | User departments |
| CartItem | Shopping cart items |
| Order | Customer orders |
| OrderItem | Products associated with orders |

The application also uses database tables for Laravel permissions, roles, caching, and background jobs.

---

## Project Structure

```text
newproject/
│
├── app/
│   ├── DataTables/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php
│   │   │   ├── CartController.php
│   │   │   ├── CategoryController.php
│   │   │   ├── CheckoutController.php
│   │   │   ├── CollectionController.php
│   │   │   ├── DashboardController.php
│   │   │   ├── DepartmentController.php
│   │   │   ├── OrderController.php
│   │   │   ├── ProductController.php
│   │   │   ├── ReceiptController.php
│   │   │   ├── RoleController.php
│   │   │   └── UserController.php
│   │   └── Middleware/
│   └── Models/
│
├── database/
│   ├── migrations/
│   └── seeders/
│
├── resources/
│   ├── views/
│   │   ├── admin/
│   │   ├── category/
│   │   ├── departments/
│   │   ├── emails/
│   │   ├── layouts/
│   │   ├── orders/
│   │   ├── roles/
│   │   ├── users/
│   │   ├── components/
│   │   ├── home.blade.php
│   │   ├── about.blade.php
│   │   ├── collection.blade.php
│   │   ├── product.blade.php
│   │   ├── cart.blade.php
│   │   ├── checkout.blade.php
│   │   ├── receipt.blade.php
│   │   ├── login.blade.php
│   │   └── signup.blade.php
│   │
│   ├── css/
│   └── js/
│
├── routes/
│   ├── web.php
│   └── api.php
│
├── public/
├── storage/
├── tests/
├── composer.json
├── package.json
├── vite.config.js
└── README.md
```

---

## Installation & Setup

### Requirements

- PHP 8.2 or higher.
- Composer.
- Node.js and npm.
- A supported database.
- XAMPP or another local development environment.

### 1. Clone the Repository

```bash
git clone https://github.com/jana-ds-da/My_Mug_updated.git
cd My_Mug_updated
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install Frontend Dependencies

```bash
npm install
```

### 4. Configure Environment

```bash
cp .env.example .env
```

Configure your database connection and other environment variables inside `.env`.

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Run Database Migrations

```bash
php artisan migrate
```

### 7. Build Frontend Assets

```bash
npm run build
```

For development:

```bash
npm run dev
```

### 8. Start the Laravel Server

```bash
php artisan serve
```

Open the application at:

```text
http://127.0.0.1:8000
```

---

## Security & Access Control

The application uses authentication and authorization mechanisms to protect administrative functionality.

- Authenticated access to protected customer features.
- Permission-protected dashboard routes.
- Role-protected customer order history.
- Permission-based user management.
- Permission-based role management.
- Permission-based department management.
- Order access and management restrictions.

---

## Important Notes

- Configure your database before running migrations.
- Configure mail settings in the `.env` file to enable order email notifications.
- Configure the appropriate payment provider before using real online payment processing.
- Never upload `.env`, credentials, API keys, or other sensitive configuration files to a public repository.
- Run `php artisan storage:link` if the application uses Laravel's public storage disk.
- The repository contains a nested `mymug/` directory with a separate Laravel project/repository. The main project documentation above describes the root `newproject/` application. Check the nested repository separately if you intend to publish both applications together.

---

## Future Improvements

- Integrate a production-ready online payment gateway.
- Add advanced sales and analytics reports.
- Improve product search and filtering.
- Add product reviews and ratings.
- Add automated testing for core shopping workflows.
- Improve performance and caching.
- Add inventory and stock management.

---

## Author

**Jana Muhammad**

GitHub: [@jana-ds-da](https://github.com/jana-ds-da)

Project Repository: [My Mug — My_Mug_updated](https://github.com/jana-ds-da/My_Mug_updated)

---

## License

This project is developed for educational and portfolio purposes. Add a formal license if you intend to distribute or reuse it publicly.
