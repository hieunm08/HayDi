<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Hosts extends CI_Controller
{
    public $isCheck = false;
    var $API = "";

    function __construct()
    {
        parent::__construct();
        $this->API="http://api.haydi.vn:3001/";
        $this->is_logged_in();
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
                $this->list_hosts();
            }
        } else {
            $this->isCheck = false;
            $this->list_hosts();
        }
    }
    
    function list_hosts()
    {
        $host = json_decode($this->curl->simple_get($this->API.'hosts?limit=10&lat=21.02867&lon=105.75589&distance=200000km'),true);
        $data = $host['data'];//chuyen thanhh mang  data
        $list = $data['list'];
        $this->load->library('pagination');
        $this->load->model('host');

        $config['base_url'] = base_url() . 'admin/hosts/list_hosts';
        $config['total_rows'] = $host['data']['total'];
        $config['per_page'] = 8;
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

//        if ($this->isCheck) {
//            $data['suppliers'] = $this->supplier->show_suppliers($config['per_page'], $page, $supplier_cd);
//        } else {
            /*$data['hosts'] = $this->host->show_all_host($config['per_page'], $page);
            $listHost = $data['list'];*/
//        }

        $data['links'] = $this->pagination->create_links();
        $data['main_content'] = 'backend/hosts/hosts';
        $data['title'] = 'Host';
        $this->load->view('includes/template', $data);
    }
    function block_host(){
       if(isset($_POST['submit'])){
            $data = array(
                'id'       =>  $this->input->post('id'),
                'name'      =>  $this->input->post('name'),
                'price'=>  $this->input->post('price'),
                'address'      =>  $this->input->post('address'),
                'unit'=>  $this->input->post('unit'),
                'country'=>  $this->input->post('country'),
                'country_code'=>  $this->input->post('country_code')

            );
            $update =  $this->curl->simple_put($this->API.'/kontak', $data, array(CURLOPT_BUFFERSIZE => 10)); 
            if($update)
            {
                $this->session->set_flashdata('hasil','Update Data Berhasil');
            }else
            {
               $this->session->set_flashdata('hasil','Update Data Gagal');
            }
            redirect('kontak');
        }else{
            $params = array('id'=>  $this->uri->segment(3));
            $data['datakontak'] = json_decode($this->curl->simple_get($this->API.'/kontak',$params));
            $this->load->view('kontak/edit',$data);
        }
    }


    function host_detail($id)
    {
        $data['hd']= json_decode($this->curl->simple_get($this->API.'hosts/'.$id));
        $this->load->library('pagination');
       
        //echo(json_encode($data['host']));
      
       //die();
      

        $data['links'] = $this->pagination->create_links();
        $data['main_content'] = 'backend/hosts/host_info';
        $data['title'] = 'Host';
        $this->load->view('includes/template', $data);
        }        

        //theo tat ca
    function edit_host(){
       if(isset($_POST['edit'])){
        $id = $_POST['id'];
            $data = array(
                'id'       =>  $this->input->post('id'),
                'name'      =>  $this->input->post('name')       
            );
            $update =  $this->curl->simple_put($this->API.'backend/hosts/20',$data , array(CURLOPT_BUFFERSIZE => 10)); 
           echo ($update);
           die();
            if($update)
            {
                $this->session->set_flashdata('hasil','Update Data Berhasil');
                echo "thành công";
            }else
            {
               $this->session->set_flashdata('hasil','Update Data Gagal');
               echo "thất bại";
            }
             redirect('admin/hosts', 'refresh');
        }else{
            $params = array('id'=>  $this->uri->segment(3));
            $data['datakontak'] = json_decode($this->curl->simple_get($this->API.'/kontak',$params));
            $this->load->view('kontak/edit',$data);
        }
        }
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

    function delete_host($id)
    {
        if(empty($id)){
            redirect('kontak');
        }else{
            $delete =  $this->curl->simple_delete($this->API.'/kontak', array('id'=>$id), array(CURLOPT_BUFFERSIZE => 10)); 
            if($delete)
            {
                $this->session->set_flashdata('hasil','Delete Data Berhasil');
            }else
            {
               $this->session->set_flashdata('hasil','Delete Data Gagal');
            }
            redirect('kontak');
        }
        redirect('admin/hosts', 'refresh');
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


