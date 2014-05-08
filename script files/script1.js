    
    function duration(startdate, enddate, starttime, endtime){
	var sd=new Date(startdate);
	var ed=new Date(enddate);
	var std=starttime.split(":");
	var etd=endtime.split(":");
	sd.setHours(std[0],std[1],std[2]);
	ed.setHours(etd[0],etd[1],etd[2]);
	var sdm=sd.getTime();
	var edm=ed.getTime();
	var t=edm-sdm;
	function msToTime(s) {
            var ms = s % 1000;
            s = (s - ms) / 1000;
            var secs = s % 60;
           s = (s - secs) / 60;
            var mins = s % 60;
          var hrs = (s - mins) / 60;

         return hrs + ':' + mins + ':' + secs;
         }
         return msToTime(t);
	}
    
    function validateDuration(d){
                    var h=d.split(":");
                    if(h[0]<0){
                        return false;
                    }
                    else{
                        return true;
                    }
                }
    
//ADD COMPLETED TASK-------------------------------------------------------------------
    $(function() {    
        $("#add_task_span").click(function(){
            $("#startDiv").show();
            $("#enterBtn").click(function()
            {   
                $("#startDiv").hide();
                var taskname = $("#taskName").val().toLowerCase();
                var project = $("#project").val().toLowerCase();
                if(project==""){
                    project="others";
                }
                var from_hour=$("#from_hour").val();
                var from_min=$("#from_min").val();
        
                var to_hour=$("#to_hour").val();
                var to_min=$("#to_min").val();
        
                var starttime=from_hour+":"+from_min+":"+0;
                var endtime=to_hour+":"+to_min+":"+0;
                
                //duration validation
               /* if((from_min>to_min)&&(from_hour<to_hour)){
                    var hours=(to_hour-from_hour)-1;
                    var mins=(to_min-from_min)+60;
                    var duration=hours+":"+mins+":"+0;
                }
                else{
                    var duration=(to_hour-from_hour)+":"+(to_min-from_min)+":"+0;
                }*/
                
                var startdate=$("#start_date").val();
                var enddate=$("#end_date").val();
                var durations=duration(startdate,enddate,starttime,endtime);
                
                
                //alert(durations);
                var info="taskName="+taskname +"&project="+project+"&startTime="+starttime+"&endTime="+endtime+"&startDate="+startdate+"&enddate="+enddate+"&duration="+durations;
                //alert(info);
                if(taskname=="" || starttime=="" || endtime=="" || startdate=="" || validateDuration(durations)==false){
                    $("#messages").html("<b>Please enter the valid data</b>").fadeOut(5000);
                }
                
                else{
                    $.ajax({
                        type: "POST",
                        url: "addTask.php",
                        data: info,
                        success: function(msg){
                            //window.location.reload();
                            $("#task_table").load("taskPage.php");
                            //$("#tbody").html(msg);
                        }
                    });
                }   //end of else
            });
        });
    });
    
 //CHANGE PASSWORD--------------------------------------------------------------
 $(function(){
     $("#change_password").hide();
     $("#password_change").click(function(){
        $("#change_password").slideDown();
        $("#change_pass_button").click(function(){
            $("#change_password").hide();
            var old_pass=$("#old_password").val();
            var new_pass=$("#new_password").val();
            var info="oldpassword="+old_pass+"&newpassword="+new_pass;
            $.ajax({
               type:"POST",
               url:"changePassword.php",
               data:info,
               success:function(msg){
                   if(msg=="ok"){
                       alert("login First");
                       window.location="login.html";
                   }
                   else{
                  $("#messages").html("<b>"+msg+"</b>").fadeOut(7000); 
               }
           }
            });
        });
     });
  });
 
//DOWNLOAD VIEWING------------------------------------------------------------
/*$(function(){
$("#dashboard_div").hide();
$("#dash_link").click(function(){
    $("#taskTable").hide();
    $("#dashboard_div").show();
});
});*/


$(function(){
   
   $("#Month_task").click(function(){
		$.ajax({
			type:'POST',
			url:"monthTask.php",
			success: function(msg){
				var data = msg.split(",");
				var newData="";
				for(var i=1;i<data.length-2;i=i+7){
					newData = newData+data[i]+","+data[i+1]+","+data[i+2]+","+data[i+3]+","+data[i+4]+","+data[i+5]+","+data[i+6]+"\n";
					}
$("#Month_task").append('<form id="exportform" action="export.php" method="post" target="_blank"><input type="hidden" id="exportdata" name="exportdata" /></form>');
	$("#exportdata").val();
	$("#exportdata").val(newData);
    $("#exportform").submit().remove();
    return true; 
				}
			});
		});
   
   $("#Week_Task").click(function(){
		$.ajax({
			type:'POST',
			url:"weekTask.php",
			success: function(msg){
				var data = msg.split(",");
				var newData="";
				for(var i=1;i<data.length-2;i=i+7){
					newData = newData+data[i]+","+data[i+1]+","+data[i+2]+","+data[i+3]+","+data[i+4]+","+data[i+5]+","+data[i+6]+"\n";
					}
$("#Week_Task").append('<form id="exportform" action="export.php" method="post" target="_blank"><input type="hidden" id="exportdata" name="exportdata" /></form>');
	$("#exportdata").val();
	$("#exportdata").val(newData);
    $("#exportform").submit().remove();
    return true; 
				}
			});
		});
   
$("#DownloadTask").click(function(){
	var fromDate=$("#fromDate").val();
	var toDate=$("#toDate").val();
		$.ajax({
			type:'POST',
			data:"fromDate="+fromDate+"&toDate="+toDate,
			url:"downloadTask.php",
			success: function(msg){
				var data = msg.split(",");
				var newData="";
				for(var i=1;i<data.length-2;i=i+7){
					newData = newData+data[i]+","+data[i+1]+","+data[i+2]+","+data[i+3]+","+data[i+4]+","+data[i+5]+","+data[i+6]+"\n";
					}
$("#DownloadTask").append('<form id="exportform" action="export.php" method="post" target="_blank"><input type="hidden" id="exportdata" name="exportdata" /></form>');
	$("#exportdata").val();
	$("#exportdata").val(newData);
    $("#exportform").submit().remove();
    return true; 
				}
			});
	});
        });





