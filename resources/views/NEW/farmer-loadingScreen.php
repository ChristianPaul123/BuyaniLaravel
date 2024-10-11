<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrot Loading Screen</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.8); 
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            flex-direction: column;
            color: white; 
            font-size: 48px;
        }
        .carrot {
            animation: bounce 1s infinite;
        }
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-20px);
            }
            60% {
                transform: translateY(-10px);
            }
        }
    </style>
</head>
<body>

    <div class="loading-screen" id="loadingScreen">
        <div class="text-center">
            <div class="carrot">🥕</div>
            <h4 class="mt-3">Loading, please wait...</h4>
        </div>
    </div>

    <script>
        // Simulate loading delay
        setTimeout(() => {
            document.getElementById('loadingScreen').style.display = 'none';
        }, 3000); // Change this duration as needed
    </script>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
