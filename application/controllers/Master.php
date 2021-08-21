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

    public function job()
    {
        $jobs = $this->API->get('JOB');
        $data = array(
            'title' => "Master Job Vacation",
            'jobs' => $jobs,
        );
        $this->load->view('dist/modules-job-admin', $data);
    }

    public function history()
    {
        if ($this->session->userdata('data')->ADMIN_ROLE == 2) {
            $sellingRow = $this->API->getSellingAdmin();
        } else {
            $sellingRow = $this->API->getSellingAdmin($this->session->userdata('data')->ADMIN_INSTITUTION);
        }
        
        $data = array(
            'title' => "History Admin",
            'selling' => $sellingRow,
        );
        $this->load->view('dist/modules-history-admin', $data);
    }

    public function buy()
    {

        $sellingRow = $this->API->getBuyAdmin();
        $data = array(
            'title' => "Pembelian Admin",
            'selling' => $sellingRow,
        );
        $this->load->view('dist/modules-history-admin', $data);
    }

    public function institution()
    {
        if ($this->session->userdata('data')->ADMIN_ROLE == 2) {
            $institution = $this->API->getInstitution();
        } else {
            $institution = $this->API->getInstitution($this->session->userdata('data')->ADMIN_INSTITUTION);
        }
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

    public function category()
    {
        $category = $this->API->get('PRODUCT_CATEGORY');
        $data = array(
            'title' => "Master Kategori Produk",
            'category' => $category,
        );
        $this->load->view('dist/modules-category-admin', $data);
    }

    public function add_institution()
    {
        $institution_name = $this->input->post('name');
        $institution_address = $this->input->post('address');
        $admin_name = $this->input->post('admin_name');
        $admin_nohp = $this->input->post('admin_nohp');
        $admin_email = $this->input->post('admin_email');
        $admin_password = $this->input->post('admin_password');

        if (empty($institution_name) || empty($institution_address) || empty($admin_name) || empty($admin_nohp) || empty($admin_email) || empty($admin_password)) {
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
                $dt = array(
                    'ADMIN_NAME' => $admin_name, 
                    'ADMIN_EMAIL' => $admin_email, 
                    'ADMIN_PASSWORD' => $admin_password,
                    'ADMIN_NOHP' => $admin_nohp,
                    'ADMIN_ROLE' => 1,
                    'ADMIN_INSTITUTION' => $result,
                );

                if ($this->API->insert($dt, 'ADMIN')) {
                    echo json_encode(
                        array('status' => true, 'message' => 'Add Institution success', 'data' => $data)
                    );
                }
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
                $result->ADMIN = $this->API->getById(array('ADMIN_INSTITUTION' => $result->INSTITUTION_ID), 'ADMIN');
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
        $idadmin = $this->input->post('id_admin');
        $admin_name = $this->input->post('admin_name');
        $admin_nohp = $this->input->post('admin_nohp');
        $admin_email = $this->input->post('admin_email');
        $admin_password = $this->input->post('admin_password');

        if (empty($id) || empty($institution_name) || empty($institution_address) || empty($admin_name) || empty($admin_nohp) || empty($admin_email) || empty($admin_password)) {
            echo json_encode(
                array('status' => false, 'message' => 'Field are empty', 'data' => null)
            );
        } else {
            $param = array('INSTITUTION_ID' => $id);
            $data = array('INSTITUTION_NAME' => $institution_name, 'INSTITUTION_ADDRESS' => $institution_address);

            $result = $this->API->update($param, $data, 'INSTITUTION');
            if ($result) {
                if ($idadmin == null) {
                    $dt = array(
                        'ADMIN_NAME' => $admin_name,
                        'ADMIN_EMAIL' => $admin_email,
                        'ADMIN_PASSWORD' => $admin_password,
                        'ADMIN_NOHP' => $admin_nohp,
                        'ADMIN_ROLE' => 1,
                        'ADMIN_INSTITUTION' => $id
                    );
                    if ($this->API->insert($dt, 'ADMIN')) {
                        echo json_encode(
                            array('status' => true, 'message' => 'Update institution success', 'data' => $data)
                        );
                    }
                } else {
                    $dt = array(
                        'ADMIN_NAME' => $admin_name,
                        'ADMIN_EMAIL' => $admin_email,
                        'ADMIN_PASSWORD' => $admin_password,
                        'ADMIN_NOHP' => $admin_nohp,
                    );
                    if ($this->API->update(array('ADMIN_ID' => $idadmin), $dt, 'ADMIN')) {
                        echo json_encode(
                            array('status' => true, 'message' => 'Update institution success', 'data' => $data)
                        );
                    }
                }
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
        $target = $this->input->post('target');
        $status = $this->input->post('status');

        if (empty($id) || empty($user_fullname) || empty($user_email) || empty($user_phone) || empty($company_id) || empty($target) || empty($status)) {
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
                'TARGET'     => $target,
                'USER_STATUS'=> $status
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
        $company_partner = $this->input->post('pendamping');
        $company_nohp = $this->input->post('nohp');

        if (empty($id) || empty($comapny_name) || empty($company_address) || empty($company_partner) || empty($company_nohp)) {
            echo json_encode(
                array('status' => false, 'message' => 'Field are empty', 'data' => null)
            );
        } else {
            $param = array('COMPANY_ID' => $id);
            $data = array('COMPANY_NAME' => $comapny_name, 'COMPANY_ADDRESS' => $company_address, 'COMPANY_PARTNER' => $company_partner, 'COMPANY_NOHP' => $company_nohp);

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
        $company_partner = $this->input->post('pendamping');
        $company_nohp = $this->input->post('nohp');

        if (empty($comapny_name) || empty($company_address) || empty($company_partner) || empty($company_nohp)) {
            echo json_encode(
                array('status' => false, 'message' => 'Field empty', 'data' => null)
            );
        } else {
            $data = array('COMPANY_NAME' => $comapny_name, 'COMPANY_ADDRESS' => $company_address, 'COMPANY_IMAGE' => '-', 'COMPANY_PARTNER' => $company_partner, 'COMPANY_NOHP' => $company_nohp);

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
            $config['upload_path']="./upload/products"; //path folder file upload
            $config['allowed_types']='gif|jpg|png'; //type file yang boleh di upload
            $config['encrypt_name'] = TRUE; //enkripsi file name upload
            
            $this->load->library('upload',$config); //call library upload 
            if($this->upload->do_upload("image")){ //upload file
                $data = array('upload_data' => $this->upload->data()); //ambil file name yang diupload
    
                $judul= $this->input->post('judul'); //get judul image
                $image= $data['upload_data']['file_name']; //set file name ke variable image

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
                    $result = $this->API->insert(array('PRODUCT_IMAGE_NAME' => $image, 'PRODUCT_ID' => $result), 'PRODUCT_IMAGE');
                    if ($result) {
                        echo json_encode(
                            array('status' => true, 'message' => 'Add Product success', 'data' => $data)
                        );
                    }
                }
            } else {
                echo json_encode(
                    array('status' => false, 'message' => 'Failed to upload image for product', 'data' => null)
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
                $result->IMAGE = $this->API->getById(array('PRODUCT_ID' => $id), 'PRODUCT_IMAGE');
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
            $config['upload_path']="./upload/products"; //path folder file upload
            $config['allowed_types']='gif|jpg|png'; //type file yang boleh di upload
            $config['encrypt_name'] = TRUE; //enkripsi file name upload

            $this->load->library('upload',$config); //call library upload 
            if($this->upload->do_upload("image")){ //upload file
                $data = array('upload_data' => $this->upload->data()); //ambil file name yang diupload
    
                $judul= $this->input->post('judul'); //get judul image
                $image= $data['upload_data']['file_name']; //set file name ke variable image

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
                    $find = $this->API->getById(array('PRODUCT_ID' => $id), 'PRODUCT_IMAGE');
                    if (!empty($find))
                        $result = $this->API->update(array('PRODUCT_ID' => $id), array('PRODUCT_IMAGE_NAME' => $image), 'PRODUCT_IMAGE');
                    else
                        $result = $this->API->insert(array('PRODUCT_IMAGE_NAME' => $image, 'PRODUCT_ID' => $id), 'PRODUCT_IMAGE');
                    if ($result) {
                        echo json_encode(
                            array('status' => true, 'message' => 'Update product success', 'data' => $data)
                        );
                    }
                } else {
                    echo json_encode(
                        array('status' => false, 'message' => 'Failed to update data with id ' + $id, 'data' => null)
                    ); 
                }
            } else {
                echo json_encode(
                    array('status' => false, 'message' => 'Failed to upload image for product', 'data' => null)
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

    public function add_category()
    {
        $categoryName = $this->input->post('name');

        if (empty($categoryName)) {
            echo json_encode(
                array('status' => false, 'message' => 'Field empty', 'data' => null)
            );
        } else {
            $data = array(
                'CATEGORY_NAME' => $categoryName,
                'CATEGORY_STATUS' => 1,
            );

            $result = $this->API->insert($data, 'PRODUCT_CATEGORY');
            if (!$result) {
                echo json_encode(
                    array('status' => false, 'message' => 'Failed to store on server', 'data' => null)
                );
            } else {
                echo json_encode(
                    array('status' => true, 'message' => 'Add Category Product success', 'data' => $data)
                );
            }
        }
    }

    public function get_category()
    {
        $id = $this->uri->segment(5);
        
        if (empty($id)) {
            echo json_encode(
                array('status' => false, 'message' => 'Field id empty', 'data' => null)
            );
        } else {
            $result = $this->API->getById(array('CATEGORY_ID' => $id), 'PRODUCT_CATEGORY');
            if (!$result) {
                echo json_encode(
                    array('status' => false, 'message' => "Data not found $id", 'data' => null)
                );
            } else {
                echo json_encode(
                    array('status' => true, 'message' => 'Get data category product by id success', 'data' => $result)
                );
            }
        }
    }

    public function update_category()
    {
        $id = $this->input->post('id');
        $categoryName = $this->input->post('name');

        if (empty($id) || empty($categoryName)) {
            echo json_encode(
                array('status' => false, 'message' => 'Field are empty', 'data' => null)
            );
        } else {
            $param = array('CATEGORY_ID' => $id);
            $data = array(
                'CATEGORY_NAME' => $categoryName,
            );

            $result = $this->API->update($param, $data, 'PRODUCT_CATEGORY');
            if ($result) {
                echo json_encode(
                    array('status' => true, 'message' => 'Update category product success', 'data' => $data)
                );
            } else {
                echo json_encode(
                    array('status' => false, 'message' => 'Failed to update data with id ' + $id, 'data' => null)
                ); 
            }
        }
    }

    public function add_job()
    {
        $jobPosition = $this->input->post('position');
        $jobCompany = $this->input->post('company');
        $jobStart = $this->input->post('start');
        $jobEnd = $this->input->post('end');
        $jobDescription = $this->input->post('description');

        if (empty($jobPosition) || empty($jobCompany) || empty($jobStart) || empty($jobEnd) || empty($jobDescription)) {
            echo json_encode(
                array('status' => false, 'message' => 'Field are empty', 'data' => null)
            );
        } else {
            $config['upload_path']="./upload/jobs"; //path folder file upload
            $config['allowed_types']='gif|jpg|png'; //type file yang boleh di upload
            $config['encrypt_name'] = TRUE; //enkripsi file name upload

            $this->load->library('upload',$config); //call library upload 
            if($this->upload->do_upload("poster")){ //upload file
                $data = array('upload_data' => $this->upload->data()); //ambil file name yang diupload
    
                $image= $data['upload_data']['file_name']; //set file name ke variable image

                $data = array(
                    'JOB_POSITION' => $jobPosition,
                    'JOB_COMPANY' => $jobCompany,
                    'JOB_START' => $jobStart,
                    'JOB_END' => $jobEnd,
                    'JOB_DESCRIPTION' => $jobDescription,
                    'JOB_POSTER' => $image,
                );

                $result = $this->API->insert($data, 'JOB');
                if (!$result) {
                    echo json_encode(
                        array('status' => false, 'message' => 'Failed to store on server', 'data' => null)
                    );
                } else {
                    echo json_encode(
                       array('status' => true, 'message' => 'Add job success', 'data' => $data)
                    );
                }
            } else {
                echo json_encode(
                    array('status' => false, 'message' => 'Failed to upload image for job', 'data' => null)
                );
            }
        }
    }

    public function get_job()
    {
        $id = $this->uri->segment(5);
        
        if (empty($id)) {
            echo json_encode(
                array('status' => false, 'message' => 'Field id empty', 'data' => null)
            );
        } else {
            $result = $this->API->getById(array('JOB_ID' => $id), 'JOB');
            if (!$result) {
                echo json_encode(
                    array('status' => false, 'message' => "Data not found $id", 'data' => null)
                );
            } else {
                echo json_encode(
                    array('status' => true, 'message' => 'Get data job by id success', 'data' => $result)
                );
            }
        }
    }

    public function update_job()
    {
        $id = $this->input->post('id');
        $jobPosition = $this->input->post('position');
        $jobCompany = $this->input->post('company');
        $jobStart = $this->input->post('start');
        $jobEnd = $this->input->post('end');
        $jobDescription = $this->input->post('description');

        if (empty($id) || empty($jobPosition) || empty($jobCompany) || empty($jobStart) || empty($jobEnd) || empty($jobDescription)) {
            echo json_encode(
                array('status' => false, 'message' => 'Field are empty', 'data' => null)
            );
        } else {
            $config['upload_path']="./upload/jobs"; //path folder file upload
            $config['allowed_types']='gif|jpg|png'; //type file yang boleh di upload
            $config['encrypt_name'] = TRUE; //enkripsi file name upload

            $this->load->library('upload',$config); //call library upload 
            if($this->upload->do_upload("poster")){ //upload file
                $data = array('upload_data' => $this->upload->data()); //ambil file name yang diupload
    
                $image= $data['upload_data']['file_name']; //set file name ke variable image

                $param = array('JOB_ID' => $id);
                $data = array(
                    'JOB_POSITION' => $jobPosition,
                    'JOB_COMPANY' => $jobCompany,
                    'JOB_START' => $jobStart,
                    'JOB_END' => $jobEnd,
                    'JOB_DESCRIPTION' => $jobDescription,
                    'JOB_POSTER' => $image,
                );

                $result = $this->API->update($param, $data, 'JOB');
                if ($result) {
                    echo json_encode(
                        array('status' => true, 'message' => 'Update job success', 'data' => $data)
                    );
                } else {
                    echo json_encode(
                        array('status' => false, 'message' => 'Failed to update data with id ' + $id, 'data' => null)
                    ); 
                }
            } else {
                echo json_encode(
                    array('status' => false, 'message' => 'Failed to upload image for product', 'data' => null)
                );
            }
        }
    }

    public function delete_job()
    {
        $id = $this->uri->segment(5);
        if (empty($id)) {
            echo json_encode(
                array('status' => false, 'message' => 'Field id empty', 'data' => null)
            );
        } else {
            $result = $this->API->delete(array('JOB_ID' => $id), 'JOB');
            echo json_encode(
                array('status' => true, 'message' => 'Delete data job by id success', 'data' => $result)
            );
        }
    }
}

/* End of file Master.php */
