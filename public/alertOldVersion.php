<?php

// Using the ini_set()

ini_set("SMTP", "chrlink.net");

ini_set("sendmail_from", "chandane@chr-link.fr");

ini_set("smtp_port", "25");



$dsn = 'mysql:host=localhost;dbname=siteimmobilier;port=3306;charset=utf8';

$msg = "";



// Création et test de la connexion



try {

    $pdo = new PDO($dsn, 'parzival' , 'Mickalel00');



}

catch (PDOException $exception) {

    mail('fauxmail@votremail.com', 'PDOException', $exception->getMessage());

    exit('Erreur de connexion à la base de données');

}



// Requête pour tester la connexion

$queryUser = $pdo->query("SELECT * 
FROM alert_user
JOIN Activity ON alert_user.id_activity_id = activity.id
");

$resultatQueryUser = $queryUser->fetchAll();


//Afficher le résultat dans un tableau

print("<table border=\"1\">");

foreach ($resultatQueryUser as $key => $variable)

{

    print("<tr>");
    print("<td>".$resultatQueryUser[$key]['id']."</td>");
    print("<td>".$resultatQueryUser[$key]['postal_code']."</td>");
    print("<td>".$resultatQueryUser[$key]['name']."</td>");
    print("<td>".$resultatQueryUser[$key]['max_price']."</td>");

    print("<tr>");

    $alertId = $resultatQueryUser[$key]['id'];



    $queryBienHermes = $pdo->query("SELECT * FROM `bien_hermes`
                            LEFT OUTER JOIN `property_alert` ON bien_hermes.id = property_alert.bien_id
                            WHERE `CodePostal` =  '".$resultatQueryUser[$key]['postal_code']."' 
                            AND `PrixPublic` <= '".$resultatQueryUser[$key]['max_price']."'
                            AND `Activite` LIKE '%".$resultatQueryUser[$key]['name']."%'
                            AND property_alert.bien_id is null
                             ");

    $resultatQueryBienHermes = $queryBienHermes->fetchAll();

    print("<table border=\"1\">");

    foreach ($resultatQueryBienHermes as $key1 => $variable1)

        {


            print("<tr>");

            print("<td>".$resultatQueryBienHermes[$key1]['CodeAgence']."</td>");

            print("<td>".$resultatQueryBienHermes[$key1]['Activite']."</td>");

            print("<td>".$resultatQueryBienHermes[$key1]['PrixPublic']."</td>");

            print("<td>".$resultatQueryBienHermes[$key1]['CodePostal']."</td>");


            print("<tr>");


            $pdo->query(" INSERT INTO `property_alert`(`bien_id`, `alert_user_id`, `is_sent`) VALUES ('".$resultatQueryBienHermes[$key1]['id']."','".$alertId."','1') ");
        }


}
print("</table>");


$msg .= ("<table border=\"1\">");



foreach ($resultatQueryBienHermes as $key => $variable)

{

    $msg .= ("<tr>");

    $msg .= ("<td>".$resultatQueryBienHermes[$key]['CodeAgence']."</td>");

    $msg .= ("<td>".$resultatQueryBienHermes[$key]['Numero']."</td>");

    $msg .= ("<td>".$resultatQueryBienHermes[$key]['TitreAnnonce']."</td>");

    $msg .= ("<td>".$resultatQueryBienHermes[$key]['Activite']."</td>");

    $msg .= ("<tr>");

}



$msg .= ("</table>");



$msg .= "Voici le resume des bien_hermes :"."\r\n\r\n";

$msg .= "***************************"."\r\n";



$dest = "chandane@chr-link.fr";

//$cc = "xxxxxx@transactium.fr";



$site = "Alerte mail";

$expediteur = "c.handane@transactium.fr";

$sujet = "MAJ & Upload BDD Cabinet Hermes";





$headers = "From: ".$site." <".$expediteur.">" . "\r\n";



mail($dest, $sujet, $msg, $headers);



?>
