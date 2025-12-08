# Complete Guide: Making Your Portfolio Website Fully Dynamic

## From Static to Dynamic - A Detailed Tutorial

---

## 📋 Table of Contents

1. [Understanding Dynamic vs Static](#understanding-dynamic-vs-static)
2. [The MVC Architecture](#the-mvc-architecture)
3. [Building the Admin Panel](#building-the-admin-panel)
4. [Creating Controllers](#creating-controllers)
5. [Building Forms](#building-forms)
6. [Handling File Uploads](#handling-file-uploads)
7. [Displaying Dynamic Content](#displaying-dynamic-content)
8. [Complete Feature Examples](#complete-feature-examples)
9. [Security & Validation](#security--validation)
10. [Testing Your Dynamic Site](#testing-your-dynamic-site)

---

## 🎯 Understanding Dynamic vs Static

### Static Website

```html
<!-- Hard-coded content -->
<h1>John Doe</h1>
<p>I am a web developer</p>
```

**Problem:** To change content, you must edit HTML files manually.

### Dynamic Website

```php
<!-- Content from database -->
<h1>{{ $hero->title }}</h1>
<p>{{ $hero->description }}</p>
```

**Solution:** Content is stored in database and can be updated through admin panel.

---

## 🏗 The MVC Architecture

Laravel uses MVC (Model-View-Controller) pattern:

```
User Request → Route → Controller → Model → Database
                          ↓
                        View (Blade Template)
                          ↓
                      Response to User
```

### Components Explained

**Model** (`app/Models/Project.php`)

- Represents database table
- Handles data logic
- Performs CRUD operations

**View** (`resources/views/projects/index.blade.php`)

- HTML templates
- Displays data to user
- Uses Blade syntax

**Controller** (`app/Http/Controllers/ProjectController.php`)

- Handles user requests
- Processes data
- Returns views

---

## 🎨 Building the Admin Panel

### Step 1: Plan Your Admin Features

For a portfolio, you need to manage:

- ✅ Hero Section (intro)
- ✅ About Section
- ✅ Skills
- ✅ Projects

### Step 2: Create Admin Layout

**File:** `resources/views/layouts/admin.blade.php`

```blade
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex space-x-8">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center">
                        Admin Panel
                    </a>
                    <a href="{{ route('admin.hero.index') }}" class="flex items-center">
                        Hero
                    </a>
                    <a href="{{ route('admin.about.index') }}" class="flex items-center">
                        About
                    </a>
                    <a href="{{ route('admin.skills.index') }}" class="flex items-center">
                        Skills
                    </a>
                    <a href="{{ route('admin.projects.index') }}" class="flex items-center">
                        Projects
                    </a>
                </div>
                <div class="flex items-center">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Error Messages -->
        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>
```

**What this does:**

- Creates consistent admin layout
- Navigation menu for all sections
- Displays success/error messages
- Logout functionality

---

## 🎮 Creating Controllers

### Understanding Controllers

Controllers handle the logic between routes and views.

### Step 1: Create a Controller

```bash
# Create a resource controller (includes all CRUD methods)
php artisan make:controller Admin/ProjectController --resource
```

**What `--resource` gives you:**

- `index()` - List all projects
- `create()` - Show create form
- `store()` - Save new project
- `show()` - Show single project
- `edit()` - Show edit form
- `update()` - Update project
- `destroy()` - Delete project

### Step 2: Complete Controller Example

**File:** `app/Http/Controllers/Admin/ProjectController.php`

```php
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of projects
     * Route: GET /admin/projects
     */
    public function index()
    {
        // Get all projects from database, ordered by newest first
        $projects = Project::orderBy('created_at', 'desc')->get();
        
        // Return view with projects data
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new project
     * Route: GET /admin/projects/create
     */
    public function create()
    {
        // Simply return the create form view
        return view('admin.projects.create');
    }

    /**
     * Store a newly created project in database
     * Route: POST /admin/projects
     */
    public function store(Request $request)
    {
        // Step 1: Validate incoming data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'nullable|url',
        ]);

        // Step 2: Handle file upload if image exists
        if ($request->hasFile('image')) {
            // Store image in public/storage/projects folder
            $imagePath = $request->file('image')->store('projects', 'public');
            $validated['image'] = $imagePath;
        }

        // Step 3: Create project in database
        Project::create($validated);

        // Step 4: Redirect with success message
        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project created successfully!');
    }

    /**
     * Display the specified project
     * Route: GET /admin/projects/{id}
     */
    public function show(Project $project)
    {
        // Laravel automatically finds project by ID (Route Model Binding)
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified project
     * Route: GET /admin/projects/{id}/edit
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified project in database
     * Route: PUT/PATCH /admin/projects/{id}
     */
    public function update(Request $request, Project $project)
    {
        // Step 1: Validate
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'nullable|url',
        ]);

        // Step 2: Handle new image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }
            
            // Store new image
            $imagePath = $request->file('image')->store('projects', 'public');
            $validated['image'] = $imagePath;
        }

        // Step 3: Update project
        $project->update($validated);

        // Step 4: Redirect with success message
        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project updated successfully!');
    }

    /**
     * Remove the specified project from database
     * Route: DELETE /admin/projects/{id}
     */
    public function destroy(Project $project)
    {
        // Delete image file if exists
        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }

        // Delete project from database
        $project->delete();

        // Redirect with success message
        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project deleted successfully!');
    }
}
```

**Key Concepts Explained:**

1. **Route Model Binding:** `Project $project` automatically fetches the project by ID
2. **Validation:** `$request->validate()` ensures data is correct
3. **File Upload:** `$request->file('image')->store()` saves uploaded files
4. **Flash Messages:** `->with('success', 'message')` shows one-time messages
5. **Redirect:** `redirect()->route()` sends user to another page

---

## 🛣 Setting Up Routes

**File:** `routes/web.php`

```php
<?php

use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\HeroController;

// Admin routes - protected by auth middleware
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Projects - All CRUD routes
    Route::resource('projects', ProjectController::class);
    
    // Skills - All CRUD routes
    Route::resource('skills', SkillController::class);
    
    // About - Usually just edit/update (single record)
    Route::get('about', [AboutController::class, 'edit'])->name('about.edit');
    Route::put('about', [AboutController::class, 'update'])->name('about.update');
    
    // Hero - Usually just edit/update (single record)
    Route::get('hero', [HeroController::class, 'edit'])->name('hero.edit');
    Route::put('hero', [HeroController::class, 'update'])->name('hero.update');
});
```

**What `Route::resource()` creates:**

| Verb | URI | Action | Route Name |
|------|-----|--------|------------|
| GET | /admin/projects | index | admin.projects.index |
| GET | /admin/projects/create | create | admin.projects.create |
| POST | /admin/projects | store | admin.projects.store |
| GET | /admin/projects/{id} | show | admin.projects.show |
| GET | /admin/projects/{id}/edit | edit | admin.projects.edit |
| PUT/PATCH | /admin/projects/{id} | update | admin.projects.update |
| DELETE | /admin/projects/{id} | destroy | admin.projects.destroy |

---

## 📝 Building Forms

### Form Basics

Forms send data from browser to server.

### Complete Form Example - Create Project

**File:** `resources/views/admin/projects/create.blade.php`

```blade
@extends('layouts.admin')

@section('title', 'Create Project')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow">
    <h1 class="text-2xl font-bold mb-6">Create New Project</h1>

    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <!-- Title Field -->
        <div class="mb-4">
            <label for="title" class="block text-gray-700 font-bold mb-2">
                Project Title *
            </label>
            <input 
                type="text" 
                name="title" 
                id="title"
                value="{{ old('title') }}"
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500 @error('title') border-red-500 @enderror"
                required
            >
            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Description Field -->
        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-bold mb-2">
                Description *
            </label>
            <textarea 
                name="description" 
                id="description"
                rows="5"
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500 @error('description') border-red-500 @enderror"
                required
            >{{ old('description') }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Image Upload Field -->
        <div class="mb-4">
            <label for="image" class="block text-gray-700 font-bold mb-2">
                Project Image
            </label>
            <input 
                type="file" 
                name="image" 
                id="image"
                accept="image/*"
                class="w-full px-3 py-2 border rounded-lg @error('image') border-red-500 @enderror"
            >
            <p class="text-gray-500 text-sm mt-1">Accepted: JPG, PNG, GIF (Max: 2MB)</p>
            @error('image')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Link Field -->
        <div class="mb-6">
            <label for="link" class="block text-gray-700 font-bold mb-2">
                Project URL
            </label>
            <input 
                type="url" 
                name="link" 
                id="link"
                value="{{ old('link') }}"
                placeholder="https://example.com"
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500 @error('link') border-red-500 @enderror"
            >
            @error('link')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Buttons -->
        <div class="flex justify-between">
            <a href="{{ route('admin.projects.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600">
                Cancel
            </a>
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">
                Create Project
            </button>
        </div>
    </form>
</div>
@endsection
```

**Form Elements Explained:**

1. **`@csrf`** - Security token (REQUIRED for all forms)
2. **`enctype="multipart/form-data"`** - Required for file uploads
3. **`old('field')`** - Keeps form data if validation fails
4. **`@error('field')`** - Shows validation errors
5. **`route('admin.projects.store')`** - Form submission URL

### Edit Form Example

**File:** `resources/views/admin/projects/edit.blade.php`

```blade
@extends('layouts.admin')

@section('title', 'Edit Project')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow">
    <h1 class="text-2xl font-bold mb-6">Edit Project</h1>

    <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <!-- Title Field -->
        <div class="mb-4">
            <label for="title" class="block text-gray-700 font-bold mb-2">
                Project Title *
            </label>
            <input 
                type="text" 
                name="title" 
                id="title"
                value="{{ old('title', $project->title) }}"
                class="w-full px-3 py-2 border rounded-lg @error('title') border-red-500 @enderror"
                required
            >
            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Description Field -->
        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-bold mb-2">
                Description *
            </label>
            <textarea 
                name="description" 
                id="description"
                rows="5"
                class="w-full px-3 py-2 border rounded-lg @error('description') border-red-500 @enderror"
                required
            >{{ old('description', $project->description) }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Current Image Display -->
        @if($project->image)
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Current Image</label>
            <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" class="w-48 h-32 object-cover rounded">
        </div>
        @endif

        <!-- New Image Upload -->
        <div class="mb-4">
            <label for="image" class="block text-gray-700 font-bold mb-2">
                Change Image (Optional)
            </label>
            <input 
                type="file" 
                name="image" 
                id="image"
                accept="image/*"
                class="w-full px-3 py-2 border rounded-lg @error('image') border-red-500 @enderror"
            >
            @error('image')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Link Field -->
        <div class="mb-6">
            <label for="link" class="block text-gray-700 font-bold mb-2">
                Project URL
            </label>
            <input 
                type="url" 
                name="link" 
                id="link"
                value="{{ old('link', $project->link) }}"
                class="w-full px-3 py-2 border rounded-lg @error('link') border-red-500 @enderror"
            >
            @error('link')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Buttons -->
        <div class="flex justify-between">
            <a href="{{ route('admin.projects.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600">
                Cancel
            </a>
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">
                Update Project
            </button>
        </div>
    </form>
</div>
@endsection
```

**Key Differences from Create Form:**

- `@method('PUT')` - Tells Laravel this is an UPDATE request
- `old('title', $project->title)` - Shows existing data or old input
- Displays current image before upload field

---

## 📋 Listing Data (Index View)

**File:** `resources/views/admin/projects/index.blade.php`

```blade
@extends('layouts.admin')

@section('title', 'Manage Projects')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Projects</h1>
        <a href="{{ route('admin.projects.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
            + Add New Project
        </a>
    </div>

    <!-- Projects Table -->
    @if($projects->count() > 0)
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Image</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Link</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($projects as $project)
                <tr>
                    <td class="px-6 py-4">
                        @if($project->image)
                            <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" class="w-16 h-16 object-cover rounded">
                        @else
                            <div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center">
                                <span class="text-gray-400">No image</span>
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm font-medium text-gray-900">{{ $project->title }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-500">{{ Str::limit($project->description, 50) }}</div>
                    </td>
                    <td class="px-6 py-4">
                        @if($project->link)
                            <a href="{{ $project->link }}" target="_blank" class="text-blue-500 hover:underline">
                                View
                            </a>
                        @else
                            <span class="text-gray-400">N/A</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm font-medium">
                        <div class="flex space-x-2">
                            <!-- Edit Button -->
                            <a href="{{ route('admin.projects.edit', $project) }}" class="text-blue-600 hover:text-blue-900">
                                Edit
                            </a>
                            
                            <!-- Delete Button -->
                            <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this project?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="text-center py-12">
        <p class="text-gray-500 mb-4">No projects yet.</p>
        <a href="{{ route('admin.projects.create') }}" class="text-blue-500 hover:underline">
            Create your first project
        </a>
    </div>
    @endif
</div>
@endsection
```

**Key Features:**

- Lists all projects in a table
- Shows image thumbnails
- Edit and Delete buttons
- Confirmation dialog for delete
- Empty state message

---

## 📤 Handling File Uploads

### Step 1: Create Storage Link

```bash
# This creates a symbolic link from public/storage to storage/app/public
php artisan storage:link
```

**Why?** Files in `storage/app/public` aren't accessible from web. The link makes them accessible via `public/storage`.

### Step 2: Upload File in Controller

```php
// In your store() method
if ($request->hasFile('image')) {
    // Store in storage/app/public/projects
    $path = $request->file('image')->store('projects', 'public');
    
    // $path will be something like: "projects/abc123.jpg"
    $validated['image'] = $path;
}
```

### Step 3: Display Image in View

```blade
@if($project->image)
    <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}">
@endif
```

**How it works:**

1. File uploaded to `storage/app/public/projects/abc123.jpg`
2. Saved in database as `projects/abc123.jpg`
3. Accessed via `public/storage/projects/abc123.jpg`

### Step 4: Delete Old File When Updating

```php
// In your update() method
if ($request->hasFile('image')) {
    // Delete old image
    if ($project->image) {
        Storage::disk('public')->delete($project->image);
    }
    
    // Store new image
    $path = $request->file('image')->store('projects', 'public');
    $validated['image'] = $path;
}
```

---

## 🎨 Displaying Dynamic Content on Frontend

### Homepage Controller

**File:** `app/Http/Controllers/HomeController.php`

```php
<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Skill;
use App\Models\About;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch all dynamic content
        $hero = DB::table('hero_section')->first();
        $about = About::first();
        $skills = Skill::orderBy('name')->get();
        $projects = Project::orderBy('created_at', 'desc')->get();
        
        return view('welcome', compact('hero', 'about', 'skills', 'projects'));
    }
}
```

### Homepage View

**File:** `resources/views/welcome.blade.php`

```blade
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $hero->title ?? 'Portfolio' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-500 to-purple-600 text-white py-20">
        <div class="container mx-auto px-4">
            @if($hero)
                <h1 class="text-5xl font-bold mb-4">{{ $hero->title }}</h1>
                <h2 class="text-2xl mb-4">{{ $hero->subtitle }}</h2>
                <p class="text-lg mb-6">{{ $hero->description }}</p>
                
                <div class="flex space-x-4">
                    @if($hero->cv_link)
                        <a href="{{ $hero->cv_link }}" class="bg-white text-blue-500 px-6 py-3 rounded-lg hover:bg-gray-100">
                            Download CV
                        </a>
                    @endif
                    <a href="#contact" class="border-2 border-white px-6 py-3 rounded-lg hover:bg-white hover:text-blue-500">
                        Contact Me
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-12">About Me</h2>
            @if($about)
                <div class="flex flex-col md:flex-row items-center gap-8">
                    @if($about->photo)
                        <img src="{{ asset('storage/' . $about->photo) }}" alt="{{ $about->name }}" class="w-64 h-64 rounded-full object-cover">
                    @endif
                    <div>
                        <h3 class="text-2xl font-bold mb-4">{{ $about->name }}</h3>
                        <p class="text-gray-700">{{ $about->description }}</p>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Skills Section -->
    <section id="skills" class="bg-gray-100 py-20">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-12">Skills</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($skills as $skill)
                    <div class="bg-white p-6 rounded-lg shadow text-center">
                        <h3 class="font-bold mb-2">{{ $skill->name }}</h3>
                        <p class="text-gray-600">{{ $skill->skill_name }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section id="projects" class="py-20">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-12">Projects</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($projects as $project)
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        @if($project->image)
                            <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" class="w-full h-48 object-cover">
                        @endif
                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-2">{{ $project->title }}</h3>
                            <p class="text-gray-700 mb-4">{{ $project->description }}</p>
                            @if($project->link)
                                <a href="{{ $project->link }}" target="_blank" class="text-blue-500 hover:underline">
                                    View Project →
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</body>
</html>
```

**Dynamic Features:**

- All content from database
- Conditional rendering (`@if`)
- Loops for multiple items (`@foreach`)
- Dynamic images
- Fallbacks for missing data

---

## 🔒 Security & Validation

### Validation Rules

```php
$request->validate([
    // Required field
    'title' => 'required',
    
    // Required string, max 255 characters
    'title' => 'required|string|max:255',
    
    // Required email format
    'email' => 'required|email',
    
    // Required valid URL
    'link' => 'required|url',
    
    // Optional (nullable) URL
    'link' => 'nullable|url',
    
    // Image file, specific types, max 2MB
    'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    
    // Integer between 1 and 10
    'level' => 'required|integer|min:1|max:10',
    
    // Unique in database table
    'email' => 'required|email|unique:users,email',
    
    // Unique except current record (for updates)
    'email' => 'required|email|unique:users,email,' . $user->id,
]);
```

### Common Validation Rules

| Rule | Description | Example |
|------|-------------|---------|
| `required` | Field must be present | `'name' => 'required'` |
| `nullable` | Field can be null | `'phone' => 'nullable'` |
| `string` | Must be string | `'name' => 'string'` |
| `integer` | Must be integer | `'age' => 'integer'` |
| `email` | Valid email format | `'email' => 'email'` |
| `url` | Valid URL format | `'website' => 'url'` |
| `max:value` | Maximum value/length | `'name' => 'max:255'` |
| `min:value` | Minimum value/length | `'age' => 'min:18'` |
| `image` | Must be image file | `'photo' => 'image'` |
| `mimes:jpg,png` | Specific file types | `'photo' => 'mimes:jpg,png'` |
| `unique:table,column` | Unique in database | `'email' => 'unique:users'` |

### CSRF Protection

**Always include in forms:**

```blade
<form method="POST">
    @csrf
    <!-- form fields -->
</form>
```

**What it does:** Prevents Cross-Site Request Forgery attacks.

---

## ✅ Complete Feature: Skills Management

Let me show you a complete feature from start to finish.

### Step 1: Controller

```bash
php artisan make:controller Admin/SkillController --resource
```

**File:** `app/Http/Controllers/Admin/SkillController.php`

```php
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Skill::orderBy('name')->get();
        return view('admin.skills.index', compact('skills'));
    }

    public function create()
    {
        return view('admin.skills.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'skill_name' => 'required|string',
        ]);

        Skill::create($validated);

        return redirect()
            ->route('admin.skills.index')
            ->with('success', 'Skill added successfully!');
    }

    public function edit(Skill $skill)
    {
        return view('admin.skills.edit', compact('skill'));
    }

    public function update(Request $request, Skill $skill)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'skill_name' => 'required|string',
        ]);

        $skill->update($validated);

        return redirect()
            ->route('admin.skills.index')
            ->with('success', 'Skill updated successfully!');
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();

        return redirect()
            ->route('admin.skills.index')
            ->with('success', 'Skill deleted successfully!');
    }
}
```

### Step 2: Routes

```php
// In routes/web.php
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('skills', SkillController::class);
});
```

### Step 3: Views

**Index:** `resources/views/admin/skills/index.blade.php`

```blade
@extends('layouts.admin')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <div class="flex justify-between mb-6">
        <h1 class="text-2xl font-bold">Skills</h1>
        <a href="{{ route('admin.skills.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">
            + Add Skill
        </a>
    </div>

    <table class="min-w-full">
        <thead>
            <tr>
                <th class="text-left">Category</th>
                <th class="text-left">Skills</th>
                <th class="text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($skills as $skill)
            <tr>
                <td class="py-2">{{ $skill->name }}</td>
                <td class="py-2">{{ $skill->skill_name }}</td>
                <td class="py-2">
                    <a href="{{ route('admin.skills.edit', $skill) }}" class="text-blue-500">Edit</a>
                    <form action="{{ route('admin.skills.destroy', $skill) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500" onclick="return confirm('Delete this skill?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
```

**Create:** `resources/views/admin/skills/create.blade.php`

```blade
@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow">
    <h1 class="text-2xl font-bold mb-6">Add New Skill</h1>

    <form action="{{ route('admin.skills.store') }}" method="POST">
        @csrf
        
        <div class="mb-4">
            <label class="block font-bold mb-2">Category</label>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full border rounded px-3 py-2" required>
            @error('name')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block font-bold mb-2">Skills</label>
            <textarea name="skill_name" rows="3" class="w-full border rounded px-3 py-2" required>{{ old('skill_name') }}</textarea>
            @error('skill_name')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-between">
            <a href="{{ route('admin.skills.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded">Cancel</a>
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded">Add Skill</button>
        </div>
    </form>
</div>
@endsection
```

**Edit:** `resources/views/admin/skills/edit.blade.php`

```blade
@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow">
    <h1 class="text-2xl font-bold mb-6">Edit Skill</h1>

    <form action="{{ route('admin.skills.update', $skill) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label class="block font-bold mb-2">Category</label>
            <input type="text" name="name" value="{{ old('name', $skill->name) }}" class="w-full border rounded px-3 py-2" required>
            @error('name')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block font-bold mb-2">Skills</label>
            <textarea name="skill_name" rows="3" class="w-full border rounded px-3 py-2" required>{{ old('skill_name', $skill->skill_name) }}</textarea>
            @error('skill_name')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-between">
            <a href="{{ route('admin.skills.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded">Cancel</a>
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded">Update Skill</button>
        </div>
    </form>
</div>
@endsection
```

---

## 🧪 Testing Your Dynamic Site

### Step 1: Create Test Data

```bash
php artisan tinker
```

```php
// Create a skill
App\Models\Skill::create([
    'name' => 'Programming',
    'skill_name' => 'PHP, Laravel, JavaScript'
]);

// Create a project
App\Models\Project::create([
    'title' => 'Portfolio Website',
    'description' => 'My personal portfolio built with Laravel',
    'link' => 'https://example.com'
]);
```

### Step 2: Test Admin Panel

1. Login to `/login`
2. Go to `/admin/skills`
3. Click "Add Skill"
4. Fill form and submit
5. Verify skill appears in list
6. Click "Edit" and modify
7. Click "Delete" and confirm

### Step 3: Test Frontend

1. Visit homepage `/`
2. Verify skills appear
3. Verify projects appear
4. Check images load correctly

---

## 📚 Summary Checklist

To make any section dynamic:

- [ ] Create migration for database table
- [ ] Create model
- [ ] Create controller with CRUD methods
- [ ] Add routes (use `Route::resource()`)
- [ ] Create views (index, create, edit)
- [ ] Add validation rules
- [ ] Handle file uploads (if needed)
- [ ] Display on frontend
- [ ] Test all CRUD operations

---

## 🎯 Next Steps

1. **Complete all sections** (Hero, About, Skills, Projects)
2. **Add authentication** (already included with Laravel Breeze)
3. **Style admin panel** (use Tailwind CSS)
4. **Add pagination** for large lists
5. **Add search/filter** functionality
6. **Deploy to production**

---

**You now have everything you need to make your portfolio fully dynamic! Start with one section (like Skills), get it working completely, then replicate for other sections.**
