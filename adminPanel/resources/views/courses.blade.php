@extends('layout.app')

@section('content')


<!-- table div -->
<div id='mainDivCourse' class="container">
    <div class="row">
        <div class="col-md-12 p-5">
        <button id='courseAddBtn' class='btn btn-danger my-4'>Add New</button>
            <table id="CourseDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                    <th class="th-sm">Name</th>
                    <th class="th-sm">Fee</th>
                    <th class="th-sm">Class</th>
                    <th class="th-sm">Enroll</th>
                    <th class="th-sm">Edit</th>
                    <th class="th-sm">Delete</th>
                    </tr>
                </thead>
                <tbody id="courseTableID">
                   	   
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- loader div -->
<div id='loadingDivCourse' class="container">
    <div class="row">
        <div class="col-md-12 p-5 text-center">
            <img class='w-50' src="{{asset('images/loading.gif')}}" alt="">
        </div>
    </div>
</div>


<!-- wrong div -->
<div id='wrongDivCourse' class="container d-none">
    <div class="row">
        <div class="col-md-12 p-5 text-center">
            <h2>Something Went Wrong!</h2>
        </div>
    </div>
</div>


<!-- add new course modal  -->
<div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Add New Course</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">
       <div class="container">
       	<div class="row">
       		<div class="col-md-6">
             	<input id="CourseNameId" type="text"  class="form-control mb-3" placeholder="Course Name">
          	 	<input id="CourseDesId" type="text"  class="form-control mb-3" placeholder="Course Description">
    		 	<input id="CourseFeeId" type="text"  class="form-control mb-3" placeholder="Course Fee">
     			<input id="CourseEnrollId" type="text"  class="form-control mb-3" placeholder="Total Enroll">
       		</div>
       		<div class="col-md-6">
     			<input id="CourseClassId" type="text"  class="form-control mb-3" placeholder="Total Class">      
     			<input id="CourseLinkId" type="text"  class="form-control mb-3" placeholder="Course Link">
     			<input id="CourseImgId" type="text"  class="form-control mb-3" placeholder="Course Image">
       		</div>
       	</div>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="CourseAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>
<!-- add new course modal end  -->



<!-- Modal for Delete Course -->
<div class="modal fade" id="deleteCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body mt-3 mb-1">
      <h5 class='float-left'>Do you want to delete?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h6 id='showCourseIdValue' class='d-none'></h6>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
        <button data-id=" " id="courseConfirmBtn" type="button" class="btn btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>


<!-- Update course modal  -->
<div class="modal fade" id="updateCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Update Course</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">
        <h5 id='courseIdValueUpdate' class='d-none'></h5>
        <div id='courseEditForm' class="container d-none" >
            <div class="row">
                <div class="col-md-6">
                    <input id="CourseNameIdUpdate" type="text"  class="form-control mb-3" placeholder="Course Name">
                    <input id="CourseDesIdUpdate" type="text" class="form-control mb-3" placeholder="Course Description">
                    <input id="CourseFeeIdUpdate" type="text"  class="form-control mb-3" placeholder="Course Fee">
                    <input id="CourseEnrollIdUpdate" type="text" class="form-control mb-3" placeholder="Total Enroll">
                </div>
                <div class="col-md-6">
                    <input id="CourseClassIdUpdate" type="text"  class="form-control mb-3" placeholder="Total Class">      
                    <input id="CourseLinkIdUpdate" type="text"  class="form-control mb-3" placeholder="Course Link">
                    <input id="CourseImgIdUpdate" type="text"  class="form-control mb-3" placeholder="Course Image">
                </div>
            </div>
        </div>
        <img id='courseEditImgLoader' class='w-50 mx-auto' src="{{asset('images/loading.gif')}}" alt="">
        <h2 id='courseEditWrongText' class='text-center d-none'>Something Went Wrong!</h2>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="CourseAddConfirmBtnUpdate" type="button" class="btn  btn-sm  btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>
<!-- Update course modal end  -->

@endsection


@section('script')

<script type='text/javascript'>

getCourseData();

/// all code cut from custom js



