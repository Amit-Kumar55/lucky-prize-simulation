<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Prize</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin-top: 50px; }
        .container { width: 50%; margin: auto; }
        .btn { background: blue; color: white; padding: 10px 20px; border: none; cursor: pointer; margin-top: 10px; }
        .message { margin: 20px 0; font-size: 20px; color: green; }
        .error { margin: 20px 0; font-size: 20px; color: red; }
        .form-group { margin-bottom: 10px; }
        input[type="text"], input[type="number"] { padding: 8px; width: 90%; }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit Prize</h2>

    @if(session('error'))
        <p class="error">{{ session('error') }}</p>
    @endif

    <form action="{{ route('prizes.update', $prize->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <input type="text" name="name" value="{{ $prize->name }}" required>
        </div>


        <div class="form-group">
            <input type="number" step="0.1" name="probability" value="{{ $prize->probability }}" required>
        </div>

        <button type="submit" class="btn">Update Prize</button>
    </form>

    <br>
    <a href="{{ route('simulate') }}">Back to List</a>
</div>

</body>
</html>
