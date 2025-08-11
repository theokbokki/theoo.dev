```php
tap($user = App\Models\User::firstWhere('email', 'me@mail.be'), fn ($user) => $user->password = bcrypt('change_this'))->save();
```
