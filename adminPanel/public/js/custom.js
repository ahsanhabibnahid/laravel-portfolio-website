$(document).ready(function() {
    $('#VisitorDt').DataTable();
    $('.dataTables_length').addClass('bs-select');
});

// get services data from database

function getServiceData() {

    axios.get('/getServiceData')
        .then(function(response) {
            if (response.status == 200) {
                $('#mainDiv').removeClass('d-none');
                $('#loadingDiv').addClass('d-none');

                $('#serviceTableID').empty();

                var jsonData = response.data;
                $.each(jsonData, function(i, item) {
                    $("<tr>").html(
                        "<td><img class='table-img' src=" + jsonData[i].service_img + "></td>" +
                        "<td>" + jsonData[i].service_name + "</td>" +
                        "<td>" + jsonData[i].service_des + "</td>" +
                        "<td><a href=''><i class='fas fa-edit'></i></a></td>" +
                        "<td><a class='serviceDeleteBtn' data-id=" + jsonData[i].id + " ><i class='fas fa-trash-alt'></i></a></td>"
                    ).appendTo('#serviceTableID');
                });

                // click delete icon and show modal
                $('.serviceDeleteBtn').click(function() {
                    var id = $(this).data('id');
                    $('#showIdValue').html(id);
                    $('#deleteService').modal('show');
                });

                // click delete confirm
                $('#serviceConfirmBtn').click(function() {
                    var id = $('#showIdValue').html();
                    serviceDataDelete(id);
                });

            } else {
                $('#loadingDiv').addClass('d-none');
                $('#wrongDiv').removeClass('d-none');
            }


        }).catch(function(error) {
            $('#loadingDiv').addClass('d-none');
            $('#wrongDiv').removeClass('d-none');
        });
}

// service delete from database
function serviceDataDelete(deleteId) {
    axios.post('/DeleteService', {
            id: deleteId
        })
        .then(function(response) {
            if (response.data == 1) {
                $('#deleteService').modal('hide');
                toastr.success('Delete Success.');
                getServiceData()
            } else {
                $('#deleteService').modal('hide');
                toastr.error('Delete Fail.');
                getServiceData()
            }
        }).catch(function(error) {

        })
}