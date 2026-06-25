<?php

/**
 * EL PATRÓN OBSERVER
 * Propósito: Define una dependencia de uno a muchos entre objetos.
 */

// ==========================================
// 1. PARTICIPANTE: Observador (Observer)
// Interfaz con el método actualizar(mensaje).
// ==========================================
interface IObservador {
    public function actualizar($mensaje);
}

// ==========================================
// 2. PARTICIPANTE: Observable (Subject)
// Interfaz que define el contrato para gestionar observadores.
// ==========================================
interface IObservable {
    public function agregarObservador(IObservador $observador);
    public function eliminarObservador(IObservador $observador);
    public function notificarObservadores($mensaje);
}

// ==========================================
// 3. PARTICIPANTE: GimnasioNotificador (Sujeto Concreto)
// Implementa Observable. Mantiene la lista de observadores.
// ==========================================
class GimnasioNotificador implements IObservable {
    private $observadores = []; // Lista interna de observadores
    private $ultimasNovedades = [];

    public function agregarObservador(IObservador $observador) {
        $id = spl_object_hash($observador);
        $this->observadores[$id] = $observador;
    }

    public function eliminarObservador(IObservador $observador) {
        $id = spl_object_hash($observador);
        unset($this->observadores[$id]);
    }

    // Cuando el gimnasio llama a publicarNovedad(msg), almacena y dispara notificaciones
    public function publicarNovedad($mensaje) {
        $this->ultimasNovedades[] = $mensaje;
        $this->notificarObservadores($mensaje);
    }

    // Recorre la lista e invoca actualizar() en cada uno
    public function notificarObservadores($mensaje) {
        foreach ($this->observadores as $observador) {
            $observador->actualizar($mensaje);
        }
    }

    public function getNovedades() {
        return $this->ultimasNovedades;
    }
}

// ==========================================
// 4. PARTICIPANTE: UsuarioSuscrito (Observador Concreto)
// Representa un usuario. Al recibir actualizar(msg), lo procesa y almacena.
// ==========================================
class UsuarioSuscrito implements IObservador {
    private $nombre;
    private $notificaciones = [];

    public function __construct($nombre) {
        $this->nombre = $nombre;
    }

    public function actualizar($mensaje) {
        // Procesa y almacena la notificación
        $this->notificaciones[] = "🔔 [Para {$this->nombre}]: {$mensaje}";
    }

    public function getNotificaciones() {
        return $this->notificaciones;
    }
    
    public function getNombre() {
        return $this->nombre;
    }
}
