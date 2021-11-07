<?php 
require_once 'functions.php';
require_once 'DatabaseClass/database.class.php';
$Operation = @$_GET['Operation'];

switch($Operation) {
case 'LangTR':
    $_SESSION['language'] = "TR";
    echo $_SESSION['language'];
break;
case 'LangEN':
    $_SESSION['language'] = "EN";
    echo $_SESSION['language'];
    break;
    case 'signup': 
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name_surname     =  post($_POST['name_surname']);
            $email            =  post($_POST['email']);
            $password         =  post($_POST['password']);
            $confirmPassword  =  post($_POST['confirm-password']);
            $encrypt          =  sha1(md5($password));
            $token            =  decrypt($_POST['token'], $key);
            $ip               =  IPAddress();
            $user_token       =  md5(uniqid());
            $activationLink   =  $link."activation/".$user_token;
            $content = "
                        <h3>".$array['verify-title']." ". $name_surname."!</h3><br><br>
                        ".$array['verify-content']."<br><br>
                        <a href='".$activationLink."'>Link</a>
                        ";
            if ($token  != $_SESSION['token']) {
                $dizi['result'] = $array['error'];
                $dizi['alert'] = "danger";
            }else {
                if(!isset($token)) {
                    $dizi['result'] = $array['error'];
                    $dizi['alert'] = "danger";
                }
                else {
                    if(empty($name_surname) or empty($email) or empty($password) or empty($confirmPassword)) {
                        $dizi['result'] = $array['empty'];
                        $dizi['alert'] = "danger";
                        $dizi['feedback'] = "empty";
                    }else {
	                if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                        $dizi['result'] = $array['email_filter'];
                        $dizi['alert'] = "warning";
                        $dizi['feedback'] = "email_filter";
                    }
                    else {
                        if($password != $confirmPassword) {
                        $dizi['result'] = $array['not-match'];
                        $dizi['alert'] = "warning";
                        $dizi['feedback'] = "not-match";
                        }else {
                        if(strlen($name_surname) < 5 || strlen($name_surname) > 30) {
                        $dizi['result'] = $array['name-surname-lenght'];
                        $dizi['alert'] = "warning";
                        $dizi['feedback'] = "name-surname-lenght";
                        }else {
                        if(strlen($email) < 5 || strlen($email) > 35) {
                        $dizi['result'] = $array['email-lenght'];
                        $dizi['alert'] = "warning";
                        $dizi['feedback'] = "email-lenght";
                        }else {
                        if(strlen($password) < 5 || strlen($password) > 30) {
                        $dizi['result'] = $array['password-lenght'];
                        $dizi['alert'] = "warning";
                        $dizi['feedback'] = "password-lenght";
                        }else {
                        $Query = $db->getColumn("SELECT COUNT(*) FROM members WHERE email=? AND status=?",array($email,"1"));
                            if($Query > 0 ) {
                        $dizi['result'] = $array['registered'];
                        $dizi['alert'] = "danger";
                        $dizi['feedback'] = "registered"; 
                        $VerifiedQuery = $db->getRow("SELECT status FROM members WHERE email=?",array($email));
                        if($VerifiedQuery->status == "0") {
                        SendMail($email,$array['verify-account'],$name_surname,$content);
                        $dizi['result'] = $array['resend-email'];
                        $dizi['alert'] = "success";
                        $dizi['feedback'] = "success";
                            }
                            }else {
                        $Insert = $db->Insert("INSERT INTO members SET
                        name_surname=?,
                        email=?,
                        password=?,
                        ip=?,
                        user_token=?  
                        ",array($name_surname,$email,$encrypt,IPAddress(),$user_token));
                        if($Insert) {
                        $dizi['result'] = $array['success'];
                        $dizi['alert'] = "success";
                        $dizi['feedback'] = "success"; 
                        SendMail($email,$array['verify-account'],$name_surname,$content);
                        }else {
                        $dizi['result'] = $array['error'];
                        $dizi['alert'] = "danger";
                        $dizi['feedback'] = "error"; 
                        }
                        }
                        }
                        }
                        }   
                        }
                    }
                    }
                }
            }
        echo json_encode($dizi);
        }
    break;
    case 'signin':
         if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email            =  post($_POST['email']);
            $password         =  post($_POST['password']);
            $encrypt          =  sha1(md5($password));
            $token            =  decrypt($_POST['token'], $key);
            $rowCount = $db->getColumn("SELECT COUNT(*) FROM members WHERE email=? AND password=?",array($email,$encrypt));
            $MemberQuery = $db->getRow("SELECT * FROM members WHERE email=?",array($email));
            
             if ($token  != $_SESSION['token']) {
                $dizi['result'] = $array['error'];
                $dizi['alert'] = "danger";
            }else {
                if(!isset($token)) {
                    $dizi['result'] = $array['error'];
                    $dizi['alert'] = "danger";
                }else {
                    if(empty($email) or empty($password)) {
                        $dizi['result'] = $array['empty'];
                        $dizi['alert'] = "danger";
                        $dizi['feedback'] = "empty";
                    }
                else {
                       if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                        $dizi['result'] = $array['email_filter'];
                        $dizi['alert'] = "warning";
                        $dizi['feedback'] = "email_filter";
                    }else {
                         if($MemberQuery->status == "0") {
                $dizi['result'] =  $array['not-email-verified'];
                $dizi['alert']  =  "danger";
                $dizi['feedback']  =  "danger";
            }
                else {
            if($rowCount > 0 ) {
                   $dizi['result'] = $array['success-login'];
                   $dizi['alert'] = "success";
                   $dizi['feedback'] = "success";
                   $_SESSION['login'] = true;
                   $_SESSION['id'] = $MemberQuery->id;
                   $_SESSION['name_surname'] = $MemberQuery->name_surname;
                   $_SESSION['email'] = $MemberQuery->email;
                   $_SESSION['password'] = $MemberQuery->password;

            }else {
                   $dizi['result'] = $array['not-found'];
                   $dizi['alert'] = "danger";
            }
                }
            }
        }   
    }
}
        echo json_encode($dizi);
         }
    break;
    case 'logout':
        unset($_SESSION['login']);
        unset($_SESSION['name_surname']);
        unset($_SESSION['email']);
        unset($_SESSION['password']);
        header("Location: ".$link."");

    break;
    case 'saveaccount': 
        if($_SERVER['REQUEST_METHOD'] == "POST") {
            $name_surname = post($_POST['name_surname']);
            $email = post($_POST['email']);
            $password = post($_POST['password']);
            $encrypt  = sha1(md5($password));
            $token     =  decrypt($_POST['token'], $key);

            if ($token  != $_SESSION['token']) {
                $dizi['result'] = $array['error'];
                $dizi['alert'] = "danger";
            }else {
                    if(!isset($token)) {
                    $dizi['result'] = $array['error'];
                    $dizi['alert'] = "danger";
                    }else {
                    if(strlen($email) < 5 || strlen($email) > 35) {
                    $dizi['result'] = $array['email-lenght'];
                    $dizi['alert'] = "warning";
                    $dizi['feedback'] = "email-lenght";
                    }
                       else {
            if(empty($name_surname) or empty($email)) {
                $dizi['result'] = $array['empty'];
                $dizi['alert'] = "danger";
            }else {
                if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
                    $dizi['result'] = $array['email_filter'];
                    $dizi['alert'] = "warning";
                    $dizi['feedback'] = "email_filter";
                }
                else {
                    if(strlen($name_surname) < 5 || strlen($name_surname) > 30) {
                        $dizi['result'] = $array['name-surname-lenght'];
                        $dizi['alert'] = "warning";
                        $dizi['feedback'] = "name-surname-lenght";
                        }
                else {
                    if(empty($password)) {
                $Update = $db->Update("UPDATE members SET name_surname=?,email=?",array($name_surname,$email));
                    $dizi['result'] = $array['save-changes-success'];
                    $dizi['alert'] = "success";
                    $dizi['feedback'] = "success";
                }else {
                     if(strlen($password) < 5 || strlen($password) > 30) {
                        $dizi['result'] = $array['password-lenght'];
                        $dizi['alert'] = "warning";
                        $dizi['feedback'] = "password-lenght";
                        }else {
                $Update = $db->Update("UPDATE members SET name_surname=?,email=?,password=?",array($name_surname,$email,$encrypt));
                    $dizi['result'] = $array['save-changes-success'];
                    $dizi['alert'] = "success";
                    $dizi['feedback'] = "success";
             }
            }
           }
          }
        }
      }
    }
  }
      echo json_encode($dizi);
    }
    break;
  case 'shortenurl': 
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $url = post($_POST['url']);
        $token  =  decrypt($_POST['token'], $key);
        $code = md5(uniqid());
		$redirectCode = substr($code, 0,6);
          if ($token  != $_SESSION['token']) {
                $dizi['result'] = $array['error'];
                $dizi['alert'] = "danger";
            }else {
                    if(!isset($token)) {
                    $dizi['result'] = $array['error'];
                    $dizi['alert'] = "danger";
                    }
                    else {
                        if(!@$_SESSION['login']) {
                            $dizi['result'] = $array['not-login'];
                            $dizi['alert'] = "danger";
                        }
                    else {
                        if(empty($url)) {
                            $dizi['result'] = $array['empty'];
                            $dizi['alert'] = "warning";
                        }else {
                        if(!filter_var($url,FILTER_VALIDATE_URL)) {
                            $dizi['result'] = $array['filter_url'];
                            $dizi['alert'] = "danger";
                            $dizi['feedback'] = "filter_url";
                        }else {
                            $Insert = $db->Insert("INSERT INTO links SET 
                            url=?,
                            member_id=?,
                            redirect_code=?
                            ",array($url,$_SESSION['id'],$redirectCode));
                            $dizi['result'] = $link."redirect/".$redirectCode;
                            $dizi['alert'] = "success";
                            $dizi['feedback'] = "success";
                        }
                      }
                    }
                }
                }   
                echo json_encode($dizi);
    }
  break;
  case 'redirecturl':
        if($_SERVER['REQUEST_METHOD'] == "POST") {
        echo $redirect_url = decrypt($_POST['redirect_url'], $key);
        $id = decrypt($_POST['id'], $key);
        $RowCount  = $db->getColumn("SELECT COUNT(*) FROM visitors INNER JOIN links ON visitors.visitor_link_id = links.id WHERE visitor_link_id=? AND ip=?",array($id,IpAddress()));
        if($RowCount < 1) {
        $UrlQuery = $db->getRow("SELECT * FROM links WHERE id=?",array($id));
        $visitors = $UrlQuery->visitors;
        $UpdateVisitors = $visitors+1;
        $Insert = $db->Insert("INSERT INTO visitors SET ip=?,visitor_link_id=?",array(IPAddress(),$id));
        $Update = $db->Update("UPDATE links SET visitors=? WHERE id=?",array($UpdateVisitors,$id));
        }
        }
 break;
 case 'refreshtable':
            $MemberLinks = $db->getRows("SELECT * FROM links WHERE member_id=?",array($_SESSION['id']));
                                foreach($MemberLinks as $row) {
                                    ?><tr id="<?=$row->id?>">
                                    <td style='text-align:left'><?=$row->url?></td>
                                    <td><?=$row->visitors?></td>
                                    <td><a href='".$link . "/redirect/".$row->redirect_code."'><?=$link . "redirect/" . $row->redirect_code?></td>
                                   <td><a href='javascript:void(0)' class='text-danger' onclick="Delete('<?=$row->id?>')">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                    </svg>
                                    </a>
                                </td>
                                    </tr> 
                                 <?php }
break;
case 'deleteurl':
    	$ID = $_GET['ID'];
		$delete = $db->Delete("DELETE FROM links WHERE id=?",array($ID));
		if ($delete) {
			$message = $array['delete-success'].":::success";
		}else {
			$message = 'Bir Hata Oluştu !:::danger';
		}
		echo $message;
break;
}
?>