$(function(){
$("#download_by_dates").hide();
$("#by_dates").click(function(){
    $("#download_by_dates").slideDown();
});
});
$(function(){
$("#home").click(function(){
    $("#taskTable").show();
    $("#dashboard_div").hide();
});
});

//EDIT TASK---------------------------------------------------------
$(function(){
$(".edit_task_icon").click(function(){
    var ID=$(this).attr("edit");
    $("#startDiv").slideDown();
    var taskname=$(this).attr("taskname");
    var project=$(this).attr("project");
    document.getElementById('taskName').value=taskname;
    document.getElementById('project').value=project;
    document.getElementById('enterBtn').value="Save";
    $("#enterBtn").click(function(){
        $("#startDiv").hide();
        var taskName=$("#taskName").val().toLowerCase();
        var Project=$("#project").val().toLowerCase();
        if(Project==""){
            Project="others";
        }
        var from_hour=$("#from_hour").val();
        var from_min=$("#from_min").val();
        /*var from_day=$("#from_day").val();
        var from_month=$("#from_month").val();
        var from_year=$("#from_year").val();*/
               
        var to_hour=$("#to_hour").val();
        var to_min=$("#to_min").val();
        
        var starttime=from_hour+":"+from_min+":"+0;
        var endtime=to_hour+":"+to_min+":"+0;
        var startdate=$("#start_date").val();
        var enddate=$("#end_date").val();
        var durations=duration(startdate,enddate,starttime,endtime);
        var info="id="+ID+"&taskName="+taskName +"&project="+Project+"&startTime="+starttime+"&endTime="+endtime+"&startDate="+startdate+"&enddate="+enddate+"&duration="+durations;
        //var duration=(to_hour-from_hour)+":"+(to_min-from_min)+":"+0;
        if(taskname=="" || starttime=="" || endtime=="" || startdate=="" || validateDuration(durations)==false){
                    $("#messages").html("<b>Please enter the valid data</b>").fadeOut(5000);
                }
                else{
        $.ajax({
            type:"POST",
            url:"editTask.php",
            data:info,
            success:function(){
                $("#task_table").load("taskPage.php");
            }
        });}
    });
});
});
  
//LOGOUT------------------------------------------------------------------------
$(function(){
$("#logout").click(function(){
    $.ajax({
        type:"POST",
        url:"logout.php",
        success:function(msg){
           window.location="login.html";
        }
    });
});
});

//UPLOAD------------------------------------------------------------------------
$(function(){
$("#upload_div").hide();
$(".upload_link").click(function(){
    $("#upload_div").slideDown();
    $("#upload").click(function(){
        $("#upload_div").hide();
    });
});
});

//CHARTS------------------------------------------------------------------------
/*$(function(){
$("#chart_div").hide();
$("#dashboard_link").click(function(){
    //$("#taskTable").hide();
    //$("#dashboard_div").hide();
    $("#chart_div").show();
    $("#by_project").click(function(){
        var myWindow=window.open("column_chart.php","","width=700,height=600");
    });
    $("#by_users").click(function(){
        var myWindow=window.open("line_chart.php","","width=700,height=600");
    });
    $("#by_tasks").click(function(){
        var myWindow=window.open("pie_chart.html","","width=700,height=600");
    });
    //$("#chart_view").show();
    });
});
/*$(function(){
$("#dashboard_link").click(function(){
    var myWindow=window.open("line_chart.php","","width=700,height=600");
});
});*/

$(function(){
$("#pie_div").hide();
$("#line_div").hide();
$("#options").hide();
$("#column_div").hide();
$("#dashboard_link").click(function(){
    $("#taskTable").hide();
    $("#dashboard_div").hide();
    //$("#chart_div").show();
    $("#options").show();
    //by tasks------------------------------------------------------------
    $("#by_tasks").click(function(){
        $("#pie_div").show();
        $("#line_div").hide();
        $("#column_div").hide();
    });
    $("#pie_link").click(function(){
        var myWindow=window.open("pie_chart.html");
    });
    //by projects---------------------------------------------------------
    $("#by_projects").click(function(){
        $("#column_div").show();
        $("#line_div").hide();
        $("#pie_div").hide();
    });
    $("#column_link").click(function(){
        var myWindow=window.open("column_chart.php");
    });
    
    //by users------------------------------------------------------------
    $("#by_users").click(function(){
        $("#line_div").show();
        $("#column_div").hide();
        $("#pie_div").hide();
    });
    $("#line_link").click(function(){
        var myWindow=window.open("./line graph/line_chart.php");
    });
});
});

// HOME---------------------------------------------------------------------------
$(function(){
$("#home").click(function(){
    $("#options").hide();
    $("#pie_div").hide();
    $("#line_div").hide();
    $("#column_div").hide();
});

});

$(function(){
$("#isadmin").click(function(){
        var myWindow=window.open("./mailer/mailsender.html");
    });
});

