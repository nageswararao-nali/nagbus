// JavaScript Document
(function() {

    var u = location.port != "" ? ':' + location.port : "";
    //var k = location.port != "" ? "/laabus/adminnew" : '/laabus/adminnew/';
	var k = location.port != "" ? "/adminnew" : '/adminnew/';
    var baseurl = location.protocol + "//" + document.domain + u + k;
//alert(baseurl);
    var app = angular.module('myModule', []);

    //Factories
    app.factory('moduleService', function($http) {
        var promise;
        var moduleService = {
            async: function() {
                if (!promise) {
                    promise = $http.get(baseurl + "Modules/get_all_modules").then(function(response) {
                        if (response.data.err_code == 1 && response.data.status == "SUCCESS") {
                            return response.data;
                        }
                        else
                            alert("No modules");
                    });
                }
                return promise;
            }
        };
        return moduleService;
    });

    app.factory('categoryService', function($http) {
        var promise;
        var categoryService = {
            async: function() {
                if (!promise) {
                    promise = $http.get(baseurl + "Categories/get_all_categories").then(function(response) {
                        if (response.data.err_code == 1 && response.data.status == "SUCCESS") {
                            return response.data;
                        }
                        else
                            alert("No Categories");
                    });
                }
                return promise;
            }
        };
        return categoryService;
    });

    app.factory('ServiceProviderService', function($http) {

        var promise;
        var ServiceProviderService = {
            async: function() {
                if (!promise) {
                    promise = $http.get(baseurl + "Service_provider/fetch_service_providers").then(function(response) {
                        if (response.data.err_code == 1 && response.data.status == "SUCCESS") {
                            return response.data;
                        }
                        else
                            alert("No Categories");
                    });
                }
                return promise;
            }
        };
        return ServiceProviderService;
    });

    app.factory('apiService', function($http) {
        var promise;
        var apiService = {
            async: function() {
                if (!promise) {
                    promise = $http.get(baseurl + "APISetup/get_operator_apis/3")
                }
            }
        }
    })

    app.controller("commissionCtrl", function($scope, $http, moduleService) {
        //By page load it calls the function

        $http.get(baseurl + "Modules/get_all_modules").success(function(response) {
            moduleService.async().then(function(d) {
                $scope.modules = d.message
            })
            //if(response.err_code==1 && response.status=="SUCCESS")	$scope.modules = response.message;
            //else $('select[name="moduleid"]').html('<option value="">No Modules</option>');
        });

        $scope.servic = function() {
            $http.get(baseurl + "Categories/get_selected_module_categories/" + $scope.mid.module_id).success(function(response) {
                if (response.err_code == 1 && response.status == "SUCCESS")
                    $scope.categories = response.message;
                else
                    $scope.categories = "";
            })
        }

        $scope.cat = function() {
            $http.get(baseurl + "Commission_Setup/get_operators_commission/" + $scope.mid.module_id + '/' + $scope.cid.category_id).success(function(res) {
                if (res.err_code == 1 && res.status == "SUCCESS")
                    $scope.operators = res.message;
                //else $('select[name="categoryid"]').html('<option value="">No Operators</option>');
            });
        }
        /*$scope.cat=function(){
         $http.get(baseurl+"Operators/load_operators/"+$scope.mid.module_id+'/'+$scope.cid.category_id).success(function(res){
         if(res.err_code==1 && res.status=="SUCCESS")	$scope.operators = res.message;
         //else $('select[name="categoryid"]').html('<option value="">No Operators</option>');
         });
         }*/
    });


    app.controller('moduleCtrl', function($scope, moduleService) {
        moduleService.async().then(function(d) {
            $scope.modules = d.message
        });
    });

    app.controller('categoryCtrl', function($scope, $http) {
		console.log(baseurl)
        $http.get(baseurl + "Categories/list_all_categories").then(function(response) {
            $scope.categories = response.data;
        });
        $scope.delete = function(id) {
            conf = confirm("Are you sure, you want to delete?");
            if (conf) {
                $http.get(baseurl + "Categories/delete_category/" + id).then(function(response) {
                    if (response.err_code == 1 && response.status == "SUCCESS") {
                        window.location.href = '';
                    } else {
                        alert("System error, please try again!!!");
                    }
                });
            }

        }
    }).controller('supportmatrixCtrl', function($scope, $http) {
		console.log(baseurl)
        $http.get(baseurl + "Supportmatrix/list_all_supportmatrix").then(function(response) {
            $scope.categories = response.data;
        });
        $scope.delete = function(id) {
            conf = confirm("Are you sure, you want to delete?");
            if (conf) {
                $http.get(baseurl + "Supportmatrix/delete_supportmatrix/" + id).then(function(response) {
                    if (response.err_code == 1 && response.status == "SUCCESS") {
                        window.location.href = '';
                    } else {
                        alert("System error, please try again!!!");
                    }
                });
            }

        }
    }).controller("operatorCtrl", function($scope, $http) {
        $http.get(baseurl + "operators/list_all_operators").then(function(response) {
            $scope.operators = response.data;
        });
    });

    app.controller('commissionDistributeCtrl', function($scope, $http) {
        $http.get(baseurl + "Commission_Setup/fetch_commission").success(function(response) {
            if (response.err_code == 1 && response.status == "SUCCESS") {
                $scope.smd_percentage = response.message[0].smd_percentage;
                $scope.term1_period = response.message[0].cp_term1period;
                $scope.term1_percentage = response.message[0].cp_term1percentage;
                $scope.term2_period = response.message[0].cp_term2period;
                $scope.term2_percentage = response.message[0].cp_term2percentage;
                $scope.term3_percentage = response.message[0].cp_term3percentage;
                $scope.labbus_percentage = response.message[0].laabus_percentage;
            }
            else
                $scope.categories = "";
        })
    });

    app.controller('spCtrl', function($scope, ServiceProviderService) {
        ServiceProviderService.async().then(function(d) {
            $scope.ServiceProviderServices = d.message
        });
    });
})();

/*if(response.err_code==1 && response.status=="SUCCESS")	$scope.modules = response.message;
 else $('select[name="moduleid"]').html('<option value="">No Modules</option>'); */