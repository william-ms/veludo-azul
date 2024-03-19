<div class="home-services border-wrapper">
  <div class="day-services">
    <h2><?php echo "{$date[2]}/{$date[1]}/{$date[0]}"; ?><h2>
    <!-- <h3> weekday <h3> -->
  </div>

  <div class="list-services">
    <?php if(count($services) > 0): ?>
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
        <h2>Não há serviços para hoje</h2>
      </div>
    <?php endif; ?>
  </div>
</div>

<div class="home-buttons">
  <div>
    <a class="btn btn-change-day" href="/calendar"><i class="fa-regular fa-calendar-days"></i></a>
  </div>

  <div>
    <a class="btn btn-add-service" href="/service/create"><i class="fa-solid fa-plus"></i></a>
  </div>

  <div>
    <a class="btn btn-search" href="/search"><i class="fa-solid fa-magnifying-glass"></i></a>
  </div>
</div>
