<?

function displayFieldset($legend,$fields=array(),$data=array(),$errors=array()) {

	$return = "<fieldset>\n";

	if (!empty($legend)) {

		$return.= "<legend>";
		$return.= $legend;
		$return.= "</legend>\n";

	}

	if (!empty($errors["everything"])) {

		$return.= "<p class=\"error\">";
		$return.= $errors["everything"];
		$return.= "</p>\n";

	}

	foreach ($fields as $field) {

		$name = $field["name"];

		$return.= "<p>\n";

		if (!empty($field["label"])) {

			$return.= "<label for=\"";
			$return.= str_replace("_","-",$name);
			$return.= "\">";
			$return.= $field["label"];

			if (isset($errors[$name])) {
	
				$return.= "<span class=\"error\">";
				$return.= " ";
				$return.= $errors[$name];
				$return.= ".</span>\n";
	
			}
			$return.= "</label>\n";

		} else {

			if (isset($errors[$name])) {
	
				$return.= "<span class=\"error\">";
				$return.= "This ";
				$return.= $errors[$name];
				$return.= ".</span>\n";
	
			}
		}

		switch ($field["type"]) {

			case "submit":

				$return.= "<input type=\"submit\" id=\"";
				$return.= str_replace("_","-",$name);
				$return.= "\" name=\"";
				$return.= $name;
				$return.= "\" ";
				$return.= "value=\"";

				if (!empty($data[$name])) {

					$return.= htmlspecialchars($data[$name]);

				} else {

					$return.= ucwords(htmlspecialchars($name));

				}
				$return.= "\" ";
				if (isset($field["class"])) {
					$return.= "class=\"";
					$return.= $field["class"];
					$return.= "\" ";
				}
				$return.= "/>\n";

			break;

			case "textarea":

				$return.= "<textarea id=\"";
				$return.= str_replace("_","-",$name);
				$return.= "\" name=\"";
				$return.= $name;
				$return.= "\" ";
				if (isset($field["class"])) {
					$return.= "class=\"";
					$return.= $field["class"];
					$return.= "\" ";
				}
				$return.= "cols=\"30\" rows=\"15\">\n";

				if (!empty($data[$name])) {

					$return.= htmlspecialchars($data[$name]);

				}

				$return.= "</textarea>\n";

			break;

			case "mediumtextarea":

				$return.= "<textarea id=\"";
				$return.= str_replace("_","-",$name);
				$return.= "\" name=\"";
				$return.= $name;
				$return.= "\" ";
				if (isset($field["class"])) {
					$return.= "class=\"";
					$return.= $field["class"];
					$return.= "\" ";
				}
				$return.= "cols=\"50\" rows=\"5\">\n";

				if (!empty($data[$name])) {

					$return.= htmlspecialchars($data[$name]);

				}

				$return.= "</textarea>\n";

			break;

			case "hidden":

				$return.= "<input type=\"hidden\" id=\"";
				$return.= str_replace("_","-",$name);
				$return.= "\" name=\"";
				$return.= $name;
				$return.= "\" ";

				if (!empty($data[$name])) {

					$return.= "value=\"";
					$return.= htmlspecialchars($data[$name]);
					$return.= "\" ";

				}

				if (isset($field["class"])) {
					$return.= "class=\"";
					$return.= $field["class"];
					$return.= "\" ";
				}

				$return.= "/>\n";

			break;

			case "date":

				$return.= "<input type=\"text\" id=\"";
				$return.= str_replace("_","-",$name);
				$return.= "\" name=\"";
				$return.= $name;
				$return.= "\" ";
				$return.= "value=\"";

				if (!empty($data[$name])) {
					$return.= htmlspecialchars($data[$name]);

				} else {

					$return.= date("Y-m-d H-i-s");

				}

				$return.= "\" ";

				if (isset($field["class"])) {
					$return.= "class=\"";
					$return.= $field["class"];
					$return.= "\" ";
				}

				$return.= "/>\n";

			break;

			case "select":

				$return.= "<select id=\"";
				$return.= str_replace("_","-",$name);
				$return.= "\" name=\"";
				$return.= $name;
				$return.= "\"";
				if (isset($field["class"])) {
					$return.= "class=\"";
					$return.= $field["class"];
					$return.= "\" ";
				}
				$return.= ">\n";

				if (isset($field["options"])) {

					foreach ($field["options"] as $value => $text) {

						$return.= "<option value=\"";
						$return.= $value;
						$return.= "\" ";

						if (!empty($data[$name]) && $data[$name] == $value) {

							$return.= "selected=\"selected\" ";

						}

						$return.= ">";
						$return.= htmlspecialchars($text);
						$return.= "</option>\n";

					}
				}

				$return.= "</select>\n";

			break;

			case "checkbox":

				if (isset($field["options"])) {

					if (!empty($data[$name])) {

						if (is_array($data[$name])) {

							$values = $data[$name];

						} else {

							$values = explode(",",$data[$name]);

						}

					}

					foreach ($field["options"] as $option) {

						$return.= htmlspecialchars($option);
						$return.= "<input type=\"checkbox\" name=\"";
						$return.= $name;
						$return.= "[]\"";
						$return.= " value=\"";
						$return.= htmlspecialchars($option);
						$return.= "\" ";
						if (isset($field["class"])) {
							$return.= "class=\"";
							$return.= $field["class"];
							$return.= "\" ";
						}

						if (!empty($values) && in_array($option,$values)) {

							$return.= "checked=\"checked\" ";

						}

						$return.= "/>\n";

					}
				}

			break;

			case "radio":

				if (isset($field["options"])) {

					foreach ($field["options"] as $value) {

						$return.= htmlspecialchars($value);
						$return.= "<input type=\"radio\" name=\"";
						$return.= $name;
						$return.= "\"";
						$return.= " value=\"";
						$return.= htmlspecialchars($value);
						$return.= "\" ";
						if (isset($field["class"])) {
							$return.= "class=\"";
							$return.= $field["class"];
							$return.= "\" ";
						}

						if (!empty($data[$name]) && $data[$name] == $value) {

							$return.= "selected=\"selected\" ";

						}

						$return.= "/>";

					}
				}

			break;

			case "password":

				$return.= "<input type=\"password\" id=\"";
				$return.= str_replace("_","-",$name);
				$return.= "\" name=\"";
				$return.= $name;
				$return.= "\" ";

				if (!empty($data[$name])) {

					$return.= "value=\"";
					$return.= htmlspecialchars($data[$name]);
					$return.= "\" ";

				}

				if (isset($field["class"])) {
					$return.= "class=\"";
					$return.= $field["class"];
					$return.= "\" ";
				}

				$return.= "/>\n";

			break;

			case "date":

				$return.= "<input type=\"text\" id=\"";
				$return.= str_replace("_","-",$name);
				$return.= "\" name=\"";
				$return.= $name;
				$return.= "\" ";
				$return.= "value=\"";

				if (!empty($data[$name])) {

					$return.= htmlspecialchars($data[$name]);

				} else {

					$return.= date("Y-m-d H:i:s");

				}

				$return.= "\" ";

				if (isset($field["class"])) {
					$return.= "class=\"";
					$return.= $field["class"];
					$return.= "\" ";
				}

				$return.= "/>\n";

				

			default:

				$return.= "<input type=\"text\" id=\"";
				$return.= str_replace("_","-",$name);
				$return.= "\" name=\"";
				$return.= $name;
				$return.= "\" ";

				if (!empty($data[$name])) {

					$return.= "value=\"";
					$return.= htmlspecialchars($data[$name]);
					$return.= "\" ";

				}

				if (isset($field["class"])) {
					$return.= "class=\"";
					$return.= $field["class"];
					$return.= "\" ";
				}

				$return.= "/>\n";

			break;

		}

		$return.= "</p>\n";

	}

	$return.= "</fieldset>\n";

	return $return;

}

?>