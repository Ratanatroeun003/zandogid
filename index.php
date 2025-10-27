<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Welcome Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&display=swap" rel="stylesheet">
    <style>
        /* --- General Reset & Setup --- */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #2a1a5e, #0f3460);
            color: #ffffff;
            text-align: center;
            overflow: hidden;
            position: relative;
        }

        canvas {
            position: absolute;
            top: 0;
            left: 0;
            z-index: 0;
            opacity: 0.5;
            width: 100%;
            height: 100%;
        }

        /* --- Container Styles --- */
        .welcome-container {
            z-index: 1;
            transform: translateZ(0);
            transition: transform 0.5s ease;
            padding: 20px;
            max-width: 90%;
        }

        /* --- Text Animation (Typing Effect) --- */
        h1 {
            font-size: 3.5rem;
            margin-bottom: 20px;
            font-weight: 600;
            overflow: hidden;
            border-right: .15em solid #00f2fe;
            white-space: nowrap;
            width: 0;
            animation: 
                typing 3.5s steps(20, end) forwards,
                blink-caret 0.75s step-end infinite;
            padding-right: 5px;
            text-shadow: 0 0 10px rgba(0, 242, 254, 0.7);
        }

        h2 {
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 30px;
            color: #e0e0e0;
            opacity: 0;
            animation: fadeIn 1s ease-out 2s forwards;
        }

        /* --- Button Styles --- */
        a {
            display: inline-block;
            padding: 14px 35px;
            font-size: 1.1rem;
            font-weight: 600;
            text-decoration: none;
            background: linear-gradient(45deg, #00f2fe, #ff007a);
            color: #ffffff;
            border-radius: 50px;
            transition: transform 0.3s ease, box-shadow 0.3s ease, background 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 242, 254, 0.6);
            margin-top: 15px;
            opacity: 0;
            animation: fadeIn 1s ease-out 3s forwards;
        }

        a:hover {
            background: linear-gradient(45deg, #ffffff, #ff99cc);
            color: #0f3460;
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 8px 25px rgba(0, 242, 254, 0.8);
        }

        /* --- Keyframes --- */
        @keyframes fadeIn {
            from { 
                opacity: 0; 
                transform: translateY(20px); 
            }
            to { 
                opacity: 1; 
                transform: translateY(0); 
            }
        }

        @keyframes typing {
            from { width: 0 }
            to { width: 100% }
        }

        @keyframes blink-caret {
            from, to { border-color: transparent }
            50% { border-color: #00f2fe; }
        }

        /* --- Responsive Design --- */
        @media (max-width: 768px) {
            h1 {
                font-size: 2.5rem;
                margin-bottom: 15px;
            }
            h2 {
                font-size: 1.5rem;
                margin-bottom: 20px;
            }
            a {
                padding: 12px 30px;
                font-size: 1rem;
            }
            .welcome-container {
                max-width: 95%;
                padding: 15px;
            }
        }

        @media (max-width: 480px) {
            h1 {
                font-size: 1.8rem;
                margin-bottom: 10px;
            }
            h2 {
                font-size: 1.2rem;
                margin-bottom: 15px;
            }
            a {
                padding: 10px 25px;
                font-size: 0.9rem;
            }
            .welcome-container {
                max-width: 100%;
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <canvas id="particle-canvas"></canvas>
    <div class="welcome-container">
        <h1 id="welcome-text">Welcome to my site!</h1>
        <h2>Zando_project</h2>
        <a href="code/main.php">Enter Site</a>
    </div>
    <script>
        // Typewriter effect with sound
        const text = "Welcome to my site!";
        let index = 0;
        const welcomeText = document.getElementById('welcome-text');
        const audio = new Audio('https://freesound.org/data/previews/316/316847_4939433-lq.mp3');
        audio.volume = 0.2;

        function typeWriter() {
            if (index < text.length) {
                welcomeText.textContent = text.substring(0, index + 1);
                audio.play().catch(() => {});
                index++;
                setTimeout(typeWriter, 150);
            }
        }
        window.onload = typeWriter;

        // Particle animation
        const canvas = document.getElementById('particle-canvas');
        const ctx = canvas.getContext('2d');
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;

        const particles = [];
        class Particle {
            constructor() {
                this.x = Math.random() * canvas.width;
                this.y = Math.random() * canvas.height;
                this.size = Math.random() * 4 + 1;
                this.speedX = Math.random() * 1.5 - 0.75;
                this.speedY = Math.random() * 1.5 - 0.75;
                this.color = `hsl(${Math.random() * 60 + 180}, 70%, 50%)`;
            }
            update() {
                this.x += this.speedX;
                this.y += this.speedY;
                if (this.size > 0.2) this.size -= 0.05;
                if (this.x < 0 || this.x > canvas.width) this.speedX *= -1;
                if (this.y < 0 || this.y > canvas.height) this.speedY *= -1;
            }
            draw() {
                ctx.fillStyle = this.color;
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
                ctx.fill();
            }
        }

        function initParticles() {
            const particleCount = window.innerWidth < 768 ? 30 : 60; // Fewer particles on mobile
            for (let i = 0; i < particleCount; i++) {
                particles.push(new Particle());
            }
        }

        function animateParticles() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            for (let particle of particles) {
                particle.update();
                particle.draw();
                if (particle.size <= 0.2) {
                    particles.splice(particles.indexOf(particle), 1);
                    particles.push(new Particle());
                }
            }
            requestAnimationFrame(animateParticles);
        }

        initParticles();
        animateParticles();

        // Resize canvas on window resize
        window.addEventListener('resize', () => {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
            particles.length = 0; // Clear particles
            initParticles(); // Reinitialize with adjusted count
        });

        // Parallax effect on mouse move (disabled on mobile)
        const container = document.querySelector('.welcome-container');
        if (window.innerWidth > 768) {
            document.addEventListener('mousemove', (e) => {
                const x = (window.innerWidth / 2 - e.clientX) / 50;
                const y = (window.innerHeight / 2 - e.clientY) / 50;
                container.style.transform = `translate(${x}px, ${y}px)`;
            });
        }
    </script>
</body>
</html>