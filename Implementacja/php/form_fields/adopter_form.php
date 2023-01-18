<div class="form-field">
    <label>Imię</label>
    <input type="text" name="name" <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>
        value="<?php echo $name; ?>">
    <span class="invalid-feedback">
        <?php echo $name_err; ?>
    </span>
</div>
<div class="form-field">
    <label>Nazwisko</label>
    <input type="text" name="surname" <?php echo (!empty($surname_err)) ? 'is-invalid' : ''; ?>
        value="<?php echo $surname; ?>">
    <span class="invalid-feedback">
        <?php echo $surname_err; ?>
    </span>
</div>
<div class="form-field">
    <label>Numer dowodu</label>
    <input type="text" name="id_number" <?php echo (!empty($id_number_err)) ? 'is-invalid' : ''; ?>
        value="<?php echo $id_number; ?>">
    <span class="invalid-feedback">
        <?php echo $id_number_err; ?>
    </span>
</div>
<div class="form-field">
    <label>Adres</label>
    <input type="text" name="address" <?php echo (!empty($address_err)) ? 'is-invalid' : ''; ?>
        value="<?php echo $address; ?>">
    <span class="invalid-feedback">
        <?php echo $address_err; ?>
    </span>
</div>
<div class="form-field">
    <label>Email</label>
    <input type="email" name="email" <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>
        value="<?php echo $email; ?>">
    <span class="invalid-feedback">
        <?php echo $email_err; ?>
    </span>
</div>
<div class="form-field">
    <label>Numer telefonu</label>
    <input type="text" name="phone" <?php echo (!empty($phone_err)) ? 'is-invalid' : ''; ?>
        value="<?php echo $phone; ?>">
    <span class="invalid-feedback">
        <?php echo $phone_err; ?>
    </span>
</div>
<div class="form-field">
    <label>Typ</label>
    <select name="type" <?php echo (!empty($type_err)) ? 'is-invalid' : ''; ?>>
        <option value="" hidden>Wybierz typ</option>
        <option value="Stały" <?php if($type == "Stały") echo 'selected'; ?>>Stały</option>
        <option value="Tymczasowy" <?php if($type == "Tymczasowy") echo 'selected'; ?>>Tymczasowy</option>
        <option value="Stały i tymczasowy" <?php if($type == "Stały i tymczasowy") echo 'selected'; ?>>Stały i tymczasowy</option>
    </select>
    <span class="invalid-feedback">
        <?php echo $type_err; ?>
    </span>
</div>
<div class="form-field">
    <label>Uwagi</label>
    <textarea name="notes" cols="5" rows="3"><?php echo $notes; ?></textarea>
</div>