<?php
use PHPMailer\PHPMailer\PHPMailer;

require 'PHPMailer.php';
date_default_timezone_set("Asia/Shanghai");
$cfg_dbhost = '127.0.0.1';
$cfg_dbname = 'day_job';
$cfg_dbuser = 'root';
$cfg_dbpwd = 'zheng';

function sendMail($mailBody, $mailSubject)
{
  $mail = new PHPMailer(); // Passing `true` enables exceptions
  $mail->isHTML(true);
  $mail->setFrom('zhengtianjie@me.com', 'zhengtianjie');
  $mail->addAddress('13007568302@163.com');
  $mail->addAddress('779220717@qq.com');
  $mail->Body    = $mailBody;
  $mail->AltBody = 'zheng';
  if(empty($mailSubject))
  {
    $mail->Subject = 'zheng';
  }
  else
  {
    $mail->Subject = $mailSubject;
  }
  $mail->send();
}
$mysqlConn = mysql_connect($cfg_dbhost, $cfg_dbuser, $cfg_dbpwd);
if(!$mysqlConn)
{
  die('Could not connect: ' . mysql_error());
}
mysql_select_db("day_job", $mysqlConn);
while(1)
{
$result = mysql_query("select * from plan where trigger_date = NOW()");
while($row = mysql_fetch_array($result))
{
 // echo "send mail" . $row['data'] . '\\\n';
  sendMail($row['data'], $row['subject']);
 // echo $row['trigger_date'] . '\t' . $row['data'] . '\n';
}
sleep(1);
}
mysql_close($mysqlConn);
//sendMail("zheng");
?>







