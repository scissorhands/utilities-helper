<?php 
function dump( $var, $text = false )
{
	if( $text ){
		echo "<pre>";
			print_r($var);
		echo "</pre>";
		exit();
	} else{
		exit( json_encode( $var ) );
	}
}

function generate_uri_hash()
{
	return md5(rand().microtime());
}

function parse_obj_array_to_ids_array($obj_array, $id_name = "id")
{
    $arr = array();
    foreach ($obj_array as $row) {
        $arr[] = $row->$id_name;
    }
    return $arr;
}

function obj_array_to_indexed_array($obj_array, $index_field, $value_field)
{
    $arr = array();
    foreach ($obj_array as $row) {
        $arr[$row->$index_field] = $row->$value_field;
    }
    return $arr;
}

function time_format(
	$input_seconds = 0,
	$format_style = 'hrs_mins_secs',
	$lang_time = array(
			'sec'	=> 	'seg.',
			'min' 	=> 	'min.',
			'hr' 	=> 	'hrs.',
			'year' 	=> 	'años'
		)
	){
	$days = "";$hours = "";$minutes = "";$seconds = "";
	$days=floor($input_seconds / 86400);
	$remainder=floor($input_seconds % 86400);
	$hours=floor($remainder / 3600);
	$remainder=floor($remainder % 3600);
	$minutes=floor($remainder / 60);
	$seconds=floor($remainder % 60);

	if ($days > 0) $days = "$days";
	if ($hours > 0) $hours = "$hours";
	if ($minutes > 0) $minutes = "$minutes";
	if ($seconds > 0) $seconds = "$seconds";

	if ($hours < 10) $hours = "0$hours";
	if ($minutes < 10) $minutes = "0$minutes";
	if ($seconds < 10) $seconds = "0$seconds";


	switch($format_style) {
		case 'days_hrs':
			if($input_seconds>(365*24*60*60)) {
				return number_format( ($days / 365), 2, '.', ',' ) . " " . $lang_time['year'];
			} else {
				return ($days*24)+$hours . ':' . $minutes . ':' . $seconds;
			}
			break;

		case 'mins_secs':
			return $minutes . ':' . $seconds;
			break;

		case 'hrs_mins_secs':
			return $hours . ':' . $minutes . ':' . $seconds;
			break;

		case 'long_mins_secs':
			return $minutes . ' ' . $lang_time['min'] . ', ' . $seconds . ' '
			. $lang_time['sec'];
			break;

		case 'long_hrs_mins_secs':
			return $hours . ' ' . $lang_time['hr'] . ', ' . $minutes . ' '
			. $lang_time['min'] . ', ' . $seconds . ' ' . $lang_time['sec'];
			break;
	}

	return $days.$hours;
}

function get_date_diff( $date1="2015-01-01", $date2="2015-01-15" )
{
	$datetime1 = new DateTime($date1);
	$datetime2 = new DateTime($date2);
	$interval = $datetime1->diff($datetime2);
	return $interval;
}

function get_dsn( $host, $user, $pass, $database )
{
	return 'mysqli://'.$user.':'.$pass.'@'.$host.'/'.$database;
}

function echolor( $text = '', $color = 'white'){
	$color_code = [
		'black'=> '30',
		'blue'=> '34',
		'green'=> '32',
		'cyan'=> '36',
		'red'=> '31',
		'purple'=> '35',
		'brown'=> '33',
		'light_gray'=> '1;37', 
		'dark_gray'=> '1;30',
		'light_blue'=> '1;34',
		'light_green'=> '1;32',
		'light_cyan'=> '1;36',
		'light_red'=> '1;31',
		'light_purple'=> '35',
		'yellow'=> '33',
		'white'=> '37'
	];
	echo isset($color_code[$color])? "\033[".$color_code[$color]."m$text\033[0m \n" : $text."\n";
}

?>