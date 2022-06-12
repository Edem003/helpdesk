$(document).ready(function()
{
  $.ajax({
      url: "get_dashboard_json",
      method: "GET",
      contentType: "application/json",
      DataType: "json",
      AccessControlAllowOrigin: "*",
      Processing: "True",
      success: function(response)
      {
        console.log(response)
      }
  });
})

$(document).ready(function()
{
  $.ajax({
      url: "get_staff_management_json",
      method: "GET",
      contentType: "application/json",
      DataType: "json",
      AccessControlAllowOrigin: "*",
      Processing: "True",
      success: function(response)
      {
        console.log(response)
      }
  });
})

$(document).ready(function()
{
  $.ajax({
      url: "get_tasks_json",
      method: "GET",
      contentType: "application/json",
      DataType: "json",
      AccessControlAllowOrigin: "*",
      Processing: "True",
      success: function(response)
      {
        console.log(response)
      }
  });
})

$(document).ready(function()
{
  $.ajax({
      url: "get_user_logs_json",
      method: "GET",
      contentType: "application/json",
      DataType: "json",
      AccessControlAllowOrigin: "*",
      Processing: "True",
      success: function(response)
      {
        console.log(response)
      }
  });
})
