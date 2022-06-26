$(document).ready(function()
{
    let dataSet = [];
    var num = '';

    $.ajax({
        url: "get_staff_count_json_sa",
        method: "GET",
        contentType: "application/json",
        DataType: "json",
        AccessControlAllowOrigin: "*",
        Processing: "True",
        success: function(response)
        {
            for(let i = 0; i<response.software_users.length; i++)
            {
                let html = [];
                num = (+num + 1);
                let fullname = `${response.software_users[i].first_name} ${response.software_users[i].surname}`
                let department = `${response.software_users[i].department}`
                let role = `${response.software_users[i].role}`
                let region = `${response.software_users[i].region}`
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
                        document.getElementById("csrf_token_software${response.software_users[i].id}").value = csrf;

                    }
                })

                $(document).ready(function() {
  
                  let dataSet = [];
                
                  $('#software_users').on('click','.details_${response.software_users[i].id}',function(){

                    $.ajax({
                      url: "get_user_tasks",
                      type: "POST",
                      data: {user_id: ${response.software_users[i].id}},
                      success: function(results)
                      {
                        console.log(results);
                        
                        for (let i = 0; i<results.data.length; i++)
                        {
                          let html = [];
                          let ticket_id = results.data[i].id;
                          let code = results.data[i].code;
                          let subject = results.data[i].subject;
                          let division = results.data[i].division;
                          let office = results.data[i].complainant_office;
                          let priority = results.data[i].priority;
                          let status = results.data[i].status;
                          let date_assigned = results.data[i].date_assigned;
                
                          html.push(code);
                          html.push(subject);
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
                          html.push(status);
                          html.push(date_assigned);
                
                          dataSet.push(html)
                        }
                
                        $('#s_t${response.software_users[i].id}').DataTable({
                          retrieve: true,
                          data: dataSet
                        });
                      }
                    });
                  });
                })

                $(document).ready(function() {
                  
                  $('#software_users').on('click','.details_${response.software_users[i].id}',function(){

                    $.ajax({
                      url: "get_staff_performance",
                      type: "POST",
                      data: {user_id: ${response.software_users[i].id}},
                      success: function(results)
                      {
                        console.log(results);
                        var html = results;
                        document.getElementById('performance_id${response.software_users[i].id}').innerHTML = html;
                      }
                    });
                  });
                })
                </script>
                <div class="text-center">
                  <a href="#" class="btn btn-outline-dark btn-xs details_${response.software_users[i].id}" type="button" data-bs-toggle="modal" data-bs-target="#details${response.software_users[i].id}">
                    <i class="fas fa-info fa-sm" data-container="body" data-bs-toggle="tooltip" data-bs-placement="left" title="View Details"></i>
                  </a>
                </div>
                <div class="modal fade" id="details${response.software_users[i].id}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                      <div class="modal-header">
                        <ul class="nav main-menu" role="tablist">
                          <li class="me-2"><a class="btn btn-primary-light btn-sm" id="pills-info-tab" data-bs-toggle="pill" href="#pills-info-${response.software_users[i].id}" role="tab" aria-controls="pills-info" aria-selected="true"><i class="fas fa-list fa-fw"></i> Tasks</a></li>
                          <li><a class="btn btn-primary-light btn-sm show" id="pills-edit-tab" data-bs-toggle="pill" href="#pills-edit-${response.software_users[i].id}" role="tab" aria-controls="pills-edit" aria-selected="false"><i class="fas fa-edit fa-fw"></i> Edit</a></li>
                        </ul>
                        <a class="text-danger" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></a>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-sm-4">
                            <div class="card" style="border-radius: 5px;">
                              <div class="text-start" style="margin: 10px;">
                                <h6 class="text-warning small">STAFF INFO</h6>
                                <ul>
                                  <li><span class="text-secondary"><b>Name:</b>  ${response.software_users[i].first_name} ${response.software_users[i].surname}</span></li>
                                  <li><span class="text-secondary"><b>Role:</b>  ${response.software_users[i].role}</span></li>
                                  <li><span class="text-secondary"><b>Department:</b> ${response.software_users[i].department}</span></li>
                                  <li><span class="text-secondary"><b>Region:</b> ${response.software_users[i].region}</span></li>
                                  <li><span class="text-secondary"><b>E-mail:</b> ${response.software_users[i].email}</span></li>
                                  <li><span class="text-secondary"><b>Telephone:</b> ${response.software_users[i].phone}</span></li>
                                  <li><span class="text-secondary"><b>Created on:</b> ${response.software_users[i].created_at}</span></li>
                                </ul>
                              </div>
                            </div>
                            <div class="card" style="border-radius: 5px;">
                              <div class="text-start" style="margin: 10px;">
                              <div class="text-warning">
                                <h6 class="small">PERFORMANCE</h6>
                              </div>
                              <div class="m-t-15" id="performance_id${response.software_users[i].id}"></div>
                            </div>
                            </div>
                          </div>
                          <div class="col-sm-8">
                            <div class="card" style="border-radius: 5px;">
                              <div class="text-start" style="margin: 10px;">
                                <div class="tab-content">
                                <div class="tab-pane fade active show" id="pills-info-${response.software_users[i].id}" role="tabpanel" aria-labelledby="pills-info-tab">                                    
                                <h6 class="text-warning small mb-3">ASSIGNED TASKS</h6>
                                <div class="table-responsive">
                                  <table class="table table-bordered" id="s_t${response.software_users[i].id}" width="100%" cellspacing="0">
                                    <thead>
                                      <tr class="small">
                                        <th>TID</th>
                                        <th>SUBJECT</th>
                                        <th>DIVISION</th>
                                        <th>PRIORITY</th>
                                        <th>STATUS</th>
                                        <th>DATE</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                              <div class="fade tab-pane" id="pills-edit-${response.software_users[i].id}" role="tabpanel" aria-labelledby="pills-edit-tab">                                    
                                <h6 class="text-warning small mb-3">EDIT INFO</h6>
                                <form class="form-bookmark needs-validation mt-3" method="POST" action="update_user" id="bookmark-form" novalidate="">
                                  <input type="text" id="csrf_token_software${response.software_users[i].id}" name="_token" hidden>
                                  <input type="text" name="user_id" value="${response.software_users[i].id}" hidden>
                                  <div class="form-row">
                                      <label for="task-title">Full Name<span class="text-danger">*</span></label>
                                      <div class="row">
                                        <div class="form-group col">
                                          <input class="form-control" id="task-title" type="text" name="first_name" required="" value="${response.software_users[i].first_name}" autocomplete="off">
                                        </div>
                                        <div class="form-group col">
                                          <input class="form-control" id="task-title" type="text" name="surname" required="" value="${response.software_users[i].surname}" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                      <label for="sub-task">Department<span class="text-danger">*</span></label>
                                      <select class="form-control" name="department_id" required="">
                                        <option value="${response.software_users[i].department}">${response.software_users[i].department}</option>
                                        <option value="Networking">Networking</option>
                                        <option value="Software">Software</option>
                                        <option value="Hardware">Hardware</option>
                                        <option value="Desktop Support">Desktop Support</option>
                                    </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                      <label for="sub-task">Role<span class="text-danger">*</span></label>
                                      <select class="form-control" name="role" required="">
                                        <option value="${response.software_users[i].role}">${response.software_users[i].role}</option>
                                        <option value="Administrator">Administrator</option>
                                        <option value="Staff">Staff</option>
                                        <option value="National Service Personnel">National Service Personnel</option>
                                      </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                      <label for="sub-task">Region<span class="text-danger">*</span></label>
                                      <select class="form-control" name="region" required="">
                                        <option value="${response.software_users[i].region}">${response.software_users[i].region}</option>
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
                                    <div class="form-group col-md-12">
                                      <label for="sub-task">E-mail</label>
                                      <input class="form-control" id="sub-task" type="email" name="email" value="${response.software_users[i].email}" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-12">
                                      <label for="sub-task">Telephone<span class="text-danger">*</span></label>
                                      <input class="form-control" id="sub-task" type="tel" name="phone" required="" value="${response.software_users[i].phone}" autocomplete="off">
                                    </div>
                                  </div>
                                  <input id="index_var" type="hidden" value="6">
                                  <button class="btn btn-primary btn-update" id="Bookmark" onclick="submitBookMark()" type="submit"><i class="fas fa-refresh small"></i> Update</button>
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
                html.push(fullname);
                html.push(department);
                html.push(role);
                html.push(region);      
                html.push(actions);
                
                dataSet.push(html);
            }
            
            $('#software_users').DataTable({
              pageLength: 25,
              data: dataSet
            });

            
        }
    });
})

