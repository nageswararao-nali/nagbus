<style>
.btn-file {
	position: relative;
	overflow: hidden;
}
.btn-file input[type=file] {
	position: absolute;
	top: 0;
	right: 0;
	min-width: 100%;
	min-height: 100%;
	font-size: 100px;
	text-align: right;
	filter: alpha(opacity=0);
	opacity: 0;
	background: red;
	cursor: inherit;
	display: block;
}
input[readonly] {
	background-color: white !important;
	cursor: text !important;
}
</style>
<div class="ibox float-e-margins">
  <div class="ibox-title">
    <h4>Describe your job and your company</h4>
  </div>
  <div class="ibox-content">
    <form id="Form" method="post" class="form-horizontal" >
      <div class="form-group">
        <div class="row">
          <div class="col-lg-4">
            <h4>JOB TITLE</h4>
            <p>Enter a short title for your job</p>
          </div>
          <div class="col-lg-8">
            <input type="text" class="form-control" aria-required="true" aria-invalid="true" placeholder="job title" name="jobtilte" required>
          </div>
        </div>
      </div>
      <hr/>
      <div class="form-group">
        <div class="row">
          <div class="col-lg-4">
            <h4>JOB DESCRIPTION</h4>
            <p>Describe your job in a few paragraphs</p>
          </div>
          <div class="col-lg-8">
            <div class="ibox float-e-margins" style="border:1px solid #CCC">
              <div class="ibox-content no-padding">
                <div class="summernote"> </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <hr/>
      <script type="text/javascript" src="https://<?=base_url()?>admin_assets/maps.googleapis.com/maps/api/js?key=AIzaSyDQTpXj82d8UpCi97wzo_nKXL7nYrd4G70"></script> 
      <script src="https://<?=base_url()?>admin_assets/maps.gstatic.com/maps-api-v3/api/js/21/8/main.js"></script>
      <div class="form-group">
        <div class="row">
          <div class="col-lg-4">
            <h4>JOB LOCATION</h4>
            <p>Enter a city and country or leave it blank</p>
          </div>
          <div class="col-lg-8">
            <input type="text" class="form-control" name="location" required/>
            <p>Examples: "Melbourne VIC", "Seattle", "Anywhere"</p>
            <div class="google-map" id="map1" style="position: relative; overflow: hidden; transform: translateZ(0px); background-color: rgb(229, 227, 223);">
              <div class="gm-style" style="position: absolute; left: 0px; top: 0px; overflow: hidden; width: 100%; height: 100%; z-index: 0;">
                <div style="position: absolute; left: 0px; top: 0px; overflow: hidden; width: 100%; height: 100%; z-index: 0; cursor: url(https://maps.gstatic.com/mapfiles/openhand_8_8.cur) 8 8, default;">
                  <div style="position: absolute; left: 0px; top: 0px; z-index: 1; width: 100%; transform-origin: 0px 0px 0px; transform: matrix(1, 0, 0, 1, 0, 0);">
                    <div style="transform: translateZ(0px); position: absolute; left: 0px; top: 0px; z-index: 100; width: 100%;">
                      <div style="position: absolute; left: 0px; top: 0px; z-index: 0;">
                        <div aria-hidden="true" style="position: absolute; left: 0px; top: 0px; z-index: 1; visibility: inherit;">
                          <div style="width: 256px; height: 256px; transform: translateZ(0px); position: absolute; left: 128px; top: -190px;"></div>
                          <div style="width: 256px; height: 256px; transform: translateZ(0px); position: absolute; left: 128px; top: 66px;"></div>
                          <div style="width: 256px; height: 256px; transform: translateZ(0px); position: absolute; left: -128px; top: -190px;"></div>
                          <div style="width: 256px; height: 256px; transform: translateZ(0px); position: absolute; left: -128px; top: 66px;"></div>
                          <div style="width: 256px; height: 256px; transform: translateZ(0px); position: absolute; left: 384px; top: -190px;"></div>
                          <div style="width: 256px; height: 256px; transform: translateZ(0px); position: absolute; left: 384px; top: 66px;"></div>
                        </div>
                      </div>
                    </div>
                    <div style="transform: translateZ(0px); position: absolute; left: 0px; top: 0px; z-index: 101; width: 100%;"></div>
                    <div style="transform: translateZ(0px); position: absolute; left: 0px; top: 0px; z-index: 102; width: 100%;"></div>
                    <div style="transform: translateZ(0px); position: absolute; left: 0px; top: 0px; z-index: 103; width: 100%;">
                      <div style="position: absolute; left: 0px; top: 0px; z-index: -1;">
                        <div aria-hidden="true" style="position: absolute; left: 0px; top: 0px; z-index: 1; visibility: inherit;">
                          <div style="width: 256px; height: 256px; overflow: hidden; transform: translateZ(0px); position: absolute; left: 128px; top: -190px;"></div>
                          <div style="width: 256px; height: 256px; overflow: hidden; transform: translateZ(0px); position: absolute; left: 128px; top: 66px;"></div>
                          <div style="width: 256px; height: 256px; overflow: hidden; transform: translateZ(0px); position: absolute; left: -128px; top: -190px;"></div>
                          <div style="width: 256px; height: 256px; overflow: hidden; transform: translateZ(0px); position: absolute; left: -128px; top: 66px;"></div>
                          <div style="width: 256px; height: 256px; overflow: hidden; transform: translateZ(0px); position: absolute; left: 384px; top: -190px;"></div>
                          <div style="width: 256px; height: 256px; overflow: hidden; transform: translateZ(0px); position: absolute; left: 384px; top: 66px;"></div>
                        </div>
                      </div>
                    </div>
                    <div style="position: absolute; z-index: 0; transform: translateZ(0px); left: 0px; top: 0px;">
                      <div style="overflow: hidden;"></div>
                    </div>
                    <div style="position: absolute; left: 0px; top: 0px; z-index: 0;">
                      <div aria-hidden="true" style="position: absolute; left: 0px; top: 0px; z-index: 1; visibility: inherit;">
                        <div style="transform: translateZ(0px); position: absolute; left: 128px; top: -190px; width: 256px; height: 256px; transition: opacity 200ms ease-out;"><img src="https://mts1.googleapis.com/vt?pb=!1m4!1m3!1i11!2i603!3i769!2m3!1e0!2sm!3i317119687!3m14!2sen-US!3sUS!5e18!12m1!1e47!12m3!1e37!2m1!1ssmartmaps!12m4!1e26!2m2!1sstyles!2zcy50OjZ8cC5zOjQzfHAubDotMTF8cC5oOiMwMDg4ZmYscy50OjN8cy5lOmcuZnxwLmg6I2ZmMDAwMHxwLnM6LTEwMHxwLmw6OTkscy50OjN8cy5lOmcuc3xwLmM6I2ZmODA4MDgwfHAubDo1NCxzLnQ6ODF8cy5lOmcuZnxwLmM6I2ZmZWNlMmQ5LHMudDo0MHxzLmU6Zy5mfHAuYzojZmZjY2RjYTEscy50OjN8cy5lOmwudC5mfHAuYzojZmY3Njc2NzYscy50OjN8cy5lOmwudC5zfHAuYzojZmZmZmZmZmYscy50OjJ8cC52Om9mZixzLnQ6ODJ8cy5lOmcuZnxwLnY6b258cC5jOiNmZmI4Y2I5MyxzLnQ6NDB8cC52Om9uLHMudDozOXxwLnY6b24scy50OjM2fHAudjpvbixzLnQ6MzN8cC52OnNpbXBsaWZpZWQ!4e0" draggable="false" style="-webkit-user-select: none; border: 0px; padding: 0px; margin: 0px; width: 256px; height: 256px;"></div>
                        <div style="transform: translateZ(0px); position: absolute; left: 128px; top: 66px; width: 256px; height: 256px; transition: opacity 200ms ease-out;"><img src="https://mts1.googleapis.com/vt?pb=!1m4!1m3!1i11!2i603!3i770!2m3!1e0!2sm!3i317119687!3m14!2sen-US!3sUS!5e18!12m1!1e47!12m3!1e37!2m1!1ssmartmaps!12m4!1e26!2m2!1sstyles!2zcy50OjZ8cC5zOjQzfHAubDotMTF8cC5oOiMwMDg4ZmYscy50OjN8cy5lOmcuZnxwLmg6I2ZmMDAwMHxwLnM6LTEwMHxwLmw6OTkscy50OjN8cy5lOmcuc3xwLmM6I2ZmODA4MDgwfHAubDo1NCxzLnQ6ODF8cy5lOmcuZnxwLmM6I2ZmZWNlMmQ5LHMudDo0MHxzLmU6Zy5mfHAuYzojZmZjY2RjYTEscy50OjN8cy5lOmwudC5mfHAuYzojZmY3Njc2NzYscy50OjN8cy5lOmwudC5zfHAuYzojZmZmZmZmZmYscy50OjJ8cC52Om9mZixzLnQ6ODJ8cy5lOmcuZnxwLnY6b258cC5jOiNmZmI4Y2I5MyxzLnQ6NDB8cC52Om9uLHMudDozOXxwLnY6b24scy50OjM2fHAudjpvbixzLnQ6MzN8cC52OnNpbXBsaWZpZWQ!4e0" draggable="false" style="-webkit-user-select: none; border: 0px; padding: 0px; margin: 0px; width: 256px; height: 256px;"></div>
                        <div style="transform: translateZ(0px); position: absolute; left: -128px; top: -190px; width: 256px; height: 256px; transition: opacity 200ms ease-out;"><img src="https://mts0.googleapis.com/vt?pb=!1m4!1m3!1i11!2i602!3i769!2m3!1e0!2sm!3i317119687!3m14!2sen-US!3sUS!5e18!12m1!1e47!12m3!1e37!2m1!1ssmartmaps!12m4!1e26!2m2!1sstyles!2zcy50OjZ8cC5zOjQzfHAubDotMTF8cC5oOiMwMDg4ZmYscy50OjN8cy5lOmcuZnxwLmg6I2ZmMDAwMHxwLnM6LTEwMHxwLmw6OTkscy50OjN8cy5lOmcuc3xwLmM6I2ZmODA4MDgwfHAubDo1NCxzLnQ6ODF8cy5lOmcuZnxwLmM6I2ZmZWNlMmQ5LHMudDo0MHxzLmU6Zy5mfHAuYzojZmZjY2RjYTEscy50OjN8cy5lOmwudC5mfHAuYzojZmY3Njc2NzYscy50OjN8cy5lOmwudC5zfHAuYzojZmZmZmZmZmYscy50OjJ8cC52Om9mZixzLnQ6ODJ8cy5lOmcuZnxwLnY6b258cC5jOiNmZmI4Y2I5MyxzLnQ6NDB8cC52Om9uLHMudDozOXxwLnY6b24scy50OjM2fHAudjpvbixzLnQ6MzN8cC52OnNpbXBsaWZpZWQ!4e0" draggable="false" style="-webkit-user-select: none; border: 0px; padding: 0px; margin: 0px; width: 256px; height: 256px;"></div>
                        <div style="transform: translateZ(0px); position: absolute; left: -128px; top: 66px; width: 256px; height: 256px; transition: opacity 200ms ease-out;"><img src="https://mts0.googleapis.com/vt?pb=!1m4!1m3!1i11!2i602!3i770!2m3!1e0!2sm!3i317119687!3m14!2sen-US!3sUS!5e18!12m1!1e47!12m3!1e37!2m1!1ssmartmaps!12m4!1e26!2m2!1sstyles!2zcy50OjZ8cC5zOjQzfHAubDotMTF8cC5oOiMwMDg4ZmYscy50OjN8cy5lOmcuZnxwLmg6I2ZmMDAwMHxwLnM6LTEwMHxwLmw6OTkscy50OjN8cy5lOmcuc3xwLmM6I2ZmODA4MDgwfHAubDo1NCxzLnQ6ODF8cy5lOmcuZnxwLmM6I2ZmZWNlMmQ5LHMudDo0MHxzLmU6Zy5mfHAuYzojZmZjY2RjYTEscy50OjN8cy5lOmwudC5mfHAuYzojZmY3Njc2NzYscy50OjN8cy5lOmwudC5zfHAuYzojZmZmZmZmZmYscy50OjJ8cC52Om9mZixzLnQ6ODJ8cy5lOmcuZnxwLnY6b258cC5jOiNmZmI4Y2I5MyxzLnQ6NDB8cC52Om9uLHMudDozOXxwLnY6b24scy50OjM2fHAudjpvbixzLnQ6MzN8cC52OnNpbXBsaWZpZWQ!4e0" draggable="false" style="-webkit-user-select: none; border: 0px; padding: 0px; margin: 0px; width: 256px; height: 256px;"></div>
                        <div style="transform: translateZ(0px); position: absolute; left: 384px; top: -190px; width: 256px; height: 256px; transition: opacity 200ms ease-out;"><img src="https://mts0.googleapis.com/vt?pb=!1m4!1m3!1i11!2i604!3i769!2m3!1e0!2sm!3i317117528!3m14!2sen-US!3sUS!5e18!12m1!1e47!12m3!1e37!2m1!1ssmartmaps!12m4!1e26!2m2!1sstyles!2zcy50OjZ8cC5zOjQzfHAubDotMTF8cC5oOiMwMDg4ZmYscy50OjN8cy5lOmcuZnxwLmg6I2ZmMDAwMHxwLnM6LTEwMHxwLmw6OTkscy50OjN8cy5lOmcuc3xwLmM6I2ZmODA4MDgwfHAubDo1NCxzLnQ6ODF8cy5lOmcuZnxwLmM6I2ZmZWNlMmQ5LHMudDo0MHxzLmU6Zy5mfHAuYzojZmZjY2RjYTEscy50OjN8cy5lOmwudC5mfHAuYzojZmY3Njc2NzYscy50OjN8cy5lOmwudC5zfHAuYzojZmZmZmZmZmYscy50OjJ8cC52Om9mZixzLnQ6ODJ8cy5lOmcuZnxwLnY6b258cC5jOiNmZmI4Y2I5MyxzLnQ6NDB8cC52Om9uLHMudDozOXxwLnY6b24scy50OjM2fHAudjpvbixzLnQ6MzN8cC52OnNpbXBsaWZpZWQ!4e0" draggable="false" style="-webkit-user-select: none; border: 0px; padding: 0px; margin: 0px; width: 256px; height: 256px;"></div>
                        <div style="transform: translateZ(0px); position: absolute; left: 384px; top: 66px; width: 256px; height: 256px; transition: opacity 200ms ease-out;"><img src="https://mts0.googleapis.com/vt?pb=!1m4!1m3!1i11!2i604!3i770!2m3!1e0!2sm!3i317117528!3m14!2sen-US!3sUS!5e18!12m1!1e47!12m3!1e37!2m1!1ssmartmaps!12m4!1e26!2m2!1sstyles!2zcy50OjZ8cC5zOjQzfHAubDotMTF8cC5oOiMwMDg4ZmYscy50OjN8cy5lOmcuZnxwLmg6I2ZmMDAwMHxwLnM6LTEwMHxwLmw6OTkscy50OjN8cy5lOmcuc3xwLmM6I2ZmODA4MDgwfHAubDo1NCxzLnQ6ODF8cy5lOmcuZnxwLmM6I2ZmZWNlMmQ5LHMudDo0MHxzLmU6Zy5mfHAuYzojZmZjY2RjYTEscy50OjN8cy5lOmwudC5mfHAuYzojZmY3Njc2NzYscy50OjN8cy5lOmwudC5zfHAuYzojZmZmZmZmZmYscy50OjJ8cC52Om9mZixzLnQ6ODJ8cy5lOmcuZnxwLnY6b258cC5jOiNmZmI4Y2I5MyxzLnQ6NDB8cC52Om9uLHMudDozOXxwLnY6b24scy50OjM2fHAudjpvbixzLnQ6MzN8cC52OnNpbXBsaWZpZWQ!4e0" draggable="false" style="-webkit-user-select: none; border: 0px; padding: 0px; margin: 0px; width: 256px; height: 256px;"></div>
                      </div>
                    </div>
                  </div>
                  <div style="position: absolute; left: 0px; top: 0px; z-index: 2; width: 100%; height: 100%;"></div>
                  <div style="position: absolute; left: 0px; top: 0px; z-index: 3; width: 100%; transform-origin: 0px 0px 0px; transform: matrix(1, 0, 0, 1, 0, 0);">
                    <div style="transform: translateZ(0px); position: absolute; left: 0px; top: 0px; z-index: 104; width: 100%;"></div>
                    <div style="transform: translateZ(0px); position: absolute; left: 0px; top: 0px; z-index: 105; width: 100%;"></div>
                    <div style="transform: translateZ(0px); position: absolute; left: 0px; top: 0px; z-index: 106; width: 100%;"></div>
                    <div style="transform: translateZ(0px); position: absolute; left: 0px; top: 0px; z-index: 107; width: 100%;"></div>
                  </div>
                </div>
                <div style="margin-left: 5px; margin-right: 5px; z-index: 1000000; position: absolute; left: 0px; bottom: 0px;"><a target="_blank" href="https://maps.google.com/maps?ll=40.67,-73.94&amp;z=11&amp;t=m&amp;hl=en-US&amp;gl=US&amp;mapclient=apiv3" title="Click to see this area on Google Maps" style="position: static; overflow: visible; float: none; display: inline;">
                  <div style="width: 62px; height: 26px; cursor: pointer;"><img src="https://maps.gstatic.com/mapfiles/api-3/images/google_white2.png" draggable="false" style="position: absolute; left: 0px; top: 0px; width: 62px; height: 26px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px;"></div>
                  </a></div>
                <div style="padding: 15px 21px; border: 1px solid rgb(171, 171, 171); font-family: Roboto, Arial, sans-serif; color: rgb(34, 34, 34); box-shadow: rgba(0, 0, 0, 0.2) 0px 4px 16px; z-index: 10000002; display: none; width: 256px; height: 148px; position: absolute; left: 71px; top: 60px; background-color: white;">
                  <div style="padding: 0px 0px 10px; font-size: 16px;">Map Data</div>
                  <div style="font-size: 13px;">Map data ©2015 Google</div>
                  <div style="width: 13px; height: 13px; overflow: hidden; position: absolute; opacity: 0.7; right: 12px; top: 12px; z-index: 10000; cursor: pointer;"><img src="https://maps.gstatic.com/mapfiles/api-3/images/mapcnt6.png" draggable="false" style="position: absolute; left: -2px; top: -336px; width: 59px; height: 492px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px;"></div>
                </div>
                <div class="gmnoprint" style="z-index: 1000001; position: absolute; right: 168px; bottom: 0px; width: 121px;">
                  <div draggable="false" class="gm-style-cc" style="-webkit-user-select: none;">
                    <div style="opacity: 0.7; width: 100%; height: 100%; position: absolute;">
                      <div style="width: 1px;"></div>
                      <div style="width: auto; height: 100%; margin-left: 1px; background-color: rgb(245, 245, 245);"></div>
                    </div>
                    <div style="position: relative; padding-right: 6px; padding-left: 6px; font-family: Roboto, Arial, sans-serif; font-size: 10px; color: rgb(68, 68, 68); white-space: nowrap; direction: ltr; text-align: right;"><a style="color: rgb(68, 68, 68); text-decoration: none; cursor: pointer; display: none;">Map Data</a><span style="">Map data ©2015 Google</span></div>
                  </div>
                </div>
                <div class="gmnoscreen" style="position: absolute; right: 0px; bottom: 0px;">
                  <div style="font-family: Roboto, Arial, sans-serif; font-size: 11px; color: rgb(68, 68, 68); direction: ltr; text-align: right; background-color: rgb(245, 245, 245);">Map data ©2015 Google</div>
                </div>
                <div class="gmnoprint gm-style-cc" draggable="false" style="z-index: 1000001; -webkit-user-select: none; position: absolute; right: 96px; bottom: 0px;">
                  <div style="opacity: 0.7; width: 100%; height: 100%; position: absolute;">
                    <div style="width: 1px;"></div>
                    <div style="width: auto; height: 100%; margin-left: 1px; background-color: rgb(245, 245, 245);"></div>
                  </div>
                  <div style="position: relative; padding-right: 6px; padding-left: 6px; font-family: Roboto, Arial, sans-serif; font-size: 10px; color: rgb(68, 68, 68); white-space: nowrap; direction: ltr; text-align: right;"><a href="https://www.google.com/intl/en-US_US/help/terms_maps.html" target="_blank" style="text-decoration: none; cursor: pointer; color: rgb(68, 68, 68);">Terms of Use</a></div>
                </div>
                <div draggable="false" class="gm-style-cc" style="-webkit-user-select: none; position: absolute; right: 0px; bottom: 0px;">
                  <div style="opacity: 0.7; width: 100%; height: 100%; position: absolute;">
                    <div style="width: 1px;"></div>
                    <div style="width: auto; height: 100%; margin-left: 1px; background-color: rgb(245, 245, 245);"></div>
                  </div>
                  <div style="position: relative; padding-right: 6px; padding-left: 6px; font-family: Roboto, Arial, sans-serif; font-size: 10px; color: rgb(68, 68, 68); white-space: nowrap; direction: ltr; text-align: right;"><a target="_new" title="Report errors in the road map or imagery to Google" href="https://www.google.com/maps/@40.67,-73.94,11z/data=!10m1!1e1!12b1?source=apiv3&amp;rapsrc=apiv3" style="font-family: Roboto, Arial, sans-serif; font-size: 10px; color: rgb(68, 68, 68); text-decoration: none; position: relative;">Report a map error</a></div>
                </div>
                <div class="gmnoprint" draggable="false" controlwidth="32" controlheight="84" style="margin: 5px; -webkit-user-select: none; position: absolute; left: 0px; top: 0px;">
                  <div controlwidth="32" controlheight="40" style="cursor: url(https://maps.gstatic.com/mapfiles/openhand_8_8.cur) 8 8, default; position: absolute; left: 0px; top: 0px;">
                    <div aria-label="Street View Pegman Control" style="width: 32px; height: 40px; overflow: hidden; position: absolute; left: 0px; top: 0px;"><img src="https://maps.gstatic.com/mapfiles/api-3/images/cb_scout2.png" draggable="false" style="position: absolute; left: -9px; top: -102px; width: 1028px; height: 214px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px;"></div>
                    <div aria-label="Pegman is disabled" style="width: 32px; height: 40px; overflow: hidden; position: absolute; left: 0px; top: 0px; visibility: hidden;"><img src="https://maps.gstatic.com/mapfiles/api-3/images/cb_scout2.png" draggable="false" style="position: absolute; left: -107px; top: -102px; width: 1028px; height: 214px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px;"></div>
                    <div aria-label="Pegman is on top of the Map" style="width: 32px; height: 40px; overflow: hidden; position: absolute; left: 0px; top: 0px; visibility: hidden;"><img src="https://maps.gstatic.com/mapfiles/api-3/images/cb_scout2.png" draggable="false" style="position: absolute; left: -58px; top: -102px; width: 1028px; height: 214px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px;"></div>
                    <div aria-label="Street View Pegman Control" style="width: 32px; height: 40px; overflow: hidden; position: absolute; left: 0px; top: 0px; visibility: hidden;"><img src="https://maps.gstatic.com/mapfiles/api-3/images/cb_scout2.png" draggable="false" style="position: absolute; left: -205px; top: -102px; width: 1028px; height: 214px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px;"></div>
                  </div>
                  <div class="gmnoprint" controlwidth="0" controlheight="0" style="opacity: 0.6; display: none; position: absolute;">
                    <div title="Rotate map 90 degrees" style="width: 22px; height: 22px; overflow: hidden; position: absolute; cursor: pointer;"><img src="https://maps.gstatic.com/mapfiles/api-3/images/mapcnt6.png" draggable="false" style="position: absolute; left: -38px; top: -360px; width: 59px; height: 492px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px;"></div>
                  </div>
                  <div class="gmnoprint" controlwidth="20" controlheight="39" style="position: absolute; left: 6px; top: 45px;">
                    <div style="width: 20px; height: 39px; overflow: hidden; position: absolute;"><img src="https://maps.gstatic.com/mapfiles/api-3/images/mapcnt6.png" draggable="false" style="position: absolute; left: -39px; top: -401px; width: 59px; height: 492px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px;"></div>
                    <div title="Zoom in" style="position: absolute; left: 0px; top: 2px; width: 20px; height: 17px; cursor: pointer;"></div>
                    <div title="Zoom out" style="position: absolute; left: 0px; top: 19px; width: 20px; height: 17px; cursor: pointer;"></div>
                  </div>
                </div>
                <div class="gmnoprint" style="margin: 5px; z-index: 0; position: absolute; cursor: pointer; right: 0px; top: 0px;">
                  <div class="gm-style-mtc" style="float: left;">
                    <div draggable="false" title="Show street map" style="direction: ltr; overflow: hidden; text-align: center; position: relative; color: rgb(0, 0, 0); font-family: Roboto, Arial, sans-serif; -webkit-user-select: none; font-size: 11px; padding: 1px 6px; border-bottom-left-radius: 2px; border-top-left-radius: 2px; -webkit-background-clip: padding-box; border: 1px solid rgba(0, 0, 0, 0.14902); box-shadow: rgba(0, 0, 0, 0.298039) 0px 1px 4px -1px; min-width: 24px; font-weight: 500; background-color: rgb(255, 255, 255); background-clip: padding-box;">Map</div>
                    <div style="z-index: -1; padding-top: 2px; -webkit-background-clip: padding-box; border-width: 0px 1px 1px; border-right-style: solid; border-bottom-style: solid; border-left-style: solid; border-right-color: rgba(0, 0, 0, 0.14902); border-bottom-color: rgba(0, 0, 0, 0.14902); border-left-color: rgba(0, 0, 0, 0.14902); box-shadow: rgba(0, 0, 0, 0.298039) 0px 1px 4px -1px; position: absolute; left: 0px; top: 19px; text-align: left; display: none; background-color: white; background-clip: padding-box;">
                      <div draggable="false" title="Show street map with terrain" style="color: rgb(0, 0, 0); font-family: Roboto, Arial, sans-serif; -webkit-user-select: none; font-size: 11px; padding: 3px 8px 3px 3px; direction: ltr; text-align: left; white-space: nowrap; background-color: rgb(255, 255, 255);"><span role="checkbox" style="box-sizing: border-box; position: relative; line-height: 0; font-size: 0px; margin: 0px 5px 0px 0px; display: inline-block; border: 1px solid rgb(198, 198, 198); border-radius: 1px; width: 13px; height: 13px; vertical-align: middle; background-color: rgb(255, 255, 255);">
                        <div style="position: absolute; left: 1px; top: -2px; width: 13px; height: 11px; overflow: hidden; display: none;"><img src="https://maps.gstatic.com/mapfiles/mv/imgs8.png" draggable="false" style="position: absolute; left: -52px; top: -44px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px; width: 68px; height: 67px;"></div>
                        </span>
                        <label style="vertical-align: middle; cursor: pointer;">Terrain</label>
                      </div>
                    </div>
                  </div>
                  <div class="gm-style-mtc" style="float: left;">
                    <div draggable="false" title="Show satellite imagery" style="direction: ltr; overflow: hidden; text-align: center; position: relative; color: rgb(86, 86, 86); font-family: Roboto, Arial, sans-serif; -webkit-user-select: none; font-size: 11px; padding: 1px 6px; border-bottom-right-radius: 2px; border-top-right-radius: 2px; -webkit-background-clip: padding-box; border-width: 1px 1px 1px 0px; border-top-style: solid; border-right-style: solid; border-bottom-style: solid; border-top-color: rgba(0, 0, 0, 0.14902); border-right-color: rgba(0, 0, 0, 0.14902); border-bottom-color: rgba(0, 0, 0, 0.14902); box-shadow: rgba(0, 0, 0, 0.298039) 0px 1px 4px -1px; min-width: 41px; background-color: rgb(255, 255, 255); background-clip: padding-box;">Satellite</div>
                    <div style="z-index: -1; padding-top: 2px; -webkit-background-clip: padding-box; border-width: 0px 1px 1px; border-right-style: solid; border-bottom-style: solid; border-left-style: solid; border-right-color: rgba(0, 0, 0, 0.14902); border-bottom-color: rgba(0, 0, 0, 0.14902); border-left-color: rgba(0, 0, 0, 0.14902); box-shadow: rgba(0, 0, 0, 0.298039) 0px 1px 4px -1px; position: absolute; right: 0px; top: 19px; text-align: left; display: none; background-color: white; background-clip: padding-box;">
                      <div draggable="false" title="Zoom in to show 45 degree view" style="color: rgb(184, 184, 184); font-family: Roboto, Arial, sans-serif; -webkit-user-select: none; font-size: 11px; padding: 3px 8px 3px 3px; direction: ltr; text-align: left; white-space: nowrap; display: none; background-color: rgb(255, 255, 255);"><span role="checkbox" style="box-sizing: border-box; position: relative; line-height: 0; font-size: 0px; margin: 0px 5px 0px 0px; display: inline-block; border: 1px solid rgb(241, 241, 241); border-radius: 1px; width: 13px; height: 13px; vertical-align: middle; background-color: rgb(255, 255, 255);">
                        <div style="position: absolute; left: 1px; top: -2px; width: 13px; height: 11px; overflow: hidden; display: none;"><img src="https://maps.gstatic.com/mapfiles/mv/imgs8.png" draggable="false" style="position: absolute; left: -52px; top: -44px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px; width: 68px; height: 67px;"></div>
                        </span>
                        <label style="vertical-align: middle; cursor: pointer;">45°</label>
                      </div>
                      <div draggable="false" title="Show imagery with street names" style="color: rgb(0, 0, 0); font-family: Roboto, Arial, sans-serif; -webkit-user-select: none; font-size: 11px; padding: 3px 8px 3px 3px; direction: ltr; text-align: left; white-space: nowrap; background-color: rgb(255, 255, 255);"><span role="checkbox" style="box-sizing: border-box; position: relative; line-height: 0; font-size: 0px; margin: 0px 5px 0px 0px; display: inline-block; border: 1px solid rgb(198, 198, 198); border-radius: 1px; width: 13px; height: 13px; vertical-align: middle; background-color: rgb(255, 255, 255);">
                        <div style="position: absolute; left: 1px; top: -2px; width: 13px; height: 11px; overflow: hidden;"><img src="https://maps.gstatic.com/mapfiles/mv/imgs8.png" draggable="false" style="position: absolute; left: -52px; top: -44px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px; width: 68px; height: 67px;"></div>
                        </span>
                        <label style="vertical-align: middle; cursor: pointer;">Labels</label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <hr/>
      <div class="form-group">
        <div class="row">
          <div class="col-lg-4">
            <h4>HOW TO APPLY</h4>
            <p>Select how you would want jobseekers to submit their applications</p>
          </div>
          <div class="col-lg-8">
            <label>
              <input type="radio" name="optionsRadios" required/>
              Allow job seekers to submit their cover letter and resume directly </label>
            <label>
              <input type="radio" name="optionsRadios" required/>
              Job seekers must follow the application steps below </label>
            <br/>
            <div class="ibox float-e-margins" style="border:1px solid #CCC">
              <div class="ibox-content no-padding">
                <div class="summernote"> </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <hr/>
      <div class="form-group">
        <div class="row">
          <div class="col-lg-4">
            <h4>CONTRACT TYPE</h4>
            <p>Select the correct type for your job</p>
          </div>
          <div class="col-lg-4">
            <div class="form-group">
              <select id="brand" class="form-control" name="brand" required>
                <option value="">contracttype</option>
                <option>Contract</option>
                <option>Freelance</option>
                <option>Part Time</option>
                <option>Full Time</option>
              </select>
            </div>
          </div>
        </div>
      </div>
      <hr/>
      <div class="form-group">
        <div class="row">
          <div class="col-lg-4">
            <h4>JOB CATEGORY</h4>
            <p>Select a category for your job</p>
          </div>
          <div class="col-lg-4">
            <div class="form-group">
              <select id="brand" class="form-control" name="brand" required>
                <option>Wordpress backend</option>
                <option>Banking</option>
                <option>Finance</option>
                <option>Human Resources</option>
                <option>Sales</option>
                <option>Hardware</option>
                <option>Software</option>
                <option>Accounting</option>
                <option>Information Technology</option>
                <option>Marketing</option>
                <option>Customer Service</option>
              </select>
            </div>
          </div>
        </div>
      </div>
      <hr/>
      <div class="form-group">
        <div class="row">
          <div class="col-lg-4">
            <h4>Custom Text</h4>
            <p>Custom field Text</p>
          </div>
          <div class="col-lg-8">
            <input type="text" class="form-control" name="customtext" required/>
          </div>
        </div>
      </div>
      <hr/>
      <div class="form-group">
        <div class="row">
          <div class="col-lg-4">
            <h4>Custom Date</h4>
            <p>Custom Fields Date</p>
          </div>
          <div class="col-lg-4">
            <div class="input-group date"> <span class="input-group-addon"> <i class="fa fa-calendar"></i> </span>
              <input id="datepicker" type="text" class="form-control" value="" name="date" required/>
            </div>
          </div>
        </div>
      </div>
      <hr/>
      <div class="form-group">
        <div class="row">
          <div class="col-lg-4">
            <h4>Hotline</h4>
          </div>
          <div class="col-lg-8">
            <input type="text" class="form-control" name="hotline" required/>
          </div>
        </div>
      </div>
      <hr/>
      <div class="form-group">
        <div class="row">
          <div class="col-lg-4">
            <h4>COMPANY NAME</h4>
            <p>Enter your company name</p>
          </div>
          <div class="col-lg-8">
            <input type="text" class="form-control" name="companyname" required/>
          </div>
        </div>
      </div>
      <hr/>
      <div class="form-group">
        <div class="row">
          <div class="col-lg-4">
            <h4>COMPANY WEBSITE</h4>
            <p>Enter your company website</p>
          </div>
          <div class="col-lg-8">
            <input type="text" class="form-control" name="companywebsite" required/>
          </div>
        </div>
      </div>
      <hr/>
      <div class="form-group">
        <div class="row">
          <div class="col-lg-4">
            <h4>COMPANY LOGO</h4>
            <p>Upload your company logo</p>
          </div>
          <div class="col-lg-8"> <span class="file-input btn btn-primary btn-file"> Browse&hellip;
            <input type="file" multiple name="logo" required/>
            </span> </div>
        </div>
      </div>
      <hr/>
      <div class="form-group">
        <div class="row">
          <div class="col-lg-offset-4 col-lg-6">
            <label>
              <input type="checkbox" name="checkbox" required/>
              I agree with the Terms of use </label>
          </div>
        </div>
      </div>
      <hr/>
      <div class="form-group">
        <div class="row">
          <div class="col-lg-offset-4 col-lg-6">
            <button type="submit" class="btn btn-primary">continue</button>
            <button type="cancel" class="btn btn-primary">cancel</button>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
