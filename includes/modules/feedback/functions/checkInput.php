<?

function checkInput($data=array(),$criteria=array()) {

	$return = array();

	foreach($criteria as $key => $tests) {

		foreach ($tests as $criterion) {

			switch($criterion) {

				case "required":

					if (empty($data[$key])) {

						$return[$key] = "is required";

					}

				break;

				case "email":

					if (
					isset($data[$key])
					&&
					!ereg(
						"^([._a-zA-Z0-9-]){2,255}@([._a-zA-Z0-9-]){2,255}\.([a-zA-Z]){2,4}$",
						 $data[$key]
						)
					) {

						$return[$key] = "must be a valid email address";

					}

				break;

				case "number":

					if (
					isset($data[$key])
					&&
					!is_numeric($data[$key])
					) {

						$return[$key] = "must be a number";

					}

				break;

			}
		}
	}

	return $return;

}

?>