$(document).ready(function()
{
    let dataSet = [];
    var num = '';

    $.ajax({
        url: "get_staff_count_json_sa",
        method: "GET",
        contentType: "application/json",
        DataType: "json",
        AccessControlAllowOrigin: "*",
        Processing: "True",
        success: function(response)
        {
            for(let i = 0; i<response.desktop_support_users.length; i++)
            {
                let html = [];
                num = (+num + 1);
                let fullname = `${response.desktop_support_users[i].first_name} ${response.desktop_support_users[i].surname}`
                let department = `${response.desktop_support_users[i].department}`
                let role = `${response.desktop_support_users[i].role}`
                let region = `${response.desktop_support_users[i].region}`
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
                        document.getElementById("csrf_token_desk_support${response.desktop_support_users[i].id}").value = csrf;

                    }
                })

                $(document).ready(function() {
  
                  let dataSet = [];
                
                  $('#desk_support_users').on('click','.details_${response.desktop_support_users[i].id}',function(){

                    $.ajax({
                      url: "get_user_tasks",
                      type: "POST",
                      data: {user_id: ${response.desktop_support_users[i].id}},
                      success: function(results)
                      {
                        console.log(results);
                        
                        for (let i = 0; i<results.data.length; i++)
                        {
                          let html = [];
                          let ticket_id = results.data[i].id;
                          let code = results.data[i].code;
                          let subject = results.data[i].subject;
                          let division = results.data[i].division;
                          let office = results.data[i].complainant_office;
                          let priority = results.data[i].priority;
                          let status = results.data[i].status;
                          let assigned_date = results.data[i].assigned_date;
                          let date_assigned = results.data[i].date_assigned;
                
                          html.push(code);
                          html.push(subject);
                          html.push(division);
                          html.push(priority);
                          html.push(status);
                          html.push(date_assigned);
                
                          dataSet.push(html)
                        }
                
                        $('#d_s_t${response.desktop_support_users[i].id}').DataTable({
                          retrieve: true,
                          data: dataSet
                        });
                      }
                    });
                  });
                })

                $(document).ready(function() {

                  $('#desk_support_users').on('click','.details_${response.desktop_support_users[i].id}',function(){

                    $.ajax({
                      url: "get_staff_performance",
                      type: "POST",
                      data: {user_id: ${response.desktop_support_users[i].id}},
                      success: function(results)
                      {
                        console.log(results);
                        var html = results;
                        document.getElementById('performance_id${response.desktop_support_users[i].id}').innerHTML = html;
                      }
                    });
                  });
                })
                </script>
                <div class="text-center">
                  <a href="#" class="btn btn-outline-dark btn-xs details_${response.desktop_support_users[i].id}" type="button" data-bs-toggle="modal" data-bs-target="#details${response.desktop_support_users[i].id}">
                    <i class="fas fa-info fa-sm" data-container="body" data-bs-toggle="tooltip" data-bs-placement="left" title="View Details"></i>
                  </a>
                </div>
                <div class="modal fade" id="details${response.desktop_support_users[i].id}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                      <div class="modal-header">
                        <ul class="nav main-menu" role="tablist">
                          <li class="me-2"><a class="btn btn-primary-light btn-sm" id="pills-info-tab" data-bs-toggle="pill" href="#pills-info-${response.desktop_support_users[i].id}" role="tab" aria-controls="pills-info" aria-selected="true"><i class="fas fa-list fa-fw"></i> Tasks</a></li>
                          <li><a class="btn btn-primary-light btn-sm show" id="pills-edit-tab" data-bs-toggle="pill" href="#pills-edit-${response.desktop_support_users[i].id}" role="tab" aria-controls="pills-edit" aria-selected="false"><i class="fas fa-edit fa-fw"></i> Edit</a></li>
                        </ul>
                        <a class="text-danger" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></a>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-sm-4">
                            <div class="card" style="border-radius: 5px;">
                              <div class="text-start" style="margin: 10px;">
                                <h6 class="text-warning small">STAFF INFO</h6>
                                <ul>
                                  <li><span class="text-secondary"><b>Name:</b>  ${response.desktop_support_users[i].first_name} ${response.desktop_support_users[i].surname}</span></li>
                                  <li><span class="text-secondary"><b>Role:</b>  ${response.desktop_support_users[i].role}</span></li>
                                  <li><span class="text-secondary"><b>Department:</b> ${response.desktop_support_users[i].department}</span></li>
                                  <li><span class="text-secondary"><b>Region:</b> ${response.desktop_support_users[i].region}</span></li>
                                  <li><span class="text-secondary"><b>E-mail:</b> ${response.desktop_support_users[i].email}</span></li>
                                  <li><span class="text-secondary"><b>Telephone:</b> ${response.desktop_support_users[i].phone}</span></li>
                                  <li><span class="text-secondary"><b>Created on:</b> ${response.software_users[i].created_at}</span></li>
                                </ul>
                              </div>
                            </div>
                            <div class="card" style="border-radius: 5px;">
                              <div class="text-start" style="margin: 10px;">
                              <div class="text-warning">
                                <h6 class="small">PERFORMANCE</h6>
                              </div>
                              <div class="m-t-15" id="performance_id${response.desktop_support_users[i].id}"></div>
                            </div>
                            </div>
                          </div>
                          <div class="col-sm-8">
                            <div class="card" style="border-radius: 5px;">
                              <div class="text-start" style="margin: 10px;">
                                <div class="tab-content">
                                <div class="tab-pane fade active show" id="pills-info-${response.desktop_support_users[i].id}" role="tabpanel" aria-labelledby="pills-info-tab">                                    
                                <h6 class="text-warning small mb-3">ASSIGNED TASKS</h6>
                                <div class="table-responsive">
                                  <table class="table table-bordered"  id="d_s_t${response.desktop_support_users[i].id}" width="100%" cellspacing="0">
                                    <thead>
                                      <tr class="small">
                                        <th>TID</th>
                                        <th>SUBJECT</th>
                                        <th>DIVISION</th>
                                        <th>PRIORITY</th>
                                        <th>STATUS</th>
                                        <th>DATE</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                              <div class="fade tab-pane" id="pills-edit-${response.desktop_support_users[i].id}" role="tabpanel" aria-labelledby="pills-edit-tab">                                    
                                <h6 class="text-warning small mb-3">EDIT INFO</h6>
                                <form class="form-bookmark needs-validation mt-3" method="POST" action="update_user" id="bookmark-form" novalidate="">
                                  <input type="text" id="csrf_token_desk_support${response.desktop_support_users[i].id}" name="_token" hidden>
                                  <input type="text" name="user_id" value="${response.desktop_support_users[i].id}" hidden>
                                  <div class="form-row">
                                      <label for="task-title">Full Name<span class="text-danger">*</span></label>
                                      <div class="row">
                                        <div class="form-group col">
                                          <input class="form-control" id="task-title" type="text" name="first_name" required="" value="${response.desktop_support_users[i].first_name}" autocomplete="off">
                                        </div>
                                        <div class="form-group col">
                                          <input class="form-control" id="task-title" type="text" name="surname" required="" value="${response.desktop_support_users[i].surname}" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                      <label for="sub-task">Department<span class="text-danger">*</span></label>
                                      <select class="form-control" name="department_id" required="">
                                        <option value="${response.desktop_support_users[i].department}">${response.desktop_support_users[i].department}</option>
                                        <option value="Networking">Networking</option>
                                        <option value="Software">Software</option>
                                        <option value="Hardware">Hardware</option>
                                        <option value="Desktop Support">Desktop Support</option>
                                    </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                      <label for="sub-task">Role<span class="text-danger">*</span></label>
                                      <select class="form-control" name="role" required="">
                                        <option value="${response.desktop_support_users[i].role}">${response.desktop_support_users[i].role}</option>
                                        <option value="Administrator">Administrator</option>
                                        <option value="Staff">Staff</option>
                                        <option value="National Service Personnel">National Service Personnel</option>
                                      </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                      <label for="sub-task">Region<span class="text-danger">*</span></label>
                                      <select class="form-control" name="region" required="">
                                        <option value="${response.desktop_support_users[i].region}">${response.desktop_support_users[i].region}</option>
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
                                    <div class="form-group col-md-12">
                                      <label for="sub-task">E-mail</label>
                                      <input class="form-control" id="sub-task" type="email" name="email" value="${response.desktop_support_users[i].email}" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-12">
                                      <label for="sub-task">Telephone<span class="text-danger">*</span></label>
                                      <input class="form-control" id="sub-task" type="tel" name="phone" required="" value="${response.desktop_support_users[i].phone}" autocomplete="off">
                                    </div>
                                  </div>
                                  <input id="index_var" type="hidden" value="6">
                                  <button class="btn btn-primary btn-update" id="Bookmark" onclick="submitBookMark()" type="submit"><i class="fas fa-refresh small"></i> Update</button>
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
                html.push(fullname);
                html.push(department);
                html.push(role);
                html.push(region);      
                html.push(actions);
                
                dataSet.push(html);
            }
            
            $('#desk_support_users').DataTable({
              pageLength: 25,
              data: dataSet
            });
            
        }
    });
})


