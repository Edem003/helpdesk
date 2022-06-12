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