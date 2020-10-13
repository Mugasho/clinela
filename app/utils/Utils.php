<?php


namespace clinela\utils;


use clinela\database\DB;

class Utils {
    public $countries;

    /**
     * Utils constructor.
     */
    public function __construct() {
        $this->countries = $this->get_countries();
    }

    /**
     * countries of the world
     * @return array
     */
    function get_countries() {
        /*
         * @param none
         * @return array
         */
        return array(
            'AF' => 'Afghanistan',
            'AX' => '&#197;land Islands',
            'AL' => 'Albania',
            'DZ' => 'Algeria',
            'AS' => 'American Samoa',
            'AD' => 'Andorra',
            'AO' => 'Angola',
            'AI' => 'Anguilla',
            'AQ' => 'Antarctica',
            'AG' => 'Antigua and Barbuda',
            'AR' => 'Argentina',
            'AM' => 'Armenia',
            'AW' => 'Aruba',
            'AU' => 'Australia',
            'AT' => 'Austria',
            'AZ' => 'Azerbaijan',
            'BS' => 'Bahamas',
            'BH' => 'Bahrain',
            'BD' => 'Bangladesh',
            'BB' => 'Barbados',
            'BY' => 'Belarus',
            'BE' => 'Belgium',
            'PW' => 'Belau',
            'BZ' => 'Belize',
            'BJ' => 'Benin',
            'BM' => 'Bermuda',
            'BT' => 'Bhutan',
            'BO' => 'Bolivia',
            'BQ' => 'Bonaire, Saint Eustatius and Saba',
            'BA' => 'Bosnia and Herzegovina',
            'BW' => 'Botswana',
            'BV' => 'Bouvet Island',
            'BR' => 'Brazil',
            'IO' => 'British Indian Ocean Territory',
            'VG' => 'British Virgin Islands',
            'BN' => 'Brunei',
            'BG' => 'Bulgaria',
            'BF' => 'Burkina Faso',
            'BI' => 'Burundi',
            'KH' => 'Cambodia',
            'CM' => 'Cameroon',
            'CA' => 'Canada',
            'CV' => 'Cape Verde',
            'KY' => 'Cayman Islands',
            'CF' => 'Central African Republic',
            'TD' => 'Chad',
            'CL' => 'Chile',
            'CN' => 'China',
            'CX' => 'Christmas Island',
            'CC' => 'Cocos (Keeling) Islands',
            'CO' => 'Colombia',
            'KM' => 'Comoros',
            'CG' => 'Congo (Brazzaville)',
            'CD' => 'Congo (Kinshasa)',
            'CK' => 'Cook Islands',
            'CR' => 'Costa Rica',
            'HR' => 'Croatia',
            'CU' => 'Cuba',
            'CW' => 'Cura&ccedil;ao',
            'CY' => 'Cyprus',
            'CZ' => 'Czech Republic',
            'DK' => 'Denmark',
            'DJ' => 'Djibouti',
            'DM' => 'Dominica',
            'DO' => 'Dominican Republic',
            'EC' => 'Ecuador',
            'EG' => 'Egypt',
            'SV' => 'El Salvador',
            'GQ' => 'Equatorial Guinea',
            'ER' => 'Eritrea',
            'EE' => 'Estonia',
            'ET' => 'Ethiopia',
            'FK' => 'Falkland Islands',
            'FO' => 'Faroe Islands',
            'FJ' => 'Fiji',
            'FI' => 'Finland',
            'FR' => 'France',
            'GF' => 'French Guiana',
            'PF' => 'French Polynesia',
            'TF' => 'French Southern Territories',
            'GA' => 'Gabon',
            'GM' => 'Gambia',
            'GE' => 'Georgia',
            'DE' => 'Germany',
            'GH' => 'Ghana',
            'GI' => 'Gibraltar',
            'GR' => 'Greece',
            'GL' => 'Greenland',
            'GD' => 'Grenada',
            'GP' => 'Guadeloupe',
            'GU' => 'Guam',
            'GT' => 'Guatemala',
            'GG' => 'Guernsey',
            'GN' => 'Guinea',
            'GW' => 'Guinea-Bissau',
            'GY' => 'Guyana',
            'HT' => 'Haiti',
            'HM' => 'Heard Island and McDonald Islands',
            'HN' => 'Honduras',
            'HK' => 'Hong Kong',
            'HU' => 'Hungary',
            'IS' => 'Iceland',
            'IN' => 'India',
            'ID' => 'Indonesia',
            'IR' => 'Iran',
            'IQ' => 'Iraq',
            'IE' => 'Republic of Ireland',
            'IM' => 'Isle of Man',
            'IL' => 'Israel',
            'IT' => 'Italy',
            'CI' => 'Ivory Coast',
            'JM' => 'Jamaica',
            'JP' => 'Japan',
            'JE' => 'Jersey',
            'JO' => 'Jordan',
            'KZ' => 'Kazakhstan',
            'KE' => 'Kenya',
            'KI' => 'Kiribati',
            'KW' => 'Kuwait',
            'KG' => 'Kyrgyzstan',
            'LA' => 'Laos',
            'LV' => 'Latvia',
            'LB' => 'Lebanon',
            'LS' => 'Lesotho',
            'LR' => 'Liberia',
            'LY' => 'Libya',
            'LI' => 'Liechtenstein',
            'LT' => 'Lithuania',
            'LU' => 'Luxembourg',
            'MO' => 'Macao S.A.R., China',
            'MK' => 'Macedonia',
            'MG' => 'Madagascar',
            'MW' => 'Malawi',
            'MY' => 'Malaysia',
            'MV' => 'Maldives',
            'ML' => 'Mali',
            'MT' => 'Malta',
            'MH' => 'Marshall Islands',
            'MQ' => 'Martinique',
            'MR' => 'Mauritania',
            'MU' => 'Mauritius',
            'YT' => 'Mayotte',
            'MX' => 'Mexico',
            'FM' => 'Micronesia',
            'MD' => 'Moldova',
            'MC' => 'Monaco',
            'MN' => 'Mongolia',
            'ME' => 'Montenegro',
            'MS' => 'Montserrat',
            'MA' => 'Morocco',
            'MZ' => 'Mozambique',
            'MM' => 'Myanmar',
            'NA' => 'Namibia',
            'NR' => 'Nauru',
            'NP' => 'Nepal',
            'NL' => 'Netherlands',
            'AN' => 'Netherlands Antilles',
            'NC' => 'New Caledonia',
            'NZ' => 'New Zealand',
            'NI' => 'Nicaragua',
            'NE' => 'Niger',
            'NG' => 'Nigeria',
            'NU' => 'Niue',
            'NF' => 'Norfolk Island',
            'MP' => 'Northern Mariana Islands',
            'KP' => 'North Korea',
            'NO' => 'Norway',
            'OM' => 'Oman',
            'PK' => 'Pakistan',
            'PS' => 'Palestinian Territory',
            'PA' => 'Panama',
            'PG' => 'Papua New Guinea',
            'PY' => 'Paraguay',
            'PE' => 'Peru',
            'PH' => 'Philippines',
            'PN' => 'Pitcairn',
            'PL' => 'Poland',
            'PT' => 'Portugal',
            'PR' => 'Puerto Rico',
            'QA' => 'Qatar',
            'RE' => 'Reunion',
            'RO' => 'Romania',
            'RU' => 'Russia',
            'RW' => 'Rwanda',
            'BL' => 'Saint Barth&eacute;lemy',
            'SH' => 'Saint Helena',
            'KN' => 'Saint Kitts and Nevis',
            'LC' => 'Saint Lucia',
            'MF' => 'Saint Martin (French part)',
            'SX' => 'Saint Martin (Dutch part)',
            'PM' => 'Saint Pierre and Miquelon',
            'VC' => 'Saint Vincent and the Grenadines',
            'SM' => 'San Marino',
            'ST' => 'S&atilde;o Tom&eacute; and Pr&iacute;ncipe',
            'SA' => 'Saudi Arabia',
            'SN' => 'Senegal',
            'RS' => 'Serbia',
            'SC' => 'Seychelles',
            'SL' => 'Sierra Leone',
            'SG' => 'Singapore',
            'SK' => 'Slovakia',
            'SI' => 'Slovenia',
            'SB' => 'Solomon Islands',
            'SO' => 'Somalia',
            'ZA' => 'South Africa',
            'GS' => 'South Georgia/Sandwich Islands',
            'KR' => 'South Korea',
            'SS' => 'South Sudan',
            'ES' => 'Spain',
            'LK' => 'Sri Lanka',
            'SD' => 'Sudan',
            'SR' => 'Suriname',
            'SJ' => 'Svalbard and Jan Mayen',
            'SZ' => 'Swaziland',
            'SE' => 'Sweden',
            'CH' => 'Switzerland',
            'SY' => 'Syria',
            'TW' => 'Taiwan',
            'TJ' => 'Tajikistan',
            'TZ' => 'Tanzania',
            'TH' => 'Thailand',
            'TL' => 'Timor-Leste',
            'TG' => 'Togo',
            'TK' => 'Tokelau',
            'TO' => 'Tonga',
            'TT' => 'Trinidad and Tobago',
            'TN' => 'Tunisia',
            'TR' => 'Turkey',
            'TM' => 'Turkmenistan',
            'TC' => 'Turks and Caicos Islands',
            'TV' => 'Tuvalu',
            'UG' => 'Uganda',
            'UA' => 'Ukraine',
            'AE' => 'United Arab Emirates',
            'GB' => 'United Kingdom (UK)',
            'US' => 'United States (US)',
            'UM' => 'United States (US) Minor Outlying Islands',
            'VI' => 'United States (US) Virgin Islands',
            'UY' => 'Uruguay',
            'UZ' => 'Uzbekistan',
            'VU' => 'Vanuatu',
            'VA' => 'Vatican',
            'VE' => 'Venezuela',
            'VN' => 'Vietnam',
            'WF' => 'Wallis and Futuna',
            'EH' => 'Western Sahara',
            'WS' => 'Samoa',
            'YE' => 'Yemen',
            'ZM' => 'Zambia',
            'ZW' => 'Zimbabwe'
        );
    }

