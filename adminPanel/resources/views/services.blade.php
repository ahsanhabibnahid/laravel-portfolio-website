@extends('layout.app')

@section('content')
 

<!-- sercice table -->
<div id='mainDiv' class="container d-none">
    
    <div class="row">
        <div class="col-md-12 p-5">
        <button id='serviceAddBtn' class='btn btn-danger my-4'>Add New</button>
            <table id="ServiceDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                    <th class="th-sm">Image</th>
                    <th class="th-sm">Name</th>
                    <th class="th-sm">Description</th>
                    <th class="th-sm">Edit</th>
                    <th class="th-sm">Delete</th>
                    </tr>
                </thead>
                <tbody id='serviceTableID'>
                 
                </tbody>
            </table>

        </div>
    </div>
</div>


<!-- service loader -->
<div id='loadingDiv' class="container">
    <div class="row">
        <div class="col-md-12 p-5 text-center">
            <img class='w-50' src="{{asset('images/loading.gif')}}" alt="">
        </div>
    </div>
</div>

<!-- service wrong -->

<div id='wrongDiv' class="container d-none">
    <div class="row">
        <div class="col-md-12 p-5 text-center">
            <h2>Something Went Wrong!</h2>
        </div>
    </div>
</div>



<!-- Modal for Delete Service -->
<div class="modal fade" id="deleteService" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    
      <div class="modal-body mt-3 mb-1">
        <h5 class='float-left'>Do you want to delete?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h6 id='showIdValue' class='d-none'></h6>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
        <button data-id=" " id="serviceConfirmBtn" type="button" class="btn btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal for Edit -->
<div class="modal fade" id="editService" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Update Service</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mt-3 mb-1">

        <h6 id='serviceIdValue' class='d-none'></h6>
        <div class='d-none' id='serviceEditForm'>
          <input id="serviceIdName" type="text" class="form-control mb-4" placeholder='Service Name'>
          <input id="serviceIdDes" type="text" class="form-control mb-4" placeholder='Service Description'>
          <input id="serviceIdImg" type="text" class="form-control mb-4" placeholder='Service Image Link'>
        </div>
        <img id='serviceEditImg1' class='w-50 mx-auto' src="{{asset('images/loading.gif')}}" alt="">
        <h2 id='serviceEditWrongs' class='text-center d-none'>Something Went Wrong!</h2>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
        <button data-id=" " id="serviceUpdateConfirmBtn" type="button" class="btn btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>



<!-- Modal For Add New Service -->

<div class="modal fade" id="addServiceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body mt-3 mb-1">

        <div id='serviceAddForm'>
          <h5 class='text-center text-danger mb-4'>Add New Service</h5>
          <input id="addServiceIdName" type="text" class="form-control mb-4" placeholder='Service Name'>
          <input id="addServiceIdDes" type="text" class="form-control mb-4" placeholder='Service Description'>
          <input id="addServiceIdImg" type="text" class="form-control mb-4" placeholder='Service Image Link'>
        </div>

      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        <button data-id=" " id="serviceAddConfirmBtn" type="button" class="btn btn-success">Save</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('script')

    <script type='text/javascript'>
        getServiceData()


// Eigula custom.js er code Develop er subidhar jonno akhn eikhane code gula raktasi

        // get services data from database

function getServiceData() {

axios.get('/getServiceData')
    .then(function(response) {
        if (response.status == 200) {
            $('#mainDiv').removeClass('d-none');
            $('#loadingDiv').addClass('d-none');

            $('#ServiceDataTable').DataTable().destroy();
            $('#serviceTableID').empty();

            var jsonData = response.data;
            $.each(jsonData, function(i, item) {
                $("<tr>").html(
                    "<td><img class='table-img' src=" + jsonData[i].service_img + "></td>" +
                    "<td>" + jsonData[i].service_name + "</td>" +
                    "<td>" + jsonData[i].service_des + "</td>" +
                    "<td><a class='serviceEditBtn' data-id=" + jsonData[i].id + " ><i class='fas fa-edit'></i></a></td>" +
                    "<td><a class='serviceDeleteBtn' data-id=" + jsonData[i].id + " ><i class='fas fa-trash-alt'></i></a></td>"
                ).appendTo('#serviceTableID');
            });

            // click delete icon and show modal
            $('.serviceDeleteBtn').click(function() {
                var id = $(this).data('id');
                $('#showIdValue').html(id);
                $('#deleteService').modal('show');
            });

            //click edit icon and show modal
            $('.serviceEditBtn').click(function(){
                var id = $(this).data('id');
                $('#serviceIdValue').html(id);
                updateEachService(id);
                $('#editService').modal('show');
            })

            // DataTable Code

            $('#ServiceDataTable').DataTable({'order':false});
            $('.dataTables_length').addClass('bs-select');



        } else {
            $('#loadingDiv').addClass('d-none');
            $('#wrongDiv').removeClass('d-none');
        }


    }).catch(function(error) {
        $('#loadingDiv').addClass('d-none');
        $('#wrongDiv').removeClass('d-none');
    });
}


