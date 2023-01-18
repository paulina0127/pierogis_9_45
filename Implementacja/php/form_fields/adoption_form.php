<div class="form-field">
    <label>Data</label>
    <input type="date" name="date" <?php echo (!empty($date_err)) ? 'is-invalid' : ''; ?>"
        value="<?php echo $date; ?>">
    <span class="invalid-feedback">
        <?php echo $date_err; ?>
    </span>
</div>
<div class="form-field">
    <label>Status</label>
    <select name="status"
        <?php echo (!empty($status_err)) ? 'is-invalid' : ''; ?>>
        <option value="" hidden>Wybierz status</option>
        <option value="Rozpoczęta" <?php if($status == "Rozpoczęta") echo 'selected'; ?>>Rozpoczęta</option>
        <option value="Zaakceptowana" <?php if($status == "Zaakceptowana") echo 'selected'; ?>>Zaakceptowana</option>
        <option value="Przerwana" <?php if($status == "Przerwana") echo 'selected'; ?>>Przerwana</option>
        <option value="Zakończona" <?php if($status == "Zakończona") echo 'selected'; ?>>Zakończona</option>
    </select>
    <span class="invalid-feedback">
        <?php echo $status_err; ?>
    </span>
</div>
<div class="form-field">
    <label>Nr ewidencyjny psa</label>
    <input type="number" name="dog_id" <?php echo (!empty($dog_id_err)) ? 'is-invalid' : ''; ?>
        value="<?php echo $dog_id; ?>">
    <span class="invalid-feedback">
        <?php echo $dog_id_err; ?>
    </span>
</div>
<div class="form-field">
    <label>Typ</label>
    <select name="type" <?php echo (!empty($type_err)) ? 'is-invalid' : ''; ?>>
        <option value="" hidden>Wybierz typ</option>
        <option value="Stała" <?php if($type == "Stała") echo 'selected'; ?>>Stała</option>
        <option value="Tymczasowa" <?php if($type == "Tymczasowa") echo 'selected'; ?>>Tymczasowa</option>
    </select>
    <span class="invalid-feedback">
        <?php echo $type_err; ?>
    </span>
</div>
<div class="form-field">
    <label>Id adoptującego</label>
    <input type="number" name="adopter_id" <?php echo (!empty($adopter_id_err)) ? 'is-invalid' : ''; ?>
        value="<?php echo $adopter_id; ?>">
    <span class="invalid-feedback">
        <?php echo $adopter_id_err; ?>
    </span>
</div>

<div class="form-field">
    <label>Uwagi</label>
    <textarea name="notes" cols="5" rows="3"><?php echo $notes; ?></textarea>
</div>