    /**
     * ugandan districts
     * @return array
     */
    function get_districts() {
        return array(
            "abim"          => "Abim",
            "adjumani"      => "Adjumani",
            "agago"         => "Agago",
            "alebtong"      => "Alebtong",
            "amolatar"      => "Amolatar",
            "amudat"        => "Amudat",
            "amuria"        => "Amuria",
            "amuru"         => "Amuru",
            "apac"          => "Apac",
            "arua"          => "Arua",
            "budaka"        => "Budaka",
            "bududa"        => "Bududa",
            "bugiri"        => "Bugiri",
            "buikwe"        => "Buikwe",
            "bukedea"       => "Bukedea",
            "bukomansimbi"  => "Bukomansimbi",
            "bukwo"         => "Bukwo",
            "bulambuli"     => "Bulambuli",
            "buliisa"       => "Buliisa",
            "bundibugyo"    => "Bundibugyo",
            "bushenyi"      => "Bushenyi",
            "busia"         => "Busia",
            "butaleja"      => "Butaleja",
            "butambala"     => "Butambala",
            "buvuma"        => "Buvuma",
            "buyende"       => "Buyende",
            "dokolo"        => "Dokolo",
            "gomba"         => "Gomba",
            "gulu"          => "Gulu",
            "hoima"         => "Hoima",
            "ibanda"        => "Ibanda",
            "iganga"        => "Iganga",
            "isingiro"      => "Isingiro",
            "jinja"         => "Jinja",
            "kaabong"       => "Kaabong",
            "kabale"        => "Kabale",
            "kabarole"      => "Kabarole",
            "kaberamaido"   => "Kaberamaido",
            "kalangala"     => "Kalangala",
            "kaliro"        => "Kaliro",
            "kalungu"       => "Kalungu",
            "kampala"       => "Kampala",
            "kamuli"        => "Kamuli",
            "kamwenge"      => "Kamwenge",
            "kanungu"       => "Kanungu",
            "kapchorwa"     => "Kapchorwa",
            "kasese"        => "Kasese",
            "katakwi"       => "Katakwi",
            "katerere"      => "Katerere",
            "kayunga"       => "Kayunga",
            "kibaale"       => "Kibaale",
            "kibingo"       => "Kibingo",
            "kiboga"        => "Kiboga",
            "kibuku"        => "Kibuku",
            "kiruhura"      => "Kiruhura",
            "kiryandongo"   => "Kiryandongo",
            "kisoro"        => "Kisoro",
            "kitgum"        => "Kitgum",
            "koboko"        => "Koboko",
            "kole"          => "Kole",
            "kotido"        => "Kotido",
            "kumi"          => "Kumi",
            "kween"         => "Kween",
            "kyankwanzi"    => "Kyankwanzi",
            "kyegegwa"      => "Kyegegwa",
            "kyenjojo"      => "Kyenjojo",
            "lamwo"         => "Lamwo",
            "lira"          => "Lira",
            "luuka"         => "Luuka",
            "luwero"        => "Luwero",
            "lwengo"        => "Lwengo",
            "lyantonde"     => "Lyantonde",
            "manafwa"       => "Manafwa",
            "maracha"       => "Maracha",
            "masaka"        => "Masaka",
            "masindi"       => "Masindi",
            "mayuge"        => "Mayuge",
            "mbale"         => "Mbale",
            "mbarara"       => "Mbarara",
            "mitooma"       => "Mitooma",
            "mityana"       => "Mityana",
            "moroto"        => "Moroto",
            "moyo"          => "Moyo",
            "mpigi"         => "Mpigi",
            "mubende"       => "Mubende",
            "mukono"        => "Mukono",
            "nakapiripirit" => "Nakapiripirit",
            "nakaseke"      => "Nakaseke",
            "nakasongola"   => "Nakasongola",
            "namiyango"     => "Namiyango",
            "namutumba"     => "Namutumba",
            "napak"         => "Napak",
            "nebbi"         => "Nebbi",
            "ngora"         => "Ngora",
            "nsiika"        => "Nsiika",
            "ntoroko"       => "Ntoroko",
            "ntungamo"      => "Ntungamo",
            "nwoya"         => "Nwoya",
            "otuke"         => "Otuke",
            "oyam"          => "Oyam",
            "pader"         => "Pader",
            "pallisa"       => "Pallisa",
            "rakai"         => "Rakai",
            "rukungiri"     => "Rukungiri",
            "serere"        => "Serere",
            "sironko"       => "Sironko",
            "soroti"        => "Soroti",
            "ssembabule"    => "Ssembabule",
            "tororo"        => "Tororo",
            "wakiso"        => "Wakiso",
            "yumbe"         => "Yumbe",
            "zombo"         => "Zombo"
        );
    }

