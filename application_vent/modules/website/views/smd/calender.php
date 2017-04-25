<?php $this->load->view('website/smd/links_block.php')?>
<div class="panel panel-default calendar-toolbar mb20 text-center">
      <div class="panel-body">
<div class="row">
  <div class="col-md-9">
    <div class="panel panel-default calendar-toolbar mb20 text-center">
      <div class="panel-body">
        <div class="btn-group btn-group-sm left">
          <button type="button" class="btn btn-default ion ion-arrow-left-c prev-btn"></button>
          <button type="button" class="btn btn-default ion ion-arrow-right-c next-btn"></button>
        </div>
        <button type="button" class="btn btn-default btn-sm ml15 left today-btn">today</button>
        <strong class="text-uppercase current-date"></strong>
        <div class="btn-group btn-group-sm right">
          <button type="button" class="btn btn-default view-month">Month</button>
          <button type="button" class="btn btn-default view-week">Week</button>
          <button type="button" class="btn btn-default view-day">Day</button>
        </div>
      </div>
      <div id="fullCalendar"></div>
    </div>
  </div>
  <div class="col-sm-3">
    <button type="button" class="btn btn-pink btn-icon-inline btn-sm mb15 addEventBtn"> <i class="ion ion-plus"></i> Add Event </button>
    <ul class="calevents list-unstyled" id="calevents">
    </ul>
  </div>
</div>
</div>
</div>