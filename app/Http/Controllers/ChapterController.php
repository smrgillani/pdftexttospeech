<?php

namespace App\Http\Controllers;
use App\Page;
use App\Language;
use App\PageAudio;
use App\BookAudio;
use App\ChapterAudio;
use App\Chapter;
use App\Book;
use App\User;
use App\Membership;
use Illuminate\Http\Request;
use Auth;
use Validator;
use App\LanguageVoice;
use App\Jobs\ProcessTextToSpeech;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\InputStream;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Support\Facades\Storage;
use App\Utilities\Mp3;
use Google\Cloud\TextToSpeech\V1\AudioConfig;
use Google\Cloud\TextToSpeech\V1\AudioEncoding;
use Google\Cloud\TextToSpeech\V1\SsmlVoiceGender;
use Google\Cloud\TextToSpeech\V1\SynthesisInput;
use Google\Cloud\TextToSpeech\V1\TextToSpeechClient;
use Google\Cloud\TextToSpeech\V1\VoiceSelectionParams;
class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private  $male=[

        'JAMES',
        'JOHN',
        'ROBERT',
        'MICHAEL',
        'WILLIAM',
        'DAVID',
        'RICHARD',
        'CHARLES',
        'JOSEPH',
        'PAUL',
        'BRIAN',
        'KEVIN',
      ];

      private $female=[

        'MARY',
        'PATRICIA',
        'LINDA',
        'BARBARA',
        'ELIZABETH',
        'JENNIFER',
        'MARIA',
        'SUSAN',
        'MARGARET',
        'DOROTHY',
        'LISA',
        'BETTY',
      ];

    private $gender_array=[

        'SSML_VOICE_GENDER_UNSPECIFIED' => 0,
        'MALE' => 1,
        'FEMALE' => 2,
        'NEUTRAL' => 3
    ];

