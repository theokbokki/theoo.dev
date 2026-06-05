<x-base>
    <h1>Login</h1>
    <form action="{{ route('login.store') }}" method="POST">
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email"/>
            @error('email') <p>{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password"/>
            @error('password') <p>{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="remember">Remember me</label>
            <input type="checkbox" name="remember" id="remember"/>
        </div>
        <button type="submit">Login</button>
    </form>
</x-base>
