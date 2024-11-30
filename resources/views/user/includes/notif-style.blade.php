<style>
    @keyframes fadeInDown {
        from {
            transform: translate(-50%, -55%);
            opacity: 0;
        }
        to {
            transform: translate(-50%, -50%);
            opacity: 1;
        }
    }

    @keyframes fadeOutUp {
        from {
            transform: translate(-50%, -50%);
            opacity: 1;
        }
        to {
            transform: translate(-50%, -55%);
            opacity: 0;
        }
    }

    .notif {
        background-color: #fff8dd;
        border: 3px solid #d97a18;
        border-radius: 10px;
        position: fixed;
        top: 15%;
        left: 50%;
        transform: translateX(-50%);
        text-align: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        animation: fadeInDown 0.3s ease-out forwards;
        font-weight: bold;
        color: #d97a18;
        overflow: hidden;
    }

    .notif.hidden {
        animation: fadeOutUp 0.3s ease-in forwards;
    }

    .container-right{
        padding: 15px;
    }

    .notif i:nth-of-type(1) {
        z-index: 2;
        background-color: #d97a18;
        color: #fff8dd;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 50px;
        flex-shrink: 0;
        font-size: 30px;
    }
</style>
