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

  //Import the DB class
  use DB;

  /**
   * Represent the users table
   * This class is a Model
   * @Author Luis Miguel Mejía Suárez (BalmungSan)
   */
  class UserModel extends \Model {
    /**
     * Get an user
     * @param email the email of the user
     * @param password the password of the user (not encrypted)
     * @return an UserDTO with all the data if the credential are correct, if not return null
     * @note this function encrypts the password using and md5 hash
     * @see UserDTO
     */
    public static function getUser($email, $password) {
      //encrypt the password
      $pass = md5($password);

      //get the user
      $result = DB::select('*')->from('users')->where('email', '=', $email)->where('password', '=', $pass)->execute();

      //check if the user doesn't exists
      if (count($result) == 0) {
        return null;
      }

      //get the city name
      $city = DB::select('city')->from('cities')->where('city_id', '=', $result->get('city_id'))->execute();

      //create the user
      $user = new UserDTO();
      $user->setId($result->get('user_id'));
      $user->setEmail($result->get('email'));
      $user->setName($result->get('real_name'));
      $user->setAddress($result->get('address'));
      $user->setCity($city->get('city'));

      return $user;
    }

    /**
     * Create a new user in the database
     * @param user an UserDTO with all the data of the user
     * @param password the password for the new user
     * @return 1 on success 0 on failure
     * @note this function encrypts the password using and md5 hash
     * @note this function sets the id for the new user if succeed
     * @see UserDTO
     */
    public static function registerUser($user, $password) {
      //encrypt the password
      $pass = md5($password);

      //get the city id of the user's city
      $city = DB::select('city_id')->from('cities')->where('city', '=', $user->getCity())->execute();

      //prepare the columns an values
      $colums = array(
        "email",
        "password",
        "name",
        "city_id",
        "address"
      );
      $values = array(
        $user->getEmail(),
        $pass,
        $user->getName(),
        $city->get('city_id'),
        $user->getAddress()
      );

      //insert the user
      $result = DB::insert('users')->columns($colums)->values($values)->execute();

      //check if the insert succeed
      if ($result[1] == 1) {
        $user->setId($result[0]);
        return 1;
      } else {
        return 0;
      }
    }

    /**
     * Drop an user from the database
     * @param user the id of the user to delete
     * @param password the password of the user to delete, for security
     * @return 1 on success 0 on failure
     * @note this function encrypts the password using and md5 hash
     */
    public function deleteUser($user, $password) {
      //encrypt the password
      $pass = md5($password);

      //delete the user
      return DB::delete('users')->where('user_id', '=', $user)->where('password', '=', $pass)->execute();
    }

    /**
     * Change the password of an user
     * @param user the id of the user
     * @param password the new password
     * @return 1 on success 0 on failure
     * @note this function encrypts the password using and md5 hash
     * @see UserDTO
     */
    public static function changePassword($user, $password) {
      //encrypt the password
      $pass = md5($password);

      //update the password
      return DB::update('users')->value('password', $pass)->where('user_id', '=', $user)->execute();
    }

    /**
     * Update an user data
     * @param user an UserDTO with the id of the user to update and the modified data
     * @return 1 if at least one field is changed, else 0
     * @see UserDTO
     */
    public static function updateUser($user) {
      //get the city_id of the user's city
      $city = DB::select('city_id')->from('cities')->where('city', '=', $user->getCity())->execute();

      //prepare the columns an values
      $set = array(
        'city_id' => $city->get('city_id'),
        'real_name' => $user->getName(),
        'address' => $user->getAddress()
      );

      //update the data
      return DB::update('users')->set($set)->where('user_id', '=', $user->getId())->execute();
    }

    /**
     * Get all cities saved in the database
     * @return an array with the cities
     */
    public static function getCities() {
      $result = DB::select('city')->from('cities')->execute();
      $cities = array();
      foreach ($result as $r) $cities[] = $r['city'];
      return $cities;
    }
  }
?>