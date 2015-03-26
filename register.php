<form action="index.php?page=home&action=register" method="POST">
<table border="1px">
    <tr><td>Username</td>
        <td><input type="text" name="username" value="<?php echo isset($data['username']) ? $data['username'] : ''; ?>" /></td>
    </tr>
    <tr><td>Password</td>
        <td><input type="text" name="password1" value="<?php echo  isset($data['password1']) ? $data['password1'] : ''; ?>" /></td>
    </tr>
    
    <tr>
        <td colspan="2"><input type="submit" value="Register"/></td>
    </tr>
</table>
    
</form>