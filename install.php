<?php

require_once("includes/db.inc.php");

// SQL File
$SQLFileSchema = 'database/schema.sql';
$SQLFilePopulate = 'database/populate.sql';

DB::Connect();

if (!DB::GetLink()) {
	die("MySQL Connection error");
}

// Function For Run Multiple Query From .SQL File
function MultiQuery($sqlfile, $sqldelimiter = ';') {
	set_time_limit(0);

	if (is_file($sqlfile) === true) {
		$sqlfile = fopen($sqlfile, 'r');

		if (is_resource($sqlfile) === true) {
			$query = array();
			echo "<table cellspacing='3' cellpadding='3' border='0'>";

			while (feof($sqlfile) === false) {
				$query[] = fgets($sqlfile);

				if (preg_match('~' . preg_quote($sqldelimiter, '~') . '\s*$~iS', end($query)) === 1) {
					$query = trim(implode('', $query));

					if (mysql_query($query) === false) {
						echo '<tr><td>ERROR:</td><td> ' . $query . '</td></tr>';
					} else {
						echo '<tr><td>SUCCESS:</td><td>' . $query . '</td></tr>';
					}

					while (ob_get_level() > 0) {
						ob_end_flush();
					}

					flush();
				}
				if (is_string($query) === true) {
					$query = array();
				}
			}
			echo "</table>";
			return fclose($sqlfile);
		}
	}
	return false;
}

function copy_directory( $source, $destination ) {
	if ( is_dir( $source ) ) {
		@mkdir( $destination );
		$directory = dir( $source );
		while ( FALSE !== ( $readdirectory = $directory->read() ) ) {
			if ( $readdirectory == '.' || $readdirectory == '..' ) {
				continue;
			}
			$PathDir = $source . '/' . $readdirectory; 
			if ( is_dir( $PathDir ) ) {
				copy_directory( $PathDir, $destination . '/' . $readdirectory );
				continue;
			}
			copy( $PathDir, $destination . '/' . $readdirectory );
			echo "<br>SUCCESS: $PathDir -> $destination/$readdirectory";
		}
 
		$directory->close();
	}else {
		copy( $source, $destination );
	}
}

MultiQuery($SQLFileSchema);
MultiQuery($SQLFilePopulate);

echo "All done";
?>