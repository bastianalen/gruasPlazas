<?php
require_once("initialize.php");

$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch ($action) {
    case 'add':
		doInsert();
		break;
        
    case 'edit':
        doEdit();
        break;
        
    case 'delete':
        doDelete();
        break;
            
    case 'photos':
        doupdateimage();
        break;
        
}

function doInsert()
{
    if (isset($_POST['save'])) {

		if ($_POST['nombre'] == "" or $_POST['patente'] == "" or $_POST['anio'] == "" or $_POST['id_tipo_vehiculo'] == 0 or $_POST['marca'] == "" or $_POST['modelo'] == "") {
			$messageStats = false;
			message("¡Los campos obligatorios son: Patente, Nombre, Año, Marca, Modelo y Tipo de vehiculo!", "error");
			redirect('../view/vehiculos/indexVehiculo.php?view=add');
		} else {
			$vehiculo = new Vehiculo();
			// $vehiculo->id_vehiculo = $_POST['id_vehiculo'];
			$vehiculo->patente = $_POST['patente'];
			$vehiculo->nombre = $_POST['nombre'];
			$vehiculo->fecha_obtencion = $_POST['fecha_obtencion'];
			$vehiculo->anio = $_POST['anio'];
			$vehiculo->marca = $_POST['marca'];
			$vehiculo->modelo = $_POST['modelo'];
			$vehiculo->nro_motor = $_POST['nro_motor'];
			$vehiculo->nro_chasis = $_POST['nro_chasis'];
			$vehiculo->nro_vin = $_POST['nro_vin'];
			$vehiculo->color = $_POST['color'];
			$vehiculo->id_tipo_vehiculo = $_POST['id_tipo_vehiculo'];
			$vehiculo->activo = 1;

            // Procesar imagen
            $imagen = $_FILES['imagen_vehi'];
            $rutaTemporal = $imagen['tmp_name'];
            $nombreOriginal = $imagen['name'];

            // Validar si se subió un archivo válido
            if ($imagen['error'] === UPLOAD_ERR_OK && $rutaTemporal) {
                // Encriptar el nombre de la imagen
                $extension = pathinfo($nombreOriginal, PATHINFO_EXTENSION);
                $nombreEncriptado = md5(uniqid(rand(), true)) . '.' . $extension;

                // Ruta absoluta en el servidor donde se guardarán las imágenes
                $carpetaDestino = $_SERVER['DOCUMENT_ROOT'] . '/GruasPlazas/public/img/img_vehiculos/';
                $rutaDestino = $carpetaDestino . $nombreEncriptado;

                // Mover el archivo a la carpeta destino
                if (move_uploaded_file($rutaTemporal, $rutaDestino)) {
                    echo "Imagen subida exitosamente.";

                    // Generar la ruta relativa para la base de datos
                    $rutaImagenBaseDatos = '/GruasPlazas/public/img/img_vehiculos/' . $nombreEncriptado;

                    // Asignar la ruta encriptada al objeto del vehículo
                    $vehiculo->imagen_vehi = $nombreEncriptado;

                    echo "Ruta guardada en base de datos: " . $rutaImagenBaseDatos;
                } else {
                    echo "Error al subir la imagen.";
                }
            } else {
                echo "Error: No se pudo procesar la imagen.";
            }
			$vehiculo->create();

			message("¡Nuevo vehiculo [" . $_POST['nombre'] . "] registrado exitosamente!", "success");
			redirect('../view/vehiculos/indexVehiculo.php');

		}
	}

}

