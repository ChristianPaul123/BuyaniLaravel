<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsd elivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Fade Animation -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
    <!-- Poppins font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
        overflow-x: hidden;
        font-family: 'Poppins', sans-serif;
        }
        .hero-section {
            font-family: 'Poppins', sans-serif;
            background: #f8f9fa;
            padding: 60px 0;
        }
        .feature-icon {
            font-size: 2rem;
        }
    </style>
</head>
<body>
    <!-- NavBar -->
    <?php include 'navbar-consumer.php' ?>

    <!-- Main Page -->
    <section class="hero-section d-flex align-items-center" style="background-image: url(img/stockImg3.png); background-repeat: no-repeat; background-size: cover; background-position: center; height: 650px;">
        <div class="container">
            <h1 class="display-4" style="color: #FFFF; font-size: 60px; font-weight: bold; margin-bottom: -10px;">EMPOWER FARMERS</h1>
            <h1 style="color: #F39634; font-size: 60px; font-weight: bold; display: inline;">ENRICH </h1><h1 style="color: #69A543; font-size: 60px; font-weight: bold; display: inline;">COMMUNITIES</h1>
            <p class="lead" style="color: #FFFF; font-size: 22px; font-weight: bold;">BuyAni, Where Every Purchase is a Celebration of Hard Work and Fresh Harvests</p>
            <a href="consumer-shop.php" class="btn btn-lg" style="background-color: #F39634; color: #FFFF;">SHOP NOW!</a>
        </div>
    </section>

    <!-- Our Products -->
    <section class="text-center p-3">
        <h1>Our Best Sellers</h1>
        <p>Freshly delivered from our local farmers!</p>
        <div class="container">
            <!-- lagayan ng best sellers -->
        </div>
    </section>

    <!-- Details -->
     <section>
        <div class="row p-5">
            <div class="col-md-6 d-flex justify-content-center" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="100">
                <img src="img/stockImg.png" alt="Landscape Image" width="600" height="400" style="border-radius: 20px;">
            </div>
            <div class="col-md-6 px-5">
                <h4>Lorem Ipsum</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
            </div>
        </div>
        <div class="row p-5">
            <div class="col-md-6 px-5">
                <h4>Lorem Ipsum</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
            </div>
            <div class="col-md-6 d-flex justify-content-center" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="100">
                <img src="img/stockImg2.png" alt="Landscape Image" width="600" height="400" style="border-radius: 20px;">
            </div>
        </div>
     </section>

     <!-- Contact Us -->
     <section class="p-3" style="background-image: url(img/stockImg5.png); background-repeat: no-repeat; background-size: cover; background-position: center; height: 450px;">
        <div class="row h-100 d-flex align-items-center">
            <div class="col-md-6 d-flex flex-column align-items-center justify-content-center">
                <h3 class="pb-2" style="color:chartreuse;">Contact Us For Inquiries!</h3>
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d294.38162674181825!2d123.71843815368132!3d13.15098642433476!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33a1015eccf097cb%3A0x8e91fc8310d08926!2sVKY%20FRUITS%20AND%20VEGETABLES%20TRADING!5e0!3m2!1sen!2sph!4v1726749600004!5m2!1sen!2sph"
                    width="400"
                    height="300"
                    style="border: 2px solid #000; border-radius: 20px;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
            <div class="col-md-6 d-flex align-items-center">
                <div class="container p-3" style="width:500px; background-color: #5DC14C; border: solid black 2px; border-radius: 20px">
                    <h2 class="text-center">Contact Form</h2>
                    <form>
                        <div class="form-group p-1">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter your name">
                        </div>
                        <div class="form-group p-1">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter your email">
                        </div>
                        <div class="form-group p-1">
                            <label for="message">Message</label>
                            <textarea class="form-control" id="message" rows="3" placeholder="Enter your message"></textarea>
                        </div>
                        <div class="text-center pt-1">
                            <button type="submit" class="btn" style="background-color: #F39634; color: #FFFF;">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'footer.php' ?>

    
    <!-- JAVASCRIPTS -->
    <!-- Navbar toggle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Fade animation -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init();
        });
    </script>
    
</body>
</html>
