<?php
// Include necessary files
include '../backend/db.php';
include '../backend/authorsSearchSlider.php';

// Collect filters
$filters = [
    'search' => isset($_GET['k']) ? trim($_GET['k']) : null,
    'author' => isset($_GET['author']) ? trim($_GET['author']) : null,
    'type' => isset($_GET['type']) ? trim($_GET['type']) : null
];
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Include the supplements renderer component
include '../backend/partials/renderSupplements.php';
?>

<?php include '../components/header.php'; ?>
<?php include '../components/top-navbar.php'; ?>
<?php include '../components/page-header-supplements.php'; ?>

<main id="supplements">
    <?php include '../components/filter-section.php'; ?>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <div style="display: flex; justify-content: space-between; align-items: center; margin: 20px;">
        <div style="background-color: rgba(128, 128, 128, 0.089); border-radius: 8px; display: inline-block; padding: 6px;">
            <a href="../issues" style="color: rgb(85, 84, 84); padding: 8px 20px; text-decoration: none;">Issues</a>
            <a href="?" style="background-color: blueviolet; padding: 8px 20px; color: whitesmoke; border-radius: 8px; text-decoration: none; display: inline-block;">Supplements</a>
        </div>
        
        <div>
            <select class="form--control" name="year" id="yearFilter" style="padding: 8px; border-radius: 4px; border: 1px solid #ddd;">
                <option value="">Select Year</option>
                <option value="2023" <?php echo (isset($_GET['year']) && $_GET['year'] == '2023') ? 'selected' : ''; ?>>2023</option>
                <option value="2024" <?php echo (isset($_GET['year']) && $_GET['year'] == '2024') ? 'selected' : ''; ?>>2024</option>
                <option value="2025" <?php echo (isset($_GET['year']) && $_GET['year'] == '2025') ? 'selected' : ''; ?>>2025</option>
            </select>
        </div>
    </div>

    <div class="issueslay" style="display: flex; gap: 30px; padding: 20px;">
        <section class="bd-bottom padding">
            <div id="articleListContainer" class="grid grid-cols-2 gap-4">
                <?php
                // Render supplements with filters (is_publication = 'no' for supplements)
                renderSupplements($con, $page, $filters);
                ?>
            </div>
        </section>
        
        <?php include '../components/sidebar.php'; ?>
    </div>
</main>

<?php include '../components/footer.php'; ?>

<script>
// Toggle format links function
window.toggleFormatLinks = function(button) {
    const formatLinks = button.nextElementSibling;
    if (formatLinks.style.display === 'none' || formatLinks.style.display === '') {
        formatLinks.style.display = 'block';
        button.textContent = 'Hide Options ▲';
    } else {
        formatLinks.style.display = 'none';
        button.textContent = 'Show Options ▼';
    }
};

// Initialize format links to be hidden
document.querySelectorAll('.format-links').forEach(links => {
    links.style.display = 'none';
});

// Year filter
document.getElementById('yearFilter')?.addEventListener('change', function() {
    const year = this.value;
    const currentUrl = new URL(window.location.href);
    
    if (year) {
        currentUrl.searchParams.set('year', year);
    } else {
        currentUrl.searchParams.delete('year');
    }
    
    window.location.href = currentUrl.toString();
});
</script>