<div class="calendar">
  <div class="border-wrapper">
    <div class="btn-close-wrapper">
      <a class="btn btn-close" href="/"><i class="fa-solid fa-xmark"></i></a>
    </div>

    <form method="post" action="/calendar/update" id="calendar-form">
        <div class="calendar-wrapper">
            <div class="calendar-month">
              <select name="month" id="month" onchange="changeMonth(this)">
                <?php foreach($months as $key => $month): ?>
                  <option value="<?php echo $month; ?>" <?php echo ($key == $date[1])?"selected":""; ?>>
                    <?php echo $month; ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
    
            <div class="calendar-year">
              <input type="number" name="year" value="<?php echo $date[0]; ?>" min="1900" max="2500" placeholder="2024"/>
            </div>
        </div>

        <div class="calendar-day" id="days">
          <?php for($day = 1; $day <= $lengthDays; $day++): ?>
            <input 
              type="radio" 
              id="day-<?php echo $day; ?>" 
              name="day" 
              value="<?php echo ($day < 10)? '0'.$day : $day; ?>"
              <?php echo ($day == $date[2])?"checked":""; ?>
            />

            <label
              for="day-<?php echo $day; ?>">
              <?php echo $day; ?>
            </label>
          <?php endfor; ?>
        </div>

    </form>
  </div>

  <div class="calendar-button">
    <button class="btn btn-calendar" type="submit" form="calendar-form">Confirmar</button>
  </div>
</div>