// click delete confirm
$('#serviceConfirmBtn').click(function() {
var id = $('#showIdValue').html();
serviceDataDelete(id);
});

//service update confirm
$('#serviceUpdateConfirmBtn').click(function(){
var id = $('#serviceIdValue').html();
var name = $('#serviceIdName').val();
var des= $('#serviceIdDes').val();
var img = $('#serviceIdImg').val();
updateService(id,name,des,img)

});


// service delete from database
function serviceDataDelete(deleteId) {
$('#serviceConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");
axios.post('/DeleteService', {
        id: deleteId
    })
    .then(function(response) {
        $('#serviceConfirmBtn').html('YES');
        if(response.status==200){
            if (response.data == 1) {
                $('#deleteService').modal('hide');
                toastr.success('Delete Success.');
                getServiceData()
            } else {
                $('#deleteService').modal('hide');
                toastr.error('Delete Fail.');
                getServiceData()
            }
        }
        else{
            $('#deleteService').modal('hide');
            toastr.error('Something Went Wrong !');
        }
    }).catch(function(error) {
        $('#deleteService').modal('hide');
        toastr.error('Something Went Wrong !');
    })
}

// get details and update each from database
function updateEachService(detailsId){
axios.post('/DetailsService',{id:detailsId})
.then(function(response){
    if(response.status==200){
        $('#serviceEditForm').removeClass('d-none');
        $('#serviceEditImg1').addClass('d-none');
        
        var jsonData = response.data;
        $('#serviceIdName').val(jsonData[0].service_name);
        $('#serviceIdDes').val(jsonData[0].service_des);
        $('#serviceIdImg').val(jsonData[0].service_img);
    }
    else{
        $('#serviceEditImg1').addClass('d-none');
        $('#serviceEditWrongs').removeClass('d-none');
    }
}).catch(function (error){
    $('#serviceEditImg1').addClass('d-none');
    $('#serviceEditWrongs').removeClass('d-none');
})
}


// service update

function updateService(serviceId,serviceName,serviceDes,serviceImg){

if(serviceName.length==0){
    toastr.error('Service Name is Empty!');
}
else if(serviceDes.length==0){
    toastr.error('Service Description is Empty!');
}
else if(serviceImg.length==0){
    toastr.error('Service Image is Empty!');
}
else{
    $('#serviceUpdateConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
    axios.post('/UpdateService',{id:serviceId,name:serviceName,des:serviceDes,img:serviceImg})
    .then(function(response){
        $('#serviceUpdateConfirmBtn').html("YES");
        if(response.status==200){
            if(response.data==1){
                $('#editService').modal('hide');
                toastr.success('Data Update Success');
                getServiceData()
            }
            else{
                $('#editService').modal('hide');
                toastr.error('Data Update Fail !');
                getServiceData()
            }
        }
        else{
            $('#editService').modal('hide');
            toastr.error('Something Went Wrong !');
        }

    }).catch(function(error){
        $('#editService').modal('hide');
        toastr.error('Something Went Wrong !');
    })
}  
}


// add new service button click
$('#serviceAddBtn').click(function(){
$("#addServiceModal").modal('show');
});


// add new service yes button click
$('#serviceAddConfirmBtn').click(function(){
var name = $('#addServiceIdName').val();
var des = $('#addServiceIdDes').val();
var img = $('#addServiceIdImg').val();
addServiceFunction(name,des,img);
});


// add new service function
function addServiceFunction(nameVal,desVal,imgVal){
if(nameVal.length==0){
    toastr.error('Service Name is Empty !');
}
else if(desVal.length==0){
    toastr.error('Service Description is Empty !');
}
else if(imgVal.length==0){
    toastr.error('Service Image is Empty !');
}
else{
    $('#serviceAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");
    axios.post('/addNewService',{name:nameVal,des:desVal,img:imgVal})
    .then(function(response){
        $('#serviceAddConfirmBtn').html('Save');
        if(response.status==200){
            if(response.data==1){
                $('#addServiceModal').modal('hide');
                toastr.success('Add New Service Success');
                getServiceData()
            }
            else {
                $('#addServiceModal').modal('hide');
                toastr.success('Add New Service Fail');
                getServiceData()
            }
        }
        else{
            $('#addServiceModal').modal('hide');
            toastr.error('Something Went Wrong !');
        }
    }).catch(function(error){
        $('#addServiceModal').modal('hide');
        toastr.error('Something Went Wrong !');
    });
}
}

    </script>

@endsection