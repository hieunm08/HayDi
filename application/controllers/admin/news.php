<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Controller
{
    public $isCheck = false;
    var $API = "";

    function __construct()
    {
        parent::__construct();
        $this->is_logged_in();
        $this->API="http://api.haydi.vn:3001/";
        $this->load->library('curl');
        $this->load->helper('language');
        $this->lang->load('supplier', $this->session->userdata('language'));
    }

    function index()
    {
        if (!empty($_POST)) {

            if (isset($_POST['uploadclick'])) {
                if (isset($_FILES['file'])) {
                    $this->docFileExcel($_FILES['file']['tmp_name'], './folder/' . $_FILES['file']['name']);
                }
            } elseif (isset($_POST['userName'])) {
                $userName = $_POST['userName'];
                $password = $_POST['password'];
                $fullname = $_POST['fullname'];
                $type = $_POST['type'];
                $status = $_POST['status'];
                $this->addSupplier($userName, $password, $fullname,  $type, $status);

            } elseif ($_POST['supplier_search'] != null) {
                $this->isCheck = true;
                $supplier_cd = $_POST['supplier_search'];
//                $this->list_suppliers($supplier_cd);
                $this->list_suppliers_by_search($supplier_cd);
            }
             else {
                $this->isCheck = false;
//                $supplier_cd = $_POST['supplier_search'];
                $this->list_payments();
            }
        } else {
            $this->isCheck = false;
            $this->list_news();
        }
    }
    
    function list_news()
        {
            $this->load->library('pagination');
            $this->load->model('tintuc');

           

            $config['base_url'] = base_url() . 'admin/news/list_news';
            $config['total_rows'] = $this->tintuc->totalNews();
            $config['per_page'] = 3;
            $config["uri_segment"] = 4;
            //pagination styling
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href"#">';
            $config['cur_tag_close'] = '</a></li>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['prev_link'] = '&laquo;';
            $config['next_link'] = '&raquo;';

            $this->pagination->initialize($config);
            $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
            $data['news'] = $this->tintuc->getAllNews($config['per_page'], $page);
            $data['links'] = $this->pagination->create_links();
            $data['main_content'] = 'backend/news/news';
            $data['title'] = 'News';
            $this->load->view('includes/template', $data);
        }
    function list_news_by_id($id)
    {
        $this->load->library('pagination');
        $this->load->model('tintuc');

        $data['news'] = $this->tintuc->getNewsById($id);

        $data['links'] = $this->pagination->create_links();
        $data['main_content'] = 'backend/news/news_info';
        $data['title'] = 'Skills';
        $this->load->view('includes/template', $data);
    } 
    function edit_news()
    {
       
        $data['title']=$this->input->post('title');
        $data['thumb']=$this->input->post('thumb');
        $data['link']=$this->input->post('link');
        $data['intro']=$this->input->post('intro');
        $data['content']=$this->input->post('content');
        $data['status']=$this->input->post('status');
        $data['group_id']=$this->input->post('group_id');
        $data['updated_at']=mdate('%Y-%m-%d %H:%i:%s', now());
        $data['id']=$this->input->post('id');
        $this->load->library('pagination');
        $this->load->model('tintuc');
        $id = $this->uri->segment(4);
       
        $this->tintuc->updateNews($data, $id);
        redirect('admin/news', 'refresh');
    }
    function block_news(){
        $this->load->model('tintuc');
        $id = $_GET['id'];
        $status = $_GET['status'];
        $this->session->set_flashdata('message', 'Suppliers successfully ');
        $this->tintuc->changeNewsStatus($id, $status);
        redirect('admin/news', 'refresh');
    }

    private function is_logged_in()
    {
        $is_logged_in = $this->session->userdata('is_logged_in');
        if (!isset($is_logged_in) || $is_logged_in != true) {

        }
    }

   

    
}


