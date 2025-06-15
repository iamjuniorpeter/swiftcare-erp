<?php

namespace App\Http\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require base_path('vendor/phpmailer/src/PHPMailer.php');
require base_path('vendor/phpmailer/src/Exception.php');
require base_path('vendor/phpmailer/src/SMTP.php');

class MailController extends Controller
{
    public function sendTestMail()
    {
        $response = json_decode($this->sendEmail(['aisa@veritaskapital.com'], 'Test Subject', 'Test Message'));

        if ($response->status === "success") {
            return response()->json(["status" => "success", "message" => "Mail successfully sent"]);
        }

        return response()->json(["status" => "error", "message" => "Error sending mail: " . $response->message]);
    }

    public function sendLowAlertsToCustomer($user, $merchant, $item)
    {
        $availableQty = $item->batches_sum_quantity ?? 0;

        $msg = "
        <html>
        <head>
            <style>
                body {
                    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                    background-color: #f8f9fa;
                    padding: 20px;
                    color: #333;
                }
                .email-container {
                    background-color: #ffffff;
                    border-radius: 8px;
                    padding: 30px;
                    max-width: 600px;
                    margin: 0 auto;
                    box-shadow: 0 0 10px rgba(0,0,0,0.1);
                }
                .header {
                    background-color: #0d6efd;
                    color: #ffffff;
                    padding: 15px 20px;
                    border-radius: 6px 6px 0 0;
                    font-size: 20px;
                    text-align: center;
                    font-weight: bold;
                }
                .content {
                    padding: 20px;
                    line-height: 1.6;
                }
                .highlight {
                    background-color: #ffeeba;
                    padding: 10px;
                    border-left: 4px solid #ffc107;
                    margin: 15px 0;
                    font-weight: 500;
                }
                .footer {
                    font-size: 12px;
                    color: #666;
                    text-align: center;
                    margin-top: 30px;
                }
            </style>
        </head>
        <body>
            <div class='email-container'>
                <div class='header'>Low Stock Notification</div>
                <div class='content'>
                    <p>Dear <strong>{$user->merchant->contact_person}</strong>,</p>

                    <p>We would like to inform you that one of your inventory items is running low on stock. Timely action can help prevent stockouts and ensure smooth operations.</p>

                    <div class='highlight'>
                        <strong>Item:</strong> {$item->name} <br>
                        <strong>Current Quantity:</strong> {$availableQty} units <br>
                        <strong>Reorder Level:</strong> {$item->reorder_level} units
                    </div>

                    <p>We recommend initiating a restock to maintain availability. You can manage this item directly through your inventory dashboard.</p>

                    <p>If you have any questions or need assistance, feel free to reach out to our support team.</p>

                    <p>Thank you for choosing <strong>Swiftcare Distribution</strong>.</p>
                </div>
                <div class='footer'>
                    &copy; " . date('Y') . " Swiftcare Distribution Services. All rights reserved.
                </div>
            </div>
        </body>
        </html>
        ";

        $response = json_decode($this->sendEmail([$user->merchant->email], 'Low Stock Alert - ' . $item->name, $msg));
    }


    public function sendEmail($recipients, $subject, $message)
    {
        $primaryRecipient = $recipients[0];

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->SMTPDebug = 0;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = "starttls";
            $mail->Port = 587;
            $mail->Host = "smtp.office365.com";

            $mail->Username = "admin@swiftcaredistributions.com";
            $mail->Password = "Admin@Peter";

            $mail->setFrom('admin@swiftcaredistributions.com', 'Swift Care Distribution');
            $mail->addAddress($primaryRecipient);
            $mail->Subject = $subject;
            $mail->isHTML(true);
            $mail->Body = $message;

            // Add additional CCs if provided
            foreach (array_slice($recipients, 1) as $cc) {
                $mail->addCC($cc);
            }

            if (!$mail->send()) {
                return json_encode(["status" => "error", "message" => "Failed to send email."]);
            }

            return json_encode(["status" => "success", "message" => "Email successfully sent."]);

        } catch (Exception $e) {
            return json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
    }
}
