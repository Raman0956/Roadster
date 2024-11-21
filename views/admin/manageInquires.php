<?php
session_start();
require_once 'C:/xampp/htdocs/roadsters/models/InquiryModel.php';
require_once 'C:/xampp/htdocs/roadsters/views/header.php';

// Ensure the user is logged in and is an admin
if (!isset($_SESSION['userID']) || $_SESSION['role'] !== 'Admin') {
    header("Location: /roadsters/views/authentication/login.php");
    exit();
}

$inquiryModel = new InquiryModel();

// Fetch all inquiries
$inquiries = $inquiryModel->getAllInquiries();

// Separate inquiries based on carID
$validInquiries = array_filter($inquiries, fn($inquiry) => !empty($inquiry['carID']));
$nullInquiries = array_filter($inquiries, fn($inquiry) => empty($inquiry['carID']));
$pendingInquiries = array_filter($inquiries, fn($inquiry) => ($inquiry['status'] ==='Pending'));
?>

<div class="container mt-5">
    <h2 class="text-center">Manage Inquiries</h2>

    <!-- Filter Options -->
    <div class="d-flex justify-content-center my-4">
        <div class="form-check me-3">
            <input class="form-check-input" type="radio" name="inquiryFilter" id="pendingInquiries" value="pending" checked>
            <label class="form-check-label" for="pendingInquiries">Pending Inquires</label>
        </div>
        <div class="form-check me-3">
            <input class="form-check-input" type="radio" name="inquiryFilter" id="allInquiries" value="all" >
            <label class="form-check-label" for="allInquiries">All Inquiries</label>
        </div>
        <div class="form-check me-3">
            <input class="form-check-input" type="radio" name="inquiryFilter" id="validInquiries" value="valid">
            <label class="form-check-label" for="validInquiries">General Inquires</label>
        </div>
        <div class="form-check me-3">
            <input class="form-check-input" type="radio" name="inquiryFilter" id="nullInquiries" value="null">
            <label class="form-check-label" for="nullInquiries">Service Inquires</label>
        </div>
    </div>

    <!-- All Inquiries Table -->
<div id="allInquiriesTable" class="inquiry-table" style="display: none;">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>User ID</th>
                <th>Stock ID</th>
                <th>Make</th>
                <th>Model</th>
                <th>Service</th>
                <th>Message</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($inquiries as $inquiry): ?>
                <tr>
                    <td><?= htmlspecialchars($inquiry['userID']); ?></td>
                    <td><?= htmlspecialchars($inquiry['carID'] ?? 'N/A'); ?></td>
                    <td><?= htmlspecialchars($inquiry['make'] ?? 'N/A'); ?></td>
                    <td><?= htmlspecialchars($inquiry['model'] ?? 'N/A'); ?></td>
                    <td><?= htmlspecialchars($inquiry['serviceName'] ?? 'N/A'); ?></td>
                    <td><?= htmlspecialchars($inquiry['message']); ?></td>
                    <td><?= htmlspecialchars($inquiry['status']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Pending Inquiries Table -->
<div id="pendingInquiriesTable" class="inquiry-table" >
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>User ID</th>
                <th>Stock ID</th>
                <th>Make</th>
                <th>Model</th>
                <th>Service</th>
                <th>Message</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pendingInquiries as $inquiry): ?>
                <tr>
                    <td><?= htmlspecialchars($inquiry['userID']); ?></td>
                    <td><?= htmlspecialchars($inquiry['carID'] ?? 'N/A'); ?></td>
                    <td><?= htmlspecialchars($inquiry['make'] ?? 'N/A'); ?></td>
                    <td><?= htmlspecialchars($inquiry['model'] ?? 'N/A'); ?></td>
                    <td><?= htmlspecialchars($inquiry['serviceName'] ?? 'N/A'); ?></td>
                    <td><?= htmlspecialchars($inquiry['message']); ?></td>
                    <td><?= htmlspecialchars($inquiry['status']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Valid Inquiries Table -->
<div id="validInquiriesTable" class="inquiry-table" style="display: none;">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>User ID</th>
                <th>Stock ID</th>
                <th>Make</th>
                <th>Model</th>
                <th>Service</th>
                <th>Message</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($validInquiries as $inquiry): ?>
                <tr>
                    <td><?= htmlspecialchars($inquiry['userID']); ?></td>
                    <td><?= htmlspecialchars($inquiry['carID']); ?></td>
                    <td><?= htmlspecialchars($inquiry['make'] ?? 'N/A'); ?></td>
                    <td><?= htmlspecialchars($inquiry['model'] ?? 'N/A'); ?></td>
                    <td><?= htmlspecialchars($inquiry['serviceName'] ?? 'N/A'); ?></td>
                    <td><?= htmlspecialchars($inquiry['message']); ?></td>
                    <td><?= htmlspecialchars($inquiry['status']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Service Inquiries Table -->
<div id="nullInquiriesTable" class="inquiry-table" style="display: none;">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>User ID</th>
                <th>Service</th>
                <th>Message</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($nullInquiries as $inquiry): ?>
                <tr>
                    <td><?= htmlspecialchars($inquiry['userID']); ?></td>
                    <td><?= htmlspecialchars($inquiry['serviceName'] ?? 'N/A'); ?></td>
                    <td><?= htmlspecialchars($inquiry['message']); ?></td>
                    <td><?= htmlspecialchars($inquiry['status']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    document.querySelectorAll('input[name="inquiryFilter"]').forEach(radio => {
        radio.addEventListener('change', function() {
            document.querySelectorAll('.inquiry-table').forEach(table => {
                table.style.display = 'none';
            });
            const selectedTable = document.getElementById(`${this.value}InquiriesTable`);
            if (selectedTable) {
                selectedTable.style.display = 'block';
            }
        });
    });
</script>
