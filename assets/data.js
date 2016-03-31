var authUser = function() {
    $.ajax({
        url     : 'http://localhost:8080/billing/index.php/billgenerator/authuser',
        type    : 'post',
        data    : {loginid : 'billadmin', loginpw : 'billadmin'},
        dataType: 'json',
        success : function(data) {
            console.log(data);    
        },
        error   : function(jqXHR) {
            console.log(jqXHR[0]);
        }
    }); 
};