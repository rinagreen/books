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
                 <a href="#addBookModal" class="btn btn-success" data-toggle="modal">
                 <i class="material-icons">&#xE147;</i>
                 <span>Add New Book</span>
                 </a>
              </div>
           </div>

           <div class="row mb-3 ">
             <!--  <div class="col-2">
                <h5>Export as:</h5>
              </div> -->
              <div class="col-12">
                <h5 style="display: inline-block;">Export as:</h5>
                <button type="button" class="btn btn-primary btn-sm csv_export">CSV</button>
                <button type="button" class="btn btn-secondary btn-sm xml_export">XML</button>
              </div>             
           </div>

           <div class="table-responsive scroll">
              <table class="table table-bordered table-striped" id="books" width="100%" cellspacing="0">
                 <thead>
                    <tr>
                       <th>ID</th>
                       <th>Title</th>
                       <th>Code</th>
                       <th>Author</th>
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
   <div id="addBookModal" class="modal fade">
      <div class="modal-dialog">
         <div class="modal-content">            
            <form action="{{ route('books.store') }}" method="POST" name="add_book">
               {{ csrf_field() }}
               <div class="modal-header">
                  <h4 class="modal-title">Add Book</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               </div>
               <div class="modal-body">
                  <div class="form-group">
                     <label>Title</label>
                     <input type="text" name="title" class="form-control" required>
                  </div>
                  <div class="form-group">
                     <label>Code</label>
                     <input type="text" name="code" class="form-control" required>
                  </div> 
                  <div class="form-group">
                    <label for="select_authors">Author</label>
                    <select class="form-control" id="select_authors" name="author_id">
                      <option> -- </option> 
                      @foreach($authors as $author)
                      <option value="{{ $author->id }}" >{{ $author->name }}</option> 
                      @endforeach
                    </select>
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
   <div id="editBookModal" class="modal fade">
      <div class="modal-dialog">
         <div class="modal-content"> 
            <form  id="edit-form" method="POST" action="">
              @csrf
              @method('PATCH')
               <div class="modal-header">
                  <h4 class="modal-title">Edit Book</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               </div>
               <div class="modal-body">
                  <div class="form-group">
                     <label>Title</label>
                     <input type="text" name="title" class="form-control edit_title" required>
                  </div>
                  <div class="form-group">
                     <label>Code</label>
                     <input type="text" name="code" class="form-control edit_code" required>
                  </div> 
                  <div class="form-group">
                    <label for="select_authors">Author</label>
                    <select class="form-control edit_author" id="select_authors" name="author_id">
                      <option> -- </option> 
                      @foreach($authors as $author)
                      <option value="{{ $author->id }}" >{{ $author->name }}</option> 
                      @endforeach
                    </select>
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
   <div id="deleteBookModal" class="modal fade">
      <div class="modal-dialog">
         <div class="modal-content"> 
            <div class="modal-header">
               <h4 class="modal-title">Delete Book</h4>
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
               <p>Are you sure you want to delete these Records?</p>
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
 
            const TABLE = $('#books').DataTable({  
                "dom": "<'col-sm-12'tr><'row' <'col-sm-12 col-sm-6'l><'col-sm-12 col-sm-6'p>>" ,  
                dom: 'Bfrtip',
                buttons: [ 
                    'colvis'
                ],
                "aaSorting": [[ 0, "desc" ]],
                "aoColumnDefs": [
                  { "bSortable": false, "aTargets": [ 4 ] },
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
                   "url": "{{ url('ajax-all-books') }}" ,
                   "dataType": "json",
                   "type": "POST",
                    "data": function (d) {
                        d._token = "{{csrf_token()}}",
                        d.search = $('#column_search').val()
                    } 
                 }, 
                "columns": [
                    { "data": "id" },
                    { "data": "title" },
                    { "data": "code" },
                    { "data": "author_id" },
                    { "data": "actions" }
                ],
                "drawCallback": function( data ) {  
                    $('.no_of_users').text(data.json.recordsFiltered);
                },
            });


            $('#column_search').on( 'keyup', function () {
              TABLE.draw();
            });
 
 

            $('#books').on('click', '.editBookModalButton', function () {                
               let code = $(this).attr('data-code'),
                  title = $(this).attr('data-title'),
                  url = $(this).attr('data-url'),
                  author_id = $(this).attr('data-author-id')

                  $('.edit_code').val(code);
                  $('.edit_title').val(title);
                  $('.edit_author').val(author_id);
                  $('#edit-form').attr('action', url);
            });

            $('#books').on('click', '.deleteBookModalButton', function () {                
               let url = $(this).attr('data-url'); 
               $('#delete-form').attr('action', url);
            });
 

             $(document).on('click', '.csv_export', function (){
                $('table').tableExport({type:'csv'});
             });

             $(document).on('click', '.xml_export', function (){
                $('table').tableExport({ 
                    type:'excel',
                    mso: {
                      fileFormat:'xmlss',
                      worksheetName: ['Table 1','Table 2', 'Table 3']
                    }
                });
             });

        }); 
    </script>

   @endpush
@endsection