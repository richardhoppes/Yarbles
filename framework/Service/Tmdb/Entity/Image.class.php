<?php

class Service_Tmdb_Entity_Image {

    protected $strType;
    protected $intSize;
    protected $intHeight;
    protected $intWidth;
    protected $strUrl;
    protected $strId;

    public function setHeight($height) {
        $this->intHeight = (int) $height;
    }

    public function getHeight() {
        return $this->intHeight;
    }

    public function setId($id) {
        $this->strId = (string) $id;
    }

    public function getId() {
        return $this->strId;
    }

    public function setSize($size) {
        $this->intSize = (string) $size;
    }

    public function getSize() {
        return $this->intSize;
    }

    public function setType($type) {
        $this->strType = (string) $type;
    }

    public function getType() {
        return $this->strType;
    }

    public function setUrl($url) {
        $this->strUrl = (string) $url;
    }

    public function getUrl() {
        return $this->strUrl;
    }

    public function setWidth($width) {
        $this->intWidth = (int) $width;
    }

    public function getWidth() {
        return $this->intWidth;
    }
}