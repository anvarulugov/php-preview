<?php
ini_set('display_errors', 0);

function pre_print_r(...$variables)
{
	foreach ($variables as $variable) {
		echo '<pre>';
		print_r($variable);
		echo '</pre>';
	}
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$phpCode = $_POST['code'];
	ob_start();
	try {
		$phpCode = str_replace(['<?php', '<?', '?>'], '', $phpCode);
		eval($phpCode);
		$output = ob_get_clean();
		echo $output;
	} catch (\ParseError $e) {
		echo '<div class="border rounded bg-red-200 border-red-300 p-3">' . $e->getMessage() . '</div>';
	}
	exit;
}
