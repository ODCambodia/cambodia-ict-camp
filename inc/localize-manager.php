<?php
/*
 * CambodiaICTCamp
 * Localize Manager
 */

class ICTCamp_Localize_Manager
{

    var $current_language = 'en';

    var $supported_languages = array(
        'en' => 'English',
        'km' => 'Khmer'
    );

    function __construct()
    {
        add_action( 'after_setup_theme', array( $this, 'init_language_manager' ) );
    }

    function init_language_manager()
    {
        if ( function_exists( 'qtranxf_getLanguage' ) ) {
            $local_lang = qtranxf_getLanguage();
            $this->current_language = $local_lang;
        }
    }

    function get_the_language_by_language_code( $lang_code = 'en' )
    {
        return $this->supported_languages[$lang_code];
    }

    function get_current_language()
    {
        return $this->current_language;
    }

    function get_supported_languages()
    {
        return $this->supported_languages;
    }

    function echo_language_selectors()
    {
        if ( function_exists( 'qtranxf_generateLanguageSelectCode' ) ) {
            qtranxf_generateLanguageSelectCode( 'image' );
        }
    }

    function get_path_to_flag_image( $lang )
    {
        return get_stylesheet_directory_uri() . '/img/' . $lang . '.png';
    }

    function print_language_flags_for_post( $post )
    {
        foreach ( $this->supported_languages as $lang_code => $lang ) {
            if ( function_exists( 'qtranxf_isAvailableIn' ) && qtranxf_isAvailableIn( $post->ID, $lang_code ) ) { // no En content
                $path_to_flag = ictcamp_localize_manager()->get_path_to_flag_image( $lang_code );

                if ( !empty( $path_to_flag ) ) {
                    echo '<img class="lang_flag" alt="' . $lang . '" src="' . $path_to_flag . '"></img>';
                }
            }
        }
    }

    /****** Add function convert date, H.E ******/
    function khmer_date( $date_string, $splitted_by = '.' )
    {
        if ( ictcamp_localize_manager()->get_current_language() == 'km' ) {
            $splitted_date = explode( $splitted_by, $date_string ); 
            $joined_date = '';

            if ( count( $splitted_date ) > 1) {
                $joined_date .= 'ថ្ងៃទី ' . ictcamp_localize_manager()->convert_to_kh_number( $splitted_date[0] );
                $joined_date .= ' ខែ' . ictcamp_localize_manager()->convert_to_kh_month( $splitted_date[1] );
                $joined_date .= ' ឆ្នាំ' . ictcamp_localize_manager()->convert_to_kh_number( $splitted_date[2] );
            }

            return $joined_date;
        } else {
            $return_date = date( 'j F Y', strtotime( $date_string ) );

            return  $return_date;
        }
    }

