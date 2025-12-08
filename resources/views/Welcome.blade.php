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
                    Hello, I'm <span class="gradient-text">Anurag Adhikari</span>
                </h1>
                <h2 class="home-subtitle">Full Stack Web Developer</h2>
                <p class="home-description">
                    Passionate about creating elegant solutions to complex problems. Specialized in Laravel, PHP, and
                    modern web technologies.
                </p>
                <div class="home-buttons">
                    <a href="#projects" class="btn">View My Work</a>
                    <a href="assets/cv.pdf" class="btn btn-outline">MY CV</a>
                </div>
            </div>

            <!-- Right Profile Image -->
            <div class="home-image">
                <img src="{{ asset('assets/profile.png') }}" alt="Anurag Adhikari" class="profile-img">
            </div>
        </div>
    </section>


    <!-- About Section -->
    <section class="about" id="about">
        <h1 class="heading"><span>About Me</span></h1>
        <div class="row">
            <div class="about-text">
                <p>I am a motivated backend development intern currently working with PHP and MySQL to build functional,
                    efficient server-side systems. With a background in Computer Engineering, I'm learning to design and
                    structure databases, and write clean, maintainable code. I enjoy solving real-world problems,
                    understanding system logic, and improving how applications work behind the scenes. Every project I
                    work on helps me grow my technical skills, analytical thinking, and confidence as a developer. I'm
                    committed to learning continuously and becoming a strong backend developer with full-stack
                    capabilities.</p>
            </div>
            <div class="info-container">
                <div class="box">
                    <h3><span>Name:</span> Anurag Adhikari</h3>
                    <h3><span>Education:</span> Bachelors in Computer Engineering</h3>
                    <h3><span>Email:</span> aanurag677@gmail.com</h3>
                    <h3><span>Location:</span> Kirtipur, Kathmandu</h3>
                </div>
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section class="skills" id="skills">
        <h1 class="heading"><span>Skills</span></h1>
        <div class="box-container">
            <div class="box">
                <h3>Languages</h3>
                <p>Python, HTML, CSS, PHP, C++, C</p>
            </div>
            <div class="box">
                <h3>Tools</h3>
                <p>MySQL, Git & GitHub, API</p>
            </div>
            <div class="box">
                <h3>Soft skills</h3>
                <p>Report Writing, Communication, Team Work</p>
            </div>
            <div class="box">
                <h3>Framework</h3>
                <p>Laravel</p>
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section class="projects" id="projects">
        <h1 class="heading"><span>My Projects</span></h1>
        <div class="box-container">
            <div class="box">
                <h3>Portfolio Website</h3>
                <p>A modern, responsive personal portfolio website built with Laravel and modern web technologies.
                    Features dynamic content management and elegant UI/UX design.</p>
            </div>
            <div class="box">
                <h3>E-commerce Platform</h3>
                <p>A full-featured online marketplace with secure payment integration, product management, and user
                    authentication. Built for scalability and performance.</p>
            </div>
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