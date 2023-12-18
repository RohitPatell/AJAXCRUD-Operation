<?php
require('backend.php');
$sql = "SELECT * FROM students";
$result = mysqli_query($conn, $sql);
$html = '<table> <tr><td>id</td><td>firstname</td><td>lastname</td><td>email</td><td>phone</td></tr>';
while($row= mysqli_fetch_assoc($result)){
    $html.= '<tr>
    <td>'.$row['id'].'</td><td>'.$row['firstname'].'</td><td>'.$row['lastname'].'</td><td>'.$row['email'].'></td><td>'.$row['phone'].'</td>
</tr>';
}
$html.='</table>';
header('Content-Type:application/xls');
// header('Content-Disposition:attachment;flename=SqltoCSV.xls');
header('Content-Disposition: attachment; filename=SqltoCSV.xls');
echo $html;

?>


