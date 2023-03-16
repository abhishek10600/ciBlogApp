<?php 
    class Login extends CI_controller
    {
        public function index()
        {
            $this->load->view('admin/login');
        }
        public function authenticate()
        {
            $this->load->model('Admin_model');

            $this->form_validation->set_rules('username','Username','trim|required');
            $this->form_validation->set_rules('password','Password','trim|required');

            if($this->form_validation->run() == true)
            {
                $username = $this->input->post('username');
                $admin = $this->Admin_model->getByUsername($username);
                if(!empty($admin))
                {
                    $password = $this->input->post('password');
                    if(password_verify($password,$admin['password']) == true)
                    {
                        $adminArray['admin_id'] = $admin['id'];
                        $adminArray['admin_username'] = $admin['username'];
                        $this->session->set_userdata('admin',$adminArray);
                        redirect(base_url().'admin/Home/index');
                    }
                    else
                    {
                        $this->session->set_flashdata('msg','Wrong creds');
                        redirect(base_url().'admin/Login/index');
                    }
                }
                else
                {
                    $this->session->set_flashdata('msg','Wrong creds');
                    redirect(base_url().'admin/Login/index');
                }
            }
            else
            {
                $this->load->view('admin/login');
            }
        }
        public function logout()
        {
            $this->session->unset_userdata('admin');
            redirect(base_url().'admin/Login/index');
        }
    }