<x-app-layout>
    <div class="flex h-screen overflow-hidden bg-light" x-data="{ sidebarOpen: false }">

        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-50 w-64 bg-dark text-white transition-transform duration-300 ease-in-out md:relative md:translate-x-0 shadow-xl border-r border-white/10">
            <div class="flex items-center justify-between p-6 border-b border-white/10">
                <span
                    class="text-2xl font-extrabold tracking-tight bg-gradient-to-r from-primary to-primary-light bg-clip-text text-transparent">Admin
                    Panel</span>
                <button @click="sidebarOpen = false" class="md:hidden text-gray-400 hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <nav class="p-4 space-y-3">
                <a href="{{ route('admin.hero.index') }}"
                    class="block px-5 py-3 rounded-full hover:bg-white/10 transition-all duration-300 {{ request()->routeIs('admin.hero.*') ? 'bg-primary shadow-lg shadow-primary/30' : 'text-gray-300' }}">
                    Intro / Hero
                </a>
                <a href="{{ route('admin.about.index') }}"
                    class="block px-5 py-3 rounded-full hover:bg-white/10 transition-all duration-300 {{ request()->routeIs('admin.about.*') ? 'bg-primary shadow-lg shadow-primary/30' : 'text-gray-300' }}">
                    About Me
                </a>
                <a href="{{ route('admin.skill.index') }}"
                    class="block px-5 py-3 rounded-full hover:bg-white/10 transition-all duration-300 {{ request()->routeIs('admin.skill.*') ? 'bg-primary shadow-lg shadow-primary/30' : 'text-gray-300' }}">
                    Skills
                </a>
                <a href="{{ route('admin.project.index') }}"
                    class="block px-5 py-3 rounded-full hover:bg-white/10 transition-all duration-300 {{ request()->routeIs('admin.project.*') ? 'bg-primary shadow-lg shadow-primary/30' : 'text-gray-300' }}">
                    Projects
                </a>
                <!-- Settings Removed -->

                <!-- Logout Removed as per user request -->
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto w-full bg-[#f8f9fa]">
            <!-- Mobile Header -->
            <div class="md:hidden flex items-center bg-white p-4 shadow-sm">
                <button @click="sidebarOpen = true" class="text-gray-600 hover:text-gray-900">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <span class="ml-4 font-semibold text-lg text-dark">Dashboard</span>
            </div>

            <div class="py-12">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <header class="mb-10">
                        <h2 class="text-4xl font-extrabold text-dark mb-2">Welcome, <span
                                class="text-primary">{{ Auth::user()->name }}</span>!</h2>
                        <p class="text-gray-500 text-lg">Manage your portfolio content from one place.</p>
                    </header>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                        <!-- Hero Card -->
                        <div
                            class="bg-white p-8 rounded-3xl shadow-card hover:shadow-hover hover:-translate-y-2 transition-all duration-300 border border-black/5 relative overflow-hidden group">
                            <div
                                class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center text-primary mb-4 group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-dark mb-2">Intro</h3>
                            <p class="text-gray-600 font-medium mb-6 text-base">Manage Hero section.</p>
                            <a href="{{ route('admin.hero.index') }}"
                                class="inline-block px-6 py-2 bg-primary text-white font-semibold rounded-full shadow-lg shadow-primary/30 hover:bg-primary-dark hover:-translate-y-1 transition-all duration-300">
                                Edit
                            </a>
                        </div>

                        <!-- About Card -->
                        <div
                            class="bg-white p-8 rounded-3xl shadow-card hover:shadow-hover hover:-translate-y-2 transition-all duration-300 border border-black/5 relative overflow-hidden group">
                            <div
                                class="w-12 h-12 bg-secondary/10 rounded-xl flex items-center justify-center text-secondary mb-4 group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-dark mb-2">About</h3>
                            <p class="text-gray-600 font-medium mb-6 text-base">Manage personal info.</p>
                            <a href="{{ route('admin.about.index') }}"
                                class="inline-block px-6 py-2 bg-white text-secondary border-2 border-secondary font-semibold rounded-full hover:bg-secondary hover:text-white hover:-translate-y-1 transition-all duration-300">
                                Edit
                            </a>
                        </div>

                        <!-- Skills Card -->
                        <div
                            class="bg-white p-8 rounded-3xl shadow-card hover:shadow-hover hover:-translate-y-2 transition-all duration-300 border border-black/5 relative overflow-hidden group">
                            <div
                                class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center text-indigo-600 mb-4 group-hover:scale-110-transition-transform">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-dark mb-2">Skills</h3>
                            <p class="text-gray-600 font-medium mb-6 text-base">Update technical skills.</p>
                            <a href="{{ route('admin.skill.index') }}"
                                class="inline-block px-6 py-2 bg-primary text-white font-semibold rounded-full shadow-lg shadow-primary/30 hover:bg-primary-dark hover:-translate-y-1 transition-all duration-300">
                                Manage
                            </a>
                        </div>

                        <!-- Projects Card -->
                        <div
                            class="bg-white p-8 rounded-3xl shadow-card hover:shadow-hover hover:-translate-y-2 transition-all duration-300 border border-black/5 relative overflow-hidden group">
                            <div
                                class="w-12 h-12 bg-pink-100 rounded-xl flex items-center justify-center text-pink-500 mb-4 group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-dark mb-2">Projects</h3>
                            <p class="text-gray-600 font-medium mb-6 text-base">Add or edit projects.</p>
                            <a href="{{ route('admin.project.index') }}"
                                class="inline-block px-6 py-2 bg-white text-primary border-2 border-primary font-semibold rounded-full hover:bg-primary hover:text-white hover:-translate-y-1 transition-all duration-300">
                                Manage
                            </a>
                        </div>

                        <!-- Social Links Card -->
                        <div
                            class="bg-white p-8 rounded-3xl shadow-card hover:shadow-hover hover:-translate-y-2 transition-all duration-300 border border-black/5 relative overflow-hidden group">
                            <div
                                class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center text-green-600 mb-4 group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M18 2a2 2 0 012 2v16a2 2 0 01-2 2H6a2 2 0 01-2-2V4a2 2 0 012-2h12zm-6 14a4 4 0 100-8 4 4 0 000 8z">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-dark mb-2">Social Links</h3>
                            <p class="text-gray-600 font-medium mb-6 text-base">Manage all social media links.</p>
                            <a href="{{ route('admin.sociallink.index') }}"
                                class="inline-block px-6 py-2 bg-primary text-white font-semibold rounded-full shadow-lg shadow-primary/30 hover:bg-primary-dark hover:-translate-y-1 transition-all duration-300">
                                Manage
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>