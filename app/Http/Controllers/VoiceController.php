<?php

namespace App\Http\Controllers;

use App\Voice;
use App\User;
use App\Language;
use App\LanguageVoice;
use Auth;
use Illuminate\Http\Request;
use Google\Cloud\TextToSpeech\V1\TextToSpeechClient;

class VoiceController extends Controller
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
       
$code=[
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
        

// create client object
$client = new TextToSpeechClient();

// perform list voices request
$response = $client->listVoices();
$voices = $response->getVoices();

$ssmlVoiceGender = ['SSML_VOICE_GENDER_UNSPECIFIED', 'MALE', 'FEMALE',
            'NEUTRAL'];

            // display the SSML voice gender        

        foreach ($voices as $voice) {
            // display the voice's name. example: tpc-vocoded
            $voice->getName();
            //$codes[substr($voice->getName(), 0, 2)];
            //$code[substr($voice->getName(), 0, strpos($voice->getName(), "-Wavenet"))];
            if (strpos($voice->getName(), '-Wavenet') !== false) {
            $languageName= $code[substr($voice->getName(), 0, strpos($voice->getName(), "-Wavenet"))];
            $lcode=substr($voice->getName(), 0, strpos($voice->getName(), "-Wavenet"));
            }
            elseif (strpos($voice->getName(), '-Standard') !== false) {
                $languageName= $code[substr($voice->getName(), 0, strpos($voice->getName(), "-Standard"))];
            $lcode=substr($voice->getName(), 0, strpos($voice->getName(), "-Standard"));
            }else{
                $languageName=null;
                $lcode=null;
            }
            
            // SSML voice gender values from TextToSpeech\V1\SsmlVoiceGender
            $gender = $voice->getSsmlGender();
           
        
            // display the supported language codes for this voice. example: 'en-US'
            foreach ($voice->getLanguageCodes() as $languageCode) {
                 
              Voice::create([
                'language'      => $languageName,
                'code'          => $lcode,
                'name'          => $voice->getName(),
                'ssml_gender'   => $ssmlVoiceGender[$gender],
                'natural_sample_rate_hertz' => $voice->getNaturalSampleRateHertz()
              ]);       
              
            }    
        }

        $client->close();
        return redirect()->back()->with([
                'message' => "Data inserted Successfully",          
            ], 201);
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
     * @param  \App\Voice  $voice
     * @return \Illuminate\Http\Response
     */
    public function show(Voice $voice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Voice  $voice
     * @return \Illuminate\Http\Response
     */
    public function edit(Voice $voice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Voice  $voice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Voice $voice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Voice  $voice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Voice $voice)
    {
        //
    }

    public function editlanguagesearch(Request $request)
    {
        
       if($request->ajax())
        {
        $output="";
        $output.='<select multiple class="form-control" id="languages" name="languages[]" required>';

       //  $membership=User::whereId(auth()->user()->id)->first();
       // if(!empty($membership->membership_id)){
       //  $language=Language::where('membership_id',$membership->membership_id)->get();
       // }
       // else{
       //  $language=[];
       // }




        if($request->search=='Both'){
        $languages=Voice::distinct()->pluck('language')->toArray();
     
        }else{
        $languages=Voice::Where('name', 'like', '%' . $request->search . '%')->distinct()->pluck('language')->toArray();
        }
        
          foreach($languages as $language){
           $output.= '<option>'.$language.'</option>';
          }
          $output.='</select>';
          return Response($output);
        }
    }

    public function languagesearch(Request $request)
    {
        
       if($request->ajax())
        {
        $output="";
        $output.='<select multiple class="form-control" id="languages" name="languages[]" required>';
        if($request->search=='Both'){
        $languages=Voice::distinct()->pluck('language')->toArray();
     
        }else{
        $languages=Voice::Where('name', 'like', '%' . $request->search . '%')->distinct()->pluck('language')->toArray();
        }

          foreach($languages as $language){
           $output.= '<option>'.$language.'</option>';
          }
          $output.='</select>';
          return Response($output);
        }
    }

    public function voicesearch(Request $request)
    {   
         // dd($request->language);
        $output="";
     if(!empty($request->language)){
        $output.='<select multiple class="form-control" id="voices" name="voices[]" required>';
     // dd($request->language);
        foreach($request->language as $language)
        {
            // dd(Voice::Where('language',$language)->get());
          if($request->voicetype=='Both'){
          

            $languages=Voice::Where('language',$language)->get(['ssml_gender','name']);

        
        }else{
            
            $languages=Voice::Where('language',$language)->Where('name', 'like', '%' . $request->voicetype . '%')->get(['ssml_gender','name']);

            // dd($languages);
          } 
         
     
        foreach($languages as $language){
           $output.= '<option selected>'.$language->ssml_gender.'   '.$language->name.'</option>';
          }

        }
        $output.='</select>';

         // dd($output);
        return Response($output);

        }else{
          return Response($output);  
        }
    }

    public function uservoices(Request $request)
    {
        $membership=User::whereId(auth()->user()->id)->first();
       if(!empty($membership->membership_id)){
        $languages=Language::where('membership_id',$membership->membership_id)->where('code',$request->language)->with('languagevoices')->first();

       }
       else{
        $languages=null;
       }


      $output="";
     if(!empty($languages)){
        $output.='<select class="form-control" id="voicename" name="voicename" required>';
        // dd(count($languages->languagevoices));
       $output.='<option disabled selected>Choose Voice</option>';
        foreach($languages->languagevoices as $key=>$language){

           $gender=LanguageVoice::where('name',$language->name)->first();

           
             if($gender->ssml_gender == 'FEMALE' && explode("-",$language->name)[2] == 'Wavenet'){

                $option=$this->female[$key] ;

             }

             if($gender->ssml_gender == 'MALE' && explode("-",$language->name)[2] == 'Wavenet'){

                $option=$this->male[$key] ;

             }

            if(explode("-",$language->name)[2] == 'Standard'){
            $option='Robotic';
           }

          $output.= "<option value=".$language->name.">".$option." ".explode("-",$language->name)[3] ."</option>";
           // $output.= "<option value=".$language->name.">".explode("-",$language->name)[2]." ".explode("-",$language->name)[3] ."</option>";
          }
       
        $output.='</select>';
   
        return Response($output);

        }else{
          return Response($output);  
        }
    }


        public function userdefaultvoices(Request $request)
    {
        $membership=User::whereId(auth()->user()->id)->first();
       if(!empty($membership->membership_id)){
        $languages=Language::where('membership_id',$membership->membership_id)->where('code',$request->language)->with('languagevoices')->first();

       }
       else{
        $languages=null;
       }


      $output="";
     if(!empty($languages)){
        $output.='<select class="form-control" id="voicename" name="voicename" required>';
        // dd(count($languages->languagevoices));
       // $output.='<option disabled selected>Choose Voice</option>';
        foreach($languages->languagevoices as $key=>$language){

           $gender=LanguageVoice::where('name',$language->name)->first();

           
             if($gender->ssml_gender == 'FEMALE' && explode("-",$language->name)[2] == 'Wavenet'){

                $option=$this->female[$key] ;

             }

             if($gender->ssml_gender == 'MALE' && explode("-",$language->name)[2] == 'Wavenet'){

                $option=$this->male[$key] ;

             }

            if(explode("-",$language->name)[2] == 'Standard'){
            $option='Robotic';
           }

          $output.= "<option value=".$language->name.">".$option." ".explode("-",$language->name)[3] ."</option>";
           // $output.= "<option value=".$language->name.">".explode("-",$language->name)[2]." ".explode("-",$language->name)[3] ."</option>";
          }
       
        $output.='</select>';
   
        return Response($output);

        }else{
          return Response($output);  
        }
    }

        public function uservoicesdemo(Request $request)
    {
        $membership=User::whereId(auth()->user()->id)->first();
       if(!empty($membership->membership_id)){
        $languages=Language::where('membership_id',$membership->membership_id)->where('code',$request->language)->with('languagevoices')->first();

       }
       else{
        $languages=null;
       }


       $output="";
     if(!empty($languages)){
        $output.='<select class="form-control" id="voicename_demo" name="voicename" required>';
        
       $output.='<option disabled selected>Choose Voice</option>';
        foreach($languages->languagevoices as $language){
        
           $output.= "<option value=".$language->name.">".explode("-",$language->name)[2]." ".explode("-",$language->name)[3] ."</option>";
          }
       
        $output.='</select>';
   
        return Response($output);

        }else{
          return Response($output);  
        }
    }

    public function voicegender(Request $request)
    {

    $output="";
    $ssml_gender=LanguageVoice::where('name',$request->voicename)->pluck('ssml_gender')->toArray();
      if(!empty($ssml_gender)){
        $output.='<select class="custom-select mr-sm-2" id="ssmlgender" name="ssml_gender" required>';
       
        foreach($ssml_gender as $gender){
            
           $output.= "<option selected>".$gender."</option>";
          }
       
        $output.='</select>';
       return Response($output);

        }else{
          return Response($output);  
        }
    }


        public function voicegenderdemo(Request $request)
    {

    $output="";
    $ssml_gender=LanguageVoice::where('name',$request->voicename)->pluck('ssml_gender')->toArray();
      if(!empty($ssml_gender)){
        $output.='<select class="custom-select mr-sm-2" id="ssmlgender_demo" name="ssml_gender" required>';
       
        foreach($ssml_gender as $gender){
            
           $output.= "<option selected>".$gender."</option>";
          }
       
        $output.='</select>';
       return Response($output);

        }else{
          return Response($output);  
        }
    }
}
