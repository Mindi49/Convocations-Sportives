<?php

require_once __DIR__ . "/../vendor/autoload.php";

/**
 * Classe modélisant une vue
 */
class Vue {
    /** Nom du fichier associé à la vue. */
    private $fichier;

    /**
     * Constructeur d'une vue.
     *
     * @param $action   Action à laquelle est associée la vue.
     */
    public function __construct($action) {
        $this->fichier = "vue" . $action . ".twig";
    }

    /**
     * Génère et affiche la vue.
     *
     * @param $donnees  Les données nécessaires à la génération de la vue.
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function generer($donnees) {
        $loader = new \Twig\Loader\FilesystemLoader('Vue');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load($this->fichier);
        echo $template->render($donnees);
    }
}