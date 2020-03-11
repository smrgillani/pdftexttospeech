<?php

namespace App\Jobs;
use App\Page;
use App\PageAudio;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Google\Cloud\TextToSpeech\V1\AudioConfig;
use Google\Cloud\TextToSpeech\V1\AudioEncoding;
use Google\Cloud\TextToSpeech\V1\SsmlVoiceGender;
use Google\Cloud\TextToSpeech\V1\SynthesisInput;
use Google\Cloud\TextToSpeech\V1\TextToSpeechClient;
use Google\Cloud\TextToSpeech\V1\VoiceSelectionParams;
use Illuminate\Support\Facades\Storage;

class ProcessTextToSpeech implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

     protected $content;
     protected $book_id;
     protected $page_no;
     protected $page_id;
     protected $no_of_pages;
     protected $language;
     protected $voicename;
     protected $ssml_gender;
     protected $pitch;
     protected $speed;

    private $gender_array=[

        'SSML_VOICE_GENDER_UNSPECIFIED' => 0,
        'MALE' => 1,
        'FEMALE' => 2,
        'NEUTRAL' => 3
    ];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($page,$data)
    {
      
    $this->content = $page->content;
    $this->page_no = $page->page_no;
    $this->page_id = $page->id;
    $this->book_id=$data->book_id;
    $this->no_of_pages=$data->no_of_pages;
    $this->language=$data->language;
    $this->voicename=$data->voicename;
    $this->ssml_gender=$data->ssml_gender;
    $this->pitch=$data->pitch;
    $this->speed=$data->speed;  
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
    
        // instantiates a client
            $client = new TextToSpeechClient();

            // sets text to be synthesised
            $synthesisInputText = (new SynthesisInput())
                ->setText($this->content);

            // build the voice request, select the language code ("en-US") and the ssml
            // voice gender

            $voice = (new VoiceSelectionParams())
                ->setLanguageCode($this->language)
                ->setName($this->voicename)
                ->setSsmlGender($this->gender_array[$this->ssml_gender]);

            // Effects profile
            $effectsProfileId = "telephony-class-application";

            // select the type of audio file you want returned
            $audioConfig = (new AudioConfig())
                ->setAudioEncoding(AudioEncoding::MP3)
                ->setEffectsProfileId(array($effectsProfileId))
                ->setPitch($this->pitch)
                ->setSpeakingRate($this->speed);

            // perform text-to-speech request on the text input with selected voice
            // parameters and audio file type
            $response = $client->synthesizeSpeech($synthesisInputText, $voice, $audioConfig);
            $audioContent = $response->getAudioContent();
            $page=Page::whereId($this->page_id)->where('book_id',$this->book_id)->first();
          
            if(!empty($page)){
                $saveFile=Storage::disk('public_path')->put('user'.auth()->user()->id.'/book'.$this->book_id.'/'.$this->voicename.'/Page/page'.$this->page_no, $audioContent);
                   if($saveFile==true){
                    $path='user'.auth()->user()->id.'/book'.$this->book_id.'/'.$this->voicename.'/Page/page'.$this->page_no;
                        PageAudio::create([
                            'book_id' => $this->book_id , 
                            'page_id' => $page->id,
                            'language'=> $this->language,
                            'voice' => $this->voicename,
                            'audio_path' => $path,
                        ]);
                   }
            }      

    }
}
