<?php
// session_start();
if (isset($_SESSION['id_user'])) { //id user is logged
//   header("location: ../../../index.php");
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>La table d'Hélène</title>
    <link rel="stylesheet" href="/SGRC/css/style_admin/tableau_de_bord/login.css" />
</head>

<body>
    <section class="login form">
        <div class="box">
            <div class="container">
                <div class="form">
                    <h2>La table d'Hélène</h2>
                    <form action="index.php" method="POST"  id="ValidationDuFormulaireLogin">
                    <div class="error-txt"></div>
                        <!-- Login -->
                        <div class="inputBox">
                            <input type="text" placeholder="Login" name="login" id="login" autocomplete="off" required />
                        </div>
                        <!-- Password -->
                        <div class="password">
                            <label class="password">
                                <input type="password" placeholder="Mot de passe" name="mdp" id="mdp" autocomplete="off" required>

                                <div class="password-icon">
                                    <i data-feather="eye"></i>
                                    <i data-feather="eye-off"></i>
                                </div>
                            </label>
                        </div>
                        <!-- Envoi -->
                        <div class="inputBox button">
                            <input type="submit" value="Connexion" />
                        </div>
                        <!-- Mot de passe oublié -->
                        <p class="forget"><a href="#">Mot de passe oublié ?</a></p>
                    </form> <br> <br>
                    <p style="color:#f94144; " id="erreur"></p>
                </div>
            </div>
        </div>
    </section>
    <script src="js/admin/tableau_de_bord/login.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script>
        feather.replace();
    </script>
    <script src="/SGRC/js/admin/tableau_de_bord/eye.js"></script>
</body>

</html>