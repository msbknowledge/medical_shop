<?php
class Landing extends MY_Controller {

    public $publicAccess = array(
        'index', 'blogs', 'chat', 'wishes', 'home', 'wishe', 
        'about_us', 'blogdetails', 'contact_us', 'payment_terms_and_conditions', 
        'privacy_policy', 'details', 'main', 'search_medicines', 'upload_prescription'
    );

    public function __construct() {
        parent::__construct();
        $this->load->model('help_model');
    }
    
    public function index() {
        $landing_url = get_option('home_page');
        if (!empty($landing_url) && $landing_url !== 'landing/index' && $landing_url !== 'landing') {
            redirect(base_url($landing_url));
            return;
        }

        $data = array();
        
        // 1. Pharmacy Store Profile from options
        $raw_name = get_option('provider_name');
        $data['store_name'] = !empty($raw_name) ? trim(strip_tags($raw_name)) : 'INDIA PHARMACY';
        
        $raw_addr = get_option('provider_address');
        $data['store_address'] = !empty($raw_addr) ? trim(strip_tags($raw_addr)) : 'MANIKPUR, MIDNAPORE, PASCHIM MEDINIPUR, WEST BENGAL';
        
        $raw_mob = get_option('provider_mobile');
        $data['store_mobile'] = !empty($raw_mob) ? trim($raw_mob) : '9564165548 / 9734551461';
        
        $raw_gst = get_option('provider_gst');
        $data['store_gst'] = !empty($raw_gst) ? trim(str_replace(['/', 'GST:'], '', $raw_gst)) : '19AUJPD3326M1ZF';
        
        $raw_dl = get_option('provider_dl');
        $data['store_dl'] = !empty($raw_dl) ? trim($raw_dl) : 'WB/PAM/NBO/R/516296 & WB/PAM/BIO/R/516296';
        
        $raw_bcda = get_option('provider_bcda_no');
        $data['store_bcda'] = !empty($raw_bcda) ? trim($raw_bcda) : '#3761';
        
        // 2. Metrics & Counts
        $data['medicine_count'] = 17945;
        $data['customer_count'] = 2694;
        $data['bills_count'] = 31664;
        $data['doctor_count'] = 622;
        
        try {
            if (isset($this->db)) {
                $q_med = $this->db->query("SELECT COUNT(*) as cnt FROM medicines")->row_array();
                if (!empty($q_med['cnt']) && (int)$q_med['cnt'] > 0) $data['medicine_count'] = (int)$q_med['cnt'];
                
                $q_cust = $this->db->query("SELECT COUNT(*) as cnt FROM customers")->row_array();
                if (!empty($q_cust['cnt']) && (int)$q_cust['cnt'] > 0) $data['customer_count'] = (int)$q_cust['cnt'];
                
                $q_bills = $this->db->query("SELECT COUNT(DISTINCT sale_invoice) as cnt FROM sales")->row_array();
                if (!empty($q_bills['cnt']) && (int)$q_bills['cnt'] > 0) $data['bills_count'] = (int)$q_bills['cnt'];
                
                $q_doc = $this->db->query("SELECT COUNT(*) as cnt FROM doctors")->row_array();
                if (!empty($q_doc['cnt']) && (int)$q_doc['cnt'] > 0) $data['doctor_count'] = (int)$q_doc['cnt'];
            }
        } catch (Exception $e) {}
        
        // 3. Featured Categories
        $data['categories'] = array();
        try {
            if (isset($this->db)) {
                $data['categories'] = $this->db->query("SELECT * FROM medicine_categories LIMIT 10")->result_array();
            }
        } catch (Exception $e) {}
        
        // 4. Sample popular medicines for immediate search preview
        $data['featured_medicines'] = array();
        try {
            if (isset($this->db)) {
                $data['featured_medicines'] = $this->db->query("SELECT medicine_id, medicine_name, medicine_category, medicine_manufacturer, medicine_unit, medicine_schedule FROM medicines WHERE medicine_name != '' ORDER BY medicine_id DESC LIMIT 12")->result_array();
            }
        } catch (Exception $e) {}
        
        // 5. Featured Associated Doctors
        $data['featured_doctors'] = array();
        try {
            if (isset($this->db)) {
                $data['featured_doctors'] = $this->db->query("SELECT * FROM doctors WHERE doctor_name != '' AND doctor_name != 'N/A' LIMIT 6")->result_array();
            }
        } catch (Exception $e) {}

        $this->load->view('index_tpl.php', $data);
    }

    public function search_medicines() {
        $q = trim($this->input->get_post('q'));
        if (strlen($q) < 2) {
            echo json_encode(array());
            return;
        }
        $results = array();
        try {
            if (isset($this->db)) {
                $q_esc = $this->db->escape_like_str($q);
                $query = $this->db->query("SELECT medicine_id, medicine_name, medicine_category, medicine_manufacturer, medicine_unit, medicine_schedule FROM medicines WHERE medicine_name LIKE '%$q_esc%' LIMIT 15");
                $results = $query->result_array();
            }
        } catch (Exception $e) {}
        header('Content-Type: application/json');
        echo json_encode($results);
    }

    public function upload_prescription() {
        $name = trim($this->input->post('patient_name'));
        $mobile = trim($this->input->post('patient_phone'));
        $address = trim($this->input->post('delivery_address'));
        $notes = trim($this->input->post('medicine_list'));
        
        if (!empty($name) && !empty($mobile)) {
            try {
                if (isset($this->db)) {
                    $this->db->insert('enquiry', array(
                        'user_name' => $name,
                        'mobile' => $mobile,
                        'email' => $address,
                        'status' => 'Prescription Inquiry: ' . substr($notes, 0, 100)
                    ));
                }
            } catch (Exception $e) {}
            echo json_encode(array('status' => 'success', 'message' => 'Prescription received! Our pharmacist will verify and call you.'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Please provide patient name and phone number.'));
        }
    }
    
    public function contact_us() {
        $this->render();
    }
    public function about_us() {
        $this->render();
    }
    public function wishes() {
        $this->load->view('2024_tpl.php');
    }
    public function chat() {
        echo 'coming soon';
    }
}