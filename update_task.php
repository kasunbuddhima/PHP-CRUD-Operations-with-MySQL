<?php
session_start();

include("include_connection.php");

if(isset($_POST['update_submit'])){
    taskUpdate();
}

if(isset($_POST['btn_cancel'])){
   
    header('Location:tasks.php');
}
?>
<html>
    <head><title></title></head>
    
    <body>
        
        <?php
        $taskid;
        if(isset($_GET['taskid'])){
            $taskid = $_GET['taskid'];
        }
        $array = getTask($taskid);
        
        ?>
        <h3 align="center">Update Task</h3>
        <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
            <table width="500px" align="center" border="1" cellpadding= 5 cellspacing = 0>
                <tr>
                    <td>Task Name <input type="hidden" name="taskid" value="<?php echo $array['task_id']; ?>"/> </td>
                    <Td><input type="text" name="txt_task_name" value="<?php echo $array['task_name']; ?>"/></Td>
                </tr>
                <tr>
                    <td>Task Description</td>
                    <Td><textarea name="txt_description" rows="6" cols="50"><?php echo $array['description']; ?></textarea></Td>
                </tr>
                <tr>
                    <td>Assigned User</td>
                    <Td>

                        <select name="selected_user">
                        <?php
                            $users = getAllUsers();
                            while($row = mysqli_fetch_array($users)){
                                if($row['username'] == $array['username']){
                        ?>
                            <option value="<?php echo $row['username']; ?>" selected><?php echo $row['username']; ?></option>   
                        <?php
                                }else{
                        ?>
                            <option value="<?php echo $row['username']; ?>" ><?php echo $row['username']; ?></option>
                        <?php
                                }
                        ?>



                        <?php    
                            }

                        ?>
                        </select>                 
                    </Td>
                </tr>
                <tr>
                    <td><input type="submit" name="update_submit" value="Update"/></td>
                    <td><input type="submit" name="btn_cancel" value="Cancel"/></td>
                </tr>
            </table>
        </form>
    </body>
</html>