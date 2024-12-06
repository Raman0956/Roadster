<?php
session_start();
require_once 'C:/xampp/htdocs/roadsters/models/InquiryModel.php';
require_once 'C:/xampp/htdocs/roadsters/models/TestDriveModel.php';
require_once 'C:/xampp/htdocs/roadsters/views/header.php';

// Ensure the user is logged in and is an admin
if (!isset($_SESSION['userID']) || $_SESSION['role'] !== 'Admin') {
    header("Location: /roadsters/views/authentication/login.php");
    exit();
}

$inquiryModel = new InquiryModel();
$testDriveModel = new TestDriveModel();

// Fetch all inquiries
$inquiries = $inquiryModel->getAllInquiries();
$testDriveInquiries = $testDriveModel->getAllTestDriveInquiries();

// Separate inquiries based on carID
$validInquiries = array_filter($inquiries, fn($inquiry) => !empty($inquiry['carID']));
$nullInquiries = array_filter($inquiries, fn($inquiry) => empty($inquiry['carID']));

// Handle filter type and status filter
$filterType = $_POST['filterType'] ?? $_SESSION['filterType'] ?? 'testDrive';


// Handle status filter for each filter type
if ($filterType === 'testDrive') {
    $statusFilter = $_POST['statusFilter'] ?? $_SESSION['testDriveStatusFilter'] ?? '';
    $_SESSION['testDriveStatusFilter'] = $statusFilter;
} elseif ($filterType === 'validInquiries') {
    $statusFilter = $_POST['statusFilter'] ?? $_SESSION['validInquiriesStatusFilter'] ?? '';
    $_SESSION['validInquiriesStatusFilter'] = $statusFilter;
} elseif ($filterType === 'nullInquiries') {
    $statusFilter = $_POST['statusFilter'] ?? $_SESSION['nullInquiriesStatusFilter'] ?? '';
    $_SESSION['nullInquiriesStatusFilter'] = $statusFilter;
} else {
    $statusFilter = '';
}

// Apply filters based on type
$filteredTestDriveInquiries = ($filterType === 'testDrive' && $statusFilter)
    ? array_filter($testDriveInquiries, fn($inquiry) => $inquiry['status'] === $statusFilter)
    : $testDriveInquiries;

$filteredValidInquiries = ($filterType === 'validInquiries' && $statusFilter)
    ? array_filter($validInquiries, fn($inquiry) => $inquiry['status'] === $statusFilter)
    : $validInquiries;

$filteredNullInquiries = ($filterType === 'nullInquiries' && $statusFilter)
    ? array_filter($nullInquiries, fn($inquiry) => $inquiry['status'] === $statusFilter)
    : $nullInquiries;


    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['bookingUpdate'])) {
        $selectedBookings = $_POST['selectedBookings'] ?? [];
        $newStatus = $_POST['bulkStatus'] ?? '';
    
        if (!empty($selectedBookings) && !empty($newStatus)) {
            foreach ($selectedBookings as $bookingID) {
                $testDriveModel->updateBookingStatus($bookingID, $newStatus);
            }
            echo "<script>alert('Bookings updated successfully!'); window.location.href='';</script>";
        } else {
            echo "<script>alert('Please select bookings and a status to update.');</script>";
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['validInquiryUpdate'])) {
        $selectedInquires = $_POST['selectedInquires'] ?? [];
        $newStatus = $_POST['bulkStatus'] ?? '';
    
        if (!empty($selectedInquires) && !empty($newStatus)) {
            foreach ($selectedInquires as $inquiryID) {
                $inquiryModel->updateInquiryStatus($inquiryID, $newStatus);
            }
            echo "<script>alert('Inquires updated successfully!'); window.location.href='';</script>";
        } else {
            echo "<script>alert('Please select Inquires and a status to update.');</script>";
        }
    }
    

?>

