<?php

/**
 * \brief The database handler
 * 
 * This variable is global to avoid a new connection on each Model instantiation
 * or query call.
 * 
 * */
$_dbHandle = null;

/**
 * \brief The Model class
 * 
 * 
 * This class access the database and provides the main functionalities 
 * to manage the database.
 * 
 * This class can insure any SQL command.
 * 
 * An example:
 * 
 *     $m = new Model('table1');
 *     $r = $m->select();
 *     print_r($r); //$r is an array with all cols and lines of table1
 * 
 * Another example
 * 
 *     $m = new Model('table1');
 *     $r = $m->query_ar('SELECT * from table2, table3 where table2.id = table3.t2_id');
 *     print_r($r); //$r is an array with all the result.
 * 
 * 
 * */
class Model {

    /** Propriedades */
    protected $_prop; ///< The cols of the table
    protected $_proptype; ///< the type of each col
    protected $_usehtmlentities = true;
    protected $editing = false;

    public function get_usehtmlentities() {
        return $this->_usehtmlentities;
    }

    public function set_usehtmlentities($_usehtmlentities) {
        $this->_usehtmlentities = $_usehtmlentities;
    }

    /**
     * 
     * \brief Access the database on specific table.
     * 
     * Accessing a specific table do means you can only manage this table.
     * 
     * 
     * 
     * */
    function __construct($tablename = "") {
        if ($tablename == "") {
            $this->_model = get_class($this);
            $this->_table = strtolower($this->_model) . "s";
            $this->_prop = array();
        } else {
            $this->_model = $tablename;
            $this->_table = $tablename;
            $this->_prop = array();
        }
    }

    function connect($address = DB_HOST, $account = DB_USER, $pwd = DB_PASS, $name = DB_NAME) {
        global $_dbHandle;
        if ($_dbHandle == null) {

            $_dbHandle = @mysqli_connect($address, $account, $pwd);
            if ($_dbHandle) {
                if (mysqli_select_db($_dbHandle, $name)) {
                    return 1;
                }
            }
            echo "Ops, infelizmente nosso servidor est&aacute; com 
			algum problema. Por favor volte daqui a pouco.";
            exit;
            return 0;
        }
        return 1;
    }

    /**
     * \brief Set a col of the table passed in @ref __construct.
     * 
     * \param[$att] The col.
     * \param[$val] The value
     * 
     * */
    function set($att, $val) {
        $this->_prop[$att] = $val;
        /*
        if($att == "id" && strlen(trim($val)) > 1){
            $this->editing = true;
        }
         * 
         */
    }

    /**
     * \brief Get all cols of the table passed in @ref __construct.
     * 
     * */
    function getProp() {
        $res = $this->query('SHOW COLUMNS FROM ' . $this->_table);
        $a = $this->toArray($res);
        foreach ($a as $k => $v) {
            $this->_prop[$v["Field"]] = "";
            $this->_proptype[$v["Field"]] = $v["Type"];
        }

        //print_r($this->_prop);
    }

    /**
     * \brief Set all cols throuht an array which keys has the same name 
     * of the cols.
     * 
     * With this function you can pass all data of the $_POST in one time.
     * Avoiding to many call to @ref set.
     * 
     * You can pass all data of a form with only one line: `$m->setAll($_POST)`.
     * 
     * As this function is usually instantiated inside a controller, is a best practice 
     * to use the filtered user input provided by the controller: `$m->setAll($this->_post)`.
     * 
     * \param[$att] The array with all the data. If a key of $att doesn't exists in the cols, it will be ignored.
     * If $att doesn't contains all the cols, the original values of these cols will not be changed (if exists, otherwise the database will use the default).
     * 
     * */
    function setAll($att) {
        if (!$this->editing)
            $this->getProp();

        foreach ($this->_prop as $k => $v) {
            if (isset($att[$k])) {
                $this->_prop[$k] = $att[$k];
                //$this->set($k, $att[$k]);
            } else {
                if (!$this->editing)
                    unset($this->_prop[$k]);
            }
        }
    }

    /**
     * \brief Get the value of a col.
     * 
     * After insuring @ref load, you can take the value of any col using this function.
     * 
     * */
    function get($att) {
        return $this->_prop[$att];
    }

    function getAll() {
        return $this->_prop;
    }

    /**
     * 
     * \brief Execute a custom query.
     * 
     * */
    function query($qr) {
        global $_dbHandle;
        $this->connect();
        $r = mysqli_query($_dbHandle, $qr);

        if ($r === FALSE) {
            print("query error");
            echo mysqli_error($_dbHandle);
            echo $qr;
            die();
        }
        return $r;
    }

    function setTimeZone($t) {
        return $this->query("SET time_zone = \"" . $t . "\"");
    }

    function getTime() {
        return $this->query_ar("select now() as date");
    }

    function query_ar($qr) {
        return $this->toArray($this->query($qr));
    }

    /** Load the model by 'id' */
    function load($id) {
        global $_dbHandle;
        $this->connect();
        $r = $this->query("select * from " . $this->_table . " where id='" . mysqli_real_escape_string($_dbHandle, $id) . "'");
        $data = $this->getRow($r);
        $this->_prop = array();
        if (isset($data) and count($data) > 0 and $data != null) {
            foreach ($data as $k => $v) {
                $this->_prop[$k] = $v;
            }
        }else{
            return false;
        }
        $this->editing = true;
        return true;
    }

    function reload() {
        $this->load($this->get("id"));
    }

