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
   * Represent an user (one record from mysql table 'users')
   * This class is a POPO (Plain Old PHP Object)
   * @Author Luis Miguel Mejía Suárez (BalmungSan)
   */
  class UserDTO {
    //data
    private $id;
    private $email;
    private $name;
    private $city;
    private $address;

    /**
     * Fill all fields of this UserDTO
     * @param data an array with all the data for the user
     * @return this
     */
    public function fill($data) {
      $this->id         = $data[0];
      $this->email      = $data[1];
      $this->name       = $data[2];
      $this->city       = $data[3];
      $this->address    = $data[4];
      return $this;
    }

    //getters and setters
    public function getId() {
      return $this->id;
    }

    public function setId($id) {
      $this->id = $id;
    }

    public function getEmail() {
      return $this->email;
    }

    public function setEmail($email) {
      $this->email = $email;
    }

    public function setName($name) {
      $this->name = $name;
    }
	
	public function getName() {
      return $this->name;
    }

    public function getCity() {
      return $this->city;
    }

    public function setCity($city) {
      $this->city = $city;
    }

    public function getAddress() {
      return $this->address;
    }

    public function setAddress($address) {
      $this->address = $address;
    }

    /**
     * Transform this user to an array
     * @return an array with all the data of this user
     */
    public function toArray() {
      return array(
        'id' => $this->id,
        'email' => $this->email,
        'name' => $this->name,
        'city' => $this->city,
        'address' => $this->address
      );
    }
  }
?>