



function getProjectData(){
    axios.get('/getProjectData')
    .then(function(response){
        if(response.status==200){
            $('#loadingDivProject').addClass('d-none');
            $('#mainDivProject').removeClass('d-none');

            $('#ProjecteDataTable').DataTable().destroy();
            $('#projectTableID').empty();
            
            var JsonData = response.data;
            $.each(JsonData, function(i,item){
                $('<tr>').html(
                    "<td> <img class='table-img' src='"+JsonData[i].project_img+"'> </td>"+
                    "<td>"+JsonData[i].project_name+"</td>"+
                    "<td>"+JsonData[i].project_desc+"</td>"+
                    "<td>"+JsonData[i].project_link+"</td>"+
                    "<td><a class='projectUpdClick' data-id="+JsonData[i].id+" ><i class='fas fa-edit'></i></a></td>"+
                    "<td><a class='projectDltClick' data-id="+JsonData[i].id+"><i class='fas fa-trash-alt'></i></a></td>"
                ).appendTo('#projectTableID');
            });
            
            /// data delete icon click
            $('.projectDltClick').click(function(){
                var id = $(this).data('id');
                $('#showIdValueProject').html(id);
                $("#deleteProjectModal").modal('show');
            })

            /// data update icon click
            $('.projectUpdClick').click(function (){
                var id = $(this).data('id');
                $('#updateCatchId').html(id);
                getUpdateDetails(id)
                $('#UpdatePojectModal').modal('show');
                
            })

            // DataTable Code

            $('#ProjecteDataTable').DataTable({'order':false});
            $('.dataTables_length').addClass('bs-select');

        }
        else{
            $('#loadingDivProject').removeClass('d-none');
        }
    }).catch(function(error){
        $('#loadingDivProject').removeClass('d-none');
    })
}

/// add new project modal show
$('#ProjectAddBtn').click(function(){
    $('#addPojectModal').modal('show');
});

/// add new project save btn click
$('#ProjectAddConfirmBtn').click(function(){
    var ProjectName = $('#addProjectIdName').val();
    var ProjectDes = $('#addProjectIdDes').val();
    var ProjectLink = $('#addProjectIdLink').val();
    var ProjectImg = $('#addProjectIdImg').val();

    addNewProject(ProjectName,ProjectDes,ProjectLink,ProjectImg);
});


/// add new project function
function addNewProject(ProjectName,ProjectDes,ProjectLink,ProjectImg){
    if(ProjectName.length==0){
        toastr.error('Project Name is Empty !');
    }
    else if(ProjectDes.length==0){
        toastr.error('Project Description is Empty !');
    }
    else if(ProjectLink.length==0){
        toastr.error('Project Link is Empty !');
    }
    else if(ProjectImg.length==0){
        toastr.error('Project Image Link is Empty !');
    }
    else{
        $('#ProjectAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");    
        axios.post('/addNewProject',{name:ProjectName,des:ProjectDes,link:ProjectLink,img:ProjectImg})
        .then(function(response){
            if(response.status==200){
                if(response.data==1){
                    $('#ProjectAddConfirmBtn').html('Save');
                    toastr.success('Project Insert Success');
                    $('#addPojectModal').modal('hide');
                    getProjectData()
                }
                else{
                    toastr.error('Project Insert Fail !');
                    $('#addPojectModal').modal('hide');
                    getProjectData()
                }  
            }
            else {
                toastr.error('Something Went Wrong !');
                $('#addPojectModal').modal('hide');
            }
            

        }).catch(function(error){
            toastr.error('Something Went Wrong !');
            $('#addPojectModal').modal('hide');
        })
    }
}



//// Delete project yes btn
$('#ProjectDltConfirmBtn').click(function(){
    var id = $('#showIdValueProject').html();
    deleteProject(id)
});


//// delete project function

function deleteProject(DeleteID){
    $('#ProjectDltConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");
    axios.post('/deleteProject',{id:DeleteID})
    .then(function(response){
        if(response.status==200){
            $('#ProjectDltConfirmBtn').html("YES");
            if(response.data==1){
                $("#deleteProjectModal").modal('hide');
                toastr.success('Project Delete Success');
                getProjectData()
            }
            else{
                $("#deleteProjectModal").modal('hide');
                toastr.error('Project Delete Fail !');
                getProjectData()
            }
        }
        else{
            $("#deleteProjectModal").modal('hide');
            toastr.error('Something Went Wrong !');
        }

    }).catch(function(error){
        $("#deleteProjectModal").modal('hide');
        toastr.error('Something Went Wrong !');
    })
}


/// update value show

function getUpdateDetails(updateID){
    axios.post('/getEachProject',{id:updateID})
    .then(function(response){
        if(response.status==200){
            $('#UpdateValueID').removeClass('d-none');
            $('#projectEditImg1').addClass('d-none');

            var JsonData = response.data;

            $('#UpdateProjectIdName').val(JsonData[0].project_name);
            $('#UpdateProjectIdDes').val(JsonData[0].project_desc);
            $('#UpdateProjectIdLink').val(JsonData[0].project_link);
            $('#UpdateProjectIdImg').val(JsonData[0].project_img);
        }
        else{
            $('#projectEditImg1').addClass('d-none');
            $('#projectEditWrongs').removeClass('d-none');
        }
    }).catch(function(error){
        $('#projectEditImg1').addClass('d-none');
        $('#projectEditWrongs').removeClass('d-none');
    });
}

/// update confirm yes btn click
$('#ProjectUpdateConfirmBtn').click(function(){
    var UpdateId = $('#updateCatchId').html();
    var UpdateName = $('#UpdateProjectIdName').val();
    var UpdateDes = $('#UpdateProjectIdDes').val();
    var UpdateLink = $('#UpdateProjectIdLink').val();
    var UpdateImg = $('#UpdateProjectIdImg').val();

    updateProject(UpdateId,UpdateName,UpdateDes,UpdateLink,UpdateImg);
});



/// update project function
function updateProject(UpdateId,UpdateName,UpdateDes,UpdateLink,UpdateImg){
    if(UpdateName.length==0){
        toastr.error('Project Name is Empty!');
    }
    else if(UpdateDes.length==0){
        toastr.error('Project Description is Empty!');
    }
    else if(UpdateLink.length==0){
        toastr.error('Project Link is Empty!');
    }
    else if(UpdateImg.length==0){
        toastr.error('Project Image Link is Empty!');
    }
    else{
        $('#ProjectUpdateConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
        axios.post('/updateProject',{id:UpdateId,name:UpdateName,des:UpdateDes,link:UpdateLink,img:UpdateImg})
    .then(function(response){
        $('#ProjectUpdateConfirmBtn').html("YES");
        if(response.status==200){
            if(response.data==1){
                $('#UpdatePojectModal').modal('hide');
                toastr.success('Data Update Success');
                getProjectData()
            }
            else{
                $('#UpdatePojectModal').modal('hide');
                toastr.error('Data Update Fail !');
                getProjectData()
            }
        }
        else{
            $('#UpdatePojectModal').modal('hide');
            toastr.error('Something Went Wrong !');
        }
    }).catch(function(error){
        $('#UpdatePojectModal').modal('hide');
        toastr.error('Something Went Wrong !');
    })
    }
    
}