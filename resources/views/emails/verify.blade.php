<body>
    <h2>Verify Your Email Address</h2>

    <div>
        Thanks for creating an account with the verification demo app.
        Please follow the link below to verify your email address
        <a href="{{ URL::to('register/verify/' . $confirmation_code) }}">Activation Link<br/>

    </div>

</body>
