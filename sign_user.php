<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>马牛逼的留言板</title>
</head>
<body>
<!--创建表单-->
<h1 align="center">注册用户</h1>
<form method="post">
    <div align="center">用户名：<input type="text" name="user_name" maxlength="10" placeholder="请输入用户名(不超过10个字符)" required="required"></input></div>
    <p><p><p><p>
    <div align="center">账户id:<input type="number" name="user_id" min="1" max="999999999" placeholder="请输入账户id(整数)" required="required"></div>
    <p><p><p><p>
    <div align="center">密码1：<input type="password" name="user_pwd_1" maxlength="10" placeholder="请输入密码(不超过10个字符)" required="required" ></div>
    <div align="center">密码2：<input type="password" name="user_pwd_2" maxlength="10" placeholder="请再次输入密码(不超过10个字符)" required="required" ></div>
    <p><p><p><p>
    <div align="center"><input type="submit" name="submit" value="注册"></div>
    <p><p><p><p>
    <div align="center"><a href="index.php">点击跳转至登录页面</a></div>
</form>
</body>
</html> 

<?php
    //启用session
    session_start();
    //session_destroy();
    //提交表单
    if($_POST['submit']=='注册')
    {
        $e1_user_name=addslashes($_POST['user_name']);
        $e2_user_name=addcslashes($e1_user_name,'<,>,.?;:][}{|!@#$%^&*`~/()');
        $e_user_id=(int)$_POST['user_id'];
        $e1_user_pwd_1=addslashes($_POST['user_pwd_1']);
        $e2_user_pwd_1=addcslashes($e1_user_pwd_1,'<,>.?;:][}{|!@#$%^&*`~/()');
        $e1_user_pwd_2=addslashes($_POST['user_pwd_2']);
        $e2_user_pwd_2=addcslashes($e1_user_pwd_2,'<,>,.?;:][}{|!@#$%^&*`~/()');
        
        //引用功能文件
        $_SESSION['token']="A132465798A";
        include("php/function/f_sign_user.php");
        //创建实例
        $mysql_op=new mysql_class_1();
        $mysql_op->sign_user($e2_user_name,$e_user_id,$e2_user_pwd_1,$e2_user_pwd_2);
        $_SESSION['token']="0";
    }
?>