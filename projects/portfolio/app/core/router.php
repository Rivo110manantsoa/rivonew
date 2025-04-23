<?php 

class Router 
{
    protected $controller = "home";  // Contrôleur par défaut
    protected $method = "index";     // Méthode par défaut
    protected $params = [];          // Paramètres supplémentaires

    public function __construct() {
        // Récupérer l'URL et la nettoyer
        $url = $this->getURL();

        // Vérifier si le contrôleur existe
        if (!empty($url[0]) && file_exists("../app/controllers/" . strtolower($url[0]) . ".php")) {
            $this->controller = strtolower($url[0]); // Charger le bon contrôleur
            unset($url[0]);
        } 
        
        require "../app/controllers/" . $this->controller . ".php";
        $this->controller = new $this->controller;

        // Vérifier si la méthode existe dans le contrôleur
        if (!empty($url[1]) && method_exists($this->controller, strtolower($url[1]))) {
            $this->method = strtolower($url[1]); // Charger la méthode spécifiée
            unset($url[1]);
        }

        // Collecter les paramètres restants
        $this->params = !empty($url) ? array_values($url) : []; // Convertir les valeurs en tableau indexé

        // Appeler la méthode avec les paramètres
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    /**
     * Extraire l'URL depuis $_GET['url']
     */
    private function getURL() {
        $url = isset($_GET['url']) ? $_GET['url'] : "home";
        return explode("/", filter_var(trim($url, "/"), FILTER_SANITIZE_URL));
    }

}
