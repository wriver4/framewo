<?php
/**
 * New Product Form Example
 * 
 * This demonstrates how to create a form page using the framework
 */

// Include the framework
require_once dirname($_SERVER['DOCUMENT_ROOT']) . '/framework/autoload.php';

// Initialize security and helpers
$security = new Security();
$helpers = new Helpers();
// $security->require_login(); // Uncomment to require login

// Page configuration
$title = 'Add New Product';
$title_icon = '<i class="fas fa-plus"></i>';

$errors = [];
$success = false;

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate CSRF token (if using)
    // if (!$security->verify_csrf_token($_POST['csrf_token'] ?? '')) {
    //     $errors[] = 'Invalid security token. Please try again.';
    // }
    
    // Get and sanitize form data
    $name = $helpers->sanitize_input($_POST['name'] ?? '');
    $description = $helpers->sanitize_input($_POST['description'] ?? '');
    $category = $helpers->sanitize_input($_POST['category'] ?? '');
    $price = $helpers->sanitize_input($_POST['price'] ?? '');
    $stock_quantity = (int)($_POST['stock_quantity'] ?? 0);
    $sku = $helpers->sanitize_input($_POST['sku'] ?? '');
    
    // Validate required fields
    $validation_errors = $helpers->validate_required([
        'name' => $name,
        'category' => $category,
        'price' => $price,
        'sku' => $sku
    ]);
    
    $errors = array_merge($errors, $validation_errors);
    
    // Additional validation
    if (!empty($price) && !is_numeric($price)) {
        $errors[] = 'Price must be a valid number';
    }
    
    if (!empty($sku)) {
        // Check if SKU already exists (you would implement this in Products class)
        // $products = new Products();
        // if ($products->skuExists($sku)) {
        //     $errors[] = 'SKU already exists';
        // }
    }
    
    // If no errors, create the product
    if (empty($errors)) {
        try {
            $products = new Products();
            $product_id = $products->create($name, $description, $category, $price, $stock_quantity, $sku);
            
            if ($product_id) {
                $success = true;
                // Redirect to list page
                header('Location: list.php?success=created');
                exit;
            } else {
                $errors[] = 'Failed to create product. Please try again.';
            }
        } catch (Exception $e) {
            $errors[] = 'Error: ' . $e->getMessage();
        }
    }
}

// Generate CSRF token
$csrf_token = $security->generate_csrf_token();

// Include header
include FRAMEWORK . '/templates/header.php';
include FRAMEWORK . '/templates/navigation.php';
?>

<div class="row justify-content-center">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title mb-0">
          <i class="fas fa-box"></i>
          Product Information
        </h5>
      </div>
      <div class="card-body">
        <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
          <i class="fas fa-exclamation-triangle"></i>
          <strong>Please correct the following errors:</strong>
          <ul class="mb-0 mt-2">
            <?php foreach ($errors as $error): ?>
            <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
        <?php endif; ?>

        <form method="POST"
              class="needs-validation"
              novalidate>
          <input type="hidden"
                 name="csrf_token"
                 value="<?= $csrf_token ?>">

          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="name"
                       class="form-label">Product Name *</label>
                <input type="text"
                       class="form-control"
                       id="name"
                       name="name"
                       value="<?= htmlspecialchars($_POST['name'] ?? '') ?>"
                       required>
                <div class="invalid-feedback">
                  Please provide a product name.
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="sku"
                       class="form-label">SKU *</label>
                <input type="text"
                       class="form-control"
                       id="sku"
                       name="sku"
                       value="<?= htmlspecialchars($_POST['sku'] ?? '') ?>"
                       required>
                <div class="invalid-feedback">
                  Please provide a SKU.
                </div>
              </div>
            </div>
          </div>

          <div class="mb-3">
            <label for="description"
                   class="form-label">Description</label>
            <textarea class="form-control"
                      id="description"
                      name="description"
                      rows="3"><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea>
          </div>

          <div class="row">
            <div class="col-md-4">
              <div class="mb-3">
                <label for="category"
                       class="form-label">Category *</label>
                <select class="form-select"
                        id="category"
                        name="category"
                        required>
                  <option value="">Select Category</option>
                  <option value="Electronics"
                          <?= ($_POST['category'] ?? '') === 'Electronics' ? 'selected' : '' ?>>Electronics</option>
                  <option value="Clothing"
                          <?= ($_POST['category'] ?? '') === 'Clothing' ? 'selected' : '' ?>>Clothing</option>
                  <option value="Books"
                          <?= ($_POST['category'] ?? '') === 'Books' ? 'selected' : '' ?>>Books</option>
                  <option value="Home & Garden"
                          <?= ($_POST['category'] ?? '') === 'Home & Garden' ? 'selected' : '' ?>>Home & Garden</option>
                  <option value="Sports"
                          <?= ($_POST['category'] ?? '') === 'Sports' ? 'selected' : '' ?>>Sports</option>
                </select>
                <div class="invalid-feedback">
                  Please select a category.
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="mb-3">
                <label for="price"
                       class="form-label">Price *</label>
                <div class="input-group">
                  <span class="input-group-text">$</span>
                  <input type="number"
                         class="form-control"
                         id="price"
                         name="price"
                         step="0.01"
                         min="0"
                         value="<?= htmlspecialchars($_POST['price'] ?? '') ?>"
                         required>
                  <div class="invalid-feedback">
                    Please provide a valid price.
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="mb-3">
                <label for="stock_quantity"
                       class="form-label">Stock Quantity</label>
                <input type="number"
                       class="form-control"
                       id="stock_quantity"
                       name="stock_quantity"
                       min="0"
                       value="<?= htmlspecialchars($_POST['stock_quantity'] ?? '0') ?>">
              </div>
            </div>
          </div>

          <div class="d-flex justify-content-between">
            <a href="list.php"
               class="btn btn-secondary">
              <i class="fas fa-arrow-left"></i>
              Back to List
            </a>
            <button type="submit"
                    class="btn btn-primary">
              <i class="fas fa-save"></i>
              Create Product
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include FRAMEWORK . '/templates/footer.php';