function getCourseData() {

axios.get('/getCourseData')
    .then(function(response) {
        if (response.status == 200) {
            $('#mainDivCourse').removeClass('d-none');
            $('#loadingDivCourse').addClass('d-none');
            
            $('#CourseDataTable').DataTable().destroy();
            $('#courseTableID').empty();

            var jsonData = response.data;
            $.each(jsonData, function(i, item) {
                $("<tr>").html(
                    "<td>"+jsonData[i].course_name+"</td>" +
                    "<td>"+jsonData[i].course_fee+"</td>" +
                    "<td>"+jsonData[i].course_totalclass+"</td>" +
                    "<td>"+jsonData[i].course_totalenroll+"</td>" +
                    "<td><a class='courseEditBtn' data-id=" + jsonData[i].id + " ><i class='fas fa-edit'></i></a></td>" +
                    "<td><a class='courseDeleteBtn' data-id=" + jsonData[i].id + " ><i class='fas fa-trash-alt'></i></a></td>"
                ).appendTo('#courseTableID');
            });  
            
            /// delete icon click
            $('.courseDeleteBtn').click(function(){
                var id = $(this).data('id');
                $('#showCourseIdValue').html(id);
                $('#deleteCourseModal').modal('show');
            });

            /// update icon click
            $('.courseEditBtn').click(function(){
                var id = $(this).data('id');
                $('#courseIdValueUpdate').html(id);
                updateEachCourse(id);
                $('#updateCourseModal').modal('show');
            });


            // DataTable Code
            $('#CourseDataTable').DataTable({'order':false});
            $('.dataTables_length').addClass('bs-select');


        } else {
            $('#loadingDivCourse').addClass('d-none');
            $('#wrongDivCourse').removeClass('d-none');
        }


    }).catch(function(error) {
        $('#loadingDivCourse').addClass('d-none');
        $('#wrongDivCourse').removeClass('d-none');
    });
}


//// add new course btn show modal

$('#courseAddBtn').click(function(){
$('#addCourseModal').modal('show');
});

//// add new course modal yes btn
$('#CourseAddConfirmBtn').click(function(){
var CourseName = $('#CourseNameId').val();
var CourseDes = $('#CourseDesId').val();
var CourseFee = $('#CourseFeeId').val();
var CourseEnroll = $('#CourseEnrollId').val();
var CourseClass = $('#CourseClassId').val();
var CourseLink = $('#CourseLinkId').val();
var CourseImg = $('#CourseImgId').val();

addCourseFunction(CourseName,CourseDes,CourseFee,CourseEnroll,CourseClass,CourseLink,CourseImg);
});


