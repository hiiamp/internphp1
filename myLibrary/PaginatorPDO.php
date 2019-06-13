<?php
    class PaginatorPDO{
        private $_conn;
        private $_limit;
        private $_page;
        private $_query;
        private $_total;

        public function __construct($conn, $query)
        {
            $this->_conn = $conn;
            $this->_query = $query;

            $temp = $this->_conn->prepare($this->_query);
            $temp->execute();
            $temp->setFetchMode(PDO::FETCH_ASSOC);
            //$rs = $this->_conn->query( $this->_query);
            $rs = $temp->fetchAll();
            $c = 0;
            foreach ($rs as $row) $c++;
            $this->_total = $c;
        }

        public function getData( $limit = 10, $page = 1 ) {

            $this->_limit   = $limit;
            $this->_page    = $page;

            if ( $this->_limit == 'all' ) {
                $query      = $this->_query;
            } else {
                $query      = $this->_query . " LIMIT " . ( ( $this->_page - 1 ) * $this->_limit ) . ", $this->_limit";
            }
            $temp = $this->_conn->prepare($query);
            $temp->execute();
            $temp->setFetchMode(PDO::FETCH_ASSOC);
            $rs = $temp->fetchAll();
            foreach ($rs as $row){
                $results[]  = $row;
            }

            $result         = new stdClass();
            $result->page   = $this->_page;
            $result->limit  = $this->_limit;
            $result->total  = $this->_total;
            $result->data   = @$results or null;

            return $result;
        }

        public function createLinks( $links, $list_class ) {
            if ( $this->_limit == 'all' ) {
                return '';
            }
            $last       = ceil( $this->_total / $this->_limit );
            $start      = ( ( $this->_page - $links ) > 0 ) ? $this->_page - $links : 1;
            $end        = ( ( $this->_page + $links ) < $last ) ? $this->_page + $links : $last;
            $html       = '<ul class="pagination">';
            $class      = ( $this->_page == 1 ) ? "disabled" : "";
            if($this->_page > 1) $html.= '<li class="page-item"><a class = "page-link" href="?limit=' . $this->_limit . '&page=' . ( $this->_page - 1 ) . '">Previous</a></li>';
            else $html.= '<li class="page-item"><a class = "page-link" href="?limit=' . $this->_limit . '&page=' . ( $this->_page ) . '">Previous</a></li>';
            if ( $start > 1 ) {
                $html   .= '<li><a class = "page-link" href="?limit=' . $this->_limit . '&page=1">1</a></li>';
                $html   .= '<li class="page-item"><span>...</span></li>';
            }
            for ( $i = $start ; $i <= $end; $i++ ) {
                $class  = ( $this->_page == $i ) ? "active" : "";
                $html   .= '<li class="page-item '.$class.'"><a class = "page-link" href="?limit=' . $this->_limit . '&page=' . $i . '">  ' . $i . '  </a></li>';
            }
            if ( $end < $last ) {
                $html   .= '<li class="page-item"><span>...</span></li>';
                $html   .= '<li><a class = "page-link" href="?limit=' . $this->_limit . '&page=' . $last . '">' . $last . '</a></li>';
            }
            $class      = ( $this->_page >= $last ) ? "disabled" : "";
            if($this->_page*$this->_limit<$this->_total) $html.= '<li class="page-item"><a class = "page-link" href="?limit=' . $this->_limit . '&page=' . ( $this->_page + 1 ) . '">Next</a></li>';
            else $html.= '<li class="page-item"><a class = "page-link" href="?limit=' . $this->_limit . '&page=' . ( $this->_page ) . '">Next</a></li>';
            $html       .= '</ul>';
            return $html;
            }
    }

?>