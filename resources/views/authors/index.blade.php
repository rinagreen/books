@extends('layout.index')

@section('content')

  <div class="container mt-4">
     <div class="card shadow">
        <div class="card-header" style="background: #435d7d; color:#fff">
           <h5 class="m-0 font-weight-bold text-gray-900">{{ $pageTitle }}</h5>
        </div>
        <div class="card-body">
           <div class=" row mb-3 table-title" style="background: #fff">
              <div class="col-sm-6 col-lg-5">
                 <div class="input-group">
                    <input type="text" class="form-control" aria-label="Search" id="column_search">
                    <div class="input-group-append">
                       <span class="input-group-text">Search</span>
                    </div>
                 </div>
              </div>
              <div class="col-sm-6 col-lg-7 text-right"> 
                 <a href="#addAuthorModal" class="btn btn-success" data-toggle="modal">
                 <i class="material-icons">&#xE147;</i>
                 <span>Add New Author</span>
                 </a>
              </div>
           </div>
 
           <div class="table-responsive scroll">
              <table class="table table-bordered table-striped" id="authors" width="100%" cellspacing="0">
                 <thead>
                    <tr>
                       <th>ID</th>
                       <th>Name</th> 
                       <th>Actions</th>
                    </tr>
                 </thead>
                 <tbody> 
                 </tbody>
              </table>
           </div>
        </div>
     </div>
  </div>

   <!-- Add Modal HTML -->
   <div id="addAuthorModal" class="modal fade">
      <div class="modal-dialog">
         <div class="modal-content">            
            <form action="{{ route('authors.store') }}" method="POST" name="add_author">
               {{ csrf_field() }}
               <div class="modal-header">
                  <h4 class="modal-title">Add Author</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               </div>
               <div class="modal-body">
                  <div class="form-group">
                     <label>Name</label>
                     <input type="text" name="name" class="form-control" required>
                  </div> 
               </div>
               <div class="modal-footer">
                  <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                  <input type="submit" class="btn btn-success" value="Add">
               </div>
            </form>
         </div>
      </div>
   </div>


   <!-- Edit Modal HTML -->
   <div id="editAuthorModal" class="modal fade">
      <div class="modal-dialog">
         <div class="modal-content"> 
            <form  id="edit-form" method="POST" action="">
              @csrf
              @method('PATCH')
               <div class="modal-header">
                  <h4 class="modal-title">Edit Author</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               </div>
               <div class="modal-body">
                  <div class="form-group">
                     <label>Name</label>
                     <input type="text" name="name" class="form-control edit_name" required>
                  </div> 
               </div>
               <div class="modal-footer">
                  <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                  <input type="submit" class="btn btn-info" value="Save">
               </div>
            </form>
         </div>
      </div>
   </div>

   <!-- Delete Modal HTML -->
   <div id="deleteAuthorModal" class="modal fade">
      <div class="modal-dialog">
         <div class="modal-content"> 
            <div class="modal-header">
               <h4 class="modal-title">Delete Author</h4>
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
               <p>Are you sure you want to delete these Record?</p>
               <p class="text-warning"><small>This action cannot be undone.</small></p>
            </div> 
            <div class="modal-footer">
               <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
               <form method="POST" id="delete-form">
                  @csrf
                  @method('DELETE')
                  <input type="submit" class="btn btn-danger" value="Delete">
               </form>
            </div> 
         </div>
      </div>
   </div>

   @push('scripts')


    <script>

        $(document).ready(function () {
 
            const TABLE = $('#authors').DataTable({  
                "dom": "<'col-sm-12'tr><'row' <'col-sm-12 col-sm-6'l><'col-sm-12 col-sm-6'p>>" ,  
                "aaSorting": [[ 0, "desc" ]],
                "aoColumnDefs": [
                  { "bSortable": false, "aTargets": [ 2 ] },
                  { "sType": "numeric", "aTargets": [ 0 ] }
                ],
                "language": {
                  "paginate": {
                    "previous": "<span aria-hidden='true'>«</span>",
                    "next": "<span aria-hidden='true'>»</span>"
                  },
                  "sLengthMenu": "<span>Show</span> _MENU_ <span>records</span> <span>of <span class='no_of_users'></span></span>",
                },
                "processing": true,
                "serverSide": true,
                "ajax":{
                   "url": "{{ url('ajax-all-authors') }}" ,
                   "dataType": "json",
                   "type": "POST",
                    "data": function (d) {
                        d._token = "{{csrf_token()}}",
                        d.search = $('#column_search').val()
                    } 
                 }, 
                "columns": [
                    { "data": "id" },
                    { "data": "name" },
                    { "data": "actions" }
                ],
                "drawCallback": function( data ) {  
                    $('.no_of_users').text(data.json.recordsFiltered);
                },
            });


            $('#column_search').on( 'keyup', function () {
              TABLE.draw();
            });   

            $('#authors').on('click', '.editAuthorModalButton', function () {                
               let name = $(this).attr('data-name'),
                  url = $(this).attr('data-url'),
                  author_id = $(this).attr('data-author-id')
 
                  $('.edit_name').val(name);
                  $('#edit-form').attr('action', url);
            });

            $('#authors').on('click', '.deleteAuthorModalButton', function () {                
               let url = $(this).attr('data-url'); 
               $('#delete-form').attr('action', url);
            });
 
        }); 
    </script>

   @endpush
@endsection