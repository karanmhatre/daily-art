Hello {{$name}},

<p>A request to reset your password has been issued from your account.
The link to reset your password is {{ URL::route('do_reset_password', $reset_code) }}</p>
<p>If you haven't requested for a password reset please ignore this email.</p>