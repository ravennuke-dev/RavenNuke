<?php
/**
 *
 * @package RavenNuke 2.5
 * @subpackage Core
 * @version $Id: mysqli.php 3956 2013-02-09 05:02:12Z palbin $
 * @copyright 2013 by RavenNuke(tm)
 * @link http://www.ravennuke.com
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
*/

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
	header('Location: ../index.php');
	exit('Access Denied');
}

if(!defined('SQL_LAYER')) {
	define('SQL_LAYER', 'mysqli');
	/**
	 * Need these so that we can have compatability with mysql extension
	 */
	define('SQL_NUM', MYSQLI_NUM);
	define('SQL_BOTH', MYSQLI_BOTH);
	define('SQL_ASSOC', MYSQLI_ASSOC);
}

/**
*
* An instance of this class represents the database layer
*
* This class is an extension of the mysqli class.
*
* <code>
* require_once 'mainfile.php';
* $db = new sql_db($dbhost, $dbuname, $dbpass, $dbname, false);
* $db->....
* </code>
*
*/
class sql_db extends mysqli {
	/**
	* Class variables
	*/
	public $num_queries = 0;
	public $all_queries = array();
	public $connectionError = false;
	public $dbError = false;
	public $dbVersionCompare = false;
	public $errorConfigTableMissing = false;
	public $qtime = 0;
	public $preparedStatement;
	public $parameters = '';
	private $query_result;
	private $stmt_obj;
	private $row;
	private $rowset;
	private $file = '';
	private $line = '';
	private $varsBound = false;
	private static $instance = false;

	public $persistency;
	public $loglevel;
	public $display_errors;
	public $dbname;
	private $user;
	private $password;
	private $server;
	private $prefix;
	private $user_prefix;

	/**
	* Create an instance of db class
	*
	* @param string $sqlserver address to database server
	* @param string $sqluser database username
	* @param string $sqlpassword database user password
	* @param string $database database name
	* @param boolean $persistency is database connection persistent
	*/
	public function __construct($sqlserver, $sqluser, $sqlpassword, $database, $persistency = true) {
		$this->persistency = $persistency;
		$this->user = $sqluser;
		$this->password = $sqlpassword;
		$this->server = $sqlserver;
		$this->dbname = $database;
		$this->prefix = $GLOBALS['prefix'];
		$this->user_prefix = $GLOBALS['user_prefix'];
		$this->loglevel = $GLOBALS['loglevel'];
		$this->display_errors = $GLOBALS['display_errors'];

		if (version_compare(phpversion(), '5.3', '>=' ) && $this->persistency) {
			@parent::__construct('p:' . $this->server, $this->user, $this->password);
		} else {
			@parent::__construct($this->server, $this->user, $this->password);
		}

		/**
		* Use this instead of $connect_error if you need to ensure
		* compatibility with PHP versions prior to 5.2.9 and 5.3.0.
		*/
		if (mysqli_connect_error()) {
			$this->connectionError = ($this->display_errors) ? 'Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error() : true;
		} else {
			/**
			* Determine server version so we can determine compatability
			*/
			$this->db_version = $this->server_version;
			if (version_compare($this->db_version, '40100', '>=')) {
				$this->dbVersionCompare = false;
				//$this->set_charset();
			} else {
				$this->dbVersionCompare = '<p>&nbsp;</p><p class="d1"><strong>We are sorry but the the MySQL version (' . $this->db_version . ') you are attempting to use is to old and is not supported by RavenNuke'
				. ' nor by MySQL.com any longer.</p>'
				. '<div class="c1">'
				. '<p class="d2">Please ask your host to upgrade or switch hosts</p></div>';
			}

			if (parent::select_db($this->dbname)) {
				/**
				* Test to see if database is populated
				*/
				if ($this->sql_numrows($this->sql_query('SHOW TABLES LIKE "' . $this->prefix . '_config"'))) {
					$this->errorConfigTableMissing = false;
				} else {
					$this->errorConfigTableMissing = true;
				}
			} else {
				$this->dbError = true;
				$this->sql_close();
			}
		}
	}

	/**
	* Use this so we do not have to duplicate every function for the mysqli and mysql_stmt classes.
	*/
	public function __call($method, $args) {
		$object = empty($this->stmt_obj) ? $this->query_result : $this->stmt_obj;
		return call_user_func_array(array($object, $method), $args);
	}

