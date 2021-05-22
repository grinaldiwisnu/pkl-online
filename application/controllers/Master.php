<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('login')) {
            redirect('auth','refresh');
        }
        $this->load->model('API_Model', 'API');

        $isAdmin = $this->API->checkAdmin(array('ADMIN_ID' => $this->session->userdata('id')));
        if (!$isAdmin) {
            session_destroy();
            redirect('auth','refresh');
        }
    }

    public function index()
    {
        
    }

    public function history()
    {

        $sellingRow = $this->API->getSellingAdmin();
        $data = array(
            'title' => "History Admin",
            'selling' => $sellingRow,
        );
        $this->load->view('dist/modules-history-admin', $data);
    }

    public function institution()
    {
        $institution = $this->API->getInstitution();
        $data = array(
            'title' => "Master Institusi",
            'institution' => $institution,
        );
        $this->load->view('dist/modules-institution-admin', $data);
    }

    public function company()
    {
        $company = $this->API->get('COMPANY');
        $data = array(
            'title' => "Master Perusahaan",
            'company' => $company,
        );
        $this->load->view('dist/modules-company-admin', $data);
    }

    public function add_institution()
    {
        $institution_name = $this->input->post('name');
        $institution_address = $this->input->post('address');

        if (empty($institution_name) || empty($institution_address)) {
            echo json_encode(
                array('status' => false, 'message' => 'Field empty', 'data' => null)
            );
        } else {
            $data = array('INSTITUTION_NAME' => $institution_name, 'INSTITUTION_ADDRESS' => $institution_address, 'INSTITUTION_AS' => '-');

            $result = $this->API->insert($data, 'INSTITUTION');
            if (!$result) {
                echo json_encode(
                    array('status' => false, 'message' => 'Failed to store on server', 'data' => null)
                );
            } else {
                echo json_encode(
                    array('status' => true, 'message' => 'Add Institution success', 'data' => $data)
                );
            }
        }
    }

    public function get_institution()
    {
        $id = $this->uri->segment(5);
        
        if (empty($id)) {
            echo json_encode(
                array('status' => false, 'message' => 'Field id empty', 'data' => null)
            );
        } else {
            $result = $this->API->getById(array('INSTITUTION_ID' => $id), 'INSTITUTION');
            if (!$result) {
                echo json_encode(
                    array('status' => false, 'message' => "Data not found $id", 'data' => null)
                );
            } else {
                echo json_encode(
                    array('status' => true, 'message' => 'Get data institution by id success', 'data' => $result)
                );
            }
        }
    }

    public function update_institution()
    {
        $id = $this->input->post('id');
        $institution_name = $this->input->post('name');
        $institution_address = $this->input->post('address');

        if (empty($id) || empty($institution_name) || empty($institution_address)) {
            echo json_encode(
                array('status' => false, 'message' => 'Field are empty', 'data' => null)
            );
        } else {
            $param = array('INSTITUTION_ID' => $id);
            $data = array('INSTITUTION_NAME' => $institution_name, 'INSTITUTION_ADDRESS' => $institution_address);

            $result = $this->API->update($param, $data, 'INSTITUTION');
            if ($result) {
                echo json_encode(
                    array('status' => true, 'message' => 'Update institution success', 'data' => $data)
                );
            } else {
                echo json_encode(
                    array('status' => false, 'message' => 'Failed to update data with id ' + $id, 'data' => null)
                ); 
            }
        }
    }

    public function delete_institution()
    {
        $id = $this->uri->segment(5);
        if (empty($id)) {
            echo json_encode(
                array('status' => false, 'message' => 'Field id empty', 'data' => null)
            );
        } else {
            $result = $this->API->delete(array('INSTITUTION_ID' => $id), 'INSTITUTION');
            echo json_encode(
                array('status' => true, 'message' => 'Delete data institution by id ' + $id + ' success')
            );
        }
    }

    public function detail_institution()
    {
        $id = $this->uri->segment(4);
        if (empty($id)) {
            
            redirect('master/institution','refresh');
            
        } else {
            $detail = $this->API->getById(array('INSTITUTION_ID' => $id), 'INSTITUTION');
            $child = $this->API->getChildById(array('INSTITUTION_ID' => $id), 'USER');
            for ($i=0; $i < count($child); $i++) { 
                if ($child[$i]->COMPANY_ID != null)
                    $child[$i]->COMPANY_DETAIL = $this->API->getById(array('COMPANY_ID' => $child[$i]->COMPANY_ID), 'COMPANY');
            }
            $company = $this->API->get('COMPANY');
            $data = array(
                'title' => "Detail Institusi $detail->INSTITUTION_NAME",
                'detail' => $detail,
                'child' => $child,
                'company' => $company
            );
            $this->load->view('dist/modules-detail-institution-admin', $data);
        }
    }

    public function get_user_institution()
    {
        $id = $this->uri->segment(5);
        
        if (empty($id)) {
            echo json_encode(
                array('status' => false, 'message' => 'Field id empty', 'data' => null)
            );
        } else {
            $result = $this->API->getById(array('USER_ID' => $id), 'USER');
            if (!$result) {
                echo json_encode(
                    array('status' => false, 'message' => "Data not found $id", 'data' => null)
                );
            } else {
                echo json_encode(
                    array('status' => true, 'message' => 'Get data user by id success', 'data' => $result)
                );
            }
        }
    }

    public function update_user_institution()
    {
        $id = $this->input->post('id');
        $user_fullname = $this->input->post('fullname');
        $user_email = $this->input->post('email');
        $user_phone = $this->input->post('phone');
        $company_id = $this->input->post('company');

        if (empty($id) || empty($user_fullname) || empty($user_email) || empty($user_phone) || empty($company_id)) {
            echo json_encode(
                array('status' => false, 'message' => 'Field are empty', 'data' => null)
            );
        } else {
            $param = array('USER_ID' => $id);
            $data = array(
                'USER_FULLNAME' => $user_fullname,
                'USER_EMAIL' => $user_email, 
                'USER_PHONE' => $user_phone,
                'COMPANY_ID' => $company_id,
            );

            $result = $this->API->update($param, $data, 'USER');
            if ($result) {
                echo json_encode(
                    array('status' => true, 'message' => 'Update user success', 'data' => $data)
                );
            } else {
                echo json_encode(
                    array('status' => false, 'message' => 'Failed to update data with id ' + $id, 'data' => null)
                ); 
            }
        }
    }

    public function delete_user_institution()
    {
        $id = $this->uri->segment(5);
        if (empty($id)) {
            echo json_encode(
                array('status' => false, 'message' => 'Field id empty', 'data' => null)
            );
        } else {
            $result = $this->API->delete(array('USER_ID' => $id), 'USER');
            echo json_encode(
                array('status' => true, 'message' => 'Delete data user by id ' + $id + ' success')
            );
        }
    }

    public function detail_company()
    {
        $id = $this->uri->segment(4);
        if (empty($id)) {
            
            redirect('master/company','refresh');
            
        } else {
            $detail = $this->API->getById(array('COMPANY_ID' => $id), 'COMPANY');
            $child = $this->API->getChildById(array('COMPANY_ID' => $id), 'PRODUCT');
            for ($i=0; $i < count($child); $i++) { 
                if ($child[$i]->CATEGORY_ID != null)
                    $child[$i]->CATEGORY_DETAIL = $this->API->getById(array('CATEGORY_ID' => $child[$i]->CATEGORY_ID), 'PRODUCT_CATEGORY');
            }
            $data = array(
                'title' => "Detail Perusahaan $detail->COMPANY_NAME",
                'detail' => $detail,
                'child' => $child,
                'category' => $this->API->get('PRODUCT_CATEGORY')
            );
            $this->load->view('dist/modules-detail-company-admin', $data);
        }
    }

    public function get_company()
    {
        $id = $this->uri->segment(5);
        
        if (empty($id)) {
            echo json_encode(
                array('status' => false, 'message' => 'Field id empty', 'data' => null)
            );
        } else {
            $result = $this->API->getById(array('COMPANY_ID' => $id), 'COMPANY');
            if (!$result) {
                echo json_encode(
                    array('status' => false, 'message' => "Data not found $id", 'data' => null)
                );
            } else {
                echo json_encode(
                    array('status' => true, 'message' => 'Get data company by id success', 'data' => $result)
                );
            }
        }
    }

    public function update_company()
    {
        $id = $this->input->post('id');
        $comapny_name = $this->input->post('name');
        $company_address = $this->input->post('address');

        if (empty($id) || empty($comapny_name) || empty($company_address)) {
            echo json_encode(
                array('status' => false, 'message' => 'Field are empty', 'data' => null)
            );
        } else {
            $param = array('COMPANY_ID' => $id);
            $data = array('COMPANY_NAME' => $comapny_name, 'COMPANY_ADDRESS' => $company_address);

            $result = $this->API->update($param, $data, 'COMPANY');
            if ($result) {
                echo json_encode(
                    array('status' => true, 'message' => 'Update company success', 'data' => $data)
                );
            } else {
                echo json_encode(
                    array('status' => false, 'message' => 'Failed to update data with id ' + $id, 'data' => null)
                ); 
            }
        }
    }

    public function delete_company()
    {
        $id = $this->uri->segment(5);
        if (empty($id)) {
            echo json_encode(
                array('status' => false, 'message' => 'Field id empty', 'data' => null)
            );
        } else {
            $result = $this->API->delete(array('COMPANY_ID' => $id), 'COMPANY');
            echo json_encode(
                array('status' => true, 'message' => 'Delete data company by id ' + $id + ' success')
            );
        }
    }

    public function add_company()
    {
        $comapny_name = $this->input->post('name');
        $company_address = $this->input->post('address');

        if (empty($comapny_name) || empty($company_address)) {
            echo json_encode(
                array('status' => false, 'message' => 'Field empty', 'data' => null)
            );
        } else {
            $data = array('COMPANY_NAME' => $comapny_name, 'COMPANY_ADDRESS' => $company_address, 'COMPANY_IMAGE' => '-');

            $result = $this->API->insert($data, 'COMPANY');
            if (!$result) {
                echo json_encode(
                    array('status' => false, 'message' => 'Failed to store on server', 'data' => null)
                );
            } else {
                echo json_encode(
                    array('status' => true, 'message' => 'Add Company success', 'data' => $data)
                );
            }
        }
    }

    public function add_product()
    {
        $id = $this->input->post('id');
        $productName = $this->input->post('name');
        $productPrice = $this->input->post('price');
        $productStock = $this->input->post('stock');
        $productCategory = $this->input->post('category');
        $productDesc = $this->input->post('description');

        if (empty($id) || empty($productName) || empty($productPrice) || empty($productStock) || empty($productCategory) || empty($productDesc)) {
            echo json_encode(
                array('status' => false, 'message' => 'Field empty', 'data' => null)
            );
        } else {
            $data = array(
                'PRODUCT_NAME' => $productName,
                'PRODUCT_DESCRIPTION' => $productDesc,
                'PRODUCT_PRICE' => $productPrice,
                'PRODUCT_STOCK' => $productStock,
                'COMPANY_ID' => $id,
                'CATEGORY_ID' => $productCategory,
            );

            $result = $this->API->insert($data, 'PRODUCT');
            if (!$result) {
                echo json_encode(
                    array('status' => false, 'message' => 'Failed to store on server', 'data' => null)
                );
            } else {
                echo json_encode(
                    array('status' => true, 'message' => 'Add Product success', 'data' => $data)
                );
            }
        }
    }

    public function get_product()
    {
        $id = $this->uri->segment(5);
        
        if (empty($id)) {
            echo json_encode(
                array('status' => false, 'message' => 'Field id empty', 'data' => null)
            );
        } else {
            $result = $this->API->getById(array('PRODUCT_ID' => $id), 'PRODUCT');
            if (!$result) {
                echo json_encode(
                    array('status' => false, 'message' => "Data not found $id", 'data' => null)
                );
            } else {
                echo json_encode(
                    array('status' => true, 'message' => 'Get data product by id success', 'data' => $result)
                );
            }
        }
    }

    public function update_product()
    {
        $id = $this->input->post('id');
        $productName = $this->input->post('name');
        $productPrice = $this->input->post('price');
        $productStock = $this->input->post('stock');
        $productDesc = $this->input->post('description');
        $productCategory = $this->input->post('category');

        if (empty($id) || empty($productName) || empty($productPrice) || empty($productStock) || empty($productCategory) || empty($productDesc)) {
            echo json_encode(
                array('status' => false, 'message' => 'Field are empty', 'data' => null)
            );
        } else {
            $param = array('PRODUCT_ID' => $id);
            $data = array(
                'PRODUCT_NAME' => $productName,
                'PRODUCT_DESCRIPTION' => $productDesc,
                'PRODUCT_PRICE' => $productPrice,
                'PRODUCT_STOCK' => $productStock,
                'CATEGORY_ID' => $productCategory,
            );

            $result = $this->API->update($param, $data, 'PRODUCT');
            if ($result) {
                echo json_encode(
                    array('status' => true, 'message' => 'Update product success', 'data' => $data)
                );
            } else {
                echo json_encode(
                    array('status' => false, 'message' => 'Failed to update data with id ' + $id, 'data' => null)
                ); 
            }
        }
    }

    public function delete_product()
    {
        $id = $this->uri->segment(5);
        if (empty($id)) {
            echo json_encode(
                array('status' => false, 'message' => 'Field id empty', 'data' => null)
            );
        } else {
            $result = $this->API->delete(array('PRODUCT_ID' => $id), 'PRODUCT');
            echo json_encode(
                array('status' => true, 'message' => 'Delete data product by id success')
            );
        }
    }
}

/* End of file Master.php */
