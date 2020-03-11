<?php

use Illuminate\Database\Seeder;
use App\Voice;
use App\Language;
use App\LanguageVoice;
class LanguageVoicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            
                    $voices=Voice::Where('language',$language)->get(['ssml_gender','name','natural_sample_rate_hertz']);
                        foreach($voices as $voice){
                        $ssml_gender=strtok($voice, ' ');
                         $voiceCode=  substr($voice, strpos($voice, " ") + 1);
                          $languageCode2=substr($voiceCode, 0, strpos($voiceCode, '-', strpos($voiceCode, '-')+1));
                          if($languageCode1==$languageCode2){
                            $languageVoice=LanguageVoice::create([
                                'language_id' => $newLanguage->id,
                                'name' => $voiceCode,
                                'ssml_gender' =>$ssml_gender ,
                                'natural_sample_rate_hertz' => $voice->natural_sample_rate_hertz,
                            ]);
                          }

                        }

              
    }
}
