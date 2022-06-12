$(document).ready(function()
{
    let dataSet = [];

    var num = '';

    $.ajax({
        url: "get_closed_ticket",
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
                let details = `${response.data[i].details}`
                let complainant_name = `${response.data[i].complainant_name}`
                let complainant_number = `${response.data[i].complainant_number}`
                let complainant_office = `${response.data[i].complainant_office}`
                let division = `${response.data[i].division}`
                let region = `${response.data[i].region}`
                let priority = `${response.data[i].priority}`
                let status = `${response.data[i].status}`
                let full_name = `${response.data[i].first_name} ${response.data[i].surname}`
                let date_assigned = `${response.data[i].date_assigned}`
                let department_id = `${response.data[i].department_id}`
                let date_created = `${response.data[i].date_created}`
                let actions = `
                <script>
                $.ajax({
                    url: "get-csrf-token",
                    method: "GET",
                    DataType: "html",
                    AccessControlAllowOrigin: "*",
                    success: function(data)
                    {
                        var csrf = data;
                        document.getElementById("csrf_token_closed${response.data[i].id}").value = csrf;

                    }
                })

                function get_users(val){
                    $.ajax({
                    type: "GET",
                    url: "select_option_users",
                    data:'department_id='+val,
                    success: function(data){
                        $("#dept_users").html(data);
                    }
                    });
                  }
                
                  $(document).ready(function() {
  
                    $('#closed_ticket').on('click','.details_${response.data[i].id}',function(){
                
                      $.ajax({
                        url: "get_ticket_note",
                        type: "POST",
                        data: {ticket_id: '${response.data[i].code}'},
                        success: function(results)
                        {
                          console.log(results);
                          var html = "";
                          for (let i = 0; i<results.data.length; i++)
                          {
                            html += "<span class='text-secondary'>";
                            html += results.data[i].note;
                            html += "</span>";
                            html += "<br>";
                            html += "<span class='small'> Created by ";
                            html += results.data[i].first_name;
                            html += ' ';
                            html += results.data[i].surname;
                            html += " on ";
                            html += results.data[i].date_created;
                            html += "</span>";
                            html += "<br><br>";
                          }
                          document.getElementById('note_id${response.data[i].id}').innerHTML = html;
                        }
                      });
                    });
                  })
                </script>
                <div class="text-center"><a href="#" class="btn btn-outline-dark btn-xs details_${response.data[i].id}" type="button" data-bs-toggle="modal" data-bs-target="#modal${response.data[i].id}"><i class="fas fa-info fa-sm" data-container="body" data-bs-toggle="tooltip" data-bs-placement="left" title="View Details"></i></a></div>
                <div class="modal fade" id="modal${response.data[i].id}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                        <div class="modal-header">
                            <div>
                            <ul class="nav main-menu" role="tablist">
                                <li class="me-2"><a class="btn btn-primary-light btn-sm" id="pills-info-tab" data-bs-toggle="pill" href="#pills-info${response.data[i].id}" role="tab" aria-controls="pills-info" aria-selected="true"><i class="fas fa-info-circle fa-fw"></i> Details</a></li>
                            </ul>
                            </div>
                            <a class="text-danger"data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></a>
                        </div>
                        <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-5">
                            <div class="card" style="border-radius: 5px;">
                                <div class="text-start" style="margin: 10px;">
                                <h6 class="text-warning small">TICKET INFO</h6>
                                <ul>
                                    <li><span class="text-secondary" id="code"><b>Ticket ID:</b> ${response.data[i].code}</span></li>
                                    <li><span class="text-secondary"><b>Priority:</b>  ${response.data[i].priority}</span></li>
                                    <li><span class="text-secondary"><b>Status:</b>  ${response.data[i].status}</span></li>
                                    <li><span class="text-secondary"><b>Department:</b>  ${response.data[i].department}</span></li>
                                    <li><span class="text-secondary"><b>Assigned To:</b>  ${response.data[i].first_name} ${response.data[i].surname}</span></li>
                                    <li><span class="text-secondary"><b>Assigned Date:</b>  ${response.data[i].date_assigned}</span></li>
                                </ul>
                                </div>
                            </div>
                            <div class="card" style="border-radius: 5px;">
                                <div class="text-start" style="margin: 10px;">
                                <h6 class="text-warning small">COMPLAINANT INFO</h6>
                                <ul>
                                    <li><span class="text-secondary"><b>Name:</b>  ${response.data[i].complainant_name}</span></li>
                                    <li><span class="text-secondary"><b>Telephone:</b>  ${response.data[i].complainant_number}</span></li>
                                    <li><span class="text-secondary"><b>Division/Unit:</b> ${response.data[i].division}</span></li>
                                    <li><span class="text-secondary"><b>Office:</b> ${response.data[i].complainant_office}</span></li>
                                    <li><span class="text-secondary"><b>Resquested On:</b>  ${response.data[i].date_created}</span></li>
                                </ul>
                                </div>
                            </div>
                            </div>
                            <div class="col-sm-7">
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="pills-info${response.data[i].id}" role="tabpanel" aria-labelledby="pills-info-tab">  
                                <div class="card" style="border-radius: 5px;">
                                    <div class="text-start" style="margin: 10px;">
                                    <h6 class="text-warning small">SUBJECT</h6>
                                    <ul>
                                        <li><span class="text-secondary">${response.data[i].subject}</span></li>
                                    </ul>
                                    <br>
                                    <h6 class="text-warning small">DETAILS</h6>
                                    <ul>
                                        <li><span class="text-secondary">${response.data[i].details}</span></li>
                                    </ul>
                                    </div>
                                </div>
                                <div class="card" style="border-radius: 5px;">
                                    <div class="text-start" style="margin: 10px;">
                                    <h6 class="text-warning small">NOTE</h6>
                                    <ul>
                                        <li><p id="note_id${response.data[i].id}"></p></li>
                                    </ul>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                `
                
                html.push(num);
                html.push(code);
                html.push(subject);
                html.push(complainant_name);
                html.push(complainant_office);
                html.push(full_name);
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
                html.push(actions);

                dataSet.push(html);
            }
            
            $('#closed_ticket').DataTable({
                pageLength: 25,
                data: dataSet
            });

        }
    });
})