<?php

    // Only process POST reqeusts.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form fields and remove whitespace.
        $name = strip_tags(trim($_POST["name"]));
        $email = $_POST["email"];
        $mobile = trim($_POST["phone"]);
		$product = strip_tags(trim($_POST["product"]));
        if (!empty($email)) {
            $email=filter_var(trim($email), FILTER_SANITIZE_EMAIL);
			// Build the email headers (if email provided).
			$email_headers = "From: $name\r\nReply-to: $email";
        }else{
            $email="Not Provided (You cannot reply this mail).";
			// Build the email headers (if email not provided).
			$email_headers = "From: $name <$mobile>";
        }
        $message = strip_tags(trim($_POST["message"]));
        // Set the recipient email address.
        // FIXME: Update this to your desired email address.
        $recipient = "tarun@multiagencies.com";

        // Set the email subject.
        $subject = "New enquiry Message from Website. Sender: $name";

        // Build the email content.
        $email_content = "Name: $name\n\n";
        $email_content .= "Email: $email\n\n";
        $email_content .= "Mobile:$mobile\n\n";
		$email_content .= "Product:$product\n\n";
        $email_content .= "Message:$message\n\n";
		//customer email content
		$customer_email_content="Thank You $name for contacting Multi Agencies. We will get back to you soon";
		//customer email subject
		$customer_subject = "Thank You $name for contacting Multi Agencies";
        
		//customer email headers.
		$customer_email_headers = "From:Tarun- Multi Agencies <tarun@multiagencies.com>";
        // Send the email.
        if (mail($recipient, $subject, $email_content, $email_headers)) {
            // Set a 200 (okay) response code.
            http_response_code(200);
			if (!empty($_POST["email"])){
				mail($_POST["email"], $customer_subject, $customer_email_content, $customer_email_headers);
			}else{}
            echo "Thank You! for contacting us. We will respond to you soon.";
        } else {
            // Set a 500 (internal server error) response code.
            http_response_code(500);
            echo "Oops! Something went wrong and we couldn't send your message.";
        }

    } else {
        // Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        echo "There was a problem with your submission, please try again.";
    }

?>