<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;

class MedicalResultsNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $examination;
    public $examinationType;
    public $patientEmail;
    public $patientName;

    /**
     * Create a new message instance.
     */
    public function __construct($examination, $examinationType, $patientEmail, $patientName)
    {
        $this->examination = $examination;
        $this->examinationType = $examinationType; // 'pre_employment' or 'annual_physical'
        $this->patientEmail = $patientEmail;
        $this->patientName = $patientName;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $subject = $this->examinationType === 'pre_employment' 
            ? 'Your Pre-Employment Medical Results - RSS Citi Health Services'
            : 'Your Annual Physical Medical Results - RSS Citi Health Services';

        return new Envelope(
            subject: $subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.medical-results-notification',
            with: [
                'examination' => $this->examination,
                'examinationType' => $this->examinationType,
                'patientEmail' => $this->patientEmail,
                'patientName' => $this->patientName,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        try {
            // Generate PDF based on examination type
            $pdfView = $this->examinationType === 'pre_employment' 
                ? 'pdf.pre-employment-results' 
                : 'pdf.annual-physical-results';
            
            // Ensure examination has all necessary relationships loaded
            if ($this->examinationType === 'pre_employment') {
                $this->examination->load(['drugTestResults', 'preEmploymentRecord.medicalTest']);
            } else {
                $this->examination->load(['drugTestResults', 'patient.appointment.medicalTest']);
            }
            
            $pdf = Pdf::loadView($pdfView, [
                'examination' => $this->examination
            ]);
            
            // Set PDF options for better formatting
            $pdf->setPaper('A4', 'portrait');
            $pdf->setOptions([
                'isHtml5ParserEnabled' => true,
                'isPhpEnabled' => true,
                'defaultFont' => 'Arial'
            ]);
            
            // Generate filename
            $filename = $this->examinationType === 'pre_employment' 
                ? 'Pre-Employment_Medical_Results_' . $this->examination->id . '.pdf'
                : 'Annual_Physical_Results_' . $this->examination->id . '.pdf';
            
            return [
                Attachment::fromData(fn () => $pdf->output(), $filename)
                    ->withMime('application/pdf')
            ];
        } catch (\Exception $e) {
            // Log error but don't fail the email
            \Log::error('Failed to generate PDF attachment for medical results email: ' . $e->getMessage(), [
                'examination_id' => $this->examination->id,
                'examination_type' => $this->examinationType,
                'patient_email' => $this->patientEmail
            ]);
            
            // Return empty array if PDF generation fails
            return [];
        }
    }
}
