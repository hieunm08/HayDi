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
                $this->list_host();
            }
        } else {
            $this->isCheck = false;
            $this->list_host();
        }
    }
    
    function list_host()
    {
        $this->load->library('pagination');
        $this->load->model('host');

        $config['base_url'] = base_url() . 'admin/hosts/list_host';
        $config['total_rows'] = $this->host->total_hosts();
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
        $data['hosts'] = $this->host->getAllHost($config['per_page'], $page);
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
       
      

        $data['links'] = $this->pagination->create_links();
        $data['main_content'] = 'backend/hosts/host_info';
        $data['title'] = 'Host';
        $this->load->view('includes/template', $data);
        }        

    function add_host()
    {
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        $this->form_validation->set_rules('name', 'name', 'trim|required');
        $this->form_validation->set_rules('phone', 'phone', 'trim|required');
        $this->form_validation->set_rules('email', 'email', 'trim|required');


        if ($this->form_validation->run() == FALSE)
        {
            $this->load->model('host');
             $this->load->model('supplier');

            $data['city_code'] = $this->supplier->getCityCode();
            $data['main_content'] = 'backend/hosts/add_host';
            $data['title'] = 'Add host';
            $this->load->view('includes/template', $data);

        }else
        {
        $data_array =  array(
        "name"        =>    $this->input->post('name'),
        "phone"        =>   $this->input->post('phone'),
        "email"        =>    $this->input->post('email'),
        "images"        =>   array(
            $this->input->post('images')
        ),
        "video" => $this->input->post('video'),
        "intro" => $this->input->post('intro'),
        "address"        =>    $this->input->post('address'),
        "country_code"        =>    $this->input->post('country_code'),
        "price"        =>    $this->input->post('price'),
        "price_baby"        =>    $this->input->post('price_baby'),
        "unit"        =>    $this->input->post('unit'),
        "surcharge"        =>    $this->input->post('surcharge'),
        "room_number"        =>    $this->input->post('room_number'),
        "customers_same_time"        =>    $this->input->post('customers_same_time'),
        "with_boss"        =>    $this->input->post('with_boss'),
        "type"        =>    $this->input->post('type'),
        "services"        =>   array(
            "service_id" =>  $this->input->post('service_id'),
            "access" =>  $this->input->post('access'),
            "cost" =>  $this->input->post('cost'),
            "unit" =>  $this->input->post('unit'),
        ),
        );
        $make_call = callAPI('POST', 'http://api.haydi.vn:3001/backend/hosts', json_encode($data_array));
        $response = json_decode($make_call, true);
        echo($make_call);
        redirect('admin/hosts', 'refresh');
    }
}
    function edit_host(){
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        $this->form_validation->set_rules('name', 'name', 'trim|required');
        $this->form_validation->set_rules('phone', 'phone', 'trim|required');
        $this->form_validation->set_rules('email', 'email', 'trim|required');


        if ($this->form_validation->run() == FALSE)
        {
            $this->load->model('host');
            $this->load->model('supplier');

            $data['city_code'] = $this->supplier->getCityCode();
            $data['main_content'] = 'backend/hosts/host_info';
            $data['title'] = 'Edit host';
            $this->load->view('includes/template', $data);

        }else
        {
        $id = $this->input->post('id');
        $data_array =  array(
        "name"        =>    $this->input->post('name'),
        "phone"        =>   $this->input->post('phone'),
        "email"        =>    $this->input->post('email'),
        "images"        =>   array(
            $this->input->post('images')
        ),
        "video" => $this->input->post('video'),
        "intro" => $this->input->post('intro'),
        "address"        =>    $this->input->post('address'),
        "country_code"        =>    $this->input->post('country_code'),
        "price"        =>    $this->input->post('price'),
        "price_baby"        =>    $this->input->post('price_baby'),
        "unit"        =>    $this->input->post('unit'),
        "surcharge"        =>    $this->input->post('surcharge'),
        "room_number"        =>    $this->input->post('room_number'),
        "customers_same_time"        =>    $this->input->post('customers_same_time'),
        "with_boss"        =>    $this->input->post('with_boss'),
        "type"        =>    $this->input->post('type')
        );
        $make_call = callAPI('PUT', 'http://api.haydi.vn:3001/backend/hosts/'. $id, json_encode($data_array));
        $response = json_decode($make_call, true);
        echo($make_call);
        redirect('admin/hosts', 'refresh');  
    }
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


