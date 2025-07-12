<?php 
include 'includes/header.php';
include '../config/database.php';
?>

<!-- Mensaje de éxito si existe -->
<?php if(isset($_SESSION['success'])): ?>
    <div class="container mt-3">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php 
                echo $_SESSION['success'];
                unset($_SESSION['success']);
            ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
<?php endif; ?>

<!-- Banner principal con imagen de fondo -->
<div class="hero-section">
    <img src="/mascotas/uploads/portada.jpg" alt="Portada Adoptame Saladillo" class="hero-image">
    <div class="hero-text">
        <h1>Bienvenidos a Adoptame Saladillo</h1>
        <p>¡Encontrá a tu compañero perfecto, o ayudá a una mascota a encontrar su hogar!</p>
    </div>
</div>

<!-- Tarjetas de servicios principales -->
<div class="container mb-5">
    <div class="row g-4">
        
        <!-- Primera fila: 3 tarjetas -->
        <div class="col-md-4">
            <div class="card card-donacion-personalizada tarjeta-adopcion">
                <div class="card-body">
                    <i class="fas fa-paw icono-tarjeta"></i>
                    <h3 class="mb-3">Mascotas en Adopción</h3>
                    <p class="texto-tarjeta">Encontrá a tu próximo compañero y dale un hogar lleno de amor.</p>
                    <a href="mascotas_adopcion.php" class="btn btn-tarjeta-inicio">Ver mascotas</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-donacion-personalizada tarjeta-transito">
                <div class="card-body">
                    <i class="fas fa-home icono-tarjeta"></i>
                    <h3 class="mb-3">Mascotas en Tránsito</h3>
                    <p class="texto-tarjeta">Ayudá temporalmente a una mascota mientras encuentra su hogar definitivo.</p>
                    <a href="mascotas_transito.php" class="btn btn-tarjeta-inicio">Ver mascotas</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-donacion-personalizada tarjeta-perdidas">
                <div class="card-body">
                    <i class="fas fa-search icono-tarjeta"></i>
                    <h3 class="mb-3">Mascotas Perdidas</h3>
                    <p class="texto-tarjeta">Ayudanos a reunir mascotas perdidas con sus familias.</p>
                    <a href="mascotas_perdidas.php" class="btn btn-tarjeta-inicio">Ver mascotas</a>
                </div>
            </div>
        </div>

        <!-- Segunda fila: 2 tarjetas centradas -->
        <div class="col-md-6">
            <div class="card card-donacion-personalizada tarjeta-reportar">
                <div class="card-body">
                    <i class="fas fa-bullhorn icono-tarjeta"></i>
                    <h3 class="mb-3">Reportar Mascota</h3>
                    <p class="texto-tarjeta">¿Encontraste o perdiste una mascota? Reportala acá y te ayudamos a difundir.</p>
                    <a href="mascotas_perdidas.php" onclick="iniciarChat(); return false;" class="btn btn-tarjeta-inicio">Reportar</a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card card-donacion-personalizada tarjeta-donacion">
                <div class="card-body">
                    <i class="fas fa-heart icono-tarjeta"></i>
                    <h3 class="mb-3">Realizar Donación</h3>
                    <p class="texto-tarjeta">Tu ayuda es fundamental para continuar con nuestra labor de rescate y cuidado.</p>
                    <a href="realizar_donacion.php" class="btn btn-tarjeta-inicio">Donar</a>
                </div>
            </div>
        </div>
        
    </div>
</div>

<?php 
include 'includes/sidebar.php';
?>