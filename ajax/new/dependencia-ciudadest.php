<?php
include_once('../../init.php');
include_once('../../config.php');
include(DOC_ROOT . "/classes/class.mysql.php");
include(DOC_ROOT . "/classes/class.combos.php");
include_once(DOC_ROOT . '/libraries.php');

if ($_POST['type'] == "getMunicipios") {
    $estado = $_POST['estado'];
    $municipios = $util->municipios($estado);
    echo json_encode([
        'municipios'    => $municipios
    ]);
}
