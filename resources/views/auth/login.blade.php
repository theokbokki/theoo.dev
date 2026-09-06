<x-layout baseClass="auth">
    <header class="header">
        <h1 class="header__title">Login</h1>
        <x-nav/>
    </header>
    <form action="{{ route('login.store') }}" method="POST" class="auth__form">
        @csrf
        <div class="auth__field">
            <label for="email" class="auth__label">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" class="auth__input"/>
            @error('email') <p class="auth__error">{{ $message }}</p> @enderror
        </div>
        <div class="auth__field">
            <label for="password" class="auth__label">Password</label>
            <input type="password" name="password" id="password" class="auth__input"/>
            @error('password') <p class="auth__error">{{ $message }}</p> @enderror
        </div>
        <div class="auth__field auth__field--checkbox">
            <label for="remember" class="auth__label auth__label--checkbox">Remember me</label>
            <input type="checkbox" name="remember" id="remember" @checked(old('remember', false)) class="auth__input auth__input--checkbox"/>
        </div>
        <button type="submit" class="auth__submit">Login</button>
    </form>
</x-layout>
