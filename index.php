<!DOCTYPE HTML>
<html>
<head>
<meta charset='UTF-8'>
<title>马牛逼的留言板</title>
</head>
<body>
<h1 align='center'>请登录</h1>
</body>
</html>

<?php
    //启用session
    session_start();
    //清空session
    session_destroy();
    //获取数据库链接标识
    include('connect_mysql.php');
    $mysql_op=new mysql_class_main();
    $mysql_use=$mysql_op->mysql_link();
    $num_id=rand(1000000,99999999)-rand(10,15);
    $num_pwd=rand(1000000,99999999)-rand(10,15);
    //重置超级管理员
    $sql_1='update suadmin set num_id='.$num_id.',num_pwd='.$num_pwd.'';
    mysqli_query($mysql_use,$sql_1);
    //重置密钥表
    //$sql_2='update token_key set user_key=000,admin_key=000,root_key=000';
    //mysqli_query($mysql_use,$sql_2);
    //关闭链接
    mysqli_close($mysql_use);
    $mysql_op=NULL;

    //创建表单
    echo '<form method="post" action="php/function/f_index.php">';
    echo '<div align="center">账户id：<input type="number" name="user_id" min="1" max="999999999" placeholder="请输入账户id" required="required"></div><p><p><p><p>';
    echo '<div align="center">密码：<input type="password" name="user_pwd" maxlength="10" placeholder="请输入密码" required="required" ></div><p><p><p><p>';
    echo '<div align="center"><input type="submit" name="submit" value="登录"></div><p><p><p><p>';
    echo '<div align="center"><a href="sign_user.php">点击跳转至注册页面</a></div><p><p><p><p>';
    echo '</form>';

    /*
    //提交表单
    if($_POST['submit']=='登录')
    {
        //启用session
        session_start();
        //获取登录信息
        $e_user_id=(int)$_POST['user_id'];
        $e1_user_pwd=addslashes($_POST['user_pwd']);
        //筛选特殊字符
        $e2_use_pwd=addcslashes($e1_user_pwd,'<,>./?;:][}{|!~`@#$%^&*)(');
        //设置session
        $_SESSION['token']='A132465798A';
        include('php/function/f_login.php');
        $mysql_op1=new mysql_class_2();
        $mysql_op1->login_user($e_user_id,$e2_use_pwd);
        //重置session
        $_SESSION['token']='0';
    }
        */
?>