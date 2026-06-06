<x-base>
    <h1 class="form__title">Login</h1>
    <form action="{{ route('login.store') }}" method="POST" class="form">
        @csrf
        <div class="form__field">
            <label for="email" class="form__label">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" class="form__input"/>
            @error('email') <p class="form__error">{{ $message }}</p> @enderror
        </div>
        <div class="form__field">
            <label for="password" class="form__label">Password</label>
            <input type="password" name="password" id="password" class="form__input"/>
            @error('password') <p class="form__error">{{ $message }}</p> @enderror
        </div>
        <div class="form__field form__field--checkbox">
            <label for="remember" class="form__label form__label--checkbox">Remember me</label>
            <input type="checkbox" name="remember" id="remember" @checked(old('remember', false)) class="form__input form__input--checkbox"/>
        </div>
        <button type="submit" class="form__button">Login</button>
    </form>
</x-base>
