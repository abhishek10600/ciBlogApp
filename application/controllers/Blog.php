<?php
class Blog extends CI_Controller
{
    public function index($page = 1)
    {
        $this->load->model('Article_model');
        $this->load->helper('text');

        $this->load->library('pagination');

        $perpage = 2;

        $param['offset'] = $perpage;
        $param['limit'] = ($page * $perpage) - $perpage;

        //pagination configuration
        $config['base_url'] = base_url('blog/index');
        $config['total_rows'] = $this->Article_model->getArticlesCount();
        $config['per_page'] = $perpage;
        $config['use_page_numbers'] = true;

        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Prevoius';
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['fill_tag_close'] = "</ul>";
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled page-item'><li class='active page-item'><a href='#' class='page-link'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li class='page-item'>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li class='page-item'>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li class='page-item'>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li class='page-item'>";
        $config['last_tagl_close'] = "</li>";
        $config['attributes'] = array('class' => 'page-link');

        $this->pagination->initialize($config);
        $pagination_links = $this->pagination->create_links();

        $articles = $this->Article_model->getArticlesFront($param);
        $data['articles'] = $articles;
        $data['pagination_links'] = $pagination_links;
        $this->load->view('front/blog', $data);
    }
    public function categories()
    {
        $this->load->model('Category_model');

        $categories = $this->Category_model->getCategoriesFront();
        $data['categories'] = $categories;
        $this->load->view('front/category', $data);
    }
    public function detail($id)
    {
        $this->load->model('Article_model');
        $this->load->model('Comment_model');

        $this->load->library('form_validation');

        $article = $this->Article_model->getArticle($id);

        if (empty($article)) {
            redirect(base_url('blog'));
        }

        $comments = $this->Comment_model->getComments($id,true);

        $data['article'] = $article;
        $data['comments'] = $comments;

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('comment', 'Comment', 'required');

        if($this->form_validation->run() == true)
        {
            $formArray['name'] = $this->input->post('name');
            $formArray['comment'] = $this->input->post('comment');
            $formArray['article_id'] = $id;
            $formArray['created_at'] = date('Y-m-d H:i:s'); 

            $this->Comment_model->create($formArray);

            $this->session->set_flashdata('success','Your Comment has been posted successfully');
            redirect(base_url('Blog/detail/'.$id));
            
        }else{
            $this->load->view('front/blogdetail', $data);
        }

        
    }
    public function category($category_id,$page=1){
        $this->load->model('Category_model');
        $this->load->model('Article_model');
        $this->load->helper('text');

        $this->load->library('pagination');

        $category = $this->Category_model->getCategory($category_id);
        if(empty($category)){
            redirect(base_url('blog'));
        }
        $perpage = 2;

        $param['offset'] = $perpage;
        $param['limit'] = ($page * $perpage) - $perpage;
        $param['category_id'] = $category_id; 

        //pagination configuration
        $config['base_url'] = base_url('blog/category/'.$category_id);
        $config['total_rows'] = $this->Article_model->getArticlesCount($param);
        $config['uri_segment'] = 4; 
        $config['per_page'] = $perpage;
        $config['use_page_numbers'] = true;

        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Prevoius';
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['fill_tag_close'] = "</ul>";
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled page-item'><li class='active page-item'><a href='#' class='page-link'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li class='page-item'>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li class='page-item'>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li class='page-item'>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li class='page-item'>";
        $config['last_tagl_close'] = "</li>";
        $config['attributes'] = array('class' => 'page-link');

        $this->pagination->initialize($config);
        $pagination_links = $this->pagination->create_links();

        $articles = $this->Article_model->getArticlesFront($param);
        $data['articles'] = $articles;
        $data['category'] = $category;
        $data['pagination_links'] = $pagination_links;
        $this->load->view('front/category_articles',$data);
    }
}