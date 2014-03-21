<?php

if(isset($_POST['source_code'])) {
	$code = new Code($_POST['source_code']);
	$editedCode = &$code->getEditedCode();
}

?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru">
<head>
	<meta charset="utf-8">
</head>
<body>
	<form method="POST">
		<input type='Submit' /><br>
		<textarea name="source_code" style="width:99%;" rows="10"><?php if(isset($_POST['source_code'])) echo $_POST['source_code']; ?></textarea><br>
		<textarea style="width:99%;" rows="40"><?php if($editedCode) echo $editedCode; ?></textarea>
	</form>
</body>
</html><?php

class Code {
	public $sourceCode;
	protected $editedCode = '';

	protected $notNeedNewLine = array( //TODO to for or strin ...
	);

	protected $notNeedChars = array(
							"\r",
							"\n",
	);

	protected $tabs = '';

	public function __construct(& $sourceCode) {
		$this->sourceCode = &$sourceCode;
	}

	public function getEditedCode() {
		if($this->editedCode)
			return $this->editedCode;

		$this->unMinifyCode();
		return $this->editedCode;
	}

	protected function unMinifyCode() {
		$sCode =& $this->sourceCode;
		$eCode =& $this->editedCode;

		$this->isFor = false;
		$isString = false;

		for($length=strlen($sCode),$i=0;$i<$length;$i++) {
			if(array_search($sCode[$i], $this->notNeedChars) !== false) {
				continue;
			}
			$this->prepend($sCode, $i);
			$eCode.= $sCode[$i];
			$this->append($sCode, $i);
		}
	}

	protected function tabs($sign, $count=1) {
		if($sign === '+') {
			$this->tabs.= "\t";
		}
		if($sign === '-') {
			$this->tabs = substr($this->tabs, 0, -1);
		}
	}

	protected function prepend($sCode, $i) {
		if($sCode[$i] == '}'){
			$this->tabs('-');
			$this->addNewLine();
		}
	}

	protected function append($sCode, $i) {
		if(($sCode[$i]==';' && !$isFor) || $sCode[$i]=='}') {
			$this->addNewLine();
		}
		if($sCode[$i]=='{') {
			$this->tabs('+');
			$this->addNewLine();
		}
	}

	protected function addNewLine() {
		$this->editedCode.= "\n".$this->tabs;
	}
}
