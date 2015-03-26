<?php


/* 
 * 
 * this Function sorts the tasks by date 
 * @param $tasks - array to be sorted
 * @param $order - 0 for ascending order, 1 - for descending order
 * @return array - returns the sorted array 
 */

//Func soft by date   0 -> vuzhodqsht , default value 

//MODEL
abstract class Model {
    private $id;
    
    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }


}

class User extends Model {
    private $id;
    private $username;
    private $password;
    
   
    function getUsername() {
        return $this->username;
    }

    function getPassword() {
        return $this->password;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setUsername($username) {
        $this->username = $username;
    }

    function setPassword($password) {
        $this->password = $password;
    }
    
    // check user input against the tasks.user : 
    function loginUser(){
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $user = User::getUser();
            $mysql_q1 = 'select username,password from todo.user where username="' . $user['username'] . '" and password="' . $user['password'] . '";';
        
            $connection = dbOperations::dbConnect();
            $result = mysql_query($mysql_q1,$connection);
        
            if (mysql_num_rows($result) == 0) {
                echo "No such user!";
            } else {
                $user_db = mysql_fetch_row($result);        
            }
        
            mysql_close($connection);
      
            $_SESSION['username'] = $user_db[0];
      
            Tasks::redirectPostListTasks();
        }
    } //end of loginUser()
    
    function logoutUser(){
       if(isset($_SESSION['username'])){
            session_destroy();
        }
        Tasks::redirectPostListTasks();
    }  // end of logoutUser
    
    //get user from FORM
    function getUser(){
    //    $user = new User();
    //    $user->setUsername($_POST['username']);
    //    $user->setPassword($_POST['password']);
    //    return $user;

        return $user = array(
            'username' => $_POST['username'],
            'password' => $_POST['password'],
        );
    }
    
    function listHome(){
        if(!isset($_SESSION['username'])){
            echo "In listHome <br />";
            include './home.php';
        }

    } 
    function listregformHome(){
       // just include registerform
        echo "In listregformHome <br />";
        include './register.php';
    }

    function registerHome(){
        // new user registration into system
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        //check if user exists in db
        $connection = dbOperations::dbConnect();
        $sql1 = 'SELECT username FROM todo.user WHERE username="' . $_POST['username'] . '";';
        $sql_rsc1 = mysql_query($sql1, $connection);
        $usr1 = mysql_result($sql_rsc1,0);

        if($usr1 == $_POST['username']) {
            //echo $usr1;
            //var_dump($usr1);
            echo "Username already exists! <br />"; // NOT PRINTED ON PAGE !!!!
            //exit;

        } else {
            //maybe to check if pass1 == pass2
            $sql2 = 'INSERT INTO todo.user (username, password) VALUES ("' . $_POST['username'] . '","' . $_POST['password1'] . '")';
            mysql_query($sql2,$connection);
            echo "New account $usr1 has been created successfully! <br />";
        }

        mysql_close($connection);
        //redirectPostListTasks('home');

        if (headers_sent()) {
        die("Redirect failed. Please click on this link: <a href=\"localhost/index.php?page=home\">");
    }
    else{
        exit(header("Location: /index.php?page=home"));
    }
        }
    }



} // End of class User

class Tasks extends Model {
    private $name;
    private $description;
    private $priority;
    private $created;
    private $dueDate;
    
    function getName() {
        return $this->name;
    }

    function getDescription() {
        return $this->description;
    }

    function getPriority() {
        return $this->priority;
    }

    function getCreated() {
        return $this->created;
    }

    function getDueDate() {
        return $this->dueDate;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function setPriority($priority) {
        $this->priority = $priority;
    }

    function setCreated($created) {
        $this->created = $created;
    }

    function setDueDate($dueDate) {
        $this->dueDate = $dueDate;
    }
    
    function sortTasks(&$data, $order){
  
        sort1($data,$order);
    
    }
    
    // sortirame po dueDate
    function sort1(&$data, $order){
        $dates = array();
        foreach($data as $key => $value){
            $dates[$key] = $value['dueDate'];
        }
        // print_r($dates);
        array_multisort($dates, $order == 0 ? SORT_ASC : SORT_DESC, SORT_STRING, $data);
    }   
    
    function toggle(){
        if (isset($_GET['order'])){
            return $_GET['order'] == 0 ? 1 : 0;
            //return !$_GET['order'];
        }
        return 1;
    }
///////////
    
    function listTasks() {
   
    $connection = dbOperations::dbConnect();
    
    if(isset($_SESSION['username'])) {
        $sql1 = 'select id from todo.user where username="' . $_SESSION['username'] . '";';
        $sql1_res = mysql_query($sql1,$connection);
        $usr_id = mysql_result($sql1_res, 0);
    } else {
        echo "Please Log in to see your tasks! <br />";
    } 
    
    // for Guest user
    if (!isset($usr_id)) {
      $usr_id = 0;  
    } 
        $q_usr_tasks = 'select * from todo.tasks where userid="' . $usr_id . '";';
        $result = mysql_query($q_usr_tasks,$connection);
   
    $tasks = array();
    while($task = mysql_fetch_assoc($result)){
        $tasks[] = $task;
    }
      
    mysql_close($connection);     
    return $tasks;
    } //end of listTasks  
    
    /////////////  createTasks  /////////////////
    function createTasks(){
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){        
                $task = array (     // TO CLARIFY :  MUST define class TASKS  with all of its Properties and Methods ????!! 
                      //'id' => $_POST['id'],    // TODO generate sequential ID from the database
                       'name' => $_POST['name'],
                       'description' => $_POST['description'],
                       'priority' => $_POST['priority'],
                      // 'created' => $_POST['created'],
                       'dueDate' => $_POST['dueDate'],  
                    
        );   
         
        $connection = dbOperations::dbConnect();
       
        $mysql_q3 = 'select id from user where username="' . $_SESSION['username'] . '";';
        $userid_rsc = mysql_query($mysql_q3, $connection);
        $userid = mysql_result($userid_rsc,0);
  
        $sql = 'insert into todo.tasks (userid, name, description, priority, dueDate) VALUES '
              . '(' . $userid . ', "' . $task['name'] . '", "' . $task['description'] . '", ' . $task['priority'] . ', "' . $task['dueDate'] . '")';  
 
        mysql_query($sql,$connection);
        mysql_close($connection);
        
        Tasks::redirectPostListTasks();
    
        }    
  
    }
    