    function get_gender() {
        /*
        * @param none
        * @return array
        */
        return array(
            'M' => 'Male',
            'F' => 'Female'
        );
    }

    function get_fee_action() {
        /*
        * @param none
        * @return array
        */
        return array(
            '0' => 'Deposit',
            '1' => 'Withdraw'
        );
    }

    function get_asset_category() {
        /*
        * @param none
        * @return array
        */
        return array(
            'current'    => 'Current',
            'fixed'      => 'Fixed',
            'intangible' => 'Intangible',
            'investment' => 'Investment',
            'other'      => 'Other'
        );
    }

    function get_recur_types() {
        /*
        * @param none
        * @return array
        */
        return array(
            '1'   => 'After Meal',
            '2'  => 'Before Meal',
            '3' => 'Morning',
            '4'  => 'Night'

        );
    }

    function get_prescription_period() {
        /*
        * @param none
        * @return array
        */
        return array(
            'day'   => 'Day(s)',
            'week'  => 'Week(s)',
            'month' => 'Month(s)',
            'year'  => 'Year(s)'

        );
    }

    function get_blood_group() {
        /*
        * @param none
        * @return array
        */
        return array(
            'A-'   => 'A+',
            'A+'   => 'A+',
            'B-'   => 'B-',
            'B+'   => 'B+',
            'AB-'   => 'AB-',
            'AB+'   => 'AB+',
            'O-'   => 'O-',
            'O+'   => 'O+'
        );
    }

