<?php
session_start();
if (!isset($_SESSION['id_user'])) {
    header("location: ../../../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Chat App</title>
    <!-- Lien Css -->
    <link rel="stylesheet" href="/SGRC/css/style_admin/message/message.css" />
    <!-- Font Awsome -->
    <script src="https://kit.fontawesome.com/438cd94e6c.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="right">
        <div class="theme-toggler" id="theme-toggler">
            <!-- Dark and Light -->
            <i class="fa-solid fa-circle-half-stroke"></i>
        </div>
    </div>
    <div class="wrapper">
        <!-- La section titre formuliare -->
        <section class="chat">
            <header>
                <?php
                include_once "../../../php/connexion.php";
                $id_user = mysqli_real_escape_string($link, $_GET['id_user']);
                $sql = mysqli_query($link, "SELECT * FROM user WHERE id_user = {$id_user}");
                if (mysqli_num_rows($sql) > 0) {
                    $row = mysqli_fetch_assoc($sql);
                }
                ?>
                <a href="users.php" class="back-icon"><i class="fa-solid fa-arrow-left"></i></a>
                <img src="../../../php/images/<?php echo $row['image']; ?>" alt="">
                <div class="details">
                    <span><?php echo $row['login'] ?></span>
                    <p><?php echo $row['status']; ?></p>
                </div>
            </header>
            <div class="chat-box">
            </div>
            <form action="" class="typing-area" autocomplete="off">
                <!-- Message sortant  outgoing_id -->
                <input type="text" name="id_expediteur" value="<?php echo $_SESSION['id_user'];  ?>" hidden>
                <!-- Message entrant  incoming -->
                <input type="text" name="id_destinataire" value="<?php echo $id_user; ?>" hidden>
                <input type="text" name="message" class="input-field" autofocus="autofocus" placeholder="Message" />
                <button><i class="fa-solid fa-paper-plane"></i></button>
            </form>
        </section>
    </div>
    <!-- Script DarkMode -->
    <script src="/SGRC/js/source/dark_mode.js"></script>
    <!-- SCRIPT FONT AWESOME -->
    <script src="https://kit.fontawesome.com/438cd94e6c.js" crossorigin="anonymous"></script>
    <script src="/SGRC/js/admin/message/chat.js"></script>
</body>

</html>