<!-- resources/views/auth/pwrecover.blade.php -->

<form method="POST" action="/password/email">
    {!! csrf_field() !!}

    <div>
        Email
        <input type="email" ng-model="sendEmail" name="email" value="{{ old('email') }}">
    </div>

    <div>
        <button type="submit" ng-click="password(sendEmail)">
            Send Password Reset Link
        </button>
    </div>
</form>