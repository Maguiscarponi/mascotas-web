<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    // Redirigir al login
    header("Location: /mascotas/usuario/auth/login/login.php");
    exit;
}

include '../../config/database.php';
include '../includes/header.php';
include '../auth/verificar_sesion.php';

// Redirigir si no hay ID de mascota
if (!isset($_GET['id'])) {
    header("Location: ../index.php");
    exit();
}

$id_mascota = $_GET['id'];

// Obtener nombre de la mascota
$sql = "SELECT nombre FROM mascotas WHERE id_mascota = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_mascota);
$stmt->execute();
$result = $stmt->get_result();
$mascota = $result->fetch_assoc();
?>

<div class="contenedor-formulario-principal">
    <div class="tarjeta-formulario-principal">
        <div class="encabezado-formulario-principal">
            <h2>¿Viste a <?php echo $mascota['nombre']; ?>?</h2>
        </div>
        <div class="cuerpo-formulario-principal">
            <form action="procesar_contacto.php" method="POST">
                <input type="hidden" name="id_mascota" value="<?php echo $id_mascota; ?>">
                <input type="hidden" name="id_usuario" value="<?php echo $_SESSION['usuario_id']; ?>">

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nombre_completo" class="form-label">Nombre y apellido</label>
                            <input type="text" class="form-control" id="nombre_completo" name="nombre_completo" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="telefono" class="form-label">Número de teléfono</label>
                    <input type="tel" class="form-control" id="telefono" name="telefono" required>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="ubicacion_vista" class="form-label">¿Dónde viste a la mascota?</label>
                            <input type="text" class="form-control" id="ubicacion_vista" name="ubicacion_vista"
                                placeholder="Ej: Calle, barrio, lugar de referencia" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="fecha_vista" class="form-label">¿Cuándo la viste?</label>
                            <input type="date" class="form-control" id="fecha_vista" name="fecha_vista" required>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="informacion_adicional" class="form-label">Información adicional</label>
                    <textarea class="form-control" id="informacion_adicional" name="informacion_adicional"
                        rows="4" placeholder="Cuéntanos más detalles que puedan ayudar a encontrarla"></textarea>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn boton-enviar-formulario">Enviar información</button>
                    <a href="../detalle_mascota.php?id=<?php echo $id_mascota; ?>" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Establecer fecha máxima como hoy
    document.getElementById('fecha_vista').max = new Date().toISOString().split("T")[0];
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>