<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;

class BooksController extends Controller
{ 
    public function index()
    {
        $data['pageTitle'] = 'List of All Books';
        $data['authors'] = Author::all();

        return view('books.index', $data);
    }

    public function ajaxAllBooks(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'title',
            2 => 'code',
            3 => 'author_id',
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $dir = $request->input('order.0.dir');
        $order = $columns[$request->input('order.0.column')];            
        $search = $request->input('search');
        $searchColumns = ['id', 'title', 'code', 'author_id'];

        $books = Book::ofSearch( $search, $searchColumns )
            ->orWhereHas('authors', function($q) use ($search) {
                $q->where('name', 'LIKE', '%'.$search.'%');
            })
            ->offset( $start )
            ->limit( $limit )
            ->orderBy( $order, $dir )
            ->get();

        $parameters = '?search=' . $request->input('search');

        $data = array();
        if(!empty($books))
        {
            foreach ($books as $book)
            {
                $edit_action = '<a href="#editBookModal" class="edit editBookModalButton"  
                                    data-toggle="modal" 
                                    data-title="'.$book->title.'" 
                                    data-code="'.$book->code.'" 
                                    data-author-id="'.$book->author_id.'"
                                    data-url="'.route("books.update", $book->id).'">
                                    <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
                                </a>';
                $delete_action = '<a href="#deleteBookModal" class="delete deleteBookModalButton" data-toggle="modal" data-url="'.route("books.destroy", $book->id).'"> <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>';

                $nestedData['id'] = $book->id;
                $nestedData['title'] = $book->title;
                $nestedData['code']  = $book->code;
                $nestedData['author_id'] = $book->author_id ? Author::find($book->author_id)->name : '';
                $nestedData['actions'] = $edit_action.$delete_action;
                $data[] = $nestedData;
            }
        }

        $recordsTotal = Book::count();
        $recordsFiltered = Book::ofSearch( $search, $searchColumns )->orderBy('id', 'asc')->count();
          
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
        $book = Book::create($request->all());   

        return redirect()->back(); 
    }
 
    public function update(Request $request, $id)
    {
        $book = Book::find($id);

        if(!$book) {
            abort(404);
        }

        $book->update($request->all());

        return redirect()->back(); 
    }
  
    public function destroy(Request $request, $id)
    {
        $book = Book::find($id);

        if(!$book) {
            abort(404);
        }

        $book->delete();

        return redirect()->back(); 
    }
}