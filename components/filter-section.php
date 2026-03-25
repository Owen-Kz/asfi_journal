<?php
include "../backend/db.php";

// Fetch unique authors
$authorsList = [];
$authorsQuery = "SELECT DISTINCT authors_fullname FROM authors ORDER BY authors_fullname ASC";
$authorsResult = mysqli_query($con, $authorsQuery);
if ($authorsResult && mysqli_num_rows($authorsResult) > 0) {
    while ($author = mysqli_fetch_assoc($authorsResult)) {
        $authorsList[] = $author['authors_fullname'];
    }
}

// Fetch unique article types from journals
$typesList = [];
$typesQuery = "SELECT DISTINCT article_type FROM journals WHERE article_type IS NOT NULL AND article_type != '' ORDER BY article_type ASC";
$typesResult = mysqli_query($con, $typesQuery);
if ($typesResult && mysqli_num_rows($typesResult) > 0) {
    while ($type = mysqli_fetch_assoc($typesResult)) {
        $typesList[] = $type['article_type'];
    }
}
?>

<section class="pt-3">
    <div class="containerf">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card custom--card responsive-filter-card mb-4" style="justify-content: center; display: flex;">
                    <div class="card-body">
                        <form id="searchArticle" method="GET" action="">
                            <div class="d-flex flex-wrap gap-4 filter-card" style="align-items: flex-end;">
                                <div class="flex-grow-1">
                                    <label class="form--label">Search Journal</label>
                                    <input type="text" name="k" id="search" class="form--control" value="<?php echo isset($_GET['k']) ? htmlspecialchars($_GET['k']) : ''; ?>" placeholder="Enter journal title...">
                                </div>

                                <div class="flex-grow-1">
                                    <label class="form--label">Author</label>
                                    <select name="author" id="authorsOption" class="form--control">
                                        <option value="">All Authors</option>
                                        <?php foreach ($authorsList as $author): ?>
                                            <option value="<?php echo htmlspecialchars($author); ?>" <?php echo (isset($_GET['author']) && $_GET['author'] == $author) ? 'selected' : ''; ?>>
                                                <?php echo htmlspecialchars($author); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="flex-grow-1">
                                    <label class="form--label">Article Type</label>
                                    <select name="type" class="form--control" id="typeOption">
                                        <option value="">All Types</option>
                                        <?php foreach ($typesList as $type): ?>
                                            <option value="<?php echo htmlspecialchars($type); ?>" <?php echo (isset($_GET['type']) && $_GET['type'] == $type) ? 'selected' : ''; ?>>
                                                <?php echo htmlspecialchars($type); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                
                                <div class="flex-grow-1">
                                    <input type="hidden" name="page" value="1">
                                    <button type="submit" class="btn btn--base w-100" style="background-color: #80078b; color:whitesmoke">
                                        <i class="las la-filter"></i> Filter
                                    </button>
                                </div>
                                
                                <div class="flex-grow-1">
                                    <a href="?" class="btn btn--base w-100" style="background-color: #6c757d; color:white; text-decoration: none; display: inline-block; text-align: center; padding: 8px 16px; border-radius: 4px;">
                                        <i class="las la-sync-alt"></i> Reset
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>