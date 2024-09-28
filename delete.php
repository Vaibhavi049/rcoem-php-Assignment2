<?php
require 'vendor/autoload.php';

if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $Email = $_POST['email'];
    $Phone = $_POST['phone'];

    $fields=[
        'name' =>$name,
        'email'=>$Email,
        'phone'=>$Phone
    ];
    delete('contacts', $fields);
    
    header('Location: index.php');
    exit;
}

include 'views/delete.view.php';