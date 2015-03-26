<a href="index.php?page=tasks&action=create">Create</a>

<table border="1px">
<tr>
<td>ID</td>
<td>Name</td>
<td>Description</td>
<td>Priority</td>
<td>Created</td>
<td><a href="http://localhost/todo/index.php?page=tasks&order=<?php echo toggle(); ?>"> Due Date</a></td>
<td colspan="2">Actions </td>
</tr>

    <?php 
    // getting data from a JSON file!
//              $tasks_json = file_get_contents('./data/tasks.json');
//            $tasks_arr = json_decode($tasks_json, TRUE);
        sortTasks($data, isset($_GET['order']) ? $_GET['order'] : 0);
        foreach($data as $item){
            echo '<tr><td>' . $item['id'] . 
                 '</td><td>' . $item['name'] . 
                 '</td><td>' . $item['description'] . 
                 '</td><td>' . $item['priority'] . 
                 '</td><td>' . $item['created'] . 
                 '</td><td>' . $item['dueDate'] . '</td>
                  <td><a href="index.php?page=tasks&action=update&id=' . $item['id'] . '">Update</a></td>
                  <td><a href="index.php?page=tasks&action=delete&id=' . $item['id'] . '">Delete</a></td>
                 </tr>';
        }
       // $t_id = $item['id'];
        // VIEW  from MVC
    ?>


</table>