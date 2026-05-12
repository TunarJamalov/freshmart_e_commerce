# FreshMart E-commerce

FreshMart is a Laravel-based e-commerce project built to practice real backend development workflows, admin management, user accounts, cart logic, checkout, coupons, orders, and payment integrations.

## Features

- Product listing and product detail pages
- Cart add, update, remove, and clear
- Coupon system
- Delivery option selection
- User registration, login, profile, orders, wishlist
- Admin dashboard
- Product, category, variation, coupon, order, slider, FAQ, post, page, and subscriber management
- PayPal and Stripe payment flow
- Blog comments and replies
- Contact form and subscriber email verification

## Tech Stack

- PHP 8.2
- Laravel 12
- MySQL or SQLite
- Blade
- Tailwind CSS
- Vite
- Stripe PHP
- PayPal package

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
