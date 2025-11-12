<?php
// Process demo booking form and send email

header('Content-Type: application/json');

// Only accept POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

// Sanitize and validate input
$name = isset($_POST['name']) ? sanitize_input($_POST['name']) : '';
$email = isset($_POST['email']) ? sanitize_input($_POST['email']) : '';
$company = isset($_POST['company']) ? sanitize_input($_POST['company']) : '';
$phone = isset($_POST['phone']) ? sanitize_input($_POST['phone']) : '';
$date = isset($_POST['date']) ? $_POST['date'] : '';
$time = isset($_POST['time']) ? $_POST['time'] : '';
$product = isset($_POST['product']) ? sanitize_input($_POST['product']) : '';
$message = isset($_POST['message']) ? sanitize_input($_POST['message']) : '';

// Validate required fields
if (empty($name) || empty($email) || empty($date) || empty($time) || empty($product)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Missing required fields']);
    exit;
}

// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid email address']);
    exit;
}

// Validate date is in the future
$bookingDateTime = strtotime($date . ' ' . $time);
$now = time();
if ($bookingDateTime <= $now) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Please select a future date and time']);
    exit;
}

// Format the booking details for email
$bookingDate = date('l, F j, Y', strtotime($date));
$bookingTime = date('g:i A', strtotime($time));

// Email recipient
$recipientEmail = 'livertembo@yahoo.com';
$subject = 'New Demo Booking Request: ' . $product;