$(document).ready(function()
{
    let dataSet = [];
    var num = '';

    $.ajax({
        url: "get_staff_count_json_sa",
        method: "GET",
        contentType: "application/json",
        DataType: "json",
        AccessControlAllowOrigin: "*",
        Processing: "True",
        success: function(response)
        {
            for(let i = 0; i<response.networking_users.length; i++)
            {
                let html = [];
                num = (+num + 1);
                let fullname = `${response.networking_users[i].first_name} ${response.networking_users[i].surname}`
                let department = `${response.networking_users[i].department}`
                let role = `${response.networking_users[i].role}`
                let region = `${response.networking_users[i].region}`
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
                        document.getElementById("csrf_token_networking${response.networking_users[i].id}").value = csrf;

                    }
                })

                $(document).ready(function() {
  
                  let dataSet = [];
                
                  $('#networking_users').on('click','.details_${response.networking_users[i].id}',function(){

                    $.ajax({
                      url: "get_user_tasks",
                      type: "POST",
                      data: {user_id: ${response.networking_users[i].id}},
                      success: function(results)
                      {
                        console.log(results);
                        
                        for (let i = 0; i<results.data.length; i++)
                        {
                          let html = [];
                          let ticket_id = results.data[i].id;
                          let code = results.data[i].code;
                          let subject = results.data[i].subject;
                          let division = results.data[i].division;
                          let office = results.data[i].complainant_office;
                          let priority = results.data[i].priority;
                          let status = results.data[i].status;
                          let date_assigned = results.data[i].date_assigned;
                
                          html.push(code);
                          html.push(subject);
                          html.push(division);
                          html.push(priority);
                          html.push(status);
                          html.push(date_assigned);
                
                          dataSet.push(html)
                        }
                
                        $('#n_t${response.networking_users[i].id}').DataTable({
                          retrieve: true,
                          data: dataSet
                        });
                      }
                    });
                  });
                })

                $(document).ready(function() {
                  
                  $('#networking_users').on('click','.details_${response.networking_users[i].id}',function(){

                    $.ajax({
                      url: "get_staff_performance",
                      type: "POST",
                      data: {user_id: ${response.networking_users[i].id}},
                      success: function(results)
                      {
                        console.log(results);
                        var html = results;
                        document.getElementById('performance_id${response.networking_users[i].id}').innerHTML = html;
                      }
                    });
                  });
                })
                </script>
                <div class="text-center">
                  <a href="#" class="btn btn-outline-dark btn-xs details_${response.networking_users[i].id}" type="button" data-bs-toggle="modal" data-bs-target="#details${response.networking_users[i].id}">
                    <i class="fas fa-info fa-sm" data-container="body" data-bs-toggle="tooltip" data-bs-placement="left" title="View Details"></i>
                  </a>
                </div>
                <div class="modal fade" id="details${response.networking_users[i].id}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                      <div class="modal-header">
                        <ul class="nav main-menu" role="tablist">
                          <li class="me-2"><a class="btn btn-primary-light btn-sm" id="pills-info-tab" data-bs-toggle="pill" href="#pills-info-${response.networking_users[i].id}" role="tab" aria-controls="pills-info" aria-selected="true"><i class="fas fa-list fa-fw"></i> Tasks</a></li>
                          <li><a class="btn btn-primary-light btn-sm show" id="pills-edit-tab" data-bs-toggle="pill" href="#pills-edit-${response.networking_users[i].id}" role="tab" aria-controls="pills-edit" aria-selected="false"><i class="fas fa-edit fa-fw"></i> Edit</a></li>
                        </ul>
                        <a class="text-danger" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></a>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-sm-4">
                            <div class="card" style="border-radius: 5px;">
                              <div class="text-start" style="margin: 10px;">
                                <h6 class="text-warning small">STAFF INFO</h6>
                                <ul>
                                  <li><span class="text-secondary"><b>Name:</b>  ${response.networking_users[i].first_name} ${response.networking_users[i].surname}</span></li>
                                  <li><span class="text-secondary"><b>Role:</b>  ${response.networking_users[i].role}</span></li>
                                  <li><span class="text-secondary"><b>Department:</b> ${response.networking_users[i].department}</span></li>
                                  <li><span class="text-secondary"><b>Region:</b> ${response.networking_users[i].region}</span></li>
                                  <li><span class="text-secondary"><b>E-mail:</b> ${response.networking_users[i].email}</span></li>
                                  <li><span class="text-secondary"><b>Telephone:</b> ${response.networking_users[i].phone}</span></li>
                                  <li><span class="text-secondary"><b>Created on:</b> ${response.software_users[i].created_at}</span></li>
                                </ul>
                              </div>
                            </div>
                            <div class="card" style="border-radius: 5px;">
                              <div class="text-start" style="margin: 10px;">
                              <div class="text-warning">
                                <h6 class="small">PERFORMANCE</h6>
                              </div>
                              <div class="m-t-15" id="performance_id${response.networking_users[i].id}"></div>
                            </div>
                            </div>
                          </div>
                          <div class="col-sm-8">
                            <div class="card" style="border-radius: 5px;">
                              <div class="text-start" style="margin: 10px;">
                                <div class="tab-content">
                                <div class="tab-pane fade active show" id="pills-info-${response.networking_users[i].id}" role="tabpanel" aria-labelledby="pills-info-tab">                                    
                                <h6 class="text-warning small mb-3">ASSIGNED TASKS</h6>
                                <div class="table-responsive">
                                  <table class="table table-bordered"  id="n_t${response.networking_users[i].id}" width="100%" cellspacing="0">
                                    <thead>
                                      <tr class="small">
                                        <th>TID</th>
                                        <th>SUBJECT</th>
                                        <th>DIVISION</th>
                                        <th>PRIORITY</th>
                                        <th>STATUS</th>
                                        <th>DATE</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                              <div class="fade tab-pane" id="pills-edit-${response.networking_users[i].id}" role="tabpanel" aria-labelledby="pills-edit-tab">                                    
                                <h6 class="text-warning small mb-3">EDIT INFO</h6>
                                <form class="form-bookmark needs-validation mt-3" method="POST" action="update_user" id="bookmark-form" novalidate="">
                                  <input type="text" id="csrf_token_networking${response.networking_users[i].id}" name="_token" hidden>
                                  <input type="text" name="user_id" value="${response.networking_users[i].id}" hidden>
                                  <div class="form-row">
                                      <label for="task-title">Full Name<span class="text-danger">*</span></label>
                                      <div class="row">
                                        <div class="form-group col">
                                          <input class="form-control" id="task-title" type="text" name="first_name" required="" value="${response.networking_users[i].first_name}" autocomplete="off">
                                        </div>
                                        <div class="form-group col">
                                          <input class="form-control" id="task-title" type="text" name="surname" required="" value="${response.networking_users[i].surname}" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                      <label for="sub-task">Department<span class="text-danger">*</span></label>
                                      <select class="form-control" name="department_id" required="">
                                        <option value="${response.networking_users[i].department}">${response.networking_users[i].department}</option>
                                        <option value="Networking">Networking</option>
                                        <option value="Software">Software</option>
                                        <option value="Hardware">Hardware</option>
                                        <option value="Desktop Support">Desktop Support</option>
                                    </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                      <label for="sub-task">Role<span class="text-danger">*</span></label>
                                      <select class="form-control" name="role" required="">
                                        <option value="${response.networking_users[i].role}">${response.networking_users[i].role}</option>
                                        <option value="Administrator">Administrator</option>
                                        <option value="Staff">Staff</option>
                                        <option value="National Service Personnel">National Service Personnel</option>
                                      </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                      <label for="sub-task">Region<span class="text-danger">*</span></label>
                                      <select class="form-control" name="region" required="">
                                        <option value="${response.networking_users[i].region}">${response.networking_users[i].region}</option>
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
                                    <div class="form-group col-md-12">
                                      <label for="sub-task">E-mail</label>
                                      <input class="form-control" id="sub-task" type="email" name="email" value="${response.networking_users[i].email}" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-12">
                                      <label for="sub-task">Telephone<span class="text-danger">*</span></label>
                                      <input class="form-control" id="sub-task" type="tel" name="phone" required="" value="${response.networking_users[i].phone}" autocomplete="off">
                                    </div>
                                  </div>
                                  <input id="index_var" type="hidden" value="6">
                                  <button class="btn btn-primary btn-update" id="Bookmark" onclick="submitBookMark()" type="submit"><i class="fas fa-refresh small"></i> Update</button>
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
                html.push(fullname);
                html.push(department);
                html.push(role);
                html.push(region);      
                html.push(actions);
                
                dataSet.push(html);
            }
            
            $('#networking_users').DataTable({
              pageLength: 25,
              data: dataSet
            });
            
        }
    });
})


