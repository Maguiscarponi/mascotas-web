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

<!-- Contenedor principal del formulario -->
<div class="contenedor-formulario-principal">
    
    <!-- Tarjeta del formulario -->
    <div class="tarjeta-formulario-principal">
        
        <!-- Encabezado -->
        <div class="encabezado-formulario-principal">
            <h2>¿Viste a <?php echo $mascota['nombre']; ?>?</h2>
        </div>
        
        <!-- Cuerpo del formulario -->
        <div class="cuerpo-formulario-principal">
            
            <form action="procesar_contacto.php" method="POST">
                <!-- Campos ocultos -->
                <input type="hidden" name="id_mascota" value="<?php echo $id_mascota; ?>">
                <input type="hidden" name="id_usuario" value="<?php echo $_SESSION['usuario_id']; ?>">

                <!-- Primera fila: Nombre y Email -->
                <div class="fila-formulario-principal">
                    <div class="columna-formulario-principal">
                        <div class="grupo-campo-formulario">
                            <label for="nombre_completo" class="etiqueta-formulario-principal">Nombre y apellido</label>
                            <input type="text" 
                                   class="input-formulario-principal" 
                                   id="nombre_completo" 
                                   name="nombre_completo" 
                                   required>
                        </div>
                    </div>
                    <div class="columna-formulario-principal">
                        <div class="grupo-campo-formulario">
                            <label for="email" class="etiqueta-formulario-principal">Correo electrónico</label>
                            <input type="email" 
                                   class="input-formulario-principal" 
                                   id="email" 
                                   name="email" 
                                   required>
                        </div>
                    </div>
                </div>

                <!-- Segunda fila: Teléfono -->
                <div class="fila-formulario-principal">
                    <div class="columna-formulario-principal">
                        <div class="grupo-campo-formulario">
                            <label for="telefono" class="etiqueta-formulario-principal">Número de teléfono</label>
                            <input type="tel" 
                                   class="input-formulario-principal" 
                                   id="telefono" 
                                   name="telefono" 
                                   required>
                        </div>
                    </div>
                </div>

                <!-- Tercera fila: Ubicación y Fecha -->
                <div class="fila-formulario-principal">
                    <div class="columna-formulario-principal">
                        <div class="grupo-campo-formulario">
                            <label for="ubicacion_vista" class="etiqueta-formulario-principal">¿Dónde viste a la mascota?</label>
                            <input type="text" 
                                   class="input-formulario-principal" 
                                   id="ubicacion_vista" 
                                   name="ubicacion_vista"
                                   placeholder="Ej: Calle, barrio, lugar de referencia" 
                                   required>
                        </div>
                    </div>
                    <div class="columna-formulario-principal">
                        <div class="grupo-campo-formulario">
                            <label for="fecha_vista" class="etiqueta-formulario-principal">¿Cuándo la viste?</label>
                            <input type="date" 
                                   class="input-formulario-principal" 
                                   id="fecha_vista" 
                                   name="fecha_vista" 
                                   required>
                        </div>
                    </div>
                </div>

                <!-- Cuarta fila: Información adicional -->
                <div class="fila-formulario-principal">
                    <div class="columna-formulario-principal">
                        <div class="grupo-campo-formulario">
                            <label for="informacion_adicional" class="etiqueta-formulario-principal">Información adicional</label>
                            <textarea class="input-formulario-principal" 
                                      id="informacion_adicional" 
                                      name="informacion_adicional"
                                      rows="4" 
                                      placeholder="Cuéntanos más detalles que puedan ayudar a encontrarla"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Botones de acción -->
                <div class="contenedor-botones-formulario">
                    <button type="submit" class="boton-enviar-formulario">Enviar información</button>
                    <a href="../detalle_mascota.php?id=<?php echo $id_mascota; ?>"
                       class="boton-cancelar-formulario">Cancelar</a>
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