<?php

/**
 * EL PATRÓN FACTORY METHOD
 * Propósito: Definir una interfaz para crear un objeto, pero delegar a las subclases la decisión de qué clase concreta instanciar.
 */

// ==========================================
// 1. PARTICIPANTE: Product (IRutina)
// Interfaz común de los productos a ser creados.
// ==========================================
interface IRutina {
    public function ejecutar();
}

// ==========================================
// 2. PARTICIPANTE: Creator (CreadorRutina)
// Declara el método de fábrica y define la lógica principal.
// ==========================================
abstract class CreadorRutina {
    // El Factory Method (Método de Fábrica)
    abstract protected function crearRutina(): IRutina;

    // Lógica que utiliza el producto sin acoplarse a su clase concreta
    public function generarPlan() {
        $rutina = $this->crearRutina();
        $resultado = $rutina->ejecutar();
        return "📋 Plan de entrenamiento generado: " . $resultado;
    }
}

// ==========================================
// 3. PARTICIPANTES: Concrete Creators
// Cada subclase implementa el Factory Method para instanciar su producto correspondiente.
// ==========================================

class CreadorRutinaFuerza extends CreadorRutina {
    protected function crearRutina(): IRutina {
        return new RutinaFuerza();
    }
}

class CreadorRutinaCardio extends CreadorRutina {
    protected function crearRutina(): IRutina {
        return new RutinaCardio();
    }
}

class CreadorRutinaPerdidaPeso extends CreadorRutina {
    protected function crearRutina(): IRutina {
        return new RutinaPerdidaPeso();
    }
}
?>
