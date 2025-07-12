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

<!-- Banner principal -->
<div class="seccion-hero-principal">
    <img src="/mascotas/uploads/portada.jpg" alt="Portada Adoptame Saladillo" class="imagen-hero-principal">
    <div class="texto-hero-principal">
        <h1>Bienvenidos a Adoptame Saladillo</h1>
        <p>¡Encontrá a tu compañero perfecto, o ayudá a una mascota a encontrar su hogar!</p>
    </div>
</div>

<!-- Tarjetas de servicios -->
<div class="container mb-5">
    <div class="row g-4">
        
        <!-- Primera fila: 3 tarjetas -->
        <div class="col-md-4">
            <div class="tarjeta-base tarjeta-servicio-adopcion">
                <div class="cuerpo-tarjeta">
                    <i class="fas fa-paw icono-tarjeta"></i>
                    <h3 class="titulo-servicio-inicio">Mascotas en Adopción</h3>
                    <p class="descripcion-servicio-inicio">Encontrá a tu próximo compañero y dale un hogar lleno de amor.</p>
                    <a href="mascotas_adopcion.php" class="btn boton-tarjeta-inicio">Ver mascotas</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="tarjeta-base h-100 tarjeta-servicio-transito">
                <div class="cuerpo-tarjeta">
                    <i class="fas fa-home icono-tarjeta"></i>
                    <h3 class="titulo-servicio-inicio">Mascotas en Tránsito</h3>
                    <p class="descripcion-servicio-inicio">Ayudá temporalmente a una mascota mientras encuentra su hogar definitivo.</p>
                    <a href="mascotas_transito.php" class="btn boton-tarjeta-inicio">Ver mascotas</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="tarjeta-base h-100 tarjeta-servicio-perdidas">
                <div class="cuerpo-tarjeta">
                    <i class="fas fa-search icono-tarjeta"></i>
                    <h3 class="titulo-servicio-inicio">Mascotas Perdidas</h3>
                    <p class="descripcion-servicio-inicio">Ayudanos a reunir mascotas perdidas con sus familias.</p>
                    <a href="mascotas_perdidas.php" class="btn boton-tarjeta-inicio">Ver mascotas</a>
                </div>
            </div>
        </div>

        <!-- Segunda fila: 2 tarjetas centradas -->
        <div class="col-md-6">
            <div class="tarjeta-base h-100 tarjeta-servicio-reportar">
                <div class="cuerpo-tarjeta">
                    <i class="fas fa-bullhorn icono-tarjeta"></i>
                    <h3 class="titulo-servicio-inicio">Reportar Mascota</h3>
                    <p class="descripcion-servicio-inicio">¿Encontraste o perdiste una mascota? Reportala acá y te ayudamos a difundir.</p>
                    <a href="mascotas_perdidas.php" onclick="iniciarChat(); return false;" class="btn boton-tarjeta-inicio">Reportar</a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="tarjeta-base h-100 tarjeta-servicio-donacion">
                <div class="cuerpo-tarjeta">
                    <i class="fas fa-heart icono-tarjeta"></i>
                    <h3 class="titulo-servicio-inicio">Realizar Donación</h3>
                    <p class="descripcion-servicio-inicio">Tu ayuda es fundamental para continuar con nuestra labor de rescate y cuidado.</p>
                    <a href="realizar_donacion.php" class="btn boton-tarjeta-inicio">Donar</a>
                </div>
            </div>
        </div>
        
    </div>
</div>

<?php 
include 'includes/sidebar.php';
?>