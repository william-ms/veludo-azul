<div class="border-wrapper">
  <div class="btn-close-wrapper">
    <a class="btn btn-close" href="/"><i class="fa-solid fa-xmark"></i></a>
  </div>

  <form method="post" action="/service" id="add-service">
    <div class="input-service">
      <input type="text" name="firstName" placeholder="Nome" value="<?php echo old('firstName'); ?>"/>
      <?php echo flash('firstName'); ?>
    </div>

      <div class="input-service">
        <input type="text" name="lastName" placeholder="Sobrenome" value="<?php echo old('lastName'); ?>"/> 
        <?php echo flash('lastName'); ?>
      </div>

      <div class="input-service">
        <input type="tel" name="phoneNumber" placeholder="(99)99999-9999" value="<?php echo old('phoneNumber'); ?>" onkeyup="phoneMask(this)"/>
        <?php echo flash('phoneNumber'); ?>
      </div>

      <div class="input-service">
        <textarea name="description" placeholder="Descrição do serviço"><?php echo old('description'); ?></textarea>
        <?php echo flash('description'); ?>
      </div>

      <div class="input-service w50">
          <div class="value-wrapper">
              <span class="span-value">R$</span>
              <input type="number" name="value" step="0.01" placeholder="00,00" value="<?php echo old('value'); ?>"/>
          </div>
        <?php echo flash('value'); ?>
      </div>

      <div class="input-service w50">
        <input type="date" name="dateOutput" value="<?php echo (old('dateOutput'))?old('dateOutput'):date('Y-m-d'); ?>"/>
        <?php echo flash('dateOutput'); ?>
      </div>
  </form>
</div>

<div class="form-button">
  <button class="btn btn-form" type="submit" form="add-service">Adicionar</button>
</div>
