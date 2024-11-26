<!DOCTYPE html>
<html lang="en">
<head>
    <title>Animal Vaccinations</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container"> 1 
        <h1>Animal Vaccinations</h1>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Animal ID</th>
                    <th>Animal Type</th>
                    <th>Vaccine Name</th>
                    <th>Vaccination Date</th>
                    <th>Next Vaccine Date</th>
                    <th>Administered By</th>
                    <th>Created By</th>
                    <th>Employee ID</th>
                    <th>Notes</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                
                <?php foreach ($vaccinations as $vaccination): ?>
                    <tr>
                        <td><?= $vaccination['id'] ?></td>
                        <td><?= $vaccination['animal_id'] ?></td>
                        <td><?= $vaccination['animal_type'] ?></td>
                        <td><?= $vaccination['vaccine_name'] ?></td>
                        <td><?= $vaccination['vaccination_date'] ?></td>
                        <td><?= $vaccination['next_vaccine_date'] ?></td>
                        <td><?= $vaccination['administered_by'] ?></td>
                        <td><?= $vaccination['created_by'] ?></td>
                        <td><?= $vaccination['employee_id'] ?></td>
                        <td><?= $vaccination['notes'] ?></td>
                        <td>
                            <a href="<?= base_url('edit_vaccination/' . $vaccination['id']) ?>" class="btn btn-sm btn-primary">Edit</a>
                            <a href="<?= base_url('delete_vaccination/' . $vaccination['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this vaccination?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>Add New Vaccination</h2>
        <?php if (isset($validation_errors) && !empty($validation_errors)): ?>
            <div class="alert alert-danger">
                <?php foreach ($validation_errors as $error): ?>
                    <p><?= $error ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <form action="<?= base_url('add_vaccination') ?>" method="post">
            <div class="mb-3">
                <label for="animal_id">Animal ID:</label>
                <input type="text" name="animal_id" id="animal_id" class="form-control" value="<?= set_value('animal_id') ?>">
            </div>
            <div class="mb-3">
                <label for="animal_type">Animal Type:</label>
                <input type="text" name="animal_type" id="animal_type" class="form-control" value="<?= set_value('animal_type') ?>">
            </div>
            <div class="mb-3">
                <label for="vaccine_name">Vaccine Name:</label>
                <input type="text" name="vaccine_name" id="vaccine_name" class="form-control" value="<?= set_value('vaccine_name') ?>">
            </div>
            <div class="mb-3">
                <label for="vaccination_date">Vaccination Date:</label>
                <input type="date" name="vaccination_date" id="vaccination_date" class="form-control" value="<?= set_value('vaccination_date') ?>">
            </div>
            <button type="submit" class="btn btn-primary">Add Vaccination</button>
        </form>
    </div>
</body>
</html>