<script>
$(document).on('change', '.btn-file :file', function() {
  var input = $(this),
      numFiles = input.get(0).files ? input.get(0).files.length : 1,
      label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
  input.trigger('fileselect', [numFiles, label]);
});

$(document).ready( function() {
    $('.btn-file :file').on('fileselect', function(event, numFiles, label) {
        
        var input = $(this).parents('.input-group').find(':text'),
            log = numFiles > 1 ? numFiles + ' files selected' : label;
        
        if( input.length ) {
            input.val(log);
        } else {
            if( log ) alert(log);
        }
        
    });
	
         $(document).ready(function(){
             $("#Form").validate({
                 rules: {
                     jobtilte: {
						
                         required: true,
                         minlength: 3
					
                     },
                     location: {
                         required: true,
                         
                     },
                     optionsRadios: {
                         required: true,
                         
                     },
                     brand: {
                         required: true,
                         
                     },
					 customtext: {
                         required: true,
                         
                     },
					 date: {
					     required: true,
                         min:"01/01/2000",
						 max:"01/01/2020"
						 
                     },
					 hotline: {
                         required: true,
                         
                     },
					 companyname: {
                         required: true,
                         
                     },
					 companywebsite: {
                         required: true,
                         
                     },
					 logo: {
                         required: true,
                         
                     },
					 checkbox: {
                         required: true,
                         
                     },
                 }
			 }
             })
        });
</script> 
