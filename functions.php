<?php
include 'BaseClass.php';
include "User.php";
$conn = mysqli_connect('45.15.23.59','root','Sco@l@it123','national-03-andrei');
$salt = ']1md5!A00pLog2.3';
session_start();

function checkLogin(){
    if (!isset($_SESSION['user_id'])) {
        header('Location: autovit_login.php');
    }
}

function runQuery($queryParam) {
    global $conn;
    $query = mysqli_query($conn, $queryParam);
    if(!$query) {
        die("MySql error on query: $queryParam -".mysqli_error($conn));
    }
    if(is_bool($query)){
        return mysqli_insert_id($conn);
    } else {
        return $query->fetch_all(MYSQLI_ASSOC);
    }

}

function readTable ($tableName) {

    $sql = "SELECT * FROM $tableName;";
    return runQuery($sql);
}

function displayData($data) {
    $columns = array_keys($data[0]);

    ?>
    <table class="table">
        <tr>
            <?php
            foreach ($columns as $column):?>
                <th>
                    <?php  echo $column ;?>
                </th>
            <?php  endforeach;?>
        </tr>
        <?php
        foreach ($data as $line):
            ?>
            <tr>
                <?php foreach($line as $value): ?>
                    <td> <?php echo $value ?></td>
                <?php endforeach;?>
            </tr>
        <?php endforeach;?>
    </table>
    <?php

}

function findBy($tableName,$filterColumn=null, $filterValue=null,$orderColumn=null, $orderDir='ASC', $limit=null,$offset=0 ) {
    $sql = "SELECT * FROM $tableName " ;

    if(!is_null($filterColumn)){
        $sql .= " WHERE $filterColumn='$filterValue'";
    }
    if(!is_null($orderColumn)){
        $sql .= " ORDER BY $orderColumn $orderDir";
    }
    if(!is_null($limit)){
        $sql .= " LIMIT $offset,$limit;";;
    }
    return runQuery($sql);
}

function findOneBy($tableName, $filterColumn=null, $filterValue=null,$orderColumn=null, $orderDir='ASC',$offset=0){
    $data = findBy($tableName, $filterColumn, $filterValue,$orderColumn,$orderDir, 1, $offset);
    return $data[0];
}

function findAll ($tableName,$orderColumn=null,$orderDir='ASC' ) {
    return findBy($tableName, null, null, $orderColumn, $orderDir);

}

