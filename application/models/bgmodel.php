<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class bgmodel extends CI_Model {
        
        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
        }
        
        /* billing_users */
        
        public function authenticate_user($loginid = '', $loginpw = '') {
            $sql = "select `userid`, `loginid`, trim(concat(`firstname` ,' ', `lastname`)) as fullname
                    from billing_users
                    where `loginid` = ? and `loginpw` = md5(?);";
            
            $result = $this->db->query($sql, array($loginid, $loginpw));
            
            if($result->num_rows() > 0) {
                $output = array('userdata' => $result->result(), 'response' => true); 
            } else {
                $output = array('userdata' => $result->result(), 'response' => false);
            }
            
            return $output;
        } 
        
        
        public function change_password($userid = 0, $loginpw = '') {
            $sql = "update billing_users set `loginpw` = md5(?) where userid = ?;";
            $this->db->query($sql, array($loginpw, $userid));
        }
        
        
        public function get_user_info($userid = 0) {
            $sql = "select `loginid`, `firstname`, `middlename`, `lastname`, `email`
                    from billing_users
                    where userid = ?";
            $result = $this->db->query($sql, array($userid));
            
            return $result->result();
        }
        
        
        public function register_user($loginid = '', $loginpw = '', $firstname = '', $middlename = '', $lastname = '', $email = '') {
            $sql = "insert into billing_users
                        (`loginid`, `loginpw`, `firstname`, `middlename`, `lastname`, `email`, `dateregistered`)
                    values (?,md5(?),?,?,?,?,now());";
            $this->db->query($sql, array($loginid,$loginpw,$firstname,$middlename,$lastname,$email));
            
            $sql = "select last_insert_id() as recid from billing_users;";
            $result = $this->db->query($sql);
            
            $row = $result->row();
            
            if(!$row->recid) {
                $output = array('retvalue' => 0, 'msg' => 'User registration failed.');    
            } else {
                $output = array('retvalue' => 1, 'msg' => 'Account successfuly saved.');
            }
            return $output;
        }
        
        
        public function update_user($userid = 0, $firstname = '', $middlename = '', $lastname = '', $email = '') {
            $sql = "update billing_users
                    set `firstname` = ?, `middlename` = ?, `lastname` = ?, `email` = ?
                    where userid = ?;";
            $this->db->query($sql, array($firstname, $middlename, $lastname, $email, $userid));
        }
        
        /* billing_accounts */
        
        public function tran_accounts($trantype = 0, $acctid = 0, $usedid = 0, $acctname = '', $addr1 = '',
                                      $addr2 = '', $city = '', $province = '', $zipcode = '') {

            switch ($trantype)
            {
                case 0 :
                    /* Check account if already exists */
                    $sql = "select count(*) as reccnt from billing_accounts where accountname = ?;";
                    $result = $this->db->query($sql, array($acctname));
                    $row = $result->row();
                    
                    if($row->reccnt > 0) {
                        $output = array('recstat' => false, 'refid' => 0);
                    } else {
                        $recid = 0;
                        $sql = "insert into `billing_accounts`
                                    (`accountname`, `address`, `address2`, `city`, `province`, `zipcode`, `recstatus`, `createdbyid`, `datecreated`)
                                values
                                    (?, ?, ?, ?, ?, ?, 1, ?, now());";
                        $this->db->query($sql, array($acctname, $addr1, $addr2, $city, $province, $zipcode, $usedid));
                        
                        $sql = "select last_insert_id() as recid from billing_accounts;";
                        $result = $this->db->query($sql);
                        
                        $row = $result->row();
                        if(isset($row)) {
                            $recid = $row->recid;
                            $output = array('recstat' => true, 'refid' => $recid);
                            $this->assign_account_code($recid);
                        } else {
                            $output = array('recstat' => false, 'refid' => 0);
                        }                        
                    }

                    return $output;
                    
                    break;
                
                case 1 :
                    $sql = "update `billing_accounts` 
                            set `accountname` = ?, `address` = ?, `address2` = ?, `city` = ?, `province` = ?, `zipcode` = ?,`modifiedbyid` = ?, `datemodified` = now()
                            where `acctid` = ?;";
                    $this->db->query($sql, array($acctname, $addr1, $addr2, $city, $province, $zipcode, $usedid, $acctid));
                    
                    break;
                
                case 2 :
                    $sql = "update `billing_accounts` set `recstatus` = 0 where `acctid` = ?;";
                    $this->db->query($sql, array($acctid));
                    
                    $sql = "select count(acctid) as reccnt from billing_accounts where acctid = ? and recstatus = 1;";
                    $result = $this->db->query($sql, array($acctid));
                    $row = $result->row();
                    
                    if(isset($row) && $row->reccnt === 0) {
                        $output = array('recstat' => true);
                    } else {
                        $output = array('recstat' => false);
                    }

                    return $output;
                    break;
                
                case 3 :
                    $sql = "select `acctid`, `acctrefno`, `accountname`, `address`, `address2`, `city`, `province`, `zipcode`
                            from `billing_accounts` 
                            where `acctid` = ?;";
                    $result = $this->db->query($sql, array($acctid));
                    return $result->result();
                    break;
                
                case 4 : 
                    $sql = "select `acctid`, `acctrefno`, `accountname` from `billing_accounts` where `recstatus`= 1 order by `accountname` ASC;";
                    $result = $this->db->query($sql);
                    return $result->result();
                    break;
                
                default :
                    $output = array('recstat' => false);
                    return $output;
                    break;
            }
        }
        
        
        public function search_clients($searched_item = '') {
            $sql = "select `acctid`, `acctrefno`, `accountname` from `billing_accounts` where `recstatus`= 1 and `accountname` like '%$searched_item%' order by accountname asc;";
            $result = $this->db->query($sql);
            return $result->result();
        }
        
        
        public function assign_account_code($record_id = 0) {
            $sql = "update `billing_accounts` set acctrefno = concat('ARN-', date_format(now(), '%Y'), date_format(now(), '%m'), date_format(now(),'%d'), '-', lpad(?, 7, '0'))
                            where `acctid` = ?;";
            $this->db->query($sql, array($record_id, $record_id));
        }
        
        
        public function get_accounts() {
            $sql = "select 0 as acctid, '- Select an Account to Bill -' as accountname, '' as addr
                    union all
                    select `acctid`, `accountname`,
                            concat(`address`,
                                   case length(`address2`) when 0 then '' else concat(' ',`address2`) end,
                                   case length(`city`) when 0 then '' else concat(' ', `city`) end,
                                   case length(`province`) when 0 then '' else concat(' ', `province`, ' ', `zipcode`) end) as addr
                    from `billing_accounts` 
                    where `recstatus` = 1 order by accountname asc;";
            $result = $this->db->query($sql);
            
            return $result->result();
        }
        
        
        public function get_account_contacts($accountid) {
            $sql = "select 0 as contactid, '- Select a Contact -' as contactname
                    union all
                    select contactid, upper(concat(lastname, ', ', firstname)) as contactname
                    from billing_account_contacts
                    where acctid = $accountid
                    order by contactname asc;";
            $result = $this->db->query($sql);
            return $result->result();
        }
        
        /* billing_account_contacts */
        
        public function register_contact($trantype = 0, $accountid = 0, $contactid = 0, $honorifics = 0, $firstname = '', $middlename = '', $lastname = '', $jobpost = '', $userid = 0) {
            $output = array();
            switch($trantype)
            {
                case 0 :
                    $sql = "select count(acctid) reccnt from billing_account_contacts where firstname = ? and lastname = ? and acctid = ?;";
                    $result = $this->db->query($sql, array($firstname, $lastname, $accountid));
                    
                    $row = $result->row();
                    
                    if($row->reccnt > 0) {
                        $output = array('recstat' => false, 'refid' => 0);
                    } else {
                        $sql = "insert into billing_account_contacts
                                    (`acctid`, `honorifics`, `firstname`, `middlename`, `lastname`, `jobpost`, `createdbyid`, `datecreated`)
                                values
                                    (?, ?, ?, ?, ?, ?, ?, now());";
                        $this->db->query($sql, array($accountid, $honorifics, $firstname, $middlename, $lastname, $jobpost, $userid));
                        
                        $sql = "select last_insert_id() as recid from billing_account_contacts;";
                        $result = $this->db->query($sql);
                        $rw = $result->row();
                        
                        $output = array('recstat' => true, 'refid' => $rw->recid, 'err' => $this->db->error());
                    }
                    return $output;
                    break;
                
                case 1 :
                    $sql = "update billing_account_contacts
                            set firstname = ?, middlename = ?, lastname = ?, jobpost = ?, modifiedbyid = ?, datemodified = now()
                            where contactid = ? and acctid = ?;";
                    $this->db->query($sql, array($firstname, $middlename, $lastname, $jobpost, $userid, $contactid, $accountid));
                    $output = array('err' => $this->db->error());
                    return $output;
                    break;
                
                case 2 :
                    $sql = "delete from billing_account_contacts where contactid = ?;";
                    $this->db->query($sql, $contactid);
                    
                    $sql = "select count(contactid) reccnt from billing_account_contacts where contactid = ?;";
                    $output = array('err' => $this->db->error());
                    break;
                
                case 3 :
                    $sql = "select honorifics, contactid, acctid, firstname, middlename, lastname, jobpost
                            from billing_account_contacts
                            where contactid = ?;";
                    $result = $this->db->query($sql, array($contactid));
                    
                    return $result->result();        
                    break;
                
                case 4 :
                    $sql = "select contactid,
                                   acctid,
                                   upper(concat(lastname, ', ', firstname, case length(middlename) when 0 then '' else concat(' ',substr(middlename,1,1), '. ') end)) as contactname,
                                   jobpost
                            from billing_account_contacts
                            where acctid = ?
                            order by lastname asc;";
                    $result = $this->db->query($sql, array($accountid));
                    
                    return $result->result();    
                    break;
                
                default :
                    
                    break;
            }
        }
        
        
        public function search_contacts($accountid = 0, $searched_item = '') {
            $sql = "select contactid, acctid, firstname, middlename, lastname, jobpost
                    from billing_account_contacts
                    where acctid = $accountid
                       and (firstname like '%' + $searched_item + '%'
                       or middlename like '%' + $searched_item + '%'
                       or lastname like '%' + $searched_item + '%')
                    order by lastname asc;";
            $result = $this->db->query($sql);
            
            return $result->result();    
        }
        
        
        public function get_contact_company($arn = '') {
            $sql = "select `acctid`, `acctrefno`, `accountname`, `address`, `address2`, `city`, `province`, `zipcode`
                    from `billing_accounts` 
                    where `acctrefno` = ?;";
                    
            $result = $this->db->query($sql, array($arn));
            return $result;
        }
        
        /* billing_info */
        
        public function get_billing_info($billingid = 0) {
            $sql = "select billingid, acctid from billing_info where billingid = $billingid;";
            $result = $this->db->query($sql);
            return $result->result();
        }
        
        
        public function create_billing_info($accountname = '', $userid = 0) {
            $sql = "insert into billing_info (acctid, createdbyid, datecreated)
                    values (?, ?, now());";
            $this->db->query($sql, array($accountname, $userid));
            
            $sql = "update billing_info set billrefno = concat('BRN', date_format(now(), '%Y'), date_format(now(), '%m'), '-', lpad(last_insert_id(), 12, '0'))
                    where billingid = last_insert_id();";
                    
            $this->db->query($sql);
            
            $sql = "select last_insert_id() as recid from billing_info";
            $result = $this->db->query($sql);
            return $result->result();
        }
        
        
        public function delete_billing_info($billingid = 0) {
            $sql = "update billing_info set billstatus = 0 where billingid = $billingid;";
            $this->db->query($sql);
        }
        
        /* billing_info_employees */
        
        public function create_employees($billingid = 0, $firstname = '', $middlename = '', $lastname = '', $jobpost = '', $salaryrate = 0, $ratetype = 0, $userid = 0) {
            $sql = "insert into billing_info_employees
                        (billingid, firstname, middlename, lastname, jobpost, salaryrate, ratetype, createdbyid, datecreated)
                    values
                        (?, ?, ?, ?, ?, ?, ?, ?, now());";
            $this->db->query($sql, array($billingid, $firstname, $middlename, $lastname, $jobpost, $salaryrate, $ratetype, $userid));
            
            $sql = "select last_insert_id() as recid from billing_info_employees;";
            
            return $result->result();
        }
        
        
        public function delete_employees($erecordid = 0) {
            $sql = "delete from billing_info_employees where erecordid = $erecordid;";
            $this->db->query($sql);
        }
        
        
        public function update_employees($erecordid = 0, $firstname = '', $middlename = '', $lastname = '', $jobpost = '', $salaryrate = 0, $ratetype = 0) {
            $sql = "update billing_info_employees
                    set firstname, middlename, lastname, jobpost, salaryrate, ratetype
                    where erecordid = $erecordid;";
            $this->db->query($sql);
        }
        
        
        public function get_employee_info($erecordid = 0) {
            $sql = "select erecordid, billingid, firstname, middlename, lastname, jobpost, salaryrate, ratetype
                    from billing_info_employees
                    where erecordid = $erecordid;";
            $this->db->query($sql);
        }
        
        /* billing_details */
        
        public function add_billing_item($billingid = 0, $erecordid = 0, $itemdesc = '', $itemops = 0, $itemvalue = 0, $userid = 0) {
            $sql = "insert into billing_details
                        (billingid, erecordid, itemdesc, itemops, itemvalue, createdbyid, datecreated)
                    values
                        (?, ?, ?, ?, ?, ?, now());";
            $this->db->query($sql, array($billingid, $erecordid, $itemdesc, $itemops, $itemvalue, $userid));
        }
        
        
        public function update_billing_item($detailid = 0, $itemdesc = '', $itemops = 0, $itemvalue = 0) {
            $sql = "update billing_details
                    set itemdesc = ?, itemops = ?, itemvalue = ?
                    where detailid = $detailid;";
            $this->db->query($sql);
        }
        
        
        public function delete_billing_item($detailid = 0) {
            $sql = "delete from billing_details where detailid = $detailid;";
            $this->db->query($sql);
        }
    
        
        public function process_billnotice($account, $employee, $billitems, $vatpct, $userid) {
            $billid = 0;
            $empid  = 0;
            
            $sql = "insert into `billing_info` 
                        (`acctid`, `contactid`, `billstatus`, `billdatefrom`, `billdateto`, `createdbyid`, `datecreated`)
                    values
                        (?, ?, ?, ?, ?, ?, now());";
            $a = $account[0];
            
            $this->db->query($sql, array($a->acctid, $a->contactid, 1, $a->billstart, $a->billend, $userid));
            
            $sql = "select max(billingid) as billid from `billing_info`;";
            $rs = $this->db->query($sql);
            foreach($rs->result() as $row) {
                $billid = $row->billid;
                $sql = "update billing_info
                        set billrefno = concat('BRN', date_format(now(), '%Y'), date_format(now(), '%m'), '-', lpad($billid, 10, '0'))
                        where billingid = $billid;";
                           
                $this->db->query($sql);  
            }           

            for($i = 0; $i < count($employee); $i++) {
                $sql = "insert into billing_info_employees
                            (`billingid`, `firstname`, `middlename`, `lastname`, `jobpost`, `salaryrate`, `ratetype`, `appliedvat`, `createdbyid`, `datecreated`)
                        values
                            (?, ?, ?, ?, ?, ?, ?, ?, ?, now());";
                            
                for($k = 0; $k < count($vatpct); $k++){
                    if($vatpct[$k]->empid == $employee[$i]->id){
                        $vat = $vatpct[$k]->vatpct;
                    }
                }
                
                $this->db->query($sql, array($billid,
                                             $employee[$i]->firstname,
                                             $employee[$i]->middlename,
                                             $employee[$i]->lastname,
                                             $employee[$i]->emppost,
                                             $employee[$i]->salaryrate,
                                             $employee[$i]->salarytype,
                                             floatval($vat),
                                             $userid));
                
                $sql = "select max(erecordid) as empid from billing_info_employees;";
                $rs = $this->db->query($sql);
                foreach($rs->result() as $row){
                    $empid = $row->empid;
                }
                
                for($j = 0; $j < count($billitems); $j++){
                    if($billitems[$j]->empid == $employee[$i]->id){
                        $sql = "insert into `billing_details`
                                    (`billingid`, `erecordid`, `itemdesc`, `itemops`, `itemvalue`, `createdbyid`, `datecreated`)
                                values
                                    (?, ?, ?, ?, ?, ?, now());";
                        $this->db->query($sql, array($billid,
                                                     $empid,
                                                     $billitems[$j]->itemdesc,
                                                     intval($billitems[$j]->itemops),
                                                     $billitems[$j]->itemval,
                                                     $userid));
                    }                    
                }
            }
        }
    
        public function get_billed_list($searchparam = ''){
            $sql = "select  main.billingid,
                            main.billrefno,
                            main.accountname,
                            main.billingperiod,
                            main.datecreated,
                            sum(main.billamount) as totalbill,
                            rtrim(main.billcreator) as billcreator
                    from (	select 	a.`billingid`, a.`billrefno`, c.`accountname`, 
                                    a.`billdatefrom`, a.`billdateto`,
                                    case when date_format(a.billdatefrom, '%Y') = date_format(a.billdateto, '%Y') 
										then concat(date_format(a.billdatefrom, '%d %M'), ' to ', date_format(a.billdateto, '%d %M %Y'))
										else concat(date_format(a.`billdatefrom`,'%d %M %Y'), ' to ', date_format(a.`billdateto`,'%d %M %Y'))
									end as billingperiod,
                                    date_format(a.`datecreated`,'%d-%b-%Y') as datecreated,
                                    concat(ifnull(f.`firstname`,''), ' ', ifnull(f.`lastname`,'')) as billcreator,
                                    b.`erecordid`, b.`salaryrate`,
                                    sum(distinct d.`itemvalue`) as adjustments,
                                    sum(distinct e.`itemvalue`) as deductions,
                                    b.`appliedvat`,
                                    ((b.`salaryrate` - ifnull(sum(distinct e.itemvalue),0)) + ifnull(sum(distinct d.itemvalue),0)) * (1 + (b.`appliedvat` / 100)) as billamount,
                                    ifnull(sum(distinct d.itemvalue),0) as isadjnull,
                                    ifnull(sum(distinct e.itemvalue),0) as isdednull
                            from 			billing_info as a
                                inner join 	billing_info_employees as b on a.`billingid` = b.`billingid`
                                inner join 	billing_accounts as c on a.`acctid` = c.`acctid`
                                left join	billing_details as d on a.`billingid` = d.`billingid` and b.`erecordid` = d.`erecordid` and d.`itemops` = 1
                                left join	billing_details as e on a.`billingid` = e.`billingid` and b.`erecordid` = e.`erecordid` and e.`itemops` = 2
                                inner join 	billing_users as f on a.`createdbyid` = f.`userid`
                            group by a.`billingid`, b.`erecordid`
                         ) as main
                    where (main.billrefno like '%$searchparam%' or main.accountname like '%$searchparam%')
                    group by main.billingid;";
                    
            $rs = $this->db->query($sql);
            return $rs->result();
        }
        
        public function get_billing_data($billrefid = ''){
            $sql = "select billingid from billing_info where billrefno = ?;";
            $rs  = $this->db->query($sql, array($billrefid));
            $bill_id = 0;
            
            foreach($rs->result() as $row){
                $bill_id = $row->billingid;
            }
            
            $sql = "select  main.billingid, main.billrefno,
                            main.accountname, main.address, main.address2, main.city, main.zipcode,
                            main.salutation, main.firstname, main.middlename, main.lastname, main.jobpost,
                            main.billingperiod,
                            main.datecreated,
                            format(sum(main.billamount),2) as totalbill,
                            fn_NumberToWords(sum(main.billamount)) as amtinwords,
                            rtrim(main.billcreator) as billcreator,
                            format(main.appliedvat,0) as appliedvat
                    from (	select 	a.`billingid`, a.`billrefno`, 
                                    c.`accountname`, c.`address`, c.`address2`, c.`city`, c.`zipcode`,
                                    h.`salutation`, g.`firstname`, g.`middlename`, g.`lastname`, g.`jobpost`,
                                    a.`billdatefrom`, a.`billdateto`,
                                    case when date_format(a.billdatefrom, '%Y') = date_format(a.billdateto, '%Y') 
										then concat(date_format(a.billdatefrom, '%d %M'), ' to ', date_format(a.billdateto, '%d %M %Y'))
										else concat(date_format(a.`billdatefrom`,'%d %M %Y'), ' to ', date_format(a.`billdateto`,'%d %M %Y'))
									end as billingperiod,
                                    date_format(a.`datecreated`,'%d %M %Y') as datecreated,
                                    concat(ifnull(f.`firstname`,''), ' ', ifnull(f.`lastname`,'')) as billcreator,
                                    b.`erecordid`, b.`salaryrate`,
                                    sum(distinct d.`itemvalue`) as adjustments,
                                    sum(distinct e.`itemvalue`) as deductions,
                                    b.`appliedvat`,
                                    ((b.`salaryrate` - ifnull(sum(distinct e.itemvalue),0)) + ifnull(sum(distinct d.itemvalue),0)) * (1 + (b.`appliedvat` / 100)) as billamount,
                                    ifnull(sum(distinct d.itemvalue),0) as isadjnull,
                                    ifnull(sum(distinct e.itemvalue),0) as isdednull
                            from 			billing_info as a
                                inner join 	billing_info_employees as b on a.`billingid` = b.`billingid`
                                inner join 	billing_accounts as c on a.`acctid` = c.`acctid`
                                left  join	billing_details as d on a.`billingid` = d.`billingid` and b.`erecordid` = d.`erecordid` and d.`itemops` = 1
                                left  join	billing_details as e on a.`billingid` = e.`billingid` and b.`erecordid` = e.`erecordid` and e.`itemops` = 2
                                inner join 	billing_users as f on a.`createdbyid` = f.`userid`
                                inner join	billing_account_contacts as g on a.`contactid` = g.`contactid`
                                inner join 	salutations as h on g.honorifics = h.sid
                            group by a.`billingid`, b.`erecordid`
                         ) as main
                    where main.billingid = ?
                    group by main.billingid;";
                
                $rs = $this->db->query($sql, array($bill_id));
                
                return $rs->row();
        }
        
        public function get_billed_employees($billingid = 0){
            $sql = "select `erecordid`, 
                            concat(`lastname`, ', ',`firstname`, ' ', case length(`middlename`) when 0 then '' else concat(substr(`middlename`,1,1),'.') end) as empname,
                            format(`salaryrate`, 2) as salaryrate,
                            `salaryrate` as salaryval,
                            case `ratetype` 
                               when 1 then 'Daily'
                               when 2 then 'Weekly'
                               when 3 then 'Monthly'
                               when 4 then 'Yearly'
                               else ''
                            end as ratetype,	
                            `appliedvat`
                    from billing_info_employees
                    where billingid = ?;";
                    
            $rs = $this->db->query($sql, array($billingid));
            return $rs->result();
        }
        
        public function get_adjustments($bid = 0, $empid = 0){
            $sql = "select `detailid`, `billingid`, `erecordid`, `itemdesc`, `itemops`, format(`itemvalue`,2) as itemvalue, `itemvalue` as itemval
                    from billing_details
                    where `billingid` = ?
                      and `erecordid` = ?
                      and `itemops` = 1;";
            $rs = $this->db->query($sql, array($bid, $empid));
            return $rs->result();
        }
        
        public function get_deductions($bid = 0, $empid = 0){
            $sql = "select `detailid`, `billingid`, `erecordid`, `itemdesc`, `itemops`, format(`itemvalue`,2) as itemvalue, `itemvalue` as itemval
                    from billing_details
                    where `billingid` = ?
                      and `erecordid` = ?
                      and `itemops` = 2;";
            $rs = $this->db->query($sql, array($bid, $empid));
            return $rs->result();
        }
    
        public function process_salutations($proctype = 0, $sid = 0, $salutation = '', $userid = 0) {
            $output = array();
            switch($proctype){
                case 0: // Add
                    $sql = "select count(*) as recexists from salutations where salutation = ?;";
                    $rs = $this->db->query($sql, array($salutation));
                    
                    foreach($rs->result() as $row){
                        if($row->recexists > 0){
                            $output = array('result' => false, 'data' => 'Salutation [ '.$salutation.' ] already exists.');
                        } else {
                            $sql = "insert into salutations (salutation, createdbyid, datecreated, datemodified)
                                    values (?, ?, now(), Now());";
                            $this->db->query($sql, array($salutation, $userid));
                            
                            $output = array('result' => true, 'data' => 'Salutation [ '.$salutation.' ] already exists.');
                        }
                    }
                    
                    break;
                
                case 1: // Edit
                    $sql = "update salutations set salutation = ?, datemodified = now() where sid = ?;";
                    $this->db->query($sql, array($salutation, $sid));
                    $output = array('result' => true, 'data' => 'Salutation has been updated successfully.');
                    break;
                
                case 2: // Delete
                    $sql = "delete from salutations where sid = ?;";
                    $this->db->query($sql, array($sid));
                    $output = array('result' => true, 'data' => 'Salutation ['.$salutation.'] has been removed successfully.');
                    break;
                
                case 3: // Get Info
                    $sql = "select sid, salutation from salutations where sid = ?;";
                    $rs = $this->db->query($sql, array($sid));
                    $output = array('result' => true, 'data' => $rs->result());
                    break;
                
                default: // Get List
                    $sql = "select sid, salutation from salutations;";
                    $rs = $this->db->query($sql);
                    $output = array('result' => true, 'data' => $rs->result());
                    break;
            }
        }
    }
?>