	/**
	* Get instance of db class
	*/
	public static function getInstance() {
		if(!self::$instance) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	* Performs a query on the database.
	* Similar to mysqli_query().
	*
	* @param string $query query string
	* @param boolean $transaction transaction setting
	*/
	public function sql_query($query = '', $transaction = FALSE) {
		/**
		* Remove any pre-existing queries
		*/
		unset($this->query_result);
		if($query != '') {
			$this->num_queries++;
			if ($this->loglevel == 3 || $this->loglevel == 4) {
				list($usec, $sec) = explode(' ', microtime());
				$time_start = ((float)$usec + (float)$sec);
				$this->query_result = parent::query($query);
				list($usec, $sec) = explode(' ', microtime());
				$time_end = ((float)$usec + (float)$sec);
				$this->qtime = number_format($time_end - $time_start, 10, '.', '');
				/**
				* Not sure why some of these are none objects.
				*/
				$num = is_object($this->query_result) ? $this->sql_numrows() : 0;
				$this->backtrace_log($query, $num);
			} else {
				$this->query_result = parent::query($query);
			}
		}
		if ($this->loglevel == 2 || $this->loglevel == 4) {
			if ($this->loglevel == 2) $this->backtrace();
			$logvar = date('F j, Y, g:i a') . "\n" ;
			$logvar .= 'File: '. $this->file . ' - Line: ' . $this->line . "\n";
			$logvar .= 'SQL was: ' . preg_replace('/\s+/u', ' ', trim($query)) . "\n";
			$logvar .= 'querycount = ' . $this->num_queries . "\n";
			$fplog = fopen(NUKE_BASE_DIR . 'rnlogs/dblog', 'a');
			fwrite($fplog, $logvar . "\n");
			fclose($fplog);
		}
		if($this->query_result) {
			unset($this->row);
			unset($this->rowset);
			return $this->query_result;
		} else {
			$error = $this->sql_error();
			if ($this->loglevel > 0) {
				$this->backtrace();
				$logvar = date('F j, Y, g:i a') . ' ' ;
				$logvar .= 'File: '. $this->file . ' - Line: ' . $this->line . "\n";
				$logvar .= 'Code: ' . $error['code'] . ' - Message: ' .  $error['message'] . "\n";
				$logvar .= 'SQL was: ' . preg_replace('/\s+/u', ' ', trim($query)) . "\n";
				$logvar .= ' remote addr: ' . $_SERVER['REMOTE_ADDR'];
				$fplog = fopen(NUKE_BASE_DIR . 'rnlogs/dblog', 'a');
				fwrite($fplog, $logvar . "\n");
				fclose($fplog);
			}
			//return ($transaction == END_TRANSACTION) ? true : false;
			return $this->query_result;
		}
	}

	/**
	* Gets the number of rows in a result.
	* Similar to mysqli_num_rows().
	*
	* @param object $query_id id of the query you want results for
	*/
	public function sql_numrows($query_id = false) {
		if(!$query_id) {
			$query_id = $this->query_result;
		}
		if($query_id) {
			return $query_id->num_rows;
		} else {
			return false;
		}
	}

	/**
	* Gets the number of affected rows in a previous MySQL operation.
	* Similar to mysqli_affectedrows().
	*
	*/
	public function sql_affectedrows() {
		return $this->affected_rows;
	}

	/**
	* Returns the number of columns for the most recent query.
	* Similar to to mysql_field_count().
	*
	* @param object $query_id id of the query you want results for
	*/
	public function sql_numfields($query_id = false) {
		if(!$query_id) {
			$query_id = $this->query_result;
		}
		if($query_id) {
			return $query_id->field_count;
		} else {
			return false;
		}
	}

	/**
	* Returns the value of the specified field in a result set.
	*
	* @param int $offset the index of the field desired
	* @param object $query_id id of the query you want results for
	*/
	public function sql_fieldname($offset, $query_id = false) {
		if(!$query_id) {
			$query_id = $this->query_result;
		}
		if($query_id) {
			$result = $query_id->fetch_fields();
			return $result[$offset]->name;
		} else {
			return false;
		}
	}

	/**
	* Fetch the field type for a single field.
	*
	* @param int $offset The field number. This value must be in the range from 0 to number of fields - 1
	* @param object $query_id id of the query you want results for
	*/
	public function sql_fieldtype($offset, $query_id = false) {
		if(!$query_id) {
			$query_id = $this->query_result;
		}
		if($query_id) {
			$result = $query_id->fetch_field_direct($offset);
			$type = $this->get_data_type($result->type);
			return $type;
		} else {
			return false;
		}
	}

	/**
	* Fetch a result row as an associative, a numeric array, or both.
	* Similar to mysqli_fetch_array().
	*
	* @param object $query_id id of the query you want results for
	* @param string $type determines if array is numeric, associative, or both
	*/
	public function sql_fetchrow($query_id = false, $type = SQL_BOTH) {
		unset($this->row);
		if(!$query_id) {
			$query_id = $this->query_result;
		}
		if($query_id && is_object($query_id)) {
			$this->row = $query_id->fetch_array($type);
			return $this->row;
		} else {
			return false;
		}
	}

	/**
	* Fetches all result rows as an associative array, a numeric array, or both
	* Similar to mysqli_fetch_all().
	*
	* @param object $query_id id of the query you want results for
	* @param string $type determines if array is numeric, associative, or both
	*/
	public function sql_fetchrowset($query_id = false, $type = SQL_BOTH) {
		unset($this->rowset);
		if(!$query_id) {
			$query_id = $this->query_result;
		}
		if($query_id && is_object($query_id)) {
			if (function_exists('mysqli_fetch_all')) {
				$this->rowset = $query_id->fetch_all($type);
			} else {
				$result = array();
				while($result = $query_id->fetch_array($type)) {
					$this->rowset[] = $result;
				}
			}
			return empty($this->rowset) ? false : $this->rowset;
		} else {
			return false;
		}
	}

	/**
	* Returns the auto generated id used in the last query.
	* Similar to mysqli_insert_id().
	*/
	public function sql_nextid() {
		return $this->insert_id;
	}

	/**
	* Frees the memory associated with a result.
	* Similar to mysqli_free_result().
	*
	* @param object $query_id id of the query you want to free
	*/
	public function sql_freeresult($query_id = false) {
		if(!$query_id) {
			$query_id = $this->query_result;
		}
		if ($query_id) {
			$query_id->free();
			unset($this->row);
			unset($this->rowset);
			unset($this->query_result);
			return true;
		} else {
			return false;
		}
	}

	/**
	* Closes and kills a previously opened database connection.
	* Similar to mysqli_close() and mysqli_kill().
	*/
	public function sql_close() {
		return parent::close();
	}

	/**
	* Escapes special characters in a string for use in an SQL statement, taking into account the current charset of the connection
	* Similar to mysqli_real_escape_string().
	*
	* @param string $string query strong that needs excaped
	* @return string escaped string that is database safe
	*/
	public function sql_escape_string($string) {
		return $this->real_escape_string($string);
	}

	/**
	* Returns an associative array of "message" and "code" for a failed query.
	*/
	public function sql_error() {
		$result['message'] = $this->error;
		$result['code'] = $this->errno;
		return $result;
	}

	/**
	* Sets to character set of the database connection
	*
	* @param sting $charset (optional) character set as the default is utf8
	*/
	// PHP8: Deprecated: Return type should either be compatible with mysqli::set_charset(string $charset): bool
	// PHP8 fix added type : bool to function call
	// Backwards compatibility for php7 #[\ReturnTypeWillChange]
	#[\ReturnTypeWillChange]
	function set_charset($charset = 'utf8') {
		if (function_exists('mysqli_set_charset')) {
			if ($this->set_charset($charset)) {
				return; // PHP8 fix add return 1, when return type :bool is set to the function call to avoid Fatal error: A function with return type must return a value
			}
		}
		$this->sql_query('SET NAMES ' . $charset);
	}

	/**
	* Optimizes the entire database of a specific table.
	*
	* @param string $tableName (optional) name of table to optimize
	*/
	public function sql_optimize($tableName = '') {
		$error = false;
		if (empty($tableName)) {
			$tables = $this->sql_fetchtables($this->dbname);
			foreach($tables as $table) {
				$error = !$this->sql_query('OPTIMIZE TABLE ' . $table) ? true : false;
			}
		} else {
			$error = !$this->sql_query('OPTIMIZE TABLE ' . $tableName) ? true: false;
		}
		return $error;
	}

	/**
	* Returns array of tables for a dataabase.
	*
	* @param string $database name of databse to show tables.  Will return RN database if empty.
	* @param boolean $rnOnly show RavenNuke tables only
	*/
	public function sql_fetchtables($database = '', $rnOnly = false) {
		$tables = array();
		$database = empty($database) ? $this->dbname : $database;
		$result = $this->sql_query('SHOW TABLES FROM ' . $database);
		while (list($name) = $this->sql_fetchrow($result, SQL_NUM)) {
			if ($rnOnly) {
				if(stristr($name, $this->prefix . '_') || stristr($name, $this->user_prefix . '_')) {
					$tables[$name] = $name;
				}
			} else {
				$tables[$name] = $name;
			}
		}
		return $tables;
	}

	/**
	* Fetches an array of available databases.
	*/
	public function sql_fetchdatabases() {
		$databases = array();
		$result = $this->sql_query('SHOW DATABASES');
		while (list($name) = $this->sql_fetchrow($result, SQL_NUM)) {
			$databases[$name] = $name;
		}
		return $databases;
	}

	/**
	* Creates an array of query information so that it can be dispalyed on the screen.
	* Incorporates to backtrace() to determine the fine and line number of query.
	*
	* @param string $query the query string you are backtracing
	* @param int $numrows number of results from query
	* @param boolean $failed did the query fail
	* @param object $query_id id of the query you want results for
	*/
	private function backtrace_log($query, $numrows, $failed = false, $query_id = false) {
		$query_id = empty($query_id) ? $query_id : $this->query_result;
		$this->backtrace();
		if ($failed) {
			$this->all_queries[$this->file][$this->num_queries] = '<span class="error thick">FAILED LINE ' . $this->line . ' - File: ' . $this->file . '</span><br />' . htmlspecialchars($query, ENT_QUOTES);
		} else {
			$this->all_queries[$this->file][$this->num_queries] = '<span class="thick">LINE ' . $this->line . ' - File: ' . $this->file . '</span><br />' . htmlspecialchars($query, ENT_QUOTES);
			$this->all_queries[$this->file][$this->num_queries] .= '<br />QTIME:' . substr($this->qtime, 0, 5);
			if (is_object($query_id)) $this->all_queries[$this->file][$this->num_queries] .= '[' . $numrows . ' results]';
		}
	}

	/**
	* Determines the filename and line of code where called and stores them.
	*/
	public function backtrace() {
		$this->file = 'unknown';
		$this->line = 0;
		if (version_compare(phpversion(), '4.3.0', '>=')) {
			$tmp = debug_backtrace();
			for ($i=0; $i < count($tmp); ++$i) {
				if (!preg_match('#[\\\/]{1}includes[\\\/]{1}db[\\\/]{1}[a-z_]+.php$#', $tmp[$i]['file'])) {
					$this->file = $tmp[$i]['file'];
					$this->line = $tmp[$i]['line'];
					break;
				}
			}
		}
	}

	/**
	* Get datatype name from numeric value
	*
	* @param int $key numeric value of datatype
	*/
	public function get_data_type($key) {
		$dataTypes = array(
		0=>'decimal',
		1=>'tinyint',
		2=>'smallint',
		3=>'int',
		4=>'float',
		5=>'double',
		7=>'timestamp',
		8=>'bigint',
		9=>'mediumint',
		10=>'date',
		11=>'time',
		12=>'datetime',
		13=>'year',
		14=>'newdate',
		16=>'bit',
		246=>'newdecimal',
		247=>'enum',
		248=>'set',
		249=>'tinyblob',
		250=>'mediumblob',
		251=>'longblob',
		252=>'blob',
		253=>'varchar',
		254=>'char',
		255=>'geometry'
		);
		$type = empty($dataTypes[$key]) ? 'unknown' : $dataTypes[$key];
		return $type;
	}

	/**
	* Prepared Statements Functions Only Below This Line
	*/

	/**
	* Prepare an SQL statement for execution.
	* Silimar to mysqli_stmt_prepare().
	*
	* @param string $query the query string
	*/
	// PHP8 Deprecated: Return type should either be compatible with mysqli::prepare(string $query): mysqli_stmt|false
	// Fix for php8: public function prepare($query): mysqli_stmt|false {
	// Backwards compatibility for php7: #[\ReturnTypeWillChange]
	#[\ReturnTypeWillChange]
	public function prepare($query) {
		$this->preparedStatement = $query;
		$this->stmt_obj = parent::stmt_init();
		$this->stmt_obj->prepare($query);
		return $this->stmt_obj;
	}

	/**
	* Binds variables to a prepared statement as parameters.
	* Similar to mysqli_stmt_bind_param().
	*/
	public function bind_param() {
		$numargs = func_num_args();
		$arg_list = func_get_args();
		if($this->loglevel > 1) {
			for ($i = 1; $i < $numargs; $i++) {
				$params[] = $arg_list[$i];
			}
			$this->parameters = $params;
		}
		return call_user_func_array(array($this->stmt_obj, 'bind_param'), $arg_list);
	}

	/**
	* Executes a prepared Query.
	* Similar to mysqli_stmt_execute().
	*
	* This function automatically utilizes mysqli_stmt_store_result() and stores results if they are found.
	*/
	public function execute() {
		$this->num_queries++;
		if($this->loglevel > 1) {
			$params = count($this->parameters);
			$query = '';
			for($i = 0; $i < $params; $i++) {
				$query .= preg_replace('/\?/', $this->parameters[$i], $this->preparedStatement, 1);
			}
		}
		if ($this->loglevel == 3 || $this->loglevel == 4) {
				list($usec, $sec) = explode(' ', microtime());
				$time_start = ((float)$usec + (float)$sec);
				$result = $this->stmt_obj->execute();
				list($usec, $sec) = explode(' ', microtime());
				$time_end = ((float)$usec + (float)$sec);
				$this->qtime = number_format($time_end - $time_start, 10, '.', '');
				$num = $this->stmt_obj->num_rows;
				$this->backtrace_log($query, $num);
		} else {
			$result = $this->stmt_obj->execute();
		}
		if ($this->loglevel == 2 || $this->loglevel == 4) {
				if ($this->loglevel == 2) $this->backtrace();
				$logvar = date('F j, Y, g:i a') . "\n" ;
				$logvar .= 'File: '. $this->file . ' - Line: ' . $this->line . "\n";
				$logvar .= 'SQL was: ' . preg_replace('/\s+/u', ' ', trim($query)) . "\n";
				$logvar .= 'querycount = ' . $this->num_queries . "\n";
				$fplog = fopen(NUKE_BASE_DIR . 'rnlogs/dblog', 'a');
				fwrite($fplog, $logvar . "\n");
				fclose($fplog);
			}
		if ($result) {
			$this->stmt_obj->store_result();
			return true;
		} else {
			$error = $this->sql_error();
			if ($this->loglevel < 0) {
				$params = count($this->parameters);
				$query = '';
				for($i = 0; $i < $params; $i++) {
					$query .= preg_replace('/\?/', $this->parameters[$i], $this->preparedStatement, 1);
				}
				$this->backtrace();
				$logvar = date('F j, Y, g:i a') . ' ' ;
				$logvar .= 'File: '. $this->file . ' - Line: ' . $this->line . "\n";
				$logvar .= 'Code: ' . $error['code'] . ' - Message: ' .  $error['message'] . "\n";
				$logvar .= 'SQL was: ' . preg_replace('/\s+/u', ' ', trim($query)) . "\n";
				$logvar .= ' remote addr: ' . $_SERVER['REMOTE_ADDR'];
				$fplog = fopen(NUKE_BASE_DIR . 'rnlogs/dblog', 'a');
				fwrite($fplog, $logvar . "\n");
				fclose($fplog);
			}
			return false;
		}
	}

	/**
	* Fetch an associative array of results from a prepared statement.
	*
	* You do not $db->bind_results(...) before usig this function.
	*
	* Example of use:
	* <code>
	* while ($row = $stmt->fetch_stmt_assoc()) {
	* 	$foo[] = $row['foo'];
	* }
	* </code>
	*/
	public function fetch_stmt_assoc() {
		/**
		* Checks to see if the variables have already been bound.
		*/
		if (!$this->varsBound) {
			$meta = $this->stmt_obj->result_metadata();
			while ($column = $meta->fetch_field()) {
				/**
				* This is to stop a syntax error if a column name has a space.
				*/
				$columnName = str_replace(' ', '_', $column->name);
				$bindVarArray[] = &$this->results[$columnName];
			}
			call_user_func_array(array($this->stmt_obj, 'bind_result'), $bindVarArray);
			$this->varsBound = true;
		}

		if ($this->stmt_obj->fetch() != null) {
			foreach ($this->results as $k => $v) {
				$results[$k] = $v;
			}
			return $results;
		} else {
			return array();
		}
	}
}

?>