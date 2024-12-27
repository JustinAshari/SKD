@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-center"> <!-- Center content in card -->
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h3>Welcome to the Admin Dashboard</h3>

                    {{ __('You are logged in!') }}
                </div>
                <div class="my-4"> <!-- Add margin and center content -->
                    <button id="backup-btn" class="btn btn-primary btn-lg">Backup Database</button> <!-- Add Bootstrap styles -->
                </div>
                <div class="text-center my-4"> <!-- Center the button -->
                    <a href="{{ url('/super') }}" class="btn btn-primary btn-lg">
                        Dashboard Admin!
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('backup-btn').addEventListener('click', function () {
        if (confirm("Are you sure you want to create a backup?")) {
            axios.post('{{ route('backup.database') }}')
                .then(response => alert(response.data.message))
                .catch(error => alert('Error: ' + error.response.data.message));
        }
    });
</script>
@endsection
