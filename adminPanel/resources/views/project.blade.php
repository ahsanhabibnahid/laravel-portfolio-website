@extends('layout.app')

@section('content')

 
<!-- project table -->
<div id='mainDivProject' class="container d-none">
    
    <div class="row">
        <div class="col-md-12 p-5">
        <button id='ProjectAddBtn' class='btn btn-danger my-4'>Add New</button>
            <table id="ProjecteDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                    <th class="th-sm">Image</th>
                    <th class="th-sm">Name</th>
                    <th class="th-sm">Description</th>
                    <th class="th-sm">Link</th>
                    <th class="th-sm">Edit</th>
                    <th class="th-sm">Delete</th>
                    </tr>
                </thead> 
                <tbody id='projectTableID'>
                 
                </tbody>
            </table>

        </div>
    </div>
</div>


<!-- project loader -->
<div id='loadingDivProject' class="container">
    <div class="row">
        <div class="col-md-12 p-5 text-center">
            <img class='w-50' src="{{asset('images/loading.gif')}}" alt="">
        </div>
    </div>
</div>

<!-- project wrong -->

<div id='wrongDivProject' class="container d-none">
    <div class="row">
        <div class="col-md-12 p-5 text-center">
            <h2>Something Went Wrong!</h2>
        </div>
    </div>
</div>



<!-- Modal For Add New Project -->

<div class="modal fade" id="addPojectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body mt-3 mb-1">

        <div id='serviceAddForm'>
          <h5 class='text-center text-danger mb-4'>Add New Project</h5>
          <input id="addProjectIdName" type="text" class="form-control mb-4" placeholder='Project Name'>
          <input id="addProjectIdDes" type="text" class="form-control mb-4" placeholder='Project Description'>
          <input id="addProjectIdLink" type="text" class="form-control mb-4" placeholder='Project Link'>
          <input id="addProjectIdImg" type="text" class="form-control mb-4" placeholder='Project Image Link'>
        </div>

      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        <button data-id=" " id="ProjectAddConfirmBtn" type="button" class="btn btn-success">Save</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal for Delete Project -->
<div class="modal fade" id="deleteProjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    
      <div class="modal-body mt-3 mb-1">
        <h5 class='float-left'>Do you want to delete?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h6 id='showIdValueProject' ></h6>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
        <button data-id=" " id="ProjectDltConfirmBtn" type="button" class="btn btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>



<!-- Modal For Update Project -->

<div class="modal fade" id="UpdatePojectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body mt-3 mb-1">

        <div id='serviceAddForm'>
            <h5 id='updateCatchId'></h5>
          <h5 class='text-center text-danger mb-4'>Update Project</h5>
        <div id='UpdateValueID' class='d-none'>
          <input id="UpdateProjectIdName" type="text" class="form-control mb-4" placeholder='Project Name'>
          <input id="UpdateProjectIdDes" type="text" class="form-control mb-4" placeholder='Project Description'>
          <input id="UpdateProjectIdLink" type="text" class="form-control mb-4" placeholder='Project Link'>
          <input id="UpdateProjectIdImg" type="text" class="form-control mb-4" placeholder='Project Image Link'>
        </div>

        <img id='projectEditImg1' class='w-50 mx-auto' src="{{asset('images/loading.gif')}}" alt="">
        <h2 id='projectEditWrongs' class='text-center d-none'>Something Went Wrong!</h2>
        
        </div>

      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        <button data-id=" " id="ProjectUpdateConfirmBtn" type="button" class="btn btn-success">Save</button>
      </div>
    </div>
  </div>
</div>








@endsection




@section('script')

<script type="text/javascript">

getProjectData()


</script>

@endsection