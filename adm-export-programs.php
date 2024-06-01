<?php
include 'connect.php';

$sql = "SELECT college, program FROM program_tab";
$result=mysqli_query($con,$sql);
$html='<table>
<tr class="text-center">
    <th scope="col">College/Department</th>
    <th scope="col">Program</th>
</tr>
';
while($row=mysqli_fetch_assoc($result)){
    $college=$row['college'];
    $program=$row['program'];

    $html.='<tr>
    <td>'.$college.'</td>
    <td>'.$program.'</td>
</tr>';
}
$html.='</table>';
header('Content-Type:application/xls');
header('Content-Disposition:attachment;filename=college-program-list.xls');
echo $html;
?>