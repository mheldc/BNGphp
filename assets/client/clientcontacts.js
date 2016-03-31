var register_contact = function(urlpost, ttype, cid, acctid) {
    if (ttype == 0 || ttype == 1) {
        if ($('#honorifics').val() == 0) {
            $('#honorifics').addClass("alert-danger");
            $('#alertholdercontact').append('<br /><span id="alertnotice" class="alert alert-danger" role="alert"><i class="fa fa-exclamation-triangle fa-lg"></i><b> Invalid honorific selected.</b></span><br />');
            return false;
        } else {
            $('#honorifics').removeClass("alert-danger");
            $('#alertholdercontact').empty();
        }
        
        if ($('#firstname').val() == '') {
            $('#firstname').addClass("alert-danger");
            $('#alertholdercontact').append('<br /><span id="alertnotice" class="alert alert-danger" role="alert"><i class="fa fa-exclamation-triangle fa-lg"></i><b> First name cannot be null.</b></span><br />');
            return false;
        } else {
            $('#firstname').removeClass("alert-danger");
            $('#alertholdercontact').empty();
        }
        
        if ($('#lastname').val() == '') {
            $('#lastname').addClass("alert-danger");
            $('#alertholdercontact').append('<br /><span id="alertnotice" class="alert alert-danger" role="alert"><i class="fa fa-exclamation-triangle fa-lg"></i><b> Last name cannot be null.</b></span><br />');
            return false;
        } else {
            $('#lastname').removeClass("alert-danger");
            $('#alertholdercontact').empty();
        }

        if ($('#jobpost').val() == '') {
            $('#jobpost').addClass("alert-danger");
            $('#alertholdercontact').append('<br /><span id="alertnotice" class="alert alert-danger" role="alert"><i class="fa fa-exclamation-triangle fa-lg"></i><b> Job position cannot be null.</b></span><br />');
            return false;
        } else {
            $('#jobpost').removeClass("alert-danger");
            $('#alertholdercontact').empty();
        }        
    }
    
    $.ajax({
        url  : urlpost,
        type : 'POST',
        data : {tran_type   : ttype,
                accountid   : acctid,
                contactid   : cid,
                honorifics  : $('#honorifics').val(),
                firstname   : $('#firstname').val(),
                middlename  : $('#middlename').val(),
                lastname    : $('#lastname').val(),
                jobpost     : $('#jobpost').val()
                },
        success : function( data ) {
            var retval = JSON.parse(data);
            /*
            switch (ttype) {
                case 0 :
                    console.log(retval);
                    if (retval['recstat'] == true && retval['refid'] > 0) {
                        console.log($('#alertholdercontact').length);
                        if ($('#alertholdercontact').length > 0) {
                            $('#alertholdercontact').empty();
                        }
                        $('#alertholdercontact')
                            .prepend('<br /><span id="alertnotice" class="alert alert-success" role="alert"><i class="fa fa-info-circle fa-lg"></i><b> Contact information has been saved.</b></span><br />');
                            
                        clear_fields();
                    }
                    break;
                    
                case 1 :
                    
                    break;
                    
                case 2 :
                    
                    break;
                    
                case 3 :
                    for(i=0; i < retval.length; i++){
                        $('#honorifics').val(retval[i]['honorifics']);
                        $('#firstname').val(retval[i]['firstname']);
                        $('#middlename').val(retval[i]['middlename']);
                        $('#lastname').val(retval[i]['lastname']);
                        $('#jobpost').val(retval[i]['jobpost']);                            
                    }

                    break;
                    
                case 4 :
                    $('#tblcontent').empty();
                    for(i=0; i < retval.length;i++){
                        $('#tblcontent')
                            .append('<tr>' +
                                        '<td>' + retval[i]['contactid'] + '</td>' +
                                        '<td>' + retval[i]['contactname'] + '</td>' +
                                        '<td>' + retval[i]['jobpost'] + '</td>' +
                                        '<td style="text-align:center;"><button onclick="javascript:get_contact_info('+ retval[i]['contactid'] +')" data-toggle="modal" data-target="#clientContactModal"><i class="fa fa-edit fa-lg"></i></button></td>' +
                                        '<td style="text-align:center;"><button onclick="javascript:delete_item('+ retval[i]['contactid'] +')"><i id="del_'+ retval[i]['contactid'] +'" class="fa fa-trash fa-lg"></i></button></td>' +
                                    '</tr>'
                                    );
                    }
                    $('#rowcount').empty().append('Total # of Records : '  + retval.length);
                    
                    break;
                    
                default :
                    
                    break;
            }
            */
            
            var aholder     = $('#alertholdercontact');
            console.log(retval);
            if (ttype == 0) {
                
                if (retval['refid'] > 0) {
                    $('#alertholdercontact')
                        .prepend(
                                    '<br />' +
                                        '<span id="alertnotice" class="alert alert-success" role="alert">' +
                                            '<i class="fa fa-info-circle fa-lg"></i>' +
                                            '<b> Contact information has been saved.</b>' +
                                        '</span>' +
                                    '<br />'
                                );
                    
                    $('#alertnotice').delay(800).fadeOut(2000, function() {
                        $('#alertholdercontact').empty();
                    });

                    clear_fields();
                } else {
                    $('#alertholdercontact')
                        .prepend(
                                    '<br />' +
                                        '<span id="alertnotice" class="alert alert-danger" role="alert">' + 
                                            '<i class="fa fa-exclamation-triangle fa-lg"></i>' +
                                            '<b> Saving of contact information failed.</b><br />' +
                                            '<b> Due to : Error code : ' + retval['err']['message'] +
                                        '</span>' +
                                    '<br />'
                                );
                    
                    $('#alertnotice').delay(800).fadeOut(2000, function() {
                        $('#alertholdercontact').empty();
                    });                    
                }
                
            } else if (ttype == 1) {
                //code
            } else if (ttype == 2) {
                
                
            } else if (ttype == 3) {
                for(i=0; i < retval.length; i++){
                    $('#honorifics').val(retval[i]['honorifics']);
                    $('#firstname').val(retval[i]['firstname']);
                    $('#middlename').val(retval[i]['middlename']);
                    $('#lastname').val(retval[i]['lastname']);
                    $('#jobpost').val(retval[i]['jobpost']);                            
                }
                
            } else if (ttype == 4) {
                $('#tblcontent').empty();
                for(i=0; i < retval.length;i++){
                    $('#tblcontent')
                        .append('<tr>' +
                                    '<td>' + retval[i]['contactid'] + '</td>' +
                                    '<td>' + retval[i]['contactname'] + '</td>' +
                                    '<td>' + retval[i]['jobpost'] + '</td>' +
                                    '<td style="text-align:center;"><button onclick="javascript:get_contact_info('+ retval[i]['contactid'] +')" data-toggle="modal" data-target="#clientContactModal"><i class="fa fa-edit fa-lg"></i></button></td>' +
                                    '<td style="text-align:center;"><button onclick="javascript:delete_item('+ retval[i]['contactid'] +')"><i id="del_'+ retval[i]['contactid'] +'" class="fa fa-trash fa-lg"></i></button></td>' +
                                '</tr>'
                                );
                }
                $('#rowcount').empty().append('Total # of Records : '  + retval.length);
                
            } else {
                
            }

        },
        fail : function( jqXHR, textStatus ) {
            console.log(jqXHR[0] + textStatus);
        },
        done : function( data ) {
            var retval = JSON.parse(data);
            console.log(data);
        }
    });

}

