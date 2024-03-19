
  <div class="border-wrapper">
    <div class="btn-close-wrapper">
      <a class="btn btn-close" href="/"><i class="fa-solid fa-xmark"></i></a>
    </div>

    <form method="post" action="/search/show" id="search-form">
      <div class="input-service">
        <input type="text" name="firstName" placeholder="Nome" value="<?php echo old('firstName'); ?>" />
        <?php echo flash('firstName'); ?>
      </div>

      <div class="input-service">
        <input type="text" name="lastName" placeholder="Sobrenome" value="<?php echo old('lastName'); ?>"/>
        <?php echo flash('lastName'); ?>
      </div>

      <div class="list-services">
        <?php if($services != '' and count($services) > 0): ?>
          <ul>
            <?php foreach($services as $service): ?>
              <li>
                <a href="/service/<?php echo $service->id; ?>">
                  <div class="list-person">
                    <p class="list-name"><?php echo "{$service->firstName} {$service->lastName}"; ?></p>
                    <p class="list-phonenumber"><?php echo $service->phoneNumber; ?></p>
                  </div>

                  <div class="list-status status-<?php echo $service->status; ?>">
                    <i class="fa-solid fa-circle"></i>
                    <span><?php echo $service->status; ?></span>
                  </div>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
        <?php else: ?>
          <div class="not-found">
            <h2>Nenhum serviço encontrado</h2>
          </div>
        <?php endif; ?>
      </div>
    </form>
  </div>

  <div class="form-button">
    <button class="btn btn-form" type="submit" form="search-form">Procurar</button>
  </div>
