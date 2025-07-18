<?php 
include '../config/database.php';

// Obtener parámetros de filtro
$nombre = isset($_GET['nombre']) ? $_GET['nombre'] : '';
$edad = isset($_GET['edad']) ? $_GET['edad'] : '';
$tipo = isset($_GET['tipo']) ? $_GET['tipo'] : '';
?>

<div class="container mt-4">
    
    <!-- Formulario de filtros -->
    <form method="GET" class="row g-3 mb-4">
        
        <!-- Campo nombre -->
        <div class="col-md-4">
            <input type="text" name="nombre" class="campo-formulario form-control" placeholder="Nombre" value="<?php echo htmlspecialchars($nombre); ?>">
        </div>
        
        <!-- Campo edad -->
        <div class="col-md-4">
            <input type="text" name="edad" class="campo-formulario form-control" placeholder="Edad" value="<?php echo htmlspecialchars($edad); ?>">
        </div>
        
        <!-- Selector tipo -->
        <div class="col-md-3">
            <select name="tipo" class="form-select">
                <option value="">Todos</option>
                <option value="Perro" <?php if (strtolower($tipo) == 'perro') echo 'selected'; ?>>Perro</option>
                <option value="Gato" <?php if (strtolower($tipo) == 'gato') echo 'selected'; ?>>Gato</option>
            </select>
        </div>
        
        <!-- Botón filtrar -->
        <div class="col-md-1 text-end">
            <button type="submit" class="btn btn-filtrar w-100">Filtrar</button>
        </div>
        
    </form>

    <!-- Listado de mascotas -->
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
        <?php
        // Consulta SQL con filtros
        $sql = "SELECT m.*, p.fecha_publicacion 
                FROM mascotas m 
                INNER JOIN publicaciones p ON m.id_mascota = p.id_mascota 
                WHERE p.tipo_publicacion = '" . $conn->real_escape_string($tipoPublicacion) . "' 
                AND p.estado_publicacion = 'Activa'";

        // Aplicar filtros
        if (!empty($nombre)) {
            $sql .= " AND m.nombre LIKE '%" . $conn->real_escape_string($nombre) . "%'";
        }

        if (!empty($edad)) {
            $sql .= " AND m.edad LIKE '%" . $conn->real_escape_string($edad) . "%'";
        }

        if (!empty($tipo)) {
            $sql .= " AND LOWER(m.tipo) = LOWER('" . $conn->real_escape_string($tipo) . "')";
        }

        $result = $conn->query($sql);

        // Mostrar resultados
        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
        ?>
        
        <!-- Tarjeta de mascota -->
        <div class="col">
            <div class="tarjeta-base tarjeta-adopcion">
                <a href="detalle_mascota.php?id=<?php echo $row['id_mascota']; ?>" class="text-decoration-none">
                    
                    <!-- Imagen de la mascota -->
                    <img class="imagen-mascota-tarjeta" src="<?php echo '../' . $row['imagen']; ?>" alt="<?php echo $row['nombre']; ?>">
                    
                    <!-- Información de la mascota -->
                    <div class="cuerpo-tarjeta">
                        <h5 class="card-title"><?php echo $row['nombre']; ?></h5>
                        <p class="card-text"><?php echo $row['edad']; ?></p>
                        
                        <!-- Botón según tipo de publicación -->
                        <?php if ($tipoPublicacion == 'Adopción'): ?>
                            <button class="btn boton-mascota-publicacion">Adoptar</button>
                        <?php elseif ($tipoPublicacion == 'Tránsito'): ?>
                            <button class="btn boton-mascota-publicacion">Dar tránsito</button>
                        <?php elseif ($tipoPublicacion == 'Perdido'): ?>
                            <button class="btn boton-mascota-publicacion">Consultar por <?php echo $row['nombre']; ?></button>
                        <?php endif; ?>
                    </div>
                    
                </a>
            </div>
        </div>
        
        <?php
            }
        } else {
            echo "<p class='text-center'>No se encontraron mascotas que coincidan con los filtros.</p>";
        }
        ?>
    </div>
    
</div>