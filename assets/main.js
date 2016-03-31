/*
var data = [
    {id: 1, author: "Pete Hunt", text: "This is one comment."},
    {id: 2, author: "John Walke", text: "This is *another* comment."}
];
*/

var CommentBox = React.createClass({
    displayName: 'CommentBox',
    loadCommentsFromServer: function() {
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
    handleCommentSubmit: function(comment) {
        var comments = this.state.data;
        comment.id = Date.now();
        
        var newComments = comments.concat([comment]);
        this.setState({data: newComments});
        
        $.ajax({
            url: this.props.urlpost,
            dataType: 'json',
            type: 'POST',
            data: comment,
            success: function(data) {
                this.setState({data: data});
            }.bind(this),
            error: function(xhr, status, err) {
                this.setState({data: comments});
                console.error(this.props.url, status, err.toString());
            }.bind(this)
       });       
    },
    getInitialState: function() {
        return {data: []};
    },
    componentDidMount: function() {
        this.loadCommentsFromServer();
        setInterval(this.loadCommentsFromServer, this.props.pollInterval);
    },
    render: function() {
        return (
            React.createElement('div', {className: "commentBox"},
                React.createElement('h1', null, "Comments"),
                React.createElement(CommentList, {data: this.state.data}, null),
                React.createElement(CommentForm, {onCommentSubmit: this.handleCommentSubmit}, null)
            )
        );
    }
});

var CommentList = React.createClass({
    displayName: 'CommentList',
    render: function() {
        var commentNodes = this.props.data.map(function (comment) {
            return(
                React.createElement(Comment, {author: comment.author, key: comment.id}, comment.commenttext)
            )
        });
        
        return(
            React.createElement('div', {className: "CommentList"}, commentNodes)       
        );
    }                                                                    
});

var CommentForm = React.createClass({
    displayName: 'CommentForm',
    getInitialState: function() {
        return{author: '', commenttext: ''};    
    },
    handleAuthorChange: function(e) {
        this.setState({author: e.target.value});  
    },
    handleTextChange: function(e) {
        this.setState({commenttext: e.target.value});    
    },
    handleSubmit: function(e) {
        e.preventDefault();
        var author = this.state.author.trim();
        var commenttext = this.state.commenttext.trim();
        
        if (!author || !commenttext) {
            return;
        }
        this.props.onCommentSubmit({author: author, commenttext: commenttext});
        this.setState({author:'', commenttext:''});
    },
    render: function() {
        return(
            React.createElement('form', {className: "commentForm", onSubmit: this.handleSubmit},
                React.createElement('input',{type: "text", placeholder: "Your Name...", value: this.state.author, onChange: this.handleAuthorChange}),
                React.createElement('input', {type: "text", placeholder: "Say Something...", value: this.state.commenttext, onChange: this.handleTextChange}),
                React.createElement('input', {type: "submit", value: "Post"})
            )                    
        );    
    }                                 
});

var Comment = React.createClass({
    rawMarkup: function() {
        var rawMarkup = marked(this.props.children.toString(),{sanitize: true});
        return {__html: rawMarkup};
    },
    render: function() {
        return(
            React.createElement('div', {className: "Comment"},
                React.createElement('h2', {className: "CommentAuthor"}, this.props.author),
                React.createElement('span', {dangerouslySetInnerHTML: this.rawMarkup()})
            )    
        );    
    } 
});

ReactDOM.render(
    React.createElement(CommentBox, {url: 'http://localhost:8080/billing/index.php/Welcome/getComments', urlpost: 'http://localhost:8080/billing/index.php/Welcome/addComment', pollInterval: 1000}), document.getElementById('content')
);

