$(document).ready(function()
{
    let dataSet = [];

    var num = '';

    $.ajax({
        url: "get_myonhold_ticket",
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
                        document.getElementById("csrf_token_myonhold_a${response.data[i].id}").value = csrf;
                        document.getElementById("csrf_token_myonhold_b${response.data[i].id}").value = csrf;

                    }
                })

                $(document).ready(function() {
  
                    $('#myonhold_ticket').on('click','.details_${response.data[i].id}',function(){
                
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
                          document.getElementById('note_id_f${response.data[i].id}').innerHTML = html;
                        }
                      });
                    });
                  })
                </script>
                <div class="text-center"><a href="#" class="btn btn-outline-dark btn-xs details_${response.data[i].id}" type="button" data-bs-toggle="modal" data-bs-target="#onholdmodal${response.data[i].id}"><i class="fas fa-info fa-sm" data-container="body" data-bs-toggle="tooltip" data-bs-placement="left" title="View Details"></i></a></div>
                <div class="modal fade" id="onholdmodal${response.data[i].id}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                        <div class="modal-header">
                            <div>
                            <ul class="nav main-menu" role="tablist">
                                <li class="me-2"><a class="btn btn-primary-light btn-sm" id="pills-info-tab" data-bs-toggle="pill" href="#pills-info-onhold${response.data[i].id}" role="tab" aria-controls="pills-info" aria-selected="true"><i class="fas fa-info-circle fa-fw"></i> Details</a></li>
                                <li class="me-2"><a class="btn btn-primary-light btn-sm show" id="pills-edit-tab" data-bs-toggle="pill" href="#pills-edit-onhold${response.data[i].id}" role="tab" aria-controls="pills-edit" aria-selected="false"><i class="fas fa-edit fa-fw"></i> Edit</a></li>
                                <li><a class="btn btn-primary-light btn-sm show" id="pills-note-tab" data-bs-toggle="pill" href="#pills-note-onhold${response.data[i].id}" role="tab" aria-controls="pills-note" aria-selected="false"><i class="fas fa-sticky-note fa-fw"></i>  Add Note</a></li>
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
                                <div class="tab-pane fade active show" id="pills-info-onhold${response.data[i].id}" role="tabpanel" aria-labelledby="pills-info-tab">  
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
                                        <li><p id="note_id_f${response.data[i].id}"></p></li>
                                    </ul>
                                    </div>
                                </div>
                                </div>
                                <div class="fade tab-pane" id="pills-edit-onhold${response.data[i].id}" role="tabpanel" aria-labelledby="pills-edit-tab">                                    
                                <div class="card" style="border-radius: 5px;">
                                    <div class="text-start" style="margin: 10px;">
                                    <h6 class="text-warning small">EDIT TICKET</h6>
                                    <form class="form-bookmark needs-validation mt-3" method="POST" action="update_handle_ticket" id="bookmark-form" novalidate="">
                                        <div class="mb-3">
                                        <input type="text" id="csrf_token_myonhold_a${response.data[i].id}" name="_token" hidden>
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Ticket ID<span class="text-danger">*</span></label>
                                        <input class="form-control" id="exampleInputEmail1" type="text" name="code" value="${response.data[i].code}" readonly required>
                                        </div>
                                    <div class="mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Status<span class="text-danger">*</span></label>
                                        <select class="form-control" name="status_id" required>
                                        <option value="${response.data[i].status}">${response.data[i].status}</option>
                                        <option value="Pending">Pending</option>
                                        <option value="On Hold">On Hold</option>
                                        <option value="Solved">Solved</option>
                                        </select>
                                    </div>
                                    <div class="">
                                        <button class="btn btn-primary btn-update" type="submit"><i class="fas fa-refresh small"></i> Update</button>
                                    </div>
                                    </form>
                                </div>
                                </div>
                            </div>
                            <div class="fade tab-pane" id="pills-note-onhold${response.data[i].id}" role="tabpanel" aria-labelledby="pills-note-tab">                                    
                                <div class="card" style="border-radius: 5px;">
                                <div class="text-start" style="margin: 10px;">
                                    <h6 class="text-warning small">NOTE</h6>
                                    <form class="form-bookmark needs-validation mt-3" method="POST" action="add_note" id="bookmark-form" novalidate="">
                                    <div class="row">
                                    <div class="mb-3">
                                    <input type="text" id="csrf_token_myonhold_b${response.data[i].id}" name="_token" hidden>
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Ticket ID<span class="text-danger">*</span></label>
                                        <input class="form-control" id="exampleInputEmail1" type="text" name="code" value="${response.data[i].code}" readonly required>
                                    </div>
                                    <div class="mb-0 mt-3">
                                    <textarea class="form-control" type="text" name="note" style="height: 200px"></textarea>
                                    </div>
                                    <div class="m-t-15">
                                    <button class="btn btn-primary" type="submit"><i class="fas fa-arrow-circle-right small"></i> Submit</button>
                                    </div>
                                </div>
                                </form>
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
            
            $('#myonhold_ticket').DataTable({
                pageLength: 25,
                data: dataSet
            });

        }
    });
})