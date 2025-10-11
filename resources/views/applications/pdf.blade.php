<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Application #{{ $application->id }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h1 { text-align:center; }
        .field { margin-bottom: 6px; }
    </style>
</head>
<body>
    <h1>Application #{{ $application->id }}</h1>
    <div class="field"><strong>Name:</strong> {{ $user->name }}</div>
    <div class="field"><strong>Email:</strong> {{ $application->contact_email }}</div>
    <div class="field"><strong>Phone:</strong> {{ $application->contact_phone }}</div>
    <div class="field"><strong>DOB:</strong> {{ $application->date_of_birth ?? '—' }}</div>
    <div class="field"><strong>Gender:</strong> {{ $application->gender ?? '—' }}</div>
    <div class="field"><strong>Country:</strong> {{ $application->country ?? '—' }}</div>
    <div class="field"><strong>Comments:</strong><div>{{ $application->comments }}</div></div>

    @if($application->files && count($application->files))
        <h3>Files</h3>
        <ul>
        @foreach($application->files as $f)
            <li>{{ basename($f) }}</li>
        @endforeach
        </ul>
    @endif
</body>
</html>
