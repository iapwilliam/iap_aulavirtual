<?php

class selects extends MySQL
{
	var $code = "";


	function cargarEstados()
	{
		//  print_r($this->code);
		$consulta = $this->consulta("SELECT * FROM estado WHERE paisId = '" . $this->code . "'");
		$num_total_registros = $this->num_rows($consulta);
		if ($num_total_registros > 0) {
			$estados = array();
			while ($estado = parent::fetch_assoc($consulta)) {
				$estadoId = $estado["estadoId"];
				$name = $estado["nombre"];
				$estados[$estadoId] = $name;
			}
			return $estados;
		} else {
			return false;
		}
	}

	function cargarCiudades()
	{
		$consulta = parent::consulta("SELECT * FROM sepomex WHERE id_estado = '" . $this->code . "' GROUP BY municipio ORDER BY municipio");
		$num_total_registros = parent::num_rows($consulta);
		if ($num_total_registros > 0) {
			$ciudades = array();
			while ($ciudad = parent::fetch_assoc($consulta)) {
				$municipioId = $ciudad["id_municipio"];
				$name = $ciudad["municipio"];
				$ciudades[$municipioId] = $name;
			}
			return $ciudades;
		} else {
			return false;
		}
	}
}
