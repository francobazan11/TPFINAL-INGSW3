# TP Final – Ingeniería de Software 3

Trabajo práctico final de la materia, basado en un sistema de gestión de gimnasio. El objetivo del proyecto es aplicar distintos **patrones de diseño** a problemas reales de un caso de uso concreto (altas de socios, turnos, rutinas, notificaciones, etc.), justificando para cada uno el problema que resuelve y cómo lo resuelve.

## Patrones de diseño implementados

| Patrón | Tipo | Rol en el sistema |
|---|---|---|
| **Observer** | Comportamiento | Notifica promociones, cambios de horario y eventos a los usuarios suscritos al sitio, sin acoplar el gimnasio a cada usuario concreto. |
| **Strategy** | Comportamiento | Genera rutinas de entrenamiento (fuerza, cardio, pérdida de peso) intercambiando el algoritmo según el objetivo del usuario, sin usar `if/else` en cascada. |
| **Singleton** | Creacional | Garantiza una única instancia de `GestorGimnasio` como fuente de verdad para socios, clases, turnos, pagos y profesor a cargo de esa clase. |
| **Factory Method** | Creacional | Delega en subclases (`CreadorRutinaFuerza`, `CreadorRutinaCardio`, etc.) la creación del tipo de rutina concreto, evitando instanciar clases concretas directamente. |



## Tecnologías

- **PHP** – lógica de servidor
- **JavaScript** – lógica de cliente, donde se implementan los patrones de diseño
- **HTML / CSS** – estructura y estilos del sitio
- **Apache (vía XAMPP)** – servidor local de desarrollo

## Cómo ejecutarlo

1. Instalar [XAMPP](https://www.apachefriends.org/) si no lo tenés.
2. Clonar este repositorio dentro de la carpeta `htdocs` de tu instalación de XAMPP, en una carpeta llamada `TP-GYM`:

   ```bash
   cd C:\xampp\htdocs
   git clone https://github.com/francobazan11/TPFINAL-INGSW3.git TP-GYM
   ```

   *(en Linux/Mac la ruta suele ser `/opt/lampp/htdocs` o `/Applications/XAMPP/htdocs`)*

3. Abrir el **Panel de control de XAMPP** e iniciar el módulo **Apache**.
4. Abrir el navegador y entrar a:

   ```
   http://localhost/TP-GYM/
   ```

5. Listo, ya se puede navegar el sitio y probar las funcionalidades de cada patrón.



## Autores

Trabajo práctico final desarrollado para la materia Ingeniería de Software 3, en colaboración con un compañero de cátedra.

## Editor utilizado

El proyecto se desarrolló utilizando [Antigravity](https://antigravity.google/).
