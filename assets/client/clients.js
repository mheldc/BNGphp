    $(document).ready(function() {
        tran_accounts(siteurl + 'billgenerator/getclients', 4, 0);         
    });
    
    $(document).on('click', '#btncreate', function(){
        $('#acctname').val('');
        $('#address1').val('');
        $('#address2').val('');
        $('#city').val('');
        $('#province').val('');
        $('#zipcode').val('');
        $('#hOps').val(0);    
    });
    
    $(document).on('click', '#btnclose', function() {
        $('#acctname').val('');
        $('#address1').val('');
        $('#address2').val('');
        $('#city').val('');
        $('#province').val('');
        $('#zipcode').val('');
        $('#notifyholder').remove();
        $('#hOps').val(-1);        
    });
    
    $(document).on('click', '#btnsave', function() {
        console.log('Save triggered');
        var saveinit = function() {
            tran_accounts(siteurl + 'billgenerator/registerclient', $('#hOps').val(), accountid);
            refresh_list();
        }, refresh_list = function() {
            tran_accounts(siteurl + 'billgenerator/getclients', 4, 0);
        }
        saveinit();
    });
  
    $(document).on('click', '#clientsearch', function() {
        search_clients();
    });
    
    $('#txtsearch').bind('keypress', function(e) {
        if(e.keyCode === 13 || e.which === 13) {
            search_clients();
        }    
    });
    
    $(document).on('click', '#btnOpsx', function() {
        $.ajax({
            url: siteurl + 'billgenerator/clientcontacts',
            type : 'POST',
            data : {clientid : 1},
            success : function( data ){
                
            },
            fail : function( jqXHR, textStatus ) {
                console.log(jqXHR + textStatus);
            },
            done : function( data ) {
                
            }
        }); 
    });
    
    var view_contacts = function(arn) {
        window.location = contacturl + arn;
    }
    
    var update_item   = function(id){
        tran_accounts(siteurl + 'billgenerator/registerclient', 3, id);
        $('#hOps').val(1);
    }
    
    var delete_item = function(id) {
        var delete_init = function() {
            tran_accounts(siteurl + 'billgenerator/registerclient', 2, id);
            refresh_list();
        }, refresh_list = function() {
            tran_accounts(siteurl + 'billgenerator/registerclient', 4, 0);
        }
        if (confirm('Are you sure you want to remove this account?') === true) {
            delete_init();
        }
    }
    
    var tran_accounts = function(urlpost, trtype, acctid) {
        
        if (trtype === 0 || trtype === 1) {
            if ($('#acctname').val() === '') {
                $('#acctname').addClass('alert-danger').text('Account Name cannot be empty!');
                $('#alertholder').append('<br /><span id="alertnotice" class="alert alert-danger" role="alert"><i class="fa fa-exclamation-triangle fa-lg"></i><b> Account name cannot be empty.</b></span><br />');
                return false;
            } else {
                $('#alertholder').empty();
                $('#acctname').removeClass('alert-danger');
            }
            
            if ($('#address1').val() === '') {
                $('#address1').addClass('alert-danger').text('Address cannot be empty!');
                $('#alertholder').append('<br /><span id="alertnotice" class="alert alert-danger" role="alert"><i class="fa fa-exclamation-triangle fa-lg"></i><b> Address cannot be empty.</b></span><br />');
                return false;
            } else {
                $('#alertholder').empty();
                $('#address1').removeClass('alert-danger');
            }
    
            if ($('#address2').val() === '') {
                $('#address2').addClass('alert-danger').text('Address cannot be empty!');
                $('#alertholder').append('<br /><span id="alertnotice" class="alert alert-danger" role="alert"><i class="fa fa-exclamation-triangle fa-lg"></i><b> Address cannot be empty.</b></span><br />');
                return false;
            } else {
                $('#alertholder').empty();
                $('#address2').removeClass('alert-danger');
            }
    
            if ($('#city').val() === '') {
                $('#city').addClass('alert-danger').text('Address cannot be empty!');
                $('#alertholder').append('<br /><span id="alertnotice" class="alert alert-danger" role="alert"><i class="fa fa-exclamation-triangle fa-lg"></i><b> City cannot be empty.</b></span><br />');
                return false;
            } else {
                $('#alertholder').empty();
                $('#city').removeClass('alert-danger');
            }
    
            if ($('#province').val() === '') {
                $('#province').addClass('alert-danger').text('Address cannot be empty!');
                $('#alertholder').append('<br /><span id="alertnotice" class="alert alert-danger" role="alert"><i class="fa fa-exclamation-triangle fa-lg"></i><b> Province cannot be empty.</b></span><br />');
                return false;
            } else {
                $('#province').removeClass('alert-danger');
            }             
        } else if (trtype === 2) {
            if (acctid === 0) {
                $('#alertholdermain').append('<br /><span id="alertnotice" class="alert alert-danger" role="alert"><i class="fa fa-exclamation-triangle fa-lg"></i><b> Please select an item to delete.</b></span><br />');
                return false;
            } else {
                $('#alertholdermain').empty();
            }            
        } else if (trtype === 3) {
            if (acctid === 0) {
                $('#alertholdermain').append('<br /><span id="alertnotice" class="alert alert-danger" role="alert"><i class="fa fa-exclamation-triangle fa-lg"></i><b> Please select an item from the list.</b></span><br />');
                return false;
            } else {
                $('#alertholdermain').empty();
            }             
        }
        
        $.ajax({
            url     : urlpost,
            type    : 'POST',
            data    : { tran_type   : trtype,
                        acctid      : acctid,
                        accountname : $('#acctname').val(),
                        addr1       : $('#address1').val(),
                        addr2       : $('#address2').val(),
                        city        : $('#city').val(),
                        prov        : $('#province').val(),
                        zipcode     : $('#zipcode').val()
                      }
        }).success(function(data){
            var retval = JSON.parse(data);
            if (retval.length === 0) {
                return false;
            }
        }).fail(function( jqXHR, textStatus ) {
            $('#alertholder')
                .append(
                    '<div id="notifyholder" class="alert">' +
                        '<span id="notifymain" class="alert alert-danger"> ' + 
                            '<i class="fa fa-exclamation-triangle"></i> Request failed : ' + textStatus + jqXHR[0] + 
                        '</span>' +
                    '</div>'
                )
                .fadeOut(10000);
        }).done(function(data){
            var retval = JSON.parse(data);
            var init = function(){
                $('#tblcontent').empty();
                $('#rowcount').text('Total # of records : ' + retval.length);
                loaditems();
            }, loaditems = function() {
                for(i=0; i < retval.length; i++) {
                   $('#tblcontent')
                       .append(
                            '<tr id="' + retval[i]['acctid'] + '"> ' +
                                '<td>' + retval[i]['acctrefno'] + '</td> ' +
                                '<td>' + retval[i]['accountname'] + '</td> ' +
                                '<td style="text-align: center;"> ' +
                                '   <button id="' + retval[i]['acctrefno'] + '" onclick="javascript: view_contacts(\'' + retval[i]['acctrefno'] + '\');"><i class="fa fa-users fa-lg"></i></button> ' +
                                '</td> ' +
                                '<td style="text-align: center;"> ' +
                                '   <button onclick="javascript:update_item('+ retval[i]['acctid'] +')" data-toggle="modal" data-target="#clientInfoModal"><i class="fa fa-edit fa-lg"></i></button> ' +
                                '</td> ' +
                                '<td style="text-align: center;"> ' +
                                    '<button onclick="javascript:delete_item('+ retval[i]['acctid'] +')"><i id="del_'+ retval[i]['acctid'] +'" class="fa fa-trash fa-lg"></i></button> ' +
                                '</td> ' +
                            '</tr>'
                   );
                }
                $('#rowcount').text('Total # of records : ' + retval.length);                       
            }
            
            if (trtype == 0) {
                console.log('Returned Reference Id : ' + retval.refid);
                if (retval.refid > 0) {
                    if ($('#notifyholder').length > 0) {
                        $('#notifyholder').remove();
                    }
                    $('#alertholder')
                        .prepend(
                            '<div id="notifyholder" class="alert">' +
                                '<span class="alert alert-success"> ' + 
                                    '<i class="fa fa-info-circle"></i> Account <b>[' + $('#acctname').val() + ']</b> has been saved successfully.' + 
                                '</span>' +
                            '</div>'
                        );
                    
                    $('#acctname').val('');
                    $('#address1').val('');
                    $('#address2').val('');
                    $('#city').val('');
                    $('#province').val('');
                    $('#zipcode').val('');
                }
                else {
                    if ($('#notifyholder').length > 0) {
                        $('#notifyholder').remove();
                    }
                    $('#alertholder')
                    .prepend(
                        '<div id="notifyholder" class="alert">' +
                            '<span class="alert alert-danger"> ' + 
                                '<i class="fa fa-exclamation-triangle"></i> Account <b>[' + $('#acctname').val() + ']</b> already exists. Please enter a unique account then try again.' + 
                            '</span>' +
                        '</div>'
                    );                        
                }                
            } else if (trtype == 1) {
                $('#hOps').val(-1);                
            } else if (trtype == 2) {
                $('#hOps').val(-1);                  
            } else if (trtype == 3) {
                if (retval.length > 0) {
                    $('#alertholder').empty();
                    accountid = retval[0]['acctid'];
                    $('#acctname').val(retval[0]['accountname']);
                    $('#address1').val(retval[0]['address']);
                    $('#address2').val(retval[0]['address2']);
                    $('#city').val(retval[0]['city']);
                    $('#province').val(retval[0]['province']);
                    $('#zipcode').val(retval[0]['zipcode']);
                } else {
                    $('#alertholder')
                    .append(
                        '<div id="notifyholder" class="alert">' +
                            '<span class="alert alert-danger"> ' + 
                                '<i class="fa fa-exclamation-triangle"></i> Account already exists. Please enter a unique account then try again.' + 
                            '</span>' +
                        '</div>'
                    )
                    .fadeOut(5000);
                }                
            } else if (trtype == 4) {
                init();
            } else {
                return false;
            }   
        });
       
    }
    
    var search_clients = function() {
        $.ajax({
            url : siteurl + 'billgenerator/searchclient',
            type    : 'POST',
            data    : {searchfield : $('#txtsearch').val()}            
        }).success(function(data) {
            var retval = JSON.parse(data);
            var init = function(){
                $('#tblcontent').empty();
                $('#rowcount').text('Total # of records : ' + retval.length);
                loaditems();
            }, loaditems = function() {
                if (retval.length > 0) {
                    for(i=0; i < retval.length; i++) {
                       $('#tblcontent')
                           .append(
                                    '<tr id="' + retval[i]['acctid'] + '"> ' +
                                        '<td>' + retval[i]['acctrefno'] + '</td> ' +
                                        '<td>' + retval[i]['accountname'] + '</td> ' +
                                        '<td style="text-align: center;"> ' +
                                        '   <button id="' + retval[i]['acctrefno'] + '" onclick="javascript: view_contacts(\'' + retval[i]['acctrefno'] + '\');"><i class="fa fa-users fa-lg"></i></button> ' +
                                        '</td> ' +
                                        '<td style="text-align: center;"> ' +
                                        '   <button onclick="javascript:update_item('+ retval[i]['acctid'] +')" data-toggle="modal" data-target="#clientInfoModal"><i class="fa fa-edit fa-lg"></i></button> ' +
                                        '</td> ' +
                                        '<td style="text-align: center;"> ' +
                                            '<button onclick="javascript:delete_item('+ retval[i]['acctid'] +')"><i id="del_'+ retval[i]['acctid'] +'" class="fa fa-trash fa-lg"></i></button> ' +
                                        '</td> ' +
                                    '</tr>'
                       );
                    }
                } else {
                    $('#tblcontent')
                        .append(
                           '<tr> ' +
                               '<td class="col-md-12" colspan="5" style="text-align: center; font-weight:bolder;">No record(s) found.</td> ' +
                           '</tr>'
                        );    
                }

                $('#rowcount').text('Total # of records : ' + retval.length);                       
            }
            init();
        }).fail(function( jqXHR, textStatus ) {
            $('#alertholdermain')
                .append(
                    '<div id="notifyholder" class="alert">' +
                        '<span id="notifymain" class="alert alert-danger"> ' + 
                            '<i class="fa fa-exclamation-triangle"></i> Request failed : ' + textStatus + jqXHR[0] + 
                        '</span>' +
                    '</div>'
                )
                .fadeOut(10000);
        }).done(function(){
            //console.log('cycle complete');    
        });        
    }        