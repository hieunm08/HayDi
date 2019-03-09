<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Suppliers extends CI_Controller
{
    var $API ="";
    public $isCheck = false;

    function __construct()
    {
        parent::__construct();
        $this->API="http://api.haydi.vn:3001/";
        $this->is_logged_in();
        $this->load->helper('language');
        $this->load->library('email');
        $this->load->library('curl');
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
            } elseif ($_POST['add'] != null) {
                $data['links'] = $this->pagination->create_links();
                $data['main_content'] = 'backend/skills/add_skill';
                $this->load->view('includes/template', $data);
             }else {
                $this->isCheck = false;
//                $supplier_cd = $_POST['supplier_search'];
                $this->list_suppliers();
            }
        } else {
            $this->isCheck = false;
            $this->list_suppliers();
        }
    }
    
    function list_suppliers()
    {
        $supplier = json_decode($this->curl->simple_get($this->API.'guiders?limit=10&lat=21.02867&lon=105.75589&distance=200000km'),true);
        $data = $supplier['data'];//chuyen thanhh mang  data
        $list = $data['list'];
        $this->load->library('pagination');
        $this->load->model('supplier');

        $config['base_url'] = base_url() . 'admin/suppliers/list_suppliers';
        $config['total_rows'] = $this->supplier->total_suppliers();
        $config['per_page'] = 5;
        $config["uri_segment"] = 4;
        //pagination styling
        $config['num_tag_open'] = '<li class="page-item">';
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

//        if ($this->isCheck) {
//            $data['suppliers'] = $this->supplier->show_suppliers($config['per_page'], $page, $supplier_cd);
//        } else {
            $data['suppliers'] = $this->supplier->show_all_suppliers($config['per_page'], $page);
//        }

        $data['links'] = $this->pagination->create_links();
        $data['main_content'] = 'backend/suppliers/suppliers';
        $data['title'] = 'Hướng Dẫn Viên';
        $this->load->view('includes/template', $data);
    }
    function block_Supplier(){
        $this->load->model('supplier');
        $id = $_GET['id'];
        $status = $_GET['status'];
        $this->session->set_flashdata('message', 'Suppliers successfully ');
        $this->supplier->change_Supplier_Status($id, $active_guide);
        redirect('admin/suppliers', 'refresh');
    }


    function list_suppliers_by_id($supplier_cd)
    {
        $this->load->library('pagination');
        $this->load->model('supplier');

        $data['suppliers'] = $this->supplier->show_suppliers($supplier_cd);
        $data['city_code'] = $this->supplier->getCityCode();

        $data['links'] = $this->pagination->create_links();
        $data['main_content'] = 'backend/suppliers/suppliers_info';
        $data['title'] = 'suppliers';
       /* if ($_POST['supplier_search'] != null) {
            
        }else{*/
           // redirect('admin/suppliers', 'refresh');

            $this->load->view('includes/template', $data);
        }        

        //theo tat ca
    function list_suppliers_by_search($supplier_cd)
    {
        $this->load->library('pagination');
        $this->load->model('supplier');

        $data['suppliers'] = $this->supplier->Find_Supplier($supplier_cd);

        $data['links'] = $this->pagination->create_links();
        $data['main_content'] = 'backend/suppliers/suppliers';
        $data['title'] = 'suppliers';
       /* if ($_POST['supplier_search'] != null) {
            
        }else{*/
           // redirect('admin/suppliers', 'refresh');

            $this->load->view('includes/template', $data);
        }        
    
    //theo tung item
 function list_suppliers_by_item()
    {
        $this->isCheck = true;
        $this->load->library('pagination');
        $this->load->model('supplier');

        $username = $_GET['username'];
        $fullname = $_GET['fullname'];
        $type = $_GET['type'];
        $status = $_GET['status'];

        $data['suppliers'] = $this->supplier->Find_Supplier_By_Item($username, $fullname, $type,  $status);

        $data['links'] = $this->pagination->create_links();
        $data['main_content'] = 'backend/suppliers/suppliers';
        $data['title'] = 'suppliers';
       /* if ($_POST['supplier_search'] != null) {
            
        }else{*/
           // redirect('admin/suppliers', 'refresh');

            $this->load->view('includes/template', $data);
        }        

    //them thong tin
    function addSupplier($userName, $password, $fullname, $type, $status)
    {
        //TODO chua hien thi len view con da them dc
        $this->load->library('pagination');
        $this->load->model('supplier');

        $data['supplier'] = $this->supplier->insert_infomation( $userName, $password, $fullname, (int)$type, $status);
        redirect('admin/suppliers', 'refresh');
    }
    //sua thogn tin
     function edit_supplier(){
       
        $id = $this->uri->segment(4);
                $this->load->model('supplier');
                $data = $this->input->post();
                $this->supplier->saveSupplier($data, $id);
                $this->session->set_flashdata('message', ' successfully edited');
                redirect('admin/suppliers', 'refresh');
        }
     function updateSupplier(){
    
        //TODO chua hien thi len view con da them dc
                $name = $_GET['name'];
                $phone = $_GET['phone'];
                if ($_GET['password']!="") {
                      $password = $_GET['password'];
                }
                $email = $_GET['email'];
                $sub_phone = $_GET['sub_phone'];
                $address = $_GET['address'];
                $country_code = $_GET['country_code'];
                $level = $_GET['level'];
                $type = $_GET['type'];
                $status = $_GET['status'];
                $languages = $_GET['languages'];
                $price = $_GET['price'];
                $price_unit = $_GET['price_unit'];
                $desc = $_GET['desc'];
                $id = $_GET['id'];
        $this->load->library('pagination');
        $this->load->model('supplier');

        if (isset($password)) {
            $data['supplier'] = $this->supplier->update_Supplier( $name, $phone,  $password, $email,  $sub_phone,  $address,  $country_code, $level, $status, $languages,  $price,   $price_unit, $desc, $id);
            redirect('admin/suppliers', 'refresh');
        }else{
            $data['supplier'] = $this->supplier->update_Supplier( $name, $phone, $email,  $sub_phone,  $address,  $country_code, $level, $status, $languages,  $price,   $price_unit, $desc, $id);
            redirect('admin/suppliers', 'refresh');
        }
       
        $data['supplier'] = $this->supplier->update_Supplier( $userName, $password, $fullname, $type, $status, $id);
       // redirect('admin/suppliers', 'refresh');
    }
    private function is_logged_in()
    {
        $is_logged_in = $this->session->userdata('is_logged_in');
        if (!isset($is_logged_in) || $is_logged_in != true) {

        }
    }

    function delete_supplier($id)
    {
        $this->load->model('supplier');
        $this->session->set_flashdata('message', 'Suppliers successfully deleted');
        $this->supplier->delete_supplier($id);
        redirect('admin/suppliers', 'refresh');
    }


    private function docFileExcel($file)
    {
        if ($file == null) {
            
            redirect('admin/suppliers', 'refresh');
            return;
        }
        $this->load->library('pagination');
        $this->load->model('supplier');

        include 'Classes/PHPExcel/IOFactory.php';
        try {
            $inputFileType = PHPExcel_IOFactory::identify($file);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($file);
        } catch (Exception $e) {
            die('Lỗi không thể đọc file "' . pathinfo($file, PATHINFO_BASENAME) . '": ' . $e->getMessage());
        }

        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        $rowData = array();
        for ($row = 1; $row <= $highestRow; $row++) {
            $rowData[] = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
            $check_id = $this->supplier->check_all_id($rowData[$row - 1][0][0]);
            if (!$check_id) {
                $data['supplier'] = $this->supplier->insert_infomation($rowData[$row - 1][0][0], $rowData[$row - 1][0][1], $rowData[$row - 1][0][2], (int)$rowData[$row - 1][0][3], $rowData[$row - 1][0][4]);
            } else {
            }
        }

        redirect('admin/suppliers', 'refresh');
    }
}


