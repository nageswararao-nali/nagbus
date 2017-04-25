<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span> <img alt="image" class="img-circle" src="<?= base_url() ?>admin_assets/img/custom1.jpg" /> </span> <a data-toggle="dropdown" class="dropdown-toggle" href="#"> <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">Administrator</strong> </span> <span class="text-muted text-xs block">My Account<b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="<?php echo base_url() . 'myaccount/'?>">Profile</a></li>
                        <li><a href="<?php echo base_url() . 'myaccount/changepassword'?>">Change Password</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url() . 'welcome/logout'?>">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element"></div>
            </li>
			
			 <li> <a href="<?= base_url() ?>dashboard"><i class="fa fa-tree"></i> <span class="nav-label">DASHBOARD</span></a> </li>
			 
			 
            <li <?= $this->uri->segment(2) == "Categories" ? 'class="active"' : ''; ?>> <a href="<?= base_url() ?>dashboard/Add_categories"><i class="fa fa-th-large"></i> <span class="nav-label">Categories</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li  <?= $this->uri->segment(2) == "Categories" ? 'class="active"' : ''; ?>><a href="<?= base_url() ?>Categories/Add_categories">View all</a></li>
                </ul>
            </li>
            <li> <a href="<?= base_url() ?>operators"><i class="fa fa-tree"></i> <span class="nav-label">Add Operators</span></a> </li>
            <li <?php echo ($this->uri->segment(1) == "dashboard" && $this->uri->segment(2) != '') ? 'class="active"' : ''; ?>> <a href="#"><i class="fa fa-bell"></i> <span class="nav-label">Approvals</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li <?= ($this->uri->segment(2) == "channel_partner" || $this->uri->segment(2) == "update_channel_partner") ? 'class="active"' : ''; ?>><a href="<?= base_url() ?>dashboard/channel_partner">Channel Partners</a></li>
                    <li <?= $this->uri->segment(2) == "Agents" ? 'class="active"' : ''; ?>><a href="<?= base_url() ?>dashboard/agents">Agents</a></li>
					<li <?= $this->uri->segment(2) == "userlists" ? 'class="active"' : ''; ?>><a href="<?= base_url() ?>dashboard/userlists">Users</a></li>
                    <li <?= $this->uri->segment(2) == "service_providers" ? 'class="active"' : ''; ?>><a href="<?= base_url() ?>dashboard/service_providers">Service Providers</a></li>
                    <li <?= $this->uri->segment(2) == "sales_marketing_department" ? 'class="active"' : ''; ?>><a href="<?= base_url() ?>dashboard/sales_marketing_department" title="Sales & Marketing Department">SMDs</a></li>
