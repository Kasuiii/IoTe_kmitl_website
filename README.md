# IoTe_kmitl_website 🌐

A website project for Mobile application development course of **IoT Engineering Major** at KMITL, built with Laravel, MySQL, Tailwind CSS, and Flowbite.

---

## 🛠️ Tech Stack

| Layer        | Technology              |
| ------------ | ----------------------- |
| Frontend     | Tailwind CSS + Flowbite |
| Backend      | Laravel (PHP)           |
| Database     | MySQL                   |
| Local Server | XAMPP                   |

---

## 📋 Prerequisites

Make sure you have all of these following installed before getting started:

- [PHP](https://www.php.net/) >= 8.1
- [Composer](https://getcomposer.org/)
- [Node.js](https://nodejs.org/) >= 18.x & npm
- [XAMPP](https://www.apachefriends.org/) (includes Apache + MySQL)
- [Git](https://git-scm.com/)

---

## ⚙️ Installation & Setup

### 1. Clone the Repository

```bash
git clone https://github.com/YOUR_USERNAME/IoTe_kmitl_website.git
cd IoTe_kmitl_website
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install Node Dependencies

```bash
npm install
```

### 4. Install Flowbite

```bash
npm install flowbite
```

### 5. Environment Setup

Copy the example environment file and generate an app key:

```bash
cp .env.example .env
php artisan key:generate
```

### 6. Configure Database

Open the `.env` file and update your database credentials:

```env
DB_CONNECTION=ชื่อดาต้าเบส
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=เว้นไว้ก่อน
DB_USERNAME=เว้นไว้ก่อน
DB_PASSWORD=
```

> ⚠️ Make sure XAMPP is running and you have created a database named `ชื่อดาต้าเบส` in **phpMyAdmin** (`http://localhost/phpmyadmin`).

### 7. Run Database Migrations

```bash
php artisan migrate
```

### 8. (ไม่ต้องทำจ้า ทำทันเดะทำ) Seed the Database

```bash
php artisan db:seed
```

---

## 🚀 Running the Project

You need **two terminal windows** running simultaneously:

**Terminal 1 — Laravel Backend:**

```bash
php artisan serve
```

**Terminal 2 — Frontend Assets (Tailwind/Flowbite):**

```bash
npm run dev
```

Then open your browser and go to:

```
http://localhost:8000
```

---

## 🏗️ Project Structure

```
IoTe_kmitl_website/
├── app/
│   ├── Http/
│   │   └── Controllers/     # Application controllers
│   └── Models/              # Eloquent models
├── database/
│   ├── migrations/          # Database schema
│   └── seeders/             # Sample data
├── resources/
│   ├── views/               # Blade templates
│   └── css/                 # Stylesheets (Tailwind)
├── routes/
│   └── web.php              # Web routes
├── public/                  # Publicly accessible files
├── .env                     # Environment config (not committed)
└── README.md
```

---

## 🔑 Authentication

This project uses **Laravel Breeze** for authentication. If not installed yet, run:

```bash
composer require laravel/breeze --dev
php artisan breeze:install
php artisan migrate
npm install && npm run dev
```

Default auth routes available:

- `/login` — Login page
- `/register` — Register page
- `/dashboard` — Protected dashboard

---

## 🧪 Running Tests

```bash
php artisan test
```

---

## 🐛 Common Issues & Fixes

**Issue: `php artisan serve` not working**

- Make sure PHP is added to your system PATH
- Check PHP version with `php -v` (must be >= 8.1)

**Issue: Database connection error**

- Make sure XAMPP's MySQL service is running
- Double-check your `.env` DB credentials
- Make sure the database exists in phpMyAdmin

**Issue: Flowbite components not styling correctly**

- Make sure `npm run dev` is running
- Check that `flowbite` is included in your `tailwind.config.js`:

```js
module.exports = {
  content: ["./resources/**/*.blade.php", "./node_modules/flowbite/**/*.js"],
  plugins: [require("flowbite/plugin")],
};
```

---

## 📦 Build for Production

```bash
npm run build
php artisan optimize
```

---

## 👥 Contributors

| Name         | Role                 |
| ------------ | -------------------- |
| Ice ก๊าบ     | Half-Fullstack       |
| Tangkwa ก๊าบ | Maybe frontend       |
| Meen ก๊าบ    | Maybe Half-fullstack |
| Pleume ก๊าบ  | Maybe frontend       |
| Focus ก๊าบ   | Maybe frontend       |

---

## 📄 License

This project is for **educational purposes** as part of the IoT Engineering curriculum course at KMITL.

---

> Made with ❤️ by PhysIot Engineering students @ KMITL
