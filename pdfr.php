<?php
//include connection file 
//include_once("include/db.php");
include_once('fpdf/fpdf.php');

    session_start();
    include_once('include/config.php');
     //db connection
        Class dbObj{
            //database connection start
            var $dbhost = "localhost";
            var $username = "root";
            var $password = "";
            var $dbname = "ehrms";
            var $conn;
            
            function getConnstring(){
                $con = mysqli_connect($this->dbhost, $this->username, $this->password, $this->dbname) or die(mysqli_errno());
                if(mysqli_connect_errno()){
                    printf("Connection failed");
                    exit();
                }else{
                    $this->conn = $con;
                }
            return $this->conn;
            }
        }
       //$today=new DateTime();
      //$today= strtotime($today);
      // $today = date('d/m/Y', $today);
    if(isset($_POST['print_patient'])){
        $from = $_POST['date'];
        $to = $_POST['dateto'];
        $gender= $_POST['gender'];
        $region = $_POST['region'];
         class PDF extends FPDF
        {
        // Page header
        function Header()
        {
            // Logo
            $this->Image('images/logo.png',100,5,10);
            $this->Ln(15);
            $this->SetFont('Arial','B',9);
            // Move to the right
            $this->Cell(80);
            // Title
            $this->Cell(30,10,'REPUBLIC OF KENYA',0,0,'C');
            // Line break
            $this->Ln(10);
            
            $this->Cell(80);
            $this->Cell(30,10,'MINISTRY OF HEALTH',0,0,'C');
            $this->Ln(10);
             
            $this->Cell(80);
            $this->Cell(30,10,'PATIENTS LIST',0,0,'C');
            $this->Ln(10);
        }
        
        // Page footer
        function Footer()
        {
            // Position at 1.5 cm from bottom
            $this->SetY(-15);
            // Arial italic 8
            $this->SetFont('Arial','I',8);
            $this->Cell(180,10,'ELECTRONIC HEALTH RECORD MANAGEMENT SYSTEM',0,0,'C');
            // Page number
            $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
        }
        }
        //$query_details = $con->query("SELECT * FROM emp_details WHERE fac =);
        
        $db = new dbObj();
        $connString =  $db->getConnstring();
        $display_heading = array('Pat. NO','Name','Gender','Address','Civil Status','Huduma No.');
        if($from ==null && $to==null && $gender==null  && $region==null)
          {  $result = mysqli_query($connString, "SELECT pat_no,concat(firstname,' ',lastname) as name,gender,address,civil_status,huduma_no FROM patient ORDER BY pat_no") or die("database error:". mysqli_error($connString));
        }else if($from !=null &&$to !=null && $gender==null  && $region==null){
            $result = mysqli_query($connString, "SELECT pat_no,concat(firstname,' ',lastname) as name,gender,address,civil_status,huduma_no FROM patient WHERE birthdate between '$from' and '$to' order BY pat_no") or die("database error:". mysqli_error($connString));
        }else if($from !=null &&$to !=null && $gender !=null  && $region==null){
            $result = mysqli_query($connString, "SELECT pat_no,concat(firstname,' ',lastname) as name,gender,address,civil_status,huduma_no FROM patient WHERE birthdate between '$from' and '$to' and gender= '$gender' order BY pat_no '") or die("database error:". mysqli_error($connString));
        }else if($from !=null &&$to !=null && $gender !=null  && $region !=null){
            $result = mysqli_query($connString, "SELECT pat_no,concat(firstname,' ',lastname) as name,gender,address,civil_status,huduma_no FROM patient WHERE birthdate between '$from' and '$to' and gender= '$gender' and  address= '$region' order BY pat_no '") or die("database error:". mysqli_error($connString));
       }else if($from !=null &&$to !=null && $gender ==null  && $region !=null){
             $result = mysqli_query($connString, "SELECT pat_no,concat(firstname,' ',lastname) as name,gender,address,civil_status,huduma_no FROM patient WHERE birthdate between '$from' and '$to' and  address= '$region' order BY pat_no '") or die("database error:". mysqli_error($connString));
        }
        
        //$header = mysqli_query($connString, "SHOW COLUMNS FROM emp");
        
        $pdf = new PDF();
        $pdf->SetMargins(5,5);
        
        //header
        $pdf->AddPage();
        //foter page
        $pdf->AliasNbPages();
        
        $pdf->Cell(20,5,' '.date("d M, Y").'',0,1,'R');
        foreach($display_heading as $header) {
        $pdf->Cell(30,10,$header,1,0,'C');
        }

        $pdf->SetFont('Arial','',8);
        $i=0;
        $i++;
        foreach($result as $row) {
        $pdf->Ln();
        foreach($row as $column)
        $pdf->Cell(30,10,$column,1,0,'C');
        }
        $pdf->Output();
    }
    else if(isset($_POST['hr_delreport'])){
        $fac = $_POST['fac'];
        $dept = $_POST['dept'];
        //$leave = $_POST['leave'];
        //$pass = $_POST['pass'];
         class PDF extends FPDF
        {
        // Page header
        function Header()
        {
            // Logo
            $this->Image('img/ap.png',100,5,10);
            $this->Ln(15);
            $this->SetFont('Arial','B',9);
            // Move to the right
            $this->Cell(80);
            // Title
            $this->Cell(30,10,'ADMINISTRATION POLICE TRAINING COLLEGE',0,0,'C');
            // Line break
            $this->Ln(10);
            
            $this->Cell(80);
            $this->Cell(30,10,'DELETED EMPLOYEE LIST',0,0,'C');
            $this->Ln(10);
        }
        
        // Page footer
        function Footer()
        {
            // Position at 1.5 cm from bottom
            $this->SetY(-15);
            // Arial italic 8
            $this->SetFont('Arial','I',8);
            // Page number
            $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
            
        }
        }
        //$query_details = $con->query("SELECT * FROM emp_details WHERE fac =);
        
        $db = new dbObj();
        $connString =  $db->getConnstring();
        $display_heading = array('PNO','Rank','First Name','Middle Name','Last name','DEPT','FACULTY');
        if($dept==null &&$fac==null){
            $result = mysqli_query($connString, "SELECT emp_archives.pno,rank,fname,mname,lname,dept,fac FROM emp_archives JOIN emp_details ON emp_details.pno=emp_archives.pno") or die("database error:". mysqli_error($connString));
        }else if($dept !=null &&$fac==null){
            $result = mysqli_query($connString, "SELECT emp_archives.pno,rank,fname,mname,lname,dept,fac FROM emp_archives JOIN emp_details ON emp_details.pno=emp_archives.pno WHERE emp_details.dept='$dept'") or die("database error:". mysqli_error($connString));
        }else if($dept ==null &&$fac !=null){
            $result = mysqli_query($connString, "SELECT emp_archives.pno,rank,fname,mname,lname,dept,fac FROM emp_archives JOIN emp_details ON emp_details.pno=emp_archives.pno WHERE emp_details.fac='$fac'") or die("database error:". mysqli_error($connString));
        } else if($dept !=null &&$fac !=null){
            $result = mysqli_query($connString, "SELECT emp_archives.pno,rank,fname,mname,lname,dept,fac FROM emp_archives JOIN emp_details ON emp_details.pno=emp_archives.pno WHERE emp_details.dept='$dept' AND emp_details.fac='$fac'") or die("database error:". mysqli_error($connString));
        } 
        
        //$header = mysqli_query($connString, "SHOW COLUMNS FROM emp");
        
        $pdf = new PDF();
        $pdf->SetMargins(5,5);
        
        //header
        $pdf->AddPage();
        //foter page
        $pdf->AliasNbPages();
        
        $pdf->Cell(20,5,' '.date("d M, Y").'',0,1,'R');
        foreach($display_heading as $header) {
        $pdf->Cell(25,10,$header,1,0,'L');
        }
        $pdf->SetFont('Arial','',8);
        $i=0;
        $i++;
        foreach($result as $row) {
        $pdf->Ln();
        foreach($row as $column)
        $pdf->Cell(25,10,$column,1,0,'L');
        }
        $pdf->Output();
    }
        else if(isset($_POST['rank_report'])){
        $rank = $_POST['rnk'];
        //$leave = $_POST['leave'];
        //$pass = $_POST['pass'];
         class PDF extends FPDF
        {
        // Page header
        function Header()
        {
            // Logo
            $this->Image('img/ap.png',100,5,10);
            $this->Ln(15);
            $this->SetFont('Arial','B',9);
            // Move to the right
            $this->Cell(80);
            // Title
            $this->Cell(30,10,'ADMINISTRATION POLICE TRAINING COLLEGE',0,0,'C');
            // Line break
            $this->Ln(10);
            
            $this->Cell(80);
            $this->Cell(30,10,'EMPLOYEE RANK LIST',0,0,'C');
            $this->Ln(10);
        }
        
        // Page footer
        function Footer()
        {
            // Position at 1.5 cm from bottom
            $this->SetY(-15);
            // Arial italic 8
            $this->SetFont('Arial','I',8);
            // Page number
            $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
        }
        }
        //$query_details = $con->query("SELECT * FROM emp_details WHERE fac =);
        
        $db = new dbObj();
        $connString =  $db->getConnstring();
        $display_heading = array('PNO','Rank','First Name','Middle Name','Last name','DEPT','FACULTY');
        
        $result = mysqli_query($connString, "SELECT emp.pno,rank,fname,mname,lname,dept,fac FROM emp JOIN emp_details ON emp_details.pno=emp.pno WHERE emp.rank='$rank'") or die("database error:". mysqli_error($connString));
        //$header = mysqli_query($connString, "SHOW COLUMNS FROM emp");
        
        $pdf = new PDF();
        $pdf->SetMargins(5,5);
        
        //header
        $pdf->AddPage();
        //foter page
        $pdf->AliasNbPages();
        
        $pdf->Cell(20,5,' '.date("d M, Y").'',0,1,'R');
        foreach($display_heading as $header) {
        $pdf->Cell(25,10,$header,1,0,'L');
        }
        $pdf->SetFont('Arial','',8);
        $i=0;
        $i++;
        foreach($result as $row) {
        $pdf->Ln();
        foreach($row as $column)
        $pdf->Cell(25,10,$column,1,0,'L');
        }
        $pdf->Output();
    }else if(isset($_POST['fac_report'])){
       $fac = $_POST['fac'];
        //$leave = $_POST['leave'];
        //$pass = $_POST['pass'];
         class PDF extends FPDF
        {
        // Page header
        function Header()
        {
            // Logo
            $this->Image('img/ap.png',100,5,10);
            $this->Ln(15);
            $this->SetFont('Arial','B',9);
            // Move to the right
            $this->Cell(80);
            // Title
            $this->Cell(30,10,'ADMINISTRATION POLICE TRAINING COLLEGE',0,0,'C');
            // Line break
            $this->Ln(10);
            
            $this->Cell(80);
            $this->Cell(30,10,'FACULTY EMPLOYEE LIST',0,0,'C');
            $this->Ln(10);
        }
        
        // Page footer
        function Footer()
        {
            // Position at 1.5 cm from bottom
            $this->SetY(-15);
            // Arial italic 8
            $this->SetFont('Arial','I',8);
            // Page number
            $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
        }
        }
        //$query_details = $con->query("SELECT * FROM emp_details WHERE fac =);
        
        $db = new dbObj();
        $connString =  $db->getConnstring();
        $display_heading = array('PNO','Rank','First Name','Middle Name','Last name','DEPT','FACULTY');
        if($fac==null){
             $result = mysqli_query($connString, "SELECT emp.pno,rank,fname,mname,lname,dept,fac FROM emp JOIN emp_details ON emp_details.pno=emp.pno ") or die("database error:". mysqli_error($connString));
        }else{
             $result = mysqli_query($connString, "SELECT emp.pno,rank,fname,mname,lname,dept,fac FROM emp JOIN emp_details ON emp_details.pno=emp.pno WHERE emp_details.fac='$fac'") or die("database error:". mysqli_error($connString));
        }
       
        //$header = mysqli_query($connString, "SHOW COLUMNS FROM emp");
        
        $pdf = new PDF();
        $pdf->SetMargins(5,5);
        
        //header
        $pdf->AddPage();
        //foter page
        $pdf->AliasNbPages();
        
        $pdf->Cell(20,5,' '.date("d M, Y").'',0,1,'R');
        foreach($display_heading as $header) {
        $pdf->Cell(25,10,$header,1,0,'L');
        }
        $pdf->SetFont('Arial','',8);
        $i=0;
        $i++;
        foreach($result as $row) {
        $pdf->Ln();
        foreach($row as $column)
        $pdf->Cell(25,10,$column,1,0,'L');
        }
        $pdf->Output();
    }else if(isset($_POST['dept_report'])){
       $dept = $_POST['dept'];
        //$leave = $_POST['leave'];
        //$pass = $_POST['pass'];
         class PDF extends FPDF
        {
        // Page header
        function Header()
        {
            // Logo
            $this->Image('img/ap.png',100,5,10);
            $this->Ln(15);
            $this->SetFont('Arial','B',9);
            // Move to the right
            $this->Cell(80);
            // Title
            $this->Cell(30,10,'ADMINISTRATION POLICE TRAINING COLLEGE',0,0,'C');
            // Line break
            $this->Ln(10);
            
            $this->Cell(80);
            $this->Cell(30,10,'DEPARTMENTAL EMPLOYEE LIST',0,0,'C');
            $this->Ln(10);
        }
        
        // Page footer
        function Footer()
        {
            // Position at 1.5 cm from bottom
            $this->SetY(-15);
            // Arial italic 8
            $this->SetFont('Arial','I',8);
            // Page number
            $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
        }
        }
        //$query_details = $con->query("SELECT * FROM emp_details WHERE fac =);
        
        $db = new dbObj();
        $connString =  $db->getConnstring();
        $display_heading = array('PNO','Rank','First Name','Middle Name','Last name','DEPT','FACULTY');
        if($dept==null){
             $result = mysqli_query($connString, "SELECT emp.pno,rank,fname,mname,lname,dept,fac FROM emp JOIN emp_details ON emp_details.pno=emp.pno") or die("database error:". mysqli_error($connString));
         }else{
             $result = mysqli_query($connString, "SELECT emp.pno,rank,fname,mname,lname,dept,fac FROM emp JOIN emp_details ON emp_details.pno=emp.pno WHERE emp_details.dept='$dept'") or die("database error:". mysqli_error($connString));
         }
       
        //$header = mysqli_query($connString, "SHOW COLUMNS FROM emp");

        $pdf = new PDF();
        $pdf->SetMargins(5,5);
        
        //header
        $pdf->AddPage();
        //foter page
        $pdf->AliasNbPages();
        
        $pdf->Cell(20,5,' '.date("d M, Y").'',0,1,'R');
        foreach($display_heading as $header) {
        $pdf->Cell(25,10,$header,1,0,'L');
        }
        $pdf->SetFont('Arial','',8);
        $i=0;
        $i++;
        foreach($result as $row) {
        $pdf->Ln();
        foreach($row as $column)
        $pdf->Cell(25,10,$column,1,0,'L');
        }
        $pdf->Output();
    }else if(isset($_POST['leave_report'])){
      $rnk = $_POST['rnk'];
       $fac = $_POST['fac'];
       $dept = $_POST['dept']; 
        
         class PDF extends FPDF
        {
        // Page header
        function Header()
        {
            // Logo
            $this->Image('img/ap.png',100,5,10);
            $this->Ln(15);
            $this->SetFont('Arial','B',9);
            // Move to the right
            $this->Cell(80);
            // Title
            $this->Cell(30,10,'ADMINISTRATION POLICE TRAINING COLLEGE',0,0,'C');
            // Line break
            $this->Ln(10);
            
            $this->Cell(80);
            $this->Cell(30,10,'FACULTY EMPLOYEE LIST',0,0,'C');
            $this->Ln(10);
        }
        
        // Page footer
        function Footer()
        {
            // Position at 1.5 cm from bottom
            $this->SetY(-15);
            // Arial italic 8
            $this->SetFont('Arial','I',8);
            // Page number
            $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
        }
        }
        //$query_details = $con->query("SELECT * FROM emp_details WHERE fac =);
        
        $db = new dbObj();
        $connString =  $db->getConnstring();
        $display_heading = array('PNO','First Name','Last name','YEAR','DAYS','START DATE');
        
        $result = mysqli_query($connString, "SELECT emp.pno,fname,Concat(mname,' ',lname)as name,year_applied,days_applied,start_date FROM emp_leave JOIN emp ON emp_leave.pno=emp.pno") or die("database error:". mysqli_error($connString));
        //$header = mysqli_query($connString, "SHOW COLUMNS FROM emp");
        
        $pdf = new PDF();
        $pdf->SetMargins(5,5);
        
        //header
        $pdf->AddPage();
        //foter page
        $pdf->AliasNbPages();
        
        $pdf->Cell(20,5,' '.date("d M, Y").'',0,1,'R');
        foreach($display_heading as $header) {
        $pdf->Cell(25,10,$header,1,0,'L');
        }
        $pdf->SetFont('Arial','',8);
        $i=0;
        $i++;
        foreach($result as $row) {
        $pdf->Ln();
        foreach($row as $column)
        $pdf->Cell(25,10,$column,1,0,'L');
        }
        $pdf->Output();
    }
    else if(isset($_POST['off_report'])){
       $rnk = $_POST['rnk'];
       $fac = $_POST['fac'];
       $dept = $_POST['dept']; 
        //$query_details = $con->query("SELECT * FROM emp_details WHERE fac =);
         class PDF extends FPDF
        {
        // Page header
        function Header()
        {
            // Logo
            $this->Image('img/ap.png',100,5,10);
            $this->Ln(15);
            $this->SetFont('Arial','B',9);
            // Move to the right
            $this->Cell(80);
            // Title
            $this->Cell(30,10,'ADMINISTRATION POLICE TRAINING COLLEGE',0,0,'C');
            // Line break
            $this->Ln(10);
            
            $this->Cell(80);
            $this->Cell(30,10,'EMPLOYEE PASS LEAVE LIST',0,0,'C');
            $this->Ln(10);
        }
        
        // Page footer
        function Footer()
        {
            // Position at 1.5 cm from bottom
            $this->SetY(-15);
            // Arial italic 8
            $this->SetFont('Arial','I',8);
            // Page number
            $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
        }
        }

        $db = new dbObj();
        $connString =  $db->getConnstring();
        $display_heading = array('PNO','First Name','Last name','DAYS','START DATE','REASON');
        
          $result = mysqli_query($connString, "SELECT emp.pno,fname,Concat(mname,' ',lname)as name,days_applied,start_date,reason FROM emp_off JOIN emp ON emp_off.pno=emp.pno") or die("database error:". mysqli_error($connString));
        
        
        //$header = mysqli_query($connString, "SHOW COLUMNS FROM emp");
        
        $pdf = new PDF();
        $pdf->SetMargins(5,5);
        
        //header
        $pdf->AddPage();
        //foter page
        $pdf->AliasNbPages();
        
        $pdf->Cell(20,5,' '.date("d M, Y").'',0,1,'R');
        foreach($display_heading as $header) {
        $pdf->Cell(25,10,$header,1,0,'L');
        }
        $pdf->SetFont('Arial','',8);
        $i=0;
        $i++;
        foreach($result as $row) {
        $pdf->Ln();
        foreach($row as $column)
        $pdf->Cell(25,10,$column,1,0,'L');
        }
        $pdf->Output();
    }
 else if(isset($_POST['lb_report'])){
       $ppno = $_POST['pno'];
      
        //$query_details = $con->query("SELECT * FROM emp_details WHERE fac =);
         class PDF extends FPDF
        {
        // Page header
        function Header()
        {
            // Logo
            $this->Image('img/ap.png',100,5,10);
            $this->Ln(15);
            $this->SetFont('Arial','B',9);
            // Move to the right
            $this->Cell(80);
            // Title
            $this->Cell(30,10,'ADMINISTRATION POLICE TRAINING COLLEGE',0,0,'C');
            // Line break
            $this->Ln(10);
            
            $this->Cell(80);
            $this->Cell(30,10,'LEAVE BALANCES LIST',0,0,'C');
            $this->Ln(10);
        }
        
        // Page footer
        function Footer()
        {
            // Position at 1.5 cm from bottom
            $this->SetY(-15);
            // Arial italic 8
            $this->SetFont('Arial','I',8);
            // Page number
            $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
        }
        }

        $db = new dbObj();
        $connString =  $db->getConnstring();
        $display_heading = array('PNO','First Name','Middle name','Last name','YEAR','DAYS','BALANCE');
        if( $ppno==null){
          $result = mysqli_query($connString, "SELECT emp.pno,fname,mname,lname,year_applied,days_applied,balance FROM emp_leave JOIN emp ON emp_leave.pno=emp.pno") or die("database error:". mysqli_error($connString));
        }else
        {
             $result = mysqli_query($connString, "SELECT emp.pno,fname,mname,lname,year_applied,days_applied,balance FROM emp_leave JOIN emp ON emp_leave.pno=emp.pno where emp.pno='$ppno'") or die("database error:". mysqli_error($connString));
        }
        
        
        //$header = mysqli_query($connString, "SHOW COLUMNS FROM emp");
        
        $pdf = new PDF();
        $pdf->SetMargins(5,5);
        
        //header
        $pdf->AddPage();
        //foter page
        $pdf->AliasNbPages();
        
        $pdf->Cell(20,5,' '.date("d M, Y").'',0,1,'R');
        foreach($display_heading as $header) {
        $pdf->Cell(25,10,$header,1,0,'L');
        }
        $pdf->SetFont('Arial','',8);
        $i=0;
        $i++;
        foreach($result as $row) {
        $pdf->Ln();
        foreach($row as $column)
        $pdf->Cell(25,10,$column,1,0,'L');
        }
        $pdf->Output();
    }
?>
