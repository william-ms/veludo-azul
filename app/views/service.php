<div class="service">
  <div class="service-show border-wrapper">
    <div class="service-name">
      <p><?php echo "{$service->firstName} {$service->lastName}"; ?></p>
    </div>

    <div class="service-phonenumber">
      <p><?php echo $service->phoneNumber; ?></p>
    </div>

    <div class="service-status status-<?php echo $service->status; ?>">
      <p><?php echo $service->status; ?></p>
    </div>

    <div class="service-tasks tasks-<?php echo $service->status; ?>">
      <p><?php echo $service->description; ?></p>
    </div>

    <div class="service-date">
      <p>Data de Entrega:</p>
      <p><?php echo $service->dateOutput; ?></p>
    </div>

    <div class="service-value">
      <p>Valor: <?php echo ($service->received == 'true') ? "(Pago)" : "" ?></p>

      <p>R$<?php echo $service->value; ?></p>
    </div>
  </div>


  <div class="service-buttons">
    <div>
      <a class="btn btn-service" href="/"><i class="fa-solid fa-arrow-left"></i></a>
    </div>


    <div>
      <?php if($service->status === 'prateleira'): ?>
        <button class="btn btn-service" onclick="open_modal('modal-status-pronto')"><i class="fa-solid fa-circle-half-stroke"></i></button>
      
        <dialog class="modal" id="modal-status-pronto">
          <div class="btn-close-wrapper">
            <button class="btn btn-close" onclick="close_modal('modal-status-pronto')"><i class="fa-solid fa-xmark"></i></a>
          </div>

          <h2>Atualizar serviço para "pronto"?</h2>

          <div class="btn-wrapper">
            <a class="btn btn-confirm" href="/service/edit/status">Sim</a>

            <button class="btn btn-confirm" onclick="close_modal('modal-status-pronto')">Não</button>
          </div>
        </dialog>
      <?php elseif($service->status === 'pronto'): ?>
        <button class="btn btn-service" onclick="open_modal('modal-status-entregue')"><i class="fa-solid fa-circle"></i></button>
      
        <dialog class="modal" id="modal-status-entregue">
          <div class="btn-close-wrapper">
            <button class="btn btn-close" onclick="close_modal('modal-status-entregue')"><i class="fa-solid fa-xmark"></i></a>
          </div>

          <h2>Atualizar serviço para "entregue"?</h2>

          <div class="btn-wrapper">
            <a class="btn btn-confirm" href="/service/edit/status">Sim</a>

            <button class="btn btn-confirm" onclick="close_modal('modal-status-entregue')">Não</button>
          </div>
        </dialog>
      <?php elseif($service->status === 'entregue'): ?>
        <button class="btn btn-service" onclick="open_modal('modal-status-prateleira')"><i class="fa-regular fa-circle"></i></button>
      
        <dialog class="modal" id="modal-status-prateleira">
          <div class="btn-close-wrapper">
            <button class="btn btn-close" onclick="close_modal('modal-status-prateleira')"><i class="fa-solid fa-xmark"></i></a>
          </div>

          <h2>Atualizar serviço para "prateleira"?</h2>

          <div class="btn-wrapper">
            <a class="btn btn-confirm" href="/service/edit/status">Sim</a>

            <button class="btn btn-confirm" onclick="close_modal('modal-status-prateleira')">Não</button>
          </div>
        </dialog>
      <?php endif; ?>
    </div>

    <div>
      <?php if($service->received === 'false'): ?>
        <button class="btn btn-service" onclick="open_modal('modal-payment')"><i class="fa-solid fa-dollar-sign"></i></button>
      
        <dialog class="modal" id="modal-payment">
          <div class="btn-close-wrapper">
            <button class="btn btn-close" onclick="close_modal('modal-payment')"><i class="fa-solid fa-xmark"></i></a>
          </div>

          <div class="service-qrcode">
            <img src="<?php echo IMAGE_PATH; ?>qrcode.jpg" />
          </div>

          <div class="btn-wrapper">
            <a class="btn btn-confirm" href="/service/edit/payment">Pagar</a>
          </div>
        </dialog>
      
      <?php elseif($service->received === 'true'): ?>
        <button class="btn btn-service" onclick="open_modal('modal-payment-remove')"><i class="fa-solid fa-dollar-sign"></i><i class="fa-solid fa-slash fa-value"></i></button>

        <dialog class="modal" id="modal-payment-remove">
          <div class="btn-close-wrapper">
            <button class="btn btn-close" onclick="close_modal('modal-payment-remove')"><i class="fa-solid fa-xmark"></i></a>
          </div>

          <h2>Remover pagamento do serviço?</h2>

          <div class="btn-wrapper">
            <a class="btn btn-confirm" href="/service/edit/payment">Sim</a>

            <button class="btn btn-confirm" onclick="close_modal('modal-payment-remove')">Não</button>
          </div>
        </dialog>
      <?php endif; ?>
    </div>

    <div>
      <a class="btn btn-service" href="/service/edit/description"><i class="fa-solid fa-pen"></i></a>
    </div>

    <div>
      <button class="btn btn-service" onclick="open_modal('modal-delete')"><i class="fa-solid fa-trash"></i></button>

        <dialog class="modal" id="modal-delete">
          <div class="btn-close-wrapper">
            <button class="btn btn-close" onclick="close_modal('modal-delete')"><i class="fa-solid fa-xmark"></i></a>
          </div>

          <h2>Deletar serviço?</h2>

          <div class="btn-wrapper">
            <a class="btn btn-confirm" href="/destroy/service/<?php echo $service->id; ?>">Sim</a>

            <button class="btn btn-confirm" onclick="close_modal('modal-delete')">Não</button>
          </div>
        </dialog>
    </div>
  </div>
</div>