<?php
session_start();
include 'connectPhpToDb.php';
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OnePage - Bootstrap Template</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700,800,900');

        :root {
            --primary-color: #2487ce;
            --secondary-color: #6a71d6;
            --accent-color: #2487ce;
            --text-color: #2a2b38;
            --light-gray: #f8f9fa;
            --white: #ffffff;
            --border-color: #e9ecef;
            --gradient-start: #2487ce;
            --gradient-end: #2487ce;
        }

        body {
            font-family: 'Poppins', sans-serif;
            font-weight: 300;
            font-size: 15px;
            line-height: 1.7;
            color: var(--text-color);
            overflow-x: hidden;
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }

        /* Navbar Styles */
        .navbar {
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 15px 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .navbar.scrolled {
            background-color: rgba(255, 255, 255, 0.98);
            padding: 10px 0;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 24px;
            color: var(--primary-color) !important;
            transition: all 0.3s ease;
        }

        .navbar-brand:hover {
            transform: translateY(-2px);
            text-shadow: 0 2px 5px rgba(36, 135, 206, 0.2);
        }

        .navbar-nav .nav-link {
            font-weight: 500;
            color: var(--text-color);
            padding: 8px 15px;
            margin: 0 5px;
            border-radius: 5px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .navbar-nav .nav-link::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: var(--primary-color);
            transform: scaleX(0);
            transform-origin: right;
            transition: transform 0.3s ease;
        }

        .navbar-nav .nav-link:hover::before,
        .navbar-nav .nav-link.active::before {
            transform: scaleX(1);
            transform-origin: left;
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            color: var(--primary-color);
            background-color: rgba(36, 135, 206, 0.1);
        }

        .navbar-toggler {
            border: none;
            padding: 0.5rem;
            transition: all 0.3s ease;
        }

        .navbar-toggler:hover {
            transform: rotate(90deg);
        }

        .navbar-toggler:focus {
            box-shadow: none;
        }

        .navbar-toggler-icon {
            background-image: none;
            width: 24px;
            height: 2px;
            position: relative;
            transition: all 0.3s ease;
        }

        .navbar-toggler-icon::before,
        .navbar-toggler-icon::after {
            content: '';
            position: absolute;
            width: 24px;
            height: 2px;
            background-color: var(--primary-color);
            left: 0;
            transition: all 0.3s ease;
        }

        .navbar-toggler-icon::before {
            transform: translateY(-6px);
        }

        .navbar-toggler-icon::after {
            transform: translateY(6px);
        }

        .navbar-toggler[aria-expanded="true"] .navbar-toggler-icon {
            background-color: transparent;
        }

        .navbar-toggler[aria-expanded="true"] .navbar-toggler-icon::before {
            transform: rotate(45deg);
        }

        .navbar-toggler[aria-expanded="true"] .navbar-toggler-icon::after {
            transform: rotate(-45deg);
        }

        /* Background Image Container */
        .background-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        .background-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: brightness(0.7);
            transition: filter 0.8s ease, transform 10s linear;
        }

        .background-image:hover {
            transform: scale(1.05);
        }

        a {
            cursor: pointer;
            transition: all 200ms linear;
            text-decoration: none;
        }

        a:hover {
            text-decoration: none;
        }

        .link {
            color: var(--primary-color);
            position: relative;
        }

        .link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 1px;
            bottom: 0;
            left: 0;
            background-color: var(--primary-color);
            transition: width 0.3s ease;
        }

        .link:hover::after {
            width: 100%;
        }

        .link:hover {
            color: var(--accent-color);
        }

        p {
            font-weight: 500;
            font-size: 14px;
            line-height: 1.7;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-weight: 600;
            color: var(--text-color);
        }

        h6 span {
            padding: 0 20px;
            text-transform: uppercase;
            font-weight: 700;
            position: relative;
            z-index: 1;
        }

        .section {
            position: relative;
            width: 100%;
            display: block;
        }

        /* Toggle switch */
        [type="checkbox"]:checked,
        [type="checkbox"]:not(:checked) {
            position: absolute;
            left: -9999px;
        }

        .checkbox:checked+label,
        .checkbox:not(:checked)+label {
            position: relative;
            display: block;
            text-align: center;
            width: 60px;
            height: 16px;
            border-radius: 8px;
            padding: 0;
            margin: 10px auto;
            cursor: pointer;
            background: linear-gradient(to right, var(--gradient-start), var(--gradient-end));
            transition: all 0.3s ease;
        }

        .checkbox:checked+label:hover,
        .checkbox:not(:checked)+label:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(78, 84, 200, 0.4);
        }

        .checkbox:checked+label:before,
        .checkbox:not(:checked)+label:before {
            position: absolute;
            display: block;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            color: var(--primary-color);
            background-color: var(--white);
            font-family: 'unicons';
            content: '\eb4f';
            z-index: 20;
            top: -10px;
            left: -10px;
            line-height: 36px;
            text-align: center;
            font-size: 24px;
            transition: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            box-shadow: 0 4px 15px rgba(78, 84, 200, 0.3);
        }

        .checkbox:checked+label:before {
            transform: translateX(44px) rotate(-270deg);
            color: var(--accent-color);
        }

        /* Login/Signup Card */
        .card-3d-wrap {
            position: relative;
            width: 440px;
            max-width: 100%;
            height: 400px;
            -webkit-transform-style: preserve-3d;
            transform-style: preserve-3d;
            perspective: 800px;
            margin: 40px auto;
            transition: all 0.5s ease;
        }

        .card-3d-wrap:hover {
            transform: translateY(-5px);
        }

        .card-3d-wrapper {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            -webkit-transform-style: preserve-3d;
            transform-style: preserve-3d;
            transition: all 600ms cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        .card-front,
        .card-back {
            width: 100%;
            height: 100%;
            background-color: var(--white);
            position: absolute;
            border-radius: 16px;
            left: 0;
            top: 0;
            -webkit-transform-style: preserve-3d;
            transform-style: preserve-3d;
            -webkit-backface-visibility: hidden;
            -moz-backface-visibility: hidden;
            -o-backface-visibility: hidden;
            backface-visibility: hidden;
            box-shadow: 0 20px 40px rgba(78, 84, 200, 0.15);
            border: none;
            transition: all 0.5s ease;
        }

        .card-back {
            transform: rotateY(180deg);
        }

        .checkbox:checked~.card-3d-wrap .card-3d-wrapper {
            transform: rotateY(180deg);
        }

        .center-wrap {
            position: absolute;
            width: 100%;
            padding: 0 35px;
            top: 50%;
            left: 0;
            transform: translate3d(0, -50%, 35px) perspective(100px);
            z-index: 20;
            display: block;
        }

        /* Form Styles */
        .form-group {
            position: relative;
            display: block;
            margin: 0;
            padding: 0;
            transition: all 0.4s ease;
            transform: translateY(0);
        }

        .form-group:hover {
            transform: translateY(-3px);
        }

        .form-style {
            padding: 13px 20px;
            padding-left: 55px;
            height: 48px;
            width: 100%;
            font-weight: 500;
            border-radius: 8px;
            font-size: 14px;
            line-height: 22px;
            letter-spacing: 0.5px;
            outline: none;
            color: var(--text-color);
            background-color: var(--light-gray);
            border: 2px solid var(--border-color);
            -webkit-transition: all 200ms linear;
            transition: all 200ms cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: none;
        }

        .form-style:focus,
        .form-style:active {
            border: 2px solid var(--accent-color);
            outline: none;
            box-shadow: 0 0 0 0.2rem rgba(143, 148, 251, 0.25);
            background-color: var(--white);
            transform: scale(1.02);
        }

        .input-icon {
            position: absolute;
            top: 0;
            left: 18px;
            height: 48px;
            font-size: 24px;
            line-height: 48px;
            text-align: left;
            color: var(--accent-color);
            -webkit-transition: all 200ms linear;
            transition: all 200ms cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Button Styles */
        .btn {
            border-radius: 8px;
            height: 44px;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            -webkit-transition: all 200ms linear;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            padding: 0 30px;
            letter-spacing: 1px;
            display: -webkit-inline-flex;
            display: -ms-inline-flexbox;
            display: inline-flex;
            -webkit-align-items: center;
            -moz-align-items: center;
            -ms-align-items: center;
            align-items: center;
            -webkit-justify-content: center;
            -moz-justify-content: center;
            -ms-justify-content: center;
            justify-content: center;
            -ms-flex-pack: center;
            text-align: center;
            border: none;
            background: linear-gradient(to right, var(--gradient-start), var(--gradient-end));
            color: var(--white);
            box-shadow: 0 4px 20px rgba(78, 84, 200, 0.3);
            width: 100%;
            margin-top: 10px;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: 0.5s;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn:hover {
            background: linear-gradient(to right, var(--gradient-start), var(--accent-color));
            color: var(--white);
            box-shadow: 0 8px 25px rgba(78, 84, 200, 0.4);
            transform: translateY(-3px);
        }

        /* Login/Signup Section */
        .auth-section {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 100px 20px 20px;
            position: relative;
            z-index: 1;
        }

        .auth-container {
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
            text-align: center;
            animation: fadeInUp 0.8s ease forwards;
            opacity: 0;
            animation-delay: 0.3s;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .toggle-text {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
        }

        .toggle-text span {
            cursor: pointer;
            padding: 0 20px;
            position: relative;
            transition: all 0.3s ease;
            color: var(--white);
        }

        .toggle-text span.active {
            color: var(--white);
            font-weight: 600;
            animation: subtlePulse 2s infinite;
        }

        @keyframes subtlePulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .toggle-text span:after {
            content: '';
            position: absolute;
            width: 0;
            height: 3px;
            bottom: -10px;
            left: 0;
            background: var(--white);
            transition: all 0.3s ease;
        }

        .toggle-text span.active:after {
            width: 100%;
        }

        /* Footer */
        .footer {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px 0;
            text-align: center;
            box-shadow: 0 -5px 20px rgba(0, 0, 0, 0.02);
            position: relative;
            z-index: 1;
            transition: all 0.4s ease;
        }

        .footer:hover {
            background-color: rgba(255, 255, 255, 0.9);
        }

        .footer p {
            margin: 0;
            color: var(--text-color);
            font-size: 14px;
            transition: all 0.4s ease;
        }

        .footer:hover p {
            transform: scale(1.02);
            color: var(--primary-color);
        }

        /* Floating animation for the card */
        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .card-3d-wrap {
            animation: float 6s ease-in-out infinite;
        }

        /* Input field animations */
        .form-group {
            animation: slideIn 0.5s ease forwards;
            opacity: 0;
        }

        .form-group:nth-child(1) {
            animation-delay: 0.4s;
        }

        .form-group:nth-child(2) {
            animation-delay: 0.5s;
        }

        .form-group:nth-child(3) {
            animation-delay: 0.6s;
        }

        .form-group:nth-child(4) {
            animation-delay: 0.7s;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">OnePage</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Background Image -->
    <div class="background-container">
        <img src="assets/img/hero-bg-abstract.jpg" alt="Background" class="background-image">
    </div>

    <!-- Login/Signup Section -->
    <section class="auth-section" id="login">
        <div class="auth-container">
            <div class="section pb-5 pt-5 pt-sm-2 text-center">
                <div class="toggle-text">
                    <h6><span class="active">Log In</span><span>Sign Up</span></h6>
                </div>
                <input class="checkbox" type="checkbox" id="reg-log" name="reg-log" />
                <label for="reg-log"></label>
                <div class="card-3d-wrap">
                    <div class="card-3d-wrapper">
                        <!-- start login -->
                        <div class="card-front">
                            <form method="post" action="login.php">
                                <div class="center-wrap">
                                    <div class="section text-center">
                                        <h4 class="mb-4 pb-3" style="color: var(--primary-color);">Welcome Back!</h4>
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-style" placeholder="Your Email" id="logemail" required>
                                            <i class="input-icon uil uil-at"></i>
                                        </div>
                                        <div class="form-group mt-2">
                                            <input type="password" name="pass" class="form-style" placeholder="Your Password" id="logpass" autocomplete="off" required>
                                            <i class="input-icon uil uil-lock-alt"></i>
                                        </div>
                                        <div class="form-group mt-2">
                                            <select name="role" id="role" class="form-select" required>
                                                <option value="">--Pilih--</option>
                                                <option value="admin">Admin</option>
                                                <option value="dosen">Dosen</option>
                                                <option value="mahasiswa">Mahasiswa</option>
                                            </select>
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-lg btn-block w-100 mt-4 mb-1">Sign in</button>
                                        <p class="mb-0 mt-4 text-center"><a href="#0" class="link">Forgot your password?</a></p>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- end login -->

                        <!-- start register -->
                        <div class="card-back">
                            <form method="post" action="register.php">
                                <div class="center-wrap">
                                    <div class="section text-center">
                                        <h4 class="mb-3 mt-4 pb-2" style="color: var(--primary-color);">Create Account</h4>
                                        <div class="form-group mt-2">
                                            <input type="text" name="nama" class="form-style" placeholder="Your Name" id="logname" autocomplete="off" required>
                                            <i class="input-icon uil uil-user"></i>
                                        </div>
                                        <div class="form-group mt-2">
                                            <input type="number" name="nrp" class="form-style" placeholder="Your nrp" id="lognrp" autocomplete="off" required>
                                            <i class="input-icon uil uil-user"></i>
                                        </div>
                                        <div class="form-group mt-2">
                                            <input type="email" name="email" class="form-style" placeholder="Your Email" id="logemail" autocomplete="off" required>
                                            <i class="input-icon uil uil-at"></i>
                                        </div>
                                        <div class="form-group mt-2">
                                            <input type="password" name="pass" class="form-style" placeholder="Your Password" id="logpass" autocomplete="off" required>
                                            <i class="input-icon uil uil-lock-alt"></i>
                                        </div>
                                        <button type="submit" name="register" class="btn btn-primary btn-lg btn-block w-100 mt-4 mb-4">Register</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- end register -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p>&copy; 2023 OnePage. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Toggle between login and signup
        const toggleText = document.querySelectorAll('.toggle-text span');
        const checkbox = document.getElementById('reg-log');

        toggleText.forEach(span => {
            span.addEventListener('click', function() {
                toggleText.forEach(s => s.classList.remove('active'));
                this.classList.add('active');
                checkbox.checked = this.textContent.trim() === 'Sign Up';

                // Add click animation
                this.style.animation = 'none';
                setTimeout(() => {
                    this.style.animation = 'subtlePulse 2s infinite';
                }, 10);
            });
        });

        // Update toggle text when checkbox changes
        checkbox.addEventListener('change', function() {
            toggleText.forEach(s => s.classList.remove('active'));
            if (this.checked) {
                toggleText[1].classList.add('active');
            } else {
                toggleText[0].classList.add('active');
            }
        });

        // Add animation to form inputs on focus
        const inputs = document.querySelectorAll('.form-style');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.querySelector('.input-icon').style.transform = 'scale(1.2) rotate(10deg)';
                this.parentElement.style.transform = 'translateY(-5px)';
            });
            input.addEventListener('blur', function() {
                this.parentElement.querySelector('.input-icon').style.transform = 'scale(1) rotate(0)';
                this.parentElement.style.transform = 'translateY(0)';
            });
        });

        // Add ripple effect to buttons
        const buttons = document.querySelectorAll('.btn');
        buttons.forEach(button => {
            button.addEventListener('click', function(e) {
                // Create ripple element
                const ripple = document.createElement('span');
                ripple.classList.add('ripple-effect');
                this.appendChild(ripple);

                // Get click position
                const rect = this.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;

                // Position ripple
                ripple.style.left = `${x}px`;
                ripple.style.top = `${y}px`;

                // Remove ripple after animation
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });

        // Background image parallax effect
        window.addEventListener('mousemove', function(e) {
            const background = document.querySelector('.background-image');
            const x = e.clientX / window.innerWidth;
            const y = e.clientY / window.innerHeight;
            background.style.transform = `translate(-${x * 20}px, -${y * 20}px) scale(1.05)`;
        });
    </script>
</body>

</html>