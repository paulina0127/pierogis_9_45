<div class="form-field">
    <label>Nazwa</label>
    <input type="text" name="name" <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>
        value="<?php echo $name; ?>">
    <span class="invalid-feedback">
        <?php echo $name_err; ?>
    </span>
</div>
<div class="form-field">
    <label>Producent</label>
    <input type="text" name="manufacturer" <?php echo (!empty($manufacturer_err)) ? 'is-invalid' : ''; ?>
        value="<?php echo $manufacturer; ?>">
    <span class="invalid-feedback">
        <?php echo $manufacturer_err; ?>
    </span>
</div>
<div class="form-field">
    <label>Ilość</label>
    <input type="text" name="quantity" <?php echo (!empty($quantity_err)) ? 'is-invalid' : ''; ?>
        value="<?php echo $quantity; ?>">
    <span class="invalid-feedback">
        <?php echo $quantity_err; ?>
    </span>
</div>
<div class="form-field">
    <label>Kategoria</label>
    <select name="category"
        <?php echo (!empty($category_err)) ? 'is-invalid' : ''; ?>
        value="<?php echo $category; ?>">
        <option value="" hidden>Wybierz kategorię</option>
        <option value="Karma" <?php if($category == "Karma") echo 'selected'; ?>>Karma</option>
        <option value="Środek leczniczy" <?php if($category == "Środek leczniczy") echo 'selected'; ?>>Środek leczniczy</option>
        <option value="Witaminy"<?php if($category == "Witaminy") echo 'selected'; ?> >Witaminy</option>
    </select>
    <span class="invalid-feedback">
        <?php echo $category_err; ?>
    </span>
</div>
<div class="form-field">
    <label>Typ</label>
    <select name="type"
        <?php echo (!empty($type_err)) ? 'is-invalid' : ''; ?>>
        <option value="" hidden>Wybierz typ</option>
        <option value="Sucha" <?php if($type == "Sucha") echo 'selected'; ?>>Sucha</option>
        <option value="Mokra" <?php if($type == "Mokra") echo 'selected'; ?>>Mokra</option>
        <option value="Proszek" <?php if($type == "Proszek") echo 'selected'; ?>>Proszek</option>
        <option value="Tabletki" <?php if($type == "Tabletki") echo 'selected'; ?>>Tabletki</option>
        <option value="Płyn" <?php if($type == "Płyn") echo 'selected'; ?>>Płyn</option>
    </select>
    <span class="invalid-feedback">
        <?php echo $type_err; ?>
    </span>
</div>