{{-- resources/views/home-admin.blade.php --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Item Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">CRUD Item Management</h2>
        
        {{-- Flash Message for Success --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Create Button --}}
        <div class="text-end mb-3">
            <a href="{{ route('items.create') }}" class="btn btn-primary">Add New Item</a>
        </div>

        {{-- Items Table --}}
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->description }}</td>
                        <td>
                            <a href="{{ route('items.show', $item->id) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('items.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('items.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
