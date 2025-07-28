<?php
/**
 * Products List Page Example
 * 
 * This demonstrates how to create a complete list page using the framework
 */

// Include the framework
require_once '../../autoload.php';

// Initialize security (optional - remove if not using authentication)
$security = new Security();
// $security->require_login(); // Uncomment to require login

// Page configuration
$title = 'Products Management';
$title_icon = '<i class="fas fa-box"></i>';
$button_new = true;
$new_button = 'Add Product';
$new_icon = '<i class="fas fa-plus"></i>';

try {
    // Get products data
    $products = new Products();
    $results = $products->getAllActive();
    
    // Create the list view
    $list = new ProductsList($results);
    
    // Include header
    include '../../templates/header.php';
    include '../../templates/navigation.php';
    
    // Display search box
    ?>
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="input-group">
                <span class="input-group-text">
                    <i class="fas fa-search"></i>
                </span>
                <input type="text" class="form-control" id="table-search" placeholder="Search products...">
            </div>
        </div>
        <div class="col-md-6 text-end">
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-outline-secondary" onclick="location.reload()">
                    <i class="fas fa-sync-alt"></i> Refresh
                </button>
                <a href="export" class="btn btn-outline-success">
                    <i class="fas fa-download"></i> Export
                </a>
            </div>
        </div>
    </div>
    
    <?php
    // Display the table
    if (!empty($results)) {
        $list->create_table();
    } else {
        echo '<div class="alert alert-info">
                <i class="fas fa-info-circle"></i>
                No products found. <a href="new" class="alert-link">Add your first product</a>.
              </div>';
    }
    
    // Include footer
    include '../../templates/footer.php';
    
} catch (Exception $e) {
    // Handle errors
    $error_message = 'An error occurred while loading products: ' . $e->getMessage();
    include '../../templates/header.php';
    include '../../templates/navigation.php';
    
    echo '<div class="alert alert-danger">
            <i class="fas fa-exclamation-triangle"></i>
            ' . htmlspecialchars($error_message) . '
          </div>';
    
    include '../../templates/footer.php';
}
?>