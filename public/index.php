<?php

use App\Kernel;
use Symfony\Component\Debug\Debug;
use Symfony\Component\HttpFoundation\Request;

require dirname(__DIR__).'/config/bootstrap.php';

if ($_SERVER['APP_DEBUG']) {
    umask(0000);

    Debug::enable();
}

if ($trustedProxies = $_SERVER['TRUSTED_PROXIES'] ?? $_ENV['TRUSTED_PROXIES'] ?? false) {
    Request::setTrustedProxies(explode(',', $trustedProxies), Request::HEADER_X_FORWARDED_ALL ^ Request::HEADER_X_FORWARDED_HOST);
}

if ($trustedHosts = $_SERVER['TRUSTED_HOSTS'] ?? $_ENV['TRUSTED_HOSTS'] ?? false) {
    Request::setTrustedHosts([$trustedHosts]);
}

// on active le kernel
$kernel = new Kernel($_SERVER['APP_ENV'], (bool) $_SERVER['APP_DEBUG']);
// Création de l'objet request qui fait le raccourci vers les methodes
// GET , POST, FILE, SERVER
$request = Request::createFromGlobals();
// Symfo va attraper la request par la méthode handle disponible dans le kernel
// il recupère la requete, vous définit le type de requète et vous renvoie une réponse
$response = $kernel->handle($request);
// une fois qu'il a la réponse il la renvoie
$response->send();
// apres il termine le boulot
$kernel->terminate($request, $response);
