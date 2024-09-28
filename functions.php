


<?php

function connectToDatabase()
{
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=contacts', 'root', 'Vaibhavi#24');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        return $pdo;
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }
}

function dd($var)
{
    var_dump($var);
    exit;
}

function selectAll($table)
{
    $pdo = connectToDatabase();
    
    $query = 'SELECT * FROM ' . $table;

    $statement = $pdo->prepare($query);
    $statement->execute();

    return $statement->fetchAll(PDO::FETCH_CLASS, \Models\Contact::class);
}

function create($table, $fields)
{
    $pdo = connectToDatabase();

    $query = "INSERT INTO $table SET ";
    foreach ($fields as $field => $value) {
        $query .= "$field = :$field, "; 
    }

    $query = trim($query, ', '); 

    $statement = $pdo->prepare($query);
    
    
    foreach ($fields as $field => $value) {
        $statement->bindValue(":$field", $value);
    }

    $statement->execute();
}

function delete($table, $id)
{
    $pdo = connectToDatabase();

    $query = "DELETE FROM $table WHERE id = :id"; 
    $statement = $pdo->prepare($query);
    $statement->bindValue(':id', $id, PDO::PARAM_INT); 

    $statement->execute();
}


?>