    function get_bool() {
        /*
        * @param none
        * @return array
        */
        return array(
            '1'   => 'Yes',
            '0'  => 'No'
        );
    }

    function get_icon_colors() {
        /*
        * @param none
        * @return array
        */
        return array(
            'indigo-400'  => 'indigo-400',
            'success-400' => 'success-400',
            'primary-400'  => 'primary-400',
            'warning-400'  => 'warning-400',
            'danger-400'  => 'danger-400'

        );
    }

    function get_extension( $filename ) {
        return strtolower( pathinfo( $filename, PATHINFO_EXTENSION ) );
    }

    function get_icon( $extension ) {
        switch ( $extension ) {
            case 'jpg':
            case 'png':
            case 'gif':
                return 'icon-file-picture text-primary-300';
            case 'xls':
            case 'xlsx':
            case 'csv':
                return 'icon-file-excel text-success-300';
            case 'ppt':
            case 'pptx':
                return 'icon-file-presentation text-warning-300';
            case 'doc':
            case 'docx':
            case 'rtf':
                return 'icon-file-word text-primary-300';
            case 'pdf':
                return 'icon-file-pdf text-warning-300';
            default:
                return 'icon-file-text2 text-primary-300';
        }
    }

    function get_image_icon( $filename, $width = 60, $classes = '' ) {
        switch ( $this->get_extension( $filename ) ) {
            case 'jpg':
            case 'png':
            case 'gif':
                $image = '<img src="' . $filename . '" alt="" class="' . $classes . '" width="' . $width . '">';
                break;
            case 'pdf':
                $image = '<i class="icon-file-pdf icon-2x text-warning-300"></i>';
                break;
            case 'xls':
            case 'xlsx':
                $image = '<i class="icon-file-spreadsheet icon-2x text-success-300"></i>';
                break;
            case 'ppt':
            case 'pptx':
                $image = '<i class="icon-file-presentation icon-2x text-warning-300"></i>';
                break;
            case 'rtf':
            case 'doc':
            case 'docx':
                $image = '<i class="icon-file-word icon-2x text-primary-300"></i>';
                break;
            default:
                $image = '<i class="icon-file-text icon-2x text-primary-300"></i>';

        }

        return $image;
    }

