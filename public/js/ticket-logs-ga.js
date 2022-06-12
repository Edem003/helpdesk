$(document).ready(function()
{
    let dataSet = [];
    var num = '';

    $.ajax({
        url: "get_ticket_logs_ga",
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
                let code = `${response.data[i].code}`
                let subject = `${response.data[i].subject}`
                let created_by = `${response.data[i].created_by}`
                let date_created = `${response.data[i].date_created}`
                
                html.push(num);
                html.push(code);
                html.push(subject);
                html.push(created_by);
                html.push(date_created);

                dataSet.push(html);
            }
            
            $('#ticket_logs_ga').DataTable({
                order: [[0, 'desc']],
                pageLength: 25,
                data: dataSet
            });

        }
    });
})