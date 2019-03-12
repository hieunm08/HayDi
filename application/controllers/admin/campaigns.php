<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Campaigns extends CI_Controller
{
    public $isCheck = false;

    function __construct()
    {
        parent::__construct();
        $this->is_logged_in();
        $this->load->helper('language');
        $this->lang->load('campaigns', $this->session->userdata('language'));
    }

    function index()
    {
        if (!empty($_POST)) {

            if (isset($_POST['userName'])) {
                $userName = $_POST['userName'];
                $password = $_POST['password'];
                $fullname = $_POST['fullname'];
                $type = $_POST['type'];
                $status = $_POST['status'];
                $this->addSupplier($userName, $password, $fullname,  $type, $status);

            } elseif  (($_POST['id'] != null) || ($_POST['name'] != null) || ($_POST['updated_at'] != null) || ($_POST['status'] != null)) {
                $this->isCheck = true;
             $id = $_POST['id'];
            $name = $_POST['name'];
             $updated_at = $_POST['updated_at'];
            $fdate= strtotime($updated_at);
            $tdate= date("Y/m/d",$fdate);
            $status = $_POST['status'];
                $this->search_Campaign($id,$name,$updated_at,$status);}
          /*  }elseif (isset($_POST['add'])) {
                $data['main_content'] = 'backend/campaigns/add_campaign';
                $this->load->view('includes/template', $data);
             }*/else {
                $this->isCheck = false;
//                $supplier_cd = $_POST['supplier_search'];
                $this->list_Campaigns();
            }
        } else {
            $this->isCheck = false;
            $this->list_Campaigns();
        }
    }
    
    function list_Campaigns()
    {
        $this->load->library('pagination');
        $this->load->model('campaign');

        $config['base_url'] = base_url() . 'admin/campaigns/list_Campaigns';
        $config['total_rows'] = $this->campaign->total_Campaign();
        $config['per_page'] = 5;
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
        $data['campaigns'] = $this->campaign->get_Campaign_Pagination($config['per_page'], $page);
        $data['links'] = $this->pagination->create_links();
        $data['main_content'] = 'backend/campaigns/campaigns';
        $data['title'] = 'campaigns';
        $this->load->view('includes/template', $data);
    }

    function off_campaign(){
        $this->load->model('campaign');
        $id = $_GET['id'];
        $status = $_GET['status'];
        $this->session->set_flashdata('message', 'Successfully ');
        $this->campaign->changeCampaignStatus($id, $status);
        redirect('admin/campaigns', 'refresh');
    }

    function list_campaign_by_id($id)
    {
        $this->load->library('pagination');
        $this->load->model('campaign');

        $data['campaigns'] = $this->campaign->showCampaign($id);

        $data['links'] = $this->pagination->create_links();
        $data['main_content'] = 'backend/campaigns/campaign_info';
        $data['title'] = 'Campaigns';
            $this->load->view('includes/template', $data);
        }        

    
     function search_Campaign($id,$name,$updated_at,$status)
        {
            $this->load->library('pagination');
            $this->load->model('campaign');
            $data['campaigns'] = $this->campaign->search_campaign($id,$name,$updated_at,$status);
            $data['links'] = $this->pagination->create_links();
            $data['main_content'] = 'backend/campaigns/campaigns';
             $data['title'] = 'Campaigns';
             $this->load->view('includes/template', $data);
        }

    function edit_campaign()
    {
       
        $data['name']=$this->input->post('name');
        $data['link']=$this->input->post('link');
        $data['desc']=$this->input->post('desc');
        $data['status']=$this->input->post('status');
        $data['is_sponsor']=$this->input->post('is_sponsor');
        $data['updated_at']=mdate('%Y-%m-%d %H:%i:%s', now());
        $data['type']=$this->input->post('type');
        $data['id']=$this->input->post('id');
        $this->load->library('pagination');
        $this->load->model('campaign');
        $id = $this->uri->segment(4);
       
        $this->campaign->updateCampaign($data, $id);
        redirect('admin/campaigns', 'refresh');
    }

    //them thong tin
    function add_campaign()
    {
        $data['name']=$this->input->post('name');
        $data['images']=$this->input->post('images');
        $data['link']=$this->input->post('link');
        $data['desc']=$this->input->post('desc');
        $data['status']=$this->input->post('status');
        $data['is_sponsor']=$this->input->post('is_sponsor');
        $data['updated_at']=mdate('%Y-%m-%d %H:%i:%s', now());
        $data['type']=$this->input->post('type');
        $this->load->library('pagination');
        $this->load->model('campaign');
      
       
        $this->campaign->createCampaign($data);
        redirect('admin/campaigns', 'refresh');
    }
    //sua thogn tin
     function updateSupplier(){
    
        //TODO chua hien thi len view con da them dc
          $userName = $_GET['userName'];
                $password = $_GET['password'];
                $fullname = $_GET['fullname'];
                $type = $_GET['type'];
                $status = $_GET['status'];
                 $id = $_GET['id'];
        $this->load->library('pagination');
        $this->load->model('supplier');
       
        $data['supplier'] = $this->supplier->update_Supplier( $userName, $password, $fullname, $type, $status, $id);
        redirect('admin/suppliers', 'refresh');
    }
    private function is_logged_in()
    {
        $is_logged_in = $this->session->userdata('is_logged_in');
        if (!isset($is_logged_in) || $is_logged_in != true) {

        }
    }

    function delete_campaign($id)
    {
        $this->load->model('campaign');
        $this->session->set_flashdata('message', 'Suppliers successfully deleted');
        $this->campaign->deleteCampaign($id);
        redirect('admin/campaigns', 'refresh');
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


