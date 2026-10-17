<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of home
 *
 * @author Kallol
 */
class Customer extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->targetModel = 'customers_model';
        $this->moduleMeta = array('medical' => 'Customer');
        $this->page_config['tablePrimaryKey'] = $this->customers_model->get_primary_key(); //pk
        
        /* Page Config */
        $this->page_config['title'] = 'Customer';
        $this->page_config['searchFields'] = 'customer_name,customer_contact,customer_address,email';
        $this->page_config['list_columns'] = 'customer_name,customer_contact,customer_address,customer_due,email';

        /* Form Validation Rules (Client & Server) */
        $this->page_config['validation'] = array(
            'customer_name' => 'required',
            'customer_contact' => 'required|phone',
            'email' => 'email',
            'customer_due' => 'numeric'
        );

        $this->page_config['replace_text'] = array(
            'customer_name' => 'Customer / Patient Name',
            'customer_contact' => 'Mobile No.',
            'customer_address' => 'Address',
            'customer_gst' => 'GSTIN',
            'customer_due' => 'Current Due (Rs.)',
            'doctor_name' => 'Referred Doctor',
            'email' => 'Email Address'
        );
    }

    /**
     * Validate and sanitize customer input data
     */
    private function validate_customer_data($data, $is_edit = false, $customer_id = 0) {
        $errors = array();

        $name = isset($data['customer_name']) ? trim($data['customer_name']) : '';
        if ($name === '') {
            $errors[] = 'Customer / Patient Name is required.';
        } elseif (strlen($name) < 2) {
            $errors[] = 'Customer Name must be at least 2 characters.';
        } elseif (strlen($name) > 50) {
            $errors[] = 'Customer Name cannot exceed 50 characters.';
        }

        $raw_contact = isset($data['customer_contact']) ? trim($data['customer_contact']) : '';
        $contact = preg_replace('/[^0-9]/', '', $raw_contact);

        if ($raw_contact === '') {
            $errors[] = 'Mobile / Contact number is required.';
        } else {
            if (strlen($contact) == 12 && substr($contact, 0, 2) === '91') {
                $contact = substr($contact, 2);
            } elseif (strlen($contact) == 11 && substr($contact, 0, 1) === '0') {
                $contact = substr($contact, 1);
            }
            if (strlen($contact) !== 10) {
                $errors[] = 'Please enter a valid 10-digit mobile number.';
            } else {
                // Check if phone was changed during edit or if adding new
                $phone_changed = true;
                if ($is_edit && $customer_id > 0) {
                    $curr = $this->db->select('customer_contact')
                                     ->where('customer_ID', $customer_id)
                                     ->get('customers')
                                     ->row_array();
                    if (!empty($curr) && trim($curr['customer_contact']) === $contact) {
                        $phone_changed = false;
                    }
                }

                if ($phone_changed) {
                    $this->db->select('customer_ID, customer_name');
                    $this->db->where('customer_contact', $contact);
                    if ($is_edit && $customer_id > 0) {
                        $this->db->where('customer_ID !=', $customer_id);
                    }
                    $existing = $this->db->get('customers')->row_array();
                    if (!empty($existing)) {
                        $errors[] = 'Mobile number (' . $contact . ') is already registered to ' . $existing['customer_name'] . ' (ID #' . $existing['customer_ID'] . ').';
                    }
                }
            }
        }

        $email = isset($data['email']) ? trim($data['email']) : '';
        if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Please enter a valid email address.';
        }

        $gst = isset($data['customer_gst']) ? strtoupper(trim($data['customer_gst'])) : '';
        if ($gst !== '' && $gst !== 'N/A') {
            if (!preg_match('/^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/i', $gst)) {
                $errors[] = 'Invalid GSTIN format. Must be 15 alphanumeric characters (e.g. 19AAAAA0000A1Z5) or N/A.';
            }
        }

        $due = isset($data['customer_due']) ? trim($data['customer_due']) : '0.00';
        if ($due !== '' && (!is_numeric($due) || (float)$due < 0)) {
            $errors[] = 'Due amount must be a valid non-negative number.';
        }

        return array(
            'is_valid' => empty($errors),
            'errors' => $errors,
            'clean_data' => array(
                'customer_name' => $name,
                'customer_contact' => $contact ? $contact : $raw_contact,
                'customer_address' => isset($data['customer_address']) ? trim($data['customer_address']) : '',
                'customer_gst' => $gst !== '' ? $gst : 'N/A',
                'customer_due' => is_numeric($due) ? number_format((float)$due, 2, '.', '') : '0.00',
                'doctor_name' => isset($data['doctor_name']) ? trim($data['doctor_name']) : '',
                'email' => $email
            )
        );
    }

    public function add_detail() {
        $postedData = $this->input->post();
        $config = $this->auto_fieldtype_detect(NULL);
        $this->page_config = array_merge($config, $this->page_config);

        if (isset($postedData['load_add_entry'])) {
            $entryData = $this->{$this->targetModel}->get_field_list();
            echo $this->generate_form_view($entryData[0], $this->page_config);
        } else {
            if ($postedData) {
                $validation = $this->validate_customer_data($postedData, false);
                if (!$validation['is_valid']) {
                    echo json_encode(array('status' => 'error', 'message' => implode('<br>', $validation['errors'])));
                    return;
                }

                $saveData = array_merge($postedData, $validation['clean_data']);
                unset($saveData['customer_ID']);

                $lastInsertedID = $this->{$this->targetModel}->insert_data($saveData);
                if ($lastInsertedID) {
                    echo json_encode(array('status' => 'success', 'message' => 'Customer "' . $validation['clean_data']['customer_name'] . '" added successfully!'));
                } else {
                    echo json_encode(array('status' => 'error', 'message' => 'Failed to save customer. Please try again.'));
                }
            }
        }
    }

    public function edit_detail() {
        $postedData = $this->input->post();
        $config = $this->auto_fieldtype_detect(NULL);
        $this->page_config = array_merge($config, $this->page_config);
        $pk = $config['tablePrimaryKey'];

        if (isset($postedData['load_edit_entry'])) {
            $entryData2 = $this->{$this->targetModel}->get_list(array($pk => trim($postedData['load_edit_entry'])));
            $entryData1 = $this->{$this->targetModel}->get_field_list();
            $entryData = array_intersect_key($entryData2[0], $entryData1[0]);
            echo $this->generate_form_view($entryData, $this->page_config);
        } else {
            if ($postedData) {
                $customer_id = isset($postedData[$pk]) ? intval($postedData[$pk]) : 0;
                if ($customer_id <= 0) {
                    echo json_encode(array('status' => 'error', 'message' => 'Invalid customer ID.'));
                    return;
                }

                $validation = $this->validate_customer_data($postedData, true, $customer_id);
                if (!$validation['is_valid']) {
                    echo json_encode(array('status' => 'error', 'message' => implode('<br>', $validation['errors'])));
                    return;
                }

                $saveData = array_merge($postedData, $validation['clean_data']);

                $this->{$this->targetModel}->update_data($saveData, array($pk => $customer_id));
                echo json_encode(array('status' => 'success', 'message' => 'Customer "' . $validation['clean_data']['customer_name'] . '" updated successfully!'));
            }
        }
    }

}