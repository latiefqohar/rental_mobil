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

    //  crud mobil

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
         $data['mobil']=$this->m_rental->edit_data($where,'mobil')->result();
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
 
    //  crud customer
    public function customer(){
        $data['customer']=$this->m_rental->get_data('kostumer')->result();
        $this->load->view('admin/v_header');
        $this->load->view('admin/v_customer', $data);
        $this->load->view('admin/v_footer');
            
    }

    public function add_customer(){
        if (isset($_POST['add'])) {
           $nama=$this->input->post('nama');
           $alamat=$this->input->post('alamat');
           $jk=$this->input->post('jk');
           $no_hp=$this->input->post('no_hp');
           $nik=$this->input->post('nik');
           $this->form_validation->set_rules('nama', 'Nama', 'required');
            $this->form_validation->set_rules('alamat', 'Alamat', 'required');
            $this->form_validation->set_rules('no_hp', 'Nomor Handphone', 'required');
            $this->form_validation->set_rules('nik', 'NIK', 'required');
            
            if($this->form_validation->run() != false){
            
                $data = array(
                'kostumer_nama' => $nama,
                'kostumer_alamat' => $alamat,
                'kostumer_jk' => $jk,
                'kostumer_hp' => $no_hp,
                'kostumer_ktp' => $nik
                );
                $this->m_rental->insert_data($data,'kostumer');
                redirect(base_url().'admin/customer?pesan=berhasil');
            }else{
                $this->load->view('admin/v_header');
                $this->load->view('admin/v_customer_add');
                $this->load->view('admin/v_footer'); 
            }

        }else{

        
        $this->load->view('admin/v_header');
        $this->load->view('admin/v_customer_add');
        $this->load->view('admin/v_footer'); 
        }
    }

    public function customer_edit($id){
        $where = array('kostumer_id' => $id );
        $data['customer']=$this->m_rental->edit_data($where,'kostumer')->result();
        $this->load->view('admin/v_header');
        $this->load->view('admin/v_customer_edit', $data);
        $this->load->view('admin/v_footer');

    }
    public function customer_update(){
        $id = $this->input->post('id'); 
        $nama = $this->input->post('nama'); 
        $alamat = $this->input->post('alamat'); 
        $jk = $this->input->post('jk'); 
        $hp = $this->input->post('hp'); 
        $nik = $this->input->post('nik'); 
        $this->form_validation->set_rules('nama','Nama Customer','required'); 
        $this->form_validation->set_rules('alamat','Alamat customer','required'); 
        $this->form_validation->set_rules('hp','Nomor Hp','required'); 
        $this->form_validation->set_rules('nik','NIK','required'); 
        if($this->form_validation->run() != false){ 
            $where = array( 'kostumer_id' => $id ); 
            $data = array( 
                'kostumer_nama' => $nama, 
                'kostumer_alamat' => $alamat, 
                'kostumer_jk' => $jk, 
                'kostumer_hp' => $hp, 
                'kostumer_ktp' => $nik 
             ); 
             $this->m_rental->update_data($where,$data,'kostumer'); 
             redirect(base_url().'admin/customer?pesan=sukses');
          }else{ 
              $where = array( 'kostumer_id' => $id ); 
              $data['customer'] = $this->m_rental->edit_data($where,'kostumer')->result(); 
              $this->load->view('admin/v_header'); 
              $this->load->view('admin/v_customer_edit',$data); 
              $this->load->view('admin/v_footer'); } 

    }

    public function customer_hapus($id){
        $where = array( 'kostumer_id' => $id ); 
        $this->m_rental->delete_data($where,'kostumer');
        redirect(base_url().'admin/customer?pesan=hapus');
     }


    //  Transaksi

    function transaksi(){
        $data['transaksi']=$this->db->query("SELECT * FROM transaksi,mobil,kostumer where transaksi_mobil=mobil_id and transaksi_kostumer=kostumer_id")->result();
        $this->load->view('admin/v_header');
        $this->load->view('admin/v_transaksi', $data);
        $this->load->view('admin/v_footer');  
    } 

    function transaksi_add(){
        $where = array('mobil_status' => '1');
        $data['mobil']=$this->m_rental->edit_data($where,'mobil')->result();
        $data['kostumer']=$this->m_rental->get_data('kostumer')->result();
        $this->load->view('admin/v_header');
        $this->load->view('admin/v_transaksi_add', $data);
        $this->load->view('admin/v_footer');  
    }

    function transaksi_add_act(){
        
        $customer=$this->input->post('kostumer');
        $mobil=$this->input->post('mobil');
        $tgl_pinjam=$this->input->post('tgl_pinjam');
        $tgl_kembali=$this->input->post('tgl_kembali');
        $harga=$this->input->post('harga');
        $denda=$this->input->post('denda');
        
        $this->form_validation->set_rules('kostumer','Customer','required');
        $this->form_validation->set_rules('mobil','Mobil','required');
        $this->form_validation->set_rules('tgl_pinjam','Tanggal Pinjam','required');
        $this->form_validation->set_rules('tgl_kembali','Tanggal Kembali','required');
        $this->form_validation->set_rules('harga','Harga','required'); 
        $this->form_validation->set_rules('denda','Denda','required');
        if($this->form_validation->run() != false){ 
            $data = array( 
                'transaksi_karyawan' => $this->session->userdata('id'), 
                'transaksi_kostumer' => $customer, 
                'transaksi_mobil' => $mobil, 
                'transaksi_tgl_pinjam' => $tgl_pinjam, 
                'transaksi_tgl_kembali' => $tgl_kembali, 
                'transaksi_harga' => $harga, 
                'transaksi_denda' => $denda, 
                'transaksi_tgl' => date('Y-m-d') 
            ); 
           
            $this->m_rental->insert_data($data,'transaksi'); 
            // update status mobil yg di pinjam 
            $d = array( 'mobil_status' => '2' ); 
            $w = array( 'mobil_id' => $mobil ); 
           
            $this->m_rental->update_data($w,$d,'mobil'); 
            redirect(base_url().'admin/transaksi?pesan=berhasil'); 
        }else{ 
            $w = array('mobil_status'=>'1'); 
            $data['mobil'] = $this->m_rental->edit_data($w,'mobil')->result(); 
            $data['kostumer'] = $this->m_rental->get_data('kostumer')->result(); 
            $this->load->view('admin/v_header'); 
            $this->load->view('admin/v_transaksi_add',$data); 
            $this->load->view('admin/v_footer'); 
        } 

        
        
    }

    function transaksi_hapus($id){ 
        $w = array( 'transaksi_id' => $id ); 
        $data = $this->m_rental->edit_data($w,'transaksi')->row(); 

        $ww = array( 'mobil_id' => $data->transaksi_mobil ); 
        $data2 = array( 'mobil_status' => '1' ); 
        $this->m_rental->update_data($ww,$data2,'mobil'); 
        $this->m_rental->delete_data($w,'transaksi'); 
        redirect(base_url().'admin/transaksi'); }

 }
 
 /* End of file Admin.php */
  
?>