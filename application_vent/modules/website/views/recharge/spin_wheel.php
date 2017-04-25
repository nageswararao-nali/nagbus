<!--this page is not used in any where-->
<style>
td.the_wheel {
 background-image: url(<?php echo base_url('web_assets/images/wheel_back.png')?>);
	background-position: center;
	background-repeat: none;
}
h1, p {
	margin: 0;
}
div.power_controls {
	margin-right:70px;
}
table.power {
	background-color: #cccccc;
	cursor: pointer;
	border:1px solid #333333;
}
table.power th {
	background-color: white;
	cursor: default;
}
td.pw1 {
	background-color: #6fe8f0;
}
td.pw2 {
	background-color: #86ef6f;
}
td.pw3 {
	background-color: #ef6f6f;
}
.clickable {
	cursor: pointer;
}
p.noCanvasMsg {
	color: white;
}
</style>
<script src="<?php echo base_url()?>web_assets/scripts/plugins/winwheel.js"></script>
<div align="center">
  <table cellpadding="0" cellspacing="0" border="0">
    <tr>
      <td><div class="power_controls"> <br />
          <br />
          <table class="power" cellpadding="10" cellspacing="0">
            <tr>
              <th align="center">Power</th>
            </tr>
            <tr>
              <td width="78" align="center" id="pw3" onClick="powerSelected(3);">High</td>
            </tr>
            <tr>
              <td align="center" id="pw2" onClick="powerSelected(2);">Med</td>
            </tr>
            <tr>
              <td align="center" id="pw1" onClick="powerSelected(1);">Low</td>
            </tr>
          </table>
          <br />
          <img id="spin_button" src="<?php echo base_url()?>web_assets/images/spin_off.png" alt="Spin" onClick="startSpin();" /> <br />
          <br />
          &nbsp;&nbsp;<a href="#" onClick="resetWheel(); return false;">Play Again</a><br />
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(reset) </div></td>
      <td width="438" height="582" class="the_wheel" align="center" valign="center"><canvas class="the_canvas" id="myDrawingCanvas" width="434" height="434">
          <p class="noCanvasMsg" align="center">Sorry, your browser doesn't support canvas.<br />
            Please try another.</p>
        </canvas></td>
    </tr>
  </table>
</div>