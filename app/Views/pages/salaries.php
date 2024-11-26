<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salaries - Dairy Farm</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEJ9vM9vYd8m5U6tMZgZj5yTc+LhT1kF0kLZPeJwN1gEuK27u27oK9Z8A6v7M" crossorigin="anonymous">

    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- Custom CSS for styling -->
    <style>
        .container {
            background-color: #ffffff;
            padding: 0.5rem 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            animation: fadeIn 1s ease-in-out;
            overflow-x: hidden;
            min-height: 500px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        h2 {
            color: #2c3e50;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .btn {
            margin-right: 5px;
        }

        .table {
            border: none;
            table-layout: fixed;
        }

        .table th,
        .table td {
            vertical-align: middle;
            color: #2c3e50;
        }

        .table th,
        .table td {
            padding: 0.25rem 0.5rem;
            font-size: 0.9rem;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .alert {
            margin-bottom: 1.5rem;
        }

        .btn-info {
            background-color: #3498db;
            border-color: #3498db;
        }

        .btn-danger {
            background-color: #e74c3c;
            border-color: #e74c3c;
        }

        .btn-success {
            background-color: #27ae60;
            border-color: #27ae60;
            font-weight: 600;
            border-radius: 5px;
            transition: transform 0.3s;
        }

        .btn-success:hover {
            transform: scale(1.05);
        }

        .text {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
        }

        .pagination-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: auto;
        }

        .search-icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
            pointer-events: none;
            font-size: 1rem;
        }
    </style>
</head>

