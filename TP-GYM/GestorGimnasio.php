<?php

class GestorGimnasio {
    // 1. Atributo estático privado para la única instancia
    private static $instancia = null;
    
    // Listas para almacenar los datos críticos
    private $socios = [];
    private $clases = [];

    // 2. Constructor privado para evitar 'new GestorGimnasio()' desde afuera
    private function __construct() {
        // Inicializamos la sesión para que la demo funcione y no se borren los datos al recargar
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        // Recuperamos los socios si ya había guardados en la sesión
        if (isset($_SESSION['lista_socios'])) {
            $this->socios = $_SESSION['lista_socios'];
        }
    }

    // Evitamos que se pueda clonar el objeto
    private function __clone() {}

    // 3. Método estático global para obtener la instancia
    public static function getInstance() {
        if (self::$instancia === null) {
            self::$instancia = new GestorGimnasio();
        }
        return self::$instancia;
    }

    // Métodos de negocio
    public function registrarSocio($socio) {
        $this->socios[] = $socio;
        $_SESSION['lista_socios'] = $this->socios; // Persistencia visual para la demo
    }

    public function obtenerSocios() {
        return $this->socios;
    }

    public function reservarTurno($turno) {
        return "Turno reservado: " . $turno;
    }
}
?>