    /**
     * convert bytes to other units
     * @param $bytes
     * @param int $precision
     *
     * @return string
     */
    function formatBytes( $bytes, $precision = 2 ) {
        $units = array( 'B', 'KB', 'MB', 'GB', 'TB' );

        $bytes = max( $bytes, 0 );
        $pow   = floor( ( $bytes ? log( $bytes ) : 0 ) / log( 1024 ) );
        $pow   = min( $pow, count( $units ) - 1 );

        // Uncomment one of the following alternatives
        $bytes /= pow( 1024, $pow );

        // $bytes /= (1 << (10 * $pow));

        return round( $bytes, $precision ) . ' ' . $units[ $pow ];
    }

    /**
     * Get elapsed time to now
     * @param $old_date
     *
     * @return string
     */
    function get_interval( $old_date ) {
        $interval = date_diff( date_create(), date_create( $old_date ) );

        if ( $interval->y > 0 ) {
            return $interval->format( "%y yrs" );
        }
        if ( $interval->y < 1 && $interval->m > 0 ) {
            return $interval->format( "%m Months" );
        }
        if ( $interval->y < 1 && $interval->m < 1 && $interval->d > 0 ) {
            return $interval->format( "%d Days" );
        }
        if ( $interval->y < 1 && $interval->m < 1 && $interval->d < 1 && $interval->h > 0 ) {

            return $interval->format( "%h Hours" );
        }
    }

