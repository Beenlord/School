<?php

	namespace core\controllers;

	use core\models\PageModel as Page;

	class PageController extends Controller
	{
		public function _index()
		{
			$page = new Page();
			$page -> render();
		}
	}