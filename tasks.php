<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php include './data.php'; ?>
<?php include './functions.php'; ?>
<!--
<?php print_r($menu); ?>
<?php var_dump($menu); ?>
-->


<html>
    <head>
        <meta charset="UTF-8">
        <title>ToDo</title>
        <link rel="stylesheet" href="css/styles.css" />   
    </head>
    <body>
        <div class="container">
            <div class="top">  
            <div class="imag"> <img src="CSS/Eigen_Owl_Todo.png" alt="buhal"></div>   
                <div class="date"> 
                 <!-- 2015-01-15 20:59  -->
                  <?php 
                    echo date('D / d M Y : H i s', time() + 3600);
                  ?>
                </div>
                <div  class="login">
                    <form action="index.php" method="POST">
                        User: <input size="12" type="text" name="username" />
                        <br />
                        Pass: <input size='12' type="password" name="password" />
                        <br />
                        <input width="20px" type="submit" value="Authenticate" />
                        <br />
                        <?php echo $_POST['username']; ?>
                        <?php echo $_POST['password']; ?>
                    </form>
                </div>
                <div class="menu"> 
                    <ul>
                        <?php                            
                            foreach ($menu as $item) {
                                    echo '<li><a href="' . $item['link'] . '">' . $item['name'] . '</a></li>';
                                   
                                }
                        ?>
                        <!--
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Tasks</a></li>
                        <li><a href="#">Finished</a></li>
                        <li><a href="#">Statistics</a></li>
                        -->
                    </ul>
                    <div class="greeting">Hello dear <?php echo  $username . '!'; ?></div>
                </div>
            </div>
            <div class="body"> --------  
                <form action="index.php" method="POST"> 
                    <br />
                   Search: <input type="text" name="search" />
                   <input type="submit" value="Go" />
                   
                </form>
                <?php //echo $_POST['search']; ?>
                
                <br />
                
                

            
            </div>
            
        </div>
        <?php
        // put your code here
        $i = '3';
        settype($i,'float');
      //  var_dump($i);
        //var_dump((int)'100');
      //  var_dump(ord('a'));
        
        ?>
    </body>
</html>
