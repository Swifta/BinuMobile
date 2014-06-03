<?php

/**
 * The app listing on the index page, data is hardcoded in this file
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class App_list_model extends CI_Model {

    public function __construct() {
        
    }

    /**
     * Get the menu
     */
    public function get_list() {

        $listing = array(
            'Total MATS' => 'http://swifta.co/matsapp/',
            'Hello World' => 'http://swifta.co/binutraining/helloworld/hello_world.xml',
            'Hello Galaxy' => 'http://swifta.co/binutraining/helloworld/hello_galaxy.xml',
            'Hello Solar System' => 'http://swifta.co/binutraining/helloworld/hello_solar_system.xml',
            'New Form' => 'http://swifta.co/binutraining/framework/index.php/nav/new_form/',
            'Image Page' => 'http://swifta.co/binutraining/framework/index.php/nav/new_image/',
            'Cookie Details' => 'http://swifta.co/binutraining/framework/index.php/nav/displaycookies/'
        );

        return($listing);
    }

    public function cookie_details() {
        $listing = array();
        $listing_val = array();
        foreach ($_COOKIE as $name => $val) {
            //  $name .' => '.$value;
            /*       $listing_val['label'] = $name;
              $listing_val['url'] = $value;
              $listing[] = $listing_val;
              }
              return($listing_val); */
            $listing[$name . '=>' . $val] = 'http://swifta.com';
        }
        return $listing;
    }

    /**
     * Get the form test list
     */
    public function get_ft_list() {

        $listing = array(
            'Text' => '/apps/dev_apps/index.php/nav/form_page/text/',
            'Numeric' => '/apps/dev_apps/index.php/nav/form_page/numeric/',
            'Decimal' => '/apps/dev_apps/index.php/nav/form_page/decimal/',
            'Phone' => '/apps/dev_apps/index.php/nav/form_page/phone/',
            'Email' => '/apps/dev_apps/index.php/nav/form_page/email/',
            'Date' => '/apps/dev_apps/index.php/nav/form_page/date/',
            'Time' => '/apps/dev_apps/index.php/nav/form_page/time/',
            'Date Time' => '/apps/dev_apps/index.php/nav/form_page/dateTime/',
        );

        return($listing);
    }

    /**
     * Get the text for the text page example
     */
    public function get_text() {
        $text = <<<EOT
They called him Frost. Of all things created of Solcom, Frost was the finest, the mightiest, the most difficult to understand. This is why he bore a name, and why he was given dominion over half the Earth.

On the day of Frost's createion, Solcom had suffered a discontinuity of complementary functions, best described as madness.  This was brought on by an unprecedented solar flareup which lasted for a little over thirty-six hous. It occurred during a vital phase of circuit-structuring, and when it was finished so was Frost. Solcom was then in the unique position of having created a unique being duing a period of temporary amnesia.

And Solcom was not cetain that Frost was the product originally desired. The initial design had called for a machine to be situated on the surface of the planet Earth, to function as a relay station and coordinating agent for activities in the notrhern hemisphere. Solcom tested the machine to this end, and all of its responses were perfect. Yet there was somethig different about Frost, something which led Solcom to dignify him with a name and a personal pronoun. This, in itself, was an almost unheard of occurrence.  The molecular circuits had already been sealed, though, and could not be aalyzed without being destroyed in the process.  Frost represented too great an investment of Solcom's time, energy, and materials to be dismantled because of an intangible, especially when he functioned perfectly. Theefore, Solcom's strangest creation was given dominion over half the Earth, ad they called him, unimaginatively, Frost.
EOT;

        return($text);
    }

    /**
     * Get custom data for the custom page
     */
    public function get_custom() {

        $listing = array(
        );

        return($listing);
    }

}
