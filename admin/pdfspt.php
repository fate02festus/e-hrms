<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/jquery-ui.css" />
    <script src="js/jquery.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script>
    $(function() {
        $( "#datepicker" ).datepicker();
    });
    </script>
    <style>
        @media print{
            @page{
                size: 8.5in 11in;
            }
        }
        
        #print{
            border:2px solid #000;
            width:950px;
            height:850px;
            max-widt:800px;
            max-height:800px;
            margin:auto;
            font-size:12px;
        }
        table {
            border-collapse: collapse;
            }

        table, td, th {
            border: 1px solid black;
        }
    </style>
</head> 
<body> 
<button onclick="printContent('print')">Print Content</button>
<button><a style = "text-decoration:none; color:#000;" href = "home.php">Back</a></button>
<?php
    $_SESSION['date'] = date("d-m-Y");
$date = date('d/m/Y');
    $conn = new mysqli("localhost", "root", "", "ehrms") or die(mysqli_error());
    $q = $conn->query("select date,patient_hrecold.pat_no,concat(patient.firstname,' ',patient.lastname) as name,remark,complaints,concat(doctor.firstname,' ',doctor.lastname) as doctor,patient_hrecold.hospital from patient_hrecold LEFT JOIN patient on patient.pat_no=patient_hrecold.pat_no left join doctor on doctor.user_id=patient_hrecold.doctor order by date desc") or die(mysqli_error());
    $f = $q->fetch_array();
?>

<br />
<br />
    <div id="print">
        <div style = "margin:10px;">    <br />      
            <center>Republic of Kenya</center>
            <center>Ministry of Health</center>
            <center>Patients Health Record</center>
            <br />
            <br />
            <label>Date:
                <?php echo "<u>".
                       date("d-m-Y")."</u>";
                    ?>
                
            <br />
            <br />
            <center>
                <table>
                        <tr>
                            <th style = "padding-right:20px;padding-left:20px;"><center>Date.</center></th>

                            <th style = "padding-right:40px;padding-left:40px;"><center>Complains</center></th>
                           <th style = "padding-right:40px;padding-left:40px;"><center>Remarks</center></th>
                            <th style = "padding-right:40px;padding-left:40px;"><center>Specialist</center></th>
                            <th style = "padding-right:40px;padding-left:40px;"><center>Lab</center></th>
                            <th style = "padding-right:20px;padding-left:20px;"><center>Prescription</center></th>
                            <th style = "padding-left:30px; padding-right:20px;"><center>Doctor</center></th>
                             <th style = "padding-left:20px; padding-right:20px;"><center>Hospital</center></th>
                        </tr>
                <?php
 if(isset($_POST['print_patient'])){
        $from =  date("d/m/Y", strtotime($_POST['date']));
        $to =date("d/m/Y", strtotime( $_POST['dateto']));
        $gender= $_POST['gender'];
        $region = $_POST['region'];

            if($gender==null  && $region==null){
              $query =$conn->query( "select date,patient_hrecold.pat_no,concat(patient.firstname,' ',patient.lastname) as name,remark,complaints,specialist_remarks,lab_remarks,prescription,concat(doctor.firstname,' ',doctor.lastname) as doctor,patient_hrecold.hospital from patient_hrecold LEFT JOIN patient on patient.pat_no=patient_hrecold.pat_no left join doctor on doctor.user_id=patient_hrecold.doctor WHERE patient_hrecold.date between '$from' and '$to' order by date desc") or die(mysqli_error());

            }else if( $gender !=null  && $region==null){
                $query = $conn->query( "select date,patient_hrecold.pat_no,concat(patient.firstname,' ',patient.lastname) as name,remark,complaints,specialist_remarks,lab_remarks,prescription,concat(doctor.firstname,' ',doctor.lastname) as doctor,patient_hrecold.hospital from patient_hrecold LEFT JOIN patient on patient.pat_no=patient_hrecold.pat_no left join doctor on doctor.user_id=patient_hrecold.doctor WHERE patient_hrecold.date between '$from' and '$to' and patient.gender= '$gender' order by date desc'")or die(mysqli_error());
            }else if( $gender !=null  && $region !=null){
                $query= $conn->query( "select date,patient_hrecold.pat_no,concat(patient.firstname,' ',patient.lastname) as name,remark,complaints,specialist_remarks,lab_remarks,prescription,concat(doctor.firstname,' ',doctor.lastname) as doctor,patient_hrecold.hospital from patient_hrecold LEFT JOIN patient on patient.pat_no=patient_hrecold.pat_no left join doctor on doctor.user_id=patient_hrecold.doctor WHERE patient_hrecold.date between '$from' and '$to' and patient.gender= '$gender' and  patient.address= '$region' order by date desc'") or die(mysqli_error());
           }else if( $gender ==null  && $region !=null){
                 $query = $conn->query( "select date,patient_hrecold.pat_no,concat(patient.firstname,' ',patient.lastname) as name,remark,complaints,specialist_remarks,lab_remarks,prescription,concat(doctor.firstname,' ',doctor.lastname) as doctor,patient_hrecold.hospital from patient_hrecold LEFT JOIN patient on patient.pat_no=patient_hrecold.pat_no left join doctor on doctor.user_id=patient_hrecold.doctor WHERE patient_hrecold.date between '$from' and '$to' and  patient.address= '$region' order by date desc'") or die(mysqli_error());
            }

//get total
                $q = $conn->query("SELECT COUNT(*) as total FROM `patient_hrecold` WHERE date = '$date'") or die(mysqli_error());
                        $f = $q->fetch_array();

                   // $query = $conn->query("select date,patient_hrecold.pat_no,concat(patient.firstname,' ',patient.lastname) as name,remark,complaints,specialist_remarks,lab_remarks,prescription,concat(doctor.firstname,' ',doctor.lastname) as doctor,patient_hrecold.hospital from patient_hrecold LEFT JOIN patient on patient.pat_no=patient_hrecold.pat_no left join doctor on doctor.user_id=patient_hrecold.doctor WHERE patient_hrecold.date='$date' order by date desc ") or die(mysqli_error());
                 
                    for($a = 1; $a <= intval($f['total']); $a++){
                        $fetch = $query->fetch_array()
                ?>
                    <tr>
                        <td><center><?php echo $fetch['date']?></center></td>
                        <td><center><?php echo $fetch['complaints']?></center></td>
                        <td><center><?php echo $fetch['remark']?></center></td>
                        <td><center><?php echo $fetch['specialist_remarks']?></center></td>
                        <td><center><?php echo $fetch['lab_remarks']?></center></td>
                        <td><center><?php echo $fetch['prescription']?></center></td>
                        <td><center><?php echo $fetch['doctor']?></center></td>
                        <td><center><?php echo $fetch['hospital']?></center></td>
                    </tr>
                <?php
                    }}
                    $conn->close();
                ?>
                </table>
            </center>
        </div>
    </div>
<script>
function printContent(el){
    var restorepage = document.body.innerHTML;
    var printcontent = document.getElementById(el).innerHTML;
    document.body.innerHTML = printcontent;
    window.print();
    document.body.innerHTML = restorepage;
}
</script>
</html>