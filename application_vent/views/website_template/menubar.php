<!-- main-container -->
<div class="main-container clearfix nav-horizontal">
<?php $this->load->view('website_template/navbar.php');?>
<!-- content-here -->
<div class="content-container fixedHeader" id="content"> 
  <!-- panels -->
  <div class="page page-ui-panels">
    <?php $this->load->view('website_template/bread_crumb.php')?>
    <div class="page-wrap"> 
    <div id="loading" class="text-center" style="display:none;"><b>Please Wait While We Load the Requested Data....</b><br/>
    <img src="<?php echo base_url()?>images/loading.gif" alt="loading"/></div>
	
    <div id="pagecontent">
    <?php "this is not displayed on the page 
		site content starts here and end tag at footer "?>