<!--                    <li <?= $this->uri->segment(2) == "Food_Courts" ? 'class="active"' : ''; ?>><a href="<?= base_url() ?>Admin/Approvals/Food_Courts" title="Hotels and Restarents">Food Courts</a></li>
                    <li <?= $this->uri->segment(2) == "Modules" ? 'class="active"' : ''; ?>><a href="<?= base_url() ?>Admin/Approvals/Modules">Modules</a></li>
                    <li <?= $this->uri->segment(2) == "Categories" ? 'class="active"' : ''; ?>><a href="<?= base_url() ?>Admin/Approvals/Categories">Categories</a></li>
                    <li <?= $this->uri->segment(2) == "E_com_Sellers" ? 'class="active"' : ''; ?>><a href="<?= base_url() ?>Admin/Approvals/E_com_Sellers">E-com Sellers</a></li>
                    <li <?= $this->uri->segment(3) == "Cabs" ? 'class="active"' : ''; ?>><a href="<?= base_url() ?>Admin/Approvals/Cabs">Cabs</a></li>
                    <li <?= $this->uri->segment(3) == "Delivary_Agencies" ? 'class="active"' : ''; ?>><a href="<?= base_url() ?>Admin/Approvals/Delivary_Agencies">Delivary Agencies</a></li>-->
                </ul>
            </li>
            <!--<li <?= ($this->uri->segment(1) == "wallet" ) ? 'class="active"' : ''; ?>> <a href="<?= base_url() ?>wallet"><i class="fa fa-google-wallet"></i> <span class="nav-label">Wallet History</span></a> </li>-->
			
			   <li <?= ($this->uri->segment(1) == "wallet" && ($this->uri->segment(2) != '' )) ? 'class="active"' : ''; ?>> <a href="#"><i class="fa fa-google-wallet"></i> <span class="nav-label">Wallet</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <!-- li <?= ($this->uri->segment(2) == "history") ? 'class="active"' : ''; ?>><a href="<?= base_url() ?>wallet/history">History</a></li -->
                    <li <?= $this->uri->segment(2) == "requests" ? 'class="active"' : ''; ?>><a href="<?= base_url() ?>wallet/requests">Requests</a></li>
                    <li <?= $this->uri->segment(2) == "withdraws" ? 'class="active"' : ''; ?>><a href="<?= base_url() ?>wallet/withdraws">Withdraws</a></li>
					<li <?= $this->uri->segment(2) == "withdraws" ? 'class="active"' : ''; ?>><a href="<?= base_url() ?>wallet/reminder"><i class="fa fa-bell"></i>Add Fund Reminder</a></li>
                </ul>
            </li>
			
			<li <?= ($this->uri->segment(1) == "order" ) ? 'class="active"' : ''; ?>> <a href="<?= base_url() ?>dashboard/wallethistory"><i class="fa fa-google-wallet"></i> <span class="nav-label">Wallet History</span></a> </li>
			
			
			<li <?= ($this->uri->segment(1) == "order" ) ? 'class="active"' : ''; ?>> <a href="<?= base_url() ?>dashboard/Orders"><i class="fa fa-google-wallet"></i> <span class="nav-label">Order History</span></a> </li>
			
			<li <?= ($this->uri->segment(1) == "order" ) ? 'class="active"' : ''; ?>> <a href="<?= base_url() ?>dashboard/Ordersfail"><i class="fa fa-google-wallet"></i> <span class="nav-label">Failed Transaction</span></a> </li>
			
			
			
            <li <?= $this->uri->segment(2) == "Commission_Setup" ? 'class="active"' : ''; ?>><a href="<?= base_url() ?>Admin/Commission_Setup"><i class="fa fa-inr"></i> <span class="nav-label">Commission Setup</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
				 <!--<li <?= $this->uri->segment($this->uri->total_segments()) == "Commission_Setup" ? 'class="active"' : ''; ?>><a href="<?= base_url() ?>dashboard/Commission_categories">Commission Package Categorywise</a></li>-->
                    <li <?= $this->uri->segment($this->uri->total_segments()) == "Commission_Setup" ? 'class="active"' : ''; ?>><a href="<?= base_url() ?>dashboard/Commission">Commission Package</a></li>
                   <!-- <li <?= $this->uri->segment($this->uri->total_segments()) == "user_agent" ? 'class="active"' : ''; ?>><a href="<?= base_url() ?>dashboard/User_under_agent_commission">User under Agent</a></li>-->
                    <li <?= $this->uri->segment($this->uri->total_segments()) == "distribute" ? 'class="active"' : ''; ?>><a href="<?= base_url() ?>dashboard/Commission_distribute">Commission Distribute</a></li>

                </ul>
            </li>
			
			
			 <li <?= $this->uri->segment(2) == "Categories" ? 'class="active"' : ''; ?>> <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Support Matrix</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li  <?= $this->uri->segment(2) == "Categories" ? 'class="active"' : ''; ?>><a href="<?= base_url() ?>Supportmatrix/Add_matrix">View all</a></li>
                </ul>
            </li>
			
			<li <?= $this->uri->segment(2) == "Categories" ? 'class="active"' : ''; ?>> <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Locking Amount </span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li  <?= $this->uri->segment(2) == "Categories" ? 'class="active"' : ''; ?>><a href="<?= base_url() ?>Lockamount/Edit_lockamount">View all</a></li>
                </ul>
            </li>
			
			<li <?= $this->uri->segment(2) == "Categories" ? 'class="active"' : ''; ?>> <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Limited Offers </span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li  <?= $this->uri->segment(2) == "Categories" ? 'class="active"' : ''; ?>><a href="<?= base_url() ?>Limited_offer/limitedOffers">View Offers</a></li>
                </ul>
                
            </li>
			

            <li <?= $this->uri->segment(2) == "Commission_Setup" ? 'class="active"' : ''; ?>><a href="javascript:;"><i class="fa fa-inr"></i> <span class="nav-label">Offers</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
				 
					<li <?= $this->uri->segment($this->uri->total_segments()) == "Commission_Setup" ? 'class="active"' : ''; ?>><a href="<?= base_url() ?>Offer/Edit_subscription">Agent Subscription</a></li>
				   <li <?= $this->uri->segment($this->uri->total_segments()) == "Commission_Setup" ? 'class="active"' : ''; ?>><a href="<?= base_url() ?>Offer/Edit_offer">User Joining</a></li>
                   
                    <li <?= $this->uri->segment($this->uri->total_segments()) == "distribute" ? 'class="active"' : ''; ?>><a href="<?= base_url() ?>Offer/Edit_wallet">Wallet</a></li>
					
					<li <?= $this->uri->segment($this->uri->total_segments()) == "distribute" ? 'class="active"' : ''; ?>><a href="#">Other Offers & Promos</a></li>

                </ul>
            </li>
			
			
			<li <?= ($this->uri->segment(1) == "order" ) ? 'class="active"' : ''; ?>> <a href="<?= base_url() ?>dashboard/
			rules"><i class="fa fa-google-wallet"></i> <span class="nav-label">Tax Rules</span></a> </li>
			
			
			<!-- <li <?= $this->uri->segment(2) == "Categories" ? 'class="active"' : ''; ?>> <a href="<?= base_url() ?>dashboard/Add_categories"><i class="fa fa-th-large"></i> <span class="nav-label">Categories</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li  <?= $this->uri->segment(2) == "Categories" ? 'class="active"' : ''; ?>><a href="<?= base_url() ?>Categories/Add_categories">View all</a></li>
                </ul>
            </li>
			-->
			
			

