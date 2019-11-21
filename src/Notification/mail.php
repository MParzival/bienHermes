< ?php



$dest = "mick.aubin@gmail.Com";



$site = "Cabinet Hermes";

$expediteur = "rapport@transactium.fr";

$sujet = "MAJ & Upload BDD Cabinet Hermes";





$msg .= "Voici le resume de l'insertion dans bien_hermes :"."\r\n\r\n"

$msg .= "Total des biens pour les agences Hermès: "."\r\n\r\n";

$msg .= "Agence de ST-Etienne : "."\r\n\r\n\r\n";



$msg .= "***************************"."\r\n";





$headers = "From: ".$site." <".$expediteur.">" . "\r\n";



mail($dest, $sujet, $msg, $headers);



?>