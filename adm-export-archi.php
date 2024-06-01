<?php 
include 'connect.php';
$export=$_GET['export'];
$sql = "SELECT apprefno, CONCAT (lname,', ',fname,' ',mname) as name, vcscore,vrscore,frscore,qrscore,scaledscr,perrank,sai,stanine FROM student_archive where sy='$export'";

$result=mysqli_query($con,$sql);


$html='<table>
<tr class="text-center">
    <th scope="col">TPN</th>
    <th scope="col">Name</th>
    <th scope="col">Verbal Comprehension</th>
    <th scope="col">Verbal Reasoning</th>
    <th scope="col">Figurative Reasoning</th>
    <th scope="col">Quantitative Reasoning</th>
    <th scope="col">Scaled Score</th>
    <th scope="col">Percentile Rank</th>
    <th scope="col">SAI</th>
    <th scope="col">Stanine</th>
    <th scope="col">Total</th>
</tr>
';
while($row=mysqli_fetch_assoc($result)){
    $tpn=$row['apprefno'];
    $name=$row['name'];
    $vrscore = $row['vrscore'];
    $vcscore = $row['vcscore'];
    $frscore = $row['frscore'];
    $qrscore = $row['qrscore'];
    $scaledscore = $row['scaledscr'];
    $perrank = $row['perrank'];
    $sai = $row['sai'];
    $stanine = $row['stanine'];

    $vscore=$vcscore + $vrscore;
    $nvscore=$frscore + $qrscore;
    $tscore = $vscore + $nvscore;
    
    $html.='<tr>
    <td>'.$tpn.'</td>
    <td>'.$name.'</td>
    <td>'.$vrscore.'</td>
    <td>'.$vcscore.'</td>
    <td>'.$frscore.'</td>
    <td>'.$qrscore.'</td>
    <td>'.$scaledscore.'</td>
    <td>'.$perrank.'</td>
    <td>'.$sai.'</td>
    <td>'.$stanine.'</td>
    <td>'.$tscore.'</td>
</tr>';
}
$html.='</table>';
header('Content-Type:application/xls');
header('Content-Disposition:attachment;filename=archive-entrance-exam-scores.xls');
echo $html;
?>