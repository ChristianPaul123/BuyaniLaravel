
    <style>
        .loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(90, 79, 79, 0.761);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 99;
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

    <div class="loading-screen" id="loadingScreen">
        <div class="text-center">
            <div class="carrot">🥕🧑‍🌾</div>
            <h4 class="mt-3">Loading, please wait...</h4>
        </div>
    </div>

    <script>
        // Simulate loading delay
        setTimeout(() => {
            document.getElementById('loadingScreen').style.display = 'none';
        }, 2000); // Change this duration as needed
    </script>
