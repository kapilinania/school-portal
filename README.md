# 🎓 School Portal - Laravel Project

A powerful and user-friendly Laravel-based School Management System with roles for **Admin**, **Teacher**, and **Student**. It includes exam handling, results, student profiles, and much more.

---

## 🚀 Features

- Student, Teacher, and Admin logins
- Online exam system
- Result generation
- Profile management
- Section-wise subject handling
- Responsive Blade templates
- Email notifications
- Admin dashboard with charts

---

## 🛠️ Requirements

- PHP >= 8.1
- Composer
- MySQL or MariaDB
- Node.js & npm (for frontend assets)
- Laravel Installer (optional)

---

## 📦 Installation Guide

### 1. Clone the Repository

```bash
git clone https://github.com/kapilinania/school-portal.git
cd school-portal
```
### 2. Install PHP Dependencies

- composer install
### 3. Create Environment File
  - copy .env.example .env        # Windows
  # OR
  - cp .env.example .env          # macOS/Linux

### 4. Generate App Key
bash
Copy
Edit
php artisan key:generate
### 5. Configure .env for Database
Edit .env file and set your DB credentials:

env
Copy
Edit
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=school_portal_db
DB_USERNAME=root
DB_PASSWORD=
### 6. Run Migrations
bash
Copy
Edit
php artisan migrate
Optionally:

bash
Copy
Edit
php artisan db:seed
### 7. Install Frontend Assets
bash
Copy
Edit
npm install
npm run dev
▶️ Run the Application
bash
Copy
Edit
php artisan serve
Visit: http://127.0.0.1:8000

### 📁 Folder Structure
text
Copy
Edit
app/
routes/
resources/
public/
database/
.env
### 🙌 Contributing
Pull requests are welcome. For major changes, please open an issue first.

### 📄 License
This project is licensed under the MIT License.

### 👤 Developed by
Kapil Choudhary
GitHub

yaml
Copy
Edit

---

### ✅ Save Instructions

1. Open your Laravel project in VS Code.
2. Create a file named `README.md` in the root directory.
3. Paste the above content.
4. Save it.
5. Then run:

```bash
git add README.md
git commit -m "Added complete README file"
git push origin main
 
