<?php
  /**
   * Copyright 2017 Luis Miguel Mejía Suárez (BalmungSan)
   *
   * Licensed under the Apache License, Version 2.0 (the "License");
   * you may not use this file except in compliance with the License.
   * You may obtain a copy of the License at
   *
   *  http://www.apache.org/licenses/LICENSE-2.0
   *
   * Unless required by applicable law or agreed to in writing, software
   * distributed under the License is distributed on an "AS IS" BASIS,
   * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
   * See the License for the specific language governing permissions and
   * limitations under the License.
   */

  //This class exists in the Model namespace
  namespace Model;

  /**
   * Represent a book (one record from mysql table 'books')
   * This class is a POPO (Plain Old PHP Object)
   * @Author Luis Miguel Mejía Suárez (BalmungSan)
   */
  class BookDTO {
    //data
    private $id;        //0
    private $user;      //1
    private $name;      //2
    private $author;    //3
    private $isNew;     //4
    private $category;  //5
    private $price;     //6
    private $preview;   //7
    private $units;  //8

    /**
     * Fill all fields of this BookDTO
     * @param data an array with all the data for the book
     * @return this
     */
    public function fill($data) {
      $this->id        = $data[0];
      $this->user      = $data[1];
      $this->name      = $data[2];
      $this->author    = $data[3];
      $this->isNew     = $data[4];
      $this->category  = $data[5];
      $this->price     = $data[6];
      $this->preview   = $data[7];
      $this->units     = $data[8];
      return $this;
    }

    //getters and setters
    public function getId() {
      return $this->id;
    }

    public function setId($id) {
      $this->id = $id;
    }

    public function getUser() {
      return $this->user;
    }

    public function setUser($user) {
      $this->user = $user;
    }

    public function getName() {
      return $this->name;
    }

    public function setName($name) {
      $this->name = $name;
    }

    public function getAuthor() {
      return $this->author;
    }

    public function setAuthor($author) {
      $this->author = $author;
    }

    public function getIsNew() {
      return $this->isNew;
    }

    public function setIsNew($isNew) {
      $this->isNew = $isNew;
    }

    public function getCategory() {
      return $this->category;
    }

    public function setCategory($category) {
      $this->category = $category;
    }

    public function getPrice() {
      return $this->price;
    }

    public function setPrice($price) {
      $this->price = $price;
    }

    public function getPreview() {
      return $this->preview;
    }

    public function setPreview($preview) {
      $this->preview = $preview;
    }

    public function getUnits() {
      return $this->units;
    }

    public function setUnits($units) {
      $this->units = $units;
    }

    /**
     * Transforms this book to an array
     * @return an array with all the data of this book
     */
    public function toArray() {
      return array(
        'id' => $this->id,
        'user' => $this->user,
        'name' => $this->name,
        'author' => $this->author,
        'isNew' => $this->isNew,
        'category' => $this->category,
        'price' => $this->price,
        'preview' => $this->preview,
        'units' => $this->units,
      );
    }
  }
?>