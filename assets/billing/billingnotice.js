// Variable containers
var data        = [],
    clientinfo  = [],
    employee    = [],
    billitems   = [],
    vatused     = [],
    clientaddr  = [],
    itemstobill = [],
    empTran     = 0;

//Elements Containers
var dvDetails       = $('#dDetails :input'),
    dvBillItems     = $('#dBillItems :input'),
    dvAccount       = $('#dAccount :input'),
    elAlert         = $('#alertnotice'),
    elAlert2        = $('#alertnotice2'),
    elAlert3        = $('#alertnotice3'),
    tblContent      = $('#itemcontent'),
    tdSubtotal      = $('#tbsubtotal'),
    tdAppVat        = $('#tbappvat'),
    tdTotal         = $('#tbtotal'),
    tblSummary      = $('#summarycontent'),
    tdSummaryAmt    = $('#summaryamt');

// Input Elements
var elAccount       = $('#accountid'),
    elContact       = $('#contactid'),
    elClientAddr    = $('#clientaddr'),
    elBtnNext       = $('#btnnext'),
    elBtnNext2      = $('#btnnext2'),
    elBtnItem       = $('#itemsave'),
    elfname         = $('#firstname'),
    elmname         = $('#middlename'),
    ellname         = $('#lastname'),
    eljobpost       = $('#jobpost'),
    elsalaryrate    = $('#salaryrate'),
    elsalarytype    = $('#salarytype'),
    elitemdesc      = $('#itemdesc'),
    elitemops       = $('#opsid'),
    elitemvalue     = $('#itemvalue'),
    elappvatpct     = $('#vatpct'),
    elbillfrom      = $('#dtfrom'),
    elbillto        = $('#dtto'),
    eltxtfrom       = $('#txtfrom'),
    eltxtto         = $('#txtto');
    
var get_accounts = function(){
    $.ajax({
            url     : siteurl + 'billgenerator/getaccounts',
            type    : 'POST',
            success : function(data) {
                var objdata = JSON.parse(data);
                elAccount.empty();
                for(i=0; i < objdata.length; i++){
                    elAccount.append('<option value="' + objdata[i]['acctid'] + '">' + objdata[i]['accountname'] + '</option>')
                    clientaddr.push({'aid': objdata[i]['acctid'], 'addr': objdata[i]['addr']});
                }
            },
            fail    : function(jqXHR, textStatus) {
                console.log(jqXHR + textStatus);
            },
            done    : function(data) {
                console.log('Accounts loaded...');
            }
    });
}

var get_contacts = function(clientid) {
    var find_address = function() {
        for(i=0; i<clientaddr.length; i++){
            if (clientaddr[i]['aid'] == clientid) {
                elClientAddr
                    .empty()
                    .append('<em>' + clientaddr[i]['addr'] + '</em>');
                break;
            }
        }
        load_contacts();
    },
    load_contacts = function() {
        $.ajax({
                url     : siteurl + 'billgenerator/getacctcontacts',
                type    : 'POST',
                data    : {'accountid' : clientid},
                success : function(data) {
                    var objdata = JSON.parse(data);
                    elContact.empty();
                    for(i=0; i < objdata.length; i++){
                        elContact
                            .append('<option value="' + objdata[i]['contactid'] + '">' + objdata[i]['contactname'] + '</option>')
                    }
                },
                fail    : function(jqXHR, textStatus) {
                    console.log(jqXHR + textStatus);
                },
                done    : function(data) {
                    console.log('Contacts loaded...');
                }
        });          
    };
    
    find_address();
}

var regnotice = function(){
    dataentry = {'id':1, 'name':'Romel Dela Cruz', 'age':34}
    data.push(dataentry);
    
    console.log('Total data in array : ' + data.length);
    console.log(data);
}