    function convert_to_kh_month( $month = '' )
    {
        if ( ictcamp_localize_manager()->get_current_language() == 'km' ) {
            if ( $month == 'Jan' ) {
                $kh_month = 'មករា';
            } elseif ( $month == 'Feb' ) {
                $kh_month = 'កុម្ភៈ';
            } elseif ( $month == 'Mar' ) {
                $kh_month = 'មីនា';
            } elseif ( $month == 'Apr' ) {
                $kh_month = 'មេសា';
            } elseif ( $month == 'May' ) {
                $kh_month = 'ឧសភា';
            } elseif ( $month == 'Jun' ) {
                $kh_month = 'មិថុនា';
            } elseif ( $month == 'Jul' ) {
                $kh_month = 'កក្កដា';
            } elseif ( $month == 'Aug' ) {
                $kh_month = 'សីហា';
            } elseif ( $month == 'Sep' ) {
                $kh_month = 'កញ្ញា';
            } elseif ( $month == 'Oct' ) {
                $kh_month = 'តុលា';
            } elseif ( $month == 'Nov' ) {
                $kh_month = 'វិច្ឆិកា';
            } elseif ( $month == 'Dec' ) {
                $kh_month = 'ធ្នូ';
            } elseif ( $month == '01' ) {
                $kh_month = 'មករា';
            } elseif ( $month == '02' ) {
                $kh_month = 'កុម្ភៈ';
            } elseif ( $month == '03' ) {
                $kh_month = 'មីនា';
            } elseif ( $month == '04' ) {
                $kh_month = 'មេសា';
            } elseif ( $month == '05' ) {
                $kh_month = 'ឧសភា';
            } elseif ( $month == '06' ) {
                $kh_month = 'មិថុនា';
            } elseif ( $month == '07' ) {
                $kh_month = 'កក្កដា';
            } elseif ( $month == '08' ) {
                $kh_month = 'សីហា';
            } elseif ( $month == '09' ) {
                $kh_month = 'កញ្ញា';
            } elseif ( $month == '10' ) {
                $kh_month = 'តុលា';
            } elseif ( $month == '11' ) {
                $kh_month = 'វិច្ឆិកា';
            } elseif ( $month == '12' ) {
                $kh_month = 'ធ្នូ';
            } elseif ( $month == '០១' ) {
                $kh_month = 'មករា';
            } elseif ( $month == '០២' ) {
                $kh_month = 'កុម្ភៈ';
            } elseif ( $month == '០៣' ) {
                $kh_month = 'មីនា';
            } elseif ( $month == '០៤' ) {
                $kh_month = 'មេសា';
            } elseif ( $month == '០៥' ) {
                $kh_month = 'ឧសភា';
            } elseif ( $month == '០៦' ) {
                $kh_month = 'មិថុនា';
            } elseif ( $month == '០៧' ) {
                $kh_month = 'កក្កដា';
            } elseif ( $month == '០៨' ) {
                $kh_month = 'សីហា';
            } elseif ( $month == '០៩' ) {
                $kh_month = 'កញ្ញា';
            } elseif ( $month == '១០' ) {
                $kh_month = 'តុលា';
            } elseif ( $month == '១១' ) {
                $kh_month = 'វិច្ឆិកា';
            } elseif ( $month == '១២' ) {
                $kh_month = 'ធ្នូ';
            }

            if ( isset( $kh_month ) ) {
                $month = $kh_month;
            }
        }

        return $month;
    }

    function convert_to_kh_number( $number )
    {
        if ( ictcamp_localize_manager()->get_current_language() == 'km' ) {
            $conbine_num = '';
            $split_num = str_split( $number );
            
            foreach ( $split_num as $num ) {
                if ( $num == '0' ) {
                    $kh_num = '០';
                } elseif ( $num == '1' ) {
                    $kh_num = '១';
                } elseif ( $num == '2' ) {
                    $kh_num = '២';
                } elseif ( $num == '3' ) {
                    $kh_num = '៣';
                } elseif ( $num == '4' ) {
                    $kh_num = '៤';
                } elseif ( $num == '5' ) {
                    $kh_num = '៥';
                } elseif ( $num == '6' ) {
                    $kh_num = '៦';
                } elseif ( $num == '7' ) {
                    $kh_num = '៧';
                } elseif ( $num == '8' ) {
                    $kh_num = '៨';
                } elseif ( $num == '9' ) {
                    $kh_num = '៩';
                } else {
                    $kh_num = $num;
                }

                $conbine_num .= $kh_num;
            }

            return $conbine_num;
        } else {
            return $number;
        }
    }

    function remove_language_code_from_url( $url )
    {
        $lang_code = substr( $url, 0, 4);
        if ( $lang_code == "/km/"
            || $lang_code == "/th/"
            || $lang_code == "/vi/"
            || $lang_code == "/my/"
            || $lang_code == "/la/" )
        {
            $url = substr($url,3);
        }

        return $url;
    }
}

$GLOBALS['ictcamp_localize_manager'] = new ICTCamp_Localize_Manager();

function ictcamp_localize_manager() 
{
    return $GLOBALS['ictcamp_localize_manager'];
}
