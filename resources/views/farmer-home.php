<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Fade Animation -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
    <!-- Poppins Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <!-- Chart -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Weather Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


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
        section {
            font-family: 'Poppins', sans-serif;
        }

        /* Container-top border */
        .custom-border-top {
            color: white;
            background-color: #5DC14C;
            border-radius: 30px 30px 0px 0px;
            border-style: solid;
            border-color: black;
            border-width: 3px 3px 0px 3px;
        }
        .custom-border-bottom {
            color: black; 
            background-color: #FFFFFF; 
            border-radius: 0px 0px 30px 30px; 
            border: solid black;
        }


        /* Weather */
        #weather i {
            font-size: 50px;
            margin-bottom: 10px;
        }
        #temperature {
            font-size: 20px;
            color: #333;
        }
        .sunny {
            color: orange;
        }
        .rainy {
            color: blue;
        }
        .cloudy {
            color: gray;
        }

    </style>
</head>
<body>
    <!-- NavBar -->
    <?php include 'navbar-farmer.php' ?>

    <!-- Main Page -->
    <section >
        <div class="row" class="hero-section d-flex align-items-center" style="background-image: url(img/stockImg4.png); background-repeat: no-repeat; background-size: cover; background-position: center; height: 650px;">
            <!-- Left Section -->
            <div class="col-md-4 px-5">
                <!-- Upper Part -->
                <div class="container pt-5">
                    <h1 class="display-4" style="color: #FFFF; font-size: 50px; font-weight: bold; margin-bottom: -10px;">Welcome</h1>
                    <h1 style="color: #F39634; font-size: 70px; font-weight: bold;">Farmer!</h1>
                    <p class="text-light">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    </p>
                    <button class="btn btn-warning">Learn More</button>
                </div>
                <!-- User Status -->
                <div class="row text-center px-3 mt-5">
                    <div class="row p-0 m-0">
                        <h1 class="custom-border-top py-2 m-0">Farmers Status</h1>
                        <div class="row custom-border-bottom py-3 m-0">
                            <div class="col">
                                <h5>Active</h5>
                                <h5>XXX</h5>
                            </div>
                            <div class="col m-0 p-0">
                                <h1>|</h1>
                            </div>
                            <div class="col">
                                <h5>Inactive</h5>
                                <h5>XXX</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Middle Section-->   
            <div class="col-md-3 text-center" style="color: white;">
                <div class="container mt-4 p-2" style="background-color: rgba(0, 0, 0, 0.3); border-radius: 15px; width: 90%;">
                    <div class="row">
                        <p class="card-text" id="day" style="font-weight: bold; font-size: 45px;"></p>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div id="weather" class="">
                                <i id="weatherIcon" class="me-3" style="font-size: 100px;"></i> <!-- Change the value here -->
                            </div>
                        </div>

                        <div class="col">
                            <p id="weatherText" class="mb-0" style="font-size: 25px;"></p>
                            <p id="temperature" style="font-size: 2em;"></p>
                        </div>
                    </div>
                </div>        
            </div>



            <!-- Right Section-->
            <div class="col-md-5 px-5" style="color: white;">
                <!-- Best Seller -->
                <div class="row my-4">
                    <div class="row text-center d-flex mx-auto custom-border-top">
                        <h2 class="my-2">Best Selling This Month</h2>
                    </div>
                    <div class="row text-center d-flex mx-auto py-3 custom-border-bottom">
                        <div class="col">
                            <h4 style="position: absolute;">1st</h4>
                            <img src="https://via.placeholder.com/125x125" alt="Custom Placeholder" width="125" height="125">
                            <h4>Apple</h4>
                            <h5>Amount: 500kg</h5>
                        </div>
                        <div class="col">
                            <h4 style="position: absolute;">2nd</h4>
                            <img src="https://via.placeholder.com/125x125" alt="Custom Placeholder" width="125" height="125">
                            <h4>Mango</h4>
                            <h5>Amount: 300kg</h5>
                        </div>
                        <div class="col">
                            <h4 style="position: absolute;">3rd</h4>
                            <img src="https://via.placeholder.com/125x125" alt="Custom Placeholder" width="125" height="125">
                            <h4>Banana</h4>
                            <h5>Amount: 200kg</h5>
                        </div>
                    </div>
                </div>

                <!-- Bar Graph -->
                <div class="row" style="background-color: #FFFFFF;">
                    <canvas id="myBarChart" style="max-width: 600px;"></canvas>
                </div>

                


            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'footer.php' ?>

    
    <!-- JAVASCRIPTS -->
        <!-- Navbar toggle -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Day -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
        <script>
            $(document).ready(function(){
                // Using Moment.js to get and format today's day
                var today = moment().format('dddd').toUpperCase();  // 'dddd' gives the full day name
                $('#day').text(today);
            });
        </script>

        <!-- Weather -->
        <script>
            const apiKey = '8208b36e8c45621736f862fb1933cb36';
            const city = 'Legaspi, PH';
            const apiUrl = `https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${apiKey}&units=metric`;

            fetch(apiUrl)
                .then(response => response.json())
                .then(data => {
                    const weatherElement = document.getElementById('weatherText');
                    const weatherIcon = document.getElementById('weatherIcon');
                    const temperatureElement = document.getElementById('temperature');
                    const weatherCondition = data.weather[0].main.toLowerCase();
                    const temperature = data.main.temp.toFixed(1); // Get temperature and round to 1 decimal place

                    // Set temperature text
                    temperatureElement.textContent = `${temperature}°C`;

                    // Set weather condition and icon
                    if (weatherCondition.includes('rain')) {
                        weatherElement.textContent = "It's rainy!";
                        weatherIcon.className = "fas fa-cloud-showers-heavy rainy";
                    } else if (weatherCondition.includes('clear')) {
                        weatherElement.textContent = "It's sunny!";
                        weatherIcon.className = "fas fa-sun sunny";
                    } else if (weatherCondition.includes('clouds')) {
                        weatherElement.textContent = "It's cloudy!";
                        weatherIcon.className = "fas fa-cloud cloudy";
                    } else {
                        weatherElement.textContent = "Weather is mixed!";
                        weatherIcon.className = "fas fa-cloud-sun";
                    }
                })
                .catch(error => {
                    console.error('Error fetching weather data:', error);
                    document.getElementById('weatherText').textContent = "Unable to fetch weather data.";
                    document.getElementById('temperature').textContent = "";
                });

        </script>
        <script>
            // Sample Data
            const ctx = document.getElementById('myBarChart').getContext('2d');
            const myBarChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                    datasets: [{
                        label: 'This Month’s Top Consumer Vote',
                        data: [12, 19, 3, 5, 2, 3],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    indexAxis: 'y',
                    scales: {
                        x: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    
</body>
</html>
