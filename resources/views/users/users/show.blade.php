<h2>User Detail</h2>
<p>Name: {{ $users->name }}</p>
<p>Email: {{ $users->email }}</p>
<a href="{{ route('admin.users.index') }}">Back</a>
