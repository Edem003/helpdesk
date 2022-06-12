$(document).ready(function()
{
  $.ajax({
      url: "get_dept_chart",
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