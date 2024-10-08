<?php

// механизм получения данных через api
function getRequest($url, $headers) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	$response = curl_exec($ch);
	curl_close($ch);
	return $response;
}	
 
// получить погоду в городе
 function get_weather($city) {
    // получить ключ
    $api_key = 'bd5eff4885c34e888b352806240710';
    $url = "api.weatherapi.com/v1/current.json?key=bd5eff4885c34e888b352806240710&q=$city&country=Russia";
	
    $headers = array( 'User-Agent: x-treme-dev' ); // заголовок с логином для получения данных из GitHub

// вызов функции и получение json-ответа от API
$response = getRequest($url, $headers);
// преобразовать json в массив
$array = json_decode($response, true);
return '<pre>' . print_r($array) . '</pre>';
 
}


// найти в тексте город и передать в функцию get_weather()
function get_weather_shortcode($atts){
   $atts= shortcode_atts(
		array('city' => 'Simferopol'), 
		$atts, 
		'my_shorcode'
	);
	get_weather($atts['city']); 
}

add_shortcode('weather', 'get_weather_shortcode');

function add_shortcode_to_content($content){
	$arr_cites = ['Москва' => 'Moscow', 'Омск' => 'Omsk', 'Уфа' => 'Ufa', 'Краснодар' => 'Krasnodar'];
	echo  $content . '<br>';
	$city = 'Simferopol';
	foreach($arr_cites as $key => $item){
		if(strpos($content, $key) !== false ){
			 $city = $item; 
			 break;
		}   
	}
	return  do_shortcode('[weather city='. $city . ']');
}

add_filter('content', 'add_shortcode_to_content'); 

?>