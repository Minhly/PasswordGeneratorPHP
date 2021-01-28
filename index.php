<?php

class PasswordGenerator {
    // Mine arrays til tal, specialtegn, store og små bogstaver
	private $talArray = array( "1", "2","3", "4", "5", "6", "7", "8", "9", "0" );
	private $uppercaseArray = array( "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z" );
	private $lowercaseArray = array( "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z" );
	private $specialArray = array( "!","@","#","?","%","&" );
	
	private $specialchar;
	private $numbers;
	private $uppercase;
	private $lowercase;
	private $password = "";
	
	// Constructor der tager parametrene tal, specialtegn, store og små bogstaver
	function __construct($specialchar, $numbers, $uppercase, $lowercase){
		$this->set_specialchar($specialchar);
		$this->set_numbers($numbers);
		$this->set_uppercase($uppercase);
		$this->set_lowercase($lowercase);
		$this->set_password();
	}
	
	// Funktion der looper så længe der er en karakter tilbage af hver type som sætter resultatet ind i en variabel
	private function Generate_Password_Part($type, $length){
		
		$count = 0;
        $return = "";

        if($length > 0){
            while($length > $count){
                if( $type == "lowercase" ){
                    $return .= $this->lowercaseArray[random_int(0,count($this->lowercaseArray) - 1)];
                }
				else if ($type == "uppercase"){
					$return .= $this->uppercaseArray[random_int(0,count($this->uppercaseArray) - 1)];
				}
				else if ($type == "specialchar"){
					$return .= $this->specialArray[random_int(0,count($this->specialArray) - 1)];
				}
				else {
					$return .= $this->talArray[random_int(0,count($this->talArray) - 1)];
				}
                $count++;
            }
        }
        return $return;
	}
	
	
	public function set_password(){
		$this->password = str_shuffle($this->Generate_Password_Part("lowercase", $this->lowercase). $this->Generate_Password_Part("uppercase", $this->uppercase).
		$this->Generate_Password_Part("specialchar", $this->specialchar). $this->Generate_Password_Part("numbers", $this->numbers));
	}
	
	public function set_specialchar($specialchar){
		$this->specialchar = $specialchar;
	}
	
	public function set_numbers($numbers){
		$this->numbers = $numbers;
	}
	
	public function set_uppercase($uppercase){
		$this->uppercase = $uppercase;
	}
	
	public function set_lowercase($lowercase){
		$this->lowercase = $lowercase;
	}
	
	
	public function get_specialchar(){
		return $this->specialchar;
	}
	
	public function get_numbers(){
		return $this->numbers;
	}
	
	public function get_uppercase(){
		return $this->uppercase;
	}
	
	public function get_lowercase(){
		return $this->lowercase;
	}
	
	public function get_password(){
		return $this->password;
	}
	
}

// Når der er trykket på submit tager koden de indtastede værdier og generere et password
if ($_POST["submit"]){
$generatePass = new PasswordGenerator($_POST["specialtegn"], $_POST["number"] , $_POST["uppercase"], $_POST["lowercase"]);
echo "<br>Din kode er: " . $generatePass->get_password();
echo "<br><br>";
}

?>

<form action="#" method="post">
<label for="number">number:</label>
<input type="number" min="0" id="number" name="number" value="<?php echo isset($_POST["number"]) ? $_POST["number"] : 0; ?>"/>
<br><br>
<label for="lowercase">lowercase:</label>
<input type="number" min="0" id="lowercase" name="lowercase" value="<?php echo isset($_POST["lowercase"]) ? $_POST["lowercase"] : 0; ?>"/>
<br><br>
<label for="uppercase">uppercase:</label>
<input type="number" min="0" id="uppercase" name="uppercase" value="<?php echo isset($_POST["uppercase"]) ? $_POST["uppercase"] : 0; ?>"/>
<br><br>
<label for="specialtegn">specialtegn:</label>
<input type="number" min="0" id="specialtegn" name="specialtegn" value="<?php echo isset($_POST["specialtegn"]) ? $_POST["specialtegn"] : 0; ?>"/>
<br><br>
<input type="submit" name="submit" value="Generate Password!"/>
</form>




