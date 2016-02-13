<?php
    //session_start();
    
    /**
     * Prend un titre complet au format "dd/mm/yyyy - Title",
     * et le découpe en deux variables prêtes à être utilisées dans une requête.
     *
     * @return Un tableau de deux chaînes de caractères, avec la date formatée et le titre.
     */
    function decoupage_full_title($full_title)
    {
        $date= substr($full_title, 0, 10);
        
        $dateT= date_create();
        date_date_set($dateT, substr($date, 6, 4), substr($date, 3, 2), substr($date, 0, 2));
        
        $date= date_format($dateT, "Y-m-d");
        $title= substr($full_title, 13, strlen($full_title) - 1);
        
        return array ($date, $title);
    }

    /*
     * Mise à zéro des variables de session,
     * et destruction de la session.
     */
    function deconnexion()
    {
        session_unset();
        session_destroy();
        header('Location: espPro.php');
    }
?>
