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

     public function ganti_password(){
        $this->load->view('admin/v_header');
         $this->load->view('admin/ganti_password'); 
         $this->load->view('admin/v_footer');  
     }
     
     public function ganti_password_action(){
        $pass_baru = $this->input->post('pass_baru'); 
        $ulang_pass = $this->input->post('ulang_pass'); 
        $this->form_validation->set_rules('pass_baru','Password Baru','required|matches[ulang_pass]'); 
        $this->form_validation->set_rules('ulang_pass','Ulangi Password Baru','required'); 
        if($this->form_validation->run() != false){ 
            $data = array( 'admin_password' => md5($pass_baru) ); 
            $w = array( 'admin_id' => $this->session->userdata('id') ); 
            $this->m_rental->update_data($w,$data,'admin'); 
            redirect(base_url().'admin/ganti_password?pesan=berhasil'); 
        }else{ 
            $this->load->view('admin/v_header'); 
            $this->load->view('admin/ganti_password'); 
            $this->load->view('admin/v_footer'); }
     }

     public function mobil(){
         $data['mobil']=$this->m_rental->get_data('mobil')->result();
         $this->load->view('admin/v_header');
         $this->load->view('admin/mobil', $data);
         $this->load->view('admin/v_footer');
   
     }

     public function mobil_add(){
         $merk=$this->input->post('merk');
         $plat=$this->input->post('plat');
         $warna=$this->input->post('warna');
         $tahun=$this->input->post('tahun');
         $status=$this->input->post('status');
         $this->form_validation->set_rules('merk', 'Merk', 'required');
         $this->form_validation->set_rules('status', 'Status', 'required');
         
         if ($this->form_validation->run() != false) {
            $data = array(
                'mobil_merk' => $merk,
                'mobil_plat' => $plat,
                'mobil_warna' => $warna,
                'mobil_tahun' => $tahun,
                'mobil_status' => $status
                );
                $this->m_rental->insert_data($data,'mobil');
                redirect(base_url().'admin/mobil?pesan=berhasil');
         } else {
                
                redirect(base_url().'admin/mobil');      
         }
         
     }

     public function mobil_edit($id){
         $where = array('mobil_id' => $id );
         $data['data_mobil']=$this->m_rental->edit_data($where,'mobil')->result();
         $this->load->view('admin/v_header');
         $this->load->view('admin/v_mobil_edit', $data);
         $this->load->view('admin/v_footer');
         
     }
     public function mobil_update(){
       $id = $this->input->post('id'); 
       $merk = $this->input->post('merk'); 
       $plat = $this->input->post('plat'); 
       $warna = $this->input->post('warna'); 
       $tahun = $this->input->post('tahun'); 
       $status = $this->input->post('status'); 
       $this->form_validation->set_rules('merk','Merk Mobil','required'); 
       $this->form_validation->set_rules('status','Status Mobil','required'); 
       if($this->form_validation->run() != false){ 
           $where = array( 'mobil_id' => $id ); 
           $data = array( 
               'mobil_merk' => $merk, 
               'mobil_plat' => $plat, 
               'mobil_warna' => $warna, 
               'mobil_tahun' => $tahun, 
               'mobil_status' => $status 
            ); 
            $this->m_rental->update_data($where,$data,'mobil'); 
            redirect(base_url().'admin/mobil?pesan=sukses');
         }else{ 
             $where = array( 'mobil_id' => $id ); 
             $data['mobil'] = $this->m_rental->edit_data($where,'mobil')->result(); 
             $this->load->view('admin/v_header'); 
             $this->load->view('admin/v_mobil_edit',$data); 
             $this->load->view('admin/v_footer'); } 
     }
     public function mobil_hapus($id){
        $where = array( 'mobil_id' => $id ); 
        $this->m_rental->delete_data($where,'mobil');
        redirect(base_url().'admin/mobil?pesan=hapus');
     }
 
 }
 
 /* End of file Admin.php */
  
?>