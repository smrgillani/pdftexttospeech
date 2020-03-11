<?php

namespace App\Http\Controllers;

use App\Language;
use App\LanguageVoice;
use App\Membership;
use App\Package;
use App\Voice;
use DB;
use Illuminate\Http\Request;
use Validator;

class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $code = [
        'ach'        => 'Acholi',
        'aa'         => 'Afar',
        'af'         => 'Afrikaans',
        'ak'         => 'Akan',
        'tw'         => 'Akan, Twi',
        'sq'         => 'Albanian',
        'am'         => 'Amharic',
        'ar-XA'      => 'Arabic',
        'ar-BH'      => 'Arabic, Bahrain',
        'ar-EG'      => 'Arabic, Egypt',
        'ar-SA'      => 'Arabic, Saudi Arabia',
        'ar-YE'      => 'Arabic, Yemen',
        'an'         => 'Aragonese',
        'hy-AM'      => 'Armenian',
        'frp'        => 'Arpitan',
        'as'         => 'Assamese',
        'ast'        => 'Asturian',
        'tay'        => 'Atayal',
        'av'         => 'Avaric',
        'ae'         => 'Avestan',
        'ay'         => 'Aymara',
        'az'         => 'Azerbaijani',
        'ban'        => 'Balinese',
        'bal'        => 'Balochi',
        'bm'         => 'Bambara',
        'ba'         => 'Bashkir',
        'eu'         => 'Basque',
        'be'         => 'Belarusian',
        'bn'         => 'Bengali',
        'bn-IN '     => 'Bengali, India',
        'ber'        => 'Berber',
        'bh'         => 'Bihari',
        'bfo'        => 'Birifor',
        'bi'         => 'Bislama',
        'bs'         => 'Bosnian',
        'br-FR'      => 'Breton',
        'bg'         => 'Bulgarian',
        'my'         => 'Burmese',
        'ca'         => 'Catalan',
        'ceb'        => 'Cebuano',
        'ch'         => 'Chamorro',
        'cmn-CN'     => 'Mandarin Chinese',
        'cs-CZ'      => 'Czech (Czech Republic)',
        'ce'         => 'Chechen',
        'chr'        => 'Cherokee',
        'ny'         => 'Chewa',
        'zh-CN'      => 'Chinese Simplified',
        'zh-TW'      => 'Chinese Traditional',
        'zh-HK'      => 'Chinese Traditional, Hong Kong',
        'zh-MO'      => 'Chinese Traditional, Macau',
        'zh-SG'      => 'Chinese Traditional, Singapore',
        'cv'         => 'Chuvash',
        'kw'         => 'Cornish',
        'co'         => 'Corsican',
        'cr'         => 'Cree',
        'hr'         => 'Croatian',
        'cs'         => 'Czech',
        'da'         => 'Danish',
        'da-DK'      => 'Danish (Denmark)',
        'fa-AF'      => 'Dari',
        'dv'         => 'Dhivehi',
        'nl'         => 'Dutch',
        'nl-NL'      => 'Dutch - The Netherlands',
        'nl-BE'      => 'Dutch, Belgium',
        'nl-SR'      => 'Dutch, Suriname',
        'dz'         => 'Dzongkha',
        'en'         => 'English',
        'en-UD'      => 'English (upside down)',
        'en-AR'      => 'English, Arabia',
        'en-AU'      => 'English, Australia',
        'en-BZ'      => 'English, Belize',
        'en-CA'      => 'English, Canada',
        'en-CB'      => 'English, Caribbean',
        'en-CN'      => 'English, China',
        'en-DK'      => 'English, Denmark',
        'en-HK'      => 'English, Hong Kong',
        'en-IN'      => 'English, India',
        'en-ID'      => 'English, Indonesia',
        'en-IE'      => 'English, Ireland',
        'en-JM'      => 'English, Jamaica',
        'en-JA'      => 'English, Japan',
        'en-MY'      => 'English, Malaysia',
        'en-NZ'      => 'English, New Zealand',
        'en-NO'      => 'English, Norway',
        'en-PH'      => 'English, Philippines',
        'en-PR'      => 'English, Puerto Rico',
        'en-SG'      => 'English, Singapore',
        'en-ZA'      => 'English, South Africa',
        'en-SE'      => 'English, Sweden',
        'en-GB'      => 'English, United Kingdom',
        'en-US'      => 'English, United States',
        'en-ZW'      => 'English, Zimbabwe',
        'eo'         => 'Esperanto',
        'et'         => 'Estonian',
        'ee'         => 'Ewe',
        'fi-FI'      => 'Finnish (Finland)',
        'fo'         => 'Faroese',
        'fj'         => 'Fijian',
        'fil'        => 'Filipino',
        'fil-PH'     => 'Filipino; Pilipino',
        'fr-FR'      => 'French (Standard)',
        'fi'         => 'Finnish',
        'vls-BE'     => 'Flemish',
        'fra-DE'     => 'Franconian',
        'fr'         => 'French',
        'fr-BE'      => 'French, Belgium',
        'fr-CA'      => 'French, Canada',
        'fr-LU'      => 'French, Luxembourg',
        'fr-QC'      => 'French, Quebec',
        'fr-CH'      => 'French, Switzerland',
        'fy-NL'      => 'Frisian',
        'fur-IT'     => 'Friulian',
        'ff'         => 'Fula',
        'gaa'        => 'Ga',
        'gl'         => 'Galician',
        'ka'         => 'Georgian',
        'de-DE'      => 'German',
        'de-AT'      => 'German, Austria',
        'de-BE'      => 'German, Belgium',
        'de-LI'      => 'German, Liechtenstein',
        'de-LU'      => 'German, Luxembourg',
        'de-CH'      => 'German, Switzerland',
        'got'        => 'Gothic',
        'el-GR'      => 'Greek',
        'el-CY'      => 'Greek, Cyprus',
        'kl'         => 'Greenlandic',
        'gn'         => 'Guarani',
        'gu-IN'      => 'Gujarati',
        'ht'         => 'Haitian Creole',
        'ha'         => 'Hausa',
        'haw'        => 'Hawaiian',
        'he'         => 'Hebrew',
        'hz'         => 'Herero',
        'hil'        => 'Hiligaynon',
        'hi-IN'      => 'Hindi',
        'ho'         => 'Hiri Motu',
        'hmn'        => 'Hmong',
        'hu-HU'      => 'Hungarian',
        'is'         => 'Icelandic',
        'ido'        => 'Ido',
        'ig'         => 'Igbo',
        'ilo'        => 'Ilokano',
        'id-ID'      => 'Indonesian',
        'iu'         => 'Inuktitut',
        'ga-IE'      => 'Irish',
        'it-IT'      => 'Italian',
        'it-CH'      => 'Italian, Switzerland',
        'ja-JP'      => 'Japanese',
        'jv'         => 'Javanese',
        'quc'        => "K'iche'",
        'kab'        => 'Kabyle',
        'kn'         => 'Kannada',
        'pam'        => 'Kapampangan',
        'ks'         => 'Kashmiri',
        'ks-PK'      => 'Kashmiri, Pakistan',
        'csb'        => 'Kashubian',
        'kk'         => 'Kazakh',
        'km'         => 'Khmer',
        'rw'         => 'Kinyarwanda',
        'tlh-AA '    => 'Klingon',
        'kv'         => 'Komi',
        'kg'         => 'Kongo',
        'kok'        => 'Konkani',
        'ko'         => 'Korean',
        'ko-KR'      => 'Korean (Korea)',
        'ku'         => 'Kurdish',
        'kmr'        => 'Kurmanji (Kurdish)',
        'kj'         => 'Kwanyama',
        'ky'         => 'Kyrgyz',
        'lol'        => 'LOLCAT',
        'lo'         => 'Lao',
        'la-LA'      => 'Latin',
        'lv'         => 'Latvian',
        'lij'        => 'Ligurian',
        'li'         => 'Limburgish',
        'ln'         => 'Lingala',
        'lt'         => 'Lithuanian',
        'jbo'        => 'Lojban',
        'nds'        => 'Low German',
        'dsb-DE'     => 'Lower Sorbian',
        'lg'         => 'Luganda',
        'luy'        => 'Luhya',
        'lb'         => 'Luxembourgish',
        'mk'         => 'Macedonian',
        'mai'        => 'Maithili',
        'mg'         => 'Malagasy',
        'ms'         => 'Malay',
        'ms-BN'      => 'Malay, Brunei',
        'ml-IN'      => 'Malayalam',
        'mt'         => 'Maltese',
        'gv'         => 'Manx',
        'mi'         => 'Maori',
        'arn'        => 'Mapudungun',
        'mr'         => 'Marathi',
        'mh'         => 'Marshallese',
        'moh'        => 'Mohawk',
        'mn'         => 'Mongolian',
        'sr-Cyrl-ME' => 'Montenegrin (Cyrillic)',
        'me'         => 'Montenegrin (Latin)',
        'mos'        => 'Mossi',
        'na'         => 'Nauru',
        'ng'         => 'Ndonga',
        'ne-NP'      => 'Nepali',
        'ne-IN'      => 'Nepali, India',
        'pcm'        => 'Nigerian Pidgin',
        'se'         => 'Northern Sami',
        'nso'        => 'Northern Sotho',
        'no'         => 'Norwegian',
        'nb-no'      => 'Norwegian Bokmal',
        'nb-NO'      => 'Norwegian (Bokm?l) - Norway',
        'nn-NO'      => 'Norwegian Nynorsk',
        'oc'         => 'Occitan',
        'oj'         => 'Ojibwe',
        'or'         => 'Oriya',
        'om'         => 'Oromo',
        'os'         => 'Ossetian',
        'pi'         => 'Pali',
        'pap'        => 'Papiamento',
        'ps'         => 'Pashto',
        'fa'         => 'Persian',
        'en-PT'      => 'Pirate English',
        'pl'         => 'Polish',
        'pl-PL'      => 'Polish - Poland',
        'pt-PT'      => 'Portuguese',
        'pt-BR'      => 'Portuguese, Brazilian',
        'pa-IN'      => 'Punjabi',
        'pa-PK'      => 'Punjabi, Pakistan',
        'qu'         => 'Quechua',
        'qya-AA'     => 'Quenya',
        'ro'         => 'Romanian',
        'rm-CH'      => 'Romansh',
        'rn'         => 'Rundi',
        'ru'         => 'Russian',
        'ru-RU'      => 'Russian - Russia',
        'ru-BY'      => 'Russian, Belarus',
        'ru-MD'      => 'Russian, Moldova',
        'ru-UA'      => 'Russian, Ukraine',
        'ry-UA'      => 'Rusyn',
        'sah'        => 'Sakha',
        'sg'         => 'Sango',
        'sa'         => 'Sanskrit',
        'sat'        => 'Santali',
        'sc'         => 'Sardinian',
        'sco'        => 'Scots',
        'gd'         => 'Scottish Gaelic',
        'sr'         => 'Serbian (Cyrillic)',
        'sr-CS'      => 'Serbian (Latin)',
        'sh'         => 'Serbo-Croatian',
        'crs'        => 'Seychellois Creole',
        'sn'         => 'Shona',
        'ii'         => 'Sichuan Yi',
        'sd'         => 'Sindhi',
        'si-LK'      => 'Sinhala',
        'sk'         => 'Slovak',
        'sk-SK'      => 'Slovak - Slovakia',
        'sl'         => 'Slovenian',
        'so'         => 'Somali',
        'son'        => 'Songhay',
        'ckb'        => 'Sorani (Kurdish)',
        'nr'         => 'Southern Ndebele',
        'sma'        => 'Southern Sami',
        'st'         => 'Southern Sotho',
        'es-ES'      => 'Spanish',
        'es-EM'      => 'Spanish (Modern)',
        'es-AR'      => 'Spanish, Argentina',
        'es-BO'      => 'Spanish, Bolivia',
        'es-CL'      => 'Spanish, Chile',
        'es-CO'      => 'Spanish, Colombia',
        'es-CR'      => 'Spanish, Costa Rica',
        'es-DO'      => 'Spanish, Dominican Republic',
        'es-EC'      => 'Spanish, Ecuador',
        'es-SV'      => 'Spanish, El Salvador',
        'es-GT'      => 'Spanish, Guatemala',
        'es-HN'      => 'Spanish, Honduras',
        'es-MX'      => 'Spanish, Mexico',
        'es-NI'      => 'Spanish, Nicaragua',
        'es-PA'      => 'Spanish, Panama',
        'es-PY'      => 'Spanish, Paraguay',
        'es-PE'      => 'Spanish, Peru',
        'es-PR'      => 'Spanish, Puerto Rico',
        'es-US'      => 'Spanish, United States',
        'es-UY'      => 'Spanish, Uruguay',
        'es-VE'      => 'Spanish, Venezuela',
        'su'         => 'Sundanese',
        'sw'         => 'Swahili',
        'sw-KE'      => 'Swahili, Kenya',
        'sw-TZ '     => 'Swahili, Tanzania',
        'ss'         => 'Swati',
        'sv-SE'      => 'Swedish',
        'sv-FI'      => 'Swedish, Finland',
        'syc'        => 'Syriac',
        'tl'         => 'Tagalog',
        'ty'         => 'Tahitian',
        'tg'         => 'Tajik',
        'tzl'        => 'Talossan',
        'ta'         => 'Tamil',
        'tt-RU'      => 'Tatar',
        'te'         => 'Telugu',
        'kdh'        => 'Tem (Kotokoli)',
        'th'         => 'Thai',
        'bo-BT'      => 'Tibetan',
        'ti'         => 'Tigrinya',
        'ts'         => 'Tsonga',
        'tn'         => 'Tswana',
        'tr'         => 'Turkish',
        'tr-TR'      => 'Turkish - Turkey',
        'tr-CY'      => 'Turkish, Cyprus',
        'tk'         => 'Turkmen',
        'uk'         => 'Ukrainian',
        'uk-UA'      => 'Ukrainian - Ukraine',
        'hsb-DE '    => 'Upper Sorbian',
        'ur-IN'      => 'Urdu (India)',
        'ur-PK'      => 'Urdu (Pakistan)',
        'ug'         => 'Uyghur',
        'uz'         => 'Uzbek',
        'val-ES'     => 'Valencian',
        've'         => 'Venda',
        'vec'        => 'Venetian',
        'vi'         => 'Vietnamese',
        'vi-VN'      => 'Vietnamese (Viet Nam)',
        'wa'         => 'Walloon',
        'cy'         => 'Welsh',
        'wo'         => 'Wolof',
        'xh'         => 'Xhosa',
        'yi'         => 'Yiddish',
        'yo'         => 'Yoruba',
        'zea'        => 'Zeelandic',
        'zu'         => 'Zulu',
        'cmn-TW'     => 'Taiwanese Mandarin',
    ];

    public function index()
    {
        $memberships = Membership::where('id', '<>', 1)->orderBy('id', 'desc')
            ->get();
        $packages = Package::all();
        return view('membership.index')->with(['memberships' => $memberships, "packages" => $packages]);
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
            'name'              => 'required',
            'price'             => 'required',
            'voices'            => 'required',
            'languages'         => 'required',
            'voice_type'        => 'required',
            'characters_length' => 'required',
            'package'           => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {

            return response()->json(['error' => $validator->errors()], 500);

        }

        DB::beginTransaction();

        try {

            $membership = Membership::create([
                'name'              => $request->name,
                'price'             => $request->price,
                'voice_type'        => $request->voice_type,
                'characters_length' => $request->characters_length,
                'status'            => 1,
                'package_id'        => $request->package,
            ]);

            foreach ($request->languages as $language) {
                $languageCode1 = array_search($language, $this->code);
                $newLanguage   = Language::create([
                    'membership_id' => $membership->id,
                    'name'          => $language,
                    'code'          => $languageCode1,
                ]);

                foreach ($request->voices as $voice) {
                    $ssml_gender   = strtok($voice, ' ');
                    $voiceCode     = substr($voice, strpos($voice, " ") + 1);
                    $languageCode2 = substr($voiceCode, 0, strpos($voiceCode, '-', strpos($voiceCode, '-') + 1));
                    if ($languageCode1 == $languageCode2) {
                        $languageVoice = LanguageVoice::create([
                            'language_id'               => $newLanguage->id,
                            'name'                      => $voiceCode,
                            'ssml_gender'               => $ssml_gender,
                            'natural_sample_rate_hertz' => 2400,
                        ]);
                    }

                }

            }

            DB::commit();

            return response()->json([
                'message' => "Membership created Successfully",
                'data'    => $membership,
                'error'   => false,
            ], 200);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => "Membership can not created",
                'data'    => null,
                'error'   => true,
            ]);

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function show(Membership $membership)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function edit(Membership $membership)
    {
        $membershipLanguages = Membership::whereId($membership->id)->with('languages.languagevoices')->first();

        $selectedLanguage = Language::select('name', 'code')->where('membership_id', $membership->id)->get()->toArray();
        $selectedVoices   = [];

        foreach ($membershipLanguages->languages as $language) {

            foreach ($language->languagevoices as $voice) {

                $selectedVoices[] = [
                    'name'   => $voice->name,
                    'gender' => $voice->ssml_gender,
                ];

            }

        }

        $voices = array();

        if ($membershipLanguages->voice_type == 'Both') {

            $languages = Voice::distinct('language')->get(['language', 'code']);

            foreach ($selectedLanguage as $code) {

                $voices[] = Voice::Where('code', $code['code'])->get(['ssml_gender', 'name']);

            }

        } else {

            $languages = Voice::Where('name', 'like', '%' . $membershipLanguages->voice_type . '%')->distinct('language')->get(['language', 'code']);

            foreach ($selectedLanguage as $code) {

                $voices[] = Voice::Where('code', $code['code'])->Where('name', 'like', '%' . $membershipLanguages->voice_type . '%')->get(['ssml_gender', 'name']);

            }
        }

        // return view('membership.edit',compact('selectedLanguage','languages','selectedVoices','voices'));
        return response(['membership',
            'selectedLanguage' => $selectedLanguage,
            'languages'        => $languages,
            'selectedVoices'   => $selectedVoices,
            'voices'           => $voices,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Membership $membership)
    {

        $rules = [
            'name'              => 'required',
            'price'             => 'required',
            'voice_type'        => 'required',
            'languages'         => 'required',
            'voices'            => 'required',
            'characters_length' => 'required',
            'status'            => 'required',
            'package'           => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return response()->json(['error' => $validator]);

        } else {

            $memb = $membership->update([
                'name'              => $request->name,
                'price'             => $request->price,
                'status'            => $request->status,
                'voice_type'        => $request->voice_type,
                'characters_length' => $request->characters_length,
                'package_id'        => $request->package,
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);

            if ($memb == true) {

                $oldLanguage = Language::where('membership_id', $membership->id)->delete();

                if ($oldLanguage == true) {
                    foreach ($request->languages as $language) {
                        $languageCode1 = array_search($language, $this->code);
                        $newLanguage   = Language::create([
                            'membership_id' => $membership->id,
                            'name'          => $language,
                            'code'          => $languageCode1,
                            'created_at'    => date('Y-m-d H:i:s'),
                        ]);
                        if (!empty($newLanguage)) {
                            foreach ($request->voices as $voice) {
                                $ssml_gender   = strtok($voice, ' ');
                                $voiceCode     = substr($voice, strpos($voice, " ") + 1);
                                $languageCode2 = substr($voiceCode, 0, strpos($voiceCode, '-', strpos($voiceCode, '-') + 1));
                                if ($languageCode1 == $languageCode2) {
                                    $languageVoice = LanguageVoice::create([
                                        'language_id'               => $newLanguage->id,
                                        'name'                      => $voiceCode,
                                        'ssml_gender'               => $ssml_gender,
                                        'natural_sample_rate_hertz' => 2400,
                                    ]);
                                }

                            }

                        }
                    }
                }
                return !$memb == false ? response()->json([
                    'message' => "Membership updated Successfully",
                    'data'    => Membership::with('package')->where('id', '<>', 1)->orderBy('id', 'desc')
                        ->get(),
                    'error'   => false,
                ], 201) :
                response()->json([
                    'message' => 'Membership not updated',
                    'data'    => null,
                    'error'   => true,
                ]);

            }

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function destroy(Membership $membership)
    {

        $message = $membership->delete();
        return $message == true ? response()->json([
            'message' => "Membership deleted successfully",
            'data'    => Membership::where('id', '<>', 1)->orderBy('id', 'desc')->get(),
            'error'   => false,
        ], 200) :
        response()->json([
            'message' => "Membership can not be deleted",
            'data'    => null,
            'error'   => true,
        ], 200);
    }

    public function membershipsearch(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $query  = $request->membership;

            if ($query != '') {
                $data = Membership::

                    where('id', '<>', 1)
                    ->where('name', 'like', '%' . $query . '%')
                    ->orWhere('voice_type', 'like', '%' . $query . '%')
                    ->orWhere('characters_length', 'like', '%' . $query . '%')
                    ->orWhere('price', 'like', '%' . $query . '%')
                    ->orWhere('price', 'like', '%' . $query . '%')
                    ->orderBy('id', 'desc')
                    ->get();

            } else {
                $data = Membership::where('id', '<>', 1)->
                    orderBy('id', 'desc')
                    ->get();
            }
            $total_row = $data->count();
            return response([
                'total_data' => $total_row,
                'table_data' => $data,
            ]);

        }
    }

}
