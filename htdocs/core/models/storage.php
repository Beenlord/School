<?php

	require "model.php";

	class storage extends model
	{

		private $filename = "data";
		private $data = [];
		public $length = 0;

		public function __construct($filename) {
			$this -> filename = $filename;
			$this -> loadFile();
			$this -> length = count($this -> data);
		}

		public function getAll() {
			return $this -> data;
		}

		public function getItem($id) {
			return [$this -> data[$id]];
		}

		public function getLast() {
			return [$this -> data[$this -> length - 1]];
		}

		public function getRandom() {
			return $this -> data[rand(0, $this -> length - 1)];
		}

		public function setItem($text) {
			$this -> data[] = $text;
			$this -> writeFile();
		}

		private function loadFile() {
			$data = file_get_contents(F_STORE . DS . $this -> filename . JSON);
			if ($data) {
				$this->data = json_decode($data);
			} else {
				$this -> writeFile();
			}
		}

		private function writeFile() {
			file_put_contents(F_STORE . DS . $this -> filename . JSON, json_encode($this -> data, true));
		}
	}