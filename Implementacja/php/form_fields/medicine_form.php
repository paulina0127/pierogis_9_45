<div class="form-field">
    <label>Środek leczniczy</label>
    <select name="product_id" <?php echo (!empty($product_id_err)) ? 'is-invalid' : ''; ?>>
    <?php
    $med_query = "SELECT * FROM product WHERE category='Środek leczniczy'";
    $med_result = mysqli_query($conn, $med_query);

    while ($med_row = mysqli_fetch_array($med_result)) {
        $list = '<option value="' . $med_row['id'] . '"';
        if ($product_id == $med_row['id']) $list .= ' selected';
        $list .= '>' . $med_row['manufacturer'] . ' ' . $med_row['name'] . '</option>';
        echo $list;
    }
    ?>
    </select>

    <span class="invalid-feedback">
        <?php echo $product_id_err; ?>
    </span>
</div>
<div class="form-field">
    <label>Dawka</label>
    <input type="text" name="dosage" <?php echo (!empty($dosage_err)) ? 'is-invalid' : ''; ?>
        value="<?php echo $dosage; ?>">
    <span class="invalid-feedback">
        <?php echo $dosage_err; ?>
    </span>
</div>