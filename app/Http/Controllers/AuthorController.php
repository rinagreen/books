<?php

namespace App\Http\Controllers;
 
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['pageTitle'] = 'List of All Authors';
        $data['authors'] = Author::all();

        return view('authors.index', $data);
    }

    public function ajaxAllAuthors(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'name',
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $dir = $request->input('order.0.dir');
        $order = $columns[$request->input('order.0.column')];            
        $search = $request->input('search');
        $searchColumns = ['id', 'name'];

        $authors = Author::ofSearch( $search, $searchColumns ) 
            ->offset( $start )
            ->limit( $limit )
            ->orderBy( $order, $dir )
            ->get();

        $parameters = '?search=' . $request->input('search');

        $data = array();
        if(!empty($authors))
        {
            foreach ($authors as $author)
            {
                $edit_action = '<a href="#editAuthorModal" class="edit editAuthorModalButton"  
                                    data-toggle="modal" 
                                    data-name="'.$author->name.'"  
                                    data-author-id="'.$author->id.'"
                                    data-url="'.route("authors.update", $author->id).'">
                                    <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
                                </a>';
                $delete_action = '<a href="#deleteAuthorModal" class="delete deleteAuthorModalButton" data-toggle="modal" data-url="'.route("authors.destroy", $author->id).'"> <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>';

                $nestedData['id'] = $author->id;
                $nestedData['name'] = $author->name; 
                $nestedData['actions'] = $edit_action.$delete_action;
                $data[] = $nestedData;
            }
        }

        $recordsTotal = Author::count();
        $recordsFiltered = Author::ofSearch( $search, $searchColumns )->orderBy('id', 'asc')->count();
          
        $jsonData = array(
            "draw"            => intval($request->input('draw')),  
            "recordsTotal"    => intval($recordsTotal),  
            "recordsFiltered" => intval($recordsFiltered), 
            "data"            => $data   
        );
            
        echo json_encode($jsonData); 
    }

    public function store(Request $request)
    {
        $author = Author::create($request->all());   

        return redirect()->back(); 
    }

    public function update(Request $request, $id)
    {
        $author = Author::find($id);

        if(!$author) {
            abort(404);
        }

        $author->update($request->all());

        return redirect()->back(); 
    }
  
    public function destroy(Request $request, $id)
    {
        $author = Author::find($id);

        if(!$author) {
            abort(404);
        }

        $author->delete();

        return redirect()->back(); 
    }
}
