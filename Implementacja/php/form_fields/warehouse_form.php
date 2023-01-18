<div class="form-field">
    <label>Data przybycia</label>
    <input type="date" name="date1" <?php echo (!empty($date1_err)) ? 'is-invalid' : ''; ?>
        value="<?php echo $date1; ?>">
    <span class="invalid-feedback">
        <?php echo $date1_err; ?>
    </span>
</div>
<div class="form-field">
    <label>Data ważności</label>
    <input type="date" name="date2" <?php echo (!empty($date2_err)) ? 'is-invalid' : ''; ?>
        value="<?php echo $date2; ?>">
    <span class="invalid-feedback">
        <?php echo $date2_err; ?>
    </span>
</div>
<div class="form-field">
    <label>Ilość</label>
    <input type="number" name="quantity" <?php echo (!empty($quantity_err)) ? 'is-invalid' : ''; ?>
        value="<?php echo $quantity; ?>">
    <span class="invalid-feedback">
        <?php echo $quantity_err; ?>
    </span>
</div>
<div class="form-field">
    <label>Id produktu</label>
    <input type="text" name="product_id"<?php echo (!empty($product_id_err)) ? 'is-invalid' : ''; ?>
        value="<?php echo $product_id; ?>">
    <span class="invalid-feedback">
        <?php echo $product_id_err; ?>
    </span>
</div>