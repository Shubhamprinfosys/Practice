<?php
require_once "helper.php";
$obj = new HelperFunction();
session_start();
if (isset($_POST['action']) && $_POST['action'] == "edit") {
    //  $_SESSION['action'] = true;
    $key  = $_POST['key'];
    $data = ($_SESSION['items'][$key]);
    echo json_encode(['email' => $data['email'] ?? '', 'pass' => $data['pass'] ?? '']);

} elseif (isset($_POST['action']) && $_POST['action'] == "create") {
    
    $targetFile = "";
    if(isset($_FILES["fileToUpload"]["name"]) && $_FILES["fileToUpload"]["name"]!=""){
        $targetDirectory = "uploads/"; // Directory where uploaded files will be saved
        $filename = basename($_FILES["fileToUpload"]["name"]);
            if (!is_dir($targetDirectory)) {
                mkdir($targetDirectory, 0755, true);
            }
        $targetFile = $targetDirectory .  $filename;
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile);
    }
    if (!empty($_POST)) {
        $item['email']       = $_POST['email'];
        $item['pass']        = $_POST['pass'];
        if($targetFile!=""){
            $item['file']    = $targetFile;
        }
        // exit;
        if(($_POST['key']!='' && $_POST['key']!=null)){
            // echo "jj";
            $key = $_POST['key'];
            if($targetFile=="" && isset($_SESSION['items'][$key]) && $_SESSION['items'][$key]['file']!=""){
                $item['file'] = $_SESSION['items'][$key]['file'];
            }
            $_SESSION['items'][$key] = $item;
          
        }else{
            // echo 'vvv';
            $_SESSION['items'][] = $item;
        }
        
       
        $view = $obj->getHTMLView();
        echo json_encode(['status' => 'success' ,'msg' => 'Data Saved Successful','view' => $view]);
    }

}elseif(isset($_POST['action']) && $_POST['action'] == "delete"){
    if(($_POST['key']!='' && $_POST['key']!=null)){
        $key                     = $_POST['key'];
        $_SESSION['items'][$key] = [];
    }
    $view = $obj->getHTMLView();
    echo json_encode(['status' => 'success' ,'msg' => 'Record deleted successful','view' => $view]);
}
