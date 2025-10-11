<?php
namespace App\Http\Controllers;

use App\Models\Application;
use App\Http\Requests\StoreApplicationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApplicationSubmitted;
use PDF; // from barryvdh

class ApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // show form page
    public function create()
    {
        return view('applications.create');
    }

    // handle AJAX submission
    public function store(StoreApplicationRequest $request)
    {
        $data = $request->validated();
        $user = $request->user();

        $savedFiles = [];
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('applications/'.$user->id, 'public');
                $savedFiles[] = $path;
            }
        }

        $application = Application::create([
            'user_id' => $user->id,
            'contact_email' => $data['contact_email'],
            'contact_phone' => $data['contact_phone'],
            'date_of_birth' => $data['date_of_birth'] ?? null,
            'gender' => $data['gender'] ?? null,
            'country' => $data['country'] ?? null,
            'comments' => $data['comments'] ?? null,
            'files' => $savedFiles,
        ]);

        // generate PDF view
        $pdf = PDF::loadView('applications.pdf', [
            'application' => $application,
            'user' => $user,
        ]);

        $pdfPath = 'applications/pdfs/application_'.$application->id.'.pdf';
        Storage::disk('public')->put($pdfPath, $pdf->output());

        // send email to admin with attachments
        $adminEmail = config('mail.admin_address') ?? env('ADMIN_EMAIL', 'admin@example.com');

        Mail::to($adminEmail)->send(new ApplicationSubmitted($application, $pdfPath));

        return response()->json(['status' => 'success', 'message' => 'Application submitted.']);
    }
}
