<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default panel-hovered panel-stacked mb30">
      <div class="panel-body">
        <div class="row">
          <h3> Domestic & International Holiday packages </h3>
          </div>
          <div class="col-md-8">
           <form class="form-horizontal">
          <div class="form-group">
          <div class=" col-md-6">
              <input type="text" class="form-control" placeholder="Domestic" />
            </div>
          <div class="col-md-6">
            <input type="text" class="form-control" placeholder="International" />
            </div>
          </div>
         <div class="form-group">
          <div class="col-md-6">
            <label class="control-label">Starting from</label>
            <input type="text" class="form-control" placeholder="Type Depature City" />
          </div>
          <div class="col-md-6">
            <label class="control-label">I want to go to (Optional)</label>
            <input type="text" class="form-control" placeholder="Type specific destination or leave blank" />
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-6">
            <label class="control-label">When (Optional)</label>
              <select class="form-control" >
                <option value="1">For all dates</option>
                <option value="2">For specific dates</option>
                <option value="3">For specific month</option>
              </select>
            </div>
          <div class="col-md-6">
            <label class="control-label">Budget (Optional)</label>
            <select class="form-control">
              <option value="0">All options</option>
              <option value="1_1_9999">0-9999</option>
              <option value="2_10000_19999">10,000 to 19,999</option>
              <option value="3_20000_29999">20,000 to 29,999</option>
              <option value="4_30000_39999">30,000 to 39,999</option>
              <option value="5_40000_49999">40,000 to 49,999</option>
              <option value="6_50000_69999">50,000 to 69,999</option>
              <option value="7_70000_99999">70,000 to 99,999</option>
              <option value="8_100000_150000">1,00,000 to 1,50,000</option>
              <option value="9_150000_200000">1,50,000 to 2,00,000</option>
              <option value="10_200000_2147483647">2,00,000 and above</option>
            </select>
          </div>
        </div>
        <div class="form-group">
              <!--<div class="col-md-3">
                <input type="checkbox">
                <label>Add a flight</label>
              </div>-->
              <div class="col-md-3">
                <input type="checkbox">
                <label>Add a car</label>
            </div>
            <div class="col-md-3">
                <input type="checkbox" checked>
                <label>Book a Hotel</label>
            </div>
          </div>
        <div class="form-group">
        <div class="col-md-2">
        <a href="<?php echo base_url()?>Index/holidays/search" class="btn btn-success">Search Holidays</a>
       </div>
        </div>
        </form>
      </div>
      </div>
    </div>
  </div>
</div>
