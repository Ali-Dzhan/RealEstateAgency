@extends('layouts.auth')

@section('content')
    <div class="login-wrap">
        <a href="/" class="back-home">← Back to Home</a>

        <div class="login-html">
            <input id="tab-1" type="radio" name="tab" class="sign-in" checked>
            <label for="tab-1" class="tab">Sign In</label>

            <input id="tab-2" type="radio" name="tab" class="sign-up">
            <label for="tab-2" class="tab">Sign Up</label>

            <div class="login-form">
                <div class="sign-in-htm">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="group">
                            <label for="login-username" class="label">Username</label>
                            <input id="login-username" type="text" class="input" name="username" required autofocus>
                        </div>
                        <div class="group">
                            <label for="login-password" class="label">Password</label>
                            <input id="login-password" type="password" class="input" name="password" required>
                        </div>

                        <div class="group check-group">
                            <input id="check" type="checkbox" name="remember">
                            <label for="check">Keep me signed in</label>
                        </div>

                        <div class="group">
                            <button type="submit" class="button">Sign In</button>
                        </div>
                    </form>
                    <div class="hr"></div>
                    <div class="foot-lnk">
                        <a href="{{ route('password.request') }}">Forgot Password?</a>
                    </div>
                </div>

                <div class="sign-up-htm">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="group">
                            <label for="reg-username" class="label">Username</label>
                            <input id="reg-username" type="text" class="input" name="username" required>
                        </div>

                        <div class="group">
                            <label for="reg-role" class="label">Role</label>
                            <div class="select-wrapper">
                                <select id="reg-role" name="role" class="input custom-select" required>
                                    <option value="" disabled selected>Select Role</option>
                                    <option value="agent">Agent</option>
                                    <option value="client">Client</option>
                                </select>
                            </div>
                        </div>

                        <div id="agent-fields" style="display:none;">
                            <div class="group">
                                <label for="first_name" class="label">First Name</label>
                                <input id="first_name" type="text" class="input" name="first_name">
                            </div>
                            <div class="group">
                                <label for="last_name" class="label">Last Name</label>
                                <input id="last_name" type="text" class="input" name="last_name">
                            </div>
                        </div>

                        <div id="client-fields" style="display:none;">
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
                            <label for="reg-repeat" class="label">Repeat Password</label>
                            <input id="reg-repeat" type="password" class="input" name="password_confirmation" required>
                        </div>

                        <div class="group">
                            <button type="submit" class="button">Sign Up</button>
                        </div>
                    </form>
                    <div class="hr"></div>
                    <div class="foot-lnk">
                        <label for="tab-1">Already a member?</label>
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
            const value = roleSelect.value;

            // Toggle Agent fields
            agentFields.style.display = (value === 'agent') ? 'block' : 'none';

            // Toggle Client fields
            clientFields.style.display = (value === 'client') ? 'block' : 'none';
        });
    </script>
@endsection
