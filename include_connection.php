<?php
/*
$servername="localhost";
$username="root";
$password="";
$database="test";

$conn = mysqli_connect($servername, $username, $password, $database);

if($conn -> connect_error){
    die("Connection failed". $conn -> connect_error);
}else{
    echo "connnected successfully";
}
*/


function database(){
    static $conn;
    $servername="localhost";
    $username="root";
    $password="";
    $database="test";
    
    if($conn == NULL){
        $conn = mysqli_connect($servername, $username, $password, $database);
    }
    return $conn;
}



//login function 
function login(){
    echo "inside login";
    
    session_start();
    if(!empty($_POST['login_un'])){
        $conn = database();
        $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$_POST[login_un]' AND password = '$_POST[login_pw]'");
        echo "inside login";
        $row = mysqli_fetch_array($result);
        
        
        
        if(!empty($row['username']) && !empty($row['password'])){
            echo "inside login";
            $_SESSION['username'] = $row['username'];
            
            header('Location: tasks.php');
        }else{
            
            header('Location: login.php?error=Invalid username/password');
            
        }
        
    }else{
        header('Location: login.php?error=Please enter login credentials');
    }
}

//get all tasks
function selectAllTasks(){
    $conn = database();
    $result = mysqli_query($conn, "SELECT * FROM task");
    
    if(mysqli_num_rows($result) > 0){
        return $result;
    }
    
}

//get selected task info for update
function getTask($taskid){
    
    $conn = database();
    $result = mysqli_query($conn, "SELECT * FROM task WHERE task_id = '$taskid'");
    
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
        return $row;
    }
}

//get all users' names
function getAllUsers(){
    $conn = database();
    $result = mysqli_query($conn, "SELECT * FROM users");
    
    if(mysqli_num_rows($result) > 0){
        return $result;
    }
}

//task info update
function taskUpdate(){
    
    $conn = database();
    $query = "UPDATE task SET task_name= '$_POST[txt_task_name]', description='$_POST[txt_description]', username='$_POST[selected_user]' where task_id='$_POST[taskid]'";
    
    if(mysqli_query($conn,$query)){ //if success
        header('Location: tasks.php?msg=updated');
    }else{
        header('Location: tasks.php?msg=update failed'.mysqli_error($conn));
    }
    
}

//insert new task
function insertTask(){
    $conn = database();
    $query = "INSERT INTO task (task_name,description,username) VALUES('$_POST[txt_task_name]','$_POST[txt_description]','$_POST[selected_user]')";
    
    if(mysqli_query($conn, $query)){
        header('Location:tasks.php?msg=successfully Inserted');
    }else{
       
        header('Location: tasks.php?msg=insert failed: '.mysqli_error($conn));
    }
        
    
}

//search tasks by task name or description
function searchTasks($text){
    $conn = database();
    $query = "SELECT * from task WHERE task_name LIKE '%$text%' OR description LIKE '%$text%'";
    
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0){
        return $result;
    }
    
}



?>






