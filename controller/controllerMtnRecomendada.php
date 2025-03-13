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
        
}

function doInsert()
{
    if (isset($_POST['save'])) {

		if ($_POST['tipo_mantencion'] == "" or $_POST['patente'] == "" or $_POST['km_recomen'] == "" or $_POST['tiempo_recomen'] == "" or $_POST['fecha_recomen'] == "" or $_POST['desc_recomen'] == "") {
			$messageStats = false;
			message("¡Todos los campos son obligatorios!", "error");
            echo "1: ";
            echo " - 2: ".$_POST['tipo_mantencion'];
            echo " - 3: ".$_POST['patente'];
            echo " - 4: ".$_POST['km_recomen'];
            echo " - 5: ".$_POST['tiempo_recomen'];
            echo " - 6: ".$_POST['fecha_recomen'];
            echo " - 7: ".$_POST['desc_recomen'];
            redirect("../view/vehiculos/mantencionRecomendada/indexMtnRecomendada.php");
		} else {
			$mantencionrecomen = new MantencionRecomendada();
            $mantencionrecomen->id_tipo_mtn = $_POST['tipo_mantencion'];
            $mantencionrecomen->patente = $_POST['patente'];
            $mantencionrecomen->km_recomen = $_POST['km_recomen'];
            $mantencionrecomen->tiempo_recomen = $_POST['tiempo_recomen'];
            $mantencionrecomen->fecha_recomen = $_POST['fecha_recomen'];
            $mantencionrecomen->desc_recomen = $_POST['desc_recomen'];
            
            $destacar = $_POST['destacar'];
            if ($destacar == 1) {
                $mantenciondestacada = new MantencionRecomendada();
                $mantenciondestacadaActual = $mantenciondestacada->single_mantencion_recomendada_destacada($destacar,$_POST['tipo_mantencion']);
                
                $mantenciondestacada->id_tipo_mtn = $mantenciondestacadaActual->id_tipo_mtn;
                $mantenciondestacada->patente = $mantenciondestacadaActual->patente;
                $mantenciondestacada->km_recomen = $mantenciondestacadaActual->km_recomen;
                $mantenciondestacada->tiempo_recomen = $mantenciondestacadaActual->tiempo_recomen;
                $mantenciondestacada->fecha_recomen = $mantenciondestacadaActual->fecha_recomen;
                $mantenciondestacada->desc_recomen = $mantenciondestacadaActual->desc_recomen;
                $mantenciondestacada->destacar = 0;
                
                $resultadoActual = $mantenciondestacada->update($mantenciondestacadaActual->id_mtn_recomen);
                if($resultadoActual) {
                    $mantencionrecomen->destacar = $_POST['destacar'];
                    $mantencionrecomen->create();
                    message("¡Nuevo mantenci&oacute;n recomendada registrada exitosamente!", "success");
                    redirect("../view/vehiculos/mantencionRecomendada/indexMtnRecomendada.php");
                }else {
                    message("No se pudo destacar ni registrar la mantenci&oacute;n recomendada.", "error");
                    redirect("../view/vehiculos/mantencionRecomendada/indexMtnRecomendada.php");
                }
            }else {
                $mantencionrecomen->destacar = $_POST['destacar'];
                $mantencionrecomen->create();
                message("¡Nuevo mantenci&oacute;n recomendada registrada exitosamente!", "success");
                redirect("../view/vehiculos/mantencionRecomendada/indexMtnRecomendada.php");
            }
		}
	}

}

function doEdit()
{
	if (isset($_POST['save'])) {

		$mantencionrecomen = new MantencionRecomendada();
		$mantencionrecomen->id_tipo_mtn = $_POST['tipo_mantencion'];
		$mantencionrecomen->patente = $_POST['patente'];
		$mantencionrecomen->km_recomen = $_POST['km_recomen'];
		$mantencionrecomen->tiempo_recomen = $_POST['tiempo_recomen'];
		$mantencionrecomen->fecha_recomen = $_POST['fecha_recomen'];
		$mantencionrecomen->desc_recomen = $_POST['desc_recomen'];

        $destacar = $_POST['destacar'];
        if ($destacar == 1) {
            $mantenciondestacada = new MantencionRecomendada();
            $mantenciondestacadaActual = $mantenciondestacada->single_mantencion_recomendada_destacada($destacar,$_POST['tipo_mantencion']);
            
            if($mantenciondestacadaActual  != null) {
                $mantenciondestacada->id_tipo_mtn = $mantenciondestacadaActual->id_tipo_mtn;
                $mantenciondestacada->patente = $mantenciondestacadaActual->patente;
                $mantenciondestacada->km_recomen = $mantenciondestacadaActual->km_recomen;
                $mantenciondestacada->tiempo_recomen = $mantenciondestacadaActual->tiempo_recomen;
                $mantenciondestacada->fecha_recomen = $mantenciondestacadaActual->fecha_recomen;
                $mantenciondestacada->desc_recomen = $mantenciondestacadaActual->desc_recomen;
                $mantenciondestacada->destacar = 0;
                $resultadoActual = $mantenciondestacada->update($mantenciondestacadaActual->id_mtn_recomen);

                if($resultadoActual) {
                    $mantencionrecomen->destacar = $destacar;
                    $resultado = $mantencionrecomen->update($_POST['id_mtn_recomen']);
                    message("La mantenci&oacute;n recomendada para el vehiculo de patente [" . $_POST['patente'] . "] ha sido actualizada!", "success");
                    redirect("../view/vehiculos/mantencionRecomendada/indexMtnRecomendada.php");
                }else {
                    message("Error al actualizar la mantenci&oacute;n recomendada. Por favor, intenta de nuevo.", "error");
                    redirect("../view/vehiculos/mantencionRecomendada/indexMtnRecomendada.php");
                }

            }else {
                $mantencionrecomen->destacar = $destacar;
                $resultado = $mantencionrecomen->update($_POST['id_mtn_recomen']);
                message("La mantenci&oacute;n recomendada para el vehiculo de patente [" . $_POST['patente'] . "] ha sido actualizada!", "success");
                redirect("../view/vehiculos/mantencionRecomendada/indexMtnRecomendada.php");
            }
            
        }else {
            $mantencionrecomen->destacar = $destacar;
            $mantencionrecomen->update($_POST['id_mtn_recomen']);
            message("¡Nuevo mantenci&oacute;n recomendada para el vehiculo de patente [" . $_POST['patente'] . "] ha sido actualizada!", "success");
            redirect("../view/vehiculos/mantencionRecomendada/indexMtnRecomendada.php");
        }
    }
}


function doDelete() {
    echo "Mantencion Recomendada";
    $id = isset($_GET['id_mtn_recomen']) ? intval($_GET['id_mtn_recomen']) : 0;
    if ($id <= 0) {
        die("ID inválido.");
        echo "Mantencion Recomendada";
    }
    $mantencionrecomen = new MantencionRecomendada();
    $mantencionSeleccionada = $mantencionrecomen->single_mantencionrecomendada($id);
    if ($mantencionrecomen->delete($id)) {
        message("La mantenci&oacute;n recomendada para el vehiculo de patente [" . $mantencionSeleccionada->patente . "] ha sido eliminada!", "success");
        redirect("../view/vehiculos/mantencionRecomendada/indexMtnRecomendada.php");
    } else {
        message("La mantenci&oacute;n recomendada para el vehiculo de patente [" . $mantencionSeleccionada->patente . "] no a podido ser eliminada correctamente!", "error");
        redirect("../view/vehiculos/mantencionRecomendada/indexMtnRecomendada.php");
    }
}

?>