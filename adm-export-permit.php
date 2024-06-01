<?php
include 'connect.php';

$sql = "SELECT apprefno, CONCAT (lname,', ',fname,' ',mname) as name,tsite,date_format(tsched, '%M %e %Y %r') as tsched FROM account_tab where apprefno!='' and stat=1 and stat1=1";
$result=mysqli_query($con,$sql);
$html='<table>
<tr class="text-center">
    <th scope="col">App Ref No.</th>
    <th scope="col">Fullname</th>
    <th>Schedule of Exam</th>
    <th scope="col">Testing Site</th>
</tr>
';
while($row=mysqli_fetch_assoc($result)){
    $apprefno=$row['apprefno'];
    $name=$row['name'];
    $t_sched = $row['tsched'];
    $tsite = $row['tsite'];

    $html.='<tr>
    <td>'.$apprefno.'</td>
    <td>'.$name.'</td>
    <td>'.$t_sched.'</td>
    <td>'.$tsite.'</td>
</tr>';
}
$html.='</table>';
header('Content-Type:application/xls');
header('Content-Disposition:attachment;filename=permitted-applicants-list.xls');
echo $html;
?>