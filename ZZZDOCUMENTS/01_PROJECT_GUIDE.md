# Laravel Portfolio Project - Complete Guide

## 📋 Table of Contents

1. [Project Overview](#project-overview)
2. [Technology Stack](#technology-stack)
3. [Database Schema](#database-schema)
4. [Project Structure](#project-structure)
5. [Setup Instructions](#setup-instructions)
6. [Features](#features)
7. [Routes](#routes)
8. [Usage Guide](#usage-guide)

---

## 🎯 Project Overview

A professional portfolio website built with Laravel 12.40.2 featuring:

- Dynamic content management
- User authentication system
- Admin dashboard for content management
- Responsive design with Tailwind CSS
- Database-driven portfolio sections

---

## 🛠 Technology Stack

| Component | Technology |
|-----------|-----------|
| **Framework** | Laravel 12.40.2 |
| **PHP Version** | 8.2.12 |
| **Database** | MySQL |
| **Frontend** | Blade Templates, Tailwind CSS |
| **Build Tool** | Vite |
| **Server** | XAMPP (Apache + MySQL) |

---

## 🗄 Database Schema

### Portfolio Content Tables

#### 1. `hero_section`

Main landing section with personal information.

| Column | Type | Nullable | Description |
|--------|------|----------|-------------|
| id | bigint | No | Primary key |
| title | varchar(255) | No | Main heading |
| subtitle | varchar(255) | No | Subheading |
| description | text | No | Introduction text |
| education | varchar(255) | No | Education details |
| email | varchar(255) | No | Contact email |
| location | varchar(255) | No | Location info |
| profile_image | varchar(255) | Yes | Profile photo path |
| cv_link | varchar(255) | Yes | Resume/CV link |
| created_at | timestamp | Yes | Creation timestamp |
| updated_at | timestamp | Yes | Update timestamp |

#### 2. `about`

About section information.

| Column | Type | Nullable | Description |
|--------|------|----------|-------------|
| id | bigint | No | Primary key |
| name | varchar(255) | No | Name |
| description | text | No | About description |
| photo | varchar(255) | Yes | Photo path |
| created_at | timestamp | Yes | Creation timestamp |
| updated_at | timestamp | Yes | Update timestamp |

#### 3. `projects`

Portfolio projects showcase.

| Column | Type | Nullable | Description |
|--------|------|----------|-------------|
| id | bigint | No | Primary key |
| title | varchar(255) | No | Project title |
| description | text | No | Project description |
| image | varchar(255) | Yes | Project image path |
| link | varchar(255) | Yes | Project URL |
| created_at | timestamp | Yes | Creation timestamp |
| updated_at | timestamp | Yes | Update timestamp |

#### 4. `skills`

Skills and expertise listing.

| Column | Type | Nullable | Description |
|--------|------|----------|-------------|
| id | bigint | No | Primary key |
| name | varchar(255) | No | Skill category |
| skill_name | text | No | Specific skill |
| created_at | timestamp | Yes | Creation timestamp |
| updated_at | timestamp | Yes | Update timestamp |

### System Tables

#### 5. `users`

User authentication and accounts.

| Column | Type | Nullable | Description |
|--------|------|----------|-------------|
| id | bigint | No | Primary key |
| name | varchar(255) | No | User name |
| email | varchar(255) | No | Email (unique) |
| email_verified_at | timestamp | Yes | Verification timestamp |
| password | varchar(255) | No | Hashed password |
| remember_token | varchar(100) | Yes | Remember me token |
| created_at | timestamp | Yes | Creation timestamp |
| updated_at | timestamp | Yes | Update timestamp |

#### 6. `sessions`

Session management for user state.

| Column | Type | Nullable | Description |
|--------|------|----------|-------------|
| id | varchar(255) | No | Primary key |
| user_id | bigint | Yes | Foreign key to users |
| ip_address | varchar(45) | Yes | Client IP |
| user_agent | text | Yes | Browser info |
| payload | longtext | No | Session data |
| last_activity | int | No | Last activity timestamp |

#### 7. `cache`

Application caching for performance.

| Column | Type | Nullable | Description |
|--------|------|----------|-------------|
| key | varchar(255) | No | Primary key |
| value | mediumtext | No | Cached value |
| expiration | int | No | Expiry timestamp |

#### 8. `cache_locks`

Cache lock management.

| Column | Type | Nullable | Description |
|--------|------|----------|-------------|
| key | varchar(255) | No | Primary key |
| owner | varchar(255) | No | Lock owner |
| expiration | int | No | Lock expiry |

#### 9. `password_reset_tokens`

Password reset functionality.

| Column | Type | Nullable | Description |
|--------|------|----------|-------------|
| email | varchar(255) | No | Primary key |
| token | varchar(255) | No | Reset token |
| created_at | timestamp | Yes | Creation timestamp |

---

## 📁 Project Structure

```
portfolio_LARAVEL/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── Auth/              # Authentication controllers
│   │       ├── ProfileController.php
│   │       └── WelcomeController.php
│   └── Models/
│       ├── About.php
│       ├── Project.php
│       ├── Skill.php
│       └── User.php
├── database/
│   └── migrations/                # All database migrations
├── resources/
│   └── views/
│       ├── auth/                  # Auth views
│       ├── components/            # Reusable components
│       ├── layouts/               # Layout templates
│       ├── profile/               # Profile management
│       ├── Welcome.blade.php      # Homepage
│       └── dashboard.blade.php    # Admin dashboard
├── routes/
│   ├── web.php                    # Web routes
│   └── auth.php                   # Auth routes
└── public/                        # Public assets
```

---

## 🚀 Setup Instructions

### Prerequisites

- XAMPP installed with PHP 8.2.12
- Composer installed
- Node.js and npm installed

### Installation Steps

1. **Clone/Navigate to Project**

   ```bash
   cd c:\xampp\htdocs\AEIRC\portfolio_LARAVEL
   ```

2. **Install Dependencies**

   ```bash
   composer install
   npm install
   ```

3. **Configure Environment**
   - Copy `.env.example` to `.env`
   - Update database credentials:

     ```
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=laravel
     DB_USERNAME=root
     DB_PASSWORD=
     ```

4. **Generate Application Key**

   ```bash
   php artisan key:generate
   ```

5. **Run Migrations**

   ```bash
   php artisan migrate
   ```

6. **Build Assets**

   ```bash
   npm run dev
   ```

7. **Start Development Server**

   ```bash
   php artisan serve
   ```

8. **Access Application**
   - Homepage: `http://127.0.0.1:8000`
   - Admin Dashboard: `http://127.0.0.1:8000/admin/dashboard`

---

## ✨ Features

### Public Features

- **Homepage** - Dynamic portfolio showcase
- **Hero Section** - Personal introduction with profile
- **About Section** - Detailed about information
- **Skills Display** - Categorized skills listing
- **Projects Portfolio** - Project showcase with images and links

### Admin Features

- **User Authentication** - Login/Register system
- **Admin Dashboard** - Content management interface
- **Profile Management** - Update user profile
- **Protected Routes** - Middleware-protected admin area

### Technical Features

- **Database Sessions** - Persistent session storage
- **Rate Limiting** - Login attempt throttling
- **Password Reset** - Email-based password recovery
- **Cache System** - Performance optimization
- **CSRF Protection** - Security against cross-site attacks

---

## 🛣 Routes

### Public Routes

| Method | URI | Description |
|--------|-----|-------------|
| GET | `/` | Homepage |

### Authentication Routes

| Method | URI | Description |
|--------|-----|-------------|
| GET | `/login` | Login page |
| POST | `/login` | Process login |
| GET | `/register` | Registration page |
| POST | `/register` | Process registration |
| POST | `/logout` | Logout user |
| GET | `/forgot-password` | Password reset request |
| POST | `/forgot-password` | Send reset link |
| GET | `/reset-password/{token}` | Reset password form |
| POST | `/reset-password` | Process password reset |

### Protected Routes (Requires Auth)

| Method | URI | Description |
|--------|-----|-------------|
| GET | `/dashboard` | User dashboard |
| GET | `/profile` | Edit profile |
| PATCH | `/profile` | Update profile |
| DELETE | `/profile` | Delete account |

### Admin Routes (Requires Auth)

| Method | URI | Description |
|--------|-----|-------------|
| GET | `/admin/dashboard` | Admin dashboard |
| GET | `/admin/intro` | Manage intro section |
| GET | `/admin/about` | Manage about section |
| GET | `/admin/skills` | Manage skills |
| GET | `/admin/projects` | Manage projects |

---

## 📖 Usage Guide

### For Developers

#### Adding New Portfolio Content

**Add a Project:**

```php
use App\Models\Project;

Project::create([
    'title' => 'My Project',
    'description' => 'Project description',
    'image' => 'path/to/image.jpg',
    'link' => 'https://project-url.com'
]);
```

**Add a Skill:**

```php
use App\Models\Skill;

Skill::create([
    'name' => 'Programming',
    'skill_name' => 'Laravel, PHP, JavaScript'
]);
```

**Update Hero Section:**

```php
use Illuminate\Support\Facades\DB;

DB::table('hero_section')->updateOrInsert(
    ['id' => 1],
    [
        'title' => 'Your Name',
        'subtitle' => 'Your Title',
        'description' => 'Your intro',
        'education' => 'Your education',
        'email' => 'your@email.com',
        'location' => 'Your location'
    ]
);
```

#### Running Migrations

**Fresh migration (drops all tables):**

```bash
php artisan migrate:fresh
```

**Rollback last migration:**

```bash
php artisan migrate:rollback
```

**Check migration status:**

```bash
php artisan migrate:status
```

### For Content Managers

1. **Login to Admin Panel**
   - Navigate to `/login`
   - Enter credentials
   - Access admin dashboard at `/admin/dashboard`

2. **Manage Content**
   - Use admin routes to manage different sections
   - Update hero, about, skills, and projects

3. **Profile Management**
   - Update your profile at `/profile`
   - Change password or delete account

---

## 🔒 Security Features

- **Authentication** - Laravel Breeze authentication
- **Password Hashing** - Bcrypt password encryption
- **CSRF Protection** - Token-based form protection
- **Rate Limiting** - Login throttling (5 attempts)
- **Session Security** - Secure session management
- **Email Verification** - Optional email verification

---

## 🐛 Troubleshooting

### Common Issues

**Database Connection Error:**

- Verify MySQL is running in XAMPP
- Check `.env` database credentials
- Ensure database `laravel` exists

**Missing Tables Error:**

- Run `php artisan migrate`
- Check migration files exist

**Session/Cache Errors:**

- Clear cache: `php artisan cache:clear`
- Clear config: `php artisan config:clear`

**Assets Not Loading:**

- Run `npm run dev` or `npm run build`
- Check `public` directory permissions

---

## 📝 Notes

- All database seeders have been removed
- Database uses MySQL with `laravel` database name
- Sessions are stored in database, not files
- Rate limiting uses database cache
- Admin routes require authentication
- Public homepage displays all portfolio content dynamically
