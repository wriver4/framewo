<?php

/**
 * Example Products List View
 * 
 * This demonstrates how to create a list view using the ActionTable class
 */

class ProductsList extends ActionTable
{
    public function __construct($results, $lang = null)
    {
        // Define column names for the table
        $column_names = [
            'action' => 'Actions',
            'name' => 'Product Name',
            'category' => 'Category',
            'price' => 'Price',
            'stock_quantity' => 'Stock',
            'sku' => 'SKU'
        ];

        parent::__construct($results, $column_names, "products-list");
        $this->lang = $lang;
    }

    public function table_row_columns($result)
    {
        foreach ($result as $key => $value) {
            switch ($key) {
                case 'id':
                    echo '<td class="action-buttons">';
                    $this->row_nav($value, null);
                    echo '</td>';
                    break;
                case 'price':
                    echo '<td>$' . number_format($value, 2) . '</td>';
                    break;
                case 'stock_quantity':
                    $stockClass = $value > 10 ? 'text-success' : ($value > 0 ? 'text-warning' : 'text-danger');
                    echo '<td class="' . $stockClass . '">' . $value . '</td>';
                    break;
                case 'name':
                    echo '<td class="text-truncate-custom" title="' . htmlspecialchars($value) . '">';
                    echo htmlspecialchars($value);
                    echo '</td>';
                    break;
                default:
                    echo '<td>' . htmlspecialchars($value) . '</td>';
                    break;
            }
        }
    }

    public function row_nav($value, $rid)
    {
        echo '<div class="btn-group btn-group-sm" role="group">';

        // View button
        echo '<a href="view?id=' . urlencode($value) . '" 
                 class="btn btn-info btn-sm" 
                 title="View Product"
                 data-bs-toggle="tooltip">
                 <i class="far fa-eye"></i>
              </a>';

        // Edit button
        echo '<a href="edit?id=' . urlencode($value) . '" 
                 class="btn btn-warning btn-sm" 
                 title="Edit Product"
                 data-bs-toggle="tooltip">
                 <i class="far fa-edit"></i>
              </a>';

        // Delete button
        echo '<a href="delete?id=' . urlencode($value) . '" 
                 class="btn btn-danger btn-sm" 
                 title="Delete Product"
                 data-bs-toggle="tooltip"
                 onclick="return confirm(\'Are you sure you want to delete this product?\')">
                 <i class="far fa-trash-alt"></i>
              </a>';

        echo '</div>';
    }
}