var load_billeditems = function(empid) {
    var itemops = '',
        itemval,
        adjustments = 0,
        deductions = 0;
        
    tblContent.empty();   

    var empitems = [];
    for(i=0; i < billitems.length; i++){
        if(billitems[i]['empid'] == empid) {
            empitems.push(billitems[i]);
        }     
    };
        
    if (empitems.length > 0) {
        for(i=0; i<empitems.length; i++){
            itemval = parseFloat(billitems[i]['itemval']).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g,'$1,');
            if (empitems[i]['itemops'] == '1') {
                tblContent.append(  '<tr>' +
                                        '<td><i class="fa fa-plus fa-lg"></i></td>' +
                                        '<td>' + empitems[i]['itemdesc'] + '</td>' +
                                        '<td style="text-align: right;">' + accounting.formatMoney(empitems[i]['itemval']) + '</td>' +
                                        '<td>&nbsp;</td>' +
                                        '<td style="width: 20px; text-align: center;">&nbsp;</td>' +
                                        '<td style="width: 20px; text-align: center;"><button onclick="javascript:remove_billitem('+ empitems[i]['empid'] +','+ empitems[i]['itemcode'] +')"><i class="fa fa-trash fa-lg"></button></td>' +
                                    '</tr>');
                adjustments = parseFloat(adjustments) + parseFloat(empitems[i]['itemval']);
            } else {
                tblContent.append(  '<tr>' +
                                        '<td><i class="fa fa-minus fa-lg"></i></td>' +
                                        '<td>' + empitems[i]['itemdesc'] + '</td>' +
                                        '<td style="text-align: right;">' + accounting.formatMoney(empitems[i]['itemval']) + '</td>' +
                                        '<td>&nbsp;</td>' +
                                        '<td style="width: 20px; text-align: center;">&nbsp;</td>' +
                                        '<td style="width: 20px; text-align: center;"><button onclick="javascript:remove_billitem('+ empitems[i]['empid'] +','+ empitems[i]['itemcode'] +')"><i class="fa fa-trash fa-lg"></button></td>' +
                                    '</tr>');
                deductions = parseFloat(deductions) + parseFloat(empitems[i]['itemval']);
            }
        }
        
        var monthlysalary = parseFloat(accounting.formatNumber(elsalaryrate.val()).replace(/,/g,'')),
            appliedvat    = parseFloat(elappvatpct.val()) / 100,
            vatpct        = 1 + (appliedvat);
        
        tdSubtotal
            .empty()
            .append(accounting.formatMoney((monthlysalary + adjustments) - deductions));
        
        tdAppVat
            .empty()
            .append(accounting.formatMoney(((monthlysalary + adjustments) - deductions) * appliedvat));
            
        tdTotal
            .empty()
            .append(accounting.formatMoney(((monthlysalary + adjustments) - deductions) * vatpct));
    } else {
        tblContent
            .empty()
            .append('<tr>' +
                        '<td style="text-align: center;" colspan="6"><em><b>No records.</b></td>' +
                    '</tr>');
        tdSubtotal
            .empty()
            .append(accounting.formatMoney('0.00'));
        
        tdAppVat
            .empty()
            .append(accounting.formatMoney('0.00'));

        tdTotal
            .empty()
            .append(accounting.formatMoney('0.00'));
    }
}

var reset_fields = function() {
    clear_account();
    clear_employee();
    clear_billitems();
}

var clear_account = function() {
    elAccount.val(0);
    elContact.val(0);
    elClientAddr.empty();
    eltxtfrom.val('')
    eltxtto.val('');
    //clientinfo = []; 
}

var clear_employee = function() {
    elfname.val('').focus();
    elmname.val('');
    ellname.val('');
    eljobpost.val('');
    elsalaryrate.val('');
    elsalarytype.val(3);
    //employee = [];
}

var disable_acct_fields = function(isenabled) {
    elAccount.attr('disabled', isenabled);
    elContact.attr('disabled', isenabled);
    eltxtfrom.attr('disabled', isenabled);
    eltxtto.attr('disabled', isenabled);
    elBtnNext.attr('disabled', isenabled);
}

var clear_billitems = function() {
    elitemdesc.val('').focus();
    elitemops.val(1);
    elitemvalue.val('');
    elappvatpct.val(12);
    load_billeditems(0);
}

var load_billiteminfo = function(empid, itemid) {
    var items;
    if (billitems.length > 0) {
        items = $.grep(billitems, function(obj, i){
            return obj.empid == empid && obj.itemcode == itemid;  
        });        
        elitemdesc.val(items[0].itemdesc);
        elitemops.val(parseInt(items[0].itemops));
        elitemvalue.val(items[0].itemval);
    }
}

var remove_billitem = function(empid, itemid){
    if (billitems.length > 0) {
        billitems = jQuery.grep(billitems, function(bi){
           return(bi.empid !== empid && bi.itemcode !== itemid); 
        });
        load_billeditems(empid);
    }
}

