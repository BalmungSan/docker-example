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

  //Imports
  use \Model\BookModel;
  use \Model\BookDTO;

  /**
   * The Profile Controller.
   *
   * The main page of the application
   *
   * @package  app
   * @extends  Controller
   */
  class Controller_Profile extends Controller {
    /**
     * The profile page
     * @access  public
     * @return  Response
     */
    public function action_index () {
	  //check if the user is logged
      if(!$user = Session::get('userInfo')){
        //if not, return to the login page
        echo '<script>alert("You have to Log In first");</script>';
        Response::redirect('/', 'refresh');
      }
		
	  //prepare the profile page
	  $userId = $user->getId();
	  $view = View::forge('profile/profile');
	  $booksDTO = BookModel::getBooksByUser($userId);
	  $books = array_map(function ($b){return $b->toArray();}, $booksDTO);
	  $view->books = $books;
	  $categories = BookModel::getCategories();
      $view->categories = $categories;
      return $view;
    }

	/**
     * The search page
     * @access  post
     * @return  Response
	 */
    public function post_search() {
      $radioButton = Input::post("radioButton");

      if($radioButton == 0){
        $category = Input::post("categorynewbook");
        $resultDTO = BookModel::searchByCategory($category);;
      }else if($radioButton == 1){
        $author = Input::post("author");
        if($author == ""){
          echo '<script>alert("Please fill at least one field");</script>';
            Response::redirect('/', 'refresh');
        }
        $resultDTO = BookModel::searchByAuthor($author);
      }else if($radioButton == 2){
        $name = Input::post("name");
        if($name == ""){
          echo '<script>alert("Please fill at least one field");</script>';
          Response::redirect('/', 'refresh');
        }
        $resultDTO = BookModel::searchByName($name);
      }else if($radioButton == 3){
        $priceL = Input::post("priceL");
        $priceU = Input::post("priceU");
        if($priceL == "" and $priceU == ""){
          echo '<script>alert("Please fill one field");</script>';
          Response::redirect('/', 'refresh');
        }
        $resultDTO = BookModel::searchByPrice($priceL, $priceU);
      }else{
        Response::redirect_back('/', 'refresh');
      }

      $result = array_map(function ($b){$b = $b->toArray(); $b[6] = null; return $b;}, $resultDTO);
      Session::set('booksArray', $result);
      Response::redirect('book/list');
    }

	/**
     * Edit a book
     * @access  post
     * @return  Response
     */
    public function action_editBook($bookId){
	  Response::redirect("book/edit/".$bookId);
	}
	
	/**
     * Delete a book
     * @access  post
     * @return  Response
     */
	public function action_deleteBook($bookId){
	  Response::redirect("book/delete/".$bookId);
	}
	
	/**
     * Logout
     * @access  public
     * @return  Response
     */
    public function action_logOut(){
      Session::destroy();
      Response::redirect('/', 'location');
    }
  }
?>