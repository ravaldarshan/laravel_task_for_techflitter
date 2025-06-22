@if ($user)
    <div>
        <p><strong>Name:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Gender:</strong> {{ $user->gender }}</p>
        <p><strong>Date of Birth:</strong> {{ $user->dob }}</p>
        <p><strong>Phone:</strong> {{ $user->phone_no }}</p>
        <p><strong>Address:</strong> {{ $user->address }}</p>
        <p><strong>Created At:</strong> {{ $user->created_at }}</p>
    </div>
@else
    <div class="alert alert-danger">Failed to load user data.</div>
@endif
