<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width" />
    <title>Welcome Page</title>
    <script src="jquery.js"></script>
    <link rel="stylesheet" type="text/css" href="CSS/default.css">
    <link rel="stylesheet" type="text/css" href="CSS/header_style.css">
    <script type="text/javascript" src="highcharts.js"></script>
    <script type="text/javascript">
        $.ajax({
        type:"POST",
        url:"check_login.php",
        success:function(msg){
        if(msg=="ok"){
        }
        else{
        alert("Login First");
        window.location="login.html";
        }
        }
        });
        
        $.ajax({
          type:"POST",
          url:"isAdmin.php",
          success:function(msg){
           if(msg=="Send Mail"){
               $("#isadmin").html(msg);
           }
           else{
               $("#isadmin").die();
           }
          }
        });
        
        
    </script>
    <script src="script files/script1.js"></script>
    
    <?php
    require 'db.php';
     ?>
</head>
<body>
    
   <!-- ------------------------------------HEADER--------------------------------------------------- -->
    <div class="wrapper">
        <div id="header">
            <div id="logo">
                <h1>
                    <a href="#" id="home1">Time Tracker</a>
                </h1>
               &nbsp;&nbsp;&nbsp;&nbsp; <i>Logged in as: <?php echo $_COOKIE['name']; ?></i>
            </div>
            <div id="topnav">
                <nav>
                    <ul>
                        <li><a href="#" id="home">Home</a></li>
                        <li><a href="#" title="change password">Account</a>
                            <ul>
                                <li id="password_change"><a href="#">Change password</a></li>
                            </ul>
                        </li>
                        <li><a href="#" title="upload a csv" class="upload_link">Upload</a></li>
                        <li><a href="#" title="download" id="dash_link">Download</a>
                            <ul>
                                <li value="Week Task" id="Week_Task"><a href="#">By Week</a></li>
                                <li value="Month Task" id="Month_task"><a href="#">By Month</a></li>
                                <li value="" id="by_dates"><a href="#">By Dates</a></li>
                            </ul>
                        
                        </li>
                        
                        <li><a href="#" id="dashboard_link" title="view dashboard">Dashboard</a>
                        </li>
                        
                        <li><a href="#" title="logout" id="logout">Logout</a></li>
                        <li><a href="#" id="isadmin"></a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <!-- --------------------------START TASK DROPDOWN------------------------------------------------ -->
    
    <div  class="glassbox" id="startDiv">
        <form method="post"  id="form1">
            <input type="text" name="taskName" placeholder="Enter task name" id="taskName" /><br><br>
            <input type="text" name="project" placeholder="Enter the project" id="project" /><br><br>
             From:<select id="from_hour" name="from_hour">
                <option>00</option>
                <option>01</option>
                <option>02</option>
                <option>03</option>
                <option>04</option>
                <option>05</option>
                <option>06</option>
                <option>07</option>
                <option>08</option>
                <option>09</option>
                <option>10</option>
                <option>11</option>
                <option>12</option>
                <option>13</option>
                <option>14</option>
                <option>15</option>
                <option>16</option>
                <option>17</option>
                <option>18</option>
                <option>19</option>
                <option>20</option>
                <option>21</option>
                <option>22</option>
                <option>23</option>
            </select>
            <select id="from_min" name="from_min">
                <option>00</option>
                <option>05</option>
                <option>10</option>
                <option>15</option>
                <option>20</option>
                <option>25</option>
                <option>30</option>
                <option>35</option>
                <option>40</option>
                <option>45</option>
                <option>50</option>
                <option>55</option>
            </select>
              <input type="date" id="start_date"><br><br>
             
          To:<select id="to_hour" name="to_hour">
                 <option>00</option> 
                 <option>01</option>
                 <option>02</option>
                 <option>03</option>
                 <option>04</option>
                 <option>05</option>
                 <option>06</option>
                 <option>07</option>
                 <option>08</option>
                 <option>09</option>
                 <option>10</option>
                 <option>11</option>
                 <option>12</option>
                 <option>13</option>
                 <option>14</option>
                 <option>15</option>
                 <option>16</option>
                 <option>17</option>
                 <option>18</option>
                 <option>19</option>
                 <option>20</option>
                 <option>21</option>
                 <option>22</option>
                 <option>23</option>
            </select>
            <select id="to_min" name="to_min">
                 <option>00</option>
                 <option>05</option>
                 <option>10</option>
                 <option>15</option>
                 <option>20</option>
                 <option>25</option>
                 <option>30</option>
                 <option>35</option>
                 <option>40</option>
                 <option>45</option>
                 <option>50</option>
                 <option>55</option>
            </select>
          <input type="date" id="end_date"><br><br>
             <input type="button" value="Submit" id="enterBtn" class="button"/>
             <a href="" id="cancel" title='cancel'>X</a>
        </form>
    </div>
    
    <div id="messages"></div>
       
    <!-- -----------------------------TASK PAGE------------------------------------------------------- -->
    <div id="mybox">
        <?php include_once './taskPage.php';?>
        
    </div>
       
    <!-- ---------------------------CHANGE PASSWORD--------------------------------------------------- -->
    <div id="change_password" class="glassbox">
        <form method="post">
            <a href="" id="cancel">X</a>
            <input type="password" placeholder="old password" id="old_password"><br><br>
            <input type="password" placeholder="new password" id="new_password"><br><br>
            <input type="button" value="Change" class="button" id="change_pass_button">
        </form>
    </div>
      
      <!-- -----------------------------DASHBOARD-------------------------------------------------------- -->
    
     
      <!-- ------------------------------UPLOAD---------------------------------------------------------- -->
    <div id='upload_div' class="glassbox">
        <?php include 'upload.html'; ?>
    </div>
   
 <!-----------------------------------CHARTS---------------------------------------------------------------->     
 <div align="left" id="options">
         <p><input type="radio" name="choice" id="by_tasks">Tasks
         (<a href="#" id="pie_link" class="links">click to open in new window</a>)</p>
         <p><input type="radio" name="choice" id="by_projects">Projects
         (<a href="#" id="column_link" class="links">click to open in new window</a>)</p>
         <p><input type="radio" name="choice" id="by_users">Users
         (<a href="#" id="line_link" class="links">click to open in new window</a>)</p>
 </div>
 
 <div id="pie_div" align="center">
     <?php include './pie_chart.html'; ?>
 </div>
 
 <div id="line_div" align="center">
     <?php include './line graph/line_chart.php'; ?>
 </div>
 
 <div id="column_div" align="center">
     <?php include 'column_chart.php'; ?>
 </div>
 
 <!--------------------------------------DOWNLOAD BY DATES ------------------------------------------------->
 <div id="download_by_dates" class="glassbox" align="center">
     <br>
    From: <input type="date" id="fromDate" name="fromDate"><br><br>
    To:  <input type="date" id="toDate" name="toDate"><br><br>
     <br>
     <input type="button" value="Download" id="DownloadTask">
     <a href="" id="cancel">X</a>
 </div>
 <!----------------------------------IS ADMIN DIV ---------------------------------------------------------->
 
</body>
</html>