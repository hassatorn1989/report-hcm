<html>
<head>
<title>ThaiCreate.Com PHP & SQL Server (sqlsrv)</title>
</head>
<body>
<?php
    	$serverName = "HHN-DEVSQL\WEBSERVER, 1433"; //serverName\instanceName ถ้าฐานข้อมูลอยู่ในเครื่องเราใช้ localhost
        $connectionInfo = array(
            "Database" => "HCM",
            "UID" => "hcm",
            "PWD" => "P@ssw0rd",
            "MultipleActiveResultSets"=>true,
            "CharacterSet"  => 'UTF-8'
        );
        
        $conn = sqlsrv_connect( $serverName, $connectionInfo);
        
        if ( $conn ) {
            echo "Connection established.<br />";
        } else {
            echo "Connection could not be established.<br />";
            die( print_r( sqlsrv_errors(), true));
        }
?>
</body>
</html>
