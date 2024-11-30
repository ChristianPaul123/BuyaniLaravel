<style>
    @keyframes fadeInDown {
        from {
            transform: translate(-50%, -55%); /* Start from above the screen */
            opacity: 0;
        }
        to {
            transform: translate(-50%, -50%); /* Center in the screen */
            opacity: 1;
        }
    }

    @keyframes fadeOutUp {
        from {
            transform: translate(-50%, -50%); /* Start from center */
            opacity: 1;
        }
        to {
            transform: translate(-50%, -55%); /* Move up to above the screen */
            opacity: 0;
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 0.6;
        }
    }

    @keyframes fadeOut {
        from {
            opacity: 0.6;
        }
        to {
            opacity: 0;
        }
    }

    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6);
        z-index: 999;
        animation: fadeIn 0.2s ease-out forwards; /* Fade in animation for the overlay */
    }

    .overlay.hidden {
        animation: fadeOut 0.2s ease-in forwards; /* Fade out animation for the overlay */
    }

    .popup {
        width: 400px;
        background-color: #ffffff;
        border: 1px solid black;
        border-radius: 5px;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        z-index: 1000;
        animation: fadeInDown 0.3s ease-out forwards; /* Slide down animation for the modal */
    }

    .popup.hidden {
        animation: fadeOutUp 0.3s ease-in forwards; /* Slide up animation for the modal */
    }

    .container-contents {
        padding: 20px;
    }

    .popup .icon-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 120px;
        font-size: 60px;
    }

    button {
        background-color: #ffc107;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }

    .popup button:hover {
        background-color: #e0a800;
    }

    .icon-container .icon {
        color: #ffffff;
    }

    .popup .close {
        color: #fff;
        position: absolute;
        top: 10px;
        right: 10px;
    }

    .min-height {
        min-height: 100vh;
    }

    .clickable-forgot-password
    {
        cursor: pointer;
        color: rgb(255, 255, 255)
    }

    .clickable-forgot-password:hover {
        color: rgba(244, 225, 22, 0.974)
    }
</style>

<style>
    .error{
        color: #842029;
    }
    .error-bg{
        background-color: #e85e6c;
    }

    .success{
        color: #208428;
    }
    .success-bg{
        background-color: #42dc3d;
    }
</style>
