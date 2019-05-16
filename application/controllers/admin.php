<?php
 
 defined('BASEPATH') OR exit('No direct script access allowed');
 
 class Admin extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('status')!='login'){
            
            redirect(base_url()."welcome?pesan=belumlogin");
            
        }
    }
    
 
     public function index()
     {
         $data['transaksi']=$this->db->query('select * from transaksi order by transaksi_id desc limit 10')->result();
         $data['kostumer']=$this->db->query('select * from kostumer order by kostumer_id desc limit 10')->result();
         $data['mobil']=$this->db->query('select * from mobil order by mobil_id desc limit 10')->result();
         $this->load->view('admin/v_header');
         $this->load->view('admin/v_index',$data); 
         $this->load->view('admin/v_footer');
     }
 
 }
 
 /* End of file Admin.php */
  
?>