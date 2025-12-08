# Laravel Portfolio (Admin CMS)

This repository contains a small Laravel portfolio app with an admin dashboard to manage content.

Quick setup (development):

1. Install PHP / Composer / Node.js and dependencies:

```powershell
composer install
npm install
```

2. Copy `.env` and set your database:

```powershell
copy .env.example .env
php artisan key:generate
```

3. Run migrations and seed if required:

```powershell
php artisan migrate
```

4. Create storage symlink so uploaded images are served:

```powershell
php artisan storage:link
```

5. Build assets:

```powershell
npm run dev
# or for production
npm run build
```

6. Run the dev server:

```powershell
php artisan serve --host=127.0.0.1 --port=8000
```

Admin routes live under the `/admin` prefix (authentication required).

What I added:
- Admin controllers and views for About, Projects, Skills, Hero, and Settings.
- File upload handling and storage usage for images.
- Example tests for admin access.

If you want, I can convert the admin UI to Livewire for a more reactive experience, or convert legacy CSS to Tailwind utilities.
