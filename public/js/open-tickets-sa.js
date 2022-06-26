$(document).ready(function()
{
    let dataSet = [];

    var num = '';

    $.ajax({
        url: "get_open_ticket_sa",
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
                        document.getElementById("csrf_token${response.data[i].id}").value = csrf;

                    }
                })

                function get_user(val){
                    $.ajax({
                    type: "GET",
                    url: "select_option_users_sa",
                    data:'department_id='+val,
                    success: function(data){
                        $("#dept_user").html(data);
                    }
                    });
                  }

                  function get_users(val){
                    $.ajax({
                    type: "GET",
                    url: "select_option_users_sa",
                    data:'department_id='+val,
                    success: function(data){
                        $("#team_lead").html(data);
                    }
                    });

                    $.ajax({
                    type: "GET",
                    url: "select_option_group_sa",
                    data:'department_id='+val,
                    success: function(data){
                        $("#dept_users").html(data);
                    }
                    });
                  }

                  function get_assigned_type${response.data[i].id}(val){
                    $.ajax({
                    type: "GET",
                    url: "get_assigned_type",
                    data:'assigned_type='+val,
                    success: function(data){
                        $("#option_type${response.data[i].id}").html(data);
                    }
                    });
                  }
                </script>
                <div class="text-center"><a href="#" class="btn btn-outline-dark btn-xs" type="button" data-bs-toggle="modal" data-bs-target="#modal${response.data[i].id}"><i class="fas fa-info fa-sm" data-container="body" data-bs-toggle="tooltip" data-bs-placement="left" title="View Details"></i></a></div>
                <div class="modal fade" id="modal${response.data[i].id}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                        <div class="modal-header">
                            <div>
                            <ul class="nav main-menu" role="tablist">
                                <li class="me-2"><a class="btn btn-primary-light btn-sm" id="pills-info-tab" data-bs-toggle="pill" href="#pills-info${response.data[i].id}" role="tab" aria-controls="pills-info" aria-selected="true"><i class="fas fa-info-circle fa-fw"></i> Details</a></li>
                                <li><a class="btn btn-primary-light btn-sm show" id="pills-edit-tab" data-bs-toggle="pill" href="#pills-edit${response.data[i].id}" role="tab" aria-controls="pills-edit" aria-selected="false"><i class="fas fa-edit fa-fw"></i> Edit</a></li>
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
                                </div>
                                <div class="fade tab-pane" id="pills-edit${response.data[i].id}" role="tabpanel" aria-labelledby="pills-edit-tab">                                    
                                <div class="card" style="border-radius: 5px;">
                                    <div class="text-start" style="margin: 10px;">
                                    <h6 class="text-warning small">EDIT TICKET</h6>
                                    <form class="form-bookmark needs-validation mt-3" method="POST" action="update_open_ticket" id="bookmark-form" novalidate="">
                                        <div class="mb-3">
                                        <input type="text" id="csrf_token${response.data[i].id}" name="_token" hidden>
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Ticket ID<span class="text-danger">*</span></label>
                                        <input class="form-control" id="exampleInputEmail1" type="text" name="code" value="${response.data[i].code}" readonly required>
                                        </div>
                                        <div class="mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputPassword1">Complainant<span class="text-danger">*</span></label>
                                        <div class="row row-cols-sm-2 theme-form form-bottom">
                                            <div class="d-flex mb-3">
                                            <input class="form-control" type="text" name="complainant_name" plaveholder="Name" value="${response.data[i].complainant_name}" autocomplete="off">
                                            </div>
                                            <div class="d-flex mb-3">
                                            <input class="form-control" id="inputUnlabelPassword" type="tel" name="complainant_number" plaveholder="Telephone" value="${response.data[i].complainant_number}" required>
                                            </div>
                                        </div>
                                        <div class="row row-cols-sm-2 theme-form form-bottom">
                                        <div class="d-flex mb-3">
                                            <select class="form-control" name="division_id">
                                                <option value="${response.data[i].division}">${response.data[i].division}</option>
                                                <option value="LVD">LVD</option>
                                                <option value="PVLMD">PVLMD</option>
                                                <option value="SMD">SMD</option>
                                                <option value="LRD">LRD</option>
                                                <option value="Corporate">Corporate</option>
                                            </select>
                                        </div>
                                        <div class="d-flex mb-3">
                                            <input class="form-control" id="inputUnlabelPassword" type="tel" name="complainant_office" plaveholder="Office" value="${response.data[i].complainant_office}" required>
                                        </div>
                                        </div>
                                        <div class="row row-cols-sm-2 theme-form form-bottom">
                                        <div class="d-flex">
                                            <select class="form-control" name="region_id" required>
                                            <option value="${response.data[i].region}">${response.data[i].region}</option>
                                            <option value="Greater Accra">Greater Accra</option>
                                            <option value="Eastern">Eastern</option>
                                            <option value="Ashanti">Ashanti</option>
                                            <option value="Centra">Central</option>
                                            <option value="Western">Western</option>
                                            <option value="Western North">Western North</option>
                                            <option value="Volta">Volta</option>
                                            <option value="Oti">Oti</option>
                                            <option value="Bono">Bono</option>
                                            <option value="Bono East">Bono East</option>
                                            <option value="Ahafo">Ahafo</option>
                                            <option value="Savannah">Savannah</option>
                                            <option value="Northern">Northern</option>
                                            <option value="North East">North East</option>
                                            <option value="Upper East">Upper East</option>
                                            <option value="Upper West">Upper West</option>
                                            </select>
                                        </div>
                                        <div class="d-flex">
                                        
                                        </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Subject<span class="text-danger">*</span></label>
                                        <input class="form-control" id="exampleInputEmail1" type="text" name="subject" value="${response.data[i].subject}" required>
                                    </div>
                                    <div class="mb-3">
                                        <textarea class="form-control" type="text" name="details" placeholder="Please enter further details here." required>${response.data[i].details}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Priority<span class="text-danger">*</span></label>
                                        <select class="form-control" name="priority_id" required>
                                        <option value="${response.data[i].priority}">${response.data[i].priority}</option>
                                        <option value="Low">Low</option>
                                        <option value="Medium">Medium</option>
                                        <option value="High">High</option>
                                        <option value="Urgent">Urgent</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Assigned To<span class="text-danger">*</span></label>
                                        <select class="form-control" id="dept_name" name="assigned_type" onChange="get_assigned_type${response.data[i].id}(this.value);" required>
                                        <option value="" disabled selected>-- select --</option>
                                        <option value="Individual">Individual</option>
                                        <option value="Group">Group</option>
                                        </select>
                                    </div>
                                    <div class="mb-3" id="option_type${response.data[i].id}"></div>
                                    <div class="">
                                        <button class="btn btn-primary btn-update" type="submit"><i class="fas fa-refresh small"></i> Update</button>
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
                html.push(division);
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
            
            $('#open_ticket').DataTable({
                pageLength: 25,
                data: dataSet
            });

        }
    });
})