    function updateTasks(){
        //get tasks from JSON file and put to $tasks Array
        if (isset($_GET['id'])){
            $task_id = $_GET['id'];
        } else {
            echo "Error  BE!";
        }


        if($_SERVER['REQUEST_METHOD'] === 'GET'){

            $mysql_q2 = 'select * from tasks where id=' . $task_id . ';';    

            $connection = dbOperations::dbConnect();
            $result = mysql_query($mysql_q2, $connection);
            $tasks = array();
            $task = mysql_fetch_assoc($result);


            mysql_close($connection);
        return $task;

        } else  if ($_SERVER['REQUEST_METHOD'] === 'POST'){

                    $task = fetchTaskPostData();
                    //$mysql_q2 = sprintf('update tasks(name, description, priority, dueDate)'
                    //    . 'values("%s","%s","%s","%s")', $task['name'], $task['description'], $task['priority'], $task['dueDate'] );
                    $mysql_q2 = 'update tasks set name="' . $task['name'] . '", description="' . $task['description'] . '", priority="' . 
                            $task['priority'] . '" , dueDate="' . $task['dueDate'] . '" where id="' . $task_id . '";';

                    echo $mysql_q2;

                    $connection = dbOperations::dbConnect();
                    mysql_query($mysql_q2,$connection);
                    mysql_close($connection);

                    Tasks::redirectPostListTasks();
            }
    }  // End of updateTasks

    function deleteTasks(){
       // with SQL 
       if (isset($_GET['id'])){
           $task_id = $_GET['id'];
       }

      $mysql_q2 = 'delete from tasks where id=' . $task_id . ';';

      $connection = dbOperations::dbConnect();

      mysql_query($mysql_q2,$connection);  
      mysql_close($connection);

      header('Location: /todo/index.php?page=tasks');
      exit;  // za da ne tursi delete.php file ot processRequest funkciqta!!! 
    }

    
    function fetchTaskPostData(){
     return $task = array (
        //'id' => $_POST['id'],    // TODO generate sequential ID from the database
        'name' => $_POST['name'],
        'description' => $_POST['description'],
        'priority' => $_POST['priority'],
        //'created' => $_POST['created'],
        'dueDate' => $_POST['dueDate'],  
        );
    }
    
    function redirectPostListTasks($page = 'tasks'){
        header("Location: /todo/index.php?page=$page");
        exit;  // za da ne tursi delete.php file ot processRequest funkciqta!!
    }
    
} //END of CLASS Tasks

class Home {
    
}


class dbOperations {
    
    public static function dbConnect() {
            $connection = mysql_connect('localhost','root','');
        if ($connection == false) {
            echo "Error while connecting to the database!";
            exit;
        } 
    
        if (!mysql_select_db('todo',$connection)) {
            echo "ERROR while selecting DB!";
            exit;
        } 
    
        return $connection;
    } // end of dbConnect()

} // END of CLASS  dbOperations


class ProcessRequest {
    
    public static function processReq(){
        if (isset($_GET['page'])){
            $defaultAction = 'list';
            $page = $_GET['page'];
           // var_dump($page);
            $page_name = ucfirst($page);
            $page_obj = new $page_name;
            
            if (isset($_GET['action'])){
                $action = $_GET['action'];

                $function = $action . ucfirst($page);
                var_dump($action);

                $includeFile = "$page/$action";
                var_dump($includeFile);
            } else {
                $function  = $defaultAction . ucfirst($page);     
                $includeFile = "$page/$defaultAction";
            }
           // $data;
            $data = $function();

            if(!isset($_SESSION['username'])){
                //echo "Dear Guest, please Login to see your tasks!  <br />";
            } else {
                include "$includeFile.php";
           }
        } 
    }

    
    
}


