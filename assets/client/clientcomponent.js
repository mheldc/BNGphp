var ClientList = React.createClass({
    displayName         : 'ClientListings',
    getInitialState     : function(){
        return {data : []};
    },
    componentDidMount : function() {
        this.loadClientList();
        setInterval(this.loadClientList, this.props.refreshInterval);
    },
    loadClientList : function() {
        $.ajax({
            url: this.props.url,
            dataType: 'json',
            cache: false,
            success: function(data) {
                this.setState({data: data});
                console.log(data);
            }.bind(this),
                error: function(xhr, status, err) {
                console.error(this.props.url, status, err.toString());
            }.bind(this)
        }); 
    },
    transactClient : function() {
        $.ajax({
            url: this.props.urlpost,
            type: 'post',
            data: {trantype : tranType},
            success: function(data) {
                console.log(data);
            }.bind(this),
                error: function(xhr, status, err) {
                console.error(this.props.url, status, err.toString());
            }.bind(this),
        });    
    },
    render : function() {
        return(
            React.createElement(ClientInfo, {data : this.state.data})
        );
    }
});

var ClientInfo  = React.createClass({
    displayName         : 'ClientInformation',
    render: function() {
        var clientNodes = this.props.data.map(function (client) {
            return(
                React.createElement(Client, {key: client.acctid, clientid: client.acctid, clientrefno: client.acctrefno, clientname: client.accountname})
            )
        });
        
        return(
            React.createElement('tbody', null, clientNodes)
        );
    }  
});

var Client = React.createClass({
    render  :   function() {
        return (
            React.createElement('tr',{id : this.props.clientid},
                React.createElement('td', null, this.props.clientrefno),
                React.createElement('td', null, this.props.clientname),
                React.createElement('td', {style:{textAlign: 'center'}},
                    React.createElement('a', {href: '#'},
                        React.createElement('i', {className: 'fa fa-users fa-2x'})
                    )
                ),
                React.createElement('td', {style:{textAlign: 'center'}},
                    React.createElement('a', {href: '#'},
                        React.createElement('i', {className: 'fa fa-edit fa-2x'})
                    )
                ),
                React.createElement('td', {style:{textAlign: 'center'}},
                    React.createElement('a', {href: '#'},
                        React.createElement('i', {className: 'fa fa-trash fa-2x'})
                    )
                )
            )                         
        );
    }  
});

/*
var ClientHeader = React.createClass({
    displayName : 'ClientHeader',
    render : function() {
        return(
            React.createElement('thead', {style: {backgroundColor: 'rgb(224,224,224)', fontSize: '14px' , fontWeight: 'bolder' }},
                React.createElement('tr', null,
                    React.createElement('td', null, 'Reference No.'),
                    React.createElement('td', null, 'Account Name'),
                    React.createElement('td', {style: {width: '70px', textAlign: 'center'}}, 'Contacts'),
                    React.createElement('td', {style: {width: '70px', textAlign: 'center'}}, 'Edit'),
                    React.createElement('td', {style: {width: '70px', textAlign: 'center'}}, 'Delete')
                )
            )
        );
    }
});

var ClientFooter = React.createClass({
    displayName : 'ClientFooter',
    getInitialState : function() {
        return {data : []}
    },
    getClientCount : function() {
        $.ajax({
            url: this.props.url,
            dataType: 'json',
            cache: false,
            success: function(data) {
                this.setState({data: data});
            }.bind(this),
                error: function(xhr, status, err) {
                console.error(this.props.url, status, err.toString());
            }.bind(this)
        }); 
    },
    render : function() {
        return(
            React.createElement('tfoot', {style: {backgroundColor: 'rgb(224,224,224)', fontSize: '14px' , fontWeight: 'bolder' }},
                React.createElement('tr', null,
                    React.createElement('td', {colSpan: '5'}, 'Number of records : ' + this.state.data.length)    
                )
            )  
        );
    }
});
*/

ReactDOM.render(
    React.createElement(ClientList, {url: siteurl + '/billgenerator/getclients', urlpost: siteurl + '/billgenerator/registerclient', refreshInterval: 1000}, document.getElementById('tblclient'))                
);