$(document).ready(function()
{
    let dataSet = [];
    var num = '';

    $.ajax({
        url: "get_staff_count_json_sa",
        method: "GET",
        contentType: "application/json",
        DataType: "json",
        AccessControlAllowOrigin: "*",
        Processing: "True",
        success: function(response)
        {
            for(let i = 0; i<response.hardware_users.length; i++)
            {
                let html = [];
                num = (+num + 1);
                let fullname = `${response.hardware_users[i].first_name} ${response.hardware_users[i].surname}`
                let department = `${response.hardware_users[i].department}`
                let role = `${response.hardware_users[i].role}`
                let region = `${response.hardware_users[i].region}`
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
                        document.getElementById("csrf_token_hardware${response.hardware_users[i].id}").value = csrf;

                    }
                })

                $(document).ready(function() {
  
                  let dataSet = [];
                
                  $('#hardware_users').on('click','.details_${response.hardware_users[i].id}',function(){

                    $.ajax({
                      url: "get_user_tasks",
                      type: "POST",
                      data: {user_id: ${response.hardware_users[i].id}},
                      success: function(results)
                      {
                        console.log(results);
                        
                        for (let i = 0; i<results.data.length; i++)
                        {
                          let html = [];
                          let ticket_id = results.data[i].id;
                          let code = results.data[i].code;
                          let subject = results.data[i].subject;
                          let division = results.data[i].division;
                          let office = results.data[i].complainant_office;
                          let priority = results.data[i].priority;
                          let status = results.data[i].status;
                          let date_assigned = results.data[i].date_assigned;
                
                          html.push(code);
                          html.push(subject);
                          html.push(division);
                          html.push(priority);
                          html.push(status);
                          html.push(date_assigned);
                
                          dataSet.push(html)
                        }
                
                        $('#h_t${response.hardware_users[i].id}').DataTable({
                          retrieve: true,
                          data: dataSet
                        });
                      }
                    });
                  });
                })

                $(document).ready(function() {
                  
                  $('#hardware_users').on('click','.details_${response.hardware_users[i].id}',function(){

                    $.ajax({
                      url: "get_staff_performance",
                      type: "POST",
                      data: {user_id: ${response.hardware_users[i].id}},
                      success: function(results)
                      {
                        console.log(results);
                        var html = results;
                        document.getElementById('performance_id${response.hardware_users[i].id}').innerHTML = html;
                      }
                    });
                  });
                })
                </script>
                <div class="text-center">
                  <a href="#" class="btn btn-outline-dark btn-xs details_${response.hardware_users[i].id}" type="button" data-bs-toggle="modal" data-bs-target="#details${response.hardware_users[i].id}">
                    <i class="fas fa-info fa-sm" data-container="body" data-bs-toggle="tooltip" data-bs-placement="left" title="View Details"></i>
                  </a>
                </div>
                <div class="modal fade" id="details${response.hardware_users[i].id}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                      <div class="modal-header">
                        <ul class="nav main-menu" role="tablist">
                          <li class="me-2"><a class="btn btn-primary-light btn-sm" id="pills-info-tab" data-bs-toggle="pill" href="#pills-info-${response.hardware_users[i].id}" role="tab" aria-controls="pills-info" aria-selected="true"><i class="fas fa-list fa-fw"></i> Tasks</a></li>
                          <li><a class="btn btn-primary-light btn-sm show" id="pills-edit-tab" data-bs-toggle="pill" href="#pills-edit-${response.hardware_users[i].id}" role="tab" aria-controls="pills-edit" aria-selected="false"><i class="fas fa-edit fa-fw"></i> Edit</a></li>
                        </ul>
                        <a class="text-danger" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></a>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-sm-4">
                            <div class="card" style="border-radius: 5px;">
                              <div class="text-start" style="margin: 10px;">
                                <h6 class="text-warning small">STAFF INFO</h6>
                                <ul>
                                  <li><span class="text-secondary"><b>Name:</b>  ${response.hardware_users[i].first_name} ${response.hardware_users[i].surname}</span></li>
                                  <li><span class="text-secondary"><b>Role:</b>  ${response.hardware_users[i].role}</span></li>
                                  <li><span class="text-secondary"><b>Department:</b> ${response.hardware_users[i].department}</span></li>
                                  <li><span class="text-secondary"><b>Region:</b> ${response.hardware_users[i].region}</span></li>
                                  <li><span class="text-secondary"><b>E-mail:</b> ${response.hardware_users[i].email}</span></li>
                                  <li><span class="text-secondary"><b>Telephone:</b> ${response.hardware_users[i].phone}</span></li>
                                  <li><span class="text-secondary"><b>Created on:</b> ${response.software_users[i].created_at}</span></li>
                                </ul>
                              </div>
                            </div>
                            <div class="card" style="border-radius: 5px;">
                              <div class="text-start" style="margin: 10px;">
                              <div class="text-warning">
                                <h6 class="small">PERFORMANCE</h6>
                              </div>
                              <div class="m-t-15" id="performance_id${response.hardware_users[i].id}"></div>
                            </div>
                            </div>
                          </div>
                          <div class="col-sm-8">
                            <div class="card" style="border-radius: 5px;">
                              <div class="text-start" style="margin: 10px;">
                                <div class="tab-content">
                                <div class="tab-pane fade active show" id="pills-info-${response.hardware_users[i].id}" role="tabpanel" aria-labelledby="pills-info-tab">                                    
                                <h6 class="text-warning small mb-3">ASSIGNED TASKS</h6>
                                <div class="table-responsive">
                                  <table class="table table-bordered"  id="h_t${response.hardware_users[i].id}" width="100%" cellspacing="0">
                                    <thead>
                                      <tr class="small">
                                        <th>TID</th>
                                        <th>SUBJECT</th>
                                        <th>DIVISION</th>
                                        <th>PRIORITY</th>
                                        <th>STATUS</th>
                                        <th>DATE</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                              <div class="fade tab-pane" id="pills-edit-${response.hardware_users[i].id}" role="tabpanel" aria-labelledby="pills-edit-tab">                                    
                                <h6 class="text-warning small mb-3">EDIT INFO</h6>
                                <form class="form-bookmark needs-validation mt-3" method="POST" action="update_user" id="bookmark-form" novalidate="">
                                  <input type="text" id="csrf_token_hardware${response.hardware_users[i].id}" name="_token" hidden>
                                  <input type="text" name="user_id" value="${response.hardware_users[i].id}" hidden>
                                  <div class="form-row">
                                      <label for="task-title">Full Name<span class="text-danger">*</span></label>
                                      <div class="row">
                                        <div class="form-group col">
                                          <input class="form-control" id="task-title" type="text" name="first_name" required="" value="${response.hardware_users[i].first_name}" autocomplete="off">
                                        </div>
                                        <div class="form-group col">
                                          <input class="form-control" id="task-title" type="text" name="surname" required="" value="${response.hardware_users[i].surname}" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                      <label for="sub-task">Department<span class="text-danger">*</span></label>
                                      <select class="form-control" name="department_id" required="">
                                        <option value="${response.hardware_users[i].department}">${response.hardware_users[i].department}</option>
                                        <option value="Networking">Networking</option>
                                        <option value="Software">Software</option>
                                        <option value="Hardware">Hardware</option>
                                        <option value="Desktop Support">Desktop Support</option>
                                    </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                      <label for="sub-task">Role<span class="text-danger">*</span></label>
                                      <select class="form-control" name="role" required="">
                                        <option value="${response.hardware_users[i].role}">${response.hardware_users[i].role}</option>
                                        <option value="Administrator">Administrator</option>
                                        <option value="Staff">Staff</option>
                                        <option value="National Service Personnel">National Service Personnel</option>
                                      </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                      <label for="sub-task">Region<span class="text-danger">*</span></label>
                                      <select class="form-control" name="region" required="">
                                        <option value="${response.hardware_users[i].region}">${response.hardware_users[i].region}</option>
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
                                    <div class="form-group col-md-12">
                                      <label for="sub-task">E-mail</label>
                                      <input class="form-control" id="sub-task" type="email" name="email" value="${response.hardware_users[i].email}" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-12">
                                      <label for="sub-task">Telephone<span class="text-danger">*</span></label>
                                      <input class="form-control" id="sub-task" type="tel" name="phone" required="" value="${response.hardware_users[i].phone}" autocomplete="off">
                                    </div>
                                  </div>
                                  <input id="index_var" type="hidden" value="6">
                                  <button class="btn btn-primary btn-update" id="Bookmark" onclick="submitBookMark()" type="submit"><i class="fas fa-refresh small"></i> Update</button>
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
                html.push(fullname);
                html.push(department);
                html.push(role);
                html.push(region);      
                html.push(actions);
                
                dataSet.push(html);
            }
            
            $('#hardware_users').DataTable({
              pageLength: 25,
              data: dataSet
            });
            
        }
    });
})