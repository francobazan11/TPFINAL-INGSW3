<?php
// Incluimos la lógica del patrón Strategy (Tu backend)
require_once 'Estrategias.php';
require_once 'Notificador.php';

// --- Lógica del Patrón Observer (Simulación) ---
$gym = new GimnasioNotificador();

// Creamos un par de usuarios observadores
$user1 = new UsuarioSuscrito("Marcos");
$user2 = new UsuarioSuscrito("Ana");

// Los suscribimos al gimnasio
$gym->agregarObservador($user1);
$gym->agregarObservador($user2);

// Simulamos una novedad si se presiona un botón
$notificacionEnviada = null;
if (isset($_POST['enviar_notificacion'])) {
    // Si escribió algo personalizado, usamos eso. Si no, el valor del select.
    $mensaje = !empty($_POST['mensaje_personalizado']) 
               ? $_POST['mensaje_personalizado'] 
               : ($_POST['mensaje_notificacion'] ?? "¡Nueva promoción disponible!");
               
    // Cuando hay una novedad, el cliente llama a publicarNovedad()
    $gym->publicarNovedad($mensaje);
    $notificacionEnviada = $mensaje;
}


// Creamos al usuario
$clienteGym = new Usuario("Marcos");
$resultadoRutina = null;

// Evaluamos si el usuario hizo clic en alguna de las tarjetas de clase
if (isset($_GET['objetivo'])) {
    $objetivo = $_GET['objetivo'];
    
    if ($objetivo == 'fuerza') {
        $clienteGym->setEstrategia(new RutinaFuerza());
    } elseif ($objetivo == 'cardio') {
        $clienteGym->setEstrategia(new RutinaCardio());
    } elseif ($objetivo == 'peso') {
        $clienteGym->setEstrategia(new RutinaPerdidaPeso());
    }
    
    $resultadoRutina = $clienteGym->solicitarRutina();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zenith Gym</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        /* El fondo oscuro del Hero igual al de tu imagen */
        .hero-bg {
            background: linear-gradient(to right, rgba(15, 23, 42, 0.9) 0%, rgba(15, 23, 42, 0.4) 100%), url('https://images.unsplash.com/photo-1534438327276-14e5300c3a48?q=80&w=1470&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="bg-[#f8fafc] text-slate-800">

    <nav class="flex justify-between items-center py-4 px-8 bg-white shadow-sm border-b border-gray-100">
        <div class="flex items-center gap-3 text-[#1d4ed8] font-bold text-xl">
            <i class="fa-solid fa-dumbbell text-xl"></i>
            Zenith Gym
        </div>
        <button class="text-[#1e3a8a] hover:text-blue-600 text-2xl">
            <i class="fa-solid fa-bars"></i>
        </button>
    </nav>

    <header class="hero-bg h-[450px] flex items-center px-12 mx-4 mt-4 rounded-xl shadow-lg relative overflow-hidden">
        <div class="max-w-2xl text-white relative z-10">
            <h1 class="text-[3rem] font-extrabold leading-tight mb-4 tracking-tight">Transformá tu cuerpo, mejorá tu vida</h1>
            <p class="text-lg text-slate-200 mb-8 font-medium">Tu mejor versión comienza hoy en el gimnasio más avanzado de la ciudad.</p>
            <a href="#clases" class="inline-block bg-[#1d4ed8] hover:bg-blue-800 text-white font-semibold py-3 px-8 rounded-lg transition duration-300">
                Ver Clases
            </a>
        </div>
    </header>

    <section class="max-w-5xl mx-auto mt-6 grid grid-cols-2 gap-4 px-4">
        <div class="bg-white p-6 rounded-xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-gray-100 text-center flex flex-col justify-center">
            <h2 class="text-2xl font-bold text-[#1d4ed8]">+10</h2>
            <p class="text-gray-500 text-sm mt-1">Años de Experiencia</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-gray-100 text-center flex flex-col justify-center">
            <h2 class="text-2xl font-bold text-[#1d4ed8]">Top</h2>
            <p class="text-gray-500 text-sm mt-1">Instalaciones</p>
        </div>
    </section>

    <section id="clases" class="max-w-5xl mx-auto mt-16 px-4 mb-20">
        <h3 class="text-center text-xl font-medium mb-8 text-gray-800">Clases Diseñadas para Vos</h3>

        <?php if ($resultadoRutina): ?>
        <div class="bg-slate-900 border-l-4 border-blue-500 p-6 rounded-lg mb-8 text-white shadow-xl animate-fade-in-down">
            <div class="flex items-center gap-3 mb-2">
                <i class="fa-solid fa-robot text-blue-400"></i>
                <h4 class="text-sm uppercase tracking-widest text-slate-300 font-bold">Rutina Generada por el Sistema</h4>
            </div>
            <p class="text-emerald-400 font-mono text-lg mt-2">
                > <?php echo $resultadoRutina; ?>
            </p>
        </div>
        <?php endif; ?>
        
        <a href="?objetivo=fuerza#clases" class="block w-full bg-[#2563eb] text-white p-8 rounded-xl shadow-md cursor-pointer hover:bg-blue-700 transition mb-4">
            <i class="fa-solid fa-dumbbell text-2xl mb-4 text-blue-200"></i>
            <h4 class="text-xl font-bold mb-1">Musculación</h4>
            <p class="text-blue-100 text-sm">Fuerza y definición con equipamiento premium.</p>
        </a>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            
            <a href="?objetivo=peso#clases" class="block bg-white p-6 rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition">
                <i class="fa-solid fa-child-reaching text-[#2563eb] text-xl mb-3"></i>
                <h4 class="text-base font-bold text-gray-900 mb-1">CrossFit</h4>
                <p class="text-gray-500 text-sm">Intensidad pura para resultados reales.</p>
            </a>

            <a href="?objetivo=peso#clases" class="block bg-white p-6 rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition">
                <i class="fa-solid fa-person-running text-[#2563eb] text-xl mb-3"></i>
                <h4 class="text-base font-bold text-gray-900 mb-1">Funcional</h4>
                <p class="text-gray-500 text-sm">Movimientos naturales, fuerza integral.</p>
            </a>

            <a href="?objetivo=cardio#clases" class="block bg-white p-6 rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition">
                <i class="fa-solid fa-person-biking text-[#2563eb] text-xl mb-3"></i>
                <h4 class="text-base font-bold text-gray-900 mb-1">Spinning</h4>
                <p class="text-gray-500 text-sm">Cardio explosivo al ritmo de la música.</p>
            </a>

            <a href="#" class="block bg-white p-6 rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition">
                <i class="fa-solid fa-spa text-[#2563eb] text-xl mb-3"></i>
                <h4 class="text-base font-bold text-gray-900 mb-1">Yoga</h4>
                <p class="text-gray-500 text-sm">Flexibilidad y paz mental para tu día.</p>
            </a>

        </div>
    </section>

    <!-- SECCIÓN PATRÓN OBSERVER -->
    <section class="max-w-5xl mx-auto mt-12 px-4 mb-20">
        <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-100 overflow-hidden relative">
            <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-full -mr-16 -mt-16 opacity-50"></div>
            
            <div class="flex items-center gap-4 mb-8 relative z-10">
                <div class="bg-blue-600 p-3 rounded-xl shadow-lg shadow-blue-200">
                    <i class="fa-solid fa-bell text-white text-xl"></i>
                </div>
                <div>
                    <h3 class="text-2xl font-extrabold text-slate-800 tracking-tight">Sistema de Notificaciones</h3>
                    <p class="text-slate-500 font-medium">Enviar Notificacion a Suscriptores en tiempo real</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 relative z-10">
                <!-- PANEL DE CONTROL (SUJETO) -->
                <div class="md:col-span-1 bg-slate-50 p-6 rounded-2xl border border-slate-200">
                    <h4 class="font-bold text-slate-700 mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-tower-broadcast text-blue-600"></i>
                        GimnasioNotificador
                    </h4>
                    <form method="POST" class="space-y-4">
                        <div>
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block mb-2">Mensajes rápidos</label>
                            <select name="mensaje_notificacion" class="w-full p-3 bg-white border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 outline-none transition-all shadow-sm">
                                <option value="¡2x1 en pases mensuales este fin de semana!">🔥 Promoción 2x1</option>
                                <option value="Mañana el gimnasio abrirá a las 07:00hs por feriado.">⏰ Cambio de Horario</option>
                                <option value="Masterclass de Zumba este Sábado a las 10:00hs.">💃 Evento Especial</option>
                            </select>
                        </div>
                        
                        <div>
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block mb-2">O escribe tu propio mensaje</label>
                            <input type="text" name="mensaje_personalizado" placeholder="Ej: ¡Hoy clase de prueba gratis!" class="w-full p-3 bg-white border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 outline-none transition-all shadow-sm">
                        </div>

                        <button type="submit" name="enviar_notificacion" class="w-full bg-blue-600 text-white font-bold py-4 rounded-xl hover:bg-blue-700 transition-all transform hover:-translate-y-1 shadow-lg shadow-blue-200 active:scale-95">
                            Notificar Suscriptores
                        </button>
                    </form>
                </div>

                <!-- USUARIOS SUSCRITOS (OBSERVADORES) -->
                <div class="md:col-span-2 space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Usuario 1 -->
                        <div id="card-user1" class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm transition-all hover:shadow-md relative">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white font-bold shadow-md">M</div>
                                    <div>
                                        <span class="block font-bold text-slate-800 text-sm"><?php echo $user1->getNombre(); ?></span>
                                        <span id="status-user1" class="block text-[10px] text-emerald-500 font-bold uppercase tracking-tighter">Suscrito</span>
                                    </div>
                                </div>
                                <button onclick="unsubscribe('user1')" class="text-[10px] bg-slate-100 text-slate-500 hover:bg-red-50 hover:text-red-500 px-2 py-1 rounded-md transition-colors font-bold uppercase">
                                    Desuscribir
                                </button>
                            </div>
                            <div id="notif-user1" class="min-h-[60px] flex items-center justify-center bg-slate-50 rounded-xl border border-dashed border-slate-200 px-4 relative">
                                <?php if ($notificacionEnviada): ?>
                                    <p class="text-xs text-slate-700 font-medium animate-bounce text-center pr-6">
                                        🔔 <?php echo $notificacionEnviada; ?>
                                    </p>
                                    <button onclick="clearNotif('notif-user1')" class="absolute top-2 right-2 text-slate-300 hover:text-slate-500">
                                        <i class="fa-solid fa-xmark text-[10px]"></i>
                                    </button>
                                <?php else: ?>
                                    <p class="text-xs text-slate-400 italic">Esperando novedades...</p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Usuario 2 -->
                        <div id="card-user2" class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm transition-all hover:shadow-md relative">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-400 to-indigo-600 flex items-center justify-center text-white font-bold shadow-md">A</div>
                                    <div>
                                        <span class="block font-bold text-slate-800 text-sm"><?php echo $user2->getNombre(); ?></span>
                                        <span id="status-user2" class="block text-[10px] text-emerald-500 font-bold uppercase tracking-tighter">Suscrito</span>
                                    </div>
                                </div>
                                <button onclick="unsubscribe('user2')" class="text-[10px] bg-slate-100 text-slate-500 hover:bg-red-50 hover:text-red-500 px-2 py-1 rounded-md transition-colors font-bold uppercase">
                                    Desuscribir
                                </button>
                            </div>
                            <div id="notif-user2" class="min-h-[60px] flex items-center justify-center bg-slate-50 rounded-xl border border-dashed border-slate-200 px-4 relative">
                                <?php if ($notificacionEnviada): ?>
                                    <p class="text-xs text-slate-700 font-medium animate-bounce text-center pr-6">
                                        🔔 <?php echo $notificacionEnviada; ?>
                                    </p>
                                    <button onclick="clearNotif('notif-user2')" class="absolute top-2 right-2 text-slate-300 hover:text-slate-500">
                                        <i class="fa-solid fa-xmark text-[10px]"></i>
                                    </button>
                                <?php else: ?>
                                    <p class="text-xs text-slate-400 italic">Esperando novedades...</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function clearNotif(id) {
            const container = document.getElementById(id);
            container.innerHTML = '<p class="text-xs text-slate-400 italic">Esperando novedades...</p>';
            container.classList.add('bg-slate-50');
        }

        function unsubscribe(userId) {
            const status = document.getElementById('status-' + userId);
            const container = document.getElementById('notif-' + userId);
            const card = document.getElementById('card-' + userId);
            
            status.innerText = 'No Suscrito';
            status.classList.remove('text-emerald-500');
            status.classList.add('text-slate-400');
            
            container.innerHTML = '<p class="text-[10px] text-red-300 uppercase font-bold tracking-widest italic">Desconectado</p>';
            card.classList.add('opacity-60', 'grayscale-[0.5]');
            
            // Aquí en un sistema real enviaríamos una petición AJAX para eliminar del Sujeto
            console.log("Observer eliminado del Sujeto dinámicamente");
        }
    </script>


</body>
</html>