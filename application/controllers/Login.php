<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('Auth');
    }
    
	public function index()
	{
        $this->load->view('login');
    }

    public function auth(){
        // Proses Login
        $user=$_POST['username'];
        $pass=md5($_POST['password']);
        $query=$this->Auth->cek($user,$pass);
        $cek=$query->num_rows();
        $data = $query->row();
        // Cek apakah username dan pass cocok jika cocok diarahkan ke controller knn/index
        if($cek>0){
            $this->session->set_userdata(array('user'=>$user));
            redirect('knn/index');
        }
        else{
            redirect('login');
        }
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect('login');
    }

    // public function tmp(){
    //     $this->Mhome->delresult();

    //     $attr = [
    //         'amount' => '2345',
    //         'result' => 'VICTORY'
    //     ];
    //     $this->Mhome->insertresult($attr);
    // }
}