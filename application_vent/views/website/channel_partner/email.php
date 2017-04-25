<?php $this->load->view('website/channel_partner/links_block.php')?>

<div class="content-container" style="margin-top:0px;">
<div class="panel panel-default panel-hovered panel-stacked ">
  <div class="panel-body">
  <div class="page page-email">
    <div class="page-wrap">
      <button type="button" class="btn btn-pink ion ion-plus compose-btn" title="Compose Mail" data-toggle="modal" data-target="#composeMailModal"></button>
      <div class="row">
        <div class="col-md-3">
          <nav class="email-nav clearfix"> 
            <!-- compose mail btn -->
            <form class="form-horizontal" action="javascript:;">
              <div class="input-group mb30">
                <input class="form-control" type="text" placeholder="Search mail...">
                <div class="input-group-btn">
                  <button type="submit" class="btn btn-default ion ion-search"></button>
                </div>
              </div>
            </form>
            <div class="xsmall nav-text-lead text-uppercase text-muted mb10">Navigation</div>
            <ul class="list-unstyled navigation mb15">
              <li class="active"><a href="javascript:;"><span class="ion ion-filing"></span>Inbox (12)</a></li>
              <li><a href="javascript:;"><span class="ion ion-paper-airplane"></span>Sent</a></li>
              <li><a href="javascript:;"><span class="ion ion-magnet"></span>Spam</a></li>
              <li><a href="javascript:;"><span class="ion ion-document"></span>Drafts (2)</a></li>
              <li><a href="javascript:;"><span class="ion ion-chatbubble"></span>Chat</a></li>
              <li><a href="javascript:;"><span class="ion ion-trash-a"></span>Trash</a></li>
            </ul>
            <div class="xsmall nav-text-lead text-uppercase text-muted mb10">Tags</div>
            <ul class="list-unstyled labels mb15">
              <li> <a href="javascript:;"> <span class="ion ion-record" style="color: #5974d9"></span>Work </a> </li>
              <li> <a href="javascript:;"> <span class="ion ion-record" style="color: #19c395"></span>Reciept </a> </li>
              <li> <a href="javascript:;"> <span class="ion ion-record" style="color: #fc3644"></span>My Data </a> </li>
            </ul>
            <div class="input-group input-group-sm mt15">
              <input type="text" class="form-control" placeholder="Add Label" ng-model="newlabel">
              <div class="input-group-btn">
                <button type="button" class="btn btn-default fa fa-plus" ng-click="addLabel()"></button>
              </div>
            </div>
          </nav>
        </div>
        <div class="col-md-9">
          <div class="email-content"> 
            <!-- email summary lists -->
            <ul class="email-lists list-unstyled clearfix mb30">
              <li class="read"> <a href="javascript:;">
                <div class="group clearfix small"> <span class="sender-name left text-bold">Jonathan Doe</span> <span class="email-date right xsmall mt1 text-pink">3 mins ago</span> </div>
                <p class="subject">Some nice subject here.</p>
                <p class="summary small text-muted">Nor again is there anyone who loves or pursues or desires to obtain pain of itself...</p>
                <div class="group clearfix"> <span class="ion ion-trash-a left remove-email"></span> <span class="ion right ion-paperclip" ></span> </div>
                </a> </li>
              <li class="active"> <a href="javascript:;">
                <div class="group clearfix small"> <span class="sender-name left text-bold">Organizer.com</span> <span class="email-date right xsmall mt1 text-pink">12th Feb</span> </div>
                <p class="subject">Meetup at C.P, New Delhi</p>
                <p class="summary small text-muted">Lorem ipsum dolar sit amet...</p>
                <div class="group clearfix"> <span class="ion ion-trash-a left remove-email"></span> <span class="ion right" ></span> </div>
                </a> </li>
              <li class="read"> <a href="javascript:;">
                <div class="group clearfix small"> <span class="sender-name left text-bold">android.io</span> <span class="email-date right xsmall mt1 text-pink">11th Jan</span> </div>
                <p class="subject">Calling all android developers to join me</p>
                <p class="summary small text-muted">Pellentesque habitant morbi tristique senectus et netus...</p>
                <div class="group clearfix"> <span class="ion ion-trash-a left remove-email"></span> <span class="ion right ion-paperclip" ></span> </div>
                </a> </li>
              <li> <a href="javascript:;">
                <div class="group clearfix small"> <span class="sender-name left text-bold">android.io</span> <span class="email-date right xsmall mt1 text-pink">22nd Dec</span> </div>
                <p class="subject">Meetup at C.P, New Delhi</p>
                <p class="summary small text-muted">Lorem ipsum dolar sit amet...</p>
                <div class="group clearfix"> <span class="ion ion-trash-a left remove-email"></span> <span class="ion right"></span> </div>
                </a> </li>
              <li> <a href="javascript:;">
                <div class="group clearfix small"> <span class="sender-name left text-bold">trigger.io</span> <span class="email-date right xsmall mt1 text-pink">12th Dec</span> </div>
                <p class="subject">RE: Question about account information V334RE99e: s3ss</p>
                <p class="summary small text-muted">Hi, Thanks for the reply, I want to know something...</p>
                <div class="group clearfix"> <span class="ion ion-trash-a left remove-email"></span> <span class="ion right ion-paperclip" ></span> </div>
                </a> </li>
            </ul>
            <!-- #end email summary lists --> 
            
            <!-- email view (in real app, it must be loaded via xhr/json-->
            <div class="email-view mb15">
              <div class="group clearfix head mb15">
                <div class="left">
                  <h3 class="text-light mt5">Meetup at C.P., New Delhi</h3>
                  <p><strong>Organizer.com</strong></p>
                </div>
                <div class="right">
                  <div class="btn-group mb10 btn-group-sm">
                    <button class="btn btn-default ion ion-trash-a" type="button" ></button>
                    <button class="btn btn-default ion ion-arrow-left-c" type="button"></button>
                    <button class="btn btn-default fa ion-arrow-right-c" type="button"></button>
                  </div>
                  <div class="date small text-pink text-bold">12th Feb</div>
                </div>
              </div>
              <div class="email-description">
                <p> Proin nonummy, lacus eget pulvinar lacinia, pede felis dignissim leo, vitae tristique magna lacus sit amet eros. Nullam ornare. Praesent odio ligula, dapibus sed, tincidunt eget, dictum ac, nibh. Nam quis lacus. Nunc eleifend molestie velit. Morbi lobortis quam eu velit. Donec euismod vestibulum massa. Donec non lectus. Aliquam commodo lacus sit amet nulla.</p>
                <p> Cras dignissim elit et augue. Nullam non diam. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In hac habitasse platea dictumst. Aenean vestibulum. Sed lobortis elit quis lectus. Nunc sed lacus at augue bibendum dapibus. </p>
                <blockquote class="mt15">
                  <p>Ea nam error audiam, oratio nostrud pro id vulputate.</p>
                  <footer>Someone famous in <cite title="Source Title">Source Title</cite></footer>
                </blockquote>
              </div>
              
              <!-- reply box -->
              <form class="form-horizontal clearfix" action="javascript:;">
                <div id="replyBox"></div>
                <button class="btn btn-success btn-sm mt15 right" type="submit"><i class="fa fa-paper-plane"></i>Reply</button>
              </form>
            </div>
          </div>
        </div>
        <!-- #end row --> 
      </div>
      <!-- #end page-wrap --> 
    </div>
  </div
  ></div>
  </div>
  <!-- #end content-container --> 
  
</div>
<div class="modal modalFadeInScale" id="composeMailModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="email-compose"> <!-- wrapper for specific style -->
        
        <div class="modal-header clearfix bg-dark">
          <div class="small text-uppercase left title">New Message</div>
          <button class="close right" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form name="email-compose" id="mail-compose" action="javascript:;" class="form-horizontal">
            <div class="input-group mb15"> <span class="input-group-addon">To:</span>
              <input type="text" class="form-control">
            </div>
            <div class="input-group mb15"> <span class="input-group-addon">Subject:</span>
              <input type="text" class="form-control">
            </div>
            <div class="input-group mb15"  style="width: 100%">
              <div id="composeMailBox"></div>
            </div>
            <button type="submit" class="btn btn-success">Send Message</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