    /**
     * Reduce word length
     *
     * @param $text
     * @param $maxChar
     * @param string $end
     *
     * @return string
     */
    function limitChars( $text, $maxChar, $end = '...' ) {
        $output = '';
        if ( ! empty( $text ) ) {
            if ( strlen( $text ) > $maxChar || $text == '' ) {
                $words  = preg_split( '/\s/', $text );
                $output = '';
                $i      = 0;
                while ( 1 ) {
                    $length = strlen( $output ) + strlen( $words[ $i ] );
                    if ( $length > $maxChar ) {
                        break;
                    } else {
                        $output .= " " . $words[ $i ];
                        ++ $i;
                    }
                }
                $output .= $end;
            } else {
                $output = $text;
            }
        }

        return $output;
    }

    /**
     * Adds required Html markup to email
     *
     * @param $content
     *
     * @return string
     */
    function getHtmlMessage($content){
        return '<html><body style="background-color: #222533; padding: 20px; font-family: font-size: 14px; line-height: 1.43; font-family: &quot;Helvetica Neue&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif;">

<div style="max-width: 600px; margin: 0px auto; background-color: #fff; box-shadow: 0px 20px 50px rgba(0,0,0,0.05);">
    
    <div style="padding: 60px 70px; border-top: 1px solid rgba(0,0,0,0.05);"><h1 style="margin-top: 0px;">Hi ' . $content['username'] . ',</h1>
        <div style="color: #636363; font-size: 14px;"><p>'.$content['msg'] . '</p></div>
        <a href="' . BASE_PATH  . $content['btn_link'] . '"
           style="padding: 8px 20px; background-color: #4B72FA; color: #fff; font-weight: bolder; font-size: 16px; display: inline-block; margin: 20px 0px; margin-right: 20px; text-decoration: none;">'.$content['btn_text'] . '</a><h4 style="margin-bottom: 10px;">Need Help?</h4>
        <div style="color: #A5A5A5; font-size: 12px;"><p>If you have any questions you can simply reply to this email or
                find our contact information below. Also contact us at <a href="#">info@clineladoctors.com</a>
            </p>
            </div>
    </div>
    
    <table style="width: 100%;">
        <tr>
            <td style="background-color: #fff;"><img alt="" src="'.CONTENT_PATH.'images/square-logo.png" style="width: 70px; padding: 20px"></td>
            <td style="padding-left: 50px; text-align: right; padding-right: 20px;">
            <a href="'.BASE_PATH.'login/" style="color: #261D1D; text-decoration: underline; font-size: 14px; letter-spacing: 1px;">Sign In</a>
                    <a href="'.BASE_PATH.'forgot/"
                             style="color: #7C2121; text-decoration: underline; font-size: 14px; margin-left: 20px; letter-spacing: 1px;">Forgot
                    Password</a></td>
        </tr>
    </table>


</div>
<div style="max-width: 600px; margin: 10px auto 20px; font-size: 12px; color: #A5A5A5; text-align: center;">If you are
    unable to see this message, <a href="#" style="color: #A5A5A5; text-decoration: underline;">click here to view in
        browser</a>
        </div>
</body></html>';
    }

    /**
     * Send plain email.
     * Additional formatting maybe required
     * @param $from
     * @param $to
     * @param $subject
     * @param $message
     */
    function sendEmail($from,$to,$subject,$message){

        // To send HTML mail, the Content-type header must be set
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        // Create email headers
        $headers .= 'From: ClinelaDoctors <'.$from.">\r\n".
            'Reply-To: '.$from."\r\n" .
            'X-Mailer: PHP/' . phpversion();
        // use wordwrap() if lines are longer than 70 characters
        $msg = wordwrap( $message, 70 );
        //send email
        mail( $to, $subject, $msg,$headers );

    }

    function detectDevice(){
        $deviceName="";
        $userAgent = $_SERVER["HTTP_USER_AGENT"];
        $devicesTypes = array(
            "computer" => array("msie 10", "msie 9", "msie 8", "windows.*firefox", "windows.*chrome", "x11.*chrome", "x11.*firefox", "macintosh.*chrome", "macintosh.*firefox", "opera"),
            "tablet"   => array("tablet", "android", "ipad", "tablet.*firefox"),
            "mobile"   => array("mobile ", "android.*mobile", "iphone", "ipod", "opera mobi", "opera mini"),
            "bot"      => array("googlebot", "mediapartners-google", "adsbot-google", "duckduckbot", "msnbot", "bingbot", "ask", "facebook", "yahoo", "addthis")
        );
        foreach($devicesTypes as $deviceType => $devices) {
            foreach($devices as $device) {
                if(preg_match("/" . $device . "/i", $userAgent)) {
                    $deviceName = $deviceType;
                }
            }
        }
        return ucfirst($deviceName);
    }

