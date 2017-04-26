<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Relevamiento_model extends CI_Model {
	function __construct(){
		parent:: __construct();
		$this->load->database();
	}

	public function obtenerRespPreg(){
		$this->db->select('*');
		$this->db->from('respuesta_pregunta');
		$query = $this->db->get();	

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $fila){
				$data[] = $fila;
			}	
			return $data;
		}else{
			return false;
		}	
	}

	public function obtenerPreguntas(){
		$this->db->select('*');
		$this->db->from('pregunta');
		$this->db->join('bloque','bloque.idBloque=pregunta.idBloque','left');
		$this->db->join('encuesta','encuesta.idEncuesta=bloque.idEncuesta','left');
		$this->db->join('tipo_pregunta','tipo_pregunta.idTipoPregunta=pregunta.idTipoPregunta','left');
		$this->db->join('etiqueta','etiqueta.idEtiqueta=pregunta.idEtiqueta','left');
		$query = $this->db->get();	

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $fila){
				$data[] = $fila;
			}	
			return $data;
		}else{
			return false;
		}
	}

	public function obtenerRespuestas(){
		$this->db->select('*');
		$this->db->from('respuesta');
		$query = $this->db->get();	

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $fila){
				$data[] = $fila;
			}	
			return $data;
		}else{
			return false;
		}	
	}

	public function obtenerEncuesta(){
		$this->db->select('*');
		$this->db->from('encuesta');
		$query = $this->db->get();	

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $fila){
				$data[] = $fila;
			}	
			return $data;
		}else{
			return false;
		}	
	}

	public function obtenerBloques(){
		$this->db->select('*');
		$this->db->from('bloque');
		$this->db->join('tipo_bloque','tipo_bloque.idTipoBloque=bloque.idTipoBloque','left');
		$this->db->join('encuesta','encuesta.idEncuesta=bloque.idEncuesta','left');

		//$this->db->where('nroBloque',8);

		$query = $this->db->get();	

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $fila){
				$data[] = $fila;
			}	


			return $data;
		}else{
			return false;
		}	
	}

	public function crearRelevamiento($data){
		$this->db->insert('relevamiento', 
			array('nroRelevamiento'=> $data['nroRelev'], 
					'fechaRelevamiento'=> $data['fechaR'],
					'observCriticidad'=> $data['observC'], 
					'idCriticidad'=> $data['idCriti'],
					'idEncuesta'=> $data['idEnc']));
		$idRelevamiento = $this->db->insert_id();
		return $idRelevamiento;
	}

	public function crearEncuestado($data){

		$this->db->insert('encuestado', 
			array('nombreEncuestado'=> $data['nombreE'], 
					'apellidoEncuestado'=> $data['apellidoE'],
					'dniEncuestado'=> $data['dniE'], 
					'edad'=> $data['edad'],
					'sexo'=> $data['sexo'],
					'idRelevamiento'=> $data['idRelev']));
		$idEncuestado= $this->db->insert_id();
	}

	public function obtenerEncuestado($dni){
		$this->db->select('encuestado.idEncuestado');
		$this->db->where('encuestado.dniEncuestado', $dni);
		$this->db->from('encuestado');
		$query = $this->db->get();

		if ($query->num_rows() > 0) return $query;
		else return false;
	}

	public function crearRespuestaElegida($data){
		$this->db->insert('respuesta_elegida', 
			array('respBreve'=>$data['respB'], 
					'idRelevamiento'=>$data['relevamiento'], 
					'idRespPreg'=>$data['idRespPreg'],
					'idEncuestado'=>$data['idEnc']));
		$idRespuestaElegida = $this->db->insert_id();
		return $idRespuestaElegida;
	}

	public function obtenerRelevamientos(){
		$this->db->select('*');
		$this->db->from('relevamiento');
		$this->db->join('encuesta','encuesta.idEncuesta=relevamiento.idEncuesta','left');
		$this->db->join('criticidad','criticidad.idCriticidad=relevamiento.idCriticidad','left');
		$this->db->join('empleado','empleado.idEmpleado=relevamiento.idEmpleado','left');
		$this->db->join('visita','visita.idVisita=relevamiento.idVisita','left');
		$query = $this->db->get();	

		if ($query->num_rows() > 0) return $query;
		else return false;
	}

	public function getRelevamiento($nroRelev){
		$this->db->where('idRelevamiento', $nroRelev);
		$this->db->from('relevamiento');
		$this->db->join('encuesta','encuesta.idEncuesta=relevamiento.idEncuesta','left');
		$this->db->join('criticidad','criticidad.idCriticidad=relevamiento.idCriticidad','left');
		$this->db->join('empleado','empleado.idEmpleado=relevamiento.idEmpleado','left');
		$this->db->join('visita','visita.idVisita=relevamiento.idVisita','left');
		$query = $this->db->get();

		if ($query->num_rows() > 0) return $query;
		else return false;
	}

	public function getDireccion($idD){
		$this->db->where('idDireccion', $idD);
		$this->db->from('direccion');
		$this->db->join('localidad','localidad.id_tlocalidad=direccion.id_tlocalidad','left');
		$query = $this->db->get();

		if ($query->num_rows() > 0) return $query;
		else return false;
	}

	public function getDepartamento($idDpto){
		$this->db->where('id_tdeparta', $idDpto);
		$this->db->from('departamento');
		$query = $this->db->get();

		if ($query->num_rows() > 0) return $query;
		else return false;
	}

	//Buscar todas las respuestas elegidas de un relevamiento y de los encuestados de ese relevamiento

	public function getRespElegidas($nroRelev){
		$this->db->where('idRelevamiento', $nroRelev);
		$this->db->from('respuesta_elegida');
		$this->db->join('pregunta','pregunta.idPregunta=respuesta_elegida.idPregunta','left');
		$this->db->join('respuesta','respuesta.idRespuesta=respuesta_elegida.idRespuesta','left');
		$query = $this->db->get();

		if ($query->num_rows() > 0) return $query;
		else return false;
	}

	public function getEncuestados($nroRelev){
		$this->db->where('idRelevamiento', $nroRelev);
		$this->db->from('encuestado');
		$query = $this->db->get();

		if ($query->num_rows() > 0) return $query;
		else return false;
	}

	public function getRespEnc($idEnc){
		$this->db->where('idEncuestado', $idEnc);
		$this->db->from('respuesta_elegida');
		$this->db->join('pregunta','pregunta.idPregunta=respuesta_elegida.idPregunta','left');
		$this->db->join('respuesta','respuesta.idRespuesta=respuesta_elegida.idRespuesta','left');
		$query = $this->db->get();

		if ($query->num_rows() > 0) return $query;
		else return false;

	}
}

?>