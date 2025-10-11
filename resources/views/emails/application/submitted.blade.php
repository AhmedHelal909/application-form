@component('mail::message')
# New Application Submitted

A new application has been submitted by **{{ $user->name }}**.

**Contact Email:** {{ $application->contact_email }}  
**Contact Phone:** {{ $application->contact_phone }}  
**Country:** {{ $application->country ?? '—' }}  
**DOB:** {{ $application->date_of_birth ?? '—' }}  
**Gender:** {{ $application->gender ?? '—' }}

---

### 📎 Uploaded Files:
@if($application->files && count($application->files))
@foreach($application->files as $file)
- [{{ basename($file) }}]({{ asset('storage/' . $file) }})
@endforeach
@else
_No files uploaded._
@endif

---

Thanks,  
{{ config('app.name') }}
@endcomponent