var search_contact = function() {
    $.ajax({
        url  : urlpost,
        type : 'POST',
        data : {tran_type   : ttype,
                accountid   : acctid,
                contactid   : cid,
                firstname   : $('#firstname').val(),
                middlename  : $('#middlename').val(),
                lastname    : $('#lastname').val(),
                jobpost     : $('#jobpost').val()
                },
        success : function(data) {
            
        },
        fail : function() {
            
        },
        done : function(data) {
            
        }
    });    
}

var clear_fields = function() {
    $('#honorifics').val(0);
    $('#firstname').val('');
    $('#middlename').val('');
    $('#lastname').val('');
    $('#jobpost').val('');
    register_contact(siteurl + 'billgenerator/getclientcontacts', 4, $('#lcid').text(), $('#laid').text());
}

var get_contact_info = function(contactid) {
    $('#lcid').text(contactid);
    $('#dOps').text('1');
    register_contact(siteurl + 'billgenerator/registercontact', 3, contactid, $('#laid').text());
}

var delete_item = function(contactid) {
    var response = confirm('Are you sure you want to remove this contact from list?');
    if (response == true) {
        var init = function() {
            register_contact(siteurl + 'billgenerator/registercontact', 2, contactid, $('#laid').text());
            refreshlist();
        }, refreshlist  = function() {
            register_contact(siteurl + 'billgenerator/registercontact', 4, contactid, $('#laid').text());
        }
        init();
    }
}

$(document).ready(function (){
    register_contact(siteurl + 'billgenerator/getclientcontacts', 4, $('#lcid').text(), $('#laid').text());
});

$(document).on('click', '#btncreate', function() {
    $('#dOps').text('0');
});

$(document).on('click', '#btnclosecontact', function() {
   $('#dOps').text('-1');
   $('#lcid').text('0');
   clear_fields();
});

$(document).on('click', '#btnsavecontact', function() {
    var posturl = siteurl + 'billgenerator/registercontact',
        opsid   = $('#dOps').text(),
        cid     = $('#lcid').text(),
        aid     = $('#laid').text();
    var init = function() {
        register_contact(posturl, opsid, cid, aid);
        refreshlist();
    }, refreshlist = function() {
        clear_fields();
        register_contact(siteurl + 'billgenerator/getclientcontacts', 4, cid, aid);
    }
    init();
});
