<div class="form-field">
    <label>Czynność</label>
    <input type="text" name="action" <?php echo (!empty($action_err)) ? 'is-invalid' : ''; ?>
        value="<?php echo $action; ?>">
    <span class="invalid-feedback">
        <?php echo $action_err; ?>
    </span>
</div>
<div class="form-field">
    <label>Kategoria</label>
    <select name="category" <?php echo (!empty($category_err)) ? 'is-invalid' : '' ; ?>
        value="
        <?php echo $category; ?>">
        <option value="" hidden>Wybierz kategorię</option>
        <option value="Weterynaryjna" <?php if($category == "Weterynaryjna") echo 'selected'; ?>>Weterynaryjna</option>
        <option value="Behawioralna" <?php if($category == "Behawioralna") echo 'selected'; ?>>Behawioralna</option>
        <option value="Inna" <?php if($category == "Inna") echo 'selected'; ?>>Inna</option>
    </select>
    <span class="invalid-feedback">
        <?php echo $category_err; ?>
    </span>
</div>
<div class="form-field">
    <label>Typ</label>
    <select name="type" <?php echo (!empty($type_err)) ? 'is-invalid' : '' ; ?>>
        <option value="" hidden>Wybierz typ</option>
        <option value="Szczepienie" <?php if($type == "Szczepienie") echo 'selected'; ?>>Szczepienie</option>
        <option value="Odrobaczanie" <?php if($type == "Odrobaczanie") echo 'selected'; ?>>Odrobaczanie</option>
        <option value="Zabieg" <?php if($type == "Zabieg") echo 'selected'; ?>>Zabieg</option>
        <option value="Kntrola płodności" <?php if($type == "Kontrola płodności") echo 'selected'; ?>>Kontrola płodności</option>
        <option value="Terapia" <?php if($type == "Terapia") echo 'selected'; ?>>Terapia</option>
        <option value="Inny" <?php if($type == "Inny") echo 'selected'; ?>>Inny</option>
    </select>
    <span class="invalid-feedback">
        <?php echo $type_err; ?>
    </span>
</div>
<div class="form-field">
    <label>Data</label>
    <input type="date" name="date" <?php echo (!empty($date_err)) ? 'is-invalid' : ''; ?>"
        value="<?php echo $date; ?>">
    <span class="invalid-feedback">
        <?php echo $date_err; ?>
    </span>
</div>
<div class="form-field">
    <label>Uwagi</label>
    <textarea name="notes" cols="5" rows="3"><?php echo $notes; ?></textarea>
</div>