    /** Persist the model, inserting or updating if 'id' exists. */
    function persist($getsql = false) {
        global $_dbHandle;

        $sql = "";
        $cols = "";
        $vals = "";
        $res = null;


        if (!isset($this->_prop["id"]) or $this->_prop["id"] == null or $this->_prop["id"] == '' or ! $this->editing) {
            //$this->_prop["id"] = Date("YmdHsi").rand(0,9999)."-".rand(0,99);
            if (!isset($this->_prop["id"]) or $this->_prop["id"] == null or $this->_prop["id"] == '') {
                $this->_prop["id"] = Date("YmdHsi") . str_pad(rand(0, 9999), 4, "0", STR_PAD_LEFT);
            }

            foreach ($this->_prop as $k => $v) {
                $cols = $cols . "," . mysqli_real_escape_string($_dbHandle, $k);
                $vals = $vals . ",'" . mysqli_real_escape_string($_dbHandle, $v) . "'";
            }
            $cols[0] = ' ';
            $vals[0] = ' ';

            $sql = "insert into " . $this->_table . "(" . $cols . ") values(" . $vals . ")";
        } else {
            foreach ($this->_prop as $k => $v) {
                if ($k != "id")
                    $vals = $vals . "," . $k . "='" . $v . "'";
            }
            $vals[0] = ' ';
            $sql = "update " . $this->_table . " set " . $vals . " where id='" . $this->_prop["id"] . "'";
        }
        //echo $sql;
        if ($getsql) {
            return $sql;
        }
        $res = $this->query($sql);
        return $res;
    }

    function delete($id = "") {
        if ($id == "") {
            $sql = "delete from " . $this->_table . " where id='" . $this->_prop["id"] . "'";
        } else {
            $sql = "delete from " . $this->_table . " where id='" . $id . "'";
        }
        return $this->query($sql) === TRUE;
    }

    function count($where) {
        $first = true;
        $table = $this->_table;
        $w = "";
        if ($where != null) {
            foreach ($where as $k => $v) {
                if ($first) {
                    $w = $k . "=" . "\"" . $v . "\"";
                    $first = false;
                } else {
                    $w = $w . " AND " . $k . "=" . "\"" . $v . "\"";
                }
            }
        }
        if ($where == null) {
            $sql = "SELECT count(*) as qtd FROM $table;";
        } else {
            $sql = "SELECT count(*) as qtd FROM $table WHERE $w;";
        }
        $res = $this->toArray($this->query($sql));
        // $i = 0;

        return $res[0]["qtd"];
    }

    /** Perform a select. */
    function select($where = null, $order = null, $from = null, $count = null) {
        $first = true;
        $table = $this->_table;
        if ($order != "" and $order != null)
            $order = "order by $order";
        $w = "";
        if ($where != null) {
            foreach ($where as $k => $v) {
                if ($first) {
                    $w = $k . "=" . "\"" . $v . "\"";
                    $first = false;
                } else {
                    $w = $w . " AND " . $k . "=" . "\"" . $v . "\"";
                }
            }
        }
        if ($where == null) {
            $sql = "SELECT * FROM $table $order";
        } else {
            $sql = "SELECT * FROM $table WHERE $w $order";
        }

        if ($count != null) {
            $sql = $sql . " limit $from, $count";
        }

        $res = $this->query($sql);
        // $i = 0;

        return $this->toArray($res);
        /*
          while($row = mysql_fetch_array($res, MYSQL_ASSOC)){
          $j=0;
          foreach($row as $k=>$v){
          $r[$i][$k] = $v;
          $j++;
          }
          $i++;
          }
          return $r;
         * 
         */
    }

    /** MySQL result to array */
    function toArray($res) {
        //$res = db_execute($sql);
        $i = 0;
        $r = null;
        while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
            $j = 0;
            foreach ($row as $k => $v) {
                if (!$this->_usehtmlentities) {
                    $r[$i][$k] = $v;
                } else {
                    $r[$i][$k] = htmlspecialchars($v);
                }
                $j++;
                //echo $v . "<br>";
            }
            $i++;
        }
        return $r;
    }

    /** Search - nao implementado */
    function search($term, $where = null, $onCols = null, $from, $count) {
        $first = true;
        $table = $this->_table;
        $w = "";
        if ($where != null) {
            foreach ($where as $k => $v) {
                if ($first) {
                    $w = $k . "=" . "\"" . $v . "\"";
                    $first = false;
                } else {
                    $w = $w . " AND " . $k . "=" . "\"" . $v . "\"";
                }
            }
        }
        if ($where == null) {
            $sql = "SELECT * FROM $table";
        } else {
            $sql = "SELECT *  FROM $table WHERE $w";
        }

        $s = "";
        $first = true;

        foreach ($onCols as $k => $v) {

            foreach ($term as $l => $m) {

                if ($first) {
                    $s = $s . " $v LIKE '%$m%' ";
                    $first = false;
                } else {
                    $s = $s . " OR $v LIKE '%$m%' ";
                }
            }
        }
        if ($s != "") {
            $sql = $sql . " AND( " . $s . ")";
        }


        $tcount = count($this->toArray($this->query($sql)));
        if ($count != null) {
            $sql = $sql . " limit $from, $count";
        }


        $r = $this->toArray($this->query($sql));
        $r["count"] = $tcount;
        return $r;
    }

    /** Num of rows. */
    function getNumRows($res) {
        return mysqli_num_rows($res);
    }

    function getRow($result) {
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return $row;
    }

}
