<?php
    class mo_main extends CI_Model {
        
        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
        }
        
        public function getComments() {
            $qry = "select id, author, commenttext from comments";
            $dbresult = $this->db->query($qry);
            return $dbresult->result();
        }
        
        public function addNewComment($author = '', $comment = '') {
            $sql = "insert into comments (author, commenttext) values (?,?)";
            $this->db->query($sql,array($author,$comment));
        }
    }
?>