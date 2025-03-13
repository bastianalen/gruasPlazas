<?php
include_once __DIR__ . '/../../controller/config.php'; 
require_once(__DIR__."/../../controller/initialize.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Obtener la patente desde la URL
$patente = isset($_GET['patente']) ? $_GET['patente'] : '';

// Valida precensia de patente
if ($patente) {
    
    // Obtiene las mantenciones recomendadas para el vehiculo y considerando además que estas sean las mantenciones destacadas para mostrar.
    $mantencionrecomendada = new MantencionRecomendada();
    $mantencionesrecomendadas = $mantencionrecomendada->find_mantenciones_recomendadas_destacadas($patente);
    // Crear un array con los datos que vamos a devolver al cliente
    $resultados = [];
    foreach ($mantencionesrecomendadas as $result) {
        $patente = $result['patente'];
        $tipo_mantencion = $result['id_tipo_mtn'];
        
        // Convertir las fechas a objetos DateTime
        $fechaMantencionReal = new DateTime();
        $fecharecomendada = new DateTime($result['fecha_recomen']);
        
        // Obtener la diferencia en días y tiempo para diferenciar además el día actual de los demas
        $diferenciaSegundos = $fecharecomendada->getTimestamp() - $fechaMantencionReal->getTimestamp();
        $estadoMantencionFecha = $diferenciaSegundos / 86400; // 86400 segundos en un día
        $estadoMantencion ='';
        $estadoMantencionTexto ='';
        // Determinar si está adelantado o atrasado
        if ($estadoMantencionFecha <= -1) {
            if ($estadoMantencionFecha <= -1 && $estadoMantencionFecha >= -30) {
                $estadoMantencionTexto = "Atrasado";
                $estadoMantencion = "Atrasado";
            } else if ($estadoMantencionFecha <= -31 && $estadoMantencionFecha >= -90) {
                $estadoMantencionTexto = "Muy atrasado";
                $estadoMantencion = "Muy-atrasado";
            } else if ($estadoMantencionFecha < -90) {
                $estadoMantencionTexto = "Extremadamente atrasado";
                $estadoMantencion = "Extremadamente-atrasado";
            }
        } else if ($estadoMantencionFecha > 0) {
            if ($estadoMantencionFecha > 0 && $estadoMantencionFecha <= 30) {
                $estadoMantencionTexto = "Proximo a la fecha";
                $estadoMantencion = "Proximo-a-la-fecha";
            } else if ($estadoMantencionFecha >= 31 && $estadoMantencionFecha <= 90) {
                $estadoMantencionTexto = "Al día";
                $estadoMantencion = "Al-dia";
            } else if ($estadoMantencionFecha > 90) {
                $estadoMantencionTexto = "Muy seguro";
                $estadoMantencion = "Muy-seguro";
            }
        } else if ($estadoMantencionFecha == 0 || $estadoMantencionFecha > -1){
            $estadoMantencionTexto = "Hoy";
            $estadoMantencion = "Hoy";
        } else {
            $estadoMantencionTexto = "Falta de fecha en mantención recomendada";
            $estadoMantencion = "Error";
            $estadoMantencionFecha = '';
            $fechaRecomendada = '';
            $fechaMantencionReal = '';
        }

        // Agregar los datos al array para retornar
        $resultados[] = [
            'tipo_mantencion' => $result['tipo_mantencion'],
            'desc_mtn_vehi' => $result['desc_recomen'],
            'estadoMantencion' => $estadoMantencion,
            'estadoMantencionFecha' => $estadoMantencionFecha,
            'estadoMantencionTexto' => $estadoMantencionTexto,
            'km_recomen' => $result['km_recomen'],
            'fechaRecomendada' => $fecharecomendada,
            'fechaMantencionReal' => $fechaMantencionReal,
        ];
    }
    
    // Enviar los resultados como JSON
    echo json_encode($resultados);
}
?>
