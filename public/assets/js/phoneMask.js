function phoneMask(phone)
{
  phoneFormat = phone.value.replace(/[^0-9]/g, '');

  if(phoneFormat.length >= 5 && phoneFormat.length < 9)
  {
    phoneFormat = phoneFormat.substr(0, 4) + '-' + phoneFormat.substr(4, 5);
  }
  else if(phoneFormat.length >= 9 && phoneFormat.length < 11)
  {
    phoneFormat = phoneFormat.substr(0, 5) + '-' + phoneFormat.substr(5, 6);
  }
  else if(phoneFormat.length >= 11)
  {
    phoneFormat = '('+phoneFormat.substr(0, 2)+')'+phoneFormat.substr(2, 5)+ '-' + phoneFormat.substr(7, 4);
  }

  return phone.value = phoneFormat;
}