<!--            <li <?= $this->uri->segment(2) == "Service_provider" ? 'class="active"' : ''; ?>><a href="<?= base_url() ?>Admin/Service_provider"><i class="fa fa-inr"></i> <span class="nav-label">Service Provider</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li <?= $this->uri->segment($this->uri->total_segments()) == "Service_provider" ? 'class="active"' : ''; ?>><a href="<?= base_url() ?>dashboard/Add_services">Add Service</a></li>
                    <li <?= $this->uri->segment($this->uri->total_segments()) == "approve_service_providers" ? 'class="active"' : ''; ?>><a href="<?= base_url() ?>dashboard/Approve_Service_Providers">Approve Service Providers</a></li>
                </ul>
            </li>

            <li <?= $this->uri->segment(2) == "Promotions" ? 'class="active"' : ''; ?>><a href="<?= base_url() ?>Admin/Promotions"><i class="fa fa-bars"></i> <span class="nav-label">Promotions</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li <?= $this->uri->segment($this->uri->total_segments()) == "Business_Promotions" ? 'class="active"' : ''; ?>><a href="<?= base_url() ?>dashboard/Business_Promotions">Business Promotion Codes</a></li>
                    <li <?= $this->uri->segment($this->uri->total_segments()) == "Purchase_Promotions" ? 'class="active"' : ''; ?>><a href="<?= base_url() ?>dashboard/Purchase_Promotions ">Purchase Promotion Codes</a></li>
                </ul>
            </li>

            <li <?= $this->uri->segment(2) == "APISetup" ? 'class="active"' : ''; ?>> <a href="<?= base_url() ?>Admin/APISetup"><i class="fa fa-bars"></i> <span class="nav-label">API Setup</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li <?= $this->uri->segment($this->uri->total_segments()) == "APISetup" ? 'class="active"' : ''; ?>><a href="<?= base_url() ?>dashboard/API_setup">Integrate API</a></li>
                    <li <?= $this->uri->segment($this->uri->total_segments()) == "API_credentials" ? 'class="active"' : ''; ?>><a href="<?= base_url() ?>dashboard/API_credentials">API Credentials</a></li>
                    <li <?= $this->uri->segment($this->uri->total_segments()) == "view_all" ? 'class="active"' : ''; ?>><a href="<?= base_url() ?>Admin/APISetup/view_all">View all APIs</a></li>

                </ul>
            </li>

            <li> <a href="<?= base_url() ?>dashboard/Job"><i class="fa fa-diamond"></i> <span class="nav-label">Job Form</span></a> </li>
            <li> <a href="layouts.html"><i class="fa fa-diamond"></i> <span class="nav-label">Layouts</span></a> </li>
            <li> <a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Graphs</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="graph_flot.html">Flot Charts</a></li>
                    <li><a href="graph_morris.html">Morris.js Charts</a></li>
                    <li><a href="graph_rickshaw.html">Rickshaw Charts</a></li>
                    <li><a href="graph_chartjs.html">Chart.js</a></li>
                    <li><a href="graph_chartist.html">Chartist</a></li>
                    <li><a href="graph_peity.html">Peity Charts</a></li>
                    <li><a href="graph_sparkline.html">Sparkline Charts</a></li>
                </ul>
            </li>
            <li> <a href="mailbox.html"><i class="fa fa-envelope"></i> <span class="nav-label">Mailbox </span><span class="label label-warning pull-right">16/24</span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="mailbox.html">Inbox</a></li>
                    <li><a href="mail_detail.html">Email view</a></li>
                    <li><a href="mail_compose.html">Compose email</a></li>
                    <li><a href="email_template.html">Email templates</a></li>
                </ul>
            </li>
            <li> <a href="metrics.html"><i class="fa fa-pie-chart"></i> <span class="nav-label">Metrics</span> <span class="label label-primary pull-right">NEW</span> </a> </li>
            <li> <a href="widgets.html"><i class="fa fa-flask"></i> <span class="nav-label">Widgets</span></a> </li>
            <li> <a href="#"><i class="fa fa-edit"></i> <span class="nav-label">Forms</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="form_basic.html">Basic form</a></li>
                    <li><a href="form_advanced.html">Advanced Plugins</a></li>
                    <li><a href="form_wizard.html">Wizard</a></li>
                    <li><a href="form_file_upload.html">File Upload</a></li>
                    <li><a href="form_editors.html">Text Editor</a></li>
                </ul>
            </li>
            <li> <a href="#"><i class="fa fa-desktop"></i> <span class="nav-label">App Views</span> <span class="pull-right label label-primary">SPECIAL</span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="contacts.html">Contacts</a></li>
                    <li><a href="profile.html">Profile</a></li>
                    <li><a href="projects.html">Projects</a></li>
                    <li><a href="project_detail.html">Project detail</a></li>
                    <li><a href="teams_board.html">Teams board</a></li>
                    <li><a href="social_feed.html">Social feed</a></li>
                    <li><a href="clients.html">Clients</a></li>
                    <li><a href="full_height.html">Outlook view</a></li>
                    <li><a href="file_manager.html">File manager</a></li>
                    <li><a href="calendar.html">Calendar</a></li>
                    <li><a href="issue_tracker.html">Issue tracker</a></li>
                    <li><a href="blog.html">Blog</a></li>
                    <li><a href="article.html">Article</a></li>
                    <li><a href="faq.html">FAQ</a></li>
                    <li><a href="timeline.html">Timeline</a></li>
                    <li><a href="pin_board.html">Pin board</a></li>
                </ul>
            </li>
            <li> <a href="#"><i class="fa fa-files-o"></i> <span class="nav-label">Other Pages</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="search_results.html">Search results</a></li>
                    <li><a href="lockscreen.html">Lockscreen</a></li>
                    <li><a href="invoice.html">Invoice</a></li>
                    <li><a href="login.html">Login</a></li>
                    <li><a href="login_two_columns.html">Login v.2</a></li>
                    <li><a href="forgot_password.html">Forget password</a></li>
                    <li><a href="register.html">Register</a></li>
                    <li><a href="404.html">404 Page</a></li>
                    <li><a href="500.html">500 Page</a></li>
                    <li><a href="empty_page.html">Empty page</a></li>
                </ul>
            </li>
            <li> <a href="#"><i class="fa fa-globe"></i> <span class="nav-label">Miscellaneous</span><span class="label label-info pull-right">NEW</span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="toastr_notifications.html">Notification</a></li>
                    <li><a href="nestable_list.html">Nestable list</a></li>
                    <li><a href="agile_board.html">Agile board</a></li>
                    <li><a href="timeline_2.html">Timeline v.2</a></li>
                    <li><a href="diff.html">Diff</a></li>
                    <li><a href="sweetalert.html">Sweet alert</a></li>
                    <li><a href="idle_timer.html">Idle timer</a></li>
                    <li><a href="spinners.html">Spinners</a></li>
                    <li><a href="tinycon.html">Live favicon</a></li>
                    <li><a href="google_maps.html">Google maps</a></li>
                    <li><a href="code_editor.html">Code editor</a></li>
                    <li><a href="modal_window.html">Modal window</a></li>
                    <li><a href="forum_main.html">Forum view</a></li>
                    <li><a href="validation.html">Validation</a></li>
                    <li><a href="tree_view.html">Tree view</a></li>
                    <li><a href="chat_view.html">Chat view</a></li>
                </ul>
            </li>
            <li> <a href="#"><i class="fa fa-flask"></i> <span class="nav-label">UI Elements</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="typography.html">Typography</a></li>
                    <li><a href="icons.html">Icons</a></li>
                    <li><a href="draggable_panels.html">Draggable Panels</a></li>
                    <li><a href="buttons.html">Buttons</a></li>
                    <li><a href="video.html">Video</a></li>
                    <li><a href="tabs_panels.html">Panels</a></li>
                    <li><a href="tabs.html">Tabs</a></li>
                    <li><a href="notifications.html">Notifications & Tooltips</a></li>
                    <li><a href="badges_labels.html">Badges, Labels, Progress</a></li>
                </ul>
            </li>
            <li> <a href="grid_options.html"><i class="fa fa-laptop"></i> <span class="nav-label">Grid options</span></a> </li>
            <li> <a href="#"><i class="fa fa-table"></i> <span class="nav-label">Tables</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="table_basic.html">Static Tables</a></li>
                    <li><a href="table_data_tables.html">Data Tables</a></li>
                    <li><a href="table_foo_table.html">Foo Tables</a></li>
                    <li><a href="jq_grid.html">jqGrid</a></li>
                </ul>
            </li>
            <li> <a href="#"><i class="fa fa-shopping-cart"></i> <span class="nav-label">E-commerce</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="ecommerce_products_grid.html">Products grid</a></li>
                    <li><a href="ecommerce_product_list.html">Products list</a></li>
                    <li><a href="ecommerce_product.html">Product edit</a></li>
                    <li><a href="ecommerce-orders.html">Orders</a></li>
                </ul>
            </li>
            <li> <a href="#"><i class="fa fa-picture-o"></i> <span class="nav-label">Gallery</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="basic_gallery.html">Lightbox Gallery</a></li>
                    <li><a href="carousel.html">Bootstrap Carusela</a></li>
                </ul>
            </li>
            <li> <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Menu Levels </span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li> <a href="#">Third Level <span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li> <a href="#">Third Level Item</a> </li>
                            <li> <a href="#">Third Level Item</a> </li>
                            <li> <a href="#">Third Level Item</a> </li>
                        </ul>
                    </li>
                    <li><a href="#">Second Level Item</a></li>
                    <li> <a href="#">Second Level Item</a></li>
                    <li> <a href="#">Second Level Item</a></li>
                </ul>
            </li>
            <li> <a href="css_animation.html"><i class="fa fa-magic"></i> <span class="nav-label">CSS Animations </span><span class="label label-info pull-right">62</span></a> </li>
            <li class="landing_link"> <a target="_blank" href="landing.html"><i class="fa fa-star"></i> <span class="nav-label">Landing Page</span> <span class="label label-warning pull-right">NEW</span></a> </li>
            <li class="special_link"> <a href="package.html"><i class="fa fa-database"></i> <span class="nav-label">Package</span></a> </li>-->
        </ul>
    </div>
</nav>

<?php $this->load->view('admin_template/Menu_bar.php'); ?>