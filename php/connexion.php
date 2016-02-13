<?php
    session_start();

    $id= htmlspecialchars($_POST['id']);
    $mdp= htmlspecialchars($_POST['mdp']);
    if (!(isset($id) AND isset($mdp)))
    {
        return;
    }

    $server= "localhost";
    $user= "root";
    $password= "";
    $base= "zanzibar";
    $con= mysqli_connect($server, $user, $password, $base);
    if (mysqli_connect_errno($con))
    {
        echo "<p style=\"color: #580000 ;\">Erreur de connexion : " . mysqli_connect_error() . "</p>";
        return;
    }

    $req= "SELECT * FROM users WHERE Login='" . $id . "' AND Pwd='" . $mdp . "';";
    $res= mysqli_num_rows(mysqli_query($con, $req));

    // Vrai si trouvé, Faux sinon
    $_SESSION['connexion'] = $res == 1;
    $_SESSION['author'] = $res == 1 ? $id : "";

    // echo "Session : " . session_status() . " && " . PHP_SESSION_NONE;
    // echo "<br />";
    // echo "$_SESSION : " . $_SESSION["connexion"];

    header('Location: ../espPro.php');
?>
