    <?php

defined('BASEPATH') OR exit('No direct script access allowed');


class PeliculaModel extends CI_Model {

    function __construct() { 
        parent:: __construct(); 
    }
    
    function insertar($data){
        $this->db->insert('pelicula', $data);//

        if($this->db->affected_rows() > 0){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
    function listar(){
        $data = $this->db->query("select p.id,p.titulo,p.imagen,p.descripcion,p.duracion,p.trailer,p.visto, p.fecha_estreno ,c.nombre from pelicula p , catergoria c where p.id_cat =c.id");
        if($data->num_rows()>0){
            return $data->result();
        }else{
            return false;
        }
    }

    function listarCategorias(){
        $this->db->from("catergoria");
        $data =$this->db->get();
        if($this->db->affected_rows()){
            return $data->result();
        }else{
            return false;
        }
    }
    function marcar($pelicula){
        $data = $this->db->query("Update pelicula set visto = 1 where id='$pelicula'");
        
        if($data > 0){
            return true;
        }else{
            return false;
        }
    }
    function filtrar($categoria){
        $data = $this->db->query("select p.id,p.titulo,p.imagen,p.descripcion,p.duracion,p.trailer,p.visto, p.fecha_estreno ,c.nombre from pelicula p , catergoria c where p.id_cat =c.id and p.id_cat = '$categoria'");
        if($data->num_rows()>0){
            return $data->result();
        }else{
            return false;
        }
    }
}
