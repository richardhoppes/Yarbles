<?php

class Command_Test extends Command
{
    public function __construct($arrRequest) {

        $objSession = Session::getHandle();
        $objApplicationState = Library_ApplicationState::getHandle();

        if(isset($_REQUEST['search']) && (strlen($_REQUEST['textSearch']) == 0 || strlen($_REQUEST['textSearch']) > 1) && $_REQUEST['search'] == '1')

        $this->command['textSearch'] = null;
        if ( isset($arrRequest['textSearchTop']) && strlen($arrRequest['textSearchTop']) > 0 ) {
            $this->command['textSearch'] = $arrRequest['textSearchTop'];
        } elseif ( isset($arrRequest['textSearch']) && strlen($arrRequest['textSearch']) > 0 ) {
            $this->command['textSearch'] = $arrRequest['textSearch'];
        }

        $this->command['search']                  = (isset($arrRequest['search']) && $arrRequest['search'] == '1') ? true : false;

        $this->command['serviceNetflix']          = isset($arrRequest['serviceNetflix']) ? true : false;
        $this->command['serviceHulu']             = isset($arrRequest['serviceHulu']) ? true : false;
        $this->command['serviceAmazon']           = isset($arrRequest['serviceAmazon']) ? true : false;

        $this->command['genre']                   = isset($arrRequest['genre']) ? $arrRequest['genre'] : null;
        $this->command['subGenre']                = isset($arrRequest['subGenre']) ? $arrRequest['subGenre'] : null;
        $this->command['availability']            = isset($arrRequest['availability']) ? $arrRequest['availability'] : null;

        $this->command['rating']                  = isset($arrRequest['rating']) ? $arrRequest['rating'] : null;
        $this->command['quality']                 = isset($arrRequest['quality']) ? $arrRequest['quality'] : null;
        $this->command['startYear']               = isset($arrRequest['startYear']) ? $arrRequest['startYear'] : null;
        $this->command['endYear']                 = isset($arrRequest['endYear']) ? $arrRequest['endYear'] : null;
        $this->command['mpaaRatingG']             = isset($arrRequest['mpaaRatingG']) ? true : false;
        $this->command['mpaaRatingPG']            = isset($arrRequest['mpaaRatingPG']) ? true : false;
        $this->command['mpaaRatingPG13']          = isset($arrRequest['mpaaRatingPG13']) ? true : false;
        $this->command['mpaaRatingR']             = isset($arrRequest['mpaaRatingR']) ? true : false;
        $this->command['mpaaRatingNC17']          = isset($arrRequest['mpaaRatingNC17']) ? true : false;
        $this->command['mpaaRatingUR']            = isset($arrRequest['mpaaRatingUR']) ? true : false;
        $this->command['mpaaRatingNR']            = isset($arrRequest['mpaaRatingNR']) ? true : false;
        $this->command['televisionRatingTVY']     = isset($arrRequest['televisionRatingTVY']) ? true : false;
        $this->command['televisionRatingTVY7']    = isset($arrRequest['televisionRatingTVY7']) ? true : false;
        $this->command['televisionRatingTVY7FV']  = isset($arrRequest['televisionRatingTVY7FV']) ? true : false;
        $this->command['televisionRatingTVG']     = isset($arrRequest['televisionRatingTVG']) ? true : false;
        $this->command['televisionRatingTVPG']    = isset($arrRequest['televisionRatingTVPG']) ? true : false;
        $this->command['televisionRatingTV14']    = isset($arrRequest['televisionRatingTV14']) ? true : false;
        $this->command['televisionRatingTVMA']    = isset($arrRequest['televisionRatingTVMA']) ? true : false;

        if($objApplicationState->getUser()->getId() && $objApplicationState->isNetflixAuthorized()) {
            $this->command['excludeQueued'] = isset($arrRequest['excludeQueued']) ? true : false;
            $this->command['excludeWatched'] = isset($arrRequest['excludeWatched']) ? true : false;
        } else {
            $this->command['excludeQueued'] = false;
            $this->command['excludeWatched'] = false;
        }

        $this->command['mpaaRatings'] = array();
        if( $this->command['mpaaRatingG'] )
            $this->command['mpaaRatings'][] = 'G';

        if( $this->command['mpaaRatingPG'] )
            $this->command['mpaaRatings'][] = 'PG';

        if( $this->command['mpaaRatingPG13'] )
            $this->command['mpaaRatings'][] = 'PG-13';

        if( $this->command['mpaaRatingR'] )
            $this->command['mpaaRatings'][] = 'R';

        if( $this->command['mpaaRatingNC17'] )
            $this->command['mpaaRatings'][] = 'NC-17';

        if( $this->command['mpaaRatingUR'] )
            $this->command['mpaaRatings'][] = 'UR';

        if( $this->command['mpaaRatingNR'] )
            $this->command['mpaaRatings'][] = 'NR';

        $this->command['televisionRatings'] = array();
        if( $this->command['televisionRatingTVY'] )
            $this->command['mpaaRatings'][] = 'TV-Y';

        if( $this->command['televisionRatingTVY7'] )
            $this->command['mpaaRatings'][] = 'TV-Y7';

        if( $this->command['televisionRatingTVY7FV'] )
            $this->command['mpaaRatings'][] = 'TV-Y7FV';

        if( $this->command['televisionRatingTVG'] )
            $this->command['mpaaRatings'][] = 'TV-G';

        if( $this->command['televisionRatingTVPG'] )
            $this->command['mpaaRatings'][] = 'TV-PG';

        if( $this->command['televisionRatingTV14'] )
            $this->command['mpaaRatings'][] = 'TV-14';

        if( $this->command['televisionRatingTVMA'] )
            $this->command['mpaaRatings'][] = 'TV-MA';

    }

    public function getValidSearch() {
        $boolRetVal = false;
        if ( $this->getSearch() && ($this->getTextSearch() == null || strlen($this->getTextSearch()) > 1) ) {
            $boolRetVal = true;
        }
        return $boolRetVal;
    }

    public function getAllowQueue() {
        $boolRetVal = true;
        if( $this->getAvailability() == "soon2" || $this->getAvailability() == "soon4" ) {
            $boolRetVal = false;
        }
        return $boolRetVal;
    }

}