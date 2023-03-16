<?php

    class Home extends CI_controller{
        public function __construct()
        {
            parent::__construct();
            $admin = $this->session->userdata('admin');
            if(empty($admin))
            {
                redirect(base_url().'admin/Login/index');
            }
        }
        public function index()
        {
            $admin = $this->session->userdata('admin');
            $this->load->view('admin/dashboard');
        }
    }