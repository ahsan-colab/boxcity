<!DOCTYPE html>
<html>
<head>
    <title>{{ $subjectLine }}</title>
</head>
<body>
<h2>Hello {{ $userName ?? 'User' }},</h2>

<p>{{ $messageLine ?? 'This is a default message.' }}</p>

@isset($ctaLink)
    <p><a href="{{ $ctaLink }}" style="background: #4CAF50; color: white; padding: 10px 20px; text-decoration: none;">
            {{ $ctaText ?? 'Take Action' }}
        </a></p>
@endisset

<p>Thanks,<br>The Team</p>
</body>
</html>