//add new function
function addCourseFunction(CourseName,CourseDes,CourseFee,CourseEnroll,CourseClass,CourseLink,CourseImg){
if(CourseName.length==0){
    toastr.error('Course Name is Empty !');
}
else if(CourseDes.length==0){
    toastr.error('Course Description is Empty !');
}
else if(CourseFee.length==0){
    toastr.error('Course Fee is Empty !');
}
else if(CourseEnroll.length==0){
    toastr.error('Course Enroll is Empty !');
}
else if(CourseClass.length==0){
    toastr.error('Course Class is Empty !');
}
else if(CourseLink.length==0){
    toastr.error('Course Link is Empty !');
}
else if(CourseImg.length==0){
    toastr.error('Course Image is Empty !');
}
else{
    $('#CourseAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");
    axios.post('/addNewCourse',{
        name:CourseName,
        des:CourseDes,
        fee:CourseFee,
        totalenroll:CourseEnroll,
        totalclass:CourseClass,
        link:CourseLink,
        img:CourseImg
    })
    .then(function(response){
        $('#CourseAddConfirmBtn').html('Save');
        if(response.status==200){
            if(response.data==1){
                $('#addCourseModal').modal('hide');
                toastr.success('Add New Course Success');
                getCourseData()
            }
            else {
                $('#addCourseModal').modal('hide');
                toastr.success('Add New Course Fail');
                getCourseData()
            }
        }
        else{
            $('#addCourseModal').modal('hide');
            toastr.error('Something Went Wrong !');
        }
    }).catch(function(error){
        $('#addCourseModal').modal('hide');
        toastr.error('Something Went Wrong !');
    });
}
}

/// delete yes btn

$('#courseConfirmBtn').click(function(){
var id = $('#showCourseIdValue').html();
CourseDelete(id)
});


// Course delete from database
function CourseDelete(deleteId) {
$('#courseConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");
axios.post('/DeleteCourse', {
        id: deleteId
    })
    .then(function(response) {
        $('#courseConfirmBtn').html('YES');
        if(response.status==200){
            if (response.data == 1) {
                $('#deleteCourseModal').modal('hide');
                toastr.success('Delete Success.');
                getCourseData();
            } else {
                $('#deleteCourseModal').modal('hide');
                toastr.error('Delete Fail.');
                getCourseData();
            }
        }
        else{
            $('#deleteCourseModal').modal('hide');
            toastr.error('Something Went Wrong !');
        }
    }).catch(function(error) {
        $('#deleteCourseModal').modal('hide');
        toastr.error('Something Went Wrong !');
    })
}


// get details and update each from database
function updateEachCourse(detailsId){
axios.post('/DetailsCourse',{id:detailsId})
.then(function(response){
    if(response.status==200){
        $('#courseEditForm').removeClass('d-none');
        $('#courseEditImgLoader').addClass('d-none');
        
        var jsonData = response.data;
        $('#CourseNameIdUpdate').val(jsonData[0].course_name);
        $('#CourseDesIdUpdate').val(jsonData[0].course_des);
        $('#CourseFeeIdUpdate').val(jsonData[0].course_fee);
        $('#CourseEnrollIdUpdate').val(jsonData[0].course_totalenroll);
        $('#CourseClassIdUpdate').val(jsonData[0].course_totalclass);
        $('#CourseLinkIdUpdate').val(jsonData[0].course_link);
        $('#CourseImgIdUpdate').val(jsonData[0].course_img);
    }
    else{
        $('#courseEditImgLoader').addClass('d-none');
        $('#courseEditWrongText').removeClass('d-none');
    }
}).catch(function (error){
    $('#courseEditImgLoader').addClass('d-none');
    $('#courseEditWrongText').removeClass('d-none');
})
}

//course update confirm

$('#CourseAddConfirmBtnUpdate').click(function(){
    var Courseid = $('#courseIdValueUpdate').html();
    var Coursename = $('#CourseNameIdUpdate').val();
    var Coursedes = $('#CourseDesIdUpdate').val();
    var Coursefee = $('#CourseFeeIdUpdate').val();
    var Courseenroll = $('#CourseEnrollIdUpdate').val();
    var Courseclass = $('#CourseClassIdUpdate').val();
    var Courselink = $('#CourseLinkIdUpdate').val();
    var Courseimg = $('#CourseImgIdUpdate').val();
    
    updateCourse(Courseid,Coursename,Coursedes,Coursefee,Courseenroll,Courseclass,Courselink,Courseimg)
});

// update function

function updateCourse(Courseid,Coursename,Coursedes,Coursefee,Courseenroll,Courseclass,Courselink,Courseimg){

    if(Coursename.length==0){
        toastr.error('Course Name is Empty!');
    }
    else if(Coursedes.length==0){
        toastr.error('Course Description is Empty!');
    }
    else if(Coursefee.length==0){
        toastr.error('Course Fee is Empty!');
    }
    else if(Courseenroll.length==0){
        toastr.error('Course Enroll is Empty!');
    }
    else if(Courseclass.length==0){
        toastr.error('Course Class is Empty!');
    }
    else if(Courselink.length==0){
        toastr.error('Course Link is Empty!');
    }
    else if(Courseimg.length==0){
        toastr.error('Course Image is Empty!');
    }
    else{
        $('#CourseAddConfirmBtnUpdate').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
        axios.post('/UpdateCourse',{
            id:Courseid,
            name:Coursename,
            des:Coursedes,
            fee:Coursefee,
            totalenroll:Courseenroll,
            totalclass:Courseclass,
            link:Courselink,
            img:Courseimg
        })
        .then(function(response){
            $('#CourseAddConfirmBtnUpdate').html("YES");
            if(response.status==200){
                if(response.data==1){
                    $('#updateCourseModal').modal('hide');
                    toastr.success('Data Update Success');
                    getCourseData()
                }
                else{
                    $('#updateCourseModal').modal('hide');
                    toastr.error('Data Update Fail !');
                    getCourseData()
                }
            }
            else{
                $('#updateCourseModal').modal('hide');
                toastr.error('Something Went Wrong !');
            }
    
        }).catch(function(error){
            $('#updateCourseModal').modal('hide');
            toastr.error('Something Went Wrong !');
        })
    }  
}


</script>

@endsection