function doEdit()
{
	if (isset($_POST['save'])) {

		$vehiculo = new Vehiculo();
		$vehiculo->patente = $_POST['patente'];
		$vehiculo->nombre = $_POST['nombre'];
		$vehiculo->fecha_obtencion = $_POST['fecha_obtencion'];
		$vehiculo->anio = $_POST['anio'];
		$vehiculo->marca = $_POST['marca'];
		$vehiculo->modelo = $_POST['modelo'];
		$vehiculo->nro_motor = $_POST['nro_motor'];
		$vehiculo->nro_chasis = $_POST['nro_chasis'];
		$vehiculo->nro_vin = $_POST['nro_vin'];
		$vehiculo->color = $_POST['color'];
		$vehiculo->id_tipo_vehiculo = $_POST['id_tipo_vehiculo'];
		
        // Obtener la información actual del vehículo, incluida la imagen actual
        $vehiculoActual = $vehiculo->single_vehiculo($_POST['patente']); 
        $imagenAnterior = $vehiculoActual->imagen_vehi;
        // Procesar imagen
        $imagen = $_FILES['imagen_vehi'];
        $rutaTemporal = $imagen['tmp_name'];
        $nombreOriginal = $imagen['name'];

        echo "<pre>";
        print_r($_FILES);
        echo "</pre>";

        echo "Error code: " . $imagen['error'] . "<br>";
        echo "Ruta temporal: " . $rutaTemporal . "<br>";

        // Validar si se subió un archivo válido
        if ($imagen['error'] === UPLOAD_ERR_OK && $rutaTemporal) {
            // Encriptar el nombre de la nueva imagen
            $extension = pathinfo($nombreOriginal, PATHINFO_EXTENSION);
            $nombreEncriptado = md5(uniqid(rand(), true)) . '.' . $extension;

            // Ruta absoluta en el servidor donde se guardarán las imágenes
            $carpetaDestino = $_SERVER['DOCUMENT_ROOT'] . '/GruasPlazas/public/img/img_vehiculos/';
            $rutaDestino = $carpetaDestino . $nombreEncriptado;

            // Mover el archivo a la carpeta destino
            if (move_uploaded_file($rutaTemporal, $rutaDestino)) {
                echo "Imagen subida exitosamente.";
				
                // Generar la ruta relativa para la base de datos
                // $rutaImagenBaseDatos = '/GruasPlazas/public/img/img_vehiculos/' . $nombreEncriptado;
				
                // Asignar la ruta encriptada al objeto del vehículo
                $vehiculo->imagen_vehi = $nombreEncriptado;
				
                // Actualizar la información del vehículo en la base de datos
                $vehiculo->update($_POST['id_vehiculo']);
				
                // Eliminar la imagen anterior si existe
                if (!empty($imagenAnterior)) {
                    $rutaImagenAnterior = $carpetaDestino . $imagenAnterior;
					
                    if (file_exists($rutaImagenAnterior)) {
                        if (file_exists($rutaImagenAnterior)) {
                            unlink($rutaImagenAnterior);
                        }
                    } else {
                        echo "La imagen anterior no existe en la ruta especificada.";
                    }
                }

                message("El vehiculo de patente [" . $_POST['patente'] . "] ha sido actualizado!", "success");
                redirect('../view/vehiculos/indexVehiculo.php');
            } else {
                echo "Error al subir la imagen.";
            }
        } elseif ($imagen['error'] === UPLOAD_ERR_NO_FILE) {
            // No subieron imagen nueva
            $vehiculo->imagen_vehi = $imagenAnterior;
            $vehiculo->update($_POST['id_vehiculo']);
    
            message("El vehiculo de patente [" . $_POST['patente'] . "] ha sido actualizado sin cambiar la imagen.", "success");
            redirect('../view/vehiculos/indexVehiculo.php');
    
        } else {
            echo "Error: No se pudo procesar la imagen.";
        }
    }
}


function doDelete() {
    echo "Veh&iacute;culo";
    $id = isset($_GET['id_vehiculo']) ? intval($_GET['id_vehiculo']) : 0;
    if ($id <= 0) {
        die("ID inválido.");
        echo "Veh&iacute;culo";
    }

    $vehiculo = new Vehiculo();
    $vehiculoSeleccionado = $vehiculo->single_vehiculo($id);
    if ($vehiculo->delete($id)) {
        message("El veh&iacute;culo de patente [" . $vehiculoSeleccionado->patente . "] ha sido eliminado!", "success");
        redirect('../view/vehiculos/indexVehiculo.php');
    } else {
        message("El veh&iacute;culo de patente [" . $vehiculoSeleccionado->patente . "] no ha podido ser eliminado!", "error");
        redirect('../view/vehiculos/indexVehiculo.php');
    }
}


function doupdateimage()
{

	$errofile = $_FILES['photo']['error'];
	$type = $_FILES['photo']['type'];
	$temp = $_FILES['photo']['tmp_name'];
	$myfile = $_FILES['photo']['name'];
	$location = "photos/" . $myfile;


	if ($errofile > 0) {
		message("¡No hay Imagen seleccionada!", "error");
		redirect('../view/vehiculos/indexVehiculo.php');
	} else {

		@$file = $_FILES['photo']['tmp_name'];
		@$image = addslashes(file_get_contents($_FILES['photo']['tmp_name']));
		@$image_name = addslashes($_FILES['photo']['name']);
		@$image_size = getimagesize($_FILES['photo']['tmp_name']);

		if ($image_size == FALSE) {
			message("¡El archivo subido no es una imagen!", "error");
			redirect('../view/vehiculos/indexVehiculo.php');
		} else {
			//uploading the file
			move_uploaded_file($temp, "photos/" . $myfile);



			$vehiculo = new Vehiculo();
			$vehiculo->imagen_vehi = $location;
			$vehiculo->update($_SESSION['user_id']);
			message("¡La imagen se actualizó correctamente!", "success");
			redirect("photos/");


		}
	}

}

?>