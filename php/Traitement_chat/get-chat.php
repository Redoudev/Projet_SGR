<?php
session_start();
if (isset($_SESSION['id_user'])) {
    include_once "../connexion.php";
    $id_expediteur = mysqli_real_escape_string($link, $_POST['id_expediteur']);
    $id_destinataire = mysqli_real_escape_string($link, $_POST['id_destinataire']);
    $output = "";

    $sql = "SELECT * FROM messages 
    LEFT JOIN user ON user.id_user = messages.id_expediteur
    
    WHERE (id_expediteur = {$id_expediteur} AND id_destinataire = {$id_destinataire})
    OR (id_expediteur = {$id_destinataire} AND id_destinataire = {$id_expediteur})  
    ORDER BY id_message";


    $query = mysqli_query($link, $sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            if ($row['id_expediteur'] === $id_expediteur) { // if this is equal to then is msg sender
                $output .= '<div class="chat message_sortant">
                <div class="details">
                <p>' . $row['message'] . '</p>
                </div>
              </div>';
            } else { // he is a msg receiver
                $output .= '<div class="chat message_entrant">
                <img src="/SGRC/php/images/' . $row['image'] . '   " alt="" />
                <div class="details">
                <p>' . $row['message'] . '</p>
                </div>
              </div>';
            }
        }
        echo $output;
    }
} else {
    header("../../../index.php");
}