<body class="d-flex align-items-center bg-light" style="height: 100vh;">
    <div class="container">

        <!-- Button to add a new salary and the search bar -->
        <div class="d-flex justify-content-between align-items-center">
            <div class="position-relative" style="max-width: 300px;">
                <input type="text" id="search-bar" class="form-control pr-4" placeholder="Search salaries..." oninput="searchsalaries()">
                <i class="fas fa-search search-icon"></i>
            </div>

            <div class="text">
                <a href="<?= base_url('add-salary') ?>" class="btn btn-success mt-3">
                    <i class="fas fa-plus"></i> Add New salary
                </a>
            </div>
        </div>

        <!-- Success/Error Messages -->
        <?php if (session()->getFlashdata('message')): ?>
            <div class="alert alert-success text-center"><?= session()->getFlashdata('message') ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger text-center"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <!-- Table for displaying salaries -->
        <?php if ($salaries): ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="width: 70px;">ID</th>
                        <th>Employee Name (ID)</th>
                        <th>Amount Paid</th>
                        <th>Payment date</th>
                        <th>Payment method</th>
                        <th>Note</th>
                        <th style="width: 200px;">Actions</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        <?php else: ?>
            <h3 class="text-center">No salaries recorded</h3>
        <?php endif; ?>

        <!-- Pagination Controls -->
        <div class="pagination-container">
            <span id="pagination-count"></span>
            <ul class="pagination" id="pagination"></ul>
        </div>
    </div>

    <!-- Bootstrap JS, Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybT1j3a5b7Kydn9beDcih0z8zkP8fGGp1p4v9rfOnqv7t8d47" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0M8Fq1hnwz8d8Ck93k0xt0Q4LmZOL2BxDd6DTRt+ro+/pz8D" crossorigin="anonymous"></script>

    <script>
        // Sample data (replace with your actual salary data array)
        let salaries = <?= json_encode($salaries) ?>;
        let itemsPerPage = 5; // Default items per page
        let currentPage = 1; // Track the current page
        let filteredSalaries = salaries; // Variable to hold filtered data for search

        // Function to render the table with paginated data
        function renderTable(page) {
            const start = (page - 1) * itemsPerPage;
            const end = start + itemsPerPage;
            const paginatedData = filteredSalaries.slice(start, end);
            const tableBody = document.querySelector('table tbody');
            tableBody.innerHTML = ''; // Clear previous table rows

            // Add rows for the current page
            paginatedData.forEach(salary => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${salary.id}</td>
                    <td>${salary.employee_name} (${salary.employee_id})</td>
                    <td>${salary.amount_paid}</td>
                    <td>${salary.payment_date}</td>
                    <td>${salary.payment_method}</td>
                    <td>${salary.note}</td>
                    <td>
                        <a href="/edit-salary/${salary.id}" class="btn btn-sm btn-info"><i class="fas fa-edit"></i> Edit</a>
                        <a href="/delete-salary/${salary.id}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this salary?');"><i class="fas fa-trash"></i> Delete</a>
                    </td>
                `;
                tableBody.appendChild(row);
            });

            // Update pagination count
            document.getElementById('pagination-count').textContent = `Page ${page} of ${Math.ceil(filteredSalaries.length / itemsPerPage)}`;

            // Update pagination buttons
            updatePaginationButtons(page);
        }

        function createPagination() {
            const pagination = document.getElementById('pagination');
            const totalPages = Math.ceil(filteredSalaries.length / itemsPerPage);

            // Clear previous pagination buttons
            pagination.innerHTML = '';

            // Create "Previous" button
            const prevButton = document.createElement('li');
            prevButton.classList.add('page-item');
            prevButton.innerHTML = `<a class="page-link" href="#" onclick="changePage(currentPage - 1)">Previous</a>`;
            pagination.appendChild(prevButton);

            // Create page number buttons
            for (let i = 1; i <= totalPages; i++) {
                const pageButton = document.createElement('li');
                pageButton.classList.add('page-item');
                // Highlight the current page button
                if (i === currentPage) {
                    pageButton.classList.add('active');
                }
                pageButton.innerHTML = `<a class="page-link" href="#" onclick="changePage(${i})">${i}</a>`;
                pagination.appendChild(pageButton);
            }

            // Create "Next" button
            const nextButton = document.createElement('li');
            nextButton.classList.add('page-item');
            nextButton.innerHTML = `<a class="page-link" href="#" onclick="changePage(currentPage + 1)">Next</a>`;
            pagination.appendChild(nextButton);
        }

        function updatePaginationButtons(page) {
            const pagination = document.getElementById('pagination');
            const totalPages = Math.ceil(filteredSalaries.length / itemsPerPage);

            // Disable Previous button on first page
            pagination.children[0].classList.toggle('disabled', page === 1);

            // Disable Next button on last page
            pagination.children[pagination.children.length - 1].classList.toggle('disabled', page === totalPages);

            // Highlight the current page button
            for (let i = 1; i <= totalPages; i++) {
                const pageButton = pagination.children[i];
                if (pageButton) {
                    pageButton.classList.toggle('active', i === page);
                }
            }
        }


        // Change page and render new data
        function changePage(page) {
            const totalPages = Math.ceil(filteredSalaries.length / itemsPerPage);

            // Ensure page stays within bounds
            if (page < 1) page = 1;
            if (page > totalPages) page = totalPages;

            currentPage = page;
            renderTable(page);
        }

        // Search salaries based on input
        function searchsalaries() {
            const searchTerm = document.getElementById('search-bar').value.toLowerCase();

            filteredSalaries = salaries.filter(salary => {
                return (
                    salary.employee_name.toLowerCase().includes(searchTerm) ||
                    salary.amount_paid.toLowerCase().includes(searchTerm) ||
                    salary.payment_date.toLowerCase().includes(searchTerm) ||
                    salary.payment_method.toLowerCase().includes(searchTerm) ||
                    salary.note.toLowerCase().includes(searchTerm)
                );
            });

            // Reset to first page and re-render table
            currentPage = 1;
            renderTable(currentPage);
            createPagination();
        }

        // Initialize pagination and table
        createPagination();
        renderTable(currentPage);
    </script>
</body>

</html>