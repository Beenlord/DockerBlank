<?php
	
	function getDataBase(string $baseName, bool $common = true) {
		$data = [];
		try {
			if ($common) {
				$commonJson = getFile(getFilePath('database', 'common.json'));
				$data['common'] = json_decode($commonJson);
			}
			$pageJson = getFile(getFilePath('database', 'pages', $baseName . '.json'));
			array_push($data, json_decode($pageJson));
			return $data;
		} catch (Exception $e) {
			echo 'Ошибка: ' . $e -> getMessage();
		}
	}
	
	function getFilePath() {
		return implode(DS, array_merge([CMS_ROOT], func_get_args()));
	}
	
	function getFile(string $filePath) {
		if (file_exists($filePath)) {
			return file_get_contents($filePath);
		} else throw new Exception('Запрашиваемый файл не найден.');
	}
	