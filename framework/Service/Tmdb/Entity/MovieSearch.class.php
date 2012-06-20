<?php

class Service_Tmdb_Entity_MovieSearch extends Service_Tmdb_Entity_Movie {

    protected $boolAdult;
    protected $intScore;

    public function setAdult($adult) {
        $this->boolAdult = $adult ? 1 : 0;
    }

    public function getAdult() {
        return $this->boolAdult;
    }

    public function setScore($score) {
        $this->intScore = (int) $score;
    }

    public function getScore() {
        return $this->intScore;
    }
}