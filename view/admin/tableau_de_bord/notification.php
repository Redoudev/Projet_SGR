<?php
session_start();
include_once "../../../php/connexion.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!-- Notification -->
    <div class="notifications">
        <!-- Icone -->
        <ul>
            <li>
                <?php
                $sql = "SELECT *, DATE_FORMAT(date, '%d/%m/%Y %H:%i:%S') AS 'date' FROM messages
                INNER JOIN user ON messages.id_expediteur = user.id_user
                WHERE id_destinataire = {$_SESSION['id_user']} 
                ORDER BY id_message DESC LIMIT 3 ;";
                $res = mysqli_query($link, $sql);
                ?>
                <?php
                $sql_get = mysqli_query($link, "SELECT * FROM messages WHERE lu=0 AND id_destinataire = {$_SESSION['id_user']} ");
                $count = mysqli_num_rows($sql_get);
                ?>
                <a href="#">
                    <label for="check"><i class="fa-solid fa-bell"></i>
                        <span class="count"><?php echo $count ?> </span>
                    </label>
                </a>
                <input type="checkbox" class="dropdown-check" id="check">
                <ul class="dropdown">
                    <?php

                    if (mysqli_num_rows($res) > 0) {
                        foreach ($res as $message) {
                    ?>
                            <!-- A remetre -->
                            <div class="notify_item">
                                <li>
                                    <div class="notify_img">
                                        <a href="/SGRC/view/admin/message/chat.php?id_user=<?php echo $message['id_user']; ?>" target="_blank">
                                            <img src="../../../php/images/<?php echo $message['image']; ?>" alt="">
                                    </div>
                                    <div class="notify_info">
                                        <p><?php echo $message['login']; ?> vous a envoyé :</p>
                                        <p> <?php echo $message['message']; ?></p>
                                        <span class="notify_time">Le <?php echo $message['date']; ?></span>
                                    </div>
                                    </a>
                                </li>
                            </div>
                    <?php }
                    } else {
                        echo '<li><a href="#" class="text-bold text-italic">Aucune notification trouvée</a></li>';
                    }
                    ?>
                </ul>
            </li>
        </ul>
    </div>
</body>

</html>