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
            }elseif (isset($_POST['add'])) {
                $data['main_content'] = 'backend/news/add_news';
                $this->load->view('includes/template', $data);
             }else {
                $this->isCheck = false;
//                $supplier_cd = $_POST['supplier_search'];
                $this->list_news();
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
            $config['per_page'] = 2;
            $config["uri_segment"] = 4;
            //pagination styling
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="page-item active"><a href"#">';
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
    function add_news()
    {
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        $this->form_validation->set_rules('title', 'title', 'trim|required|callback__citynull_check');
        $this->form_validation->set_rules('thumb', 'thumb', 'trim|required|callback__citynull_check');
        $this->form_validation->set_rules('link', 'link', 'trim|required');
        $this->form_validation->set_rules('intro', 'intro', 'trim|required');
        $this->form_validation->set_rules('content', 'content', 'string|trim|required');
        $this->form_validation->set_rules('status', 'status', 'trim|required');
        $this->form_validation->set_rules('group_id', 'mã nhóm', 'trim|required');

        if ($this->form_validation->run() == FALSE)
        {
            $this->load->model('tintuc');
            $data['group'] = $this->tintuc->getNewsGroup();
            $data['main_content'] = 'backend/news/add_news';
            $data['title'] = 'Add news';
            $this->load->view('includes/template', $data);

        }else
        {
            $data['title']=$this->input->post('title');
            $data['thumb']=$this->input->post('thumb');
            $data['link']=$this->input->post('link');
            $data['intro']=$this->input->post('intro');
            $data['content']=$this->input->post('content');
            $data['status']=$this->input->post('status');
            $data['updated_at']=mdate('%Y-%m-%d %H:%i:%s', now());
            $data['group_id']=$this->input->post('group_id');
            $this->load->library('pagination');
            $this->load->model('tintuc');
      
       
            $this->tintuc->createNews($data);
            redirect('admin/news', 'refresh');
        }
    }
    function block_news(){
        $this->load->model('tintuc');   
        $id = $_GET['id'];
        $status = $_GET['status'];
        $this->session->set_flashdata('message', ' successfully ');
        $this->tintuc->changeNewsStatus($id, $status);
        redirect('admin/news', 'refresh');
    }
    function delete_news($id)
    {
        $this->load->model('tintuc');
        $this->session->set_flashdata('message', ' successfully deleted');
        $this->tintuc->deleteNews($id);
        redirect('admin/news', 'refresh');
    }
    private function is_logged_in()
    {
        $is_logged_in = $this->session->userdata('is_logged_in');
        if (!isset($is_logged_in) || $is_logged_in != true) {

        }
    }

}
?>
