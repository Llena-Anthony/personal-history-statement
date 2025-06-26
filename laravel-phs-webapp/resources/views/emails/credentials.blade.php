<div style="font-family: Arial, sans-serif;">
    <h2 style="color: #1B365D;">Welcome to the PMA System!</h2>
    <p>Your account has been created. Here are your login credentials:</p>
    <ul>
        <li><strong>Username:</strong> {{ $user->username }}</li>
        <li><strong>Password:</strong> {{ $plainPassword }}</li>
    </ul>
    <p>Please keep these credentials safe. You can now log in to the system.</p>
    <br>
    <p>Thank you,<br>PMA Admin Team</p>
</div> 