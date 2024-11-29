<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cows</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body class="d-flex align-items-center bg-light" style="height: 100vh;">
    <div class="container">
        <h1>Cows</h1>

        <!-- Search bar and Add Cow Button -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="position-relative" style="max-width: 300px;">
                <input type="text" id="search-bar" class="form-control pr-4" placeholder="Search cows..." oninput="searchCows()">
                <i class="fas fa-search search-icon"></i>
            </div>

            <div class="text">
                <a href="<?= base_url('add_cow') ?>" class="btn btn-success mt-3">
                    <i class="fas fa-plus"></i> Add New Cow
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

        <!-- Table for displaying cows -->
        <?php if ($cows): ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="width: 70px;">ID</th>
                        <th>Tag Number</th>
                        <th>Date of Birth</th>
                        <th>Health Status</th>
                        <th>Stall ID</th>
                        <th>Sale Status</th>
                        <th style="width: 200px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data rows will be dynamically rendered by JS -->
                </tbody>
            </table>
        <?php else: ?>
            <h3 class="text-center">No cows added</h3>
        <?php endif; ?>

        <!-- Pagination Controls -->
        <div class="pagination-container">
            <span id="pagination-count"></span> <!-- Display the current page and total pages -->
            <ul class="pagination" id="pagination">
                <!-- Pagination buttons will be dynamically added by JavaScript -->
            </ul>
        </div>

        <!-- Add Cow Form (visible only on Add New Cow page) -->
        

    <!-- Bootstrap JS, Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybT1j3sA5b7Kydn9beDcih0z8zkP8fGGp1p4v9rfOnqv7t8d47" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0M8Fq1hnwz8d8Ck93k0xt0Q4LmZOL2BxDd6DTRt+ro+/pz8D" crossorigin="anonymous"></script>

    <script>
        // Sample data (replace with your actual cow data array)
        let cows = <?= json_encode($cows) ?>;
        let itemsPerPage = 5; // Default items per page
        let currentPage = 1; // Track the current page
        let filteredCows = cows; // Variable to hold filtered data for search

        // Function to render the table with paginated data
        function renderTable(page) {
            const start = (page - 1) * itemsPerPage;
            const end = start + itemsPerPage;
            const paginatedData = filteredCows.slice(start, end);
            const tableBody = document.querySelector('table tbody');
            tableBody.innerHTML = ''; // Clear previous table rows

            // Add rows for the current page
            paginatedData.forEach(cow => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${cow.id}</td>
                    <td>${cow.tag_number}</td>
                    <td>${cow.date_of_birth}</td>
                    <td>${cow.health_status}</td>
                    <td>${cow.stall_id}</td>
                    <td>${cow.sale_status}</td>
                    <td>
                        <a href="/edit_cow/${cow.id}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> Edit</a>
                        <a href="/delete_cow/${cow.id}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this cow?');"><i class="fas fa-trash"></i> Delete</a>
                    </td>
                `;
                tableBody.appendChild(row);
            });

            // Update pagination count
            document.getElementById('pagination-count').textContent = `Page ${page} of ${Math.ceil(filteredCows.length / itemsPerPage)}`;

            // Update pagination buttons
            updatePaginationButtons(page);
        }

        function createPagination() {
            const pagination = document.getElementById('pagination');
            const totalPages = Math.ceil(filteredCows.length / itemsPerPage);

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
            const totalPages = Math.ceil(filteredCows.length / itemsPerPage);

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
            const totalPages = Math.ceil(filteredCows.length / itemsPerPage);

            // Ensure page stays within bounds
            if (page < 1) page = 1;
            if (page > totalPages) page = totalPages;

            currentPage = page;
            renderTable(page);
        }

        // Search cows based on input
        function searchCows() {
            const searchTerm = document.getElementById('search-bar').value.toLowerCase();

            filteredCows = cows.filter(cow => {
                return (
                    cow.tag_number.toLowerCase().includes(searchTerm) ||
                    cow.date_of_birth.toLowerCase().includes(searchTerm) ||
                    cow.health_status.toLowerCase().includes(searchTerm) ||
                    cow.stall_id.toLowerCase().includes(searchTerm) ||
                    cow.sale_status.toLowerCase().includes(searchTerm)
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
