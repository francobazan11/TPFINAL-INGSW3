<?php

class GestorGimnasio {
    private static $instancia = null;
    
    private $socios = [];
    private $turnos = [];

    private function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['lista_socios'])) {
            $this->socios = $_SESSION['lista_socios'];
        }
        if (isset($_SESSION['lista_turnos'])) {
            $this->turnos = $_SESSION['lista_turnos'];
        }
    }

    private function __clone() {}

    public static function getInstance() {
        if (self::$instancia === null) {
            self::$instancia = new GestorGimnasio();
        }
        return self::$instancia;
    }

    public function registrarSocio($socio) {
        $this->socios[] = $socio;
        $_SESSION['lista_socios'] = $this->socios;
    }

    public function obtenerSocios() {
        return $this->socios;
    }

    public function reservarTurno($socio, $clase, $profesor) {
    // Guardamos el registro completo sumando al profe
        $this->turnos[] = "<b>" . $socio . "</b> reservó " . $clase . " (Profe: <b>" . $profesor . "</b>)";
        $_SESSION['lista_turnos'] = $this->turnos;
    }
    public function obtenerTurnos() {
        return $this->turnos;
    }
}
?>