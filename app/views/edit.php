<div class="border-wrapper">
  <div class="btn-close-wrapper">
    <a class="btn btn-close" href="/service/<?php echo $service->id; ?>"><i class="fa-solid fa-xmark"></i></a>
  </div>

  <form method="post" action="/service/update" id="edit-form">
    <div class="input-service">
      <input type="text" name="firstName" placeholder="Nome" value="<?php echo $service->firstName; ?>"/>
      <?php echo flash('firstName'); ?>
    </div>

    <div class="input-service">
      <input type="text" name="lastName" placeholder="Sobrenome" value="<?php echo $service->lastName ?>"/> 
      <?php echo flash('lastName'); ?>
    </div>

    <div class="input-service">
      <input type="text" name="phoneNumber" placeholder="Telefone: (xx)xxxxx-xxxxx" value="<?php echo $service->phoneNumber ?>" onkeyup="phoneMask(this)" />
      <?php echo flash('phoneNumber'); ?>
    </div>

    <div class="input-service">
      <textarea name="description" placeholder="Descrição do serviço"><?php echo $service->description ?></textarea>
      <?php echo flash('description'); ?>
    </div>

    <div class="input-service w50">
      <div class="value-wrapper">
          <span class="span-value">R$</span>
          <input type="text" name="value" placeholder="00,00" value="<?php echo $service->value ?>"/>
      </div>
      <?php echo flash('value'); ?>
    </div>

    <div class="input-service w50">
      <input type="date" name="dateOutput" placeholder="Data de Entrega: 00/00/0000" value="<?php echo $service->dateOutput; ?>" />
      <?php echo flash('dateOutput'); ?>
    </div>
  </form>
</div>

<div class="form-button">
  <button class="btn btn-form" type="submit" form="edit-form">Salvar</button>
</div>
