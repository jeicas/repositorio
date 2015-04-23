<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Actividad extends CI_Controller
{
     public function __construct(){
        parent::__construct();
        session_start();
        $this->load->helper('url');
        $this->load->database();
        $this->load->library('session');
        $this->load->model('actividad/actividad_model');
    } 


    public function obtenerPlandeAccion()
    {
      $resultdbd=array();
        if ($resultdbd=$this->actividad_model->cargarPlandeAccion()){
                $output = array(
                   'success'   => true,
                   'total'     => count($resultdbd),
                   'data'      => array_splice($resultdbd,$this->input->get("start"),$this->input->get("limit"))
                );
           echo json_encode($output);
        }
    }
    


     public function buscarUnPlandeAccion($idUsuario)
    {
      $resultdbd=array();
        if ($resultdbd=$this->actividad_model->buscarUnPlandeAccion($idUsuario)){
                $output = array(
                   'success'   => true,
                   'total'     => count($resultdbd),
                   'data'      => array_splice($resultdbd,$this->input->get("start"),$this->input->get("limit"))
                );
           echo json_encode($output);
        }
    }


     public function actualizarEstatusPlandeAccion($idActividad, $estatus)
    {
      $resultdbd=array();
        if ($resultdbd=$this->actividad_model->cambiarEstatus($idActividad, $estatus)){
                $output = array(
                   'success'   => true,
                   'total'     => count($resultdbd),
                   'data'      => array_splice($resultdbd,$this->input->get("start"),$this->input->get("limit"))
                );
           echo json_encode($output);
        }
    }



 public function aprobarActividad()
    {
        //$Actividad= [];

         $id = $this->input->post('record');
         //$Actividad =  json_decode($Actividad)
         $estatus=0;
         $resultdbd=$this->actividad_model->cambiarEstatus($id,$estatus);

                    if($resultdbd){
                                echo json_encode(array(
                                    "success"   => true,
                                    "msg"       => "La actividad ha sido Completada exitosamente." //modificado en la base de datos
                                ));
                                    }
                            else{
                                echo json_encode(array(
                                    "success"   => false,
                                    "msg"       => "No se pudo completar la actividad." //no se modifico en la base de datos
                                        ));
                                }
    }



}//fin del controller