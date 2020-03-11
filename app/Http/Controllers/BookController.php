<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\PdfToText\Pdf;
use App\Book;
use App\BookAudio;
use App\Chapter;
use App\Page;
use App\User;
use App\Language;
use App\Membership;
use Auth;
use Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books= User::whereId(auth()->user()->id)->with(['books.chapters','books.audioVoices'])->first();

       
        return view('books.index', $books);

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
        
        $rules = [
            'file' =>'required|mimes:pdf|max:50000', 
        ];

         $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {

    
          return response()->json($validator->messages(), 200);

        } else {

            $file= $request->file('file')->store('file'); 

            $path= public_path().'/storage/'.$file;

            $pages= $this->count_pages($path);

            $message = Book::create([

                'user_id' => Auth::id(),
                'name' => $request->file('file')->getClientOriginalName(),
                'path' => $path,
                'no_of_pages' => $pages,
                'created_at' => date('Y-m-d H:i:s'),

            ]);
            if(!empty($message)){

                for($i=1;$i<=$pages;$i++){

                    $page=Page::create([
                    'book_id' =>$message->id,
                    'page_no' => $i,
                    'content' => (new Pdf())
                        ->setPdf($path)
                         ->addOptions(['-f '.$i])
                        ->addOptions(['-l '.$i])
                        ->text(),
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
            }
                
            }
             if($request->ajax()){

                return !empty($message) ? response()->json([

                'message' => "File upload Successfully",
                'data' => $message,
                'error' => false,

                ]):response()->json([

                'message' => "File Can not be uploaded",
                'data' => null,
                'error' => true,

                ]);
             }
            
    }
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
       $book= Book::whereId($id)->with(['pages','chapters.audioVoices','audioVoices'])->first();
     
       $membership=User::whereId(auth()->user()->id)->first();
       if(!empty($membership->membership_id)){
        $language=Language::where('membership_id',$membership->membership_id)->get();
       }
       else{
        $language=[];
       }
           
       return view('books.detail',compact('book','language'));
    
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
    public function destroy(Book $book)
    {

        $message=$book->delete();
        return $message==true ? response()->json([
                'message' => "Book deleted successfully",
                'data' => Book::Where('user_id' ,auth()->user()->id)->with('audioVoices')->get(),
                'error' => false,
            ], 200):
                response()->json([
                'message' => "Book can not be deleted",
                'data' => null,
                'error' => true,
            ],200);


    }

    public function count_pages($pdfname) {
      $pdftext = file_get_contents($pdfname);
    
      $num = preg_match_all("/\/Page\W/", $pdftext, $dummy);
      return $num;
    }

    public function booksearch(Request $request)
    {
               if($request->ajax())
     {
      $output = '';
      $query = $request->book;
      
      if($query != '')
      {
       $data = Book::where('user_id',auth()->user()->id)->
         where('name', 'like', '%'.$query.'%')->with('audioVoices')
         ->orderBy('id', 'desc')
         ->get();
     
      }
      else
      {
       $data = Book::where('user_id',auth()->user()->id)->with('audioVoices')->
         orderBy('id', 'desc')
         ->get();
      }
        $total_row = $data->count();
        return response([
            'total_data'  => $total_row,
            'table_data'  => $data,
        ]);
           
       

     }
    }

    public function bookaudio($id)
    {
        $book= Book::whereId($id)->with(['chapters.audioVoices','audioVoices'])->first();
        return view('books.audio',compact('book'));
    }

    public function listenbook($id,$lng,$voice){
        $audio=BookAudio::where(['book_id'=> $id,'language_code'=>$lng,'voice' => $voice])->first();

        return view('books.listenbook',compact('audio'));

    }

    public function deleteAudio(Request $request){
        
        $audio=BookAudio::where(['book_id'=> $request->bookID,'language_code'=>$request->language,'voice' => $request->voice])->delete();
        return $audio==1 ? response()->json([
        'message' => 'Audio deleted successfully',
        'data' => BookAudio::where('book_id', $request->bookID)->get(),
        'error' => false,

      ]):response()->json([
        'message' => 'Audio  not deleted',
        'data' => null,
        'error' => true,

      ]);
    }


    public function bookName(Request $request)
    {
        $message=Book::Where('id' ,$request->bookID)->update(['name' => $request->bookName]);

        

           return $message== 1 ? response()->json([
                'message' => "Book updated successfully",
                'data' => Book::Where('user_id' ,auth()->user()->id)->with('audioVoices')->get(),
                'error' => false,
            ], 200):
                response()->json([
                'message' => "Book can not be updated",
                'data' => null,
                'error' => true,
            ],200);
    }


}

