<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Actividad_model extends CI_Model{

	public function __construct(){
		parent::__construct();
	}
    
	 public function cargarPlandeAccion(){
     
    $query = $this->db->query("SELECT ac.idactividad ,ac.descripcion
                                 FROM avance AS av 
                                 INNER JOIN actividad AS ac ON av.idactividad= ac.idactividad 
                                 INNER JOIN evento AS ev ON ac.idevento=ev.idevento
                                 WHERE (ev.estatus in (1,2)) and (ac.estatus in (1,2)) and (av.idusuario=3) 
                                        AND (av.tipo!=0)
                                 GROUP BY av.idactividad 
                                 ORDER BY ac.estatus, ac.idactividad ASC ");
        $resultado = array();
        $resultdb=array();  
        if ($query->num_rows() > 0){
        foreach ($query->result() as $row){
            $resultado[] = $row;
        }
        return $resultado;
        $query->free-result();
        } 
    
    }


 public function  buscarUnPlandeAccion($idUsuario,$idActividad){

    $sql=" SELECT ava.idavance as avance, ava.idactividad,ava.fechaasignacion, act.estatus 
              FROM avance AS ava 
              INNER JOIN actividad AS act ON ava.idactividad=act.idactividad 
              WHERE ava.idusuario=$idUsuario and ava.idactividad=$idActividad group by act.idactividad";

    $query = $this->db->query($sql);
       return $query;

    }

     public function  cambiarEstatus($id,$estatus){         
         $this->db->set('estatus',$estatus);
         $this->db->where('idactividad',$id);
         return  $this->db->update('actividad');
    }


}// fin de la clase