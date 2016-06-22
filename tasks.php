<?php

session_start();

include("include_connection.php");


static $search_result = "";
if(isset($_POST['search_submit'])){
    
    $search_result = searchTasks($_POST['txt_search_task']);
    if(empty($search_result)){
        header('Location: tasks.php?err=no match found');
    }  
}

?>

<html>
    <head><title></title></head>
    
    <body>
        <h3 align="center">Tasks list</h3>
        <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
            <Table width="800px" align="center" border="0" cellpadding= 5 cellspacing = 0>
                <tr>
                    <td width="700px"><input type="button" name="add_new" value="Add Task" onClick="location.href='add_task.php'"/></td>
                    <td><input type="search" name="txt_search_task"/></td>
                    <td><input type="submit" name="search_submit" value="Search"/></td>
                </tr>
            </Table>
            
        </form>
        <table width="800px" align="center" border="1" cellpadding= 5 cellspacing = 0>
            <tr>
                <td>#No</td>
                <td>Task Name</td>
                <td>Task Description</td>
                <td>Assigned User</td>
                <td>Update</td>
            </tr>
            <?php
                $result;
                if(!empty($search_result)){ //task search reslut loading
                    $result = $search_result;
                    echo "Search results with: ".$_POST['txt_search_task'];
                }else{  //normal tasks loading
                    $result = selectAllTasks(); 
                    
                }
                
                $count = 1;
                while($row = mysqli_fetch_array($result)){
                    ?>
            <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['task_name'] ?></td>
                <td><?php echo $row['description'] ?></td>
                <td><?php echo $row['username'] ?></td>
                <td><a href="update_task.php?taskid=<?php echo $row['task_id'] ?>">update</a></td>
            </tr>
            <?php
                $count++;
                }
            
            ?>
            
        </table>
    </body>
</html>