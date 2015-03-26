<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php session_start(); ?>
<?php include './data.php'; ?>
<?php include './functions.php'; ?>

<?php //print_r($menu); ?>
<?php //var_dump($menu); ?>


<html>
    <head>
        <meta charset="UTF-8">
        <title>ToDo Obj</title>
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
                    
                    <?php if(!isset($_SESSION['username'])): ?>
                    <form action="index.php?page=user&action=login" method="POST">
                        User: <input size="12" type="text" name="username" />
                        <br />
                        Pass: <input size='12' type="password" name="password" />
                        <br />
                        <input width="20px" type="submit" value="Login" />
                        <br />
                    </form>
                     <?php endif; ?>
                    <?php if(isset($_SESSION['username']))   : ?>
                    <form action="index.php?page=user&action=logout" method="POST"> 
                        <input type="submit" value="Logout" />
                        <br />
                    </form>
                    <?php  endif;  ?>
                    
                </div>
                <div class="menu"> 
                    <ul>
                        <?php                            
                            foreach ($menu as $item) {
                                    echo '<li><a href="' . $item['link'] . '">' . $item['name'] . '</a></li>';
                                   
                                }
                        ?>
                    </ul>
                    <div class="greeting" id="loginForm">Authenticated user: <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : "guest"; ?></div>
                </div>
            </div>
            <div class="body">   
               
              <!--  
                
                <form action="index.php" method="POST"> 
                    <br />
                   Search: <input type="text" name="search" />
                   <input type="submit" value="Go" />
                   <br />
                </form>
              -->
              <?php 
           /*   if(!isset($_SESSION['username'])){
                  //echo "<br />";
                  //echo '<a href="index.php?">Register</a>';
                  include './home.php';
              }*/  
               ?>
                <?php 
                $us1 = new User();
                $task1 = new Tasks();
                
                ProcessRequest::processReq(); 
                
                
                ?>

                

            </div>
            
        </div>
 <script type="text/javascript" src="JS/main.js"></script>
    </body>
</html>
