<?php

	require "controller.php";

	class api extends controller
	{

		private $view = "json";

		public function index() {}

		/*
		 * API Method /get_reason/$id
		 * Стандартный формат - [length, values]
		 * @return /get_reason <- Вернёт массив со всеми элемнетами в стандартном формате
		 * @return /get_reason/$id <- Вернёт конкретный элемент из массива в стандартном формате
		 * @return /get_reason?rand <- Вернёт рандомный элемент из массива  в стандартном формате
		 *  */
		public function get_reason($id = -1) {
			$modelReasons = self::model("storage", "reasons");

			if ($id >= 0) {
				$prepareData = [
					"length" => $modelReasons -> length,
					"values" => $modelReasons -> getItem($id),
				];
			} else
			if ($_GET && isset($_GET["rand"])) {
				$rand = rand(0, $modelReasons -> length - 1);
				$prepareData = [
					"length" => $modelReasons -> length,
					"values" => $modelReasons -> getItem($rand),
				];
			} else {
				$prepareData = [
					"length" => $modelReasons -> length,
					"values" => $modelReasons -> getAll(),
				];
			}

			self::view($this -> view, [
				"array" => $prepareData,
			]);
		}

		/*
		 * API Method /set_reason
		 * ?text= -> Текст сообщения, которое нужно добавить
		 * @return <- Статус работы
		 * !-> Нельзя отправить пустое сообщение
		 * !-> Одно и то же сообщение нельзя отправить несколько раз.
		 * */
		public function set_reason() {
			$modelReasons = self::model("storage", "reasons");
			if ($_GET && $_GET["text"]) {
				if (md5($_GET["text"]) !== md5($modelReasons -> getLast()[0])) {
					$modelReasons -> setItem($_GET["text"]);
					self::view($this -> view, [
						"array" => [
							"status" => "200",
							"text" => "success",
						],
					]);
				}
				self::view($this -> view, [
					"array" => [
						"status" => "300",
						"text" => "error",
					],
				]);
			}
		}
	}