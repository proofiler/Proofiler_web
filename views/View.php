<?php

class View {
	private $_file;
	private $_title;
	private $_menu;
	private $_userManager;

	public function __construct($anAction) {
		$this->_file = 'views/view'.$anAction.'.php';
	}

	// Generates and displays the view
	public function generate($someData) {
		$content = $this->generateFile($this->_file, $someData);
		if ((isset($_COOKIE[SESSION_NAME]) && !empty($_COOKIE[SESSION_NAME])) && (isset($_SESSION[SESSION_NAME]) && !empty($_SESSION[SESSION_NAME]))) {
			$this->_menu = $this->generateMenu('connectedMenu.php');
		} else {
			$this->_menu = $this->generateMenu('notConnectedMenu.php');
		}

		$view = $this->generateFile('views/template.php', array('title' => $this->_title, 'menu' => $this->_menu, 'content' => $content));

		echo $view;
	}

	// Generates a "view" file and returns the produced result
	private function generateFile($aFile, $someData) {
		if (file_exists($aFile)) {
			extract($someData);
			ob_start();
			require_once($aFile);

			return ob_get_clean();
		} else {
			throw new Exception('File '.$aFile.' not found');
		}
	}

	// Generates the menu file and returns the produced result
	private function generateMenu($aFile) {
		ob_start();
		require_once($aFile);

		return ob_get_clean();
	}
}
