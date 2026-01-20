<?php
// =====================================================
// Unified Email Handler – Merchant & Delivery Forms
// ENHANCED VERSION WITH ENV SUPPORT & DELIVERY EMAILS
// =====================================================

require_once __DIR__ . '/config.php';
require __DIR__ . '/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/PHPMailer/src/SMTP.php';
require __DIR__ . '/PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Enable debug for testing
$isDebug = APP_ENV === 'testing';

// Check request method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

// Get form type
$formType = $_POST['formType'] ?? '';

if (!in_array($formType, ['merchant', 'delivery'], true)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid form type']);
    exit;
}

// Initialize variables
$subject = '';
$body = '';
$replyEmail = null;
$replyName = null;

// =====================================================
// MERCHANT FORM HANDLER
// =====================================================
if ($formType === 'merchant') {
    $firstName = trim($_POST['firstName'] ?? '');
    $lastName = trim($_POST['lastName'] ?? '');
    $name = trim("$firstName $lastName");
    $email = trim($_POST['email'] ?? '');
    $storeName = trim($_POST['storeName'] ?? '');
    $message = trim($_POST['message'] ?? '');

    // Validate required fields
    if (!$name || !$email || !$storeName) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Missing required fields']);
        exit;
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Invalid email format']);
        exit;
    }

    $subject = "[MERCHANT APPLICATION] $storeName";
    $replyEmail = $email;
    $replyName = $name;

    $body =
        "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n" .
        "NEW MERCHANT APPLICATION\n" .
        "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n" .
        "Name: $name\n" .
        "Email: $email\n" .
        "Store/Restaurant: $storeName\n\n" .
        "Message:\n" .
        ($message ? "$message\n" : "[No message provided]\n") .
        "\n━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n" .
        "Submission Date: " . date('Y-m-d H:i:s') . "\n";
}

// =====================================================
// DELIVERY FORM HANDLER
// =====================================================
if ($formType === 'delivery') {
    $firstName = trim($_POST['firstName'] ?? '');
    $lastName = trim($_POST['lastName'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $nationality = trim($_POST['nationality'] ?? '');
    $dob = trim($_POST['dob'] ?? '');
    $currentLocation = trim($_POST['currentLocation'] ?? '');
    $employmentType = trim($_POST['employmentType'] ?? '');
    $workLocation = trim($_POST['workLocation'] ?? '');
    $motorbike = trim($_POST['motorbike'] ?? '');

    // Validate required fields
    if (
        !$firstName || !$lastName || !$phone ||
        !$nationality || !$dob || !$currentLocation ||
        !$employmentType || !$workLocation || !$motorbike
    ) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Missing required delivery fields']);
        exit;
    }

    $subject = "[DELIVERY PARTNER APPLICATION] $firstName $lastName";
    // No reply-to for delivery (no email collected)
    $replyEmail = null;

    $body =
        "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n" .
        "NEW DELIVERY PARTNER APPLICATION\n" .
        "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n" .
        "Personal Information\n" .
        "────────────────────\n" .
        "Name: $firstName $lastName\n" .
        "Phone: $phone\n" .
        "Nationality: $nationality\n" .
        "Date of Birth: $dob\n\n" .
        "Work Information\n" .
        "────────────────────\n" .
        "Current Location: $currentLocation\n" .
        "Employment Type: $employmentType\n" .
        "Preferred Work Location: $workLocation\n" .
        "Owns Motorbike: " . ($motorbike === 'yes' ? 'YES ✓' : 'NO') . "\n" .
        "\n━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n" .
        "Submission Date: " . date('Y-m-d H:i:s') . "\n";
}

// =====================================================
// SEND EMAIL VIA PHPMAILER
// =====================================================
function sendEmail($subject, $body, $replyEmail, $replyName, $isDebug = false) {
    $mail = new PHPMailer(true);

    try {
        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host = SMTP_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = SMTP_USERNAME;
        $mail->Password = SMTP_PASSWORD;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = SMTP_PORT;

        // Debug mode for testing
        if ($isDebug) {
            $mail->SMTPDebug = 2;
            $mail->Debugoutput = 'error_log';
        }

        // Set from address
        $mail->setFrom(SMTP_USERNAME, 'Blinky Applications');

        // Set recipient
        $mail->addAddress(PARTNER_RECEIVER_EMAIL);

        // Add reply-to if applicant email exists
        if ($replyEmail && $replyName) {
            $mail->addReplyTo($replyEmail, $replyName);
        }

        // Email content
        $mail->isHTML(false);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->CharSet = 'UTF-8';

        // Send
        if ($mail->send()) {
            return [
                'success' => true,
                'message' => 'Application submitted successfully'
            ];
        } else {
            throw new Exception('Mail send failed');
        }

    } catch (Exception $e) {
        error_log("PHPMailer Error: " . $e->getMessage());
        
        return [
            'success' => false,
            'message' => $isDebug ? 
                'Email Error: ' . $e->getMessage() : 
                'Failed to send application. Please try again.'
        ];
    }
}

// Send the email
$result = sendEmail($subject, $body, $replyEmail, $replyName, $isDebug);

// Return JSON response
header('Content-Type: application/json');
echo json_encode($result);
exit;
?>