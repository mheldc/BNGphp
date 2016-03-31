var eltbList    = $('#tbbilllist'),
    eltdcount   = $('#tdbillcount'),
    elsearch    = $('#txtsearch'),
    elbsearch   = $('#btnsearch');

var load_billed_items = function(param) {
    if (param == undefined) {
        param = '';
        console.log('Parameter not supplied by user');
    }
    
    $.ajax({
        url     : siteurl + 'billgenerator/getbilledlist',
        type    : 'get',
        data    : {sparam : param},
        success : function(data) {
            if (data.length == 0 || data == undefined) {
                console.log('')
            } else {
                var rs = JSON.parse(data);
                eltbList.empty();
                if (rs.length == 0) {
                    eltbList.append('<tr><td colspan="6"><b>No Record(s) Found.</b></td></tr>')
                } else {
                    for(i = 0; i < rs.length; i++){
                        eltbList
                        .append(
                                    '<tr>' +
                                    '    <td>' + rs[i]['billrefno'] + '</td>' +
                                    '    <td>' + rs[i]['accountname'] + '</td>' +
                                    '    <td>' + rs[i]['billingperiod'] + '</td>' +
                                    '    <td>' + rs[i]['datecreated'] + '</td>' +
                                    '    <td>' + rs[i]['billcreator'] + '</td>' + 
                                    '    <td style="text-align: right;">' + accounting.formatMoney(rs[i]['totalbill']) + '</td>' +
                                    '    <td style="text-align: center;">' +
                                    '        <button class="btn" onclick="javascript: print_bill(\'' + rs[i]['billrefno'] + '\');" >' +
                                    '            <i class="fa fa-file-pdf-o fa-lg"></i>' +
                                    '        </button>' +
                                    '    </td>' +
                                    '</tr>'
                                );
                    }                    
                }
                eltdcount
                    .empty()
                    .text('Total Number of Records : ' + rs.length);
            }
        },
        fail    : function(jqXHR, textStatus) {
            alert(jqXHR + textStatus);
        },
        done    : function(data) {

        }
    });
};

var print_bill = function(billid) {
    window.open(siteurl + 'billgenerator/generatebillingdocument/' + billid, '_blank').focus();
};

$(document).on('click', '#btnsearch', function() {
   load_billed_items(elsearch.val()); 
});

$(document).on('keypress','#txtsearch', function(e) {
    if(e.which == 13) {
        load_billed_items(elsearch.val());
    }
});

$(document).ready(function(){
    elbsearch.css('height', elsearch.css('height'));
    load_billed_items('');
});