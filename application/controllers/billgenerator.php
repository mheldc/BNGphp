<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class billgenerator extends CI_Controller {
    
        var $userid;
        var $data;
        
        public function index() {
            $userdata = $this->session->userdata('userdata');
            $response = $this->session->userdata('response');
            if(!isset($userdata[0]->userid)){
                $data['uid'] = 0;
            } else {
                $data['uid'] = $userid = $userdata[0]->userid;
            }
            
            if(!isset($userdata[0]->loginid)){ $data['lid'] = 0; } else { $data['lid'] = $userdata[0]->loginid; }
            if(!isset($userdata[0]->fullname)){ $data['uname'] = ''; } else { $data['uname'] = $userdata[0]->fullname; }
            if(!isset($response)){
                $data['ctlenabled'] = false;
                $data['setlogindisplay'] = 'block';
                $data['setlogoutdisplay'] = 'none';
            } else {
                $data['ctlenabled'] = $response;
                $data['setlogindisplay'] = 'none';
                $data['setlogoutdisplay'] = 'block';
            }
            $data['module'] = 'noticemain';
            
            if(!isset($userid)){
                $this->load->view('header');
                $this->load->view('navigation', $data);
                $this->load->view('footer', $data);
            } else {
                $this->load->view('header');
                $this->load->view('navigation', $data);
                $this->load->view('billnoticemain');
                $this->load->view('footer', $data);
            }
        }

        public function authuser() {
            $loginid = $_POST['uid'];
            $loginpw = $_POST['pwd'];
            
            $this->load->model('bgmodel');
            $rs     = $this->bgmodel->authenticate_user($loginid, $loginpw);
            $this->session->set_userdata($rs);
            
            echo json_encode($rs);
        }
        
        public function signoff() {
            session_destroy();
            echo json_encode(array('received' => true, 'response' => true));
        }
        
        public function billnotice() {
            $userdata = $this->session->userdata('userdata');
            $response = $this->session->userdata('response');
            if(!isset($userdata[0]->userid)){
                $data['uid'] = 0;
            } else {
                $data['uid'] = $userid = $userdata[0]->userid;
            }
            
            if(!isset($userdata[0]->loginid)){ $data['lid'] = 0; } else { $data['lid'] = $userdata[0]->loginid; }
            if(!isset($userdata[0]->fullname)){ $data['uname'] = ''; } else { $data['uname'] = $userdata[0]->fullname; }
            if(!isset($response)){
                $data['ctlenabled'] = false;
                $data['setlogindisplay'] = 'block';
                $data['setlogoutdisplay'] = 'none';
            } else {
                $data['ctlenabled'] = $response;
                $data['setlogindisplay'] = 'none';
                $data['setlogoutdisplay'] = 'block';
            }         
            $data['module'] = 'noticemain';
            
            if(!isset($userid)){
                //$this->load->view('header');
                //$this->load->view('navigation', $data);
                //$this->load->view('footer', $data);
                $url = str_replace('index.php/', '', base_url());
                header('Location:'.$url);
                
            } else {
                $this->load->view('header');
                $this->load->view('navigation', $data);
                $this->load->view('billnoticemain');
                $this->load->view('footer', $data);
            }
        }
        public function clients() {
            $userdata = $this->session->userdata('userdata');
            $response = $this->session->userdata('response');
            if(!isset($userdata[0]->userid)){
                $data['uid'] = 0;
            } else {
                $data['uid'] = $userid = $userdata[0]->userid;
            }
            
            if(!isset($userdata[0]->loginid)){ $data['lid'] = 0; } else { $data['lid'] = $userdata[0]->loginid; }
            if(!isset($userdata[0]->fullname)){ $data['uname'] = ''; } else { $data['uname'] = $userdata[0]->fullname; }
            if(!isset($response)){
                $data['ctlenabled'] = false;
                $data['setlogindisplay'] = 'block';
                $data['setlogoutdisplay'] = 'none';
            } else {
                $data['ctlenabled'] = $response;
                $data['setlogindisplay'] = 'none';
                $data['setlogoutdisplay'] = 'block';
            }
            $data['module'] = 'client';
            
            if(!isset($userid)){
                //$this->load->view('header');
                //$this->load->view('navigation', $data);
                //$this->load->view('footer', $data);
                $url = str_replace('index.php/', '', base_url());
                header('Location:'.$url);
            } else {
                $this->load->view('header');
                $this->load->view('navigation', $data);
                $this->load->view('clients');
                $this->load->view('footer', $data);
            }
        }

        
        public function users() {
            $userdata = $this->session->userdata('userdata');
            $response = $this->session->userdata('response');
            if(!isset($userdata[0]->userid)){
                $data['uid'] = 0;
            } else {
                $data['uid'] = $userid = $userdata[0]->userid;
            }
            
            if(!isset($userdata[0]->loginid)){ $data['lid'] = 0; } else { $data['lid'] = $userdata[0]->loginid; }
            if(!isset($userdata[0]->fullname)){ $data['uname'] = ''; } else { $data['uname'] = $userdata[0]->fullname; }
            if(!isset($response)){
                $data['ctlenabled'] = false;
                $data['setlogindisplay'] = 'block';
                $data['setlogoutdisplay'] = 'none';
            } else {
                $data['ctlenabled'] = $response;
                $data['setlogindisplay'] = 'none';
                $data['setlogoutdisplay'] = 'block';
            }
            $data['module'] = 'users';
            
            if(!isset($userid)){
                $this->load->view('header');
                $this->load->view('navigation', $data);
                $this->load->view('footer', $data);
            } else {
                $this->load->view('header');
                $this->load->view('navigation', $data);
                $this->load->view('users');
                $this->load->view('footer', $data);
            }
        }
        
        public function registeruser() {
            $udata = json_decode($_POST['udata']);
            
            if(filter_var($email, FILTER_VALIDATE_EMAIL) === true){
                echo 'this is valid';
            }
            
            $this->load->model('bgmodel');
            $this->bgmodel->register_user($loginid, $loginpw, $firstname, $middlename, $lastname, $email);
        }
        
        public function getclients() {
            $this->load->model('bgmodel');
            $result = $this->bgmodel->tran_accounts(4);
            echo json_encode($result);
        }
        
        public function getaccounts() {
            $this->load->model('bgmodel');
            $result = $this->bgmodel->get_accounts();
            echo json_encode($result);
        }
        
        public function getacctcontacts() {
            $accountid = $_POST['accountid'];
            $this->load->model('bgmodel');
            $result = $this->bgmodel->get_account_contacts($accountid);
            echo json_encode($result);
        }
        
        public function searchclient() {
            $searched_item = $_POST['searchfield'];
            $this->load->model('bgmodel');
            $result = $this->bgmodel->search_clients($searched_item);
            echo json_encode($result);
        }
        
        public function registerclient() {

            $trantype   = $_POST['tran_type'];
            $acctid     = $_POST['acctid'];
            $acctname   = $_POST['accountname'];
            $addr1      = $_POST['addr1'];
            $addr2      = $_POST['addr2'];
            $city       = $_POST['city'];
            $province   = $_POST['prov'];
            $zipcode    = $_POST['zipcode'];
            $used_id    = 1;
            
            $this->load->model('bgmodel');
            $result = $this->bgmodel->tran_accounts($trantype, $acctid, $used_id, $acctname, $addr1, $addr2, $city, $province, $zipcode);

            echo json_encode($result);
        }
        
        public function clientcontacts() {
            $userdata = $this->session->userdata('userdata');
            $response = $this->session->userdata('response');
            if(!isset($userdata[0]->userid)){
                $data['uid'] = 0;
            } else {
                $data['uid'] = $userid = $userdata[0]->userid;
            }
            
            if(!isset($userdata[0]->loginid)){ $data['lid'] = 0; } else { $data['lid'] = $userdata[0]->loginid; }
            if(!isset($userdata[0]->fullname)){ $data['uname'] = ''; } else { $data['uname'] = $userdata[0]->fullname; }
            if(!isset($response)){
                $data['ctlenabled'] = false;
                $data['setlogindisplay'] = 'block';
                $data['setlogoutdisplay'] = 'none';
            } else {
                $data['ctlenabled'] = $response;
                $data['setlogindisplay'] = 'none';
                $data['setlogoutdisplay'] = 'block';
            }
            $data['module'] = 'contacts';
            
            if(!isset($userid)){
                //$this->load->view('header');
                //$this->load->view('navigation', $data);              
                //$this->load->view('footer', $data);
                $url = str_replace('index.php/', '', base_url());
                header('Location:'.$url);
            } else {
                $client_arn = $this->uri->segment(3,'');
                if( $client_arn == '' ) {
                    index();   
                } else {
                    $this->load->model('bgmodel');
                    $result = $this->bgmodel->get_contact_company($client_arn);
                    
                    foreach ($result->result() as $row) {
                        $data['acctid'] = $row->acctid;
                        $data['acctrefno'] = $row->acctrefno;
                        $data['acctname'] = $row->accountname;
                        $data['addr1'] = $row->address;
                        $data['addr2'] = $row->address2;
                        $data['city'] = $row->city;
                        $data['prov'] = $row->province;
                        $data['zipcode'] = $row->zipcode;                       
                    }

                    $this->load->view('header');
                    $this->load->view('navigation', $data);
                    $this->load->view('clientcontacts', $data);                
                    $this->load->view('footer', $data);
                }                
            }
        }
        
        public function getclientcontacts() {
            $accountid = $_POST['accountid'];
            $this->load->model('bgmodel');
            $result = $this->bgmodel->register_contact(4, $accountid);
        
            echo json_encode($result);
        }
        
        public function searchcontacts() {
            $accountid      = $_POST['accountid'];
            $searcheditem   = $_POST['searcheditem']; 
            $this->load->model('bgmodel');
            $result = $this->bgmodel->search_contacts($accountid, $searcheditem);
        
            echo json_encode($result);            
        }
        
        public function registercontact() {
            
            $trantype   = $_POST['tran_type']; 
            $accountid  = $_POST['accountid'];
            $contactid  = $_POST['contactid'];
            $honorifics = $_POST['honorifics'];
            $firstname  = $_POST['firstname'];
            $middlename = $_POST['middlename'];
            $lastname   = $_POST['lastname'];
            $jobpost    = $_POST['jobpost'];
            $userid     = 0;
            
            $this->load->model('bgmodel');
            $result = $this->bgmodel->register_contact($trantype, $accountid, $contactid, $honorifics, $firstname, $middlename, $lastname, $jobpost, $userid);
            
            echo json_encode($result);
            
        }
                
        public function createbillnotice() {
            $userdata = $this->session->userdata('userdata');
            $response = $this->session->userdata('response');
            if(!isset($userdata[0]->userid)){
                $data['uid'] = 0;
            } else {
                $data['uid'] = $userid = $userdata[0]->userid;
            }
            
            if(!isset($userdata[0]->loginid)){ $data['lid'] = 0; } else { $data['lid'] = $userdata[0]->loginid; }
            if(!isset($userdata[0]->fullname)){ $data['uname'] = ''; } else { $data['uname'] = $userdata[0]->fullname; }
            if(!isset($response)){
                $data['ctlenabled'] = false;
                $data['setlogindisplay'] = 'block';
                $data['setlogoutdisplay'] = 'none';
            } else {
                $data['ctlenabled'] = $response;
                $data['setlogindisplay'] = 'none';
                $data['setlogoutdisplay'] = 'block';
            }         
            $data['module'] = 'notice';
            
            if(!isset($userid)){
                //$this->load->view('header');
                //$this->load->view('navigation', $data);
                //$this->load->view('footer', $data);
                $url = str_replace('index.php/', '', base_url());
                header('Location:'.$url);
                
            } else {
                $this->load->view('header');
                $this->load->view('navigation', $data);
                $this->load->view('billnotice');
                $this->load->view('footer', $data);
            }            
        }
        
        public function processnotice() {
            $userdata = $this->session->userdata('userdata');
            $response = $this->session->userdata('response');
            if(!isset($userdata[0]->userid)){
                $data['uid'] = 0;
            } else {
                $data['uid'] = $userid = $userdata[0]->userid;
            }
            
            if(!isset($userdata[0]->loginid)){ $data['lid'] = 0; } else { $data['lid'] = $userdata[0]->loginid; }
            if(!isset($userdata[0]->fullname)){ $data['uname'] = ''; } else { $data['uname'] = $userdata[0]->fullname; }
            if(!isset($response)){
                $data['ctlenabled'] = false;
                $data['setlogindisplay'] = 'block';
                $data['setlogoutdisplay'] = 'none';
            } else {
                $data['ctlenabled'] = $response;
                $data['setlogindisplay'] = 'none';
                $data['setlogoutdisplay'] = 'block';
            }         
            $data['module'] = 'notice';
            
            if(!isset($userid)){
                $this->load->view('header');
                $this->load->view('navigation', $data);
                $this->load->view('footer', $data);
                //$url = str_replace('index.php/', '', base_url());
                //header('Location:'.$url);
                
            } else {
                $bdata = json_decode($_POST['bdata']);
                
                $act_data = $bdata[0]->account;
                $emp_data = $bdata[0]->billdetails->employees;
                $item_data = $bdata[0]->billdetails->items;
                $vatpct = $bdata[0]->billdetails->vat;
                
                $this->load->model('bgmodel');
                $response = $this->bgmodel->process_billnotice($act_data, $emp_data, $item_data, $vatpct, $userid); 
                
                $cdata = json_encode(array('aid' => $bdata[0]->account[0]->acctid));
                echo $cdata;
            }               
        }
        
        public function getbilledlist() {
            $param = $_GET['sparam'];
            $this->load->model('bgmodel');
            $rs = $this->bgmodel->get_billed_list($param);
            echo json_encode($rs);
        }
        
        public function generatebillingdocument() {
            //$billid = $_GET['bid'];
            $billref = $this->uri->segment(3,'');
            $this->load->model('bgmodel');
            $b_info = $this->bgmodel->get_billing_data($billref);
            
            
            $output     = '';
            $adj_item   = '';
            $ded_item   = '';
            $total_adj  = 0;
            $total_ded  = 0;
            $subtotal   = 0;
            $total_bill = 0;
            $appvat     = 0;
            $bid        = 0;
            $eid        = 0;
            
            if (isset($b_info)) {
                if($b_info->appliedvat > 0) {
                    $isvatable = 'inclusive of '.$b_info->appliedvat.'% VAT';
                } else {
                    $isvatable = 'exclusive of 12% VAT';
                }
                
                $bid = $b_info->billingid;
                $output .= ' <br /><br /><br />
                            <p>'.$b_info->datecreated.'</p>
                            <p>'.$b_info->salutation.' '. $b_info->firstname. ' '. $b_info->lastname. '<br />
                               '.$b_info->jobpost.'<br />
                               '.$b_info->accountname.'<br />
                               '.$b_info->address.' '.$b_info->address2.' '.$b_info->city.' '.$b_info->zipcode. '
                            </p>
                            <p>Dear '.$b_info->salutation.' '.$b_info->lastname.':</p>
                            <p align="justify">
                                <br/>
                                We hereby submit our billing in the amount of '.strtoupper($b_info->amtinwords).' 
                                <b>(Php '.$b_info->totalbill.')</b> '.$isvatable.'. The amount represents services
                                rendered by IPI personnel for the period from '.$b_info->billingperiod.'.
                            </p>';                
                
            }
            
            $e_info = $this->bgmodel->get_billed_employees($bid);
            foreach ($e_info as $row) {
                
                $appvat = floatval($row->appliedvat) / 100;
                
                $adj = $this->bgmodel->get_adjustments($bid, $row->erecordid);
                if(isset($adj) && count($adj) > 0){
                    $adj_item = '<tr><td colspan="3"><b>Add :</b></td></tr>';
                    foreach($adj as $drow){
                        $adj_item .= '  <tr>
                                            <td style="width: 200px;">'.$drow->itemdesc.'</td>
                                            <td style="width: 20px;">Php</td>
                                            <td style="text-align: right; width: 105px;">'.$drow->itemvalue.'</td>
                                        </tr>';
                        $total_adj = $total_adj + floatval($drow->itemval);
                    }                    
                }

                $ded = $this->bgmodel->get_deductions($bid, $row->erecordid);
                if(isset($ded) && count($ded) > 0){
                    $ded_item = '<tr><td colspan="3"><b>Less :</b></td></tr>';
                    foreach($ded as $drow){
                        $ded_item .= '  <tr>
                                            <td style="width: 200px;">'.$drow->itemdesc.'</td>
                                            <td style="width: 20px;">Php</td>
                                            <td style="text-align: right; width: 105px;">('.$drow->itemvalue.')</td>
                                        </tr>';
                        $total_ded = floatval($total_ded) + floatval($drow->itemval);
                    }                    
                }
                
                $subtotal = ((floatval($row->salaryval) + floatval($total_adj)) - floatval($total_ded));
                $total_bill = $total_bill + $subtotal;
                
                if($appvat > 0){
                    $vat_amt = (($row->salaryval + $total_adj) - $total_ded) * ($appvat); 
                    $vatdisplay = ' <tr>
                                        <td style="width: 200px;"><b>Subtotal</b></td>
                                        <td style="width: 20px;">Php</td>
                                        <td style="text-align: right; width: 105px;"><b>'.number_format($subtotal,2,'.',',').'</b></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 200px;"><b>Plus '.($appvat * 100).'% VAT</b></td>
                                        <td style="width: 20px;">Php</td>
                                        <td style="text-align: right; width: 105px;"><b>'.number_format($vat_amt,2,'.',',').'</b></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 200px;"></td>
                                        <td colspan="2" style="text-align:right;">-------------------------------------</td>
                                    </tr>';
                }   else {
                    $vatdisplay = '';   
                }
                
                $e_total ='     <tr><td colspan="3"></td></tr>
                                '.$vatdisplay.'
                                <tr style="border-top: 1px;">
                                    <td style="width: 200px;"><b>Total</b></td>
                                    <td style="width: 20px;">Php</td>
                                    <td style="text-align: right; width: 105px;"><b>'.number_format(floatval($subtotal + $vat_amt),2,'.',',').'</b></td>
                                </tr>'; 

                
                $output .= '<label><b>'.$row->empname.'</b></label>
                            <ul style = "list-style-type: none;">
                                <li>
                                    <table>
                                        <tr style="border-top: 1px;">
                                            <td style="width: 200px;"><b>Monthly Rate</b></td>
                                            <td style="width: 20px;">Php</td>
                                            <td style="text-align: right; width: 105px;">'.$row->salaryrate.'</td>
                                        </tr>
                                    </table>
                                </li>
                                <li>
                                    <table>'.$adj_item.'</table>
                                    <br>
                                    <table>'.$ded_item.'</table>
                                    <br>
                                    <table>'.$e_total.'</table>
                                </li>
                            </ul>
                          ';
                          
                $total_adj  = 0;
                $total_ded  = 0;
                $subtotal   = 0;
            }
            $output .= '<ul style = "list-style-type: none;">
                            <li>
                                <table>
                                    <tr style="font-size:6px;">
                                        <td style="width: 200px;"></td>
                                        <td style="width: 20px;"></td>
                                        <td style="text-align: right; width: 105px;"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" style="text-align: right;">-------------------------------------------------------------------------------------------------</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 200px;"><b>Total Amount Due</b></td>
                                        <td style="width: 20px;">Php</td>
                                        <td style="text-align: right; width: 105px;"><b>'.$b_info->totalbill.'</b></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" style="text-align: right;">-------------------------------------------------------------------------------------------------</td>
                                    </tr>
                                </table>
                            </li>
                        </ul>
                        <p>
                        <br/>
                        Should you have any questions regarding our billing, please feel free to call us anytime.
                        <br />
                        <br />
                        <br />
                        <br />
                        Very truly yours,
                        <br />
                        <br />
                        <br />
                        MAE PINKY B. BLASI
                        <br />
                        Accounting Manager
                        </p>
                        ';
            
            $this->load_billpreview($output, $e_info->billrefno + '.pdf');
            //echo count($adj);
            //echo count($ded);
            //echo $output;
            
            
        }
        
        public function load_billpreview($printcontent = '', $doctitle = ''){
            $data['content'] = $printcontent;
            $data['title'] = $doctitle;
            $this->load->helper('tcpdf_helper');
            $this->load->view('billpreview',$data);
        }
    }
?>