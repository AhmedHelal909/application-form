<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use App\Models\Application;

class ApplicationSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public $application;
    protected $pdfPath;

    public function __construct(Application $application, $pdfPath)
    {
        $this->application = $application;
        $this->pdfPath = $pdfPath;
    }

    public function build()
    {
        $mail = $this->subject('New Application #'.$this->application->id)
            ->markdown('emails.application.submitted')
            ->with([
                'application' => $this->application,
                'user' => $this->application->user,
            ]);

        // attach uploaded files
        if (!empty($this->application->files)) {
            foreach ($this->application->files as $file) {
                $mail->attach(storage_path('app/public/'.$file), [
                    'as' => basename($file),
                ]);
            }
        }

        // attach generated PDF
        if ($this->pdfPath && Storage::disk('public')->exists($this->pdfPath)) {
            $mail->attach(storage_path('app/public/'.$this->pdfPath), [
                'as' => 'application_'.$this->application->id.'.pdf',
            ]);
        }

        return $mail;
    }
}
