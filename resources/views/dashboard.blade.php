<x-app-layout>
    <!-- Mobile Menu Button -->
    <button id="mobile-menu-btn" aria-controls="sidebar" aria-expanded="false" 
            style="display: none; padding: 1rem; background: #0f172a; color: white; cursor: pointer; border: none; font-size: 1rem;">
        <span style="position: absolute; width: 1px; height: 1px; overflow: hidden;">Toggle menu</span>
        ☰ Menu
    </button>

    <div style="display: flex;">

        <!-- Sidebar -->
        <div id="sidebar" class="sidebar" 
             style="background: linear-gradient(180deg, #0f172a, #111827); color: white; width: 16rem; min-height: 100vh; padding: 1.5rem; display: none; position: fixed;" 
             role="navigation" aria-hidden="true">
            <h2 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 1.5rem; color: #fff;">Admin Panel</h2>

            <ul style="list-style: none; padding: 0;">
                <li style="margin-bottom: 1rem;">
                    <a href="{{ route('admin.hero.index') }}" style="display: block; color: rgba(255,255,255,0.9); text-decoration: none; transition: color 0.3s;">Intro</a>
                </li>
                <li style="margin-bottom: 1rem;">
                    <a href="{{ route('admin.about.index') }}" style="display: block; color: rgba(255,255,255,0.9); text-decoration: none; transition: color 0.3s;">About Me</a>
                </li>
                <li style="margin-bottom: 1rem;">
                    <a href="{{ route('admin.skill.index') }}" style="display: block; color: rgba(255,255,255,0.9); text-decoration: none; transition: color 0.3s;">Skills</a>
                </li>
                <li style="margin-bottom: 1rem;">
                    <a href="{{ route('admin.project.index') }}" style="display: block; color: rgba(255,255,255,0.9); text-decoration: none; transition: color 0.3s;">Projects</a>
                </li>
                <li style="margin-top: 2rem; padding-top: 1rem; border-top: 1px solid rgba(255,255,255,0.2);">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" style="display: block; width: 100%; text-align: left; color: rgba(255,255,255,0.9); background: transparent; border: none; cursor: pointer; font-size: 1rem; font-family: inherit; padding: 0; transition: color 0.3s;">
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>

        <!-- MAIN CONTENT -->
        <div class="main-content" style="flex: 1; padding: 3rem; margin-left: 0; transition: all 0.3s; background: #f5faff;">

            <div class="dashboard" style="max-width: 1100px; margin: 0 auto;">
                <h2 style="font-size: 2.3rem; font-weight: 700; color: #1d4ed8; margin-bottom: 0.5rem;">
                    Welcome {{ Auth::user()->name }}!
                </h2>
                <p style="color: #1b2a4e; margin-bottom: 2rem; font-size: 1.1rem;">Manage your portfolio</p>

                <!-- GRID OF CARDS -->
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.875rem;">

                    <!-- Card: Intro -->
                    <div class="dashboard-card" style="background: #ffffff; padding: 1.5rem; border-radius: 12px; box-shadow: 0 6px 20px rgba(0,0,0,0.08); transition: transform 0.3s;">
                        <h3 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 0.5rem; color: #1d4ed8;">Intro</h3>
                        <p style="color: #1b2a4e; margin-bottom: 1rem;">Edit Hero Section</p>
                        <a href="{{ route('admin.hero.index') }}"
                           class="btn" style="display: inline-block; padding: 14px 20px; background: #1d4ed8; color: #fff; border-radius: 10px; text-decoration: none; font-size: 1rem; transition: background 0.3s;">
                            Edit
                        </a>
                    </div>

                    <!-- Card: About -->
                    <div class="dashboard-card" style="background: #ffffff; padding: 1.5rem; border-radius: 12px; box-shadow: 0 6px 20px rgba(0,0,0,0.08); transition: transform 0.3s;">
                        <h3 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 0.5rem; color: #1d4ed8;">About</h3>
                        <p style="color: #1b2a4e; margin-bottom: 1rem;">Edit About Me</p>
                        <a href="{{ route('admin.about.index') }}"
                           class="btn" style="display: inline-block; padding: 14px 20px; background: #1d4ed8; color: #fff; border-radius: 10px; text-decoration: none; font-size: 1rem; transition: background 0.3s;">
                            Edit
                        </a>
                    </div>

                    <!-- Card: Skills -->
                    <div class="dashboard-card" style="background: #ffffff; padding: 1.5rem; border-radius: 12px; box-shadow: 0 6px 20px rgba(0,0,0,0.08); transition: transform 0.3s;">
                        <h3 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 0.5rem; color: #1d4ed8;">Skills</h3>
                        <p style="color: #1b2a4e; margin-bottom: 1rem;">Manage Skills</p>
                        <a href="{{ route('admin.skill.index') }}"
                           class="btn" style="display: inline-block; padding: 14px 20px; background: #1d4ed8; color: #fff; border-radius: 10px; text-decoration: none; font-size: 1rem; transition: background 0.3s;">
                            Manage
                        </a>
                    </div>

                    <!-- Card: Projects -->
                    <div class="dashboard-card" style="background: #ffffff; padding: 1.5rem; border-radius: 12px; box-shadow: 0 6px 20px rgba(0,0,0,0.08); transition: transform 0.3s;">
                        <h3 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 0.5rem; color: #1d4ed8;">Projects</h3>
                        <p style="color: #1b2a4e; margin-bottom: 1rem;">Manage Projects</p>
                        <a href="{{ route('admin.project.index') }}"
                           class="btn" style="display: inline-block; padding: 14px 20px; background: #1d4ed8; color: #fff; border-radius: 10px; text-decoration: none; font-size: 1rem; transition: background 0.3s;">
                            Manage
                        </a>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <style>
        /* Media query for responsive sidebar on larger screens */
        @media (min-width: 768px) {
            #sidebar {
                display: block !important;
                position: relative !important;
            }
            .main-content {
                margin-left: 16rem !important;
            }
            #mobile-menu-btn {
                display: none !important;
            }
        }

        /* Media query for mobile menu button */
        @media (max-width: 767px) {
            #mobile-menu-btn {
                display: block !important;
            }
        }

        /* Hover effects */
        .sidebar a:hover {
            color: #60a5fa !important;
        }

        .btn:hover {
            background: #0f3cc9 !important;
        }

        .dashboard-card:hover {
            transform: translateY(-6px);
        }
    </style>
    
</x-app-layout>
