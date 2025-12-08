<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KASIRIN - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        montserrat: ['Montserrat', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        body {
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #0f0f0f;
        }
        #canvas-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }
        .glass-effect {
            backdrop-filter: blur(5px);
            background-color: rgba(255, 255, 255, 0.95); 
        }
        .bg-yellow-kasirin { background-color: #FBBF46; }
    </style>
</head>
<body class="h-screen flex items-center justify-center relative">

    <canvas id="canvas-bg"></canvas>

    <div class="glass-effect w-[800px] h-[450px] rounded-xl overflow-hidden shadow-2xl flex z-10">
        
        <div class="w-1/2 flex items-center justify-center p-8 border-r border-gray-100">
            <h1 class="text-5xl font-bold text-gray-800 font-montserrat tracking-wide select-none">
                <i class="fa-solid fa-cart-shopping text-orange-500 mr-2"></i>
                <span class="text-orange-500">KASIR</span><span class="text-black">IN</span>
            </h1>
        </div>

        <div class="w-1/2 bg-yellow-kasirin p-10 flex flex-col justify-center relative">
            <h2 class="text-4xl font-bold text-white text-center mb-8 tracking-wider">LOGIN</h2>
            
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-white text-sm mb-1 ml-1 font-semibold">Username</label>
                    <div class="relative group">
                         <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-yellow-200 group-focus-within:text-white transition">
                            <i class="fa-solid fa-user-circle"></i>
                        </span>
                        <input type="text" name="email" class="w-full bg-yellow-500/50 text-white placeholder-yellow-200 rounded-full py-2 pl-10 pr-4 focus:outline-none focus:ring-2 focus:ring-white focus:bg-yellow-500 transition border border-yellow-300/30" placeholder="Enter username">
                    </div>
                </div>

                <div class="mb-8">
                    <label class="block text-white text-sm mb-1 ml-1 font-semibold">Password</label>
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-yellow-200 group-focus-within:text-white transition">
                            <i class="fa-solid fa-lock"></i>
                        </span>
                        <input type="password" name="password" class="w-full bg-yellow-500/50 text-white placeholder-yellow-200 rounded-full py-2 pl-10 pr-4 focus:outline-none focus:ring-2 focus:ring-white focus:bg-yellow-500 transition border border-yellow-300/30" placeholder="Enter password">
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="bg-black text-white px-10 py-3 rounded-full font-bold hover:bg-gray-800 hover:scale-105 transform transition duration-200 shadow-lg">
                        LOGIN
                    </button>
                </div>
            </form>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script>
        const canvas = document.getElementById('canvas-bg');
        const ctx = canvas.getContext('2d');

        let particlesArray;

        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;

        let mouse = {
            x: null,
            y: null,
            radius: (canvas.height / 80) * (canvas.width / 80)
        }

        window.addEventListener('mousemove', 
            function(event) {
                mouse.x = event.x;
                mouse.y = event.y;
            }
        );

        class Particle {
            constructor(x, y, directionX, directionY, size, color) {
                this.x = x;
                this.y = y;
                this.directionX = directionX;
                this.directionY = directionY;
                this.size = size;
                this.color = color;
            }

            draw() {
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2, false);
                ctx.fillStyle = '#ffffff';
                ctx.fill();
            }

            update() {
                if (this.x > canvas.width || this.x < 0) {
                    this.directionX = -this.directionX;
                }
                if (this.y > canvas.height || this.y < 0) {
                    this.directionY = -this.directionY;
                }

                let dx = mouse.x - this.x;
                let dy = mouse.y - this.y;
                let distance = Math.sqrt(dx*dx + dy*dy);

                if (distance < mouse.radius + this.size) {
                    if (mouse.x < this.x && this.x < canvas.width - this.size * 10) {
                        this.x += 10;
                    }
                    if (mouse.x > this.x && this.x > this.size * 10) {
                        this.x -= 10;
                    }
                    if (mouse.y < this.y && this.y < canvas.height - this.size * 10) {
                        this.y += 10;
                    }
                    if (mouse.y > this.y && this.y > this.size * 10) {
                        this.y -= 10;
                    }
                }

                this.x += this.directionX;
                this.y += this.directionY;

                this.draw();
            }
        }

        function init() {
            particlesArray = [];
            let numberOfParticles = (canvas.height * canvas.width) / 9000;
            for (let i = 0; i < numberOfParticles; i++) {
                let size = (Math.random() * 2) + 1;
                let x = (Math.random() * ((innerWidth - size * 2) - (size * 2)) + size * 2);
                let y = (Math.random() * ((innerHeight - size * 2) - (size * 2)) + size * 2);
                let directionX = (Math.random() * 2) - 1;
                let directionY = (Math.random() * 2) - 1;
                let color = '#ffffff';

                particlesArray.push(new Particle(x, y, directionX, directionY, size, color));
            }
        }

        function animate() {
            requestAnimationFrame(animate);
            ctx.clearRect(0,0,innerWidth, innerHeight);

            for (let i = 0; i < particlesArray.length; i++) {
                particlesArray[i].update();
            }
            connect();
        }

        function connect() {
            let opacityValue = 1;
            for (let a = 0; a < particlesArray.length; a++) {
                for (let b = a; b < particlesArray.length; b++) {
                    let distance = ((particlesArray[a].x - particlesArray[b].x) * (particlesArray[a].x - particlesArray[b].x))
                    + ((particlesArray[a].y - particlesArray[b].y) * (particlesArray[a].y - particlesArray[b].y));
                    
                    if (distance < (canvas.width/7) * (canvas.height/7)) {
                        opacityValue = 1 - (distance/20000);
                        
                        let dx = mouse.x - particlesArray[a].x;
                        let dy = mouse.y - particlesArray[a].y;
                        let mouseDistance = Math.sqrt(dx*dx + dy*dy);
                        
                        if (mouseDistance < 150) {
                            ctx.strokeStyle = 'rgba(251, 191, 70,' + opacityValue + ')'; // Warna Orange/Kuning saat dekat mouse
                            ctx.lineWidth = 1;
                        } else {
                            ctx.strokeStyle = 'rgba(255,255,255,' + (opacityValue * 0.1) + ')'; // Warna Putih transparan normal
                             ctx.lineWidth = 0.5;
                        }

                        ctx.beginPath();
                        ctx.moveTo(particlesArray[a].x, particlesArray[a].y);
                        ctx.lineTo(particlesArray[b].x, particlesArray[b].y);
                        ctx.stroke();
                    }
                }
            }
        }

        window.addEventListener('resize', function() {
            canvas.width = innerWidth;
            canvas.height = innerHeight;
            mouse.radius = ((canvas.height/80) * (canvas.height/80));
            init();
        });

        window.addEventListener('mouseout', function(){
            mouse.x = undefined;
            mouse.y = undefined;
        })

        init();
        animate();
    </script>
</body>
</html>