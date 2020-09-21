@component('mail::message')
<h2>Request Permission for Resources</h2>
<p>You have new permission request from {{ $details['student_name'] }} for access subject resorces</p><br>
<small>before you click the button plese be sure to logging to the web site.</small>

@component('mail::button', ['url' =>  url('http://127.0.0.1:8000/allowPermisionSubject/'.$details['student_id'].'/'.$details['teacher_id'])])
Allow to Access
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