<div class="container mt-5">
    <h2 class="text-center">Manage Inquiries</h2>

    <!-- Filter Options -->
    <div class="d-flex justify-content-center my-4">
    <div class="form-check me-3">
        <input class="form-check-input" type="radio" name="inquiryFilter" id="allInquiries" value="testDrive" 
            <?= ($filterType === 'testDrive') ? 'checked' : ''; ?>>
        <label class="form-check-label" for="allInquiries">Test Drive Inquiries</label>
    </div>
    <div class="form-check me-3">
        <input class="form-check-input" type="radio" name="inquiryFilter" id="validInquiries" value="validInquiries" 
            <?= ($filterType === 'validInquiries') ? 'checked' : ''; ?>>
        <label class="form-check-label" for="validInquiries">General Inquiries</label>
    </div>
    <div class="form-check me-3">
        <input class="form-check-input" type="radio" name="inquiryFilter" id="nullInquiries" value="nullInquiries" 
            <?= ($filterType === 'nullInquiries') ? 'checked' : ''; ?>>
        <label class="form-check-label" for="nullInquiries">Service Inquiries</label>
    </div>
</div>


    
     <!-- Test Drive Inquiries Table -->
     <form method="POST" action="">
        <div id="allInquiriesTable" class="inquiry-table" style="<?= ($filterType === 'testDrive') ? 'display: block;' : 'display: none;'; ?>">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Select</th>
                        <th>User ID</th>
                        <th>User Email</th>
                        <th>Stock ID</th>
                        <th>Make</th>
                        <th>Model</th>
                        <th>Preferred Date</th>
                        <th>Preferred Time</th>
                        <th>
                            <select name="statusFilter" class="form-select" onchange="this.form.submit()">
                                <option value="">All</option>
                                <option value="Pending" <?= ($filterType === 'testDrive' && $statusFilter === 'Pending') ? 'selected' : ''; ?>>Pending</option>
                                <option value="Approved" <?= ($filterType === 'testDrive' && $statusFilter === 'Approved') ? 'selected' : ''; ?>>Approved</option>
                                <option value="Completed" <?= ($filterType === 'testDrive' && $statusFilter === 'Completed') ? 'selected' : ''; ?>>Completed</option>
                            </select>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($filteredTestDriveInquiries as $inquiry): ?>
                        <tr>
                            <td><input type="checkbox" name="selectedBookings[]" value="<?= htmlspecialchars($inquiry['bookingID']); ?>"></td>
                            <td><?= htmlspecialchars($inquiry['userID']); ?></td>
                            <td><?= htmlspecialchars($inquiry['email']); ?></td>
                            <td><?= htmlspecialchars($inquiry['carID'] ?? 'N/A'); ?></td>
                            <td><?= htmlspecialchars($inquiry['make'] ?? 'N/A'); ?></td>
                            <td><?= htmlspecialchars($inquiry['model'] ?? 'N/A'); ?></td>
                            <td><?= htmlspecialchars($inquiry['preferredDate'] ?? 'N/A'); ?></td>
                            <td><?= htmlspecialchars($inquiry['preferredTime']); ?></td>
                            <td><?= htmlspecialchars($inquiry['status']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Bulk Update (Visible Only for Test Drive Inquiries) -->
        <?php if ($filterType === 'testDrive'): ?>
            <div class="mb-3">
                <label for="bulkStatus" class="form-label">Update Selected Status:</label>
                <select name="bulkStatus" id="bulkStatus" class="form-select" required>
                    <option value="">Select Status</option>
                    <option value="Pending">Pending</option>
                    <option value="Approved">Approved</option>
                    <option value="Completed">Completed</option>
                </select>
            </div>
            <button type="submit" name="bookingUpdate" class="btn-stndrd">Update Selected</button>
        <?php endif; ?>
    </form>
    </div>


<!-- Valid Inquiries Table -->
<form method="POST" action="">
<div id="validInquiriesTable" class="inquiry-table" style="<?= ($filterType === 'validInquiries') ? 'display: block;' : 'display: none;'; ?>">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Select</th>
                <th>User ID</th>
                <th>Stock ID</th>
                <th>Make</th>
                <th>Model</th>
                <th>Client Email</th>
                <th>Message</th>
                <th><form method="POST" action="">
                    <input type="hidden" name="filterType" value="validInquiries">
                    <select name="statusFilter" class="form-select" onchange="this.form.submit()">
                        <option value="">All</option>
                        <option value="Pending" <?= ($_SESSION['validInquiriesStatusFilter'] === 'Pending') ? 'selected' : ''; ?>>Pending</option>
                        <option value="Answered" <?= ($_SESSION['validInquiriesStatusFilter'] === 'Answered') ? 'selected' : ''; ?>>Answered</option>
                    </select>
                </form>

</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($filteredValidInquiries as $inquiry): ?>
                <tr>
                    <td><input type="checkbox" name="selectedInquires[]" value="<?= htmlspecialchars($inquiry['inquiryID']); ?>"></td>
                     <td><?= htmlspecialchars($inquiry['userID']); ?></td>
                    <td><?= htmlspecialchars($inquiry['carID']); ?></td>
                    <td><?= htmlspecialchars($inquiry['make'] ?? 'N/A'); ?></td>
                    <td><?= htmlspecialchars($inquiry['model'] ?? 'N/A'); ?></td>
                    <td><?= htmlspecialchars($inquiry['email'] ?? 'N/A'); ?></td>
                    <td><?= htmlspecialchars($inquiry['message']); ?></td>
                    <td><?= htmlspecialchars($inquiry['status']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

    <!-- Bulk Update (Visible Only for Test Drive Inquiries) -->
    <?php if ($filterType === 'validInquiries'): ?>
                <div class="mb-3">
                    <label for="bulkStatus" class="form-label">Update Selected Status:</label>
                    <select name="bulkStatus" id="bulkStatus" class="form-select" required>
                        <option value="">Select Status</option>
                        <option value="Pending">Pending</option>
                        <option value="Answered">Answered</option>
                    </select>
                </div>
                <button type="submit" name="validInquiryUpdate" class="btn-stndrd">Update Selected</button>
            <?php endif; ?>
    </form>
    </div>


<!-- Service Inquiries Table -->
<div id="nullInquiriesTable" class="inquiry-table" style="<?= ($filterType === 'nullInquiries') ? 'display: block;' : 'display: none;'; ?>">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Select</th>
                <th>User ID</th>
                <th>Client Email</th>
                <th>Service</th>
                <th>Message</th>
                <th><form method="POST" action="">
                    <input type="hidden" name="filterType" value="nullInquiries">
                    <select name="statusFilter" class="form-select" onchange="this.form.submit()">
                        <option value="">All</option>
                        <option value="Pending" <?= ($_SESSION['nullInquiriesStatusFilter'] === 'Pending') ? 'selected' : ''; ?>>Pending</option>
                        <option value="Answered" <?= ($_SESSION['nullInquiriesStatusFilter'] === 'Answered') ? 'selected' : ''; ?>>Answered</option>
                    </select>
                </form>

</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($filteredNullInquiries as $inquiry): ?>
                <tr>
                    <td><input type="checkbox" name="selectedInquires[]" value="<?= htmlspecialchars($inquiry['inquiryID']); ?>"></td>
                    <td><?= htmlspecialchars($inquiry['userID']); ?></td>
                    <td><?= htmlspecialchars($inquiry['email'] ?? 'N/A'); ?></td>
                    <td><?= htmlspecialchars($inquiry['serviceName'] ?? 'N/A'); ?></td>
                    <td><?= htmlspecialchars($inquiry['message']); ?></td>
                    <td><?= htmlspecialchars($inquiry['status']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

    <!-- Bulk Update (Visible Only for Test Drive Inquiries) -->
    <?php if ($filterType === 'nullInquiries'): ?>
                    <div class="mb-3">
                        <label for="bulkStatus" class="form-label">Update Selected Status:</label>
                        <select name="bulkStatus" id="bulkStatus" class="form-select" required>
                            <option value="">Select Status</option>
                            <option value="Pending">Pending</option>
                            <option value="Answered">Answered</option>
                        </select>
                    </div>
                    <button type="submit" name="validInquiryUpdate" class="btn-stndrd">Update Selected</button>
                <?php endif; ?>
        </form>
        </div>

<script>
    document.querySelectorAll('input[name="inquiryFilter"]').forEach(radio => {
    radio.addEventListener('change', function () {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '';
        
        const filterTypeInput = document.createElement('input');
        filterTypeInput.type = 'hidden';
        filterTypeInput.name = 'filterType';
        filterTypeInput.value = this.value;
        form.appendChild(filterTypeInput);
        
        document.body.appendChild(form);
        form.submit();
    });
});


</script>
