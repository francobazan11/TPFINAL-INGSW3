<?php

// ==========================================
// 1. LA INTERFAZ STRATEGY
// ==========================================
interface IRutinaStrategy {
    public function generarRutina();
}

// ==========================================
// 2. LAS ESTRATEGIAS CONCRETAS
// ==========================================
class RutinaFuerza implements IRutinaStrategy {
    public function generarRutina() {
        return "🏋️‍♂️ Rutina de Fuerza: 4 series de 8-10 repeticiones (Pesos libres).";
    }
}

class RutinaCardio implements IRutinaStrategy {
    public function generarRutina() {
        return "🏃‍♂️ Rutina de Cardio: 45 min en cinta (HIIT) + 15 min de remo.";
    }
}

class RutinaPerdidaPeso implements IRutinaStrategy {
    public function generarRutina() {
        return "🔥 Rutina Pérdida de Peso: Circuito funcional + 30 min bicicleta.";
    }
}

// ==========================================
// 3. EL CONTEXTO (El Usuario)
// ==========================================
class Usuario {
    private $nombre;
    private $estrategia; 

    public function __construct($nombre) {
        $this->nombre = $nombre;
    }

    public function setEstrategia(IRutinaStrategy $nuevaEstrategia) {
        $this->estrategia = $nuevaEstrategia;
    }

    public function solicitarRutina() {
        if ($this->estrategia == null) {
            return "❌ Primero debes definir un objetivo.";
        }
        return $this->estrategia->generarRutina();
    }
}
?>