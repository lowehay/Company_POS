<!DOCTYPE html>
<html>

<head>
    <title>Product Cards</title>
    <style>
        /* Styles for the product cards */
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;

        }

        table {
            border-collapse: collapse;
            width: 100%;
            max-width: 800px;
            /* Adjust the maximum width as needed */
            overflow: auto;
            /* Add this to enable scrolling if necessary */
        }

        td {
            border: 1px solid #ccc;
            padding: 10px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        }

        .product-card {
            display: flex;
            align-items: center;
        }

        .product-image img {
            max-width: 100px;
            margin-right: 10px;
        }

        .product-info {
            flex-grow: 1;
        }

        .product-Name {
            font-weight: bold;
        }

        .product-price {
            color: green;
        }
    </style>
</head>

<body>
    <div class="container">
        <table>
            <tbody>
                <?php
                if (isset($result) && !empty($result)) {
                    foreach ($result as $key => $row) {
                        $product_id = $row->product_id;
                        $product_image = $row->product_image; // Assuming 'product_image' is the column name for the image filename
                ?>
                        <tr>
                            <td>
                                <div class="product-card">
                                    <div class="product-image"><img src="<?php echo base_url('assets/images/' . $product_image); ?>" alt="Product Image" style="max-width: 100px;"></div>
                                    <div class="product-info">
                                        <div class="product-Name"><strong><?php echo ucfirst($row->product_name); ?></strong></div>
                                        <div class="product-code"><?php echo ucfirst($row->product_code); ?></div>
                                        <div class="product-price">₱<?php echo ucfirst($row->product_price); ?></div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>