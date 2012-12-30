<?PHP
/**
 * Holds information to connect and manipulate the database.
 **/

require_once('includes/dbconn.inc.php');

class DB
{
	public static $link = null;
	  
	public static function connect()
	{
			DB::$link = mysql_connect( DB_SERVER, DB_USER, DB_PASS ); // or die( "Unable to connect to mysql server\n" );
			mysql_select_db( DB_NAME, DB::$link ) or die( "Unable to select database\n" );
	}
	
	public static function close()
	{
		if( DB::$link != null ) {
			mysql_close(DB::$link);
			$link = null;
			
			return true;
		}
		return false;
	}
	
	public static function query( $query )
	{
		$argv = func_get_args();
		array_shift( $argv );  // remove $query from the argv
		$arguments = Array();
		
		foreach( $argv as $arg ) {
			$arguments[] = mysql_real_escape_string( $arg, DB::$link );
		}
		
		$query = vsprintf( $query, $arguments );
		$result = mysql_query( $query ) or die( mysql_error() );
		
		$err = mysql_error( DB::$link );
		if( $err ) {
			throw new Exception( $err );
		}
		
		return $result;
	}
	
	public static function getLink()
	{
		return DB::$link;
	}
	
	public static function escape( $string )
	{
		return mysql_real_escape_string( $string );
	}

	public static function isConnected()
	{
		if( DB::$link == null )
			return false;
		return true;
	}
	
	public static function isClosed()
	{
		if( DB::$link == null )
			return true;
		return false;
	}
	
}

?>