    function getBrowser()
    {
        $u_agent = $_SERVER['HTTP_USER_AGENT'];
        $b_name = 'Unknown';
        $platform = 'Unknown';

        //First get the platform?
        if (preg_match('/linux/i', $u_agent)) {
            $platform = 'linux';
        }
        elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
            $platform = 'mac';
        }
        elseif (preg_match('/windows|win32/i', $u_agent)) {
            $platform = 'windows';
        }

        // Next get the name of the useragent yes seperately and for good reason
        if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
        {
            $b_name = 'Internet Explorer';
            $ub = "MSIE";
        }
        elseif(preg_match('/Firefox/i',$u_agent))
        {
            $b_name = 'Mozilla Firefox';
            $ub = "Firefox";
        }
        elseif(preg_match('/Chrome/i',$u_agent))
        {
            $b_name = 'Google Chrome';
            $ub = "Chrome";
        }
        elseif(preg_match('/Safari/i',$u_agent))
        {
            $b_name = 'Apple Safari';
            $ub = "Safari";
        }
        elseif(preg_match('/Opera/i',$u_agent))
        {
            $b_name = 'Opera';
            $ub = "Opera";
        }
        elseif(preg_match('/Netscape/i',$u_agent))
        {
            $b_name = 'Netscape';
            $ub = "Netscape";
        }

        // finally get the correct version number
        $known = array('Version', $ub, 'other');
        $pattern = '#(?<browser>' . join('|', $known) .
            ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
        if (!preg_match_all($pattern, $u_agent, $matches)) {
            // we have no matching number just continue
        }

        // see how many we have
        $i = count($matches['browser']);
        if ($i != 1) {
            //we will have two since we are not using 'other' argument yet
            //see if version is before or after the name
            if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
                $version= $matches['version'][0];
            }
            else {
                $version= $matches['version'][1];
            }
        }
        else {
            $version= $matches['version'][0];
        }

        // check if we have a number
        if ($version==null || $version=="") {$version="?";}

        return array(
            'userAgent' => $u_agent,
            'name'      => $b_name,
            'version'   => $version,
            'platform'  => $platform,
            'pattern'    => $pattern
        );
    }

    /**
     * Returns day of week as string
     * @param $day
     * @return string
     */
    public static function getDayOfWeek($day){
        switch ($day){
            case 1:
                $day='Monday';
                break;
            case 2:
                $day='Tuesday';
                break;
            case 3:
                $day='Wednesday';
                break;
            case 4:
                $day='Thursday';
                break;
            case 5:
                $day='Friday';
                break;
            case 6:
                $day='Saturday';
                break;
            case 7:
                $day='Sunday';
                break;
        }
        return $day;
    }

    public function sendSMS($sender, $destination, $message)
    {

        $db=new DB();
        if (strncmp($destination, "0", 1) === 0){
           $destination= '256'.mb_strcut($destination,1);
        }
        if (strncmp($destination, "+", 1) === 0){
            $destination= mb_strcut($destination,1);
        }
        $email = $db->getOptions('sms_api_email');
        $password = $db->getOptions('sms_api_password');
        $url = 'http://caltonmobile.com/calton/api.php?';
        $parameters = 'username=[EMAIL]&password=[PASSWORD]&contacts=[DESTINATION]&message=[MESSAGE]&sender=[SENDERID]';
        $parameters = str_replace('[EMAIL]',$email,$parameters);
        $parameters = str_replace('[PASSWORD]',urlencode($password),$parameters);
        $parameters = str_replace('[DESTINATION]',$destination,$parameters);
        $parameters = str_replace('[MESSAGE]',urlencode($message),$parameters);
        $parameters = str_replace('[SENDERID]',urlencode($sender),$parameters);
        $post_url = $url.$parameters;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $post_url);
        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result);
    }
}