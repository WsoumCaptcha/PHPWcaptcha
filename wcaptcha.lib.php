<?php
/**
 * Class for Wsoum CAPTCHA implementation
 *
 * @version 1.0
 * @property string $api_key The api key, get it from : https://captcha.wsoum.ml/get_key
 * @property string $language The primary language ('ar' for arabic, 'en' for english)
 * @property string $background The background color (in HEX)
 * @property string $border The border color (in HEX)
 */
class wcaptcha {
	
	private $api_key;
	private $language;
	private $background;
	private $border;

	/**
	 * Init
	 * @param string $api_key API KEY
	 * @param string $language Primary language
	 * @param string $background Background color (HEX)
	 * @param string $api_key Border color (HEX)
	 */	
	function __construct( $api_key, $language = 'en' ){
		
		if ( empty( $api_key ) ){
		
			die('You must set the api key in order to use the API');
			
		} else {
			
			$this->api_key	  = $api_key;
			$this->language	  = $language;
			$this->background = $background;
			$this->border	  = $border;
			
		}
		
	}
	
	/**
	 * Validate the captcha
	 * @return bool
	 */	  
	public function valid(){
		
		$input	    = $_POST['wcaptcha_input'];
		$challenge  = $_POST['wcaptcha_challenge'];
		$key		= $_POST['wcaptcha_key'];
		$language   = $_POST['wcaptcha_language'];
		
		if (empty($input) || empty($challenge) || empty($key) || empty($language)) return false;
		
		
		$api_request = curl_init( "https://captcha.wsoum.ml/api/verify_wcaptcha.php?key=".$key."&lang=".$language."&input=".$input."&challenge=".$challenge."" );
		curl_setopt($api_request, CURLOPT_RETURNTRANSFER ,1);
		
		$api_response = curl_exec($api_request);

		if ($api_response == 'false'){
		
			return false;
			
		} else {
			
			return true;
			
		}
		
	}
	/**
	 * Get captcha field
	 */	
	public function field($background = '#fafafa', $border = '#c1c1c1'){
		
?>
		<!-- Begin Wsoum CAPTCHA Code -->
		<script type="text/javascript"><!--
			wcaptcha_options = {language: '<?php echo $this->language ?>', key: '<?php echo $this->api_key ?>', background: '<?php echo $background ?>', border: '<?php echo $border ?>'}; 
		//--></script>
		<script type="text/javascript" src="https://captcha.wsoum.ml/wcaptcha.js"></script>
		<!-- End Wsoum CAPTCHA Code -->		
<?php
		
		
	}
	
	
}


?>
