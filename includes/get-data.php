<?php
	function create_url($name, $url){
		$pieces = explode(' ', $name);
		$result = $pieces[0];
		$n = count($pieces);
		for($i = 1; $i < $n; $i++){
			$result = $result.'%20'.$pieces[$i];
		}
		$result = $url.$result.'&c=apps&hl=pl';
		return $result; 
	}

	function get_data($str, $source_code, $message){
		preg_match($source_code,$str,$title); 
		if($title[1] == ''){
			return $message;
		}
		return $title[1];
	}

	function get_app($url, $searchUrl){
		$str = file_get_contents($url);
		if(strlen($str)>0){
			$temp = '/\<span class="preview-overlay-container" data-docid="(.+?)"/';
			preg_match($temp,$str,$title); 
			if($title[1] == ''){
				return $title[1]= 'Nie znaleziono aplikacji';
			}
			return $searchUrl.$title[1].'&hl=pl'; 		
		}
	}

	if (isset($_POST['submit'])) {
		// Check if name has been entered
		if (!$_POST['name']) {
			$errName = "Proszę podać nazwę aplikacji";		
		}else{
			$name = strip_tags($_POST['name']);
			$searchUrl = 'https://play.google.com/store/search?q=';

			$myUrl = create_url($name, $searchUrl);
			$searchUrl = 'https://play.google.com/store/apps/details?id=';
			$result[0] = get_app($myUrl, $searchUrl);
			if($result[0] == 'Nie znaleziono aplikacji'){
				$result[0] = '<div class="alert alert-danger">'.$result[0].'</div>';
			}else{
				$str = file_get_contents($result[0]);
				if(strlen($str)>0){
					$result[0] = '';
					$result[1] = get_data($str, '/\<div class="id-app-title" tabindex="0"\>(.+?)\<\/div\>/', 'Nie znaleziono tytułu aplikacji');//znajdz aplikacje
					$result[2] = '<strong>Kategoria: </strong>'.get_data($str,'/\<span itemprop="genre"\>(.+?)\<\/span\>/','Nie znaleziono kategorii').'<br><br>';//znajdz kategoie
					$result[3] = '<strong>Ocena: </strong>'.get_data($str,'/\<div class="score" aria-label="Ocena w gwiazdkach: (.+?) na pięć"\>/','Nie znaleziono oceny').'<br><br>';//znajdz ocene	
		 			$result[4] = '<br>'.'<img src="'.get_data($str,'/\<img class="cover-image" src="(.+?)"/','Nie znaleziono ikonki').'">'.'<br>';//znajdz ikonke
		 			$result[5] = '<strong>Instalacje: </strong>'.get_data($str,'/itemprop="numDownloads"\> (.+?) \<\/div\>/','Nie znaleziono liczby instalacji').'<br><br>';
		 			$result[6] = '<strong>Aktualna wersja: </strong>'.get_data($str,'/itemprop="softwareVersion"\>(.+?)\<\/div\>/','Nie znaleziono').'<br><br>';
					$result[7] = '<strong>Wersja na androida: </strong>'.get_data($str,'/itemprop="operatingSystems"\>(.+?)\<\/div\>/','Nie znaleziono').'<br><br>';
		 		}
			}
		}
	}
?>

