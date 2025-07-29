<?php
/**
 * Framework Demo Index Page
 * 
 * This demonstrates the basic framework functionality
 */


// Include the framework
require_once dirname($_SERVER['DOCUMENT_ROOT']) . '/framework/autoload.php';

// Initialize security
$security = new Security();

// Page configuration
$title = 'PHP Web Framework';
$title_icon = '<i class="fas fa-cogs"></i>';

// Include header and navigation
include FRAMEWORK . '/templates/header.php';
include FRAMEWORK . '/templates/navigation.php';
?>

<div class="row">
  <div class="col-12">
    <div class="jumbotron bg-primary text-white p-5 rounded mb-4">
      <h1 class="display-4">
        <i class="fas fa-rocket"></i>
        Welcome to PHP Web Framework
      </h1>
      <p class="lead">
        A lightweight, flexible PHP framework for building web applications quickly and efficiently.
      </p>
      <hr class="my-4">
      <p>
        This framework provides essential components for database management, user authentication,
        table displays, and form handling.
      </p>
      <a class="btn btn-light btn-lg"
         href="examples/products/list.php"
         role="button">
        <i class="fas fa-play"></i>
        View Examples
      </a>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-4">
    <div class="card h-100">
      <div class="card-body">
        <h5 class="card-title">
          <i class="fas fa-database text-primary"></i>
          Database Management
        </h5>
        <p class="card-text">
          Built-in database abstraction layer with PDO support, connection pooling,
          and easy configuration for multiple database environments.
        </p>
        <ul class="list-unstyled">
          <li><i class="fas fa-check text-success"></i> PDO-based connections</li>
          <li><i class="fas fa-check text-success"></i> Multiple database support</li>
          <li><i class="fas fa-check text-success"></i> Connection pooling</li>
        </ul>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card h-100">
      <div class="card-body">
        <h5 class="card-title">
          <i class="fas fa-table text-success"></i>
          Table Components
        </h5>
        <p class="card-text">
          Flexible table display components with built-in action buttons,
          sorting capabilities, and responsive design.
        </p>
        <ul class="list-unstyled">
          <li><i class="fas fa-check text-success"></i> ActionTable with CRUD buttons</li>
          <li><i class="fas fa-check text-success"></i> ViewTable for read-only data</li>
          <li><i class="fas fa-check text-success"></i> Bootstrap styling</li>
        </ul>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card h-100">
      <div class="card-body">
        <h5 class="card-title">
          <i class="fas fa-shield-alt text-warning"></i>
          Security Features
        </h5>
        <p class="card-text">
          Comprehensive security features including authentication, authorization,
          CSRF protection, and input validation.
        </p>
        <ul class="list-unstyled">
          <li><i class="fas fa-check text-success"></i> Session management</li>
          <li><i class="fas fa-check text-success"></i> CSRF protection</li>
          <li><i class="fas fa-check text-success"></i> Input sanitization</li>
        </ul>
      </div>
    </div>
  </div>
</div>

<div class="row mt-4">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title mb-0">
          <i class="fas fa-rocket"></i>
          Quick Start
        </h5>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <h6><i class="fas fa-download"></i> Installation</h6>
            <ol>
              <li>Copy the framework to your web server</li>
              <li>Configure your database settings</li>
              <li>Import the database schema</li>
              <li>Start building your application!</li>
            </ol>
            <a href="INSTALLATION.md"
               class="btn btn-outline-primary btn-sm">
              <i class="fas fa-book"></i>
              Installation Guide
            </a>
          </div>
          <div class="col-md-6">
            <h6><i class="fas fa-code"></i> Example Usage</h6>
            <pre><code><?= htmlspecialchars('<?php
// Include framework
require_once \'framework/autoload.php\';

// Create a model
class MyModel extends Database {
    public function getAll() {
        $sql = "SELECT * FROM my_table";
        return $this->getConnection()->query($sql)->fetchAll();
    }
}

// Create a list view
class MyList extends ActionTable {
    // Custom table implementation
}

// Use in your page
$model = new MyModel();
$data = $model->getAll();
$list = new MyList($data, $columns, "my-table");
$list->create_table();') ?></code></pre>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row mt-4">
  <div class="col-12">
    <div class="alert alert-info">
      <h6><i class="fas fa-lightbulb"></i> Framework Features</h6>
      <div class="row">
        <div class="col-md-6">
          <ul class="mb-0">
            <li>Database abstraction layer</li>
            <li>Table display components</li>
            <li>Security and authentication</li>
            <li>Form validation helpers</li>
          </ul>
        </div>
        <div class="col-md-6">
          <ul class="mb-0">
            <li>Template system</li>
            <li>Asset management</li>
            <li>Error handling</li>
            <li>Extensible architecture</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include FRAMEWORK . '/templates/footer.php';