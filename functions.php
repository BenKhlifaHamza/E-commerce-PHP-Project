<?php

define("MB", 1048576);

function filterRequest($requestname)
{
    return  htmlspecialchars(strip_tags($_POST[$requestname]));
}

function getAllData($table, $where = null, $values = null , $json = true)
{
    global $con;
    $data = array(); 
    if($where == null){
        $stmt = $con->prepare("SELECT  * FROM $table");
    }else{
        $stmt = $con->prepare("SELECT  * FROM $table WHERE   $where ");
    }
    $stmt->execute($values);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $count  = $stmt->rowCount();
  if($json == true){
    if ($count > 0) {
        echo json_encode(array("status" => "success", "data" => $data));
    } else {
        echo json_encode(array("status" => "failure"));
    }
    return $count;
  }else{
    if($count>0){
        return $data;
    }else{
        json_encode(array("status" => "failure"));
    }
  }  
}

function getData($table, $where = null, $values = null, $returnData = false)
{
    global $con;
    $data = array();
    $stmt = $con->prepare("SELECT  * FROM $table WHERE   $where ");
    $stmt->execute($values);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    $count  = $stmt->rowCount();
    if ($returnData && $count > 0) {
        return $data;
    }
    if ($count > 0) {
        echo json_encode(array("status" => "success", "data" => $data));
    } else {
        echo json_encode(array("status" => "failure"));
    }    
    return $count;
}

function insertData($table, $data, $json = true)
{
    global $con;
    foreach ($data as $field => $v)
        $ins[] = ':' . $field;
    $ins = implode(',', $ins);
    $fields = implode(',', array_keys($data));
    $sql = "INSERT INTO $table ($fields) VALUES ($ins)";
    $stmt = $con->prepare($sql);
    foreach ($data as $f => $v) {
        $stmt->bindValue(':' . $f, $v);
    }

    $stmt->execute();
    $count = $stmt->rowCount();
    if ($json == true) {
        if ($count > 0) {
            echo json_encode(array("status" => "success"));
        } else {
            echo json_encode(array("status" => "failure"));
        }
    }
    return $count;
}


function updateData($table, $data, $where, $json = true)
{
    global $con;
    $cols = array();
    $vals = array();

    foreach ($data as $key => $val) {
        $vals[] = "$val";
        $cols[] = "`$key` =  ? ";
    }
    $sql = "UPDATE $table SET " . implode(', ', $cols) . " WHERE $where";
    $stmt = $con->prepare($sql);
    $stmt->execute($vals);
    $count = $stmt->rowCount();
    if ($json == true) {
        if ($count > 0) {
            echo json_encode(array("status" => "success"));
        } else {
            echo json_encode(array("status" => "failure"));
        }
    }
    return $count;
}

function deleteData($table, $where, $json = true)
{
    global $con;
    $stmt = $con->prepare("DELETE FROM $table WHERE $where");
    $stmt->execute();
    $count = $stmt->rowCount();
    if ($json == true) {
        if ($count > 0) {
            echo json_encode(array("status" => "success"));
        } else {
            echo json_encode(array("status" => "failure"));
        }
    }
    return $count;
}

function imageUpload($direction, $imageRequest)
{
    if (isset($_FILES[$imageRequest])) {
        global $msgError;
        $imagename  = rand(1000, 10000) . $_FILES[$imageRequest]['name'];
        $imagetmp   = $_FILES[$imageRequest]['tmp_name'];
        $imagesize  = $_FILES[$imageRequest]['size'];
        $allowExt   = array("jpg", "png", "gif", "mp3", "pdf", "svg");
        $strToArray = explode(".", $imagename);
        $ext        = end($strToArray);
        $ext        = strtolower($ext);
        if (!empty($imagename) && !in_array($ext, $allowExt)) {
            $msgError = "EXT";
        }
        if ($imagesize > 2 * MB) {
            $msgError = "size";
        }
        if (empty($msgError)) {
            move_uploaded_file($imagetmp, $direction . $imagename);
            return $imagename;
        } else {
            return "fail";
        }
    } else {
        return "empty";
    }
}


function deleteFile($dir, $imagename)
{
    if (file_exists($dir.$imagename)) {
        unlink($dir.$imagename);
    }
}

function checkAuthenticate()
{
    if (isset($_SERVER['PHP_AUTH_USER'])  && isset($_SERVER['PHP_AUTH_PW'])) {
        if ($_SERVER['PHP_AUTH_USER'] != "******" ||  $_SERVER['PHP_AUTH_PW'] != "******") {
            header('WWW-Authenticate: Basic realm="My Realm"');
            header('HTTP/1.0 401 Unauthorized');
            echo 'Page Not Found';
            exit;
        }
    } else {
        exit;
    }
}

function result($count){
    if($count>0){
        printSuccess();
    }else{
        printFailure();
    }
}

function   printFailure($message = "none") 
{
echo     json_encode(array("status" => "failure" , "message" => $message));
}

function   printSuccess($message = "none") 
{
echo     json_encode(array("status" => "success" , "message" => $message));
}

function sendEmail($to , $title , $body){
$header = "From: support@benkhlifahamza.com " . "\n" . "CC: superhamza@gmail.com" ; 
mail($to , $title , $body , $header) ; 
}

function sendGCM($title, $message, $topic, $pageid, $pagename)
{
    $url = 'https://fcm.googleapis.com/fcm/send';
    $fields = array(
        "to" => '/topics/' . $topic,
        'priority' => 'high',
        'content_available' => true,

        'notification' => array(
            "body" =>  $message,
            "title" =>  $title,
            "click_action" => "FLUTTER_NOTIFICATION_CLICK",
            "sound" => "default"
        ),
        'data' => array(
            "pageid" => $pageid,
            "pagename" => $pagename
        )
    );
    $fields = json_encode($fields);
    $headers = array(
        'Authorization: key=' . "YOUR-KEY",
        'Content-Type: application/json'
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    $result = curl_exec($ch);
    return $result;
    curl_close($ch);
}

function insertNotification($user_id , $notification_title , $notification_body , $topic ,$page_id ,$page_name ){
        global $con ;
        $stm = $con->prepare("INSERT INTO `notifications` (notification_title , notification_body , notification_user_id) VALUES (? , ? , ?)");
        $stm-> execute(array($notification_title, $notification_body , $user_id ));
        sendGCM($notification_title , $notification_body , $topic , $page_id , $page_name);
        $count = $stm->rowCount();
        return $count;
}