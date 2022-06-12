$(document).ready(function()
{
    let dataSet = [];
    var num = '';

    $.ajax({
        url: "get_user_logs",
        method: "GET",
        contentType: "application/json",
        DataType: "json",
        AccessControlAllowOrigin: "*",
        Processing: "True",
        success: function(response)
        {
            for(let i = 0; i<response.data.length; i++)
            {
                let html = [];
                num = (+num + 1);
                let username = `${response.data[i].username}`
                let user_ip = `${response.data[i].user_ip}`
                let status = `${response.data[i].status}`
                let login_date = `${response.data[i].login_date}`
                let logout_date = `${response.data[i].logout_date}`
                
                html.push(num);
                html.push(username);
                html.push(user_ip);
                html.push(login_date);
                if (logout_date == "null")
                {
                    html.push("")
                }
                if (logout_date !== "null")
                {
                    html.push(logout_date)
                }
                if (status == 1)
                {
                    html.push("<span><i class='fas fa-check-circle text-success'></i> Success</span>")
                }
                if (status == 0)
                {
                    html.push("<span><i class='fas fa-times-circle text-danger'></i> Failed</span>")
                }
                

                dataSet.push(html);
            }
            
            $('#user_logs').DataTable({
                order: [[0, 'desc']],
                pageLength: 100,
                data: dataSet
            });

        }
    });
})