# Laravel 12 CRUD Application with Vue.js and Inertia.js

This is a full-stack CRUD (Create, Read, Update, Delete) application built using **Laravel 12**, **Vue.js 3**, and **Inertia.js**. The application provides a seamless user experience with real-time updates and smooth page transitions.

## Features

- **CRUD Operations**: Create, read, update, and delete posts.
- **Inertia.js**: Uses Inertia.js for single-page application (SPA) experience with Laravel and Vue.js.
- **Responsive Design**: Built with Tailwind CSS to ensure a mobile-first, responsive UI.
- **Dark Mode**: Toggle between dark and light modes for enhanced user experience.
- **Pagination**: Handle large datasets with pagination and easy navigation.
- **Real-time UI**: Dynamically update the interface without full page reloads.

## Tech Stack

- **Backend**: Laravel 12
- **Frontend**: Vue.js 3
- **Routing**: Inertia.js for server-side routing with SPA experience
- **Styling**: Tailwind CSS
- **Database**: MySQL (or any other database of your choice)

## ✅ Prerequisites

Before you begin, make sure your system has the following installed:

- **PHP** >= 8.2
- **Composer** >= 2.x
- **Node.js** >= 20.x
- **NPM** >= 9.x (or use Yarn if preferred)
- **MySQL / PostgreSQL / SQLite** (or another DB)
- **Git**

> 💡 Recommended: Use Laravel Sail or Docker if you want an isolated environment.

## 📂 Project Setup Steps

### 1. Clone the repository

```bash
git clone https://github.com/sotam1992/laravel-vue-inertia-crud.git
cd laravel-vue-inertia-crud
```

### 2. Install backend dependencies

```bash
composer install
```

### 3. Copy `.env` file and configure database

```bash
cp .env.example .env
```
Update your `.env` file with your database credentials:

```env
DB_DATABASE=your_db_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password
```

### 4. Generate app key and run migrations

```bash
php artisan key:generate
php artisan migrate
```

### 5. Install frontend dependencies

```bash
npm install
```

### 6. Build frontend assets

```bash
npm run dev
```

### 7. Start the Laravel server

```bash
php artisan serve
```

Your application should now be accessible at `http://localhost:8000`

---

## 📚 Resources

- [Laravel Documentation](https://laravel.com/docs)
- [Vue.js Documentation](https://vuejs.org/guide/introduction.html)
- [Inertia.js Documentation](https://inertiajs.com/)
- [Tailwind CSS Documentation](https://tailwindcss.com/docs/installation)

Happy coding! 🎉

