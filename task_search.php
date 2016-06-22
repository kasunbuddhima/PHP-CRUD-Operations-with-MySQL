<?php

session_start();

include("include_connection.php");

if(isset($_POST['add_new'])){
    header('Location: add_task.php');
}

if(isset($_POST['search_submit'])){
    searchTasks($_POST['txt_search_task']);
}



?>
<html>
    <head><title></title></head>
    
    <body>
        <h3 align="center">Tasks list</h3>
        <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
            <Table width="800px" align="center" border="0" cellpadding= 5 cellspacing = 0>
                <tr>
                    <td width="700px"><input type="submit" name="add_new" value="Add Task"/></td>
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
                $result = selectAllTasks();
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