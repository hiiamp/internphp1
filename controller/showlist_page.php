<?php
include 'myLibrary/connectDTB_PDO.php';
include "myLibrary/PaginatorPDO.php";
$conn = connect_DTB("account_ex1");
$limit      = ( isset( $_GET['limit'] ) ) ? $_GET['limit'] : 4;
$page       = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 1;
$links      = ( isset( $_GET['links'] ) ) ? $_GET['links'] : 7;
$query = "SELECT * FROM account";
$Paginator  = new PaginatorPDO( $conn, $query );
$results    = $Paginator->getData( $limit, $page );
echo '<table width = "100%" class="table table-striped table-condensed table-bordered table-rounded" >
    <h2 > List Account Created: </h2> 
    <tr>
        <th>Name</th>
        <th>E-mail</th>
        <th>Website</th>
        <th>Day of Birth</th>
        <th>Other Infor</th>
        <th>Gender</th>
        <th>Manage</th>
    </tr>';
for( $i = 0; $i < @count( $results->data ); $i++ ) :
    echo '<tr>
              <td>';
                    echo $results->data[$i]['name'];
    echo '    </td>
              <td>';
                    echo $results->data[$i]['email'];
    echo '    </td>
              <td>';
                    echo $results->data[$i]['website'];
    echo '    </td>
              <td>';
                    echo $results->data[$i]['dayofbirth'];
    echo '    </td>
              <td>';
                    echo $results->data[$i]['other'];
    echo '    </td>
              <td>';
                    echo $results->data[$i]['gender'];
    echo '    </td>
              <td>
                   <button> <a href="edit_account.php?email=' . $results->data[$i]['email'] . '"> Edit </a></button>
                   <button> <a href="confirm_delete.php?email=' . $results->data[$i]['email'] . '"> Delete </a> </button>
              </td>
    </tr>';
endfor;
echo '</table>';
echo '<nav>';
echo $Paginator->createLinks( $links, 'pagination pagination-sm' );

?>