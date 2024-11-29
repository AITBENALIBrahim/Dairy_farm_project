<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dairy Management Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.4/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<!-- Sidebar -->
<div class="flex">
    <div class="w-1/5 bg-blue-900 text-white p-6">
        <h2 class="text-2xl mb-6">Farm Dashboard</h2>
        <ul>
            <li><a href="#" class="block py-2">Dashboard</a></li>
            <li><a href="#" class="block py-2">Cows</a></li>
            <li><a href="#" class="block py-2">Milk Records</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-6">
        <h1 class="text-3xl font-bold mb-4">Welcome to the Dairy Farm Management Dashboard</h1>

        <div class="grid grid-cols-2 gap-6">
            <!-- Cow Info -->
            <div class="bg-white p-4 shadow-md rounded-lg">
                <h3 class="text-xl font-semibold mb-2">Total Cows</h3>
                <p><?= count($cows) ?></p>
            </div>

            <!-- Milk Production Info -->
            <div class="bg-white p-4 shadow-md rounded-lg">
                <h3 class="text-xl font-semibold mb-2">Total Milk Records</h3>
                <p><?= count($milk_data) ?></p>
            </div>
        </div>

        <div class="mt-8">
            <h2 class="text-2xl font-semibold">Recent Milk Production Records</h2>
            <table class="table-auto w-full mt-4">
                <thead>
                    <tr>
                        <th class="border px-4 py-2">Cow ID</th>
                        <th class="border px-4 py-2">Amount Produced</th>
                        <th class="border px-4 py-2">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($milk_data as $record): ?>
                    <tr>
                        <td class="border px-4 py-2"><?= $record['cow_id'] ?></td>
                        <td class="border px-4 py-2"><?= $record['amount_produced'] ?> liters</td>
                        <td class="border px-4 py-2"><?= $record['date'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
