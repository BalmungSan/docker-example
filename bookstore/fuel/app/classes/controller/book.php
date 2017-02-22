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
   * The Book Controller.
   *
   * This controller is in charge of all book actions
   *
   * @package  app
   * @extends  Controller
   */
  class Controller_Book extends Controller {
	/**
     * Book registration page
     * @access  public
     * @return  Response
     */
	public function action_create() {
	  if(!$user = Session::get('userInfo')){
        echo '<script>alert("Please log in first");</script>';
        Response::redirect('/', 'refresh');
      }

	  $view = View::forge('book/create');
      $view->data = array('categories' => BookModel::getCategories());
	  return $view;
	}
	
	/**
     * Register a new book in the database
     * @access  post
     * @return  Response
     */
	public function post_create() {
	  //config for files
	  $config = array(
        'path' => 'books/',
        'change_case' => 'lower',
        'normalize' => true,
        'auto_process' => true,
        'normalize_separator' => '-',
        'ext_whitelist' => array('pdf'),
      );
      Upload::process($config);

      //check if there are valid files
      if(Upload::is_valid()){
	    //save them according to the config
	    Upload::save();

	    //grab the file name of the preview
	    $preview = Upload::get_files()[0]['saved_as'];
      }

	  //set the book data
	  $user = Session::get('userInfo');
	  $book = new BookDTO();
	  $book->setUser($user->getId());
	  $book->setName(Input::post('namenewbook'));
	  $book->setAuthor(Input::post('authornewbook'));
	  $book->setIsNew(Input::post('isNew'));
	  $book->setCategory(Input::post('categorynewbook'));
	  $book->setPrice(Input::post('pricenewbook'));
	  $book->setPreview($preview);
	  $book->setUnits(Input::post('unitsnewbook'));
	  
	  //try to save the book
	  if (BookModel::registerBook($book) == 1) {
	    //if works, tell the user the add book worked
	    echo '<script>alert("New Book added");</script>';
	    Response::redirect('profile', 'refresh');
	  } else {
		//if not print an error message
		echo '<script language="javascript">';
        echo 'alert("Sorry, there was a problem. Please try again later")';
        echo '</script>';
        Response::redirect('/book/create', 'refresh');
	  }
	}

    /**
     * Edit a book page
     * @access  public
     * @return  Response
     */
	public function action_edit($bookId = null) {
	  //if no book id passed, return
	  is_null($bookId) and Response::redirect('/', 'location');

	  //paint the edit view
	  $book = BookModel::getBook($bookId)->toArray();
	  $view = View::forge('book/edit');
	  $view->data = array('categories' => BookModel::getCategories(), 'book' => $book);
	  return $view;
	}

    /**
     * Save the book changes in the database
     * @access  post
     * @return  Response
     */
	public function post_edit($bookId = null) {
	  //if no book id passed, return
	  is_null($bookId) and Response::redirect('/', 'location');

	  //config for files
	  $config = array(
        'path' => 'books/',
        'change_case' => 'lower',
        'normalize' => true,
        'auto_process' => true,
        'normalize_separator' => '-',
        'ext_whitelist' => array('pdf'),
      );
      Upload::process($config);

      //check if there are valid files
      if(Upload::is_valid()){
	    //save them according to the config
	    Upload::save();

	    //grab the file name of the preview
	    $preview = Upload::get_files()[0]['saved_as'];
      }

      //delete the old preview
      $book = BookModel::getBook($bookId);
      File::delete("books/".$book->getPreview());

	  //set the book data
	  $book->setName(Input::post('namenewbook'));
	  $book->setAuthor(Input::post('authornewbook'));
	  $book->setIsNew(Input::post('isNew'));
	  $book->setCategory(Input::post('categorynewbook'));
	  $book->setPrice(Input::post('pricenewbook'));
	  $book->setPreview($preview);
	  $book->setUnits(Input::post('unitsnewbook'));
	  
	  //try to update the book
	  try {
		BookModel::updateBook($book);
	    //if works tell the user the edit book worked
	    echo '<script>alert("Book edited");</script>';
	    Response::redirect('profile', 'refresh');
	  }catch(Exception $e){
		//if not print an error message
		echo '<script>alert("Sorry, there was a problem. Please try again later");</script>';
        Response::redirect('/book/edit', 'refresh');
	  }
	}

    /**
     * Delete a book from the database
     * @access  public
     * @return  Response
     */	
	public function action_delete($bookId = null) {
	  //if no book id passed, return
	  is_null($bookId) and Response::redirect('/', 'location');

	  //delete the preview
	  $book = BookModel::getBook($bookId);
	  File::delete("books/".$book->getPreview());

	  //delete the book from the data base
	  $result = BookModel::deleteBook($bookId);

	  //reload the profile view
	  Response::redirect('profile');
	}

	/**
     * List of searched books page
     * @access  public
     * @return  Response
     */
	public function action_list() {
	  $books = Session::get('booksArray');
	  $view = View::forge("book/list");
	  $view->books = $books;
	  return $view;
	}

	/**
     * Buy a book
	 * @note not implemented yet, print an error message
     * @access  public
     * @return  Response
     */
	public function action_buy($bookId = null) {
	  //if no book id passed, return
	  is_null($bookId) and Response::redirect('/', 'location');

	  //Print an error message an return to list
	  echo '<script>alert("Sorry, this feature has not been implemented");</script>';
      Response::redirect('book/list', 'refresh');
	}

	/**
     * Return to the book list page 
     * @access  public
     * @return  Response
     */
	public function action_back() {
	  Response::redirect('book/list', 'refresh');
	}
  }
?>