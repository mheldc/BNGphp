var elLoginId = $('#username'),
    elLoginPw = $('#password');

var authenticate_user = function() {
    if (elLoginId.val() == '') {
        elLoginId.addClass('alert-danger');
        alert('Username cannot be empty.');
        return false;
    } else {
        elLoginId.removeClass('alert-danger');
    }
    
    if (elLoginPw.val() == '') {
        elLoginPw.addClass('alert-danger');
        alert('Password cannot be empty');
        return false;
    } else {
        elLoginPw.removeClass('alert-danger');
    }
    
    $.ajax({
        url     : siteurl + 'billgenerator/authuser',
        type    : 'POST',
        data    : {'uid': elLoginId.val(), 'pwd': elLoginPw.val()},
        success : function(data) {
            var obj = JSON.parse(data);
            console.log(obj.response);
            if (obj.response == true) {
                window.location = siteurl + 'billgenerator';
            } else {
                alert('Invalid LOGIN ID and/or PASSWORD supplied.' + '\n' + 'Try again.');
                return false;
            }
        },
        fail    : function(jqXHR, textStatus) {
            console.log(jqXHR + ' ' + textStatus);
        },
        done    : function(data) {
            
        }
    });
}

var signout_user = function() {
    $.ajax({
        url     : siteurl + 'billgenerator/signoff',
        type    : 'POST',
        data    : {'signoff': true},
        success : function(data) {
            var obj = JSON.parse(data);
            if (obj.response == true) {
                window.location = siteurl.replace('index.php/','');
            }
        },
        fail    : function(jqXHR, textStatus) {
            console.log(jqXHR + ' ' + textStatus);
        },
        done    : function(data) {
            
        }
    });
}

$(document).on('click', '#btnsignin', function() {
    authenticate_user(); 
});

$(document).on('click', '#btnsignout', function() {
    signout_user();
});

$(document).on('keypress', '#username', function(evt) {
    if (evt.which == 13) {
        authenticate_user();
    }
    console.log(evt.which);
});

$(document).on('keypress', '#password', function(evt) {
    if (evt.which == 13) {
        authenticate_user();
    }
});


$(document).ready(function() {
    
});