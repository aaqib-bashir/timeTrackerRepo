<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width" />
        <title>Task Page</title>
        <?php require 'db.php'; 
        ?>
        <script type='text/javascript' src='jquery-2.1.0.js'></script>
        <script src="script files/script2.js"></script>
        <link rel="stylesheet" type="text/css" href="CSS/default.css">
    </head>
    <body>
        
        <!----------------------------------------------TASK TABLE---------------------------------------------------------->
       <?php
       if( isset($_COOKIE["userid"]))
                {
           ?>
        <div id="taskTable">
            <table align="center" class="" id="task_table">
                <thead>
                    <tr>
                        <td colspan="3"><input type="text" placeholder="Enter the task name" id="task_start"/></td>
                        <td colspan="3"><input type="text" placeholder="Enter project" id="project_start"></td>
                        <td colspan="2"><input type="button" value="Start" id="start_button" class="button"/>
                        <input type="button" value="End" id="end_button" class="button"/></td>
                    </tr>
                    
                    <tr>
                        <th>Task Name</th>
                        <th>Project</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        
                        <th>Duration</th>
                        <th>Delete Task</th>
                        <th>Restart Task</th>
                        <th>Edit Task</th>
                    </tr>
                </thead>
                
                <tfoot>
                    <tr>
                       <td colspan="8">
                                <div id="add_task_span"><b>Add a completed task</b></div>
                            </td> 
                            
                    </tr>
                </tfoot>
               
                    
                <tbody id="tbody">
   
                <?php
                $userid=$_COOKIE["userid"];
                $result=  mysql_query("select * from task where userid='$userid' order by taskid desc");
                while ($row = mysql_fetch_array($result)) 
                {
                    $id=$row['taskid'];
                    $TaskName=$row['taskname'];
                    $Project=$row['project'];
                    $StartTime=$row['starttime'];
                    $EndTime=$row['endtime'];
                    $Duration=$row['duration'];
                
                   // $dur=(strtotime($EndTime)-strtotime($StartTime))/60;  
                ?>
                
               
                
               
                    <tr id="<?php echo $id ?>" class="edit_tr">
                        <td class="edit_td">
                            <span id="taskname_<?php echo $id ?>" class="text"><b><?php echo $TaskName; ?></b></span>
                            
                        </td>
                        
                        <td class="edit_td">
                            <span id="project_<?php echo $id ?>" class="text"><?php echo $Project; ?></span>
                            
                        </td>
                        
                        <td class="edit_td">
                            <span id="starttime_<?php echo $id; ?>" class="text"><?php echo $StartTime; ?></span>
                               
                        </td>
                        
                        <td class="edit_td">
                            <span id="endtime_<?php echo $id ?>" class="text"><?php echo $EndTime; ?></span>
                            
                        </td>
                        
                        <td>
                            <span id="duration"><b><?php echo $Duration; ?></b></span>
                        </td>
                        
                        <td>
                            <a href='#' id='<?php echo $id ?>' title='delete this task' class='delete_task_icon'>
                                <img src='images/delete.png' height='20px' width='30px' title="delete task">
                            </a>
                        </td>
                        
                        <td>
                            <a href="#" id='<?php echo $TaskName; ?>' project="<?php echo $Project; ?>" title='restart this task' class='restart_task_icon'>
                                <img src='images/reload.png' height='20px' width='30px' title="restart task">
                            </a>
                        </td>
                        
                        <td id="<?php  echo $id ?>">
                            <input type="hidden" value="<?php echo $id ?>" id="task_id">
                            <a href="#" class="edit_task_icon" edit="<?php echo $id; ?>" id="edit_icon_<?php echo $id ?>" 
                               taskname="<?php echo $TaskName; ?>" project="<?php echo $Project; ?>" title="Edit this task">
                                <img src="images/edit.png" width="20px" height="20px" title="edit task"></a>
                           
                        </td>
                        
                    </tr>
                
                <?php } 
                
                }
                else{
                   echo "login first";
                   header('Location:index.html');
                }
                ?>
               
                </tbody>
            </table> 
        </div>
    </body>
</html>