var load_summary = function() {
    var empname = '', emppost = '', salaryrate = 0, salarynet = 0, totalbill = 0, vat = 0,
        adjustments = 0, deductions = 0, arritem;
    tblSummary.empty();
    
    if (employee.length > 0) {
        for(i = 0; i < employee.length; i++){
            empname = employee[i].empname;
            emppost = employee[i].emppost;
            salaryrate = employee[i].salaryrate;
            
            for (j = 0; j < vatused.length; j++) {
                if (employee[i].id == vatused[j].empid) {
                    vat = 1 + (parseFloat(vatused[j].vatpct) / 100);
                }
            }
            
            for(k = 0; k < billitems.length; k++){
                if (employee[i].id == billitems[k].empid) {
                    if (billitems[k].itemops == 1) {
                        salaryrate = salaryrate + billitems[k].itemval;
                        //adjustments = adjustments + billitems[k].itemval;
                    } else {
                        salaryrate = salaryrate - billitems[k].itemval;
                        //deductions = deductions + billitems[k].itemval;
                    }
                }
            }
            
            salarynet = salaryrate * vat;
            
            totalbill = totalbill + salarynet;

            tblSummary
            .append(
                    '<tr>' +
                        '<td>' + empname + '</td>' +
                        '<td>' + emppost + '</td>' +
                        '<td style="text-align: right;">' + accounting.formatMoney(salarynet) + '</td>' +
                        '<td style="text-align: center;"><button onclick="javascript:removefromsummary(' + employee[i].id + ');"><i class="fa fa-trash fa-lg"></i></button></td>' +
                    '</tr>'   
                    );
        
            tdSummaryAmt.text(accounting.formatMoney(totalbill));
            salarynet = 0;
        };        
    } else {
        tblSummary.append('<tr><td colspan="4" style="text-align: center;"><b><em>No items</em></b></td></tr>');
        tdSummaryAmt.text(accounting.formatMoney(0));
    }
}

var removefromsummary = function(empid) {
    if (employee.length > 0) {
        
        employee = jQuery.grep(employee, function(emp){
           return(emp.id !== empid); 
        });
        
        billitems = jQuery.grep(billitems, function(bi){
           return(bi.empid !== empid); 
        });
        
        vatused = jQuery.grep(vatused, function(vt){
           return(vt.empid !== empid); 
        });
        
        load_summary();
    }
}

$(document).on('change','#accountid', function() {
   get_contacts($('#accountid').val()); 
});

$(document).on('click','#saveclient', function() {
    console.log('Been here');
    regnotice();
});

$(document).on('click','#btnnext', function() {
    if (elAccount.val() == 0) {
        elAlert.addClass('alert alert-danger')
            .empty()
            .append('<i class="fa fa-exclamation-circle fa-lg"></i> <b>You must select a CLIENT to proceed.</b>');
        
        elAccount.addClass('alert-danger');
        
        return false;
    
    } else {
        elAlert.removeClass('alert alert-danger').empty();
        elAccount.removeClass('alert-danger');
    }
    
    if (elContact.val() == 0) {
        elAlert
            .addClass('alert alert-danger')
            .empty()
            .append('<i class="fa fa-exclamation-circle fa-lg"></i> <b>You must select a CONTACT to bill to proceed.</b>');
        
        elContact.addClass('alert-danger');
        
        return false;        
    } else {
        elAlert.removeClass('alert alert-danger').empty();
        elContact.removeClass('alert-danger');
    }
    
    if (eltxtfrom.val() == '' || eltxtto.val() == '') {
        elAlert
            .addClass('alert alert-danger')
            .empty()
            .append('<i class="fa fa-exclamation-circle fa-lg"></i> <b>Invalid date range supplied.</b>');
        
        eltxtfrom.addClass('alert-danger');
        eltxtto.addClass('alert-danger');
        
        return false;
    } else {
        elAlert.removeClass('alert alert-danger').empty();
        eltxtfrom.removeClass('alert-danger');
        eltxtto.removeClass('alert-danger');
    }
    
    
    if (Date.parse(eltxtto.val()) < Date.parse(eltxtfrom.val())) {
        elAlert
            .addClass('alert alert-danger')
            .empty()
            .append('<i class="fa fa-exclamation-circle fa-lg"></i> <b>Invalid date range supplied.</b>');
        
        eltxtfrom.addClass('alert-danger');
        eltxtto.addClass('alert-danger');
        
        return false;
    } else {
        elAlert.removeClass('alert alert-danger').empty();
        eltxtfrom.removeClass('alert-danger');
        eltxtto.removeClass('alert-danger');
    }
    
    //elAlert.removeClass('alert alert-danger')
    //       .addClass('alert alert-success')
    //       .empty()
    //       .append('<i class="fa fa-info-circle fa-lg"></i> You are a genius.');
    
    //Save values to variable
    clientinfo.push({'acctid' : elAccount.val(), 'cname' : elClientAddr.text(), 'contactid' : elContact.val(), 'contactname' : $('#contactid option:selected').text(), 'billstart' : eltxtfrom.val(), 'billend' : eltxtto.val()});
    disable_acct_fields(true);
    dvDetails.attr('disabled', false);
    ellname.focus();

});

