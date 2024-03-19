function changeMonth(e)
{
  const days = document.getElementById("days");

  if(e)
  {
    days.innerHTML = '';
    month = e.value;
    
    changeDays(month);
  }
}

function changeDays(month)
{
  let lengthDays = 31;

  if(month === 'Fevereiro')
  {
    lengthDays = 28;
  }
  else if(['Abril', 'Junho', 'Setembro', 'Novembro'].includes(month))
  {
    lengthDays = 30;
  }

  for(let i = 1; i <= lengthDays; i++)
  {
    days.innerHTML += `
      <input type="radio" name="day" id="day-`+i+`"value="`+i+`" />
      <label for="day-`+i+`">`+i+`</label>
    `;
  }
}