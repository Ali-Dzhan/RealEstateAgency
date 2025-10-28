@extends('layouts.auth')

@section('content')
    <div class="login-wrap">
        <div class="login-html">

            <!-- Tabs -->
            <input id="tab-1" type="radio" name="tab" class="sign-in" checked>
            <label for="tab-1" class="tab">Sign In</label>

            <input id="tab-2" type="radio" name="tab" class="sign-up">
            <label for="tab-2" class="tab">Sign Up</label>

            <div class="login-form">
                <!-- LOGIN FORM -->
                <div class="sign-in-htm">
                    <form method="POST" action="{{ route('auth') }}">
                        @csrf
                        <div class="group">
                            <label for="login-username" class="label">Username</label>
                            <input id="login-username" type="text" class="input" name="username" required autofocus>
                        </div>

                        <div class="group">
                            <label for="login-password" class="label">Password</label>
                            <input id="login-password" type="password" class="input" name="password" required>
                        </div>

                        <div class="group">
                            <input id="check" type="checkbox" class="check" name="remember">
                            <label for="check"><span class="icon"></span> Keep me signed in</label>
                        </div>

                        <div class="group">
                            <button type="submit" class="button">Sign In</button>
                        </div>
                    </form>

                    <div class="hr"></div>
                    <div class="foot-lnk">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">Forgot Password?</a>
                        @endif
                    </div>
                </div>

                <!-- REGISTER FORM -->
                <div class="sign-up-htm">
                    <form method="POST" action="{{ route('auth') }}">
                        @csrf
                        <div class="group">
                            <label for="reg-username" class="label">Username</label>
                            <input id="reg-username" type="text" class="input" name="username" required>
                        </div>

                        <div class="group">
                            <label for="reg-role" class="label">Role</label>
                            <select id="reg-role" name="role" class="input" required>
                                <option value="">-- Select Role --</option>
                                <option value="agent">Agent</option>
                                <option value="client">Client</option>
                            </select>
                        </div>

                        <!-- AGENT FIELDS -->
                        <div id="agent-fields" class="agent-fields" style="display:none;">
                            <div class="group">
                                <label for="first_name" class="label">First Name</label>
                                <input id="first_name" type="text" class="input" name="first_name">
                            </div>
                            <div class="group">
                                <label for="last_name" class="label">Last Name</label>
                                <input id="last_name" type="text" class="input" name="last_name">
                            </div>
                        </div>

                        <!-- CLIENT FIELDS -->
                        <div id="client-fields" class="client-fields" style="display:none;">
                            <div class="group">
                                <label for="name" class="label">Full Name</label>
                                <input id="name" type="text" class="input" name="name">
                            </div>
                        </div>

                        <div class="group">
                            <label for="reg-password" class="label">Password</label>
                            <input id="reg-password" type="password" class="input" name="password" required>
                        </div>

                        <div class="group">
                            <label for="reg-password-confirm" class="label">Repeat Password</label>
                            <input id="reg-password-confirm" type="password" class="input" name="password_confirmation" required>
                        </div>

                        <div class="group">
                            <button type="submit" class="button">Sign Up</button>
                        </div>
                    </form>

                    <div class="hr"></div>
                    <div class="foot-lnk">
                        <label for="tab-1">Already Member?</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const roleSelect = document.getElementById('reg-role');
        const agentFields = document.getElementById('agent-fields');
        const clientFields = document.getElementById('client-fields');

        roleSelect.addEventListener('change', () => {
            agentFields.style.display = roleSelect.value === 'agent' ? 'block' : 'none';
            clientFields.style.display = roleSelect.value === 'client' ? 'block' : 'none';
        });
    </script>
@endsection
