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
            <h2>Formulario de Adopción</h2>
        </div>
        
        <!-- Cuerpo del formulario -->
        <div class="cuerpo-formulario-principal">
            
            <form action="procesar_adopcion.php" method="POST">
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

                <!-- Segunda fila: Teléfono y Dirección -->
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
                    <div class="columna-formulario-principal">
                        <div class="grupo-campo-formulario">
                            <label for="direccion" class="etiqueta-formulario-principal">Dirección</label>
                            <input type="text" 
                                   class="input-formulario-principal" 
                                   id="direccion" 
                                   name="direccion" 
                                   required>
                        </div>
                    </div>
                </div>

                <!-- Tercera fila: Nombre de mascota -->
                <div class="fila-formulario-principal">
                    <div class="columna-formulario-principal">
                        <div class="grupo-campo-formulario">
                            <label for="nombre_mascota" class="etiqueta-formulario-principal">Nombre de la mascota a adoptar</label>
                            <input type="text" 
                                   class="input-formulario-principal" 
                                   id="nombre_mascota" 
                                   name="nombre_mascota" 
                                   value="<?php echo htmlspecialchars($mascota['nombre']); ?>" 
                                   readonly>
                        </div>
                    </div>
                </div>

                <!-- Cuarta fila: Experiencia previa -->
                <div class="fila-formulario-principal">
                    <div class="columna-formulario-principal">
                        <div class="grupo-campo-formulario">
                            <label class="etiqueta-formulario-principal">¿Tiene experiencia previa en el cuidado de las mascotas?</label>
                            <div class="grupo-radio-formulario">
                                <div class="opcion-radio-formulario">
                                    <input class="radio-formulario-principal" 
                                           type="radio" 
                                           name="experiencia_previa" 
                                           id="expSi" 
                                           value="Si" 
                                           required>
                                    <label class="etiqueta-radio-formulario" for="expSi">Sí</label>
                                </div>
                                <div class="opcion-radio-formulario">
                                    <input class="radio-formulario-principal" 
                                           type="radio" 
                                           name="experiencia_previa" 
                                           id="expNo" 
                                           value="No">
                                    <label class="etiqueta-radio-formulario" for="expNo">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quinta fila: Visita previa -->
                <div class="fila-formulario-principal">
                    <div class="columna-formulario-principal">
                        <div class="grupo-campo-formulario">
                            <label class="etiqueta-formulario-principal">¿Está de acuerdo en recibir una visita previa a la adopción?</label>
                            <div class="grupo-radio-formulario">
                                <div class="opcion-radio-formulario">
                                    <input class="radio-formulario-principal" 
                                           type="radio" 
                                           name="acepta_visita" 
                                           id="visitaSi" 
                                           value="Si" 
                                           required>
                                    <label class="etiqueta-radio-formulario" for="visitaSi">Sí</label>
                                </div>
                                <div class="opcion-radio-formulario">
                                    <input class="radio-formulario-principal" 
                                           type="radio" 
                                           name="acepta_visita" 
                                           id="visitaNo" 
                                           value="No">
                                    <label class="etiqueta-radio-formulario" for="visitaNo">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sexta fila: Condiciones de vivienda -->
                <div class="fila-formulario-principal">
                    <div class="columna-formulario-principal">
                        <div class="grupo-campo-formulario">
                            <label class="etiqueta-formulario-principal">Condiciones de vivienda</label>
                            <div class="grupo-radio-vertical">
                                <div class="opcion-radio-vertical">
                                    <input class="radio-formulario-principal" 
                                           type="radio" 
                                           name="tipo_vivienda" 
                                           id="patio" 
                                           value="Casa con patio" 
                                           required>
                                    <label class="etiqueta-radio-formulario" for="patio">Casa con patio</label>
                                </div>
                                <div class="opcion-radio-vertical">
                                    <input class="radio-formulario-principal" 
                                           type="radio" 
                                           name="tipo_vivienda" 
                                           id="sinPatio" 
                                           value="Casa sin patio">
                                    <label class="etiqueta-radio-formulario" for="sinPatio">Casa sin patio</label>
                                </div>
                                <div class="opcion-radio-vertical">
                                    <input class="radio-formulario-principal" 
                                           type="radio" 
                                           name="tipo_vivienda" 
                                           id="depChico" 
                                           value="Departamento chico">
                                    <label class="etiqueta-radio-formulario" for="depChico">Departamento chico</label>
                                </div>
                                <div class="opcion-radio-vertical">
                                    <input class="radio-formulario-principal" 
                                           type="radio" 
                                           name="tipo_vivienda" 
                                           id="depGrande" 
                                           value="Departamento grande">
                                    <label class="etiqueta-radio-formulario" for="depGrande">Departamento grande</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Botones de acción -->
                <div class="contenedor-botones-formulario">
                    <button type="submit" class="boton-enviar-formulario">Enviar formulario</button>
                    <a href="../detalle_mascota.php?id=<?php echo $id_mascota; ?>" 
                       class="boton-cancelar-formulario">Cancelar</a>
                </div>
                
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>