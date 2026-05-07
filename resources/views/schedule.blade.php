<h1>{{ ucfirst(Request::segment(1)) }} Page</h1>
<p>Welcome to the TheraConnect {{ Request::segment(1) }} section.</p>
<a href="{{ route('dashboard') }}">Return to Overview</a>