$(document).on('click', '#btnnext2', function() {
    if (ellname.val() == '') {
        elAlert2
            .addClass('alert alert-danger')
            .empty()
            .append('<i class="fa fa-exclamation-circle fa-lg"></i> <b>LAST NAME cannot be empty.</b>');
        
        ellname.addClass('alert-danger');
        
        return false;        
    } else {
        elAlert2.removeClass('alert alert-danger').empty();
        ellname.removeClass('alert-danger');
    }
    
    if (elfname.val() == '') {
        elAlert2
            .addClass('alert alert-danger')
            .empty()
            .append('<i class="fa fa-exclamation-circle fa-lg"></i> <b>FIRST NAME cannot be empty.</b>');
        
        elfname.addClass('alert-danger');
        
        return false;        
    } else {
        elAlert2.removeClass('alert alert-danger').empty();
        elfname.removeClass('alert-danger');
    }
    
    if (eljobpost.val() == '') {
        elAlert2
            .addClass('alert alert-danger')
            .empty()
            .append('<i class="fa fa-exclamation-circle fa-lg"></i> <b>JOB POSITION cannot be empty.</b>');
        
        eljobpost.addClass('alert-danger');
        
        return false;        
    } else {
        elAlert2.removeClass('alert alert-danger').empty();
        eljobpost.removeClass('alert-danger');
    }

    if (elsalaryrate.val() == '') {
        elAlert2
            .addClass('alert alert-danger')
            .empty()
            .append('<i class="fa fa-exclamation-circle fa-lg"></i> <b>SALARY cannot be empty.</b>');
        
        elsalaryrate.addClass('alert-danger');
        return false;        
    } else {
        elAlert2.removeClass('alert alert-danger').empty();
        elsalaryrate.removeClass('alert-danger');
    }
        
    if (elsalarytype.val() == 0) {
        elAlert2
            .addClass('alert alert-danger')
            .empty()
            .append('<i class="fa fa-exclamation-circle fa-lg"></i> <b>Invalid SALARY TYPE selected.</b>');
        
        elsalarytype.addClass('alert-danger');
        
        return false;  
    } else {
        elAlert2.removeClass('alert alert-danger').empty();
        elsalarytype.removeClass('alert-danger');        
    }
    
    var midinitial = '';
    if (elmname.val().length > 0) {
        midinitial = elmname.val().substring(0,1).toUpperCase() + '.';
    }
    
    empTran = new Date().getTime();
    employee.push({'id'         : empTran,
                   'empname'    : ellname.val() + ', ' + elfname.val() + ' ' + midinitial,
                   'emppost'    : eljobpost.val(),
                   'firstname'  : elfname.val(),
                   'middlename' : elmname.val(),
                   'lastname'   : ellname.val(),
                   'salaryrate' : accounting.unformat(elsalaryrate.val()),
                   'salarytype' : elsalarytype.val()
                  });
    dvDetails.attr('disabled', true);
    dvBillItems.attr('disabled', false);
    elitemdesc.focus();
});

