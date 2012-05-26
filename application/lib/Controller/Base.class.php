<?php

class Controller_Base extends Controller
{
    public function __construct() {
        parent::__construct();
    }

    protected function loadHeader($arrCss = array(), $arrJs = array(), $strPageTitle = null) {

        $arrCss[] = "reset.css";
        $arrCss[] = "screen.css";
        $arrCss[] = "grid.css";

        $arrOrderedJs = array("jquery.js", "common.js", "queue.js", "log.js", "debug.js");
        foreach($arrJs as $strJs) {
            $arrOrderedJs[] = $strJs;
        }

        $this->loadView('Common_Header', array('css'=>$arrCss, 'js'=>$arrOrderedJs, 'pageTitle'=>$strPageTitle));
    }

    protected function loadFooter() {
        $objSession = Session::getHandle();

        $arrRecentlyQueued = Factory_SearchStats::getRecentlyQueued(100000000, 25);
        $arrRecentlyWatched = Factory_SearchStats::getRecentlyWatched(100000000, 25);

        $this->loadView('Common_Footer', array('recentlyQueued'=>$arrRecentlyQueued, 'recentlyWatched'=>$arrRecentlyWatched));
    }
}
