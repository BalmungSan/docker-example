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
   * Represent the books table
   * This class is a Model
   * @Author Luis Miguel Mejía Suárez (BalmungSan)
   */
  class BookModel extends \Model {
    /**
     * Get a Book
     * @param bookid the id of the book to get
     * @return a BoookDTO with all the data of the book
     * @see BookDTO
     */
    public static function getBook($bookid) {
      //get the data of the book
      $data = DB::select()->from('books')->join('categories')->on('books.category_id', '=', 'categories.category_id')->where('book_id', '=', $bookid)->execute();

      //save the data in new bookDTO
      $book = new BookDTO();
      $book->setId($data->get('book_id'));
      $book->setUser($data->get('user_id'));
      $book->setName($data->get('name'));
      $book->setAuthor($data->get('author'));
      $book->setIsNew($data->get('is_new'));
      $book->setCategory($data->get('category'));
      $book->setPrice($data->get('price'));
      $book->setPreview($data->get('preview'));
      $book->setUnits($data->get('units'));

      return $book;
    }

    /**
     * Create a new book in the database
     * @param book a BookDTO with all the data of the book
     * @return 1 on success 0 on failure
     * @note this function sets the id for the new book if succeed
     * @see BookDTO
     */
    public static function registerBook($book) {
      //get the category id for the book's category
      $category = DB::select('category_id')->from('categories')->where('category', '=', $book->getCategory())->execute();

      //prepare the columns an values
      $colums = array(
        'user_id',
        'name',
        'author',
        'is_new',
        'category_id',
        'price',
		'preview',
		'units'
      );

      $values = array(
        $book->getUser(),
        $book->getName(),
        $book->getAuthor(),
        $book->getIsNew(),
        $category->get('category_id'),
        $book->getPrice(),
        $book->getPreview(),
        $book->getUnits()
      );


      //insert the book
      $result = DB::insert('books')->columns($colums)->values($values)->execute();

      //check if the insert succeed
      if ($result[1] == 1) {
        $book->setId($result[0]);
        return 1;
      } else {
        return 0;
      }
    }

    /**
     * Update a book data
     * @param book a BookDTO with the id of the book to update and the modified data
     * @return 1 if at least one field is changed, else 0
     * @see BookDTO
     */
    public static function updateBook($book) {
      //get the category id for the book's category
      $category = DB::select('category_id')->from('categories')->where('category', '=', $book->getCategory())->execute();

      //prepare the columns an values
      $set = array(
        'name' => $book->getName(),
        'author' => $book->getAuthor(),
        'is_new' => $book->getIsNew(),
        'category_id' => $category->get('category_id'),
        'price' => $book->getPrice(),
        'preview' => $book->getPreview(),
        'units' => $book->getUnits()
      );

      //update the data
      return DB::update('books')->set($set)->where('book_id', '=', $book->getId())->execute();
    }

    /**
     * Drop a book from the database
     * @param book the id of the book to delete
     * @return 1 on success 0 on failure
     */
    public static function deleteBook($book) {
      //delete the book
      return DB::delete('books')->where('book_id', '=', $book)->execute();
    }

    /**
     * Transform a result set into a collection of Books
     * @param array the result set as an array of arrays
     * @return an array of BookDTO
     * @see BookDTO
     */
    private static function toBooks($array) {
      $books = array();
      foreach ($array as $book) {
        $data    = array();
        $data[]  = $book['book_id'];
        $data[]  = $book['user_id'];
        $data[]  = $book['name'];
        $data[]  = $book['author'];
		$data[]  = $book['is_new'];
        $data[]  = $book['category'];
        $data[]  = $book['price'];
        $data[]  = $book['preview'];
        $data[]  = $book['units'];
        $books[] = (new BookDTO())->fill($data);
      }

      return $books;
    }

    /**
     * Get all books of a user
     * @param user the id of the user
     * @return an array of BookDTO with all books
     * @see BookDTO
     * @see self::toBooks
     */
    public static function getBooksByUser($user) {
      return self::toBooks(DB::select()->from('books')->join('categories')->on('books.category_id', '=', 'categories.category_id')->where('user_id', '=', $user)->execute());
    }

    /**
     * Get all books in the database
     * @return an array of BookDTO
     * @see BookDTO
     * @see self::toBooks
     */
    public static function getAll() {
      return self::toBooks(DB::select()->from('books')->join('categories')->on('books.category_id', '=', 'categories.category_id')->execute());
    }

    /**
     * Search books by category
     * @param category the category to search for
     * @return an array of books that conform to the search
     * @see BookDTO
     * @see self::toBooks
     */
    public static function searchByCategory($category) {
      //get the category id
      $categoryid = DB::select('category_id')->from('categories')->where('category', '=', $category)->execute()->get('category_id');

      //get all books with that category
      $result = DB::select()->from('books')->join('categories')->on('books.category_id', '=', 'categories.category_id')->where('books.category_id', '=', $categoryid)->execute();

      //transform the result set into an array of BookDTO
      return self::toBooks($result);
    }

    /**
     * Search books by name
     * @param name the pattern to search for in names
     * @return an array of books that conform to the search
     * @see BookDTO
     * @see self::toBooks
     */
    public static function searchByName($name) {
      //prepare the pattern
      $pattern = '%' . str_replace(' ', '%', $name) . '%';

      //get all books with that pattern in their names
      $result = DB::select()->from('books')->join('categories')->on('books.category_id', '=', 'categories.category_id')->where('name', 'like', $pattern)->execute();

      //transform the result set into an array of BookDTO
      return self::toBooks($result);
    }

    /**
     * Search books by author
     * @param author the pattern to search for in author
     * @return an array of books that conform to the search
     * @see BookDTO
     * @see self::toBooks
     */
    public static function searchByAuthor($author) {
      //prepare the pattern
      $pattern = '%' . str_replace(' ', '%', $author) . '%';

      //get all books with that pattern in their author
      $result = DB::select()->from('books')->join('categories')->on('books.category_id', '=', 'categories.category_id')->where('author', 'like', $pattern)->execute();

      //transform the result set into an array of BookDTO
      return self::toBooks($result);
    }

    /**
     * Search books by price
     * @param lower the minimum price (0 means any)
     * @param upper the maximun price (0 means any)
     * @return an array of books that conform to the search
     * @see BookDTO
     * @see self::toBooks
     */
    public static function searchByPrice($lower, $upper) {
      //prepare the query
      $query = DB::select()->from('books')->join('categories')->on('books.category_id', '=', 'categories.category_id');

      //add the lower bound
      if ($lower > 0) $query = $query->where('price', '>=', $lower);

      //add the upper bound
      if ($upper > 0 && $upper >= $lower) $query = $query->where('price', '<=', $upper);

      //get the books
      $result = $query->execute();

      //transform the result set into an array of BookDTO
      return self::toBooks($result);
    }

    /**
     * Get all categories saved in the database
     * @return an array with the categories
     */
    public static function getCategories() {
      $result = DB::select('category')->from('categories')->execute();
      $categories = array();
      foreach ($result as $r) $categories[] = $r['category'];
      return $categories;
    }
  }
?>