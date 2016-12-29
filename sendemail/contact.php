<?php
 
// Email address verification
function isEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}
 
if($_POST) {
 
    // Enter the email where you want to receive the message
    $sendtoemail = 'russell@sandrtechnology.com; soula@sandrtechnology.com';
 
    $clientName = addslashes(trim($_POST['name']));
    $clientEmail = addslashes(trim($_POST['email']));
    $sendFrom = 'contactform@sandrtechnology.com';
    $phone = addslashes(trim($_POST['phone']));
    $subject = addslashes(trim($_POST['subject']));
    $message = addslashes(trim($_POST['message']));
    $antispam = addslashes(trim($_POST['antispam']));
    $emailBody="    
       
        Name: $clientName
        Phone: $phone      
        
        $message  
      
   ";

    $array = array('nameMessage' => '', 'emailMessage' => '', 'subjectMessage' => '', 'messageMessage' => '', 'antispamMessage' => '');
 
    if($clientName == '') {
        $array['nameMessage'] = 'Empty name!';
    }
    if(!isEmail($clientEmail)) {
        $array['emailMessage'] = 'Invalid email!';
    }
    if($subject == '') {
        $array['subjectMessage'] = 'Empty subject!';
    }
    if($message == '') {
        $array['messageMessage'] = 'Empty message!';
    }
    if($antispam != '12') {
        $array['antispamMessage'] = 'Wrong antispam answer!';
    }
    if($clientName != '' && isEmail($clientEmail) && $subject != '' && $message != '' && $antispam == '12') {
        // Send email
        $headers = "From: " . $clientName . " <" . $sendFrom . ">" . "\r\n" . "Reply-To: " . $clientEmail;
        mail($sendtoemail, $subject, $emailBody, $headers);
    }
 
    echo json_encode($array);
 
}
 
?>