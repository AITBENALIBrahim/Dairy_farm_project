<!DOCTYPE html>
<html lang="en">

<head>
    <title>Feed Chart</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">
    <div class="container py-5">
        <h1 class="text-center mb-4">Feed Chart</h1>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <a href="/add-feed" class="btn btn-primary mb-3">Add New Feed</a>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Cow Tag</th>
                    <th>Feed Time</th>
                    <th>Feed Type</th>
                    <th>Quantity</th>
                    <th>Date</th>
                    <th>Created By</th>
                    <th>Employee ID</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($feedCharts)): ?>
                    <?php $index = 0; ?>
                    <?php foreach ($feedCharts as $feed): ?>
                        <tr>
                            <td><?= ++$index ?></td>
                            <td><?= esc($feed['tag_number'] ?? 'N/A') ?></td>
                            <td><?= esc($feed['feed_time']) ?></td>
                            <td><?= esc($feed['feed_type']) ?></td>
                            <td><?= esc($feed['quantity']) ?> kg</td>
                            <td><?= esc($feed['date']) ?></td>
                            <td><?= esc($feed['created_by']) ?></td>
                            <td><?= esc($feed['employee_id']) ?></td>
                            <td><?= esc($feed['created_at']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" class="text-center">No Feed Records Found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>
