<?php
session_start();

include("include_connection.php");

if(isset($_POST['insert_submit'])){
    if(!empty($_POST['txt_task_name']) && !empty($_POST['txt_description']) && !empty($_POST['selected_user'])){
        insertTask();
    }else{
        header('Location:add_task.php?msg=fill all');
    }
    
}

if(isset($_POST['btn_cancel'])){
   
    header('Location:tasks.php');
}

?>
<html>
    <head><title></title></head>
    
    <body>
        
       
        <h3 align="center">Update Task</h3>
        <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
            <table width="500px" align="center" border="1" cellpadding= 5 cellspacing = 0>
                <tr>
                    <td>Task Name</td>
                    <Td><input type="text" name="txt_task_name"/></Td>
                </tr>
                <tr>
                    <td>Task Description</td>
                    <Td><textarea name="txt_description" rows="6" cols="50"></textarea></Td>
                </tr>
                <tr>
                    <td>Assigned User</td>
                    <Td>
                        <select name="selected_user">
                        <?php
                            $users = getAllUsers();
                            while($row = mysqli_fetch_array($users)){
                        
                        ?>
                            <option value="<?php echo $row['username']; ?>" ><?php echo $row['username']; ?></option>
                        <?php    
                            }

                        ?>
                        </select> 
                    </Td>
                </tr>
                <tr>
                    <td><input type="submit" name="insert_submit" value="Insert"/></td>
                    <td><input type="submit" name="btn_cancel" value="Cancel"/></td>
                </tr>
            </table>
        </form>
    </body>
</html>