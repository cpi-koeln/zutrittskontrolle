<?php
/// Fehler kann in Zeile 34 (if unique) auftreten, wenn es in der zu suchenden Spalte keine Duplikate gibt.
function sortObjectArray($toSort, $sortDef, $secound = false){

	// jede Sortierdefinition durchlaufen (wird durch den return am Ende nur ein Mal durchlaufen!!! Muss so!!!):
	foreach($sortDef as $field => $sort){

		// Array zum Sortieren erstellen:
		$sortArray = array();
		foreach($toSort as $key => $element){

			$sortArray[$key] = $element->$field;
		}
		// sortArray sortieren
		$countSortArray=count($sortArray);
		for ($i=0;$i<$countSortArray;$i++)
			{
				$sortArray[$i]=strtolower($sortArray[$i]);
			};

		uasort($sortArray, $sort);

		// $toSort sortieren:
		$newToSort = array();
		foreach($sortArray as $key => $element){
			$newToSort[$key] = $toSort[$key];
		}
		$toSort = $newToSort;

		// Gleiche finden und sortieren:

		// uniqe Liste erstellen:
		$unique = array_unique($sortArray);

		// Neues toSort erstellen:
		$newToSort = array();

		// für jedes Element in Unique die Richtigen Elemente suchen und nach den weiteren Kriterien sortieren:
		// Wenn es unique Werte gibt:
		if(count($unique)<count($sortArray)){

			foreach($unique as $sortelement){

				// Hole nur die die dem jetzigen unique Element entprechen.
				$oneValue = array_keys($sortArray, $sortelement);

				// Neues Array mit den Werten des nur jetzt gesuchten erstellen:
				$partialToSort = array();
				foreach($oneValue as $element){
					$partialToSort[$element] = $toSort[$element];
				}

				// Wenn man Werte darin sortieren muss
				if(count($oneValue) > 1){

					// Neues definitionsarray erzeugen:
					$newSortDef = array();
					foreach($sortDef as $key => $value){
						if($key != $field){
							$newSortDef[$key] = $sortDef[$key];
						}
					}

					// Wenn es eine weitere Sortdefinition gibt.
					if(!empty($newSortDef)){

						// Rekursiver Aufruf mit dem neuen Array und der neuen Suchdefinition.
						$partialToSort = sortObj($partialToSort, $newSortDef, true);
					}
				}

				// Arrays zusammenführen.
				$newToSort = array_merge($newToSort, $partialToSort);
			}
			$toSort = $newToSort;

		}

		return $toSort;
	}
}

function ASC($a, $b){
	if($a == $b){
		return 0;
	}
	return ($a < $b) ? -1 : 1;
}

function DESC($a, $b){
	if($a == $b){
		return 0;
	}
	return ($a < $b) ? 1 : -1;
}

?>
