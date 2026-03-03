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

- [PHP](https://www.php.net/) >= 8.2
- [Composer](https://getcomposer.org/download/)
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

### 2. Install Laravel

Before start, please make sure you all have these following installed in your computer :

- [PHP](https://www.php.net/)
- [Composer](https://getcomposer.org/download/)
  If not you can install composer.exe via [Composer](https://getcomposer.org/download/) first then try to :

```bash
composer global require laravel/installer
```

### 3. Install Node Dependencies

```bash
npm install & npm build
```

### 4. Install Flowbite

1. install flowbite to your project :

```bash
npm install flowbite
```

2. Import the default theme variables from Flowbite inside your main app.css CSS file:

```bash
@import "flowbite/src/themes/default";
```

3. import plugin and configure the source to your css :

```bash
@plugin "flowbite/plugin";
@source "../../node_modules/flowbite";
```

4. add the flowbite JS to your blade file :
<body>

```bash
    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
</body>
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
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=iote_website
DB_USERNAME=root
DB_PASSWORD=
```

> ⚠️ Make sure XAMPP is running and you have created a database named `iote_website` in **phpMyAdmin** (`http://localhost/phpmyadmin`).

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

You need **terminal windows** running:

```bash
php artisan serve
```

## 🏗️ Project Structure

```
IoTe_kmitl_website/IoTe-website
├── app/
│   ├── Http/
│   │   └── Controllers/             # Application controllers
│   │       └── Controller.php
│   │       └── PageController.php   # Main Application controllers
│   └── Models/                      # Eloquent models
├── database/
│   ├── migrations/                  # Database schema
│   └── seeders/                     # Sample data
├── resources/
│   ├── css/                         # Stylesheets (Tailwind)
│   │   └── app.css                  # Main app css
│   │   └── main.css                 # Main app css
│   ├── js/                          # Javascript
│   └── view/                        # Main app blaude
│       ├── laboratories/            # Laboratories blade
│       ├── layouts/                 # Main layouts of page
│       └── index.blade.php          # index blade
├── routes/
│   └── web.php                      # Web routes
├── public/                          # Publicly accessible files
├── .env                             # Environment config (not committed)
└── README.md
```

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
