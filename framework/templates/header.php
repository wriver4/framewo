<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Framework Application' ?></title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/framework/assets/css/style.css">
</head>
<body>
    <div class="container-fluid">
        <?php if (isset($title_icon) || isset($title)): ?>
        <header class="d-flex justify-content-between align-items-center py-3 mb-4 border-bottom">
            <h1 class="h3">
                <?= $title_icon ?? '' ?>
                <?= $title ?? 'Framework Application' ?>
            </h1>
            <?php if (isset($button_new) && $button_new): ?>
            <a href="new" class="btn btn-primary">
                <?= $new_icon ?? '<i class="fas fa-plus"></i>' ?>
                <?= $new_button ?? 'New' ?>
            </a>
            <?php endif; ?>
        </header>
        <?php endif; ?>