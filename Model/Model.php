<?php


namespace TestApp;


abstract class Model implements ModelInterface
{
    public static $table_name = null;
    public static $saved_fields = null;
    private static $connection = null;

    /**
     * @var integer
     */
    protected $id;

    /**
     * Model constructor.
     */
    public function __construct()
    {

    }

    /**
     * @throws \Exception
     */
    private static function preRequest()
    {
        if (self::$connection == null) {
            self::$connection = DbConnection::getInstance()->getConnection();
        }

        if (is_null(self::$connection)) {
            throw new \Exception("Is not connected to DB");
        }

        if (is_null(static::$table_name)) {
            throw new \Exception("Table name is not set");
        }
    }

    public function saveAttributes(array $values)
    {
        foreach ($values as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    public function save()
    {
        if (is_null($this->id)) {
            $this->insert();
        } else {
            $this->update();
        }
    }


    public static function get(array $options = []): array
    {
        self::preRequest();
        $query = sprintf("select %s from %s", "*", static::$table_name);

        if (!empty($options)) {
            $clauses = [];
            foreach ($options as $optionKey => $optionValue) {
                $clauses[] = "{$optionKey} = :{$optionKey}";
            }
            $query .= " where " . implode(' and ', $clauses);
        }
        $stmt = self::$connection->prepare($query);
        $stmt->execute($options);
        return array_map(function($item) {
            /** @var Model $value */
            $value = new static();
            $value->saveAttributes($item);
            return $value;}, $stmt->fetchAll());
    }

    public static function getOne(array $options = []) : ?object
    {
        $result = self::get($options);
        return isset($result[0]) ? $result[0] : null;
    }

    public function insert()
    {
        self::preRequest();

        if (is_null(static::$saved_fields)) {
            throw new \Exception("Table fields is not set");
        }

        $clauses = [];
        $values = [];
        foreach (static::$saved_fields as $field) {
            $values[$field] = !is_null($this->{$field}) ? $this->{$field} : null;
            $clauses[] = ":{$field}";
        }

        $query = sprintf("insert into %s (%s) values (%s)", static::$table_name,
            implode(',', static::$saved_fields), implode(',', $clauses));
        $stmt = self::$connection->prepare($query);
        $stmt->execute($values);
    }

    public function update()
    {
        self::preRequest();

        if (is_null(static::$saved_fields)) {
            throw new \Exception("Table fields is not set");
        }

        $clauses = [];
        $values = [];
        foreach (static::$saved_fields as $field) {
            $values[$field] = !is_null($this->{$field}) ? $this->{$field} : null;
            $clauses[] = "{$field} = :{$field}";
        }
        $values['id'] = $this->id;
        $query = sprintf("update %s set %s where id = :id", static::$table_name, implode(',', $clauses));
        $stmt = self::$connection->prepare($query);
        $stmt->execute($values);
    }

    public function remove()
    {
        self::preRequest();
        //Операции такой не было в задании, но без этой функции интерфейс выглядит неполным
    }

}