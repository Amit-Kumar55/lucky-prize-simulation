<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lucky Prize Simulation</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin-top: 50px; }
        .container { width: 60%; margin: auto; }
        .btn { background: blue; color: white; padding: 10px 20px; border: none; cursor: pointer; margin-top: 10px; }
        .message { margin: 20px 0; font-size: 20px; color: green; }
        .error { margin: 20px 0; font-size: 20px; color: red; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table th, .table td { border: 1px solid black; padding: 10px; text-align: center; }
        .form-group { margin-bottom: 10px; }
        input[type="text"], input[type="number"] { padding: 8px; width: 90%; }
        canvas { max-width: 100%; margin-top: 20px; }
    </style>
</head>
<body>

<div class="container">
    <h2>Lucky Prize Draw Simulation</h2>

    @if(session('message'))
        <p class="message">{{ session('message') }}</p>
    @endif

    @if(session('error'))
        <p class="error">{{ session('error') }}</p>
    @endif

    <!-- Number of Prizes Input -->
    <form action="{{ route('simulate.run') }}" method="POST">
        @csrf
        <div class="form-group">
            <input type="number" name="num_prizes" placeholder="Number of Prizes to Simulate" required>
        </div>
        <button type="submit" class="btn">Simulate Prizes</button>
    </form>

    <h3>Add a New Prize</h3>
    <form action="{{ route('prizes.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <input type="text" name="name" placeholder="Prize Name" required>
        </div>
        <div class="form-group">
            <input type="number" step="0.1" name="probability" placeholder="Probability (%)" required>
        </div>
        <button type="submit" class="btn">Add Prize</button>
    </form>

    <h3>Available Prizes</h3>
    <table class="table">
        <tr>
            <th>Prize</th>
            <th>Probability (%)</th>
            <th>Actual Rewards Awarded</th>
            <th>Actions</th>
        </tr>
        @foreach($prizes as $prize)
            <tr>
                <td>{{ $prize->name }}</td>
                <td>{{ $prize->probability }}%</td>
                <td>{{ $prize->awarded }}</td>
                <td>
                    <a href="{{ route('prizes.edit', $prize->id) }}">Edit</a>
                    <form action="{{ route('prizes.delete', $prize->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    <h3>Probability vs Actual Rewards</h3>
    <canvas id="probabilityChart"></canvas>
    <canvas id="rewardsChart"></canvas>
</div>

<script>
    const prizes = @json($prizes);

    // Extract data for the charts
    const labels = prizes.map(prize => prize.name);
    const probabilities = prizes.map(prize => prize.probability);
    const awards = prizes.map(prize => prize.awarded);

    // Probability Chart
    const probabilityCtx = document.getElementById('probabilityChart').getContext('2d');
    new Chart(probabilityCtx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Probability (%)',
                data: probabilities,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
    });

    // Rewards Chart
    const rewardsCtx = document.getElementById('rewardsChart').getContext('2d');
    new Chart(rewardsCtx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Actual Rewards',
                data: awards,
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1
            }]
        },
    });
</script>

</body>
</html>