private $code=[
'ach'=>'Acholi',
'aa'=>  'Afar',
'af'  =>'Afrikaans',
'ak'=>  'Akan',
'tw'  =>'Akan, Twi',
'sq'  =>'Albanian',
'am'  =>'Amharic',
'ar-XA' => 'Arabic',
'ar-BH' =>  'Arabic, Bahrain',
'ar-EG' =>  'Arabic, Egypt',
'ar-SA' =>  'Arabic, Saudi Arabia',
'ar-YE' =>  'Arabic, Yemen',
'an'  => 'Aragonese',
'hy-AM'  => 'Armenian',
'frp' => 'Arpitan',
'as' => 'Assamese',
'ast' => 'Asturian',
'tay'=> 'Atayal',
'av'=>'Avaric',
'ae'=>'Avestan',
'ay'=>'Aymara',
'az'=>'Azerbaijani',
'ban'=> 'Balinese',
'bal'=> 'Balochi',
'bm'=>'Bambara',
'ba'=>'Bashkir',
'eu'=>'Basque',
'be'=>'Belarusian',
'bn'=>'Bengali',
'bn-IN '=>'Bengali, India',
'ber'=> 'Berber',
'bh'=>'Bihari',
'bfo'=> 'Birifor',
'bi'=>'Bislama',
'bs'=>'Bosnian',
'br-FR'=>'Breton',
'bg'=>'Bulgarian',
'my'=>'Burmese',
'ca'=>'Catalan',
'ceb'=> 'Cebuano',
'ch'=>'Chamorro',
'cmn-CN' => 'Mandarin Chinese',
'cs-CZ' => 'Czech (Czech Republic)',
'ce'=>'Chechen',
'chr'=> 'Cherokee',
'ny'=>'Chewa',
'zh-CN'=>'Chinese Simplified',
'zh-TW'=>'Chinese Traditional',
'zh-HK'=>'Chinese Traditional, Hong Kong',
'zh-MO'=>'Chinese Traditional, Macau',
'zh-SG'=>'Chinese Traditional, Singapore',
'cv'=>'Chuvash',
'kw'=>'Cornish',
'co'=>'Corsican',
'cr'=>'Cree',
'hr'=>'Croatian',
'cs'=>'Czech',
'da'=>'Danish',
'da-DK'=>'Danish (Denmark)',
'fa-AF'=>'Dari',
'dv'=>'Dhivehi',
'nl'=>'Dutch',
'nl-NL' => 'Dutch - The Netherlands',
'nl-BE'=>'Dutch, Belgium',
'nl-SR'=>'Dutch, Suriname',
'dz'=>'Dzongkha',
'en'=>'English',
'en-UD'=>'English (upside down)',
'en-AR'=>'English, Arabia',
'en-AU'=>'English, Australia',
'en-BZ'=>'English, Belize',
'en-CA'=>'English, Canada',
'en-CB'=>'English, Caribbean',
'en-CN'=>'English, China',
'en-DK'=>'English, Denmark',
'en-HK'=>'English, Hong Kong',
'en-IN'=>'English, India',
'en-ID'=>'English, Indonesia',
'en-IE'=>'English, Ireland',
'en-JM'=>'English, Jamaica',
'en-JA'=>'English, Japan',
'en-MY'=>'English, Malaysia',
'en-NZ'=>'English, New Zealand',
'en-NO'=>'English, Norway',
'en-PH'=>'English, Philippines',
'en-PR'=>'English, Puerto Rico',
'en-SG'=>'English, Singapore',
'en-ZA'=>'English, South Africa',
'en-SE'=>'English, Sweden',
'en-GB'=>'English, United Kingdom',
'en-US'=>'English, United States',
'en-ZW'=>'English, Zimbabwe',
'eo'=>'Esperanto',
'et'=>'Estonian',
'ee'=>'Ewe',
'fi-FI' => 'Finnish (Finland)',
'fo'=>'Faroese',
'fj'=>'Fijian',
'fil'=> 'Filipino',
'fil-PH' => 'Filipino; Pilipino',
'fr-FR'=>'French (Standard)',
'fi'=>'Finnish',
'vls-BE'=>'Flemish',
'fra-DE'=>'Franconian',
'fr'=>'French',
'fr-BE'=>'French, Belgium',
'fr-CA'=>'French, Canada',
'fr-LU'=>'French, Luxembourg',
'fr-QC'=>'French, Quebec',
'fr-CH'=>'French, Switzerland',
'fy-NL'=>'Frisian',
'fur-IT'=>'Friulian',
'ff'=>'Fula',
'gaa'=> 'Ga',
'gl'=>'Galician',
'ka'=>'Georgian',
'de-DE'=>'German',
'de-AT'=>'German, Austria',
'de-BE'=>'German, Belgium',
'de-LI'=>'German, Liechtenstein',
'de-LU'=>'German, Luxembourg',
'de-CH'=>'German, Switzerland',
'got'=> 'Gothic',
'el-GR'=>'Greek',
'el-CY'=>'Greek, Cyprus',
'kl'=>'Greenlandic',
'gn'=>'Guarani',
'gu-IN'=>'Gujarati',
'ht'=>'Haitian Creole',
'ha'=>'Hausa',
'haw'=> 'Hawaiian',
'he'=>'Hebrew',
'hz'=>'Herero',
'hil'=> 'Hiligaynon',
'hi-IN'=>'Hindi',
'ho'=>'Hiri Motu',
'hmn'=> 'Hmong',
'hu-HU'=>'Hungarian',
'is'=>'Icelandic',
'ido'=> 'Ido',
'ig'=>'Igbo',
'ilo'=> 'Ilokano',
'id-ID'=>'Indonesian',
'iu'=>'Inuktitut',
'ga-IE'=>'Irish',
'it-IT'=>'Italian',
'it-CH'=>'Italian, Switzerland',
'ja-JP'=>'Japanese',
'jv'=>'Javanese',
'quc'=> "K'iche'",
'kab'=> 'Kabyle',
'kn'=>'Kannada',
'pam'=> 'Kapampangan',
'ks'=>'Kashmiri',
'ks-PK'=>'Kashmiri, Pakistan',
'csb'=> 'Kashubian',
'kk'=>'Kazakh',
'km'=>'Khmer',
'rw'=>'Kinyarwanda',
'tlh-AA '=> 'Klingon',
'kv'=>'Komi',
'kg'=>'Kongo',
'kok'=> 'Konkani',
'ko'=>'Korean',
'ko-KR'=>'Korean (Korea)',
'ku'=>'Kurdish',
'kmr'=> 'Kurmanji (Kurdish)',
'kj'=>'Kwanyama',
'ky'=>'Kyrgyz',
'lol'=> 'LOLCAT',
'lo'=>'Lao',
'la-LA'=>'Latin',
'lv'=>'Latvian',
'lij'=> 'Ligurian',
'li'=>'Limburgish',
'ln'=>'Lingala',
'lt'=>'Lithuanian',
'jbo'=> 'Lojban',
'nds'=> 'Low German',
'dsb-DE'=>'Lower Sorbian',
'lg'=>'Luganda',
'luy'=> 'Luhya',
'lb'=>'Luxembourgish',
'mk'=>'Macedonian',
'mai'=> 'Maithili',
'mg'=>'Malagasy',
'ms'=>'Malay',
'ms-BN'=>'Malay, Brunei',
'ml-IN'=>'Malayalam',
'mt'=>'Maltese',
'gv'=>'Manx',
'mi'=>'Maori',
'arn'=> 'Mapudungun',
'mr'=>'Marathi',
'mh'=>'Marshallese',
'moh'=> 'Mohawk',
'mn'=>'Mongolian',
'sr-Cyrl-ME'=>'Montenegrin (Cyrillic)',
'me'=>'Montenegrin (Latin)',
'mos'=> 'Mossi',
'na'=>'Nauru',
'ng'=>'Ndonga',
'ne-NP'=>'Nepali',
'ne-IN'=>'Nepali, India',
'pcm'=> 'Nigerian Pidgin',
'se'=>'Northern Sami',
'nso'=> 'Northern Sotho',
'no'=>'Norwegian',
'nb-no'=>'Norwegian Bokmal',
'nb-NO'=> 'Norwegian (Bokm?l) - Norway',
'nn-NO' => 'Norwegian Nynorsk',
'oc'=>'Occitan',
'oj'=>'Ojibwe',
'or'=>'Oriya',
'om'=>'Oromo',
'os'=>'Ossetian',
'pi'=>'Pali',
'pap'=> 'Papiamento',
'ps'=>'Pashto',
'fa'=>'Persian',
'en-PT'=>'Pirate English',
'pl'=>'Polish',
'pl-PL' => 'Polish - Poland',
'pt-PT'=>'Portuguese',
'pt-BR'=>'Portuguese, Brazilian',
'pa-IN'=>'Punjabi',
'pa-PK'=>'Punjabi, Pakistan',
'qu'=>'Quechua',
'qya-AA'=>'Quenya',
'ro'=>'Romanian',
'rm-CH'=>'Romansh',
'rn'=>'Rundi',
'ru'=>'Russian',
'ru-RU' => 'Russian - Russia',
'ru-BY'=>'Russian, Belarus',
'ru-MD'=>'Russian, Moldova',
'ru-UA'=>'Russian, Ukraine',
'ry-UA'=>'Rusyn',
'sah'=> 'Sakha',
'sg'=>'Sango',
'sa'=>'Sanskrit',
'sat'=> 'Santali',
'sc'=>'Sardinian',
'sco'=> 'Scots',
'gd'=>'Scottish Gaelic',
'sr'=>'Serbian (Cyrillic)',
'sr-CS'=>'Serbian (Latin)',
'sh'=>'Serbo-Croatian',
'crs'=> 'Seychellois Creole',
'sn'=>'Shona',
'ii'=>'Sichuan Yi',
'sd'=>'Sindhi',
'si-LK'=>'Sinhala',
'sk'=>'Slovak',
'sk-SK' => 'Slovak - Slovakia',
'sl'=>'Slovenian',
'so'=>'Somali',
'son'=> 'Songhay',
'ckb'=> 'Sorani (Kurdish)',
'nr'=>'Southern Ndebele',
'sma'=> 'Southern Sami',
'st'=>'Southern Sotho',
'es-ES'=>'Spanish',
'es-EM'=>'Spanish (Modern)',
'es-AR'=>'Spanish, Argentina',
'es-BO'=>'Spanish, Bolivia',
'es-CL'=>'Spanish, Chile',
'es-CO'=>'Spanish, Colombia',
'es-CR'=>'Spanish, Costa Rica',
'es-DO'=>'Spanish, Dominican Republic',
'es-EC'=>'Spanish, Ecuador',
'es-SV'=>'Spanish, El Salvador',
'es-GT'=>'Spanish, Guatemala',
'es-HN'=>'Spanish, Honduras',
'es-MX'=>'Spanish, Mexico',
'es-NI'=>'Spanish, Nicaragua',
'es-PA'=>'Spanish, Panama',
'es-PY'=>'Spanish, Paraguay',
'es-PE'=>'Spanish, Peru',
'es-PR'=>'Spanish, Puerto Rico',
'es-US'=>'Spanish, United States',
'es-UY'=>'Spanish, Uruguay',
'es-VE'=>'Spanish, Venezuela',
'su'=>'Sundanese',
'sw'=>'Swahili',
'sw-KE'=>'Swahili, Kenya',
'sw-TZ '=>'Swahili, Tanzania',
'ss'=>'Swati',
'sv-SE'=>'Swedish',
'sv-FI'=>'Swedish, Finland',
'syc'=> 'Syriac',
'tl'=>'Tagalog',
'ty'=>'Tahitian',
'tg'=>'Tajik',
'tzl'=> 'Talossan',
'ta'=>'Tamil',
'tt-RU'=>'Tatar',
'te'=>'Telugu',
'kdh'=> 'Tem (Kotokoli)',
'th'=>'Thai',
'bo-BT'=>'Tibetan',
'ti'=>'Tigrinya',
'ts'=>'Tsonga',
'tn'=>'Tswana',
'tr'=>'Turkish',
'tr-TR' => 'Turkish - Turkey',
'tr-CY'=>'Turkish, Cyprus',
'tk'=>'Turkmen',
'uk'=>'Ukrainian',
'uk-UA'=> 'Ukrainian - Ukraine',
'hsb-DE '=> 'Upper Sorbian',
'ur-IN'=>'Urdu (India)',
'ur-PK'=>'Urdu (Pakistan)',
'ug'=>'Uyghur',
'uz'=>'Uzbek',
'val-ES'=>'Valencian',
've'=>'Venda',
'vec'=> 'Venetian',
'vi'=>'Vietnamese',
'vi-VN'=> 'Vietnamese (Viet Nam)',
'wa'=>'Walloon',
'cy'=>'Welsh',
'wo'=>'Wolof',
'xh'=>'Xhosa',
'yi'=>'Yiddish',
'yo'=>'Yoruba',
'zea'=> 'Zeelandic',
'zu'=>'Zulu',
'cmn-TW' => 'Taiwanese Mandarin',
];

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
     
        $rules = [
            'book_id' =>'required' ,
            'chapterName' =>'required',
            'pageFrom' =>'required|numeric',
            'pageTo' =>'required|numeric',
        ];

        $validator = Validator::make($request->all(), $rules);
          if ($validator->fails()) {
    
          return  response()->json(['error'=> $validator]);

        }else{

              $pageFrom = Page::where ( ['page_no'=> $request->pageFrom , 'book_id' => $request->book_id] )->first();
              
              $pageTo=Page::where( ['page_no' => $request->pageTo ,'book_id' => $request->book_id] )->first();

            
              if($pageFrom == null || $pageTo == null){
                 return  response()->json([
                'message' => "Page not found",
                'data' => null,
                'error' => true,
                    ], 200) ;

              }

              $chpaterExists = Chapter::where( ['book_id' => $request->book_id , 'page_from' => $pageFrom->id,'page_to' => $pageTo->id])->first();

                if(!empty( $chpaterExists )){
                 
                return  response()->json([
                'message' => "Chapter alredy exists from page ".$request->pageFrom." to page".$request->pageTo,
                'data' => null,
                'error' => true,
                    ], 200) ;
                }
                else{
                  // dd($request->book_id,$request->pageFrom,$request->pageTo,$request->chapterName,$request->total_pages);
                $chapter=Chapter::create([
                'book_id' => $request->book_id,
                'page_from' => $pageFrom->id,
                'page_to' => $pageTo->id,
                'name' => $request->chapterName,
                'total_pages'=> $request->total_pages,
            ]); 
               
            
                $chapters=Chapter::where('book_id',$request->book_id)->with('pageFrom','pageTo')->get();


               
                return  !empty($chapter) ? response()->json([

                'message' => "Chapter created Successfully",
                'data' => $chapters,
                'error' => false,

            ], 201):
            response()->json([
                'message' => 'Chapter can not be created',
                'data' => null,
                'error' =>true,

            ], 400);
 
            } 
            
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function show(Chapter $chapter)
    {

    $user= User::whereId(auth()->user()->id)->first();

    if($user->membership_id){

        $languages= Membership::whereId($user->membership_id)->with(['languages'])->get();
    }
    else { 

        $languages=null;
    }

    $chapterPages=Book::whereId($chapter->book_id)->with(['pages' => function($query) use($chapter) {

            $query->whereBetween('page_no',[$chapter->page_from,$chapter->page_to])->get();

        }])->first();

       return view('chapters.detail',compact('languages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function edit(Chapter $chapter)
    {
            
        return view('chapters.edit')->with('chapter', $chapter);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chapter $chapter)
    {

 
          $rules = [
            'book_id' =>'required' ,
            'chapterName' =>'required',
            'pageFrom' =>'required',
            'pageTo' =>'required',
        ];
        $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
               
          return  response()->json(['error'=> $validator]);
        }else {


            $pageFrom = Page::where ( ['page_no'=> $request->pageFrom , 'book_id' => $request->book_id] )->first();

               
            $pageTo=Page::where( ['page_no' => $request->pageTo ,'book_id' => $request->book_id] )->first();

              if($pageFrom == null || $pageTo == null){
                 return  response()->json([
                'message' => "Page not found",
                'data' => null,
                'error' => true,
                    ], 200) ;

              }

        $chp=$chapter->update([
            'page_from' => $pageFrom->id,
            'page_to' => $pageTo->id,
            'name' => $request->chapterName,
        ]);

        return $chp==true ? response()->json([
                'message' => "Chapter updated Successfully",
                'data' => Chapter::where('book_id',$request->book_id)->with('pageFrom','pageTo')->get(),
                'error' => false,
            ], 201):
                response()->json([
                'message' => 'Chapter not updated',
                'data' => null,
                'error' => true,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chapter $chapter)
    {
       
        $message=$chapter->delete();
        return ! false==$message ? response()->json([
                'message' => "Chapter deleted Successfully",
                'data' => Chapter::where('book_id',$chapter->book_id)->with('pageFrom','pageTo')->get(),
                'error' => false,
            ], 201):
                response()->json([
                'message' => "Chapter can't be Deleted",
                'data' => null,
                'error' => true,
               
            ]);
    }


    public function testprocess(Request $request)
    {

        $client = new TextToSpeechClient();

        // sets text to be synthesised
        $synthesisInputText = (new SynthesisInput())
            ->setText($request->demotext);

        // build the voice request, select the language code ("en-US") and the ssml
        // voice gender
        $voice = (new VoiceSelectionParams())
            ->setLanguageCode($request->language)
            ->setSsmlGender($this->gender_array[$request->ssml_gender]);

        // Effects profile
        $effectsProfileId = "telephony-class-application";

        // select the type of audio file you want returned
        $audioConfig = (new AudioConfig())
            ->setAudioEncoding(AudioEncoding::MP3)
            ->setEffectsProfileId(array($effectsProfileId))
            ->setPitch($request->pitch)
            ->setSpeakingRate($request->speed);

        // perform text-to-speech request on the text input with selected voice
        // parameters and audio file type
        $response = $client->synthesizeSpeech($synthesisInputText, $voice, $audioConfig);
        $audioContent = $response->getAudioContent();

         $saveFile=Storage::disk('public_path')->put('Demo/demo.mp3', $audioContent);
          if($saveFile==true){

          return response()->json([
          'data' => '/Demo/demo.mp3',
          'message' => "Demo Audio Generated",
          'error' => false
         ]);

        }else{

          return response()->json([
          'data' => null,
          'message' => "Demo Audio Not Genrated",
          'error' => true
         ]);
        }
         
    }


    public function process_tts(Chapter $chapter,Request $request){ 

  
    
    $rules = [
            'language' =>'required' ,
            'voicename' =>'required',
            'ssml_gender' =>'required',
            'pitch' =>'required|numeric',
            'speed' =>'required|numeric',
        ];

          $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
    
          return response()->json($validator->messages(), 422);

        }
        else{          

        $book= Book::whereId($request->book_id)->with(['pages','chapters'])->first();

        $currentUser=User::whereId(auth()->user()->id)->first();

       if(!empty($currentUser->membership_id)){

        $membership=Membership::whereId($currentUser->membership_id)->first(); 

       }
            // dd($membership->characters_length , $currentUser->characters_count);
            if($membership->characters_length > $currentUser->characters_count){
            
             foreach($book->pages as $page){

              if(strlen($page->content) > 5000 ){

                return response()->json(['message' => "Can't Process Page".$page->id." with More then 5000 Characters"]) ;
              }

            $pageAudio=PageAudio::where(['book_id'=>$request->book_id ,'page_id'=>$page->id ,'voice'=>$request->voicename])->first();

            if(empty($pageAudio)){

                ProcessTextToSpeech::dispatchNow($page,$request);

                $currentUser->update([

                'characters_count'  => $currentUser->characters_count + strlen($page->content)

                ]);

            }
        }


             if(count($book->chapters)>=1){
            
                foreach($book->chapters as $chapter){

                $checkChapterAudio=ChapterAudio::where('chapter_id',$chapter->id)
                        ->where('language_code',$request->language)
                        ->where('voice',$request->voicename)->get();
                
                    if($checkChapterAudio->isEmpty()){

                    $chapterAudio=PageAudio::where('book_id',$chapter->book_id)->where('language',$request->language)->whereBetween('page_id',[$chapter->page_from,$chapter->page_to])->get();
       

                   $chaptermp3 = new Mp3();

                    $count=0;

                    foreach($chapterAudio as $audio){

                    if($count== 0){
                      
                        $chaptermp3 = new Mp3($audio->audio_path);
                    
                        $chaptermp3->striptags();

                    }

                    if($count>=1){

                    $chaptermp3->mergeBehind(new Mp3($audio->audio_path));

                    $chaptermp3->striptags();

                    }

                    $count++;
                }

                $chapterPath= 'user'.auth()->user()->id.'/book'.$request->book_id.'/'.$request->voicename.'/Chapter/chapter'.$chapter->id.'.mp3';
                   
                    $saveChapter=Storage::disk('public_path')->put($chapterPath, $chaptermp3->str);
                                            ChapterAudio::create([
                                            'chapter_id' => $chapter->id , 
                                            'chapter_name' => $chapter->name , 
                                            'language_code'=> $request->language,
                                            'language'=> $this->code[$request->language],
                                            'voice' => $request->voicename,
                                            'audio_path' => $chapterPath,
                                        ]);
                    }
                    else{

                        return response()->json(['message' => 'Chapter'.$chapter->id.' with same voice alredy exists']) ; 
                    }
            }
        }


        $bookAudio=BookAudio::where(['book_id'=>$request->book_id ,'language_code'=> $request->language,'voice'=>$request->voicename])->first();

        if(empty($bookAudio)){

        $pageAudio= PageAudio::where('book_id',$request->book_id)
                        ->where('language',$request->language)
                        ->where('voice',$request->voicename)->get();
        
        $mp3 = new Mp3();

        $count=0;

        foreach($pageAudio as $audio){    

        if($count== 0){
            $mp3 = new Mp3($audio->audio_path);

            $mp3->striptags(); 
        }
        if($count>=1){

        $mp3->mergeBehind(new Mp3($audio->audio_path));

        $mp3->striptags();

        }
        $count++;
     }

    $bookPath= 'user'.auth()->user()->id.'/book'.$request->book_id.'/'.$request->voicename.'/Book/book'.$request->book_id.'.mp3';
    
    $saveBook=Storage::disk('public_path')->put($bookPath, $mp3->str);

                        BookAudio::create([
                            'book_id' => $request->book_id , 
                            'book_name' => $request->book_name , 
                            'language_code'=> $request->language,
                            'language'=> $this->code[$request->language],
                            'voice' => $request->voicename,
                            'audio_path' => $bookPath,
                        ]);

            return response()->json(['message' =>  "Text converted successfully"]) ;  

        }
        else{

            return response()->json(['message' => 'Book with same voice alredy exists']) ; 

        }
      }
    else{
      
            return response()->json(['message' =>  'Your membership limit finish']) ;
    } 
  }
}

    public function listenchapter($id,$lng,$voice){
        $audio=ChapterAudio::where(['chapter_id'=> $id,'language_code'=>$lng,'voice' => $voice])->first();
      
        return view('books.listenchapter',compact('audio'));

    }

    public function deleteAudio(Request $request)
    {
      $audio=ChapterAudio::where(['chapter_id'=> $request->chapterID,'language_code'=>$request->language,'voice' => $request->voice])->delete();

      return $audio==1 ? response()->json([
        'message' => 'Audio deleted successfully',
        'data' => ChapterAudio::where('chapter_id', $request->chapterID)->get(),
        'error' => false,

      ]):response()->json([
        'message' => 'Audio  not deleted',
        'data' => null,
        'error' => true,

      ]);


    }

    public function chapter($id)
    {
        $book= Book::whereId($id)->with(['pages','chapters.audioVoices','audioVoices'])->first();

        // dd($book->pages);
     
        return view('chapters.index',compact('book'));
    }

    public function process($id)
    {

        $book= Book::whereId($id)->with(['pages','chapters.audioVoices','audioVoices'])->first();
     
       $membership=User::whereId(auth()->user()->id)->first();
       if(!empty($membership->membership_id)){
        $language=Language::where('membership_id',$membership->membership_id)->get();


       }
       else{
        $language=[];
       }

       // $voicesData=$this->searchForVoice('en-GB',$language);
       // dd($voicesData);


      return view('chapters.process',compact('language','book'));
    }

    public function cheptercheck(Request $request)
    {
     
      $chapeters=Book::where('id',(int)$request->bookid)->with('chapters')->first();
      return $chapeters->chapters;
    }

  function searchForVoice($code, $array) {

   foreach ($array as $key => $val) {
      
       if ($val['code'] === $code) {
        
       $membership=User::whereId(auth()->user()->id)->first();
       $languages=Language::where('membership_id',$membership->membership_id)->where('code',$val->code)->with('languagevoices')->first();       
      
      return $data=[

        'languages' => $languages,
        'gender'     => LanguageVoice::where('name',$language->name)->first(),
        'male'       => $this->male,
        'female'     => $this->female

      ];
    }
  }
      $membership=User::whereId(auth()->user()->id)->first();
       $languages=Language::where('membership_id',$membership->membership_id)->where('code',$array[0]->code)->with('languagevoices')->first();

  return $data=[

        'languages' => $languages,
        'gender'     => LanguageVoice::where('name',$language->name)->first(),
        'male'       => $this->male,
        'female'     => $this->female

      ];
}

}
