<style>
    .notif {
        position: fixed;
        z-index: 1050;

        left: 50%;
        top: 3%;
        transform: translateX(-50%);
        transition: all 0.3s ease-in-out;

        display: flex;
        padding: 0;
        height: auto;
        min-height: 80px;
        width: auto;
    }

    .container1{
        height: auto;
        width: 60px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .icon-modal{
        font-size: 2rem;
        color: #fff8dd;
    }

    .container2{
        height: auto;
        display: flex;
        flex-direction: column;
        justify-content: center; /* Centers content horizontally */
        align-items: center;     /* Centers content vertically */
        background-color: #fff8dd;
    }

    .error-list{
        margin: 0 auto;
        width: fit-content;
    }

    .exit-modal {
        font-size: 1.5rem; /* Adjust size as desired (e.g., 1.5rem, 24px, etc.) */
        color: #000; /* Optional: Set icon color */
        cursor: pointer; /* Optional: Make it visually indicate it's clickable */
        background-color: #fff8dd;
    }




    .notif-error{
        border: 5px solid #d91818;
    }
    .notif-message{
        border: 5px solid #d97a18;
    }
    .notif-success{
        border: 5px solid #4caf50;
    }

    .container-error{
        background-color: #d91818;
        border-right: 5px solid #d91818;
    }
    .container-message{
        background-color: #d97a18;
        border-right: 5px solid #d97a18;
    }
    .container-success{
        background-color: #4caf50;
        border-right: 5px solid #4caf50;
    }


    @media (max-width: 768px) {
        .notif {
            display: flex;
            padding: 0;
            height: auto;
            min-height: 80px;
            width: 90%;
        }
    }



</style>
























{{-- <style>

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
        width: 10%;
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
</style> --}}
