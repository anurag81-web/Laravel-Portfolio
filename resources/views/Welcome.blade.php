<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anurag Adhikari - Web Developer Portfolio</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <meta name="description"
        content="Portfolio of Anurag Adhikari — Web Developer specializing in Laravel, PHP, and modern web technologies.">
</head>

<body>

    <!-- Header / Navigation -->
    <header id="header">
        <a href="#" class="logo">Anurag Adhikari</a>
        <nav id="navbar" class="navbar">
            <a href="#home">Home</a>
            <a href="#about">About</a>
            <a href="#skills">Skills</a>
            <a href="#projects">Projects</a>
            <a href="#contact">Contact</a>
        </nav>
        <div id="menu-btn" role="button" aria-label="Toggle menu" aria-controls="navbar" aria-expanded="false"
            tabindex="0">☰</div>
    </header>


    <!-- Hero Section -->
    <section class="home" id="home">
        <div class="home-container">
            <!-- Left Content -->
            <div class="home-content">
                <h1 class="home-title">
                    {{ $hero->title ?? "Hello, I'm" }} <span
                        class="gradient-text">{{ $hero->name ?? 'Anurag Adhikari' }}</span>
                </h1>
                <h2 class="home-subtitle">{{ $hero->subtitle ?? 'Full Stack Web Developer' }}</h2>
                <p class="home-description">
                    {{ $hero->description ?? 'Passionate about creating elegant solutions to complex problems. Specialized in Laravel, PHP, and modern web technologies.' }}
                </p>
                <div class="home-buttons">
                    <a href="#projects" class="btn">View My Work</a>
                    @if(optional($hero)->cv_link)
                        <a href="{{ asset('storage/' . $hero->cv_link) }}" class="btn btn-outline" target="_blank">MY CV</a>
                    @else
                        <a href="#" class="btn btn-outline">MY CV</a>
                    @endif
                </div>
            </div>

            <!-- Right Profile Image -->
            <div class="home-image">
                <img src="{{ optional($hero)->profile_image ? asset('storage/' . $hero->profile_image) : asset('assets/profile.png') }}"
                    alt="{{ $hero->name ?? 'Anurag Adhikari' }}" class="profile-img">
            </div>
        </div>
    </section>


    <!-- About Section -->
    <section class="about section" id="about">
        <h1 class="heading"><span>About Me</span></h1>
        <div class="row">
            <div class="about-text">
                <p>{{ $about->description ?? 'I am a motivated backend development intern...' }}</p>
            </div>
            <div class="info-container">
                <div class="box">
                    <h3><span>Name:</span> {{ $about->name ?? 'Anurag Adhikari' }}</h3>
                    <h3><span>Education:</span> {{ $about->education ?? 'Bachelors in Computer Engineering' }}</h3>
                    <h3><span>Email:</span> {{ $about->email ?? 'aanurag677@gmail.com' }}</h3>
                    <h3><span>Location:</span> {{ $about->location ?? 'Kirtipur, Kathmandu' }}</h3>
                </div>
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section class="skills section" id="skills">
        <h1 class="heading"><span>Skills</span></h1>
        <div class="box-container">
            @forelse($skills->groupBy('name') as $categoryName => $skillRows)
                <div class="box">
                    <h3>{{ $categoryName }}</h3>
                    <div class="flex flex-col gap-2 mt-4">
                        @foreach($skillRows as $skillRow)
                            @foreach(explode(',', $skillRow->skill_name) as $item)
                                <span class="text-2xl text-slate-700 font-medium">{{ trim($item) }}</span>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="box">
                    <h3>Languages</h3>
                    <p>Python, HTML, CSS, PHP, C++, C</p>
                </div>
            @endforelse
        </div>
    </section>

    <!-- Projects Section -->
    <section class="projects section" id="projects">
        <h1 class="heading"><span>My Projects</span></h1>
        <div class="box-container">
            @forelse($projects as $project)
                <div class="box">
                    <h3>{{ $project->title }}</h3>
                    <p>{{ $project->description }}</p>
                    @if($project->link)
                        <a href="{{ $project->link }}" target="_blank" class="btn"
                            style="margin-top: 1rem; padding: 0.5rem 1rem; font-size: 0.9rem;">View Project</a>
                    @endif
                </div>
            @empty
                <div class="box">
                    <h3>Portfolio Website</h3>
                    <p>A modern, responsive personal portfolio website...</p>
                </div>
            @endforelse
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact" id="contact">
        <h1 class="heading"><span>Get In Touch</span></h1>
        <p style="text-align: center; max-width: 600px; margin: 0 auto 40px; font-size: 1.1rem; color: #1b2a4e;">
            Have a project in mind or want to collaborate? Feel free to reach out!
        </p>
        <form action="#" method="POST">
            @csrf
            <div
                style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 20px;">
                <input type="text" name="name" placeholder="Your Name" required>
                <input type="email" name="email" placeholder="Your Email" required>
            </div>
            <div style="margin-bottom: 20px;">
                <input type="text" name="subject" placeholder="Subject" style="width: 100%;">
            </div>
            <div style="margin-bottom: 20px;">
                <textarea name="message" placeholder="Your Message" required
                    style="min-height: 150px; resize: vertical;"></textarea>
            </div>
            <button type="submit" class="btn" style="width: 100%; padding: 18px; font-size: 1.1rem;">Send Message
                📧</button>
        </form>
    </section>

    <!-- Footer Section -->
    <footer>
        <div class="social-links">
            <a href="https://github.com/anurag81-web">GitHub</a>
            <a href="https://www.linkedin.com/in/anurag-adhikari-535b8020b/">LinkedIn</a>
            <a href="https://www.instagram.com/_cannablissss_?utm_source=qr&igsh=b2thaWdjZm1peG9x">Instagram</a>
        </div>
        <p>© 2025 Anurag Adhikari. All Rights Reserved.</p>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>

</body>

</html>