<div class="wrapper wrapper-content animated fadeInRight" ng-controller="commissionCtrl">
<div class="row">
  <div class="col-lg-12">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <h5>Create New API</h5>
        <div class="ibox-tools"> <a class="close-link"> <i class="fa fa-times"></i> </a> </div>
      </div>
      <div class="ibox-content">
        <div class="row">
          <div class="col-lg-5">
            <div class="form-group">
              <div class="row">
                <label class="col-lg-12">Select Module</label>
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <select class="form-control" name="moduleid" ng-model="mid" ng-change="servic()" ng-options="item.name for item in modules track by item.module_id">
                    <option value="" disabled="disabled">Select Module</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-1"></div>
          <div class="col-lg-6">
            <div class="form-group">
              <div class="row">
                <label class="col-lg-12">Select Category</label>
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <select class="form-control" name="categoryid" ng-model="cid" ng-options="item.categoryname for item in categories track by item.category_id">
                    <option selected="selected" class="" value="" disabled="disabled">Select Category</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <h5>API LIST</h5>
        <div class="ibox-tools"> <a class="collapse-link"> <i class="fa fa-chevron-up"></i> </a> <a class="dropdown-toggle" data-toggle="dropdown" href="#"> <i class="fa fa-wrench"></i> </a>
          <ul class="dropdown-menu dropdown-user">
            <li><a href="#">Config option 1</a> </li>
            <li><a href="#">Config option 2</a> </li>
          </ul>
          <a class="close-link"> <i class="fa fa-times"></i> </a> </div>
      </div>
      <div class="ibox-content">
        <table class="table table-hover" ng-controllers="apiCtrl">
          <thead>
            <tr>
              <th>#</th>
              <th>API NAME</th>
              <th>URL</th>
              <th>PARAMETERS</th>
              <th>ACTION</th>
            </tr>
          </thead>
          <tbody class="tblCategories">
            <tr ng-repeat="api in apidata">
              <td></td>
              <td>Request Recharge</td>
              <td>http://</td>
              <td><a data-toggle="modal" class="btn btn-primary" href="#modal-form">View All</a></td>
              <td><button class="btn btn-sm btn-white" title="Edit"><i class="fa fa-edit"></i></button>
                <button class="btn btn-sm btn-white" title="Delete"><i class="fa fa-times"></i></button></td>
            </tr>
          </tbody>
        </table>
        <div id="modal-form" class="modal fade" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h3>Recharge Request API Parameters
                <a class="close-link" data-dismiss="modal" style="float:right"> <i class="fa fa-times"></i> </a></h3> </div>
              <div class="modal-body">
                <table class="table table-hover table-bordered">
                  <thead>
                    <tr>
                      <th>Param Name</th>
                      <th>Description</th>
                    </tr>
                  </thead>
                  <tbody class="tblCategories">
                    <tr>
                      <td>Parameter 1</td>
                      <td>Parameter 2</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>