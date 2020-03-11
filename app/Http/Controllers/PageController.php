<?php

namespace App\Http\Controllers;

use App\Page;
use App\Book;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $book= Book::Where('id',$request->book_id)->with('pages')->first();
        $newPageNo = $book->pages[count($book->pages) - 1]->page_no + 1;
        
        $page = Page::create([
            'book_id' => $request->book_id,
            'page_no' => $newPageNo,
            'content' => $request->pageContent,
        ]);
        Book::Where('id',$request->book_id)->increment('no_of_pages', 1);
        $data   = Book::Where('id',$request->book_id)->with(['pages'])->first();

        return !empty($page) ? response()->json([
            'message' => 'Page created successfully',
            'data'    => $data,
            'error'   => false
        ]): response()->json([

            'message' => 'Page can not be created',
            'data'    => null,
            'error'   => true
        ]);

       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $page=Page::Where('book_id',$request->book_ID)->Where('page_no',$request->page_ID)->delete();
        if($page == 1){
            Book::Where('id',$request->book_ID)->decrement('no_of_pages', 1);
            $data   = Book::Where('id',$request->book_ID)->with(['pages'])->first();
            // return view('books.allpages',compact('data'));
            return response()->json([
            'message' => 'Page deleted successfully',
            'data'    => $data,
            'error'   => false
        ]);
        }else{
            return response()->json([
            'message' => 'Page can not be deleted',
            'data'    => null,
            'error'   => true
        ]);
        }
        
    }

    public function pageedit(Request $request)
    {
       
        $page=Page::Where('book_id',$request->bookID)->Where('page_no',$request->pageNo)->update(['content' => $request->content]);

        return $page==1 ? response()->json([
            'message' => 'Page updated successfully',
            'data' => Page::Where('book_id',$request->bookID)->Where('page_no',$request->pageNo)->first(),
            'error' => false
        ]):response()->json([
            'message' => 'Page not updated',
            'data' => null,
            'error' => true
        ]);

        
    }
}
