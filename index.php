<script src="../../js/jquery.min.js"></script>
<script>
bSkipErrorDisplay = false;
$(document).ready(function () {
	console.debug("skip=", bSkipErrorDisplay);
	if (!bSkipErrorDisplay) {
		alert("cannot launch script !");
	}
});
</script>
<?php
$bErrorOnInclude = false;

register_shutdown_function(static function () {
	$error = error_get_last();
	if ($error
		&& (isset($error['type']))
		&& (in_array($error['type'], [E_ERROR, E_PARSE, E_COMPILE_ERROR], true))) {
		ob_end_clean();
	}
});
ob_start();
//require_once("include_error.php"); // will generate parse error
require_once("include_ok.php"); // will echo but no parse error
ob_end_clean();

//TODO disable JS error display + redirect
echo <<<HTML
<script>
bSkipErrorDisplay = true;
alert("go go go !");
</script>
HTML;
