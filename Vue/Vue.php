<?php

require_once __DIR__ . "/../vendor/autoload.php";
class Vue
{

    // Nom du fichier associé à la vue
    private $fichier;


    public function __construct($action)
    {
        // Détermination du nom du fichier vue à partir de l'action
        $this->fichier = "vue" . $action . ".twig";
    }

    // Génère et affiche la vue
    public function generer($donnees) {
        $loader = new \Twig\Loader\FilesystemLoader('Vue');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load($this->fichier);
        echo $template->render($donnees);
//        // Génération de la partie spécifique de la vue
//        $contenu = $this->genererFichier($this->fichier, $donnees);
//        // Génération du gabarit commun utilisant la partie spécifique
//        $vue = $this->genererFichier('Vue/gabarit.twig', array(
//            'titre' => $this->titre,
//            'contenu' => $contenu
//        ));
//        // Renvoi de la vue au navigateur
//        echo $vue;
//        //echo $contenu;
    }

    // Génère un fichier vue et renvoie le résultat produit
    private function genererFichier($fichier, $donnees)
    {
        if (file_exists($fichier)) {
            // Rend les éléments du tableau $donnees accessibles dans la vue
            extract($donnees);
            // Démarrage de la temporisation de sortie
            ob_start();
            // Inclut le fichier vue
            // Son résultat est placé dans le tampon de sortie
            require $fichier;
            // Arrêt de la temporisation et renvoi du tampon de sortie
            return ob_get_clean();
        } else {
            throw new Exception("Fichier '$fichier' introuvable");
        }
    }
}