$(document).on('click','#itemsave', function() {
    if (elitemdesc.val() == '') {
        elAlert3
            .addClass('alert alert-danger')
            .empty()
            .append('<i class="fa fa-exclamation-circle fa-lg"></i> <b>ITEM DESCRIPTION cannot be empty.</b>');
        
        elitemdesc.addClass('alert-danger');
        
        return false;  
    } else {
        elAlert3.removeClass('alert alert-danger').empty();
        elitemdesc.removeClass('alert-danger');        
    }
    
    if (elitemops.val() < 0) {
        elAlert3
            .addClass('alert alert-danger')
            .empty()
            .append('<i class="fa fa-exclamation-circle fa-lg"></i> <b>ITEM VALUE cannot be 0.</b>');
        
        elitemops.addClass('alert-danger');
        
        return false;  
    } else {
        elAlert3.removeClass('alert alert-danger').empty();
        elitemops.removeClass('alert-danger');        
    }
    
    if (elitemvalue.val() == 0) {
        elAlert3
            .addClass('alert alert-danger')
            .empty()
            .append('<i class="fa fa-exclamation-circle fa-lg"></i> <b>ITEM VALUE cannot be 0.</b>');
        
        elitemvalue.addClass('alert-danger');
        
        return false;  
    } else {
        elAlert3.removeClass('alert alert-danger').empty();
        elitemvalue.removeClass('alert-danger');        
    }

    billitems.push({'clientid'  : elAccount.val(),
                    'contactid' : elContact.val(),
                    'empid'     : empTran,
                    'itemcode'  : new Date().getTime(),
                    'itemdesc'  : elitemdesc.val(),
                    'itemops'   : elitemops.val(),
                    'itemval'   : accounting.unformat(elitemvalue.val())
                   });
    clear_billitems();
    load_billeditems(empTran);
    
});

$(document).on('click','#savedetails', function() {
    var toSave = confirm('Save this billing information?');
    if (toSave == true) {
        vatused.push({'empid': empTran, 'vatpct' : parseFloat(elappvatpct.val())});
        //itemstobill.push({'bill_id': new Date().getTime(), 'account': clientinfo, 'details':{'employee': employee, 'items': billitems, 'vatpct': parseFloat(elappvatpct.val())}});
        clear_employee();
        clear_billitems();
        dvDetails.attr('disabled', false);
        dvBillItems.attr('disabled', true);
        ellname.focus();
        load_summary();
    }
});

$(document).on('click', '#createbillnotice', function() {
    var bnaccept = confirm('Create bill notice?');
    if (bnaccept == true) {
        
        itemstobill.push({
            'account'       : clientinfo,
            'billdetails'   : {'employees' : employee, 'items' : billitems, 'vat' : vatused}
        });
        
        $.ajax({
            url     : siteurl + 'billgenerator/processnotice',
            type    : 'post',
            data    : {'bdata' : JSON.stringify(itemstobill)},
            success : function(data) {
                var x = JSON.parse(data);
                console.log(x);
            },
            fail    : function(jqXHR, textStatus) {
                alert(jqXHR + textStatus);
            },
            done    : function() {
                
            }
        });
        reset_fields();
        clientinfo = [];
        employee = [];
        billitems = [];
        itemstobill = [];
        disable_acct_fields(false);
        dvAccount.attr('disabled', false);
        load_summary();
    }
});

$(document).on('keypress', '#salaryrate', function(evt) {
    if (evt.which < 46 || evt.which > 57)
    {
        evt.preventDefault();
    } 
});

$(document).on('focusout', '#salaryrate', function() {
    if ($.isNumeric(elsalaryrate.val())) {
        elsalaryrate.val(accounting.formatMoney(elsalaryrate.val()))
    }
});

$(document).on('keypress', '#itemvalue', function(evt) {
    if (evt.which < 46 || evt.which > 57)
    {
        evt.preventDefault();
    } 
});

$(document).on('focusout', '#itemvalue', function() {
    if ($.isNumeric(elitemvalue.val())) {
        elitemvalue.val(accounting.formatMoney(elitemvalue.val()));
    }
});

$(document).on('keypress', '#vatpct', function(evt) {
    if (evt.which == 13) {
        console.log(empTran);
        load_billeditems(empTran);
    }
});

$(document).ready(function(){
    get_accounts();
    load_billeditems();
    load_summary();
    dvDetails.attr('disabled', true);
    dvBillItems.attr('disabled', true);
    elbillfrom.datetimepicker({format :'YYYY-MM-DD'});
    elbillto.datetimepicker({format :'YYYY-MM-DD'});
});