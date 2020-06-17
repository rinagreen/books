<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['pageTitle'] = 'List of All Books';

        return view('books.index', $data);
    }

    public function ajaxAllBooks(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'title',
            2 => 'code',
            3 => 'author',
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $dir = $request->input('order.0.dir');
        $order = $columns[$request->input('order.0.column')];            
        $search = $request->input('search');
        $searchColumns = ['id', 'title', 'code', 'author_id'];

        $books = Book::ofSearch( $search, $searchColumns )
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
                $nestedData['id'] = $book->id;
                $nestedData['title'] = $book->title;
                $nestedData['code']  = $book->code;
                $nestedData['author'] = $book->author_id ? Author::find($book->author_id)->name : '';
                $nestedData['actions'] = '<a href="#editBookModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                     <a href="#deleteBookModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>';
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
