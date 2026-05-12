# FreshMart E-commerce

FreshMart is a Laravel-based e-commerce project built as part of my PHP/Laravel portfolio. The goal of this project is to practice real backend workflows such as product management, cart logic, checkout, orders, coupons, user accounts, admin management, and payment integrations.

## Features

- Product listing and product detail pages
- Product categories, variations, and additional product information
- Cart add, update, remove, and clear actions
- Coupon system
- Delivery option selection
- User registration, login, profile, wishlist, orders, and invoices
- Admin dashboard
- Admin management for users, products, categories, coupons, delivery options, orders, ratings, sliders, FAQ, posts, pages, subscribers, and settings
- PayPal and Stripe payment flow
- Blog posts, comments, and replies
- Contact form
- Subscriber email verification

## Tech Stack

- PHP 8.2+
- Laravel 12
- MySQL or SQLite
- Blade
- Tailwind CSS
- Vite
- Composer
- NPM
- PayPal integration
- Stripe PHP

## Installation

```bash
git clone https://github.com/TunarJamalov/freshmart_e_commerce.git
cd freshmart_e_commerce
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm run dev
php artisan serve
```

## Environment

Update your `.env` file with your database, mail, PayPal, and Stripe credentials when needed.

Example database setup:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=freshmart
DB_USERNAME=root
DB_PASSWORD=
```

## Project Purpose

This project is not presented as a finished commercial product. It is a learning and portfolio project where I practice Laravel, backend structure, database relationships, admin workflows, and real e-commerce features.

## Current Improvement Goals

- Improve code organization and reduce repeated controller logic
- Add more validation with Form Request classes
- Add basic feature tests
- Improve seeders and demo data
- Add screenshots to this README
- Add Docker setup for easier local development

## Author

Tunar Camalov  
Junior PHP/Laravel Developer from Azerbaijan
