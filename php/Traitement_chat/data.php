<?php
while ($row = mysqli_fetch_assoc($sql)) {
  $sql2 = "SELECT * FROM messages WHERE (id_destinataire = {$row['id_user']} 
  OR id_expediteur  ={$row['id_user']}) AND (id_expediteur ={$id_expediteur}
  OR id_expediteur ={$id_expediteur}) ORDER BY id_message DESC LIMIT 1";

  $query2 = mysqli_query($link, $sql2);
  $row2 = mysqli_fetch_assoc($query2);
  if (mysqli_num_rows($query2) > 0) {
    $result = $row2['message'];
  } else {
    $result = "Aucun message disponible";
  }

  // Trimming message if word if word are more than 28
  (strlen($result) > 28) ? $msg = substr($result, 0, 28) . '...' : $msg = $result;

  if (isset($row2['id_expediteur'])) {
    // adding you : text before msg if login id send  msg
    ($id_expediteur == $row2['id_expediteur']) ? $moi = "Moi: " : $moi = "";
  } else {
    $moi = "";
  }
  // check user is online or offline
  ($row['status'] == "Hors ligne") ? $offline = "offline" : $offline = "";


  $output .= '<a href="../message/chat.php?id_user=' . $row['id_user'] . '">
    <div class="content">
    <img src="/SGRC/php/images/' . $row['image'] . '" alt="" />
      <div class="details">
        <span>' . $row['login'] . '</span>
        <p>' . $moi . $msg . '</p>
      </div>
    </div>
    <div class="status-dot ' . $offline . '"><i class="fa-solid fa-circle"></i></div>
  </a>';
}
