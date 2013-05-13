<div id="signonbox" class="roundbox">
<div id="signup" class="loginform">
    Sign Up for a LinkWise Account
    <form method="post" action="/user/create">
        <ul>
            <li>
                <label for="username">
                    <span>User Name</span>
                </label>
                <input type="text" id="username" name="username"/>
            </li>
            <li>
                <label for="password">
                    <span>Password</span>
                </label>
                <input type="password" id="password" name="password"/>
            </li>
            <li>
                <label for="pwconfirm">
                    <span>Confirm</span>
                </label>
                <input type="password" id="pwconfirm" name="pwconfirm"/>
            </li>
            <li>
                <label for="email">
                    <span>Email (Optional)</span>
                </label>
                <input type="text" id="email" name="email"/>
            </li>
            <li>
                <label></label>
                <input type="submit" value="Create Account"/>
            </li>
        </ul>
    </form>
</div>

<div id="signon" class="loginform">
    Sign On
    <form method="post" action="/user/login">
        <ul>
            <li>
                <label for="username2">
                    <span>User Name</span>
                </label>
                <input type="text" id="username2" name="username"/>
            </li>
            <li>
                <label for="password2">
                    <span>Password</span>
                </label>
                <input type="password" id="password2" name="password"/>
            </li>
            <li>
                <label></label>
                <input type="submit" value="Login"/>
            </li>
        </ul>
    </form>
    Or Connect with Your Facebook Account
    <ul>
        <li><fb:login-button onclick="login"></fb:login-button></li>
    </ul>

</div>

<div class="clear"></div>
</div>