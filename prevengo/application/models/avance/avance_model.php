

<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Avance_model extends CI_Model{

	public function __construct(){
		parent::__construct();
	}
    

	public function guardarAvance($dataAvance){
        return $this->db->insert('avance',$dataAvance);
    }



public function actualizarAvance($dataAvance){
       
         $this->db->set($dataAvance);
     	$this->db->where('idavance', $dataAvance['idavance']);
        return  $this->db->update('avance');
    }




public function consultarAvanceTipoFinal($actividad)
{



     $sql="SELECT idactividad FROM avance where tipo=0  and idactividad=$actividad";
         $query = $this->db->query($sql);
        
     if ($query->num_rows() > 0){
         $boll= false;
                }
    else  {
        $boll=true;
                }
    return $boll;   
}


 public function consultarListaAvance(){
       
        $sql="SELECT av.descripcion AS descripcion, evento.titulo AS evento, 
                     actividad.descripcion AS actividad, 
                     av.tipo AS tipo,
                     av.fecharegistro AS fecha,  
                     bdgenerica.persona.nombre AS nombre, 
                     bdgenerica.persona.apellido AS apellido 

                FROM prevengo.avance as av 
                INNER JOIN actividad ON actividad.idactividad= av.idactividad 
                INNER JOIN evento ON actividad.idevento=evento.idevento 
                INNER JOIN bdgenerica.usuario ON av.idusuario= bdgenerica.usuario.id 
                INNER JOIN bdgenerica.persona ON bdgenerica.usuario.cedula=bdgenerica.persona.cedula
                WHERE av.estatus=0 
                ORDER BY av.fecharegistro, av.tipo ASC";


         $query = $this->db->query($sql);
        
             return $query;
            }

 public function consultarListaAvanceFinal(){
       
        $sql="SELECT actividad.idactividad AS id, evento.titulo AS evento, 
                     av.descripcion AS descripcion, 
                     actividad.descripcion AS actividad, 
                     av.tipo AS tipo, 
                     av.fecharegistro AS fecha, 
                     bdgenerica.persona.nombre AS nombre, 
                     bdgenerica.persona.apellido AS apellido 

             FROM prevengo.avance AS av 
             INNER JOIN actividad ON actividad.idactividad= av.idactividad 
             INNER JOIN evento ON actividad.idevento=evento.idevento 
             INNER JOIN bdgenerica.usuario ON av.idusuario= bdgenerica.usuario.id 
             INNER JOIN bdgenerica.persona ON bdgenerica.usuario.cedula=bdgenerica.persona.cedula 
             WHERE av.estatus=0 and av.tipo=0 
             ORDER BY av.fecharegistro, id ASC";


         $query = $this->db->query($sql);
        
             return $query;
            }


   
}//fin de la clase