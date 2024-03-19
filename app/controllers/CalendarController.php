<?php
  namespace app\controllers;

  use app\library\controllers\Controller;

  class CalendarController extends Controller
  {
    public function index(array $args)
    {
      $date = explode('-', session_get('date'));

      $lengthDays = 31;

      if($date[1] === '02')
      {
        $lengthDays = 28;
      }
      else if(in_array($date[1], ['04', '06', '09', '11']))
      {
        $lengthDays = 30;
      }

      $months = [
        '01'=>'Janeiro', 
        '02'=>'Fevereiro', 
        '03'=>'Março', 
        '04'=>'Abril',
        '05'=>'Maio',
        '06'=>'Junho',
        '07'=>'Julho',
        '08'=>'Agosto',
        '09'=>'Setembro',
        '10'=>'Outubro',
        '11'=>'Novembro',
        '12'=>'Dezembro'
      ];

      return view('calendar', [
        'title' => 'Calendário',
        'date' => $date,
        'months' => $months,
        'lengthDays' => $lengthDays
      ])->extends('main')->css('calendar')->scripts('changeDay');
    }

    public function update(array $args)
    {
      $month = filter_input(INPUT_POST, 'month', FILTER_UNSAFE_RAW);
      $year = filter_input(INPUT_POST, 'year', FILTER_UNSAFE_RAW);
      $day = filter_input(INPUT_POST, 'day', FILTER_UNSAFE_RAW);

      $months = [
        'Janeiro'=>'01',
        'Fevereiro'=>'02',
        'Março'=>'03',
        'Abril'=>'04',
        'Maio'=>'05',
        'Junho'=>'06',
        'Julho'=>'07',
        'Agosto'=>'08',
        'Setembro'=>'09',
        'Outubro'=>'10',
        'Novembro'=>'11',
        'Dezembro'=>'12',
      ];

      $month = $months[$month];

      $date = $year .'-'. $month .'-'. $day;
      session_set('date', $date);

      redirect('/');
    }
  }