# Complete Laravel Portfolio Development Guide

## A Step-by-Step Tutorial for Independent Development

---

## 📚 Table of Contents

1. [Understanding Laravel Database Errors](#understanding-laravel-database-errors)
2. [Creating Database Migrations](#creating-database-migrations)
3. [Working with Models](#working-with-models)
4. [Managing Seeders](#managing-seeders)
5. [Troubleshooting Common Issues](#troubleshooting-common-issues)
6. [Complete Workflow Example](#complete-workflow-example)
7. [Best Practices](#best-practices)
8. [Quick Reference Commands](#quick-reference-commands)

---

## 🔍 Understanding Laravel Database Errors

### Common Error Pattern

```
SQLSTATE[42S02]: Base table or view not found: 1146 Table 'database.table_name' doesn't exist
```

**What this means:**

- Laravel is trying to access a table that doesn't exist in your database
- You need to create a migration for that table
- The migration must be run to create the actual table

### Tables Laravel Commonly Needs

| Table | Purpose | When Needed |
|-------|---------|-------------|
| `users` | User authentication | Login/Register features |
| `sessions` | Session storage | When `SESSION_DRIVER=database` |
| `cache` | Cache storage | Rate limiting, caching |
| `cache_locks` | Cache locking | Concurrent cache operations |
| `password_reset_tokens` | Password resets | Forgot password feature |

---

## 🛠 Creating Database Migrations

### Step 1: Understanding Migration Files

**Location:** `database/migrations/`

**Naming Convention:**

```
YYYY_MM_DD_HHMMSS_create_table_name_table.php
```

Example: `2025_12_07_091500_create_sessions_table.php`

### Step 2: Create Migration Using Artisan

```bash
# General syntax
php artisan make:migration create_table_name_table

# Examples
php artisan make:migration create_sessions_table
php artisan make:migration create_users_table
php artisan make:migration create_projects_table
```

### Step 3: Migration File Structure

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations - Creates the table
     */
    public function up(): void
    {
        Schema::create('table_name', function (Blueprint $table) {
            // Define columns here
            $table->id();                          // Auto-increment primary key
            $table->string('name');                // VARCHAR(255)
            $table->text('description');           // TEXT
            $table->string('email')->unique();     // Unique email
            $table->integer('age')->nullable();    // Nullable integer
            $table->timestamps();                  // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations - Drops the table
     */
    public function down(): void
    {
        Schema::dropIfExists('table_name');
    }
};
```

### Step 4: Common Column Types

```php
// Primary Keys
$table->id();                           // BIGINT auto-increment
$table->uuid('id')->primary();          // UUID primary key

// Strings
$table->string('name');                 // VARCHAR(255)
$table->string('email', 100);           // VARCHAR(100)
$table->text('description');            // TEXT
$table->longText('content');            // LONGTEXT

// Numbers
$table->integer('age');                 // INT
$table->bigInteger('views');            // BIGINT
$table->decimal('price', 8, 2);         // DECIMAL(8,2)

// Dates & Times
$table->timestamp('published_at');      // TIMESTAMP
$table->timestamps();                   // created_at, updated_at
$table->softDeletes();                  // deleted_at

// Boolean
$table->boolean('is_active');           // BOOLEAN

// Foreign Keys
$table->foreignId('user_id')
      ->constrained()
      ->onDelete('cascade');

// Modifiers
->nullable()                            // Allow NULL
->default('value')                      // Default value
->unique()                              // Unique constraint
->index()                               // Add index
```

### Step 5: Real-World Migration Examples

#### Sessions Table

```php
Schema::create('sessions', function (Blueprint $table) {
    $table->string('id')->primary();
    $table->foreignId('user_id')->nullable()->index();
    $table->string('ip_address', 45)->nullable();
    $table->text('user_agent')->nullable();
    $table->longText('payload');
    $table->integer('last_activity')->index();
});
```

#### Users Table

```php
Schema::create('users', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('email')->unique();
    $table->timestamp('email_verified_at')->nullable();
    $table->string('password');
    $table->rememberToken();
    $table->timestamps();
});
```

#### Cache Table

```php
Schema::create('cache', function (Blueprint $table) {
    $table->string('key')->primary();
    $table->mediumText('value');
    $table->integer('expiration');
});
```

#### Portfolio Projects Table

```php
Schema::create('projects', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->text('description');
    $table->string('image')->nullable();
    $table->string('link')->nullable();
    $table->timestamps();
});
```

### Step 6: Run Migrations

```bash
# Run all pending migrations
php artisan migrate

# Check migration status
php artisan migrate:status

# Rollback last migration
php artisan migrate:rollback

# Rollback all migrations
php artisan migrate:reset

# Drop all tables and re-run migrations
php artisan migrate:fresh

# Fresh migration with seeders
php artisan migrate:fresh --seed
```

---

## 📦 Working with Models

### Step 1: Create a Model

```bash
# Create model only
php artisan make:model Project

# Create model with migration
php artisan make:model Project -m

# Create model with migration, factory, and seeder
php artisan make:model Project -mfs
```

### Step 2: Model Structure

**Location:** `app/Models/`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     * (Optional - Laravel auto-detects from model name)
     */
    protected $table = 'projects';

    /**
     * The attributes that are mass assignable.
     * IMPORTANT: Only add fields you want to allow mass assignment
     */
    protected $fillable = [
        'title',
        'description',
        'image',
        'link',
    ];

    /**
     * The attributes that should be hidden.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean',
    ];
}
```

### Step 3: Using Models

```php
use App\Models\Project;

// Create
$project = Project::create([
    'title' => 'My Project',
    'description' => 'Description here',
    'image' => 'path/to/image.jpg',
    'link' => 'https://example.com'
]);

// Read
$projects = Project::all();                    // Get all
$project = Project::find(1);                   // Find by ID
$project = Project::where('title', 'Test')->first();  // Query

// Update
$project->update([
    'title' => 'Updated Title'
]);

// Delete
$project->delete();
```

---

## 🌱 Managing Seeders

### Understanding Seeders

Seeders populate your database with test/initial data.

### When to Remove Seeders

- Production environments (use real data)
- When you want clean migrations without auto-populated data
- When seeders conflict with your data structure

### How to Remove Seeders

**Location:** `database/seeders/`

```bash
# Delete seeder files
Remove-Item "database\seeders\AboutSeeder.php" -Force
Remove-Item "database\seeders\DatabaseSeeder.php" -Force
```

Or manually delete the files from the folder.

### Creating Seeders (If Needed)

```bash
# Create a seeder
php artisan make:seeder ProjectSeeder
```

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        Project::create([
            'title' => 'Sample Project',
            'description' => 'This is a sample project',
            'image' => 'sample.jpg',
            'link' => 'https://example.com'
        ]);
    }
}
```

```bash
# Run specific seeder
php artisan db:seed --class=ProjectSeeder

# Run all seeders
php artisan db:seed
```

---

## 🐛 Troubleshooting Common Issues

### Issue 1: Table Doesn't Exist

**Error:**

```
SQLSTATE[42S02]: Base table or view not found: 1146 Table 'laravel.sessions' doesn't exist
```

**Solution:**

1. Identify the missing table from the error
2. Create migration for that table
3. Run `php artisan migrate`

**Example Fix:**

```bash
# Create the migration file manually or use artisan
# Then run:
php artisan migrate
```

### Issue 2: Migration Already Exists

**Error:**

```
Migration already exists
```

**Solution:**
Check `database/migrations/` folder - the migration file already exists.

### Issue 3: Database Connection Failed

**Error:**

```
SQLSTATE[HY000] [2002] Connection refused
```

**Solution:**

1. Start XAMPP MySQL
2. Check `.env` file:

   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=laravel
   DB_USERNAME=root
   DB_PASSWORD=
   ```

3. Create database in phpMyAdmin if it doesn't exist

### Issue 4: Class Not Found

**Error:**

```
Class 'App\Models\Project' not found
```

**Solution:**

```bash
# Regenerate autoload files
composer dump-autoload
```

### Issue 5: Syntax Error in Migration

**Solution:**

- Check for missing semicolons
- Verify proper use of `->` and `;`
- Ensure all parentheses are closed
- Check column type spelling

---

## 🔄 Complete Workflow Example

### Scenario: Adding a Blog Feature

#### Step 1: Plan Your Database

```
Table: posts
- id (primary key)
- title (string)
- content (text)
- author_id (foreign key to users)
- published_at (timestamp, nullable)
- created_at, updated_at
```

#### Step 2: Create Migration

```bash
php artisan make:migration create_posts_table
```

#### Step 3: Edit Migration File

```php
public function up(): void
{
    Schema::create('posts', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('content');
        $table->foreignId('author_id')->constrained('users')->onDelete('cascade');
        $table->timestamp('published_at')->nullable();
        $table->timestamps();
    });
}
```

#### Step 4: Create Model

```bash
php artisan make:model Post
```

#### Step 5: Configure Model

```php
protected $fillable = [
    'title',
    'content',
    'author_id',
    'published_at',
];

protected $casts = [
    'published_at' => 'datetime',
];
```

#### Step 6: Run Migration

```bash
php artisan migrate
```

#### Step 7: Test in Tinker

```bash
php artisan tinker
```

```php
$post = App\Models\Post::create([
    'title' => 'First Post',
    'content' => 'Hello World',
    'author_id' => 1
]);
```

---

## ✅ Best Practices

### 1. Migration Best Practices

- ✅ Always use descriptive migration names
- ✅ Never edit migrations after running them in production
- ✅ Use `down()` method for proper rollbacks
- ✅ Add indexes to frequently queried columns
- ✅ Use foreign keys for relationships

### 2. Model Best Practices

- ✅ Only add necessary fields to `$fillable`
- ✅ Use `$hidden` for sensitive data
- ✅ Use `$casts` for type conversion
- ✅ Follow naming conventions (singular model name)

### 3. Database Best Practices

- ✅ Use migrations, never manually edit database
- ✅ Backup database before major changes
- ✅ Use transactions for multiple related operations
- ✅ Index foreign keys and frequently searched columns

### 4. Development Workflow

- ✅ Test migrations locally first
- ✅ Use version control (Git)
- ✅ Document your database schema
- ✅ Keep `.env` out of version control

---

## 🚀 Quick Reference Commands

### Migration Commands

```bash
php artisan make:migration create_table_name_table
php artisan migrate
php artisan migrate:status
php artisan migrate:rollback
php artisan migrate:fresh
php artisan migrate:reset
```

### Model Commands

```bash
php artisan make:model ModelName
php artisan make:model ModelName -m          # With migration
php artisan make:model ModelName -mfs        # With migration, factory, seeder
```

### Seeder Commands

```bash
php artisan make:seeder SeederName
php artisan db:seed
php artisan db:seed --class=SeederName
```

### Debugging Commands

```bash
php artisan tinker                           # Interactive shell
php artisan route:list                       # List all routes
php artisan config:clear                     # Clear config cache
php artisan cache:clear                      # Clear application cache
composer dump-autoload                       # Regenerate autoload
```

### Database Commands

```bash
php artisan db:show                          # Show database info
php artisan db:table table_name              # Show table info
php artisan db:monitor                       # Monitor database
```

---

## 📝 Practical Exercise

### Exercise: Create a Skills Management System

**Goal:** Create a complete skills table with CRUD operations

**Steps:**

1. **Create Migration**

   ```bash
   php artisan make:migration create_skills_table
   ```

2. **Define Schema**
   - id
   - name (string)
   - level (integer, 1-10)
   - category (string)
   - timestamps

3. **Create Model**

   ```bash
   php artisan make:model Skill
   ```

4. **Set Fillable Fields**

5. **Run Migration**

   ```bash
   php artisan migrate
   ```

6. **Test in Tinker**

   ```bash
   php artisan tinker
   ```

   ```php
   Skill::create(['name' => 'Laravel', 'level' => 8, 'category' => 'Backend']);
   Skill::all();
   ```

---

## 🎯 Summary Checklist

When you encounter a "table doesn't exist" error:

- [ ] Identify the missing table name from error message
- [ ] Check if migration exists in `database/migrations/`
- [ ] If not, create migration manually or with artisan
- [ ] Define proper schema in migration file
- [ ] Run `php artisan migrate`
- [ ] Verify table exists in database
- [ ] Create corresponding model if needed
- [ ] Test with tinker or your application

---

## 💡 Pro Tips

1. **Always check migration status** before creating new migrations
2. **Use Laravel's built-in commands** when available (e.g., `php artisan session:table`)
3. **Keep migrations atomic** - one table per migration
4. **Document your schema** in comments or separate documentation
5. **Use database transactions** for complex operations
6. **Test migrations** in development before production
7. **Backup before migrate:fresh** - it drops all tables!

---

## 🔗 Additional Resources

- [Laravel Documentation - Migrations](https://laravel.com/docs/migrations)
- [Laravel Documentation - Eloquent](https://laravel.com/docs/eloquent)
- [Laravel Documentation - Seeding](https://laravel.com/docs/seeding)
- [Database Design Best Practices](https://www.sqlshack.com/database-design-best-practices/)

---

**Remember:** The key to independent development is understanding the error messages, knowing where to look for solutions, and following a systematic approach. Practice these steps, and you'll be able to handle any Laravel database issue confidently!
