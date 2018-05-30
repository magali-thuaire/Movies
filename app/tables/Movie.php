<?php
namespace App\tables;


class Movie {

    private $id;
    private $title;
    private $actors;
    private $director;
    private $producer;
    private $language;
    private $year_of_prod;
    private $category;
    private $storyline;
    private $video;


    //------------------------------
    // Getters
    // ------------------------------

    // Récupère le titre d'un film
    public function getTitle() {
      return $this->title;
    }
    // Récupère les acteurs d'un film
    public function getActors() {
      return $this->actors;
    }
    // Récupère le réalisateur d'un film
    public function getDirector() {
      return $this->director;
    }
    // Récupère le producteur d'un film
    public function getProducer() {
      return $this->producer;
    }
    // Récupère l'année de production d'un film
    public function getYear() {
      return $this->year_of_prod;
    }
    // Récupère la langue d'un film
    public function getLanguage() {
      return $this->language;
    }
    // Récupère la catégorie d'un film
    public function getCategory() {
      return $this->category;
    }
    // Récupère le synopsis d'un film
    public function getStoryline() {
      return $this->storyline;
    }
    // Récupère l'url de la vidéo du film
    public function getVideo() {
      return $this->video;
    }

    //------------------------------
    // Setters
    // ------------------------------

    // Définit le titre d'un film
    public function setTitle($title) {
      $this->title = $title;
      return $this;
    }
    // Définit les acteurs d'un film
    public function setActors($actors) {
      $this->actors = $actors;
      return $this;
    }
    // Définit le réalisateur d'un film
    public function setDirector($director) {
      $this->director = $director;
      return $this;
    }
    // Définit le producteur d'un film
    public function setProducer( $producer) {
      $this->producer = $producer;
      return $this;
    }
    // Définit l'année de production d'un film
    public function setYear($year_of_prod) {
      $this->year_of_prod = $year_of_prod;
      return $this;
    }
    // Définit la langue d'un film
    public function setLanguage($language) {
      $this->language = $language;
      return $this;
    }
    // Définit la catégorie d'un film
    public function setCategory($category) {
      $this->category = $category;
      return $this;
    }
    // Définit le synopsis d'un film
    public function setStoryline($storyline) {
      $this->storyline = $storyline;
      return $this;
    }
    // Définit l'url de la vidéo du film
    public function setVideo($video) {
      $this->video = $video;
      return $this;
    }


    //------------------------------
    // Méthodes
    // ------------------------------

    // Récupère l'url d'un film
    private function getUrl($page) {
        $url = '../public/index?p=' . $page . '_film' . '&id=' . $this->id;
        return $url;
    }

    // Récupère le bouton voir du film
    public function btn_voir() {
        $url = $this->getUrl('voir');
        return '<a href="'. $url . '" class="btn btn-mdb-color btn-sm">Plus d\'infos</a>';
    }

}
