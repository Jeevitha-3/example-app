<h2>Hi {{ $userData['name'] }},</h2>

<p>Thank you for registering!</p>

<p>Your registration details:</p>
<ul>
    <li>Email: {{ $userData['email'] }}</li>
    <li>Phone: {{ $userData['phonenumber'] }}</li>
    <li>City: {{ $userData['city'] }}</li>
</ul>

<p>Regards,<br>Team</p>
