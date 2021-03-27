<?php

require_once __DIR__ . "/../vendor/autoload.php";

class Vue {
    private $fichier;

    public function __construct($action) {
        $this->fichier = "vue" . $action . ".twig";
    }

    public function generer($donnees) {
        $loader = new \Twig\Loader\FilesystemLoader('Vue');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load($this->fichier);
        echo $template->render($donnees);
    }
}