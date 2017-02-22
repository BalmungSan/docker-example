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

  /**
   * The welcome 404 presenter.
   * @package  app
   * @extends  Presenter
   */
  class Presenter_Welcome_404 extends Presenter {
    /**
	 * Prepare the view data, keeping this in here helps clean up
	 * the controller.
	 * @return void
	 */
	public function view() {
	  $messages = array('Aw, crap!', 'Bloody Hell!', 'Uh Oh!', 'Nope, not here.', 'Huh?');
	  $this->title = $messages[array_rand($messages)];
	}
  }
?>