// Prepare email body
$emailBody = "
<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #1E3A8A; color: white; padding: 20px; border-radius: 8px 8px 0 0; }
        .header h1 { margin: 0; font-size: 24px; }
        .content { background: #f9f9f9; padding: 20px; border-radius: 0 0 8px 8px; }
        .field { margin-bottom: 16px; }
        .label { font-weight: bold; color: #1E3A8A; margin-bottom: 4px; }
        .value { color: #555; }
        .booking-box { background: white; border-left: 4px solid #1E3A8A; padding: 16px; margin: 20px 0; }
        .footer { font-size: 12px; color: #999; margin-top: 20px; text-align: center; }
    </style>
</head>
<body>
    <div class=\"container\">
        <div class=\"header\">
            <h1>New Demo Booking Request</h1>
        </div>
        <div class=\"content\">
            <p>You have received a new demo booking request:</p>
            
            <div class=\"field\">
                <div class=\"label\">Product Interest:</div>
                <div class=\"value\">NetCost Estimator " . htmlspecialchars($product) . "</div>
            </div>
            
            <div class=\"booking-box\">
                <div class=\"field\">
                    <div class=\"label\">Scheduled Date:</div>
                    <div class=\"value\">" . $bookingDate . "</div>
                </div>
                <div class=\"field\">
                    <div class=\"label\">Scheduled Time:</div>
                    <div class=\"value\">" . $bookingTime . "</div>
                </div>
            </div>
            
            <h3 style=\"color: #1E3A8A; margin-top: 20px;\">Client Information</h3>
            
            <div class=\"field\">
                <div class=\"label\">Name:</div>
                <div class=\"value\">" . htmlspecialchars($name) . "</div>
            </div>
            
            <div class=\"field\">
                <div class=\"label\">Email:</div>
                <div class=\"value\"><a href=\"mailto:" . htmlspecialchars($email) . "\">" . htmlspecialchars($email) . "</a></div>
            </div>
            
            " . ((!empty($company)) ? "
            <div class=\"field\">
                <div class=\"label\">Company/Organisation:</div>
                <div class=\"value\">" . htmlspecialchars($company) . "</div>
            </div>
            " : "") . "
            
            " . ((!empty($phone)) ? "
            <div class=\"field\">
                <div class=\"label\">Phone Number:</div>
                <div class=\"value\">" . htmlspecialchars($phone) . "</div>
            </div>
            " : "") . "
            
            " . ((!empty($message)) ? "
            <div class=\"field\">
                <div class=\"label\">Additional Notes:</div>
                <div class=\"value\">" . nl2br(htmlspecialchars($message)) . "</div>
            </div>
            " : "") . "
            
            <div class=\"footer\">
                <p>This email was sent from the NetCost website demo booking system.</p>
            </div>
        </div>
    </div>
</body>
</html>
";

// Email headers
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
$headers .= "From: demo-bookings@netcost.local\r\n";
$headers .= "Reply-To: " . $email . "\r\n";

// Send email to admin
$emailSent = mail($recipientEmail, $subject, $emailBody, $headers);

// Also send confirmation email to the user
$confirmationSubject = 'Demo Booking Confirmation - NetCost Estimator';
$confirmationBody = "
<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #1E3A8A; color: white; padding: 20px; border-radius: 8px 8px 0 0; }
        .header h1 { margin: 0; font-size: 24px; }
        .content { background: #f9f9f9; padding: 20px; border-radius: 0 0 8px 8px; }
        .booking-box { background: white; border-left: 4px solid #1E3A8A; padding: 16px; margin: 20px 0; }
        .footer { font-size: 12px; color: #999; margin-top: 20px; text-align: center; }
    </style>
</head>
<body>
    <div class=\"container\">
        <div class=\"header\">
            <h1>Demo Booking Confirmed</h1>
        </div>
        <div class=\"content\">
            <p>Hi " . htmlspecialchars($name) . ",</p>
            
            <p>Thank you for booking a demo with us! We're excited to show you the power of NetCost Estimator " . htmlspecialchars($product) . ".</p>
            
            <div class=\"booking-box\">
                <h3 style=\"margin-top: 0; color: #1E3A8A;\">Your Demo Details</h3>
                <p><strong>Product:</strong> NetCost Estimator " . htmlspecialchars($product) . "</p>
                <p><strong>Date:</strong> " . $bookingDate . "</p>
                <p><strong>Time:</strong> " . $bookingTime . "</p>
            </div>
            
            <p>Our team will contact you shortly at <strong>" . htmlspecialchars($email) . "</strong>" . ((!empty($phone)) ? " or <strong>" . htmlspecialchars($phone) . "</strong>" : "") . " to confirm the details and send you a meeting link.</p>
            
            <p>If you have any questions before your demo, feel free to reply to this email or contact us directly.</p>
            
            <p>We look forward to speaking with you!</p>
            
            <p><strong>Best regards,</strong><br>
            The NetCost Team</p>
            
            <div class=\"footer\">
                <p>© 2025 NetCost. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>
</html>
";

$confirmationHeaders = "MIME-Version: 1.0\r\n";
$confirmationHeaders .= "Content-Type: text/html; charset=UTF-8\r\n";
$confirmationHeaders .= "From: noreply@netcost.local\r\n";

mail($email, $confirmationSubject, $confirmationBody, $confirmationHeaders);

// Return success response
if ($emailSent) {
    // Generate Google Calendar link for the user to add to their calendar
    $googleCalendarLink = generateGoogleCalendarLink($date, $time, $product);
    
    echo json_encode([
        'success' => true,
        'message' => 'Demo booking confirmed! Check your email for details.',
        'googleCalendarLink' => $googleCalendarLink
    ]);
} else {
    // Even if email fails, we consider it a success for user feedback
    // (but log it for admin purposes)
    error_log('Demo booking email failed for: ' . $email);
    
    $googleCalendarLink = generateGoogleCalendarLink($date, $time, $product);
    
    echo json_encode([
        'success' => true,
        'message' => 'Demo booking received! You will receive a confirmation email shortly.',
        'googleCalendarLink' => $googleCalendarLink
    ]);
}

// Sanitize input function
function sanitize_input($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

// Generate Google Calendar link
function generateGoogleCalendarLink($date, $time, $product) {
    // Parse the date and time
    $dateTime = new DateTime($date . ' ' . $time);
    $endTime = clone $dateTime;
    $endTime->add(new DateInterval('PT1H')); // 1 hour demo
    
    // Format for Google Calendar (RFC 3339 format without timezone)
    $startFormatted = $dateTime->format('Ymd\THis');
    $endFormatted = $endTime->format('Ymd\THis');
    
    // Build the Google Calendar link
    $title = 'NetCost Estimator ' . $product . ' Demo';
    $description = 'Demo session for NetCost Estimator ' . $product . '. You will receive meeting details via email.';
    $location = 'Online';
    
    $link = 'https://calendar.google.com/calendar/render?action=TEMPLATE&text=' . urlencode($title)
        . '&dates=' . $startFormatted . '/' . $endFormatted
        . '&details=' . urlencode($description)
        . '&location=' . urlencode($location);
    
    return $link;
}
?>
