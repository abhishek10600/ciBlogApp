<?php
class Category extends CI_controller
{
    //index method will show category list page
    public function index()
    {
        $this->load->model('Category_model');
        $queryString = $this->input->get('q');
        $params['queryString'] = $queryString;


        $categories = $this->Category_model->getCategories($params);
        $data['categories'] = $categories;
        $data['queryString'] = $queryString;
        $data['mainModule'] = 'category';
        $data['subModule'] = 'viewCategory';
        $this->load->view('admin/category/list', $data);
    }
    //create method will show create category page
    public function create()
    {
        $this->load->helper('common_helper');

        $data['mainModule'] = 'category';
        $data['subModule'] = 'createCategory';

        $config['upload_path']          = 'public/uploads/category/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['encrypt_name']        = true;

        $this->load->library('upload', $config);

        $this->load->model('Category_model');
        
        

        $this->form_validation->set_error_delimiters('<p class="invalid-feedback">', '</p>');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            if (!empty($_FILES['image']['name'])) {
                //user has selected a file
                if ($this->upload->do_upload('image')) {
                    //File uploaded successfully
                    $data = $this->upload->data();

                    //Resizing Image
                    resizeImage($config['upload_path'] . $data['file_name'], $config['upload_path'] . 'thumb/' . $data['file_name'], 300, 270);


                    //insert category details with category image in the database
                    $formArray['image'] = $data['file_name'];
                    $formArray['name'] = $this->input->post('name');
                    $formArray['status'] = $this->input->post('status');
                    $formArray['created_at'] = date('Y-m-d H:i:s');
                    $this->Category_model->create($formArray);

                    $this->session->set_flashdata('success', 'Category added successfully');
                    redirect(base_url() . 'admin/Category/index');
                } else {
                    //We got some error
                    $error = $this->upload->display_errors("<p class='invalid-feedback'", "</p>");
                    $data['errorImageUpload'] = $error;

                    $this->load->view('admin/category/create', $data);
                }
            } else {
                //insert category details without category image in the database
                $formArray['name'] = $this->input->post('name');
                $formArray['status'] = $this->input->post('status');
                $formArray['created_at'] = date('Y-m-d H:i:s');
                $this->Category_model->create($formArray);

                $this->session->set_flashdata('success', 'Category added successfully');
                redirect(base_url() . 'admin/Category/index');
            }
        } else {
            //we will show errors
            $this->load->view('admin/category/create' ,$data);
        }
    }
    //edit method will show edit category page
    public function edit($id)
    {
        $this->load->model('Category_model');
        $category = $this->Category_model->getCategory($id);
        if (empty($category)) {
            $this->session->set_flashdata('error', 'Category not found');
            redirect(base_url() . 'admin/Category/index');
        }
        $this->load->helper('common_helper');

        $config['upload_path']          = 'public/uploads/category/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['encrypt_name']        = true;

        $this->load->library('upload', $config);

        $this->form_validation->set_error_delimiters('<p class="invalid-feedback">', '</p>');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            if (!empty($_FILES['image']['name'])) {
                //user has selected a file
                if ($this->upload->do_upload('image')) {
                    //File uploaded successfully
                    $data = $this->upload->data();

                    //Resizing Image
                    resizeImage($config['upload_path'] . $data['file_name'], $config['upload_path'] . 'thumb/' . $data['file_name'], 300, 270);


                    //insert category details with category image in the database
                    $formArray['image'] = $data['file_name'];
                    $formArray['name'] = $this->input->post('name');
                    $formArray['status'] = $this->input->post('status');
                    $formArray['updated_at'] = date('Y-m-d H:i:s');
                    $this->Category_model->update($formArray, $id);

                    if (file_exists('./public/uploads/category/' . $category['image'])) {
                        unlink('./public/uploads/category/' . $category['image']);
                    }
                    if (file_exists('./public/uploads/category/thumb/' . $category['image'])) {
                        unlink('./public/uploads/category/thumb/' . $category['image']);
                    }

                    $this->session->set_flashdata('success', 'Category updated successfully');
                    redirect(base_url() . 'admin/Category/index');
                } else {
                    //We got some error
                    $error = $this->upload->display_errors("<p class='invalid-feedback'", "</p>");
                    $data['errorImageUpload'] = $error;

                    $this->load->view('admin/category/edit', $data);
                }
            } else {
                //insert category details without category image in the database
                $formArray['name'] = $this->input->post('name');
                $formArray['status'] = $this->input->post('status');
                $formArray['updated_at'] = date('Y-m-d H:i:s');
                $this->Category_model->update($formArray, $id);

                $this->session->set_flashdata('success', 'Category updated successfully');
                redirect(base_url() . 'admin/Category/index');
            }
        } else {
            $data['category'] = $category;
            $this->load->view('admin/category/edit', $data);
        }
    }
    //delete method will show delete category page
    public function delete($id)
    {
        $this->load->model('Category_model');
        $category = $this->Category_model->getCategory($id);
        if (empty($category)) {
            $this->session->set_flashdata('error', 'Category not found');
            redirect(base_url() . 'admin/Category/index');
        }
        if (file_exists('./public/uploads/category/' . $category['image'])) {
            unlink('./public/uploads/category/' . $category['image']);
        }
        if (file_exists('./public/uploads/category/thumb/' . $category['image'])) {
            unlink('./public/uploads/category/thumb/' . $category['image']);
        }
        $this->Category_model->delete($id);

        $this->session->set_flashdata('success', 'Category deleted successfully');
        redirect(base_url() . 'admin/category/index');
    }
}