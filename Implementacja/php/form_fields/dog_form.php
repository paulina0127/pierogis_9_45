<div class="form-field">
    <label>Imię</label>
    <input type="text" name="name" <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>
        value="<?php echo $name; ?>">
    <span class="invalid-feedback">
        <?php echo $name_err; ?>
    </span>
</div>
<div class="form-field">
    <label>Data przyjęcia</label>
    <input type="date" name="admission_date" <?php echo (!empty($admission_date_err)) ? 'is-invalid' : ''; ?>
        value="<?php echo $admission_date; ?>">
    <span class="invalid-feedback">
        <?php echo $admission_date_err; ?>
    </span>
</div>
<div class="form-field">
    <label>Numer boksu</label>
    <input type="number" name="box_number" <?php echo (!empty($box_number_err)) ? 'is-invalid' : ''; ?>
        value="<?php echo $box_number; ?>">
    <span class="invalid-feedback">
        <?php echo $box_number_err; ?>
    </span>
</div>
<div class="form-field">
    <label>Płeć</label>
    <select name="gender"
        <?php echo (!empty($gender_err)) ? 'is-invalid' : ''; ?>>
        <option value="" hidden>Wybierz płeć</option>
        <option value="Samica" <?php if($gender == "Samica") echo 'selected'; ?>>Samica</option>
        <option value="Samiec" <?php if($gender == "Samiec") echo 'selected'; ?>>Samiec</option>
    </select>
    <span class="invalid-feedback">
        <?php echo $gender_err; ?>
    </span>
</div>
<div class="form-field">
    <label>Data urodzenia</label>
    <input type="date" name="birthdate" <?php echo (!empty($birthdate_err)) ? 'is-invalid' : ''; ?>
        value="<?php echo $birthdate; ?>">
</div>
<div class="form-field">
    <label>Wiek</label>
    <input type="text" name="age" <?php echo (!empty($age_err)) ? 'is-invalid' : ''; ?>
        value="<?php echo $age; ?>">
    <span class="invalid-feedback">
        <?php echo $age_err; ?>
    </span>
</div>
<div class="form-field">
    <label>Rasa</label>
    <input type="text" name="breed" <?php echo (!empty($breed_err)) ? 'is-invalid' : ''; ?>
        value="<?php echo $breed; ?>">
    <span class="invalid-feedback">
        <?php echo $breed_err; ?>
    </span>
</div>
<div class="form-field">
    <label>Number chipa</label>
    <input type="text" name="chip_number" <?php echo (!empty($chip_number_err)) ? 'is-invalid' : ''; ?>
        value="<?php echo $chip_number; ?>">
</div>
<div class="form-field">
    <label>Status</label>
    <select name="status"
        <?php echo (!empty($status_err)) ? 'is-invalid' : ''; ?>>
        <option value="" hidden>Wybierz status</option>
        <option value="Przyjęty" <?php if($status == "Przyjęty") echo 'selected'; ?>>Przyjęty</option>
        <option value="Kwarantanna" <?php if($status == "Kwarantanna") echo 'selected'; ?>>Kwarantanna</option>
        <option value="Do adopcji" <?php if($status == "Do adopcji") echo 'selected'; ?>>Do adopcji</option>
        <option value="Dom tymczasowy" <?php if($status == "Dom tymczasowy") echo 'selected'; ?>>Dom tymczasowy</option>
        <option value="Zaadoptowany" <?php if($status == "Zaadoptowany") echo 'selected'; ?>>Zaadoptowany</option>
        <option value="Zmarły" <?php if($status == "Zmarły") echo 'selected'; ?>>Zmarły</option>
    </select>
    <span class="invalid-feedback">
        <?php echo $status_err; ?>
    </span>
</div>
<div class="form-field">
    <label>Alergie</label>
    <textarea name="alergies" cols="5" rows="3"><?php echo $alergies; ?></textarea>
</div>
<div class="form-field">
    <label>Opis</label>
    <textarea name="description" cols="5" rows="3"><?php echo $description; ?></textarea>
</div>
<div class="form-field">
    <label>Choroby</label>
    <textarea name="diseases" cols="5" rows="3"><?php echo $diseases; ?></textarea>
</div>