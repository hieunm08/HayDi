<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sponsors extends CI_Controller
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
            $this->list_sponsors();
        }
    }
    
    function list_sponsors()
        {
            $this->load->library('pagination');
            $this->load->model('sponsor');

            //dùng api
           /* $sponsor = json_decode($this->curl->simple_get($this->API.'sponsors?type=host'));
            $ojb=$sponsor->data;
            $data['arr']= $ojb->list;
          */

            $config['base_url'] = base_url() . 'admin/sponsor/list_sponsors';
            $config['total_rows'] = $this->sponsor->totalSponsor();
            $config['per_page'] = 2;
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
            $data['sponsors'] = $this->sponsor->getAllSponsor($config['per_page'], $page);
            $data['links'] = $this->pagination->create_links();
            $data['main_content'] = 'backend/sponsors/sponsors';
            $data['title'] = 'Sponsor';
            $this->load->view('includes/template', $data);
        }
        function block_news(){
            $this->load->model('tintuc');
            $id = $_GET['id'];
            $status = $_GET['status'];
            $this->session->set_flashdata('message', 'Suppliers successfully ');
            $this->sponsor->changeStatusNews($id, $status);
            redirect('admin/news', 'refresh');
        }


    private function is_logged_in()
    {
        $is_logged_in = $this->session->userdata('is_logged_in');
        if (!isset($is_logged_in) || $is_logged_in != true) {

        }
    }

   

    
}


