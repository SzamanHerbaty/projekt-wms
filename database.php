<?php
include_once('config.php');

function getConnection() {
    global $dbHost, $dbName, $dbUser, $dbPassword;
    $connection = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);
    if($connection->connect_errno) {
        $connection->close();
        die('Database connection problem');
    }
    return $connection;
}
function getAllPosts() {
    $connection = getConnection();
    $sql = 'SELECT posts.id As id, posts.title As title, categories.name As categoryName From posts Inner Join categories On posts.categoryId=categories.id';
    $result = $connection->query($sql);
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    $connection->close();
    return $rows;
}
function getAllPosts() {
    $connection = getConnection();
    $sql = 'SELECT posts.id As id, posts.title As title, posts.content As content, post.createdAt As createdAt, categories.name As categoryName, admins.firstName As firstName, admins.lastName As lastName From posts Inner Join categories On posts.categoryId=categories.id Inner Join admins On posts.authorId=admins.id Where id = $id';
    $result = $connection->query($sql);
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    $connection->close();

    if(count($rows) == 0){
        header('Location: 404.php');
        exit();
    }
    return $rows[0];
}