<style>
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
        animation: fadeInDown 0.15s ease-out forwards; /* Faster appearance */
        font-weight: bold;
        color: #d97a18;
        overflow: hidden;
        display: none; /* Default hidden */
    }

    .notif.hidden {
        animation: fadeOutUp 0.15s ease-in forwards; /* Faster disappearance */
    }

    .container-right {
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

    /* Success notification style */
    .notif.success {
        background-color: #e8f8e5;
        border: 3px solid #28a745;
        color: #28a745;
    }

    .notif.success i {
        background-color: #28a745;
        color: #e8f8e5;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 50px;
        flex-shrink: 0;
        font-size: 30px;
        border-radius: 50%;
    }

    /* Error notification style */
    .notif.error {
        background-color: #fde8e8;
        border: 3px solid #dc3545;
        color: #dc3545;
    }

    .notif.error i {
        background-color: #dc3545;
        color: #fde8e8;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 50px;
        flex-shrink: 0;
        font-size: 30px;
        border-radius: 50%;
    }
</style>
