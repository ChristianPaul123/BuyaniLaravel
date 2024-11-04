<style>
    .message {
        position: absolute;
        top:0;
        margin:10px 0 0 0;
        width: 95%;
        background-color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        padding:2rem;
        gap:1.5rem;
        border-radius: 40px;
        z-index: 10000;
        border: 10px black;
        justify-content: space-between;
        }
        .message span{
        color:black;
        font-size: 2rem;
        }
        .message i{
        font-size: 2.5rem;
        color:red;
        cursor: pointer;
        }
        .message i:active{
        transform: rotate(90deg);
        }
</style>


<?php
session_start();
?>

<?php if (isset($_SESSION["message"])) {
    ?>
<div class="message">
      <span> <?php echo $_SESSION['message'] ?> </span>
      <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
     <?php  unset($_SESSION['message']); ?>
  </div>

  <?php } ?>
