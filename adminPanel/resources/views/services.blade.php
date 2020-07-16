@extends('layout.app')

@section('content')



<div id='mainDiv' class="container d-none">
    <div class="row">
        <div class="col-md-12 p-5">

            <table id="" class="table table-striped table-bordered" cellspacing="0" width="100%">
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



<div id='loadingDiv' class="container">
<div class="row">
<div class="col-md-12 p-5 text-center">

    <img class='w-50' src="{{asset('images/loading.gif')}}" alt="">

</div>
</div>
</div>



<div id='wrongDiv' class="container d-none">
<div class="row">
<div class="col-md-12 p-5 text-center">

    <h2>Something Went Wrong!</h2>

</div>
</div>
</div>



<!-- Modal -->
<div class="modal fade" id="deleteService" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body mt-3 mb-1">
        <h5>Do you want to delete?</h5>
        <h6 id='showIdValue' class='d-none'></h6>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
        <button data-id=" " id="serviceConfirmBtn" type="button" class="btn btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('script')

    <script type='text/javascript'>
        getServiceData()
    </script>

@endsection