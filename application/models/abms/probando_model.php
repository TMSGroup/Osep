<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Probando_model extends CI_Model {
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

	public function crearRespuestaElegida(){
		$this->db->insert('respuesta_elegida', 
			array('respBreve'=>$data['respB'], 
					'respParrafo'=>$data['respP'],
					'idRelevamiento'=>$data['relevamiento'], 
					'idRespPreg'=>$data['idRespPreg'],
					'idEncuestado'=>$data['encuestado']));
		$idRespuestaElegida = $this->db->insert_id();
	}
}

?>