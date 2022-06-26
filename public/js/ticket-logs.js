$(document).ready(function()
{
    let dataSet = [];
    var num = '';

    $.ajax({
        url: "get_ticket_logs",
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
                let priority = `${response.data[i].priority}`
                let status = `${response.data[i].status}`
                let created_by = `${response.data[i].created_by}`
                let date_created = `${response.data[i].date_created}`
                
                html.push(num);
                html.push(code);
                html.push(subject);
                if (priority == 'Low')
                {
                    html.push("<span><i class='fas fa-arrow-circle-down text-success small ms-2'></i> Low</span>")
                }
                if (priority == 'Medium')
                {
                    html.push("<span><i class='fas fa-minus-circle text-warning small ms-2'></i> Medium</span>")
                }
                if (priority == 'High')
                {
                    html.push("<span><i class='fas fa-arrow-circle-up text-danger small ms-2'></i> High</span>")
                }
                if (priority == 'Urgent')
                {
                    html.push("<span><i class='fas fa-exclamation-triangle small ms-2' style='color: #d63384'></i> Urgent</span>")
                }

                if (status == 'Open')
                {
                    html.push("<b class='small' style='color: #0dcaf0; border: 1px solid; border-radius: 7px; padding: 5px'>Open</b>")
                }
                if (status == 'Pending')
                {
                    html.push("<b class='text-warning small' style='border: 1px solid; border-radius: 7px; padding: 5px'>Pending</b>")
                }
                if (status == 'On Hold')
                {
                    html.push("<b class='text-danger small' style='border: 1px solid; border-radius: 7px; padding: 5px'></i>On Hold</b>")
                }
                if (status == 'Solved')
                {
                    html.push("<b class='text-success small' style='border: 1px solid; border-radius: 7px; padding: 5px'>Solved</b>")
                }
                if (status == 'Closed')
                {
                    html.push("<b class='small' style='color: #ba895d; border: 1px solid; border-radius: 7px; padding: 5px'>Closed</b>")
                }
                html.push(created_by);
                html.push(date_created);

                dataSet.push(html);
            }
            
            $('#ticket_logs').DataTable({
                order: [[0, 'desc']],
                pageLength: 100,
                data: dataSet
            });

        }
    });
})