<?class DB {

        protected static $_instance;  //экземпляр объекта
  
        public static function getInstance() { // получить экземпляр данного класса 
            if (self::$_instance === null) { // если экземпляр данного класса  не создан
                self::$_instance = new self;  // создаем экземпляр данного класса 
            } 
            return self::$_instance; // возвращаем экземпляр данного класса
        }
   
        private  function __construct() { // конструктор отрабатывает один раз при вызове DB::getInstance();
                $this->connect = mysql_connect(HOST, USER, PASSWORD) or die("Невозможно установить соединение".mysql_error());
                mysql_select_db(NAME_BD, $this->connect) or die ("Невозможно выбрать указанную базу".mysql_error());        
				mysql_set_charset("utf8");
        }
 
        private function __clone() { //запрещаем клонирование объекта модификатором private
        }
        
        private function __wakeup() {//запрещаем клонирование объекта модификатором private
        }
   
        public static function query($sql) {
        
            $obj=self::$_instance;
        
            if(isset($obj->connect)){ 
                $obj->count_sql++;
                $start_time_sql = microtime(true);
                $result=mysql_query($sql)or die("<br/><span style='color:red'>Ошибка в SQL запросе:</span> ".mysql_error());
                $time_sql = microtime(true) - $start_time_sql;
                
                return $result;
            }
            return false;
        }   
    
        //возвращает запись в виде объекта
        public static function fetch_object($object)
        {
            return @mysql_fetch_object($object);
        }
		
		public static function num_rows($object)
        {
            return @mysql_num_rows($object);
        }

        //возвращает запись в виде массива
        public static function fetch_array($object)
        {
            return @mysql_fetch_array($object);
        }
        public static function fetch_assoc($object)
        {
            return @mysql_fetch_assoc($object);
        }
		
		public static function update($data, $table, $where) {
			foreach ($data as $column => $value) {
			$sql = "UPDATE $table SET $column = $value WHERE $where";
			mysql_query($sql) or die(mysql_error());
			}
			return true;
		}
        
        //mysql_insert_id() возвращает ID, 
        //сгенерированный колонкой с AUTO_INCREMENT последним запросом INSERT к серверу
        public static function insert_id()
        {
            return @mysql_insert_id();
        }
        
    
}
?>