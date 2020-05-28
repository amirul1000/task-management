<?php
	if(isset($_POST) && !empty($_POST))
	{
		$mail_To="Admin@contractortrackerapp.com";
		$mail_From=$_POST['email'];
		$mailer_name=$_POST['name'];
		$mail_Cc=$mail_Bcc="";
		$mail_Subject=$_POST['subject'];
		$mail_Body="Dear Admin,<br/><br/>A new contact email is arrived. Following are the the details:<br/><strong>Name: </strong>".$mailer_name."<br/><strong>Email: </strong>".$mail_From."<br/><strong>Subject: </strong>".$mail_Subject."<br/><strong>Message: </strong><br/>".nl2br($_POST['message'])."<br/><br/>Thanks & Regards,<br/>Administrator<br/>Contractor Tracker";
		$mail_To=remove_tag($mail_To);
		$mail_From=remove_tag($mail_From);
		$mailer_name=remove_tag($mailer_name);
		$mail_Cc=remove_tag($mail_Cc);
		$mail_Subject=remove_tag($mail_Subject);
		$mail_Body=remove_tag($mail_Body);
		$mail_Bcc=remove_tag($mail_Bcc);
		$rn="\r\n";
		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' .$rn;
		$headers .= 'Content-type: text/html; charset=iso-8859-1' .$rn;
		// Create email headers
		$headers .= 'From: '.$mailer_name.'<'.$mail_From.">".$rn;
		$headers .= 'Reply-To: '.$mailer_name.'<'.$mail_From.">".$rn ;
		if($mail_Cc!="")
		{
			$headers .= 'Cc: '. $mail_Cc.$rn;
		}
		if($mail_Bcc!="")
		{
			$headers .= 'Bcc: '. $mail_Bcc.$rn;
		}
		$headers .= 'X-Mailer: PHP/' . phpversion();
		if(mail($mail_To, $mail_Subject, $mail_Body, $headers)){
			$mail_send_msg='<span style="color:green;">Thank you for contacting us. We will get back to you with in 24 hours.</span>';
		} else{
			$mail_send_msg='<span style="color:red;">We are having some problem in email sending. Please try later.</span>';
		}
	}
	$name="";
	function remove_tag($main_string)
	{
		$find = array("content-type","bcc:","to:","cc:","href");
		return str_replace($find,"",$main_string);
	}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Contact Us</title>
    <link rel="icon" href="images/front/favicon.png" type="image/ico" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0"/>
    <link rel="stylesheet" type="text/css" href="css/front/style_new.css" media="all" />
    <script type="text/javascript" src="js/front/jquery-1.9.1.min.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	<script src="js/front/jquery.validationEngine.js"></script>
    <script src="js/front/jquery.validationEngine-en.js"></script>
    <link rel="stylesheet" href="css/front/validationEngine.jquery.css">
	<script>
	$(document).ready(function(){
		$("#hiden").click(function(){
			$("#open").slideToggle();
		});
		$("#contact_form").validationEngine();
		setTimeout(function(){ $(".msg_cls").html(''); }, 15000);
	});
	</script>
	<style>
	.para {
		font-size: 17px;font-family: 'Roboto', sans-serif;
	}
	.field-error { border: 1px solid #ff2b2b !important; color: #c53333 !important; }
	.label-error,
	.label-error span { color: #c53333 !important; }
	.msg-alert,.msg-alert1,
	.msg-thanks {  height: 26px; background: #b70000; border-radius: 3px; -moz-border-radius: 3px; -webkit-border-radius: 3px; margin-bottom: 10px; display: none; }
	.msg-alert1{  height: 26px; background: #b70000; border-radius: 3px; -moz-border-radius: 3px; -webkit-border-radius: 3px; margin-bottom: 10px; display: none; }
	.msg-thanks { background: #2d9a23 !important;}
	.msg-alert p,
	.msg-thanks p { text-align: center; margin: 0; color: #fff; line-height: 25px; }
	.msg-alert1 p{ text-align: center; margin: 0; color: #fff; line-height: 25px; }
	.cl { display: block; height: 0; font-size: 0; line-height: 0; text-indent: -4000px; clear: both; }
	.new_logo{float:left;margin-left:20px;margin-top: -8px;}
	</style>
 <body>
	<div class="add_drop">
	
		<div class="new_logo">
			<a href="/"><img src="images/front/menu_logo.png" border="0" alt=""></a>
		</div>
		<div class="new_menu" id="hiden">
			<img src="images/front/menu.png" width="25" height="25" border="0" alt="">

		</div>
		<div style="clear:both;"></div>
		<div style="clear:both;height:10px"></div>
		<ul class="drop_menu" id="open">
			<li><a href="/"><img src="images/front/menu_logo.png" border="0" alt=""></a></li>
			<li><a href="contact">Contact Us</a></li>
			<li><a href="terms.html">Terms</a></li>
			<li><a href="policy.html">Policy</a></li>
		</ul>

	</div>
    <div class="modal-overlay black"></div>
    <section class="section-red bg_pattern pt-60 pb-60 phn-ta-c phn-pt-30 phn-pb-30" style='background: url("images/front/contact_bg.jpg") no-repeat scroll center center transparent;background-size: cover;padding-top:117px !important;'>
        <div class="container">
            <div class="fade-from-left tab-pt-120 phn-width-full phn-pt-0" style="color:black;">
                <h2 class="title large">Contact Us</h2>
                <p class="para mb-30" style="font-size: 17px;">
					<div class="msg_cls"><?php echo $mail_send_msg;?></div>
					<form id="contact_form" action="" method="POST" enctype="multipart/form-data">
						<div class="row">
							<label for="name" class="contact_frm_label">Name:</label><br />
							<div id="" class="contact_frm_div">
								<input id="name" class="input contact_frm_input validate[required]" tabindex="1" data-errormessage-value-missing="Please enter name." name="name" type="text" value=""/>
							</div>
						</div>
						<div class="row">
							<label for="email" class="contact_frm_label">Email:</label><br />
							<div id="" class="contact_frm_div">
								<input id="email" class="input contact_frm_input validate[required, custom[email]]" tabindex="2" data-errormessage-value-missing="Please enter email." name="email" type="text" value="" />
							</div>
						</div>
						<div class="row">
							<label for="subject" class="contact_frm_label">Subject:</label><br />
							<div id="" class="contact_frm_div">
								<input id="subject" class="input contact_frm_input validate[required]" tabindex="3" data-errormessage-value-missing="Please enter subject." name="subject" type="text" value=""/>
							</div>
						</div>
						<div class="row">
							<label for="message" class="contact_frm_label">Message:</label><br />
							<div id="" class="contact_frm_div">
								<textarea id="message" class="input contact_frm_input validate[required]" tabindex="4" data-errormessage-value-missing="Please enter message." name="message" rows="7" cols="30"></textarea>
							</div>
						</div>
						<input id="submit_button" type="submit" value="Submit" class="contact_submit" tabindex="5"/>
					</form>	
				</p>
            </div>
            <div class="clr"></div>
        </div>
    </section>
</body>
</html>