<?php
class Task
{
    private $description;
    private $category_id;
    private $id;
    private $duedate;

//this creates our task with a name (description) and sets the id to a default value of null
    function __construct($description, $id = null, $category_id, $duedate)
    {
        $this->description = $description;
        $this->id = $id;
        $this->category_id = $category_id;
        $this->duedate = $duedate;
    }

//this sets the description as a string
    function setDescription($new_description)
    {
        $this->description = (string) $new_description;
    }

//this is the getter for the description
    function getDescription()
    {
        return $this->description;
    }

//this is the getter for the id
    function getId()
    {
        return $this->id;
    }

//this sets the id as an integer
    function setId($new_id)
    {
        $this->id = (int) $new_id;
    }

    function setCategoryId($new_category_id)
    {
        $this->category_id = (int) $new_category_id;
    }

    function getCategoryId()
    {
        return $this->category_id;
    }

    function getDuedate()
    {
        return $this->duedate;
    }

    function setDuedate($new_duedate)
    {
        $this->duedate = (string) $new_duedate;
    }

//this finds the id of tasks after they have been "transported" from the database into our code
    static function find($search_id)
    {
        $found_task = null;
        $tasks = Task::getAll();
        foreach($tasks as $task) {
            $task_id = $task->getId();
            if ($task_id == $search_id) {
                $found_task = $task;
            }
        }
        return $found_task;
    }

//this saves the entries in our form into the database
    function save()
    {
        $statement = $GLOBALS['DB']->query("INSERT INTO tasks (description, category_id, duedate) VALUES ('{$this->getDescription()}', {$this->getCategoryId()}, '{$this->getDuedate()}') RETURNING id;");
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $this->setId($result['id']);
    }

//this gets everything we've saved in the database and returns it to the array $tasks
//this is the "transporter" function
    static function getAll()
    {
        $returned_tasks = $GLOBALS['DB']->query("SELECT * FROM tasks ORDER BY duedate;");
        $tasks = array();
        foreach($returned_tasks as $task) {
            $description = $task['description'];
            $id = $task['id'];
            $category_id = $task['category_id'];
            $duedate = $task['duedate'];
            $new_task = new Task($description, $id, $category_id, $duedate);
            array_push($tasks, $new_task);
        }
        return $tasks;
    }

//this deletes the entries in the database
    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM tasks *;");
    }

}



?>
