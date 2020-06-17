@extends('layout.index')

@section('content')

   <div class="container">
      <div class="table-wrapper">
         <div class="table-title">
            <div class="row">
               <div class="col-sm-6">
                  <h2>Manage <b>Books</b></h2>
               </div>
               <div class="col-sm-6">
                  <a href="#addBookModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Book</span></a>
                  <a href="#deleteBookModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a>                 
               </div>
            </div>
         </div>
         <table class="table table-striped table-hover" id="books" >
            <thead>
               <tr>
                 <!--  <th>
                     <span class="custom-checkbox">
                     <input type="checkbox" id="selectAll">
                     <label for="selectAll"></label>
                     </span>
                  </th> -->
                  <th>ID</th>
                  <th>Title</th>
                  <th>Code</th>
                  <th>Author</th>
                  <th>Actions</th>
               </tr>
            </thead>
            <tbody>
             <!--   <tr>
                  <td>
                     <span class="custom-checkbox">
                     <input type="checkbox" id="checkbox1" name="options[]" value="1">
                     <label for="checkbox1"></label>
                     </span>
                  </td>
                  <td>10</td>
                  <td>20 days Christmas</td>
                  <td>171-555-2222</td>
                  <td>Thomas Hardy</td>
                  <td>
                     <a href="#editBookModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                     <a href="#deleteBookModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                  </td>
               </tr>
               <tr>
                  <td>
                     <span class="custom-checkbox">
                     <input type="checkbox" id="checkbox2" name="options[]" value="1">
                     <label for="checkbox2"></label>
                     </span>
                  </td>
                  <td>9</td>
                  <td>Objera kany</td>
                  <td>313-555-5735</td>
                  <td>Dominique Perrier</td>
                  <td>
                     <a href="#editBookModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                     <a href="#deleteBookModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                  </td>
               </tr>
               <tr>
                  <td>
                     <span class="custom-checkbox">
                     <input type="checkbox" id="checkbox3" name="options[]" value="1">
                     <label for="checkbox3"></label>
                     </span>
                  </td>
                  <td>7</td>
                  <td>200 Rules</td>
                  <td>503-555-9931</td>
                  <td>Maria Anders</td>
                  <td>
                     <a href="#editBookModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                     <a href="#deleteBookModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                  </td>
               </tr>
               <tr>
                  <td>
                     <span class="custom-checkbox">
                     <input type="checkbox" id="checkbox4" name="options[]" value="1">
                     <label for="checkbox4"></label>
                     </span>
                  </td>
                  <td>8</td>
                  <td>The Araquil </td>
                  <td>204-619-5731</td>
                  <td>Fran Wilson</td>
                  <td>
                     <a href="#editBookModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                     <a href="#deleteBookModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                  </td>
               </tr>
               <tr>
                  <td>
                     <span class="custom-checkbox">
                     <input type="checkbox" id="checkbox5" name="options[]" value="1">
                     <label for="checkbox5"></label>
                     </span>
                  </td>
                  <td>6</td>
                  <td>Via Italy</td>
                  <td>480-631-2097</td>
                  <td>Martin Blank</td>
                  <td>
                     <a href="#editBookModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                     <a href="#deleteBookModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                  </td>
               </tr> -->
            </tbody>
         </table>
         <div class="clearfix">
            <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
            <ul class="pagination">
               <li class="page-item disabled"><a href="#">Previous</a></li>
               <li class="page-item"><a href="#" class="page-link">1</a></li>
               <li class="page-item"><a href="#" class="page-link">2</a></li>
               <li class="page-item active"><a href="#" class="page-link">3</a></li>
               <li class="page-item"><a href="#" class="page-link">4</a></li>
               <li class="page-item"><a href="#" class="page-link">5</a></li>
               <li class="page-item"><a href="#" class="page-link">Next</a></li>
            </ul>
         </div>
      </div>
   </div>
   <!-- Edit Modal HTML -->
   <div id="addBookModal" class="modal fade">
      <div class="modal-dialog">
         <div class="modal-content">
            <form>
               <div class="modal-header">
                  <h4 class="modal-title">Add Book</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               </div>
               <div class="modal-body">
                  <div class="form-group">
                     <label>Title</label>
                     <input type="text" class="form-control" required>
                  </div>
                  <div class="form-group">
                     <label>Code</label>
                     <input type="email" class="form-control" required>
                  </div>
                  <div class="form-group">
                     <label>Author</label>
                     <input type="text" class="form-control" required>
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
            <form>
               <div class="modal-header">
                  <h4 class="modal-title">Edit Book</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               </div>
               <div class="modal-body">
                  <div class="form-group">
                     <label>Name</label>
                     <input type="text" class="form-control" required>
                  </div>
                  <div class="form-group">
                     <label>Email</label>
                     <input type="email" class="form-control" required>
                  </div>
                  <div class="form-group">
                     <label>Address</label>
                     <input type="text" class="form-control" required>
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
            <form>
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
                  <input type="submit" class="btn btn-danger" value="Delete">
               </div>
            </form>
         </div>
      </div>
   </div>

   @push('scripts')
    <script>
        $(document).ready(function () {
 
            const TABLE = $('#books').DataTable({  
                "dom": "<'col-sm-12'tr><'row' <'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'p>>" ,
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
                "drawCallback": function( data ) {  
                    $('.no_of_users').text(data.json.recordsFiltered)
                },
                "columns": [
                    { "data": "id" },
                    { "data": "title" },
                    { "data": "code" },
                    { "data": "author" },
                    { "data": "actions" }
                ]  
            });


            $('#column_search').on( 'keyup', function () {
              TABLE.draw();
            });
 
        });

    </script>

   @endpush
@endsection