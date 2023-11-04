<?php
session_start();
if (isset($_POST['action']) && $_POST['action'] == "edit") {
    //  $_SESSION['action'] = true;
    $key  = $_POST['key'];
    $data = ($_SESSION['items'][$key]);
    echo json_encode(['email' => $data['email'] ?? '', 'pass' => $data['pass'] ?? '']);

} elseif (isset($_POST['action']) && $_POST['action'] == "create") {
    if (!empty($_POST)) {
        $item['email']       = $_POST['email'];
        $item['pass']        = $_POST['pass'];
        if(($_POST['key']!='' && $_POST['key']!=null)){
            // echo "jj";
            $key = $_POST['key'];
            $_SESSION['items'][$key] = $item;
        }else{
            // echo 'vvv';
            $_SESSION['items'][] = $item;
        }
        // exit();
        echo json_encode(['status' => 'success' ,'msg' => 'Data Saved Successful']);
    }

}
